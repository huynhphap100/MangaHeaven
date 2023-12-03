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
		<a class="w3-cell" style="padding-left: 8px; padding-right: 8px; text-decoration: none;" href="?action=readManga&id=<?php echo $manga["Id"]; ?>"><?php echo $manga["Name"]; ?></a>
		<p class="w3-cell"> / </p>
		<a class="w3-cell" style="padding-left: 8px; padding-right: 8px; text-decoration: none;" href="?action=readManga&id=<?php echo $manga["Id"]; ?>&chap=<?php echo $chap["Chap"]; ?>">Tập <?php echo $chap["Chap"]; ?>: <?php echo $chap["Name"]; ?></a>
	</div>
	<div>
		<p><a style="text-decoration: none;" href="?action=readManga&id=<?php echo $manga["Id"]; ?>"><?php echo $manga["Name"]; ?> </a>- Tập <?php echo $chap["Chap"]; ?>: <?php echo $chap["Name"]; ?> (Cập nhật lúc: <?php echo date("d/m/Y H:i", strtotime($manga["DateUpdate"])); ?>)</p>
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
		<center>
			<a class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-disabled w3-cell" href="#">Chap trước</a>
			<div class="w3-cell">
				<!-- <p class="w3-button w3-white w3-hover-white w3-margin w3-card-2">Chọn tập</p> -->
				<select name="color" class="w3-button w3-hover-none w3-hover-text-gray w3-border w3-boder-white" style="margin: 0px 10px 0px 10px;">
					<?php foreach($chapters as $chap2){ ?>
						<option value="<?php echo $chap2["Chap"]; ?>"><a href="?action=readManga&id=<?php echo $manga["Id"]; ?>&chap=<?php echo $chap2["Chap"]; ?>" class="w3-bar-item w3-button">Tập <?php echo $chap2["Chap"]; ?>: <?php echo $chap2["Name"]; ?></a></option>
					<?php } ?>
				</select>
				<!-- <div class="w3-dropdown-content w3-bar-block w3-border" style="overflow: auto; max-height: 200px;">
					<?php foreach($chapters as $chap2){ ?>
				    	
					<?php } ?>
				</div> -->
			</div>
			<a class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-cell" href="#">Chap sau</a>
		</center>
	</div>
</div>
<div class="w3-center">
	<?php 
		$dir = 'manga/'.$manga["Name"].'/Chap'.$chap['Chap'].'/';
		$files = glob($dir . '*.*');
		natsort($files); //Sap xep theo so thu tu
		foreach ($files as $file) {
		    echo '<img style="max-width: 80%;" src="' . $file . '" alt="'.basename($file).'" />' . PHP_EOL;
		}
	?>
</div>

<div class="w3-center">
	<div class="w3-bar">
		<a class="w3-button w3-bar-item w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-disabled" href="#">Chap trước</a>
		<div class="w3-dropdown-hover">
			<p class="w3-button w3-bar-item w3-white w3-hover-white w3-margin w3-card-2">Chọn chap</p>
			<div class="w3-dropdown-content w3-bar-block w3-border" style="overflow: auto; max-height: 200px;">
			    <?php foreach($chapters as $chap2){ ?>
			    	<a href="?action=readManga&id=<?php echo $manga["Id"]; ?>&chap=<?php echo $chap2["Chap"]; ?>" class="w3-bar-item w3-button">Tập <?php echo $chap2["Chap"]; ?>: <?php echo $chap2["Name"]; ?></a>
				<?php } ?>
			</div>
		</div>
		<a class="w3-button w3-bar-item w3-aqua w3-hover-aqua w3-margin w3-card-2" href="#">Chap sau</a>
	</div>
</div>
