<?php
require("../../model/database.php");
require("../../model/function.php");
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
    $name = fixInput($_POST["name"]);
    $nameOld = fixInput($_POST["nameOld"]);
    $pathImageOld = fixInput($_POST["pathImageOld"]);
    $description = (!empty($_POST["description"])) ? fixInput($_POST["description"]) : null;
    $categories = (isset($_POST['categories'])) ? $_POST['categories'] : array();
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

    if(!isset($error) || $error == null){

    	$dir_old = "../../../manga/".$nameOld;
    	$dir_manga = "../../../manga/".$name;
    	$dir_manga_sql = "manga/".$name;
    	if(is_dir($dir_old)) rename($dir_old, $dir_manga);
    	if(!is_dir($dir_manga)) mkdir($dir_manga, 0777, true);

    	$dir_image = null;
    	if(!empty($_FILES['uploadImage']['name'])){
    		if(file_exists($pathImageOld)) unlink($pathImageOld);
    		$dir_image = $dir_manga_sql."/".$_FILES['uploadImage']['name'];
    		if(!move_uploaded_file($_FILES['uploadImage']['tmp_name'], "../../../".$dir_image)){
    			$error = "Cập nhật ảnh thất bại! ";
    		}
    	} else {
   			$nameImageOld = explode("/", $pathImageOld);
    		$dir_image = $dir_manga_sql."/".end($nameImageOld);
    	}

    	$insert = updateManga($_POST['id'], $name, $dir_image, $description, $status, $categories, $user["Id"]);
    	if($insert){
    		$success = "Sửa truyện thành công!";
    	} else {
    		$error .= "Sửa truyện thất bại!";
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