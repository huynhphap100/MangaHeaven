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
		case "manga":
			if(!isset($_REQUEST['id'])){
				header("Location: ../WebDocTruyen");
				break;
			}
			updateViewManga($_REQUEST['id']);
			$manga = getMangaById($_REQUEST['id']);
			$chapters = getChaptersManga($_REQUEST['id']);
			$userManga = getUserManga($_REQUEST['id']);
			$categories = getCategoriesByIdManga($_REQUEST['id']);
			$amountLike = getLikeManga($_REQUEST['id']);
			$amountFollow = getFollowManga($_REQUEST['id']);
			include "manga/infoManga.php";
			break;
		case "readManga":
			if(!isset($_REQUEST['id'])){
				header("Location: ../WebDocTruyen");
				break;
			} else if(!isset($_REQUEST['chap'])){
				header("Location: ../WebDocTruyen");
				break;
			}
			$manga = getMangaById($_REQUEST['id']);
			$chapters = getChaptersManga($_REQUEST['id']);
			$chap = getChapterByIdManga($_REQUEST['chap'], $_REQUEST['id']);
			include "manga/readManga.php";
			break;
		default:
			include "home/popularManga.php";
			include "home/listManga.php";
			break;
	}
	include "footer.php";
?>
