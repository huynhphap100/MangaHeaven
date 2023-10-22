<?php

	$database = DATABASE::connect();
	$request = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : "null";
	$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;

	include "title.php";
	switch ($request) {
		case "login":
			include "account/login.php";
			break;
		case "logout":
			include "account/logout.php";
			break;
		case "register":
			include "account/register.php";
			break;
		case "user":
			if($user == null){
				header("Location: ../WebDocTruyen");
				break;
			}
			$id = $user['Id'];
			include "account/user.php";
			break;
		default:
			include "home/popularManga.php";
			include "home/listManga.php";
			break;
	}
	include "footer.php";
?>
