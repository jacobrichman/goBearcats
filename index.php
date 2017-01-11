<?php
date_default_timezone_set("America/New_York");

$dir = 'pics';
$files = scandir($dir);

if(($key = array_search(".", $files)) !== false) {unset($files[$key]);}
if(($key = array_search("..", $files)) !== false) {unset($files[$key]);}

arsort($files);

?>
<!DOCTYPE html>
<html>
	<link href='http://fonts.googleapis.com/css?family=Kelly+Slab' rel='stylesheet' type='text/css'>
	<style>
		body {
				height: 100%;
				margin: 0;
				padding: 0;
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-color: #43BA91;
				font-family: 'Kelly Slab', cursive;
			}
		.imagediv {
			width: 18%;
			height: 200px;
			float: left;
			margin-right: 1%;
			margin-left: 1%;
			margin-top: 1%;
			margin-bottom: 1%;
			
			overflow: hidden;
			
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			
			background-repeat: no-repeat;
			background-position: center;
			
			cursor: pointer;
		}
		.imagediv:hover {
			opacity:0.7;
		}
		
		.overlaybackground {
			position: fixed;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background-color: rgba(0,0,0,0.5);
			z-index: 50;
			display: none;
		}
		
		.popupwindow {
			width: 800px;
			height: 500px;
			line-height: 200px;
			position: fixed;
			top: 50%;
			left: 50%;
			margin-top: -260px;
			margin-left: -400px;
			background-color: black;
			border-radius: 5px;
			text-align: center;
			color: white;
			font-size: 24px;
			z-index: 60;
			display: none;
		}
		
		#picdate { 
			font-size: 5vw;
			color: white;
		} 
		
		#title{
			font-size: 80px;
			color: white;
			margin-top: 30px;
		}
	</style>
	<title>#GoBearcats</title>
	<head>
		
	</head>
	<body>
		<p style="margin-top: 3px; margin-left: 3px;"><a style="color: white;" href="upload.php">Upload</a></p>
		<center><h2 id="title">#GoBearcats</h2></center>
		<!--Pop Up window-->
		<div class="overlaybackground" id="overlaybackground" onClick="hide()"></div>
		<div class="popupwindow" id="popupwindow">
			<img id="popupimage" style="max-width: 100%; max-height: 100%;" src="pics/1.png">
			<p id="datepopup" style="line-height: 200px; position: fixed; top: 72%; left: 50%; margin-left: -100px;">5/11/15 9:43 PM</p>
		</div>
		
		<!--Images-->
<?php
foreach ($files as &$value) {
	$date = substr($value, 0, -4);
	echo "<div onClick='show(".'"pics/'.$value.'"'.", ".'"'.date("n/j/y g:i A", $date).'"'.")' class='imagediv' style='background-image: url(".'"pics/'.$value.'"'.");'><p id='picdate'>".date("M j", $date)."</p></div>";
}

?>
	</body>
	
	<!--Pop Up Window Code-->
	<script>
		function hide() {
			document.getElementById("overlaybackground").style.display = 'none';
			document.getElementById("popupwindow").style.display = 'none';
		}
		function show(source, date) {
			document.getElementById("overlaybackground").style.display = 'block';
			document.getElementById("popupwindow").style.display = 'block';
			document.getElementById("popupimage").src = source;
			document.getElementById("datepopup").innerHTML = date;
		} 
	</script>
</html>
