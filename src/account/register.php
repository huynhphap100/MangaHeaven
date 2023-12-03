<div class="w3-display-container" style="width: 100%; height: 1200px; min-width: 700px; background-image: url('image/imgOrigin/wp2758170.gif'); background-size: cover;">

	<div id="form" class="w3-display-middle w3-row" style="width: 50%; height: 500px; opacity: 75%; background-color: rgb(37, 37, 37);">
		<div class="w3-col s12 m12 l4 w3-hide-small w3-hide-medium w3-display-container w3-blue" style="height: 100%;">
			<div class="w3-display-middle" style="width: 80%;">
				<h3 class="w3-monospace w3-center" style="width: 100%;">ĐĂNG KÝ</h3>
				<p class="w3-monospace w3-center" style="width: 100%;">Nếu bạn đã có tải khoản, hãy đăng nhập.</p>
				<a href="?action=login" class="w3-button w3-monospace w3-center w3-dark-gray" style="width: 100%;">Đăng nhập</a>
			</div>
		</div>
		<div class="w3-col s12 m12 l8 w3-display-container w3-red" style="height: 100%;">
			<div class="w3-display-middle" style="width: 80%;">
				<h3 class="w3-monospace" style="width: 100%;">ĐĂNG KÝ</h3>
				<form id="formHandle" method="post" action="src/account/handle/register.php">
					<table>
						<tr>
							<td>
								<p>Tài khoản</p>
								<input class="w3-input" style="width: 90%" type="text" name="account" placeholder="Tài khoản" value="<?php echo isset($_POST['account']) ? htmlspecialchars($_POST['account']) : ''; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<p>Tên hiển thị</p>
								<input class="w3-input" style="width: 90%" type="text" name="name" placeholder="Tên hiển thị" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" />
							</td>
							<td>
								<p>Mật khẩu</p>
								<input class="w3-input" style="width: 90%" type="password" name="password" placeholder="Mật khẩu" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<p>Email</p>
								<input class="w3-input" style="width: 90%" type="text" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
							</td>
							<td>
								<p>Nhập lại mật khẩu</p>
								<input class="w3-input" style="width: 90%" type="password" name="password2" placeholder="Mật khẩu" value="<?php echo isset($_POST['password2']) ? htmlspecialchars($_POST['password2']) : ''; ?>" />
							</td>
						</tr>
					</table>
					<button id="submit" class="w3-button w3-margin-top w3-monospace w3-center w3-dark-gray" style="width: 40%; min-width: 120px;" type="submit" name="submit" >ĐĂNG KÝ</button>
				</form>
			</div>		
		</div>
	</div>
</div>
<script>

SubmitForm("formHandle", "submit",
	function(response) {
        if(response.type == "success") window.location.href = "../WebDocTruyen"; 
        if(response.type == "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
	}
);

</script>