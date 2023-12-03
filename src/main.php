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
			$id = $_REQUEST['id'];
			updateViewManga($id);
			$manga = getMangaById($id);
			$chapters = getChaptersManga($id);
			$userManga = getUserManga($id);
			$categories = getCategoriesByIdManga($id);
			$amountLike = getLikeManga($id);
			$amountFollow = getFollowManga($id);
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
			$id = $_REQUEST['id'];
			$manga = getMangaById($id);
			$chapters = getChaptersManga($id);
			$chap = getChapterByIdManga($_REQUEST['chap'], $id);
			include "manga/readManga.php";
			break;
		default:
			include "home/popularManga.php";
			include "home/listManga.php";
			break;
	}
	include "footer.php";
?>
