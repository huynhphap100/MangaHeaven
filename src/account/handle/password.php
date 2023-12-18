<?php
	require("../../model/database.php");
	require("../../model/function.php");
	$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;
	if($user == null) {
		$resultJson = array("type" => "error", "message" => "Phải là người dùng mới có thể thay đổi.");
		echo json_encode($resultJson);
		exit();
	}

	$messageArray = array(
    	"oldpassword" => "Chưa nhập mật khẩu cũ kìa.",
    	"newpassword" => "Chưa nhập mật khẩu mới kìa.",
    	"newpassword2" => "Chưa nhập nhập lại mật khẩu mới kìa."
    );

    foreach ($messageArray as $key => $value) {
    	if (empty($_POST[$key])) {
			$error = $value;
			break;
		}
    }

    if(!isset($error) || $error == null){
	    $oldpassword = fixInput($_POST["oldpassword"]);
	    $newpassword = fixInput($_POST["newpassword"]);
	    $newpassword2 = fixInput($_POST["newpassword2"]);

	    if(strlen($oldpassword) < 10){
	    	$error = "Mật khẩu cũ không được nhỏ hơn 10 ký tự.";
	    } else if(strlen($newpassword) < 10){
	    	$error = "Mật khẩu mới không được nhỏ hơn 10 ký tự.";
	    } else if(strlen($newpassword2) < 10){
	    	$error = "Mật khẩu nhập lại không được nhỏ hơn 10 ký tự.";
	    } else if($user["Password"] != md5($oldpassword)){
	    	$error = "Mật khẩu cũ không chính xác.";
	    } else if ($newpassword != $newpassword2){
	    	$error = "Mật khẩu nhập lại không chính xác.";
	    }

	    if(!isset($error) || $error == null){
	    	$update = updatePasswordUser($user["Id"], $newpassword);
	    	if($update){
	    		$_SESSION['user'] = getUserByAccount($user["Account"]);
	    		$user = $_SESSION['user'];
	    		$success = "Cập nhật thành công!";
	    	} else {
	    		$error = "Cập nhật thất bại!";
	    	}
	    }
	}

	$type = null;
	$message = null;
	if(isset($success)){ $type = 'success'; $message = $success; }
	else if(isset($error)){ $type = 'error'; $message = $error; }

	$resultJson = array('type' => $type, 'message' => $message);
	echo json_encode($resultJson);
?>