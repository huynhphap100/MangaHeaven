<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manga Heaven</title>
	<link rel="shortcut icon" href="image/imgOrigin/Logo.gif">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<style type="text/css">
	body {
		background-color: rgb(29, 42, 53);
		color: rgb(221, 221, 221);
	}
</style>
<body>
	<?php
		session_start();
		require("src/model/database.php");
		require("src/model/function.php");
		include("src/main.php");
	?>
</body>
</html>