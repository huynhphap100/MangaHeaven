<head>
	<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Sửa truyện</p>
<form id="formHandle" method="post" action="src/account/handle/editmanga.php" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $manga['Id']; ?>">
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
								<div class="w3-cell">
									<input type="checkbox" name="categories[]" value="<?php echo $c["Id"]; ?>" checked/>
								</div>
								<p class="w3-cell"><?php echo $c["Name"]; ?></p>
							</div>
						<?php $check = 1;
						break;
						}
					}
					if($check == 0){ ?>
						<div class="w3-quarter">
							<div class="w3-cell">
								<input type="checkbox" name="categories[]" value="<?php echo $c["Id"]; ?>" />
							</div>
							<p class="w3-cell"><?php echo $c["Name"]; ?></p>
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
			<td><textarea id="editor" onchange="changeEditor(event)" class="ck-content w3-border-0 w3-border-left w3-border-bottom" type="text" name="description" placeholder="Mô tả"rows="4" cols="50" style="background-color: black; color: white;"><?php echo $manga['Description']; ?></textarea></td>
		</tr>
		<tr>
			<td><a href="?action=user&group=manga" class="w3-white w3-button" style="padding-left: 20px; padding-right: 20px">Huỷ</a></td>
			<td><button id="submit" class="w3-white w3-button" style="padding-left: 20px; padding-right: 20px">Xác nhận</button></td>
		</tr>
	</table>
</form>

<script>

CKEDITOR.replace('editor');
function changeEditor(event) {
		CKEDITOR.instances['editor'].updateElement();
	    var editorContent = CKEDITOR.instances['editor'].getData();
	    console.log("Editor Content: ", editorContent);
}
SubmitForm("formHandle", "submit",
	function(response) {
        if(response.type == "success"){
        	showBox(`<h3 class='w3-text-green'>Thành công</h3>`, `<p>${response.message}</p>`);
        	setTimeout(() => window.location.href = "?action=user&group=manga", 1000);
        } 
        if(response.type == "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
	}
);

</script>