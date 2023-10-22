<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$messageArray = array(
	    	"account" => "Chưa nhập tài khoản kìa",
	    	"password" => "Chưa nhập mật khẩu kìa"
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
		    $user = getUserByAccount($account);
		    if(!$user){
		    	$error = "Tài khoản không tồn tại.";
		    } else if($user['Password'] != md5($password)){
		    	$error = "Mật khẩu không chính xác.";
		    }
		    if(!isset($error) || $error == null){
		    	$_SESSION['user'] = $user;
		    	header("Location: ../WebDocTruyen");
		    }
		}
	}
?>
<div class="w3-display-container" style="width: 100%; height: 1200px; min-width: 500px; background-image: url('image/imgOrigin/wp2758170.gif'); background-size: cover;">
	<div id="form" class="w3-display-middle w3-row" style="width: 50%; height: 400px; opacity: 75%; background-color: rgb(37, 37, 37);">
		<div class="w3-col s12 m12 l4 w3-hide-small w3-hide-medium w3-display-container w3-blue" style="height: 100%;">
			<div class="w3-display-middle" style="width: 80%;">
				<h3 class="w3-monospace w3-center" style="width: 100%;">ĐĂNG NHẬP</h3>
				<p class="w3-monospace w3-center" style="width: 100%;">Nếu bạn chưa có tải khoản, hãy đăng ký.</p>
				<a href="?action=register" class="w3-button w3-monospace w3-center w3-dark-gray" style="width: 100%;">Đăng ký</a>
			</div>
		</div>
		<div class="w3-col s12 m12 l8 w3-display-container w3-red" style="height: 100%;">
			<div class="w3-display-middle" style="width: 80%;">
				<h3 class="w3-monospace" style="width: 100%;">ĐĂNG NHẬP</h3>
				
				<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=login#form">
					<p>Tài khoản</p>
					<input class="w3-input w3-animate-input" style="width: 60%" type="text" name="account" placeholder="Tài khoản" value="<?php echo isset($_POST['account']) ? htmlspecialchars($_POST['account']) : ''; ?>" />
					<p>Mật khẩu</p>
					<input class="w3-input w3-animate-input" style="width: 60%" type="password" name="password" placeholder="Mật khẩu" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" />
					<button class="w3-button w3-margin-top w3-monospace w3-center w3-dark-gray" style="width: 40%; min-width: 120px;">Đăng nhập</button>
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