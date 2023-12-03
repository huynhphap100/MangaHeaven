<head>
	<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Thêm truyện</p>
<form id="formHandle" method="post" action="src/account/handle/addmanga.php" enctype="multipart/form-data">
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
				<?php $category = getCategories();
				foreach($category as $c){ ?>
					<div class="w3-quarter">
						<div class="w3-cell">
							<input type="checkbox" name="categories[]" value="<?php echo $c["Id"]; ?>" />
						</div>
						<p id="labelCheck" class="w3-cell"><?php echo $c["Name"]; ?></p>
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
			<td><button id="submit" class="w3-white" style="padding-left: 20px; padding-right: 20px">Tạo truyện</button></td>
		</tr>
	</table>
</form>

<script>

CKEDITOR.replace('editor');
document.getElementById('submit').addEventListener('submit', function(event) {
    var editorContent = CKEDITOR.instances['editor'].getData();
    console.log("Editor Content: ", editorContent);
});

SubmitForm("formHandle", "submit",
	function(response) {
        if(response.type == "success"){
        	showBox(`<h3 class='w3-text-green'>Thành công</h3>`, `<p>${response.message}</p>`);
        	setInterval(() => location.reload(), 1000);
        } 
        if(response.type == "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
	}
);

</script>