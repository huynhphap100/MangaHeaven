<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

	    $messageArray = array(
	    	"account" => "Chưa nhập tài khoản kìa",
	    	"password" => "Chưa nhập mật khẩu kìa",
	    	"password2" => "Chưa nhập mật khẩu nhập lại kìa",
	    	"email" => "Chưa nhập email kìa",
	    	"name" => "Chưa nhập tên kìa"
	    );

	    foreach ($messageArray as $key => $value) {
	    	if (empty($_POST[$key])) {
				$error = $value;
				break;
			}
	    }

	    if(!isset($error) || $error == null){

		    $account = fixInput($_POST["account"]);
		    $password = fixInput($_POST["password"]);
		    $password2 = fixInput($_POST["password2"]);
		    $email = fixInput($_POST["email"]);
		    $name = fixInput($_POST["name"]);

		    if(strlen($account) < 5){
		    	$error = "Tài khoản không được nhỏ hơn 5 ký tự.";
		    } else if(strlen($password) < 10){
		    	$error = "Mật khẩu không được nhỏ hơn 10 ký tự.";
		    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error = "Email không đúng dịnh dạng.";
		    } else if ($password != $password2){
		    	$error = "Mật khẩu nhập lại không chính xác.";
		    }

		    $userCheck = getUserByAccount($account);
		    if($userCheck){
		    	$error = "Tên tài khoản đã tồn tại, hãy chọn tên khác.";
		    }

			if(!isset($error) || $error == null){
			    $insert = insertUser($account, $password, $email, $name);
			    if($insert == true){
			    	$user = getUserByAccount($account);
			    	$_SESSION['user'] = $user;
			    	header("Location: ../WebDocTruyen");
			    } else {
			    	$error = "Lỗi chèn dữ liệu vào sql: ".$database->error.".";
			    }
			}
		}
	}
?>
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
				<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=register#form">
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
					<button class="w3-button w3-margin-top w3-monospace w3-center w3-dark-gray" style="width: 40%; min-width: 120px;" type="submit" name="submit" >ĐĂNG KÝ</button>
				</form>
			</div>		
		</div>
	</div>
	<?php 
		if (isset($error) && $error != null) {
			showErrorBox($error);
			$error = null;
		}
	?>
</div>