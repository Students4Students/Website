<?php
	include_once '../private/db_connect.php';
	include_once '../private/functions.php';
	include_once '../private/register.inc.php';
	sec_session_start();
	if (login_check($mysqli) == "admin") {
$file = "uploads".$_GET['filename'];
$file    = str_replace('../', '', $file);
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}else{
echo 'file '.$file.'not found';
}
	}else{
	echo 'You are not authorised to do this. Please <a href="login.php">log in</a>';
	}
?>