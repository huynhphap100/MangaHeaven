<?php
	$manga = getMangaById($_REQUEST['id']);
	$dir_manga = "manga/".$manga["Name"]."/Chap".$_REQUEST['idchap'];
	deleteFolder($dir_manga);
	deleteChapter($_REQUEST['id'], $_REQUEST['idchap']);
	header("Location: ?action=user&group=manga");
?>