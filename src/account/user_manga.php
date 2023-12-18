<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Truyện đã đăng</p>
<style>
    #scrollManga::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    #scrollManga::-webkit-scrollbar {
        width: 12px;
        background-color: #F5F5F5;
    }

    #scrollManga::-webkit-scrollbar-thumb {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #555;
    }

    #scrollChaps::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    #scrollChaps::-webkit-scrollbar {
        width: 10px;
        background-color: #F5F5F5;
    }

    #scrollChaps::-webkit-scrollbar-thumb {
        background-color: #0ae;
        border-radius: 10px;
        background-image: -webkit-gradient(linear, 0 0, 0 100%,
        color-stop(.5, rgba(255, 255, 255, .2)),
        color-stop(.5, transparent), to(transparent));
    }
</style>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?action=user&group=addmanga#form"
      enctype="multipart/form-data">
    <div id="scrollManga" style="overflow: auto; max-height: 600px">
        <table class="w3-table">
            <?php
            if(!isset($user)) exit();
            $mangas = getMangaByUser($user["Id"]);
            foreach ($mangas as $manga) { ?>
                <tr class="w3-border w3-border-white">
                    <td style="width: 20%; height: 150px; min-width: 100px; overflow: hidden; position: relative; ">
                        <a href="?action=manga&id=<?php echo $manga['Id']; ?>">
                            <img style="width: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"
                                 src="<?php echo $manga['Image']; ?>" alt="<?php echo $manga['Image']; ?>">
                        </a>
                    </td>
                    <td style="width: 30%;">
                        <div style="text-align: center;">
                            <a class="w3-green w3-btn w3-hover-opacity w3-round-large"
                               href="?action=user&group=editmanga&id=<?php echo $manga["Id"]; ?>">Sửa</a>
                        </div>
                        <div class="w3-container">
                            <div style="text-align: center;"><p><?php echo $manga['Name']; ?></p></div>
                        </div>
                    </td>
                    <td style="width: 40%;">
                        <div style="text-align: center;">
                            <a class="w3-green w3-btn w3-hover-opacity w3-round-large"
                               href="?action=user&group=addchapter&id=<?php echo $manga["Id"]; ?>">Thêm tập</a>
                        </div>
                        <div class="w3-container" id="scrollChaps" style="overflow: auto; max-height: 100px">
                            <?php $chapters = getChaptersManga($manga['Id']);
                            foreach ($chapters as $chap) { ?>
                                <div class="w3-cell-row">
                                    <a href="?action=user&group=editchapter&id=<?php echo $chap['Id_manga']; ?>&idchap=<?php echo $chap['Chap']; ?>"
                                       class="w3-cell w3-btn w3-hover-opacity w3-left-align"
                                       style="width: 80%;"><?php echo "Tập " . $chap["Chap"] . ": " . $chap["Name"]; ?></a>
                                    <a href="?action=user&group=removechapter&id=<?php echo $manga['Id']; ?>&idchap=<?php echo $chap['Chap']; ?>"
                                       class="w3-cell w3-btn w3-hover-opacity" style="width: 20%;"><i
                                                class="bi bi-trash"></i></a>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <td style="width: 10%;">
                        <a class="w3-red w3-btn w3-hover-opacity w3-round-large"
                           href="?action=user&group=removemanga&id=<?php echo $manga["Id"]; ?>">Xoá</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</form>