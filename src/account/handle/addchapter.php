<?php
require("../../model/database.php");
require("../../model/function.php");
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;
if($user == null) {
	$resultJson = array("type" => "error", "message" => "Phải là người dùng mới có thể thay đổi.");
	echo json_encode($resultJson);
	exit();
}

$error = "";
$messageArray = array(
	"chap" => "Chưa nhập tập kìa.",
);

foreach ($messageArray as $key => $value) {
	if (empty($_POST[$key])) {
		$error = $value;
		break;
	}
}

if(!isset($error) || $error == null){
    $chap = fixInput($_POST["chap"]);
    $name = fixInput($_POST["name"]);

    if (!is_numeric($chap)) {
    	$error = "Hãy nhập tập là số.";
    } else if ($chap <= 0) {
        $error = "Hãy nhập tập lớn hơn 0.";
    } else if(getChapterByIdManga($chap, $_POST['idManga'])){
    	$error = "Tập này đã tồn tại, hãy chọn tập khác.";
    }

    if(!isset($error) || $error == null){

    	$uploadedFiles = $_FILES["uploadImages"];
        if(!empty($uploadedFiles['name'][0])){
            $dir_manga = "../../../manga/".$_POST['nameManga']."/Chap".$chap;
            if(!is_dir($dir_manga)) mkdir($dir_manga, 0777, true);

            $dir_image = null;
            $i = 0;
            foreach ($uploadedFiles["name"] as $key => $filename) {
                $i++;
                $dir_image = $dir_manga."/".$i.".png";
                if(!move_uploaded_file($uploadedFiles["tmp_name"][$key], $dir_image)){
                    $error = "Cập nhật ảnh thất bại ở ảnh".basename($filename)."! ";
                    deleteFolder($dir_manga);
                    break;
                }
            }
        }
    	
    	if(!isset($error) || $error == null) {
	    	$insert = addChapterManga($_POST['idManga'], $name, $chap);
	    	if($insert){
	    		$success = "Thêm tập thành công!";
	    	} else {
	    		$error .= "Thêm tập thất bại!";
	    	}
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