<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
		    		$_SESSION['user'] = getUserByAccount($user["Account"]);
		    		$user = $_SESSION['user'];
		    		$message = "Cập nhật thành công!";
		    	} else {
		    		$error = "Cập nhật thất bại!";
		    	}
		    }
		}
	}
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