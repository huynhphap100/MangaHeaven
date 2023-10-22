<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_REQUEST['group']) && $_REQUEST['group'] == "password"){
			$messageArray = array(
		    	"oldpassword" => "Chưa nhập mật khẩu cũ kìa.",
		    	"newpassword" => "Chưa nhập mật khẩu mới kìa.",
		    	"newpassword2" => "Chưa nhập nhập lại mật khẩu mới kìa."
		    );

		    foreach ($messageArray as $key => $value) {
		    	if (empty($_POST[$key])) {
					$error = $value;
					break;
				}
		    }

		    if(!isset($error) || $error == null){
			    $oldpassword = fixInput($_POST["oldpassword"]);
			    $newpassword = fixInput($_POST["newpassword"]);
			    $newpassword2 = fixInput($_POST["newpassword2"]);

			    if(strlen($oldpassword) < 10){
			    	$error = "Mật khẩu cũ không được nhỏ hơn 10 ký tự.";
			    } else if(strlen($newpassword) < 10){
			    	$error = "Mật khẩu mới không được nhỏ hơn 10 ký tự.";
			    } else if(strlen($newpassword2) < 10){
			    	$error = "Mật khẩu nhập lại không được nhỏ hơn 10 ký tự.";
			    } else if($user["Password"] != md5($oldpassword)){
			    	$error = "Mật khẩu cũ không chính xác.";
			    } else if ($newpassword != $newpassword2){
			    	$error = "Mật khẩu nhập lại không chính xác.";
			    }

			    if(!isset($error) || $error == null){
			    	$update = updatePasswordUser($user["Id"], $newpassword);
			    	if($update){
			    		$user['Password'] = md5($user["Password"]);
			    		$message = "Cập nhật thành công!";
			    	} else {
			    		$error = "Cập nhật thất bại!";
			    	}
			    }
			}
		} else if (isset($_REQUEST['group']) && $_REQUEST['group'] == "info"){
			if (empty($_POST['name'])){
				$error = "Chưa nhập tên kìa.";
			} else {
				$name = fixInput($_POST["name"]);
				if($_POST['name'] != $name){
					$update = updateNameUser($user["Id"], $name);
			    	if($update){
			    		$user['Name'] = $name;
			    		$message = "Cập nhật thành công!";
			    	} else {
			    		$error = "Cập nhật thất bại!";
			    	}
			    }
			}
		}
	}
?>
<div class="w3-display-container" style="width: 100%; height: 1200px; min-width: 500px; background-image: url('image/imgOrigin/wp2758170.gif'); background-size: cover;">
	<div id="form" class="w3-display-middle w3-row-padding w3-padding w3-black" style="width: 80%; opacity: 70%;">
		<div class="w3-quarter">
			<p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red" style="font-size: 20px; font-weight: bold;">Tài khoản</p>
			<a class="w3-container w3-button" style="margin: 8px 16px 8px 16px;" href="?action=user&group=info#form">Thông tin tài khoản</a>
			<a class="w3-container w3-button" style="margin: 8px 16px 8px 16px;" href="?action=user&group=password#form">Quản lý mật khẩu</a>
			<p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red" style="font-size: 20px; font-weight: bold;">Truyện tranh</p>
			<a class="w3-container w3-button" style="margin: 8px 16px 8px 16px;">Truyện đã đăng</a>
			<a class="w3-container w3-button" style="margin: 8px 16px 8px 16px;">Đăng thêm truyện</a>
			<p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red" style="font-size: 20px; font-weight: bold;">Đăng xuất</p>
			<a class="w3-container w3-button" style="margin: 8px 16px 8px 16px;" href="?action=logout">Đăng xuất</a>
		</div>
		<div class="w3-threequarter">
			<?php
			$group = (isset($_REQUEST['group'])) ? $_REQUEST['group'] : "null";
			switch ($group) {
				case 'password':
					?>
					<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Quản lý mật khẩu</p>
					<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=user&group=password#form">
						<table class="w3-table">
							<tr>
								<td>Mật khẩu cũ</td>
								<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="password" name="oldpassword" placeholder="Mật khẩu cũ" value="<?php echo isset($_POST['oldpassword']) ? htmlspecialchars($_POST['oldpassword']) : ''; ?>"></td>
							</tr>
							<tr>
								<td>Mật khẩu mới</td>
								<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="password" name="newpassword" placeholder="Mật khẩu mới" value="<?php echo isset($_POST['newpassword']) ? htmlspecialchars($_POST['newpassword']) : ''; ?>"></td>
							</tr>
							<tr>
								<td>Nhập lại mật khẩu mới</td>
								<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="password" name="newpassword2" placeholder="Nhập lại mật khẩu mới" value="<?php echo isset($_POST['newpassword2']) ? htmlspecialchars($_POST['newpassword2']) : ''; ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td><button>Xác nhận</button></td>
							</tr>
						</table>
					</form>
					<?php
					break;
				default:
					?>
					<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Thông tin tài khoản</p>
					<table class="w3-table">
						<tr>
							<td>ID tài khoản</td>
							<td class="w3-text-red"><b><?php echo $user["Id"]; ?></b></td>
						</tr>
						<tr>
							<td>Tên tài khoản</td>
								<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=user&group=info#form">
								<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="text" name="name" placeholder="Tên hiển thị" value="<?php echo $user["Name"]; ?>"></td>
								<td><button class="w3-yellow">Sửa</button></td>
								</form>
						</tr>
						<tr>
							<td>Nhóm tài khoản</td>
							<td><?php echo $user["Permission"]; ?></td>
						</tr>
						<tr>
							<td>Ngày tham gia</td>
							<td><?php echo $user["AccountDate"]; ?></td>
						</tr>
					</table>
					<?php
					break;
			} ?>
		</div>
	</div>
	<?php 
		if (isset($error) && $error != null) {
			showErrorBox($error);
			$error = null;
		} else if (isset($message) && $message != null) {
			showMessageBox($message);
			$message = null;
		}
	?>
</div>