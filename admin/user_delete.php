<?php
session_start();

if (!isset($_SESSION['email'])) {
  header('Location: ../login.php');
  exit;
}
if ($_SESSION['usertype'] != "admin") {
  header('Location: ../login.php');
  exit;
}

require '../dbconfig/dbconn.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user ID from the URL parameter
    $user_id = $_GET['user_id'];

    // Delete the user from the database
    $sql = "DELETE FROM tbl_users WHERE user_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "User deleted succesfully!";
        header("location: users.php");
        exit;
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}

// Get the user ID from the URL parameter
$user_id = $_GET['user_id'];

// Select the user's information from the database
$sql = "SELECT user_id, fname, lname, mname, ext_name, program, year_grad, work, email, usertype FROM tbl_users WHERE user_id='$user_id'";

$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output the user's information in a form
    $row = $result->fetch_assoc();


?>


<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PCB Alumni System - Admin Dashboard</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="../apple-icon.png">
    <link rel="shortcut icon" href="../favicon.ico">

    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">


    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


<!-- Left Panel -->
<?php include 'sidebar.php'; ?>
<!-- /#left-panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- Header-->
<?php include 'header.php'; ?>
<!-- /header -->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Users</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="content mt-3 justify-content-center" style="display: flex;">
            <div class="animated fadeIn">


            <div class="col-md-12 card container p-5">

                <h3 class="text-danger text-center">Delete User</h3>
                <hr class="bg-danger">
                <form method="post">
                    <div class="mb-3">
                        <p class="text-danger"><strong>Are you sure you want to delete this user?</strong></p>
                        <p>Full Name: <?php echo ucfirst($row['lname'])." ".ucfirst($row['fname'])." ".ucfirst($row['mname']); ?></p>
                        <p>Email: <?php echo $row['email']; ?></p>
                        <p>Usertype: <?php echo $row['usertype']; ?></p>
                    </div>

                    <button type="submit" class="btn btn-danger">Delete User</button>
                    <a href="users.php" class="btn btn-secondary">Cancel</a>
                </form>





                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
<?php include 'logout_modal.php'; ?>
    <!-- Right Panel -->

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>


    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="../assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>
<?php } ?>
