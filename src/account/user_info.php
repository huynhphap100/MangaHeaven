<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$error = "";
		$message = "";
		if(!empty($_FILES['uploadAvatar']['name'])){
			$target_file = "image/imgServer/account/".$user["Id"].".jpg";
			if(!getimagesize($_FILES["uploadAvatar"]["tmp_name"])){
				$error .= "Hong có nhận ra ảnh, lấy cái khác đi.";
			} else {
				if(file_exists($target_file)){
					unlink($target_file);
				}
				if(move_uploaded_file($_FILES["uploadAvatar"]["tmp_name"], $target_file)){
					$update = updateAvatarUser($user["Id"], $target_file);
		    		$_SESSION['user'] = getUserByAccount($user["Account"]);
		    		$user = $_SESSION['user'];
					$message .= "Chỉnh ảnh thành công! ";
				} else {
					$error .= "Chuyển ảnh sang máy chủ gặp lỗi. ";
				}
			}
		}
		if (empty($_POST['name'])){
			$error .= "Chưa nhập tên kìa.";
		} else {
			$name = fixInput($_POST["name"]);
			if($name != $user["Name"]){
				$update = updateNameUser($user["Id"], $name);
		    	if($update){
		    		$_SESSION['user'] = getUserByAccount($user["Account"]);
		    		$user = $_SESSION['user'];
		    		$message .= "Sửa tên thành công! ";
		    	} else {
		    		$error .= "Cập nhật thất bại!";
		    	}
		    }
		}
	}
?>
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Thông tin tài khoản</p>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=user&group=info#form" enctype="multipart/form-data">
	<table class="w3-table">
		<tr>
			<td style="width: 30%;">Ảnh đại diện</td>
			<td style="width: 20%; max-height: 200px;">
				<img style="width: 100%; background-size: cover;" src="<?php echo $user["Avatar"]; ?>" alt="<?php echo $user["Account"]; ?>">
				<input type="file" name="uploadAvatar">
			</td>
		</tr>
		<tr>
			<td>ID tài khoản</td>
			<td class="w3-text-red"><b><?php echo $user["Id"]; ?></b></td>
		</tr>
		<tr>
			<td>Tên tài khoản</td>
			<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="text" name="name" placeholder="Tên hiển thị" value="<?php echo $user["Name"]; ?>"></td>
		</tr>
		<tr>
			<td>Nhóm tài khoản</td>
			<td><?php echo $user["Permission"]; ?></td>
		</tr>
		<tr>
			<td>Ngày tham gia</td>
			<td><?php echo $user["AccountDate"]; ?></td>
		</tr>
		<tr>
			<td></td>
			<td><button class="w3-white" style="padding-left: 20px; padding-right: 20px">Sửa</button></td>
		</tr>
	</table>
</form>