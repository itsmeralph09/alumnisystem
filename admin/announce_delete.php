<?php
	session_start();
	require '../dbconfig/dbconn.php';

	if(isset($_GET['announcement_id'])){
		$sql = "DELETE FROM tbl_announcements WHERE announcement_id = '".$_GET['announcement_id']."'";

		if(mysqli_query($conn, $sql)){
			$_SESSION['success'] = 'Announcement deleted successfully!';
		}

		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting announcement!';
		}
	}
	else{
		$_SESSION['error'] = 'Select announcement to delete first!';
	}

	header('location: announce.php');
?>