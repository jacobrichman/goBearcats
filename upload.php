<?php

if(isset($_POST["submit"])) {
    if ($_FILES["image"]["size"] < 2000000) {
		$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
		$target_file = "pics/" . time(). ".".$ext;
		
		$saveit = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
		if ($saveit) {			
			echo "<script>alert('Upload Successful!');</script>";
		}
		else{
			echo "<script>alert('Error.');</script>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Kelly+Slab' rel='stylesheet' type='text/css'>
	</head>
	<body style="background-color: #43BA91; font-family: 'Kelly Slab', cursive; color: white; margin: 0; padding: 0;">
		<p style="margin-top: 3px; margin-left: 3px;"><a style="color: white;" href="./">Home</a></p>
		<form action="upload.php" method="post" enctype="multipart/form-data">
			<div style="position: fixed; top: 25%; width: 100%; font-size: 50px;">
				<center>
					Email Pictures to <a style="color: white;" href="mailto:lets@gobearcats.com">lets@gobearcats.com</a><br>
					or<br>
					Select image to upload:<br>
					<input type="file" name="image" id="fileToUpload">
					<input type="submit" value="Upload Image" name="submit">
				</center>
			</div>
		</form>
	</body>
</html>
