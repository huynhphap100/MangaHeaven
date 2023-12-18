<?php
require("../../model/database.php");
require("../../model/function.php");

$messageArray = array(
	"account" => "Chưa nhập tài khoản kìa",
	"password" => "Chưa nhập mật khẩu kìa",
	"password2" => "Chưa nhập mật khẩu nhập lại kìa",
	"email" => "Chưa nhập email kìa",
	"name" => "Chưa nhập tên kìa"
);

foreach ($messageArray as $key => $value) {
	if (empty($_POST[$key])) {
		$error = $value;
		break;
	}
}

if(!isset($error) || $error == null){

    $account = fixInput($_POST["account"]);
    $password = fixInput($_POST["password"]);
    $password2 = fixInput($_POST["password2"]);
    $email = fixInput($_POST["email"]);
    $name = fixInput($_POST["name"]);

    if(strlen($account) < 5){
    	$error = "Tài khoản không được nhỏ hơn 5 ký tự.";
    } else if(strlen($password) < 10){
    	$error = "Mật khẩu không được nhỏ hơn 10 ký tự.";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = "Email không đúng định dạng.";
    } else if ($password != $password2){
    	$error = "Mật khẩu nhập lại không chính xác.";
    }

    $userCheck = getUserByAccount($account);
    if($userCheck){
    	$error = "Tên tài khoản đã tồn tại, hãy chọn tên khác.";
    }

	if(!isset($error) || $error == null){
	    $insert = insertUser($account, $password, $email, $name);
	    if($insert){
	    	$user = getUserByAccount($account);
	    	$_SESSION['user'] = $user;
	    } else {
	    	$error = "Lỗi chèn dữ liệu vào sql: ".$database->error.".";
	    }
	}
}

$type = null;
$message = null;
if(isset($error)){
    $type = 'error'; $message = $error;
	$resultJson = array('type' => $type, 'message' => $message);
} else {
	$resultJson = array('type' => 'success', 'message' => 'Đăng ký thành công');
}
echo json_encode($resultJson);
?>