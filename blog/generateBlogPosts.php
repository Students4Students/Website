<?php
$dir = "posts/*";
$index = fopen("index.php", "w") or die("Unable to open file!");
$start = "<?php include '../includes/head.php'?> \n<div class=\"content\"  id=\"blog\">\n<h1 class=\"pagetitle\">Blog</h1>\n";
fwrite($index, $start);
fclose($index);

foreach(array_reverse(glob($dir)) as $file){
$myfile = fopen($file."/post.txt", "w") or die("Unable to open file!");
	$date = substr($file, -10);
	$date = date("l j F Y", strtotime($date));
	fwrite($myfile,'<div class="post">');
	$title = '<a href="/blog/'.$file.'/post.php"> <h2 class="title">'.file_get_contents($file."/title.txt").'</h2></a>';
	fwrite($myfile, $title);
	
	$post = '<p class="date"><span class="aligner"></span>'.$date.'</p>';
	fwrite($myfile, $post);
	fwrite($myfile,'<div class="blogdivider"></div>');
	fwrite($myfile, file_get_contents($file."/body.txt"));
	
	fwrite($myfile,'</div>');
	fclose($myfile);


$myfile = fopen($file."/post.php", "w") or die("Unable to open file!");
$start = "<?php include '../../../includes/head.php'?> \n<div class=\"content\"  id=\"blog\">\n<h1 class=\"pagetitle\">Blog</h1>\n";
fwrite($myfile, $start);


fwrite($myfile, file_get_contents($file."/post.txt"));


$end = "</div>\n<?php include '../../../includes/footer.php'?>\n";
fwrite($myfile, $end);
fclose($myfile);

$index = fopen("index.php", "a") or die("Unable to open file!");
fwrite($index, file_get_contents($file."/post.txt"));
fclose($index);

}

$index = fopen("index.php", "a") or die("Unable to open file!");
$end = "</div>\n<?php include '../includes/footer.php'?>\n";
fwrite($index, $end);
fclose($index);
?>