<style type="text/css">

	.listmanga {
		width: 70%;
	}
    .manga {
        width: 25%;
    }

    @media (max-width: 800px) {
    	.listmanga {
			width: 100%;
		}
        .manga {
            width: 33%;
        }
    }

    @media (max-width: 500px) {
    	.listmanga {
			width: 100%;
		}
        .manga {
            width: 50%;
        }
    }

    @media (max-width: 300px) {
    	.listmanga {
			width: 100%;
		}
        .manga {
            width: 100%;
        }
    }
</style>
<div class="listmanga w3-margin w3-row-padding">
	<?php $mangas = getMangas();
	foreach ($mangas as $manga) { ?>
		<div class="manga w3-col w3-card">
			<div class="w3-hover-opacity" style="width: 95%; height: 300px; overflow: hidden; position: relative;">
				<a href="?action=manga&id=<?php echo $manga["Id"] ?>">
					<img style="width: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" src="<?php echo $manga["Image"] ?>" alt="<?php echo $manga["Name"] ?>">
				</a>
			</div>
			<center>
				<a href="?action=manga&id=<?php echo $manga["Id"] ?>" style="text-decoration: none;"><?php echo $manga["Name"] ?></a>
			</center>
		</div>
	<?php } ?>
	<center class="w3-col w3-margin" style="width: 100%;">
		<?php if(isset($_GET['page'])) {
			$page = $_GET['page'];
			$pageNext = $page+1;
			$pageBack = $page-1;
			if($page == 1) {
				echo "<a href=\"#listmanga\" class=\"w3-bar-item w3-button\">&laquo;</a>";
			} else {
				echo "<a href=\"?page=$pageNext#listmanga\" class=\"w3-bar-item w3-button\">&laquo;</a>";
			}
			for ($i=1; $i <= 4; $i++) {
				if($page == $i) {
					echo "<a href=\"?page=$i#listmanga\" class=\"w3-bar-item w3-red w3-button\">$i</a>";
				} else {
					echo "<a href=\"?page=$i#listmanga\" class=\"w3-bar-item w3-button\">$i</a>";
				}
			}
			if($page == 4) {
				echo "<a href=\"#listmanga\" class=\"w3-bar-item w3-button\">&raquo;</a>";
			} else {
				echo "<a href=\"?page=$pageBack#listmanga\" class=\"w3-bar-item w3-button\">&raquo;</a>";
			}
		} else { ?>
			<a href="#listmanga" class="w3-bar-item w3-button">&laquo;</a>
			<a href="?page=1#listmanga" class="w3-button">1</a>
			<a href="?page=2#listmanga" class="w3-button">2</a>
			<a href="?page=3#listmanga" class="w3-button">3</a>
			<a href="?page=4#listmanga" class="w3-button">4</a>
			<a href="#listmanga" class="w3-button">&raquo;</a>
		<?php } ?>
	</center>
</div>