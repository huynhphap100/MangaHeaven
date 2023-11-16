<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

		    	$dir_old = "manga/".$nameOld;
		    	$dir_manga = "manga/".$name;
		    	if(is_dir($dir_old)) rename($dir_old, $dir_manga);
		    	if(!is_dir($dir_manga)) mkdir($dir_manga, 0777, true);

		    	$dir_image = null;
		    	if(!empty($_FILES['uploadImage']['name'])){
		    		if(file_exists($pathImageOld)) unlink($pathImageOld);
		    		$dir_image = $dir_manga."/".$_FILES['uploadImage']['name'];
		    		if(!move_uploaded_file($_FILES['uploadImage']['tmp_name'], $dir_image)){
		    			$error = "Cập nhật ảnh thất bại! ";
		    		}
		    	} else {
		   			$nameImageOld = explode("/", $pathImageOld);
		    		$dir_image = $dir_manga."/".end($nameImageOld);
		    	}

		    	$insert = updateManga($_REQUEST['id'], $name, $dir_image, $description, $status, $categories, $user["Id"]);
		    	if($insert){
		    		$message = "Sửa truyện thành công!";
		    		header("Location: ?action=user&group=manga#form");
		    	} else {
		    		$error .= "Sửa truyện thất bại!";
		    	}
		    }
		}
	}
?>
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Sửa truyện</p>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=user&group=editmanga&id=<?php echo $manga['Id']; ?>#form" enctype="multipart/form-data">
	<input type="hidden" name="nameOld" value="<?php echo $manga['Name']; ?>">
	<input type="hidden" name="pathImageOld" value="<?php echo $manga['Image']; ?>">
	<table class="w3-table">
		<tr>
			<td style="width: 30%;">Tên truyện</td>
			<td style="width: 20%;">
				<input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="text" name="name" placeholder="Tên truyện" value="<?php echo $manga['Name']; ?>">
			</td>
		</tr>
		<tr>
			<td>Ảnh truyện</td>
			<td>
				<input type="file" name="uploadImage">
			</td>
		</tr>
		<tr>
			<td>Thể loại</td>
			<td><div class="w3-black w3-border-0 w3-border-left w3-border-bottom w3-row-padding" style="overflow: auto; height: 50px;">
				<?php $category = getCategories();
				foreach($category as $c){
					$check = 0;
					foreach($categories2 as $c2){
						if($c['Id'] == $c2['Id']){ ?>
							<div class="w3-quarter">
								<input type="checkbox" name="categories[]" value="<?php echo $c["Id"]; ?>" checked/><?php echo $c["Name"]; ?>
							</div>
						<?php $check = 1;
						break;
						}
					}
					if($check == 0){ ?>
						<div class="w3-quarter">
							<input type="checkbox" name="categories[]" value="<?php echo $c["Id"]; ?>" /><?php echo $c["Name"]; ?>
						</div>
					<?php }
				} ?>
			</div></td>
		</tr>
		<tr>
			<td>Trạng thái</td>
			<td>
				<select name="status">
					<?php if ($manga['Status'] == 1) { ?>
						<option value="1">Đang tiến hành</option>
						<option value="2">Đã hoàn thành</option>
					<?php } else { ?>
						<option value="2">Đã hoàn thành</option>
						<option value="1">Đang tiến hành</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Mô tả</td>
			<td><textarea id="editor" class="ck-content w3-border-0 w3-border-left w3-border-bottom" type="text" name="description" placeholder="Mô tả"rows="4" cols="50" style="background-color: black; color: white;"><?php echo $manga['Description']; ?></textarea></td>
		</tr>
		<tr>
			<td><a href="?action=user&group=manga" class="w3-white w3-button" style="padding-left: 20px; padding-right: 20px">Huỷ</a></td>
			<td><button class="w3-white w3-button" style="padding-left: 20px; padding-right: 20px">Xác nhận</button></td>
		</tr>
	</table>
</form>