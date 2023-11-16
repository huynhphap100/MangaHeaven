<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
		    $description = (!empty($_POST["description"])) ? fixInput($_POST["description"]) : null;
		    $categories = (isset($_POST['categories'])) ? $_POST['categories'] : array();
		    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

		    if (!is_numeric($chap)) {
		    	$error = "Hãy nhập chap là số.";
		    } else if(getChapterByIdManga($chap, $_REQUEST['id'])){
		    	$error = "Tập này đã tồn tại, hãy chọn tập khác.";
		    }

		    if(!isset($error) || $error == null){

		    	$uploadedFiles = $_FILES["uploadImages"];
		    	$dir_manga = "manga/".$manga['Name']."/Chap".$chap;
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
		    	
		    	if(!isset($error) || $error == null) {
			    	$insert = addChapterManga($_REQUEST['id'], $name, $chap);
			    	if($insert){
			    		$message = "Thêm tập thành công!";
			    	} else {
			    		$error .= "Thêm tập thất bại!";
			    	}
			    }
		    }
		}
	}
?>
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Thêm tập mới</p>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=user&group=addchapter&id=<?php echo $_REQUEST['id'] ?>#form" enctype="multipart/form-data">
	<table class="w3-table">
		<tr>
			<td style="width: 30%;">Tập: </td>
			<td style="width: 20%;"><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="number" name="chap" placeholder="Tập" value="<?php echo $missingChapter; ?>"></td>
		</tr>
		<tr>
			<td style="width: 30%;">Tên tập</td>
			<td style="width: 20%;"><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="text" name="name" placeholder="Tên tập" value=""></td>
		</tr>
		<tr>
			<td>Ảnh tập</td>
			<td><input type="file" name="uploadImages[]" multiple="multiple"></td>
		</tr>
		<tr>
			<td></td>
			<td><button class="w3-white" style="padding-left: 20px; padding-right: 20px">Đăng truyện</button></td>
		</tr>
	</table>
</form>