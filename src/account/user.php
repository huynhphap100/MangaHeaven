<div class="w3-display-container" style="width: 100%; height: 1200px; min-width: 600px; background-image: url('image/imgOrigin/wp2758170.gif'); background-size: cover;">
	<div id="form" class="w3-display-middle w3-row-padding w3-padding w3-black" style="width: 80%; opacity: 70%;">
		<div class="w3-quarter">
			<p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red" style="font-size: 20px; font-weight: bold;">Tài khoản</p>
			<div style="margin: 16px 0px;"><a style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;" href="?action=user&group=info#form">&#129456; Thông tin tài khoản</a></div>
			<div style="margin: 16px 0px;"><a style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;" href="?action=user&group=password#form">&#128477; Quản lý mật khẩu</a></div>
			<p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red" style="font-size: 20px; font-weight: bold;">Truyện tranh</p>
			<div style="margin: 16px 0px;"><a style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;" href="?action=user&group=manga#form">&#128218; Truyện đã đăng</a></div>
			<div style="margin: 16px 0px;"><a style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;" href="?action=user&group=addmanga#form">&#128393; Đăng truyện mới</a></div>
			<p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red" style="font-size: 20px; font-weight: bold;">Đăng xuất</p>
			<div style="margin: 16px 0px;"><a style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;" href="?action=logout">&#9940; Đăng xuất</a></div>
		</div>
		<div class="w3-threequarter">
			<?php
			$group = (isset($_REQUEST['group'])) ? $_REQUEST['group'] : "null";

			if(!isset($_SESSION['user'])){
				header("Location: ../WebDocTruyen");
			}

			switch($group){
				case "password":
					include "user_password.php";
					break;
				case "addmanga":
					include "user_addmanga.php";
					break;
				case "addchapter":
					if(!isset($_REQUEST['id'])){
						header("Location: ../WebDocTruyen?action=user");
						break;
					}
					$mangaByUser = getMangaByUser($user['Id']);
					$check = 0;
					foreach($mangaByUser as $manga){
						if($manga["Id_manga"] == $_REQUEST['id']){
							$check = 1;
						}
					}
					if($check == 0){
						header("Location: ../WebDocTruyen");
						break;
					}

					$missingChapter = getMissingChapterManga($_REQUEST['id']);
					$manga = getMangaById($_REQUEST['id']);

					include "user_addchapter.php";
					break;
				case "editmanga":
					if(!isset($_REQUEST['id'])){
						header("Location: ?action=user");
						break;
					}
					$mangaByUser = getMangaByUser($user['Id']);
					$check = 0;
					foreach($mangaByUser as $manga){
						if($manga["Id_manga"] == $_REQUEST['id']){
							$check = 1;
						}
					}
					if($check == 0){
						header("Location: ../WebDocTruyen");
						break;
					}
					
					$manga = getMangaById($_REQUEST['id']);
					$categories2 = getCategoriesByIdManga($_REQUEST['id']);
					include "user_editmanga.php";
					break;
				case "removemanga":
					if(!isset($_REQUEST['id'])){
						header("Location: ../WebDocTruyen");
						break;
					}
					$mangaByUser = getMangaByUser($user['Id']);
					$check = 0;
					foreach($mangaByUser as $manga){
						if($manga["Id_manga"] == $_REQUEST['id']){
							$check = 1;
						}
					}
					if($check == 0){
						header("Location: ../WebDocTruyen");
						break;
					}
					
					$manga = getMangaById($_REQUEST['id']);
					include "user_removemanga.php";
					break;
				case "manga":
					include "user_manga.php";
					break;
				default:
					include "user_info.php";
					break;
			}
			?>
		</div>
	</div>
	<?php 
		if (isset($error) && $error != null) {
			showErrorBox($error);
			$error = null;
		} else if (isset($message) && $message != null) {
			showMessageBox("user", $message);
			$message = null;
		}
	?>
</div>