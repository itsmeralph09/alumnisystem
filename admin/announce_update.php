<?php
	session_start();
    require '../dbconfig/dbconn.php';

	if(isset($_POST['submit'])){
		
		$announcement_id = $_POST['announcement_id'];
		$content = htmlspecialchars($_POST['content']);


		$sql = "UPDATE tbl_announcements SET content = '$content' WHERE announcement_id = '$announcement_id'";
		$result = mysqli_query($conn, $sql);

		if($result){
			$_SESSION['success'] = 'Announcement updated successfully!';
		} else{
			$_SESSION['error'] = 'Failed to update announcement!';
		}

	}
	else{
		$_SESSION['error'] = 'Select announcement to edit first!';
	}

	header('location: announce.php');

?>