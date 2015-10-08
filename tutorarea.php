<?php include 'includes/head.php';
	function prePad($level){
		$ss = "";
		
		for ($ii = 0;  $ii < $level;  $ii++)
		{
			$ss = $ss . "|&nbsp;&nbsp;";
		}
		
		return $ss;
	}
	
	function myScanDir($dir, $level)
	{
		global $pathLen;
		
		if ($handle = opendir($dir)) {
			
			$allFiles = array();
			
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					if (is_dir('uploads'.$_GET['dir'] . $entry))
					{
						$allFiles[] = "D: " . $_GET['dir'] . $entry;
					}
					else
					{
						$allFiles[] = "F: " . $_GET['dir'] . $entry;
					}
				}
			}
			closedir($handle);
			
			natsort($allFiles);
			if ($_GET['dir'] !== "/"){
				echo "<i class=\"fa fa-level-up\"></i> <a href=\"tutorarea.php?dir=".substr($_GET['dir'], 0, strrpos( substr($_GET['dir'],0,-1), '/'))."/\">Up a level</a><br>";
			}
			foreach($allFiles as $value)
			{
				$current = $_GET['dir'];
				$displayName = substr($value, strlen($current) + 3);
				$fileName    = 'uploads'.substr($value, 3);
				$linkName    = str_replace(" ", "%20", substr($value, $pathLen + 3));
				if (is_dir($fileName)) {
					echo prePad($level) ."<i class=\"fa fa-folder\"></i> <a href=\"tutorarea.php?dir=".$linkName."/\">".$displayName."</a> <br>\n";
					} else {
					$file_parts = pathinfo($fileName);
					switch($file_parts['extension']){
						case "pdf":
						echo '<i class="fa fa-file-pdf-o"></i>';
						break;
						
						case "jpg":
						echo '<i class="fa fa-file-image-o"></i>';
						break;
						
						case "png":
						echo '<i class="fa fa-file-image-o"></i>';
						break;
						
						case "gif":
						echo '<i class="fa fa-file-image-o"></i>';
						break;
						
						case "svg":
						echo '<i class="fa fa-file-image-o"></i>';
						break;
						
						case "doc":
						echo '<i class="fa fa-file-word-o"></i>';
						break;
						
						case "docx":
						echo '<i class="fa fa-file-word-o"></i>';
						break;
						
						case "xls":
						echo '<i class="fa fa-file-excel-o"></i>';
						break;
						
						case "ppt":
						echo '<i class="fa fa-file-powerpoint-o"></i>';
						break;
						
					}
					echo prePad($level) . " <a href=\"download.php?filename=" . $linkName . "\" style=\"text-decoration:none;\">" . $displayName . "</a><br>\n";
				}
			}
		}
	}
	echo '<div class="content" style="text-align: left">';
	
	if (login_check($mysqli) !== false) {
		echo '<p>Welcome '.htmlentities($_SESSION['username']).' ('. login_check($mysqli).')</p>';
		$dir = "uploads".$_GET['dir'];
		$dir = realpath($dir);

		if (strpos($dir, "public_html\uploads") !== false || strpos($dir, "public_html/uploads") !== false ){
			if (login_check($mysqli) == "admin") {
				
				
				
				$dir2 = $_GET['dir'];
				echo '<form action="upload.php?dir='.$_GET['dir'].'" method="post" enctype="multipart/form-data">';
				echo '    upload a new file:';
				echo '    <input type="file" name="fileToUpload" id="fileToUpload">';
				echo '    <input type="submit" value="Upload File" name="submit">';
				echo '</form>';
				echo ' <br>';
				echo ' <form action="delete.php?dir='.$_GET['dir'].'" method="post" enctype="multipart/form-data">';
				echo '	Name of file/folder to delete:';
				echo '	<select name="fileToDelete" id="fileToDelete">';
				
				
				
				if ($handle = opendir($dir)){
					$allFiles = array();
					while (false !== ($entry = readdir($handle))) {
						if ($entry != "." && $entry != "..") {
							if (is_dir($dir . "/" . $entry))
							{
								$allFiles[] = "D: " .  "/" . $entry;
							}
							else
							{
								$allFiles[] = "F: " .  "/" . $entry;
							}
						}
					}
					closedir($handle);
					
					natsort($allFiles);
					
					foreach($allFiles as $value){
						$fileName    = substr($value, 3);
						$linkName    = str_replace(" ", "%20", $fileName);
						$fileName = substr($fileName, 1);
						$linkName = substr($linkName, 1);
						
						echo '<option value="' . $fileName . '">' . $fileName . '</option>';
						
					}
					
				}
				echo '	</select>';
				echo ' <input type="submit" value="Delete (Permanent)" name="submit">';
				
				echo ' Note folders can only be deleted if they are empty';
				echo '</form>';
				
				
				
				echo ' <form action="newfolder.php?dir='.$dir2.'" method="post" enctype="multipart/form-data">';
				echo '	Name of folder';
				echo ' <input type="text" id="foldername" name="foldername"/>';
				
				echo ' <input type="submit" value="Create Folder" name="submit">';
				echo '</form>';
				
				
				
			}
			
			myScanDir($dir, 0); 
		}else {
			echo 'Error: File path not valid';
		}
		
		
	}else{
		
		
		echo '<p>';
			echo '	<span class="error">You are not authorised to access this page.</span> Please <a href="login.php">login</a>.';
			echo '</p>';
	}
	
	echo '</div>';
	
	include 'includes/footer.php';
	
?>		