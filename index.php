<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manga Heaven</title>
	<link rel="shortcut icon" href="image/imgOrigin/Logo.gif">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
	<link rel="stylesheet" href="src/textbox.css">
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
		$_SESSION['baseURL'] = $_SERVER['REQUEST_URI'];
		require("src/model/database.php");
		require("src/model/function.php");
		include("src/main.php");
	?>
</body>

<script src="js/editor.js"></script>
</html>
