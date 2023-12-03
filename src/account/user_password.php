<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Quản lý mật khẩu</p>
<form id="formHandle" method="post" action="src/account/handle/password.php">
	<table class="w3-table">
		<tr>
			<td>Mật khẩu cũ</td>
			<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="password" name="oldpassword" placeholder="Mật khẩu cũ" value=""></td>
		</tr>
		<tr>
			<td>Mật khẩu mới</td>
			<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="password" name="newpassword" placeholder="Mật khẩu mới" value=""></td>
		</tr>
		<tr>
			<td>Nhập lại mật khẩu mới</td>
			<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="password" name="newpassword2" placeholder="Nhập lại mật khẩu mới" value=""></td>
		</tr>
		<tr>
			<td></td>
			<td><button id="submit">Xác nhận</button></td>
		</tr>
	</table>
</form>
<script>

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