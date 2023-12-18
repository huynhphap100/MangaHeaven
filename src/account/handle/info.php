<?php
	require("../../model/database.php");
	require("../../model/function.php");
	$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;
	if($user == null) {
		$resultJson = array("type" => "error", "message" => "Phải là người dùng mới có thể thay đổi.");
		echo json_encode($resultJson);
		exit();
	}

	$success = "";
	$error = "";
	if(!empty($_FILES['uploadAvatar']['name'])){
		$targer_file_old = $user["Avatar"];
		$target_file = "image/imgServer/account/".$user["Id"]."-".rand(1000000000,9999999999).".jpg";
		if(!getimagesize($_FILES["uploadAvatar"]["tmp_name"])){
			$error .= "Hong có nhận ra ảnh, lấy cái khác đi.";
		} else {
			if(file_exists("../../../".$targer_file_old)){
				unlink("../../../".$targer_file_old);
			}
			if(move_uploaded_file($_FILES["uploadAvatar"]["tmp_name"], "../../../".$target_file)){
				$update = updateAvatarUser($user["Id"], $target_file);
	    		$_SESSION['user'] = getUserByAccount($user["Account"]);
	    		$user = $_SESSION['user'];
				$success .= "Chỉnh ảnh thành công! ";
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
	    		$success .= "Sửa tên thành công! ";
	    	} else {
	    		$error .= "Cập nhật thất bại!";
	    	}
	    }
	}

	$type = null;
	$message = null;
	if(!empty($success)){ $type = 'success'; $message = $success; }
	else if(!empty($error)){ $type = 'error'; $message = $error; }

	$resultJson = array('type' => $type, 'message' => $message);
	echo json_encode($resultJson);
?>