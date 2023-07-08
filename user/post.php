<?php
session_start();



if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}


if (!isset($_SESSION['email'])) {
    header('Location: ../login.php');
    exit;
}
if ($_SESSION['usertype'] != "user") {
    header('Location: ../login.php');
    exit;
}

if(isset($_POST['submit'])){

  require '../dbconfig/dbconn.php';

  $email = $_SESSION['email'];
  $sql = "SELECT * FROM tbl_users where email = '$email'";
  $res = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($res);
  $user_id = $row['user_id'];

    $post_content = htmlspecialchars($_POST['post_content']);

    $query = "INSERT INTO tbl_forum_post(user_id, post_content) VALUES ('$user_id','$post_content')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
                $error = "Error posting!";
                $_SESSION['error'] = $error;

            } else{
                $success="Posted successfully!";
                $_SESSION['success'] = $success;


                header('Location: post.php');
                exit;
            }

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


    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>
    <div class="d-none" id="page-title">post.php</div>


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
                        <h1><i class="mr-2 fa fa-feed"></i>Forum</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Forum</a></li>
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
<script>
Swal.fire({
  icon: 'success',
  title: 'Success!',
  text: '<?php echo $success;?>'
})
</script>
<?php } ?>

<?php if(isset($error)) { ?>
<script>
Swal.fire({
  icon: 'error',
  title: 'Error!',
  text: '<?php echo $error;?>'
})
</script>
<?php } ?> 


        <div class="card-header">
            <strong class="card-title">Forum</strong>
        </div>

        <div class="card-body">


            <form action="post.php" method="post">
            <div class="form-group px-3">
                <label class="form-label" for="form4Example3" style="color: #7b0d0d">New Post</label>
                <textarea class="form-control" id="form4Example3" rows="4" name="post_content" required></textarea>
            </div>
            <div class="form-button float-right px-3">
                <button type="submit" value="submit" name="submit" class="btn btn-danger"><i class="fa fa-cloud mr-1"></i>Post</button>
                <!-- <a href="index.php" class="btn btn-secondary">Back</a> -->
            </div>
          </form>
                            </div>
                                    <div class="card-header bg-dark mt-3">
                                        <strong class="card-title text-white">Forum Post</strong>
                                    </div>
                            <div class="card-body">
                                <div class="container">
                                        <?php

                                        include '../dbconfig/dbconn.php';

                                        $sql = "SELECT * FROM tbl_forum_post ORDER BY date_posted DESC";

                                        $result = mysqli_query($conn, $sql);

                                        if (!$result){
                                        die("Invalid query: ");
                                        }
                                        

                                        if (mysqli_num_rows($result) > 0 ) {


                                        while ($row = mysqli_fetch_assoc($result)) { ?>

                                            <?php 
                                            $user_id_post = $row['user_id'];
                                            $sql1 = "SELECT * FROM tbl_users WHERE user_id = '$user_id_post'";
                                            $result1 = mysqli_query($conn, $sql1);
                                            $row1 = mysqli_fetch_assoc($result1);

                                            ?>
                                        
                                        <div class="card p-3 rounded">
                                            <div>
                                                <div class="float-left">
                                                    <p class="float-start font-weight-bold" style="color:#7b0d0d">Posted by: <?php echo ucfirst($row1['fname'])." ".ucfirst($row1['lname'])." (".$row1['email'].")"; ?></p>
                                                </div>
                                                <div class="float-right">
                                                    <p class="float-end font-weight-bold" style="color:#7b0d0d">Date Posted: <?php echo $row['date_posted']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="rounded my-2">
                                                <div class="float-left">
                                                    <p class="text-primary font-italic mb-0"><?php echo $row['post_content']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="rounded">
                                                <div class="float-right">
                                                    <a href="#email_<?php echo $row['post_id']; ?>" class="btn btn-success rounded-circle shadow-sm" data-toggle="modal"><i class="fa fa-envelope text-white"></i></a>

                                                    <a href="#edit_<?php echo $row['post_id']; ?>" class="btn btn-primary rounded-circle shadow-sm" data-toggle="modal"><i class="fa fa-pencil text-white"></i></a>

                                                    <a href="#delete_<?php echo $row['post_id']; ?>" class="btn btn-danger rounded-circle shadow-sm" data-toggle="modal"><i class="fa fa-trash text-white"></i></a>
                                                </div>          
                                            </div>
                                        <!-- <?php include 'announce_edit_delete_modal.php'; ?> -->
                                        </div>
                                       <?php } ?>
                                   <?php }else{ ?>
                                        <div class="card p-3 rounded text-center">
                                            No Post
                                        </div>
                                    <?php } ?>


                                </div>



                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <?php include 'logout_modal.php'; ?>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Get the current URL path
    var pageTitle = document.getElementById("page-title").innerText.trim();

    // Get the sidebar navbar link for the dashboard
    var dashboardLink = document.getElementById("navbar-link-announce").querySelector("a");
    var dashboardLink1 = document.getElementById("navbar-link-announce");

    // Check if the page title matches the href of the dashboard link
    if (pageTitle === dashboardLink.getAttribute("href")) {
      // Add the active hover state class to the matching link
      dashboardLink1.classList.add("active");
    }
  });
</script>


</body>

</html>
