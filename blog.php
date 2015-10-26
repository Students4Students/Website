<?php include 'includes/head.php'?>
<div class="content">
	<?php if (login_check($mysqli) == "admin" || login_check($mysqli) == "blog") : ?>
	
	
	<?php if(empty($_GET['blog'])){
		
		echo '<form action="blog.php" method="get">';
		
		echo 'Choose a blog post to edit:	<select name="blog">';
		echo '		<option value="new">Create new post</option>';
		
		$dir = "blog/posts/*";
		foreach(array_reverse(glob($dir)) as $file){
			echo '<option value="'.$file.'">'.file_get_contents($file."/title.txt").'</option>';
			
		}
		
		echo '	</select>';
		echo '	<input type="submit" value="Submit">';
		echo '</form>';
		echo '<br>';
		echo 'Once you\'ve made a change, click <a href="/generateBlogPosts.php">here</a> to update the blog';
		
		
		echo '<br><br><br><br>';
		
		if (login_check($mysqli) == "admin"){
			echo '<form action="blogupdate.php" method="get" onsubmit="return confirm(\'Are you sure you want to DELETE this post?\nThis cannot be undone. \');">';
			echo 'Choose a blog post to DELETE. THIS CANNOT BE UNDONE.<br>';
			echo '<select name="delete">';
			foreach(array_reverse(glob($dir)) as $file){
				echo '<option value="'.$file.'">'.file_get_contents($file."/title.txt").'</option>';
			
			}
			echo '</select>';
			echo '<input type="submit" value="DELETE THIS POST">';
			echo '</form>';
		}
		
		}else{
		
		if($_GET['blog'] == "new"){
			$dir = "blog/posts/".date('Y-m-d-U');
			echo '<form action="blogupdate.php?blog='.$dir.'&new=true" method="post">';
			echo 'Title: <input type="text" name="title" style="width: 60%"><br>';
			echo '<textarea rows="30" cols="100" name="body">';
			echo '</textarea><br>';
			echo '<input type="submit" value="Submit">';
			echo '</form>';
			echo '<br> To add images to this post, you will first need to create it as text only, then return to this page and edit the post. You will then be able to upload images';
			
			}else{
			$dir = $_GET['blog'];
			echo '<form action="blogupdate.php?blog='.$dir.'&new=false" method="post">';
			echo 'Title: <input type="text" name="title" style="width: 60%" value="'.file_get_contents($dir.'/title.txt').'"><br>';
			echo '<textarea rows="30" cols="100" name="body">';
			echo file_get_contents($dir.'/body.txt');
			echo '</textarea><br>';
			echo '<input type="submit" value="Submit">';
			echo '</form>';
					echo 'Images for this post:';
				echo '<form action="blogupload.php?dir='.$dir.'" method="post" enctype="multipart/form-data">';
				echo '    upload a new image:';
				echo '    <input type="file" name="fileToUpload" id="fileToUpload">';
				echo '    <input type="submit" value="Upload Image" name="submit">';
				echo '</form>';
				echo 'The images which you have uploaded are:<br><br>';
				$scandir = $dir.'/*';
			foreach(array_reverse(glob($scandir)) as $file){
				$name = basename($file);
				if ($name !== "title.txt" && $name !== "post.txt" && $name !== "post.php" && $name !== "body.txt"){
					echo $name.'<br>';
				}
			}
			foreach(array_reverse(glob($scandir)) as $file){
				$name = basename($file);
				if ($name !== "title.txt" && $name !== "post.txt" && $name !== "post.php" && $name !== "body.txt"){
					echo 'To include '.$name.' paste the following code into the box above:<br>';
					echo '<code>&lt;img src="/'.$file.'" style="max-width: 300px; max-height: 300px; float: initial"&gt;</code><br>';
				}
			}
			echo '<br>To make this images bigger/smaller, change the "300px" to be bigger/smaller. Note there are two to replace. You must leave in the "px" at the end.<br><br>';
			echo 'You can also change the "float". Currently, each image will be on a new line, with no text on that line. You could change this to "<code>float: left</code>" or "<code>float: right</code>" and the text will then wrap round the image.<br><br>';
			echo 'To construct a link, do <code>&lt;a href="www.example.com"&gt;this text is a link&lt;/a&gt;</code><br><br>';
			echo 'Any problems, please email <a href="mailto:admin@students4students.org.uk">admin@students4students.org.uk</a><br><br>';
		}
		

	}
	
	?>
	
	
	
	<?php else : ?>
	<p>
		<span class="error">You are not authorised to access this page.</span> Please <a href="login.php">login</a>.
		</p>
	<?php endif; ?>
	
</div>


<?php include 'includes/footer.php'?>