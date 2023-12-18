<?php
require("../../model/database.php");
require("../../model/function.php");

$messageArray = array(
	"account" => "Chưa nhập tài khoản kìa",
	"password" => "Chưa nhập mật khẩu kìa"
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
    $user = getUserByAccount($account);
    $userIsLock = getUserIsLocked($account);

    if($userIsLock && $userIsLock['LockUser'] == 1) {
        $error = "Tài khoản đã bị khoá.";
    } else if(!$user){
    	$error = "Tài khoản không tồn tại.";
    } else if($user['Password'] != md5($password)){
    	$error = "Mật khẩu không chính xác.";
    }
    if(!isset($error) || $error == null){
    	$_SESSION['user'] = $user;
    }
}

$type = null;
$message = null;
if(isset($error)){ $type = 'error'; $message = $error;
	$resultJson = array('type' => $type, 'message' => $message);
	echo json_encode($resultJson);
} else {
	$resultJson = array('type' => 'success', 'message' => 'Đăng nhập thành công');
	echo json_encode($resultJson);
}
?>