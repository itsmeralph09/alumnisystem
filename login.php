<?php
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
  header('Location: index.php');
  exit;
}

if (isset($_SESSION['create_success'])) {
    $create_success = $_SESSION['create_success'];
    unset($_SESSION['create_success']);
}

if (isset($_SESSION['reg_email'])) {
	$email = 	$_SESSION['reg_email'];
}else{
	$email = "";
}


$password = "";

require './dbconfig/dbconn.php';

if (isset($_POST['submit'])) {
  
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM tbl_users WHERE email = '$email'";

  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result)>0) {

    $row = mysqli_fetch_assoc($result);

    $hashed_pass = $row['password'];

    
    if (password_verify($password, $hashed_pass)) {
			unset($_SESSION['reg_email']);

      $_SESSION['email'] = $row['email'];
      $_SESSION['name'] = ucfirst($row['fname'])." ".ucfirst($row['lname']);
      $_SESSION['usertype'] = $row['usertype'];


      if ($_SESSION['usertype'] != "admin") {
        header('Location: ./user/index.php');       
      } else{
        header('Location: ./admin/index.php');
      }
      exit;

    } else{
      $error = "Incorrect password!";
    }
    
  } else{
    $error = "Invalid email!";
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>PCB ALUMNI - LOGIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	    <link rel="stylesheet" href="./vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendors/font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="./vendors/custom1.css">
	<link rel="stylesheet" type="text/css" href="./vendors/custom.css">

	</head>
	<body>
		<div class="container mb-5">

			<div class="row justify-content-center">
				<div class="col-md-6 text-center my-5">
					<h2 class="heading-section rap2">Polytechnic College of Botolan Alumni System</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">

					<div class="login-wrap p-5 p-md-5">
    <?php if(isset($error)) { ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><?php echo $error; ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>       
      <?php } ?>

    <?php if(isset($create_success)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $create_success; ?></strong><span>You can now login your new account.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>       
      <?php } ?>



		      	<div class="d-flex">

		      		<div class="w-100">
		      			<h3 class="mb-3">Sign In Your Account</h3>
		      		</div>

		      	</div>
						<form action="login.php" class="login-form" method="post">
		      		<div class="form-group">
		      			<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
		      			<input type="text" name="email" class="form-control rap1 rounded-left" placeholder="Email" value="<?php echo $email ?>" required>
		      		</div>
	            <div class="form-group">
	            	<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
	              <input type="password" name="password" class="form-control rap1 rounded-left" placeholder="Password" required>
	            </div>
	            <div class="form-group d-flex align-items-center">
	            	<div class="w-100">
	            		<label class="checkbox-wrap checkbox mb-0">Save Password
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-100 d-flex justify-content-end">
		            	<button type="submit" class="btn rap rounded submit" name="submit" value="submit">Sign In</button>
	            	</div>
	            </div>
	            <div class="form-group mt-4">
								<div class="w-100 text-center">
									<p class="mb-1">Don't have an account? </p><a href="pre_reg.php">Sign Up</a>
									
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