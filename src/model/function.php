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

function showMessageBox($text){
	?>
	<a id="errorBox" href="#form" onclick="document.getElementById('errorBox').style.display = 'none';">
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

function insertUser($account, $password, $email, $name) {
	try{
		$sql = "INSERT INTO users (Account, Password, Email, Permission, Avata, Name, AccountDate) VALUES (:account, :password, :email, :member, :image, :name, :dat)";
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
?>