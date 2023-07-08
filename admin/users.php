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

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}


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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        <h1><i class="fa fa-user mr-2"></i>Users</h1>
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


        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">


    <?php if(isset($success)) { ?>
<!--         <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
            <strong><?php echo $success; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>   --> 
<script>
Swal.fire({
  icon: 'success',
  title: 'Success!',
  text: '<?php echo $success;?>'
})
</script>

      <?php } ?> 


                            <div class="card-header">
                                <strong class="card-title">List of Users</strong>
                                <a href="user_create.php" class="btn btn-primary float-right text-light"><i class="fa fa-plus mr-1"></i>Add New User</a>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Program</th>
                                            <th>Year Graduated</th>
                                            <th>Work</th>
                                            <th>Email</th>
                                            <!-- <th>User Type</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        require '../dbconfig/dbconn.php';

                                        $sql = "SELECT * FROM tbl_users";

                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0){
                                        // Output the results in a table

                                        $num = 1;
                                        while($row = mysqli_fetch_assoc($result)) { ?>


                                        <tr>
                                        <td><?php echo $num; ?></td>
                                        <td><?php echo ucfirst($row['lname']).", ".ucfirst($row['fname'])." ".ucfirst($row['mname'])." ".ucfirst($row['ext_name']); ?></td>
                                        <td><?php echo $row['program']; ?></td>
                                        <td><?php echo $row['year_grad']; ?></td>
                                        <td><?php echo $row['work']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <!-- <td><?php echo $row['usertype']; ?></td> -->
                                        <td>
                                        <a class='btn btn-primary btn-sm' href='user_update.php?user_id=<?php echo $row['user_id']; ?>'><i class="fa fa-pencil"></i></a>
                                        <a class='btn btn-danger btn-sm' href='user_delete.php?user_id=<?php echo $row['user_id']; ?>'><i class="fa fa-trash"></i></a>
                                        </td>
                                        </tr>

                                        <?php $num++;}
                                        echo "</table>";
                                        } else {
                                        echo "0 results";
                                        }

                                        mysqli_close($conn);
                                        ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


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
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="../assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>
