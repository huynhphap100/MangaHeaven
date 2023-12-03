global$manga;
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Thêm tập mới</p>
<form id="formHandle" method="post" action="src/account/handle/addchapter.php" enctype="multipart/form-data">
	<input type="hidden" name="idManga" value="<?php echo $manga['Id']; ?>">
	<input type="hidden" name="nameManga" value="<?php echo $manga['Name']; ?>">
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
			<td><button id="submit" class="w3-white" style="padding-left: 20px; padding-right: 20px">Đăng truyện</button></td>
		</tr>
	</table>
</form>
<script>
SubmitForm("formHandle", "submit",
	function(response) {
        if(response.type === "success"){
        	showBox(`<h3 class='w3-text-green'>Thành công</h3>`, `<p>${response.message}</p>`);
        	setInterval(() => location.reload(), 1000);
        } 
        if(response.type === "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
	}
);

</script>