<?php
session_start();

if (!isset($_SESSION['otp'])){
	header("location: pre_reg.php");
	exit;
}

if (isset($_SESSION['prereg_success'])) {
    $success = $_SESSION['prereg_success'];
    unset($_SESSION['prereg_success']);
}


if (isset($_SESSION['verify_error'])) {
    $error = $_SESSION['verify_error'];
    unset($_SESSION['verify_error']);
}

// Check if OTP is submitted
if (isset($_POST['submit'])) {
    $otp = $_POST['otp'];

    // Compare the submitted OTP with the stored OTP
    if ($otp == $_SESSION['otp']) {
        // OTP verification successful
        // Proceed sa registration page
       $_SESSION['ver_email'] = $_SESSION['reg_email']; 
    	// unset($_SESSION['reg_email']);
        // unset($_SESSION['otp']);
        $_SESSION['verify_success'] = "Verification successful! You can now proceed with the registration.";
        header("location: register.php");
        exit;
    } else {
        // Invalid OTP
        $_SESSION['verify_error'] = "Invalid verification code. Please try again.";
        header("location: verify.php");
        exit;
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
		<div class="container" style="margin-top: 15vh;">

			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section rap2">Polytechnic College of Botolan Alumni System</h2>
				</div>
			</div>
			<div class="row justify-content-center">

				<div class="col-md-7 col-lg-5 card p-5 p-md-5">


		      		<h3 class="mb-4">OTP Verification</h3>

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


        <form method="POST" action="verify.php">
            <div class="form-group">
                <label for="otp">Enter the verification code sent in your email address</label>
                <input type="number" min="111111" max="999999" class="form-control" id="otp" name="otp" required>
            </div>
            <button type="submit" name="submit" value="submit" class="btn rap">Verify</button>
            <a href="pre_reg.php" class="btn btn-outline-secondary">Change Email</a>
        </form>

               <a href="login.php" class="my-2 text-decoration-none rap-text">Already have an account? Login.</a>

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