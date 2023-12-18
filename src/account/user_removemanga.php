<?php
	$manga = getMangaById($_REQUEST['id']);
	$dir_manga = "manga/".$manga["Name"];
	deleteFolder($dir_manga);
    deleteManga($_REQUEST['id']);
    if(isset($user) && $user['Id'] == $userManga['Id'])
	    header("Location: ?action=user&group=manga");
    else
        header("Location: ../WebDocTruyen");
?>