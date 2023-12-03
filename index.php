<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manga Heaven</title>
	<link rel="shortcut icon" href="image/imgOrigin/Logo.gif">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="src/textbox.css">
	<script src="js/submitForm.js"></script>
</head>
<style type="text/css">
	body {
		background-color: rgb(29, 42, 53);
		color: rgb(221, 221, 221);
	}
	#LoadingBackground {
		position: fixed;
        top: 0;
        left: 0;
		width: 100%;
		height: 100%;
		z-index: 999;
	}
	#Loading {
		border: 8px solid transparent;
        border-top-color: #3498db; /* Màu của border, có thể thay đổi */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 0.5s linear infinite;
	}
	@keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
</style>
<body>
	<div id="LoadingBackground" class="w3-opacity w3-black w3-display-container" style="">
		<div id="Loading" class="w3-display-middle"></div>
	</div>
	<?php
		session_start();
		ob_start();
		$_SESSION['baseURL'] = $_SERVER['REQUEST_URI'];
		require("src/model/database.php");
		require("src/model/function.php");
		include("src/main.php");
	?>
</body>

<script type="text/javascript">
	 window.addEventListener('load', function() {
        document.getElementById('LoadingBackground').style.display = 'none';
    });

</script>
</html>
