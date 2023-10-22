<head>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<style type="text/css">
	body {
		background-color: rgb(29, 42, 53);
		color: rgb(221, 221, 221);
	}
</style>
<div class="w3-border-bottom w3-panel w3-auto" style="width: 80%;">
	<div class="">
		<a class="w3-cell" style="padding-right: 8px; text-decoration: none;" href="index.php">Trang chủ</a>
		<p class="w3-cell"> / </p>
		<a class="w3-cell" style="padding-left: 8px; padding-right: 8px; text-decoration: none;" href="readManga.php?name=naruto">Naruto</a>
		<p class="w3-cell"> / </p>
		<a class="w3-cell" style="padding-left: 8px; padding-right: 8px; text-decoration: none;" href="readManga.php?name=naruto&chap=1">Chap 1</a>
	</div>
	<div>
		<p><a style="text-decoration: none;" href="readManga.php?name=naruto">Naruto </a>- Chapter 1 (Cập nhật lúc: 21:47 17/12/2022)</p>
	</div>
	<div class="">
		<p class="w3-center" >Nếu không xem được truyện vui lòng đổi "SERVER HÌNH" bên dưới</p>
		<div class="w3-center">
			<a class="w3-button w3-blue w3-hover-green w3-margin w3-card-2" href="#">Server 1</a>
			<a class="w3-button w3-blue w3-hover-green w3-margin w3-card-2" href="#">Server 2</a>
			<a class="w3-button w3-blue w3-hover-green w3-margin w3-card-2" href="#">Server 3</a>
			<a class="w3-button w3-blue w3-hover-green w3-margin w3-card-2" href="#">Server VIP</a>
		</div>
		<div class="w3-center">
			<div class="w3-bar">
			<a class="w3-button w3-yellow w3-hover-red w3-margin w3-card-2" href="#">Báo lỗi chương</a>
			</div>
		</div>
		<p class="w3-bar w3-light-blue w3-padding w3-center">Sử dụng mũi tên trái (←) hoặc phải (→) để chuyển chapter</p>
		<div class="w3-center">
				<a class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-disabled" href="#">Chap trước</a>
				<div class="w3-dropdown-hover">
					<p class="w3-button w3-white w3-hover-white w3-margin w3-card-2">Chọn chap</p>
					<div class="w3-dropdown-content w3-bar-block w3-border" style="margin-top: 55px; overflow: auto; max-height: 200px;">
					    <a href="#" class="w3-bar-item w3-button">Chap 1</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 2</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
					    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
					</div>
				</div>
				<a class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2" href="#">Chap sau</a>
		</div>
	</div>
</div>
<div class="w3-center">
	<?php 
		if(!isset($_GET['name']) || !isset($_GET['chap'])) {
			header("Location: ../index.php");
			exit();
		} else {
			$dir = '../manga/naruto/'.$_GET['chap'].'/';
			$files = glob($dir . '*.*');
			natsort($files); //Sap xep theo so thu tu
			foreach ($files as $file) {
			    echo '<img style="max-width: 80%;" src="' . $file . '" alt="'.basename($file).'" />' . PHP_EOL;
			}
		}
	?>
</div>

<div class="w3-center">
	<div class="w3-bar">
		<a class="w3-button w3-bar-item w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-disabled" href="#">Chap trước</a>
		<div class="w3-dropdown-hover">
			<p class="w3-button w3-bar-item w3-white w3-hover-white w3-margin w3-card-2">Chọn chap</p>
			<div class="w3-dropdown-content w3-bar-block w3-border" style="margin-top: -185px; overflow: auto; max-height: 200px;">
			    <a href="#" class="w3-bar-item w3-button">Chap 1</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 2</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
			    <a href="#" class="w3-bar-item w3-button">Chap 3</a>
			</div>
		</div>
		<a class="w3-button w3-bar-item w3-aqua w3-hover-aqua w3-margin w3-card-2" href="#">Chap sau</a>
	</div>
</div>
