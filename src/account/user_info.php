<style type="text/css">
	#divAvatar {
  width: 100%;
  max-height: 200px;
  overflow: hidden;
  position: relative;
}

#fileimage {
  width: 100%;
  height: auto;
  
}
</style>
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Thông tin tài khoản</p>
<form id="formHandle" method="post" action="src/account/handle/info.php" enctype="multipart/form-data">
	<table class="w3-table">
		<tr>
			<td style="width: 30%;">Ảnh đại diện</td>
			<td style="width: 20%; max-height: 200px;">
				<div id="divAvatar" class="w3-display-container" style="width: 100%; max-height: 200px;">
					<img style="width: 100%; max-height: 200px; background-size: cover; opacity: 0;" src="<?php echo $user["Avatar"]; ?>" alt="<?php echo $user["Account"]; ?>">
					<img id="fileimage" class="w3-display-middle w3-round-large" style="width: 100%; background-size: auto; display: block; margin: auto;" src="<?php echo $user["Avatar"]; ?>" alt="<?php echo $user["Account"]; ?>">
					<div id="textAvatar" class="w3-display-container w3-display-middle w3-gray" style="width: 100%; height:100%; opacity: 0;"><h3 class="w3-display-middle w3-padding w3-white w3-round-large">Chọn ảnh</h3></div>
					<input id="fileupload" class="w3-display-middle w3-button" style="width: 100%; height:100%; opacity: 0;" type="file" name="uploadAvatar">
				</div>
			</td>
		</tr>
		<tr>
			<td>ID tài khoản</td>
			<td class="w3-text-red"><b><?php echo $user["Id"]; ?></b></td>
		</tr>
		<tr>
			<td>Tên tài khoản</td>
			<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="text" name="name" placeholder="Tên hiển thị" value="<?php echo $user["Name"]; ?>"></td>
		</tr>
		<tr>
			<td>Nhóm tài khoản</td>
			<td><?php echo $user["Permission"]; ?></td>
		</tr>
		<tr>
			<td>Ngày tham gia</td>
			<td><?php echo $user["AccountDate"]; ?></td>
		</tr>
		<tr>
			<td></td>
			<td><button id="submit" class="w3-white" style="padding-left: 20px; padding-right: 20px">Sửa</button></td>
		</tr>
	</table>
</form>
<script>

const divAvatar = document.getElementById('divAvatar');
const textAvatar = document.getElementById('textAvatar');
divAvatar.addEventListener("mouseover", () => {
	textAvatar.style.opacity = 0.8;
});
divAvatar.addEventListener("mouseout", () => {
	textAvatar.style.opacity = 0;
});

const fileUpload = document.querySelector("#fileupload");
const fileImage = document.querySelector("#fileimage");
fileUpload.addEventListener("change", (event) => {
	const { files } = event.target;

	if (files.length > 0) {
		const reader = new FileReader();

		reader.onload = (e) => {
			fileImage.src = e.target.result;
		};

		// Read the selected file as a Data URL
		reader.readAsDataURL(files[0]);
	}
})

SubmitForm("formHandle", "submit",
	function(response) {
        if(response.type == "success") location.reload();
        if(response.type == "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
	}
);

</script>