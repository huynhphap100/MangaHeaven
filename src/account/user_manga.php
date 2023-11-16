<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Truyện đã đăng</p>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=user&group=addmanga#form" enctype="multipart/form-data">
	<table class="w3-table">
	<?php $mangas = getMangaByUser($user["Id"]);
	foreach($mangas as $manga){ ?>
		<tr class="w3-border w3-border-white">
			<td style="width: 20%; height: 150px; overflow: hidden; position: relative; ">
				<a href="?action=manga&id=<?php echo $manga['Id']; ?>">
					<img style="width: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" src="<?php echo $manga['Image']; ?>">
				</a>
			</td>
			<td style="width: 30%;">
				<center>
					<a class="w3-green w3-btn" href="?action=user&group=editmanga&id=<?php echo $manga["Id"]; ?>">Sửa</a>
				</center>
				<div class="w3-container">
					<center><p><?php echo $manga['Name']; ?></p></center>
				</div>
			</td>
			<td style="width: 40%;">
				<center><a class="w3-green w3-btn" href="?action=user&group=addchapter&id=<?php echo $manga["Id"]; ?>">Thêm tập</a></center>
				<div class="w3-container">
					<?php $chapters = getChaptersManga($manga['Id']);
					foreach ($chapters as $chap){ ?>
						<div class="w3-cell-row">
							<a href="" class="w3-cell w3-btn w3-hover-opacity w3-left-align" style="width: 80%;"><?php echo "Tập ".$chap["Chap"].": ".$chap["Name"]; ?></a>
							<a href="" class="w3-cell w3-btn w3-hover-opacity" style="width: 20%;"><i class="bi bi-trash"></i></a>
						</div>
					<?php } ?>
				</div>
			</td>
			<td style="width: 10%;">
				<a class="w3-red w3-btn" href="?action=user&group=removemanga&id=<?php echo $manga["Id"]; ?>">Xoá</a>
			</td>
		</tr>
	<?php }	?>
	</table>
</form>