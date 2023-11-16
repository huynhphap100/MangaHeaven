<?php
	$dir_manga = "manga/".$manga["Name"];
	deleteFolder($dir_manga);
	deleteManga($manga['Id']);
	header("Location: ?action=user&group=manga");
?>