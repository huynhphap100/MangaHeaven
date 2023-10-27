<!-- <div class="w3-cell-row w3-border w3-padding w3-hide-medium w3-hide-large">
	<div class="w3-cell" style="width: 16%;">
		<a href="index.php"><img src="image/imgOrigin/Logo.gif" alt="Home" style="width: 100%;"></a>
	</div>

	<div class="w3-cell w3-center w3-bar-item w3-dropdown-hover" style="width: 8%;">
		<a href="#" class="w3-button">Menu</a>
		<div class="w3-dropdown-content w3-bar-block">
			<a class="w3-bar-item w3-button" href="index.php">Trang chủ</a>
			<a class="w3-bar-item w3-button" href="#listmanga">Truyện mới</a>
			<a class="w3-bar-item w3-button" href="#">Thể loại</a>
			<a class="w3-bar-item w3-button" href="#">Giới thiệu</a>
		</div>
	</div>
</div> -->

<div class="w3-bar w3-border w3-padding" style="border:16px solid rgb(40, 42, 53);">

	<a class="w3-bar-item" style="width: 60px;" href="../WebDocTruyen"><img src="image/imgOrigin/Logo.gif" alt="Home" style="width: 100%;"></a>
	<a class="w3-bar-item w3-button" href="#">Tìm kiếm nâng cao</a>
	<a class="w3-bar-item w3-button" href="#">Thể loại</a>

	<div class="w3-right">
		<form class="w3-bar-item" method="get" onsubmit="submitSearch(event)">
            <input class="w3-round-large" style="width: 100%;" type="text" name="search" placeholder="Tìm kiếm..." value="" />
        </form>
		<?php 
			if($user != null){ ?>
				<div class="w3-bar-item w3-dropdown-hover" style="max-width: 90px;" href="?action=user">
					<a href="?action=user"><img style="width: 100%; max-height: 35px;" src="<?php echo $user["Avatar"]; ?>" alt="<?php echo $user["Account"]; ?>"></a>
					<div class="w3-dropdown-content w3-bar-block w3-gray" style="margin-left: -100px;">
						<a class="w3-bar-item w3-button" href="?action=user">Trang cá nhân</a>
						<a class="w3-bar-item w3-button" href="?action=logout">Đăng xuất</a>
					</div>
				</div>
				<?php
			} else {
				?>
				<a class="w3-bar-item w3-button" href="?action=login">Đăng nhập</a>
				<a class="w3-bar-item w3-button" href="?action=register">Đăng ký</a>
				<?php
			}
		?>
	</div>

</div>