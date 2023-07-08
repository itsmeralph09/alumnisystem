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
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

$fname="";
$mname="";
$lname="";
$extname="";
$program="";
$yeargrad="";
$work="";
$email="";
$password="";
$confirm_password="";
$usertype = "";

if (isset($_POST['submit'])) {
  
  require '../dbconfig/dbconn.php';

  $fname = $_POST['fname'];
  $mname= $_POST['mname'];
  $lname= $_POST['lname'];
  $extname= $_POST['extname'];
  $program= $_POST['program'];
  $yeargrad= $_POST['yeargrad'];
  $work= $_POST['work'];
  $email= $_POST['email'];
  $password= $_POST['password'];
  $confirm_password= $_POST['confirm_password'];
  $usertype = $_POST['usertype'];

  $query = "SELECT * FROM tbl_users WHERE email='$email'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) > 0){
    $error = "Email already used!";
  }else{
    
      if ($program != "none") {
        if($usertype != "none"){
          if ($password == $confirm_password){
          $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
      
          $query = "INSERT INTO tbl_users(fname, mname, lname, ext_name, program, year_grad, work, email, password, usertype) VALUES ('$fname','$mname','$lname','$extname','$program','$yeargrad','$work','$email','$hashed_pass', '$usertype')";
          $result = mysqli_query($conn, $query);

            if (!$result) {
              $error = "Error creating user!";
              $_SESSION['error'] = $error;
            } else{
              $success="User created successfully!";
              $_SESSION['success'] = $success;
              header('Location: users.php');
              exit;
            } 
          } else{
            $error = "Passwords do not match!";
            $_SESSION['error'] = $error;
          }
        }else{
          $error = "Please select a role!";
          $_SESSION['error'] = $error;
        }
     
    }else{
      $error = "Please select program!";
      $_SESSION['error'] = $error;
    }
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


        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

  <div class="container">

      <div class="card row m-4">



                <div class="col-md-10 mx-auto mb-2">

    <?php if(isset($error)) { ?>
<!--         <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
            <strong><?php echo $success; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>   --> 
<script>
Swal.fire({
  icon: 'error',
  title: 'Error!',
  text: '<?php echo $error;?>'
})
</script>

      <?php } ?> 
    <h3 class="text-center mt-4 mb-4" style="color: #7b0d0d">Create User Manually</h1>
    <hr style="background-color: #7b0d0d">


<form method="post" action="user_create.php">      

<input type="hidden" name="user_id"  value="<?php echo $user_id; ?>" required>
    
    <div class="form-group">
        <h4 class="text-primary text-center">Personal Information</h4>

        <label class="font-weight-bold" for="fname">First Name</label>
        <input type="text" class="form-control mb-2" id="fname" name="fname" value="<?php echo $fname; ?>" required>


        <label class="font-weight-bold" for="mname">Middle Name</label>
        <input type="text" class="form-control mb-2" id="mname" name="mname" value="<?php echo $mname; ?>">


        <label class="font-weight-bold">Last Name</label>
        <input type="text" class="form-control mb-2" name="lname" value="<?php echo $lname; ?>" required>

 
        <label class="font-weight-bold">Extension Name</label>
        <small class="text-secondary">(Jr., Sr., III, IV, etc.)</small>
        <input type="text" class="form-control mb-2" name="extname" value="<?php echo $extname; ?>">

    </div>

    <div class="form-group">
        <h4 class="text-primary text-center">Other Information</h4>

        <label class="font-weight-bold">Program Name</label>
        <select name="program" class="form-control mb-2" required>

          <?php if ($program != "" && $program != "none") { ?>
           <option value="<?php echo $program; ?>"><?php echo $program; ?></option>
          <?php } ?>
          <option value="none">Select a Program</option>

          <option value="BS in Information Technology">Bachelor of Science in Information Technology</option>
          <option value="BS in Computer Science">Bachelor of Science in Computer Science</option>
          <option value="BS in Information System">Bachelor of Science in Information System</option>
          <option  value="BS in Elementary Education">Bachelor of Science in Elementary Education</option>
          <option  value="BS in Culture and Arts Education">Bachelor of Science in Culture and Arts Education</option>
          <option  value="BS in Early Childhood Education">Bachelor of Science in Early Childhood Education</option>
        </select>


        <label class="font-weight-bold">Year Graduated</label>
        <input type="number" class="form-control   mb-2" name="yeargrad" value="<?php echo $yeargrad; ?>"  min="2009" max="2030" required>


        <label class="font-weight-bold">Work</label>
        <input type="text" class="form-control mb-2" name="work" value="<?php echo $work; ?>">

    </div>
    <div class="form-group">
        <h4 class="text-primary text-center">Account Information</h4>

        <label class="font-weight-bold">Email</label>
        <input type="email" class="form-control    mb-2" name="email" value="<?php echo $email; ?>" required>

        <label class="font-weight-bold">Password</label>
        <input type="password" class="form-control mb-2" name="password" value="<?php echo $password; ?>" required>
 

        <label class="font-weight-bold">Confirm Password</label>
        <input type="password" class="form-control mb-2" name="confirm_password" value="<?php echo $confirm_password; ?>" required>

        <label class="font-weight-bold">Usertype</label>
        <select name="usertype" class="form-control mb-2" required>
        <?php if ($usertype != "" && $usertype != "none") { ?>
          <option value="<?php echo $usertype; ?>"><?php echo $usertype; ?></option>
        <?php } ?>
        <option value="none">Select user type</option>
          <option value="admin">admin</option>
          <option  value="user">user</option>
        </select>
 
    </div>  

      <div class="form-group float-right">

            <input type="submit" class="btn btn-primary" name="submit" value="Create User">
            <a class="btn btn-secondary" href="./users.php">Cancel</a>

      </div>

    </form>

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
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="../assets/js/init-scripts/data-table/datatables-init.js"></script>


</body>

</html>
