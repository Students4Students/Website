<?php 
	if($_SERVER['HTTP_HOST'] == "localhost"){
		
		$private = "C:/wamp2/www/private/";
		}else{
		
		$private = "/home/jstockwin/private/";
	}	
	
	include_once $private.'psl-config.php';
	include_once $private.'db_connect.php';
	include_once $private.'functions.php';
sec_session_start();?>

<?php if (login_check($mysqli) == "admin" || login_check($mysqli) == "blog") : ?>

<?php
	function rrmdir($dir) { 
		foreach(glob($dir . '/*') as $file) { 
			if(is_dir($file)) rrmdir($file); else unlink($file); 
		} rmdir($dir); 
	}
	
	if (!empty($_POST['title']) && !empty($_POST['body']) && !empty($_GET['blog']) && !empty($_GET['new'])){
		if($_GET['new'] = "true"){
			mkdir($_GET['blog']);
		}
		$dir = $_GET['blog'];
		$title = fopen($dir.'/title.txt', "w") or die("Unable to open file!");
		fwrite($title, $_POST['title']);
		fclose($title);
		
		$body = fopen($dir.'/body.txt', "w") or die("Unable to open file!");
		fwrite($body, $_POST['body']);
		fclose($body);
		
		header('Location: /generateBlogPosts.php');
		}else if(!empty($_GET['delete'])){
		if (login_check($mysqli) == "admin"){
			rrmdir($_GET['delete']);
			header('Location: /generateBlogPosts.php');
			}else{
			echo 'You are not authorised to do this. Please log in to an admin account.';
		}
		}else{
		
		echo 'Invalid request';
		
	}
	
	
?>

<?php else : ?>
<p>
	<span class="error">You are not authorised to access this page.</span> Please <a href="login.php">login</a>.
</p>
<?php endif; ?>

