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
    <link rel="stylesheet" href="../vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>
    <div class="d-none" id="page-title">index.php</div>


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
                        <h1><i class="fa fa-dashboard mr-2"></i>Admin Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

                       <?php

                         require '../dbconfig/dbconn.php';

                        $sql = "SELECT * FROM tbl_users";

                        $result = mysqli_query($conn, $sql);
                        $total_alumni = mysqli_num_rows($result);
                        ?>

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
<!--                         <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div> -->
<!--                         <h4 class="mb-0">
                            <span class="count"><?php echo $total_alumni ?></span>
                        </h4> -->
                        <small class="text-light">Registered Alumni</small>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <h1 class="float-left count"><?php echo $total_alumni; ?></h1>
                            <h1 class="float-right"><i class="fa fa-user"></i></h1>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->
                       <?php

                         require '../dbconfig/dbconn.php';

                        $sql = "SELECT * FROM tbl_announcements";

                        $result = mysqli_query($conn, $sql);
                        $total_announce = mysqli_num_rows($result);
                        ?>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
<!--                         <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div> -->
<!--                         <h4 class="mb-0">
                            <span class="count"><?php echo $total_announce; ?></span>
                        </h4> -->
                        <small class="text-light">Total Announcement</small>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <h1 class="float-left count"><?php echo $total_announce; ?></h1>
                            <h1 class="float-right"><i class="fa fa-bell"></i></h1>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->
                       <?php

                         require '../dbconfig/dbconn.php';

                        $sql = "SELECT * FROM tbl_events";

                        $result = mysqli_query($conn, $sql);
                        $total_events = mysqli_num_rows($result);
                        ?>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
<!--                         <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton3" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div> -->
<!--                         <h4 class="mb-0">
                            <span class="count"><?php echo $total_events; ?></span>
                        </h4> -->
                        <small class="text-light">Total Events</small>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <h1 class="float-left count"><?php echo $total_events; ?></h1>
                            <h1 class="float-right"><i class="fa fa-calendar"></i></h1>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.col-->

                       <?php

                         require '../dbconfig/dbconn.php';

                        $sql = "SELECT * FROM tbl_users WHERE usertype = 'admin'";

                        $result = mysqli_query($conn, $sql);
                        $total_admin = mysqli_num_rows($result);
                        ?>
            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
<!--                         <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div> -->
<!--                         <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4> -->
                        <small class="text-light">Total Admin</small>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <h1 class="float-left count"><?php echo $total_admin; ?></h1>
                            <h1 class="float-right"><i class="fa fa-users"></i></h1>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->
        </div> <!-- .content -->
        <div class="content">
            <div class="col-lg-6 col-lg-3">
                <div class="card text-white bg-dark">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item text-primary" href="announce.php">View More</a>
                                    <a class="dropdown-item text-primary" href="announce.php">New Announcement</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-0">
                            <span><i class="fa fa-bell mr-2"></i>Recent Announcements</span>
                        </h4>
                        <a class="text-light" href="announce.php"><small>View More</small></a>

                        <div class="chart-wrapper p-3">
                                    <?php

                                        include '../dbconfig/dbconn.php';

                                        $sql = "SELECT * FROM tbl_announcements ORDER BY date_posted DESC LIMIT 3";

                                        $result = mysqli_query($conn, $sql);

                                        if (!$result){
                                        die("Invalid query: ");
                                        }
                                        if (mysqli_num_rows($result) > 0) {                                       
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <div class="card p-0">
                                                <div class="bg-secondary card-header rounded-0">
                                                   <small class="mb-0 text-white">Announcement #: <?php echo $row['announcement_id']; ?></small>
                                                </div>
                                                <!-- <hr> -->
                                                <div class="text-dark card-body">
                                                    <p class="font-italic text-dark mb-0"><?php echo $row['content']; ?></p>
                                                </div>
                                                <!-- <hr> -->
                                            </div>
                                    <?php } ?>
                                   <?php }else{ ?>
                                        <div class="card p-3 rounded text-center text-secondary">
                                            <small>No Recent Announcements</small>
                                        </div>
                                    <?php } ?>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-lg-3">
                <div class="card text-white bg-secondary shadow-sm">
                    <div class="card-body pb-0">
                        <div class="dropdown float-right">
                            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                                <i class="fa fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                <div class="dropdown-menu-content">
                                    <a class="dropdown-item text-primary" href="announce.php">View More</a>
                                    <a class="dropdown-item text-primary" href="announce.php">New Event</a>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-0">
                            <span><i class="fa fa-calendar mr-2"></i>Upcoming Events</span>
                        </h4>
                        <a class="text-light" href="events.php"><small>View More</small></a>

                        <div class="chart-wrapper p-3">
                                    <?php

                                        include '../dbconfig/dbconn.php';

                                        $date = date("Y-m-d");

                                        $sql = "SELECT * FROM tbl_events WHERE start > '$date' ORDER BY id DESC LIMIT 3";

                                        $result = mysqli_query($conn, $sql);

                                        if (!$result){
                                        die("Invalid query: ");
                                        }

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $date_start =$row['start'];
                                            $date_start_timestamp =strtotime($date_start);
                                            $date_formatted = date('Y-M-d D', $date_start_timestamp);

                                            $date_end =$row['end'];
                                            $date_end_timestamp =strtotime($date_end);
                                            $date_end_formatted = date('Y-M-d D', $date_end_timestamp);
                                         ?>
                                            <div class="card p-2">
                                                <div class="text-dark">
                                                    <div class="">
                                                        <p class="mb-0">Event #: <?php echo $row['id']; ?></p>
                                                        <hr>
                                                        <p class="font-weight-bold mb-0">From: <span class="font-weight-normal"><?php echo $date_formatted; ?></span></p>
                                                        <p class="font-weight-bold mb-0">To: <span class="font-weight-normal"><?php echo $date_end_formatted; ?></span></p>
                                                    </div>                                                  
                                                </div>
                                                <hr>
                                                <div class="">
                                                    <div class="">
                                                        <p class="text-secondary mb-0">Event Title:</p>
                                                        <div class="">
                                                            <small class="text-dark font-weight-bold"><?php echo $row['title']; ?></small>
                                                        </div>
                                                        <hr>
                                                        <p class="text-secondary mb-0">Event Description:</p>
                                                        <small class="text-dark font-weight-bold"><?php echo $row['description']; ?></small>
                                                        <hr>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php } ?>

                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->
        </div>
    </div><!-- /#right-panel -->

<?php include 'logout_modal.php'; ?>

    <!-- Right Panel -->

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>



    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/widgets.js"></script>


<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Get the current URL path
    var pageTitle = document.getElementById("page-title").innerText.trim();

    // Get the sidebar navbar link for the dashboard
    var dashboardLink = document.getElementById("navbar-link-dashboard").querySelector("a");
    var dashboardLink1 = document.getElementById("navbar-link-dashboard");

    // Check if the page title matches the href of the dashboard link
    if (pageTitle === dashboardLink.getAttribute("href")) {
      // Add the active hover state class to the matching link
      dashboardLink1.classList.add("active");
    }
  });
</script>


</body>

</html>
