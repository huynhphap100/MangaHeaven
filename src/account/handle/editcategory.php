<?php
require("../../model/database.php");
require("../../model/function.php");
require("../../model/functionAdmin.php");
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;
if($user == null) {
	$resultJson = array("type" => "error", "message" => "Phải là người dùng mới có thể thay đổi.");
	echo json_encode($resultJson);
	exit();
}

$error = null;
$messageArray = array(
    "name" => "Chưa nhập tên truyện kìa.",
);

foreach ($messageArray as $key => $value) {
    if (empty($_POST[$key])) {
        $error = $value;
        break;
    }
}

if(!isset($error) || $error == null){
    $id = fixInput($_POST["id"]);
    $name = fixInput($_POST["name"]);

    $insert = updateCategory($id, $name);
    if($insert){
        $success = "Sửa thể loại thành công!";
    } else {
        $error .= "Sửa thể loại thất bại!";
    }
}

$type = null;
$message = null;
if(isset($success)){ $type = 'success'; $message = $success; }
else if(isset($error)){ $type = 'error'; $message = $error; }

$resultJson = array('type' => $type, 'message' => $message);
echo json_encode($resultJson);
?>