<?php
session_start();

if (isset($_SESSION['prereg_error'])) {
    $error = $_SESSION['prereg_error'];
    unset($_SESSION['prereg_error']);
}

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require './vendor/autoload.php';
require './dbconfig/dbconn.php';
// Generate OTP
$otp = mt_rand(100000, 999999);


if (isset($_POST['submit'])){

$email = $_POST['email'];


$sql = "SELECT * from tbl_users where email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$_SESSION['prereg_error'] = "Email already registered!";
	header('Location: pre_reg.php');
	exit;
}else{


// Create a new PHPMailer instance
$mail = new PHPMailer;

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'ralphcustodio@pcb.edu.ph';
$mail->Password = '**********';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Email content
$mail->From = 'ralphcustodio@pcb.edu.ph';
$mail->FromName = 'PCB Alumni System';
$mail->addAddress($email);
$mail->Subject = 'OTP Verification';
$mail->Body = 'Your OTP is: ' . $otp;

// Send the email
if (!$mail->send()) {
    echo 'Error sending email: ' . $mail->ErrorInfo;
} else {
    // Store the generated OTP in the session
    session_start();
    $_SESSION['otp'] = $otp;
    $_SESSION['reg_email'] = $email;

    // Redirect to the OTP verification page
    $_SESSION['prereg_success'] = "Verification code was successfully sent to email.";
    header('Location: verify.php');
    exit;
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
		<div class="container mb-5 py-4" style="margin-top: 15vh;">

			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section rap2">Polytechnic College of Botolan Alumni System</h2>
				</div>
			</div>
			<div class="row justify-content-center">

				<div class="col-md-7 col-lg-5 card p-5 p-md-5">
		      		<h3 class="mb-4">Pre-Registration Verification</h3>
						<?php if(isset($error)) { ?>
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong><?php echo $error; ?></strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>       
						<?php } ?> 

        <form method="POST" action="pre_reg.php">
            <div class="form form-group">
                <label for="email">Please Enter Your Email address</label>
                <input type="email" class="form form-control" id="email" name="email" required>
                <small class="text-info font-italic">*You will receive an email containing the verification code!</small>
            </div>
            <button type="submit" name="submit" value="submit" class="btn rap">Send Code</button>

        </form>
              <a href="./login.php" class="my-2 text-decoration-none rap-text">Already have an account? Login.</a>

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
