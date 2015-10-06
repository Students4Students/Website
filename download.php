<?php
	include_once '../private/db_connect.php';
	include_once '../private/functions.php';
	include_once '../private/register.inc.php';
	sec_session_start();
	if (login_check($mysqli) !== false) {
$file = "uploads".$_GET['filename'];
$dir = realpath($file);
			if (strpos($dir, "public_html\uploads") !== false){
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
			echo 'Error: Invalid directory';
			}
	}else{
	echo 'You are not authorised to do this. Please <a href="login.php">log in</a>';
	}
?>