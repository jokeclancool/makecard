<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php //echo json_encode($_SESSION["qrcodes"]); ?>
	<?php 
		echo "<div style='width:1024px;margin:0 auto;'><img src='".$_SESSION["qrcodes"]["image"]."'></div>";
	?>
</body>
</html>