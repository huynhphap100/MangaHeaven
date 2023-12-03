<?php 

function fixInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function showErrorBox($text){
	?>
	<a id="errorBox" href="#form" onclick="document.getElementById('errorBox').style.display = 'none';">
		<div class="w3-display-container w3-opacity w3-black" style="width: 100%; height: 100%;">
		</div>
		<div class="w3-display-middle w3-center" style="width: 30%;">
			<div class=" w3-animate-top w3-white w3-border-black w3-border w3-container">
				<h3 class="w3-text-red">Có lỗi xãy ra</h3>
				<p>Lỗi: <?php echo $text; ?></p>
			</div>
		</div>
	</a>
	<?php
}

function showMessageBox($link, $text){
	?>
	<a id="errorBox" href="#form" onclick="document.getElementById('errorBox').style.display = 'none'; window.location.href = '<?php echo $_SESSION['baseURL'] ?>?action=<?php echo $link; ?>#form';">
		<div class="w3-display-container w3-opacity w3-black" style="width: 100%; height: 100%;">
		</div>
		<div class="w3-display-middle w3-center" style="width: 30%;">
			<div class=" w3-animate-top w3-white w3-border-black w3-border w3-container">
				<p class="w3-yellow"><?php echo $text; ?></p>
			</div>
		</div>
	</a>
	<?php
}

function deleteFolder($folderPath) {
    if (is_dir($folderPath)) {
        $files = scandir($folderPath); // Lấy danh sách tất cả các tệp và thư mục trong thư mục
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;
                if (is_dir($filePath)) {
                    // Nếu là thư mục, gọi đệ quy để xoá thư mục con
                    deleteFolder($filePath);
                } else {
                    // Nếu là tệp, xoá tệp
                    unlink($filePath);
                }
            }
        }
        // Xoá thư mục sau khi xoá tất cả các tệp và thư mục con
        rmdir($folderPath);
    } 
}

function insertUser($account, $password, $email, $name) {
	try{
		$sql = "INSERT INTO users (Account, Password, Email, Permission, Avatar, Name, AccountDate) VALUES (:account, :password, :email, :member, :image, :name, :dat)";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":account", $account);
		$cmd->bindValue(":password", md5($password));
		$cmd->bindValue(":email", $email);
		$cmd->bindValue(":member", 'Member');
		$cmd->bindValue(":image", 'image/imgOrigin/Logo.gif');
		$cmd->bindValue(":name", $name);
		$cmd->bindValue(":dat", date('Y-m-d'));
		$result = $cmd->execute();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function updatePasswordUser($id, $password) {
	try{
		$sql = "UPDATE users SET Password = :password WHERE Id = :id";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":password", md5($password));
		$cmd->bindValue(":id", $id);
		$result = $cmd->execute();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function updateNameUser($id, $name) {
	try{
		$sql = "UPDATE users SET Name = :name WHERE Id = :id";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":name", $name);
		$cmd->bindValue(":id", $id);
		$result = $cmd->execute();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function updateAvatarUser($id, $avatar) {
	try{
		$sql = "UPDATE users SET Avatar = :avatar WHERE Id = :id";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":avatar", $avatar);
		$cmd->bindValue(":id", $id);
		$result = $cmd->execute();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function getUserByAccount($account){
	try{
		$sql = "SELECT * FROM users where account = :account";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":account",$account);
		$cmd->execute();
		$result = $cmd->fetch();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function getCategories(){
	try{
		$sql = "SELECT * FROM category";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->execute();
		$result = $cmd->fetchAll();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function getCategoriesByIdManga($id_manga){
	try{
		$sql = "SELECT * FROM category, manga_category WHERE Id_manga = :id_manga AND manga_category.Id_category = category.Id";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_manga",$id_manga);
		$cmd->execute();
		$result = $cmd->fetchAll();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function getMangas(){
	try{
		$sql = "SELECT * FROM manga";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->execute();
		$result = $cmd->fetchAll();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function getMangaById($id){
	try{
		$sql = "SELECT * FROM manga where Id = :id";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id",$id);
		$cmd->execute();
		$result = $cmd->fetch();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function getMangaByName($name){
	try{
		$sql = "SELECT * FROM manga where Name = :name";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":name",$name);
		$cmd->execute();
		$result = $cmd->fetch();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function getMangaByUser($id_user){
	try{
		$sql = "SELECT * FROM manga, user_manga where manga.Id = user_manga.Id_manga and user_manga.Id_user = :id_user";
		$database = DATABASE::connect();
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_user",$id_user);
		$cmd->execute();
		$result = $cmd->fetchAll();
		return $result;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function addNewManga($name, $image, $description, $status, $categories, $id_author){
	try{
		$database = DATABASE::connect();

		$sql = "INSERT INTO manga (Name, Image, Description, Status) VALUES (:name, :image, :description, :status)";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":name", $name);
		$cmd->bindValue(":image", $image);
		$cmd->bindValue(":description", $description);
		$cmd->bindValue(":status", $status);
		$row = $cmd->execute();

		$id_manga = $database->lastInsertId();
		
		foreach($categories as $id_category) {
			$sql = "INSERT INTO manga_category(Id_manga, Id_category) VALUES (:id_manga, :id_category)";
			$cmd = $database->prepare($sql);
			$cmd->bindValue(":id_manga", $id_manga);
			$cmd->bindValue(":id_category", $id_category);
			$cmd->execute();
		}

		$sql = "INSERT INTO user_manga(Id_user, Id_manga) VALUES (:id_author, :id_manga)";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_author", $id_author);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();

		return $row;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function updateManga($id_manga, $name, $image, $description, $status, $categories, $id_author){
	try{
		$database = DATABASE::connect();

		$sql = "UPDATE manga SET Name=:name, Image=:image, Description=:description, Status=:status where Id=:id";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":name", $name);
		$cmd->bindValue(":image", $image);
		$cmd->bindValue(":description", $description);
		$cmd->bindValue(":status", $status);
		$cmd->bindValue(":id", $id_manga);
		$row = $cmd->execute();

		$sql = "DELETE FROM manga_category WHERE Id_manga=:id_manga";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();
		
		foreach($categories as $id_category) {
			$sql = "INSERT INTO manga_category(Id_manga, Id_category) VALUES (:id_manga, :id_category)";
			$cmd = $database->prepare($sql);
			$cmd->bindValue(":id_manga", $id_manga);
			$cmd->bindValue(":id_category", $id_category);
			$cmd->execute();
		}

		$sql = "DELETE FROM user_manga WHERE Id_manga=:id_manga";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();

		$sql = "INSERT INTO user_manga(Id_user, Id_manga) VALUES (:id_author, :id_manga)";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_author", $id_author);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();

		return $row;
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function deleteManga($id_manga){
	try{
		$database = DATABASE::connect();

		$sql = "DELETE FROM user_manga WHERE Id_manga=:id_manga";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_manga", $id_manga);
		$row = $cmd->execute();

		$sql = "DELETE FROM user_manga_action WHERE Id_manga=:id_manga";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();

		$sql = "DELETE FROM manga_category WHERE Id_manga=:id_manga";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();

		$sql = "DELETE FROM manga where Id=:id";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id", $id_manga);
		$cmd->execute();
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function deleteChapter($id_manga, $chap){
	try{
		$database = DATABASE::connect();

		$sql = "DELETE FROM chapter WHERE Id_manga=:id_manga AND Chap=:chap";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->bindValue(":chap", $chap);
		return  $cmd->execute();
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function updateViewManga($id){
	try{
		$database = DATABASE::connect();

		$sql = "UPDATE manga SET View=View+1 WHERE Id = :id";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id", $id);
		$cmd->execute();
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function getUserMangaAction($id_user, $id_manga){
	$database = DATABASE::connect();

	$sql = "SELECT * FROM user_manga_action WHERE Id_user = :id_user AND Id_manga = :id_manga";
	$cmd = $database->prepare($sql);
	$cmd->bindValue(":id_user", $id_user);
	$cmd->bindValue(":id_manga", $id_manga);
	$cmd->execute();
	$result = $cmd->fetch();
	return $result;
}

function getUserManga($id_manga){
	$database = DATABASE::connect();

	$sql = "SELECT * FROM user_manga, users WHERE Id_user = Id AND Id_manga = :id_manga";
	$cmd = $database->prepare($sql);
	$cmd->bindValue(":id_manga", $id_manga);
	$cmd->execute();
	$result = $cmd->fetch();
	return $result;
}

function getLikeManga($id_manga){
	$database = DATABASE::connect();

	$sql = "SELECT count(`Like`) as Amount FROM user_manga_action WHERE Id_manga = :id_manga AND `Like`=1";
	$cmd = $database->prepare($sql);
	$cmd->bindValue(":id_manga", $id_manga);
	$cmd->execute();
	$result = $cmd->fetch();
	return $result['Amount'];
}

function getFollowManga($id_manga){
	$database = DATABASE::connect();

	$sql = "SELECT count(Follow) as Amount FROM user_manga_action WHERE Id_manga = :id_manga AND Follow=1";
	$cmd = $database->prepare($sql);
	$cmd->bindValue(":id_manga", $id_manga);
	$cmd->execute();
	$result = $cmd->fetch();
	return $result['Amount'];
}

function addChapterManga($id_manga, $name, $chap){
	$database = DATABASE::connect();

	$sql = "INSERT INTO chapter VALUES(:id_manga, :name, :chap)";
	$cmd = $database->prepare($sql);
	$cmd->bindValue(":id_manga", $id_manga);
	$cmd->bindValue(":name", $name);
	$cmd->bindValue(":chap", $chap);
	$result = $cmd->execute();
	return $result;
}

function getChaptersManga($id_manga){
	$database = DATABASE::connect();

	$sql = "SELECT * FROM chapter WHERE Id_manga = :id_manga ORDER BY Chap ASC";
	$cmd = $database->prepare($sql);
	$cmd->bindValue(":id_manga", $id_manga);
	$cmd->execute();
	$result = $cmd->fetchAll();
	return $result;
}

function getChapterByIdManga($chap, $id_manga){
	$database = DATABASE::connect();

	$sql = "SELECT * FROM chapter WHERE Id_manga = :id_manga AND Chap = :chap";
	$cmd = $database->prepare($sql);
	$cmd->bindValue(":id_manga", $id_manga);
	$cmd->bindValue(":chap", $chap);
	$cmd->execute();
	$result = $cmd->fetch();
	return $result;
}

function getMissingChapterManga($id_manga){
	$database = DATABASE::connect();
	$sql = "SELECT COALESCE(MIN(t1.chap) + 1, 1) AS missing_number
		FROM chapter t1
		LEFT JOIN chapter t2
		ON t1.chap + 1 = t2.chap AND t1.id_manga = t2.id_manga
		WHERE t1.id_manga = :id_manga
		AND (t2.chap IS NULL OR t2.id_manga IS NULL);";
	$cmd = $database->prepare($sql);
	$cmd->bindValue(":id_manga", $id_manga);
	$cmd->execute();
	$result = $cmd->fetch();
	return $result['missing_number'];
}

function likeManga($id_manga, $id_user){
	try{
		$database = DATABASE::connect();

		$sql = "SELECT * FROM user_manga_action WHERE Id_user = :id_user AND Id_manga = :id_manga";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_user", $id_user);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();
		$result = $cmd->fetch();

		if(!$result) {
			$sql = "INSERT user_manga_action(Id_user, Id_manga) VALUES (:id_user, :id_manga)";
			$cmd = $database->prepare($sql);
			$cmd->bindValue(":id_user", $id_user);
			$cmd->bindValue(":id_manga", $id_manga);
			$cmd->execute();
			$result = $cmd->fetch();
		}

		if($result && $result['Like']){
			$sql = "UPDATE user_manga_action SET `Like`=0 WHERE Id_user=:id_user AND Id_manga=:id_manga";
		} else {
			$sql = "UPDATE user_manga_action SET `Like`=1 WHERE Id_user=:id_user AND Id_manga=:id_manga";
		}
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_user", $id_user);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

function followManga($id_manga, $id_user){
	try{
		$database = DATABASE::connect();

		$sql = "SELECT * FROM user_manga_action WHERE Id_user = :id_user AND Id_manga = :id_manga";
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_user", $id_user);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();
		$result = $cmd->fetch();

		if(!$result) {
			$sql = "INSERT user_manga_action(Id_user, Id_manga) VALUES (:id_user, :id_manga)";
			$cmd = $database->prepare($sql);
			$cmd->bindValue(":id_user", $id_user);
			$cmd->bindValue(":id_manga", $id_manga);
			$cmd->execute();
			$result = $cmd->fetch();
		}

		if($result['Follow']){
			$sql = "UPDATE user_manga_action SET Follow=0 WHERE Id_user=:id_user AND Id_manga=:id_manga";
		} else {
			$sql = "UPDATE user_manga_action SET Follow=1 WHERE Id_user=:id_user AND Id_manga=:id_manga";
		}
		$cmd = $database->prepare($sql);
		$cmd->bindValue(":id_user", $id_user);
		$cmd->bindValue(":id_manga", $id_manga);
		$cmd->execute();
	} catch(PDOException $e){
		$error_message = $e->getMessage();
		echo "<p>Error query: $error_message</p>";
		exit();
	}
}

?>