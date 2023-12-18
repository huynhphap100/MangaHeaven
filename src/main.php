<?php

	$database = DATABASE::connect();
	$request = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : "null";
	$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;

	$categoryAll = getCategories();
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
			$id_manga = $_REQUEST['id'];
			$chap = $_REQUEST['chap'];
			$manga = getMangaById($id_manga);
			$userManga = getUserManga($id_manga);
			$chapters = getChaptersManga($id_manga);
			$chapter = getChapterByIdManga($chap, $id_manga);
			$chapterNext = getChapterNext($chap, $id_manga);
			$chapterBack = getChapterBack($chap, $id_manga);
			include "manga/readManga.php";
			break;
		default:
			$mangasTop = getMangasTop(3);
			if(isset($_GET['category'])){
				$mangas = getMangaByCategoryId($_GET['category']);
			} else if(isset($_GET['search'])){
				$mangas = getMangaBySearch($_GET['search']);
			} else {
				$mangas = getMangas();
			}
			include "home/popularManga.php";
			include "home/listManga.php";
			break;
	}
	include "footer.php";
?>
