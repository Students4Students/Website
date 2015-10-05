<?php
	include_once '../private/db_connect.php';
	include_once '../private/functions.php';
	include_once '../private/register.inc.php';
	sec_session_start();
	if (login_check($mysqli) == "admin") {
	$target_dir = "uploads/".$_GET['dir'];
	//$target_dir = "uploads/";
	$target_file = $target_dir . $_POST['fileToDelete'];
	//throw new Exception($target_file);
	if (is_dir($target_file)) {
		rmdir($target_file);
	}else{
		unlink($target_file);
	}
	header("Location: ../tutorarea.php?dir=".$_GET['dir']);
	}else{
	echo 'You are not authorised to do this. Please <a href="login.php">log in</a> to an admin account';
	}
?>