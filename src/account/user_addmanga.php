<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
		    $description = (!empty($_POST["description"])) ? fixInput($_POST["description"]) : null;
		    $categories = (isset($_POST['categories'])) ? $_POST['categories'] : array();
		    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

		    if(getMangaByName($name)){
		    	$error = "Tên này đã tồn tại, hãy chọn tên khác.";
		    }

		    if(!isset($error) || $error == null){

		    	$dir_manga = "manga/".$name;
		    	if(!is_dir($dir_manga)) mkdir($dir_manga, 0777, true);

		    	$dir_image = null;
		    	if(!empty($_FILES['uploadImage']['name'])){
		    		$dir_image = $dir_manga."/".$_FILES['uploadImage']['name'];
		    		if(!move_uploaded_file($_FILES['uploadImage']['tmp_name'], $dir_image)){
		    			$error = "Cập nhật ảnh thất bại! ";
		    		}
		    	} else {
		    		$dir_image_origin = "image/imgOrigin/Logo.gif";
		    		$dir_image = $dir_manga."/default.jpg";
		    		if(!copy($dir_image_origin, $dir_image)){
		    			$error = "Cập nhật ảnh thất bại! ";
		    		}
		    	}

		    	$insert = addNewManga($name, $dir_image, $description, $status, $categories, $user["Id"]);
		    	if($insert){
		    		$message = "Thêm truyện thành công!";
		    	} else {
		    		$error .= "Thêm truyện thất bại!";
		    	}
		    }
		}
	}
?>
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Thêm truyện</p>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=user&group=addmanga#form" enctype="multipart/form-data">
	<table class="w3-table">
		<tr>
			<td style="width: 30%;">Tên truyện</td>
			<td style="width: 20%;"><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="text" name="name" placeholder="Tên truyện" value=""></td>
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
				<?php 
					$category = getCategories();
					foreach($category as $c){
				?>
				<div class="w3-quarter">
					<input type="checkbox" name="categories[]" value="<?php echo $c["Id"]; ?>" /><?php echo $c["Name"]; ?>
				</div>
				<?php } ?>
			</div></td>
		</tr>
		<tr>
			<td>Trạng thái</td>
			<td>
				<select name="status">
					<option value="1">Đang tiến hành</option>
					<option value="2">Đã hoàn thành</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Mô tả</td>
			<td><textarea id="editor" class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="text" name="description" placeholder="Mô tả"rows="4" cols="50" value=""></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><button class="w3-white" style="padding-left: 20px; padding-right: 20px">Tạo truyện</button></td>
		</tr>
	</table>
</form>