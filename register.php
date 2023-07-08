<?php
session_start();

if (!isset($_SESSION['ver_email'])) {
  header('Location: ./pre_reg.php');
  exit;
}else{
	$email = $_SESSION['ver_email'];
}


if (isset($_SESSION['verify_success'])) {
    $success = $_SESSION['verify_success'];
    unset($_SESSION['verify_success']);
}
if (isset($_SESSION['create_error'])) {
    $error = $_SESSION['create_error'];
    unset($_SESSION['create_error']);
}


$fname="";
$mname="";
$lname="";
$extname="";
$program="";
$yeargrad="";
$work="";
$password="";
$confirm_password="";

if (isset($_POST['submit'])) {
  
  require './dbconfig/dbconn.php';

  $fname = $_POST['fname'];
  $mname= $_POST['mname'];
  $lname= $_POST['lname'];
  $extname= $_POST['extname'];
  $program= $_POST['program'];
  $yeargrad= $_POST['yeargrad'];
  $work= $_POST['work'];
  $password= $_POST['password'];
  $confirm_password= $_POST['confirm_password'];


  $query = "SELECT * FROM tbl_users WHERE email='$email'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) > 0){
      $_SESSION['create_error'] = "Email already used!";
  }else{
    
      if ($program != -1) {
        if($role != -1){
          if ($password == $confirm_password){
          $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
      
          $query = "INSERT INTO tbl_users(fname, mname, lname, ext_name, program, year_grad, work, email, password, usertype) VALUES ('$fname','$mname','$lname','$extname','$program','$yeargrad','$work','$email','$hashed_pass', 'user')";
          $result = mysqli_query($conn, $query);

            if (!$result) {
              $_SESSION['create_error'] = "Error creating user!";
            } else{
              $_SESSION['create_success'] ="Registered successfully!";
              // unset($_SESSION['reg_email']);
              header('Location: login.php');
              exit;
            } 
          } else{
            $_SESSION['create_error'] = "Passwords do not match!";
          }
        }else{
          $_SESSION['create_error'] = "Please select a role!";
        }    
    }else{
      $_SESSION['create_error'] = "Please select program!";
    }
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>PCB ALUMNI - Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	    <link rel="stylesheet" href="./vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendors/font-awesome/css/font-awesome.min.css">

	<!-- <link rel="stylesheet" href="./vendors/custom1.css"> -->
	<link rel="stylesheet" type="text/css" href="./vendors/custom.css">

	</head>
	<body>
		<div class="container" style="margin-top: 10vh;">

			<div class="justify-content-center">
				<div class="col-lg-12 text-center mb-5">
					<h2 class="heading-section rap2">Polytechnic College of Botolan Alumni System</h2>
				</div>
			</div>

	<div class="justify-content-center px-lg-5">


      <div class="card row m-4 p-4">

    <?php if(isset($error)) { ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $error; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>       
      <?php } ?>

    <?php if(isset($success)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $success; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>       
      <?php } ?>
    <div class="col-lg-12 mx-auto mb-2">



    <h3 class="text-center mt-4 mb-4" style="color: #7b0d0d">Registration</h1>
    <hr style="background-color: #7b0d0d">


<form method="post" action="register.php">      

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

          <option value="Bachelor of Science in Information Technology<">Bachelor of Science in Information Technology</option>
          <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
          <option value="Bachelor of Science in Information System">Bachelor of Science in Information System</option>
          <option  value="Bachelor of Science in Elementary Education">Bachelor of Science in Elementary Education</option>
          <option  value="Bachelor of Science in Culture and Arts Education">Bachelor of Science in Culture and Arts Education</option>
          <option  value="Bachelor of Science in Early Childhood Education">Bachelor of Science in Early Childhood Education</option>
        </select>
        
        <label class="font-weight-bold">Year Graduated</label>
        <input type="number" class="form-control   mb-2" name="yeargrad" value="<?php echo $yeargrad; ?>"  min="2009" max="2030" required>


        <label class="font-weight-bold">Work</label>
        <input type="text" class="form-control mb-2" name="work" value="<?php echo $work; ?>">

    </div>
    <div class="form-group">
        <h4 class="text-primary text-center">Account Information</h4>

        <label class="font-weight-bold">Email</label>
        <input type="email" class="form-control    mb-2" name="email" value="<?php echo $email; ?>" readonly>

        <label class="font-weight-bold">Password</label>
        <input type="password" class="form-control mb-2" name="password" small class="text-warning" required>
 

        <label class="font-weight-bold">Confirm Password</label>
        <input type="password" class="form-control mb-2" name="confirm_password" required>

    </div>  

      <div class="form-group float-right">

            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            <a class="btn btn-outline-secondary" data-toggle="modal" data-target="#backModal">Cancel</a>

<div class="modal fade" id="backModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Confirm Cancelling of Registration</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-danger">You need to verify your email again if you proceed in cancelling your registration! Are you sure you want to cancel your registration?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a class="btn btn-danger" href="login.php">Yes</a>
      </div>
    </div>
  </div>
</div>





      </div>

    </form>

</div>




				</div>
			</div>
		</div>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

    <script src="./vendors/jquery/dist/jquery.min.js"></script>
    <script src="./vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="./vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>

	</body>
</html>