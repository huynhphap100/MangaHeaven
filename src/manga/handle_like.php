<?php
	session_start();
	include("../model/database.php");
	include("../model/function.php");
	likeManga($_POST['id'], $_SESSION['user']['Id']);
?>