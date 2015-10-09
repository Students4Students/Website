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
	// Set number of posts per page:
	$number = 3;
	
	$dir = "blog/posts/*";
	
	
	$pageno = 1;
	$postno = 1;
	$total = count(glob($dir));
	$totalpages = ceil($total / $number);
	
	foreach(array_reverse(glob("blog/*")) as $file){
		if (!is_dir($file) && strpos($file, "page") !== false && strpos($file, ".php") !== false){
			unlink($file);
		}
	}
	
	foreach(array_reverse(glob($dir)) as $file){
		if($postno % $number == 1){
			$index = fopen("blog/page".$pageno.".php", "w") or die("Unable to open file!");
			$start = "<?php include '../includes/head.php'?> \n<div class=\"content\"  id=\"blog\">\n<h1 class=\"pagetitle\">Blog</h1>\n";
			fwrite($index, $start);
			fclose($index);
			
		}
		$myfile = fopen($file."/post.txt", "w") or die("Unable to open file!");
		$date = substr($file, -21,-11);
		$date = date("l j F Y", strtotime($date));
		fwrite($myfile,'<div class="post">');
		$title = '<a href="/'.$file.'/post.php"> <h2 class="title">'.file_get_contents($file."/title.txt").'</h2></a>';
		fwrite($myfile, $title);
		
		$post = '<p class="date"><span class="aligner"></span>'.$date.'</p>';
		fwrite($myfile, $post);
		fwrite($myfile,'<div class="blogdivider"></div><br>');
		fwrite($myfile, str_replace("\n","<br>\n",file_get_contents($file."/body.txt")));
		
		fwrite($myfile,'</div>');
		fclose($myfile);
		
		
		$myfile = fopen($file."/post.php", "w") or die("Unable to open file!");
		$start = "<?php include '../../../includes/head.php'?> \n<div class=\"content\"  id=\"blog\">\n<h1 class=\"pagetitle\">Blog</h1>\n";
		fwrite($myfile, $start);
		
		
		fwrite($myfile, file_get_contents($file."/post.txt"));
		
		
		$end = "</div>\n<?php include '../../../includes/footer.php'?>\n";
		fwrite($myfile, $end);
		fclose($myfile);
		
		$index = fopen("blog/page".$pageno.".php", "a") or die("Unable to open file!");
		fwrite($index, file_get_contents($file."/post.txt"));
		fclose($index);
		if ($postno == $total){
			$index = fopen("blog/page".$pageno.".php", "a") or die("Unable to open file!");
			
			if($pageno == 1){
				fwrite($index,"<span class=\"button-grey-out\">&lt;</span>");
			}else{
				$prevpage = $pageno - 1;
				fwrite($index, "<a href=\"/blog/page". $prevpage .".php\" class=\"button\">&lt;</a>");
			}
			
			fwrite($index,'<h2 class="page-number"> Page: '.$pageno.' of '.$totalpages.'</h2>');
			$nextpage = $pageno + 1;
			fwrite($index, '<span class="button-grey-out">&gt;</span> ');
			
			$end = "</div>\n<?php include '../includes/footer.php'?>\n";
			fwrite($index, $end);
			fclose($index);
			$pageno = $pageno + 1;
		
		
		
		}else if ($postno % $number == 0){
			$index = fopen("blog/page".$pageno.".php", "a") or die("Unable to open file!");
			
			if($pageno == 1){
				fwrite($index,"<span class=\"button-grey-out\">&lt;</span>");
			}else{
				$prevpage = $pageno - 1;
				fwrite($index, "<a href=\"/blog/page". $prevpage .".php\" class=\"button\">&lt;</a>");
			}
			
			fwrite($index,'<h2 class="page-number"> Page: '.$pageno.' of '.$totalpages.'</h2>');
			$nextpage = $pageno + 1;
			fwrite($index, '<a href="/blog/page'. $nextpage .'.php" class="button">&gt;</a>');
			
			$end = "</div>\n<?php include '../includes/footer.php'?>\n";
			fwrite($index, $end);
			fclose($index);
			$pageno = $pageno + 1;
		}
		
		$postno = $postno + 1;

		
	}
	
	header('Location: /blog/page1.php');
	
	
?>
		<?php else : ?>
	<p>
		<span class="error">You are not authorised to access this page.</span> Please <a href="login.php">login</a>.
	</p>
	<?php endif; ?>
