<?php
session_start();

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);



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
if ($_SESSION['usertype'] != "admin") {
    header('Location: ../login.php');
    exit;
}

require '../dbconfig/dbconn.php';

$announcement_id = $_GET['announcement_id'];
$sql1 = "SELECT * FROM tbl_announcements WHERE announcement_id = '$announcement_id'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$content = $row1['content'];

$sql = "SELECT email FROM tbl_users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $mail = new PHPMailer;
    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ralphcustodio@pcb.edu.ph';
    $mail->Password = '**********';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->isHTML(true); 
    $mail->From = 'ralphcustodio@pcb.edu.ph';
    $mail->FromName = 'PCB Alumni System';
    $mail->Subject = 'Announcement - PCB Alumni System';
    $mail->Body = '<b><center>'.$content.'</center></b>';

    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];
        $mail->addAddress($email);
    }

    if (!$mail->send()) {
        $error = 'Failed to send email: ' . $mail->ErrorInfo;
        $_SESSION['error'] = $error;
    } else {
        $success= 'Announcement successfully emailed to all users!';
        $_SESSION['success'] = $success;
    }
} else {
    echo 'No email addresses found in the database!';
}

header('Location: announce.php');
exit;


?>
