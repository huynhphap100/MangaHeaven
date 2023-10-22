<style type="text/css">
	.listmanga {
		width: 70%;
		padding-right: 5%;
	}

	.image-container {
        width: calc(25% - 3%);
        margin: 1%;
        display: inline-block;
        vertical-align: top;
        box-sizing: border-box;
    }
    
    .image-container img {
        width: 100%;
        height: auto;
    }
    
    @media (max-width: 1200px) {
    	.listmanga {
			width: 70%;
		}
        .image-container {
            width: calc(25% - 4%);
        }
    }

    @media (max-width: 800px) {
    	.listmanga {
			width: 100%;
		}
        .image-container {
            width: calc(33% - 4%);
        }
    }

    @media (max-width: 500px) {
    	.listmanga {
			width: 100%;
		}
        .image-container {
            width: calc(50% - 4%);
        }
    }

    @media (max-width: 300px) {
    	.listmanga {
			width: 100%;
		}
        .image-container {
            width: calc(100% - 4%);
        }
    }
</style>
<div id="listmanga" class="listmanga w3-margin">
	<div class="w3-center">
		<div class="w3-bar">
			<?php 
				for ($i=0; $i < 20 ; $i++) { 
			?>
				<div class="image-container">
					<a href="src/readManga.php?name=naruto&chap=chap1"><img src="manga/naruto/naruto.jpg" alt="name"></a>
					<div class="w3-center">
						<div class="w3-bar">
							<a href="src/readManga.php?name=naruto&chap=chap1" style="text-decoration: none;">Naruto</a>
						</div>
					</div>
				</div>
			<?php
				}
			?>
		</div>
	</div>
	<div class="w3-center">
		<div class="w3-bar">
			<?php 
				if(isset($_GET['page'])) {
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
				} else {
			?>
					<a href="#listmanga" class="w3-bar-item w3-button">&laquo;</a>
					<a href="?page=1#listmanga" class="w3-button">1</a>
					<a href="?page=2#listmanga" class="w3-button">2</a>
					<a href="?page=3#listmanga" class="w3-button">3</a>
					<a href="?page=4#listmanga" class="w3-button">4</a>
					<a href="#listmanga" class="w3-button">&raquo;</a>
			<?php
				}
			?>
		</div>
	</div>
</div>