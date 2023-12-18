<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manga Heaven</title>
    <link rel="shortcut icon" href="image/imgOrigin/Logo.gif">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/textbox.css">
    <link rel="stylesheet" href="css/index_main.css">
    <script src="js/submitForm.js"></script>
</head>
<body>
<div id="LoadingBackground" class="w3-opacity w3-black w3-display-container">
    <div id="Loading" class="w3-display-middle"></div>
</div>

<?php
ob_start();
$_SESSION['baseURL'] = $_SERVER['REQUEST_URI'];
require("src/model/database.php");
require("src/model/function.php");
require("src/model/functionAdmin.php");
include("src/main.php");
?>

</body>
<script src="js/index_main.js"></script>
</html>
