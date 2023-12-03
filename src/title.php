<style type="text/css">
	#userDropdown {
		animation: userDrop 0.3s ease;
	}

	@keyframes userDrop{
		from { transform: scale(0.9); opacity: 0; }
		to { transform: scale(1); opacity: 1; }
	}
</style>
<div class="w3-bar w3-border w3-padding w3-card w3-round-large" style="border:16px solid rgb(40, 42, 53);">
	<a class="w3-bar-item" style="width: 60px;" href="../WebDocTruyen"><img src="image/imgOrigin/Logo.gif" alt="Home" style="width: 100%;"></a>
	<a class="w3-bar-item w3-button w3-hover-opacity w3-hover-none w3-hover-text-white" href="#">Tìm kiếm nâng cao</a>
	<a class="w3-bar-item w3-button w3-hover-opacity w3-hover-none w3-hover-text-white" href="#">Thể loại</a>

	<div class="w3-right">
		<form class="w3-bar-item" method="get" onsubmit="submitSearch(event)">
            <input class="w3-round-large" style="width: 100%;" type="text" name="search" placeholder="Tìm kiếm..." value="" />
        </form>
		<?php 
			if($user != null){ ?>
				<div class="w3-bar-item w3-dropdown-hover" style="max-width: 90px;" href="?action=user">
					<a href="?action=user"><img class="w3-round" style="width: 100%; max-height: 35px;" src="<?php echo $user["Avatar"]; ?>" alt="<?php echo $user["Account"]; ?>"></a>
					<div id="userDropdown" class="w3-dropdown-content w3-bar-block w3-dark-gray w3-round-large" style="margin-left: -100px;">
						<a class="w3-bar-item w3-button w3-hover-opacity w3-hover-white w3-hover-text-dark-gray w3-round-large" href="?action=user">Trang cá nhân</a>
						<a class="w3-bar-item w3-button w3-hover-white w3-hover-text-red w3-round-large" href="?action=logout">Đăng xuất</a>
					</div>
				</div>
				<?php
			} else {
				?>
				<a class="w3-bar-item w3-button w3-hover-opacity w3-hover-none w3-hover-text-white" href="?action=login">Đăng nhập</a>
				<a class="w3-bar-item w3-button w3-hover-opacity w3-hover-none w3-hover-text-white" href="?action=register">Đăng ký</a>
				<?php
			}
		?>
	</div>

</div>