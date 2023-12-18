<div class="w3-border-bottom w3-panel w3-auto" style="width: 80%;">
    <div class="">
        <a class="w3-cell" style="padding-right: 8px; text-decoration: none;" href="index.php">Trang chủ</a>
        <p class="w3-cell"> / </p>
        <a class="w3-cell" style="padding-left: 8px; padding-right: 8px; text-decoration: none;"
           href="?action=readManga&id=<?php echo $manga["Id"]; ?>"><?php echo $manga["Name"]; ?></a>
        <p class="w3-cell"> / </p>
        <a class="w3-cell" style="padding-left: 8px; padding-right: 8px; text-decoration: none;"
           href="?action=readManga&id=<?php echo $manga["Id"]; ?>&chap=<?php echo $chapter["Chap"]; ?>">Tập <?php echo $chapter["Chap"]; ?>
            : <?php echo $chapter["Name"]; ?></a>
    </div>
    <div>
        <p><a style="text-decoration: none;"
              href="?action=readManga&id=<?php echo $manga["Id"]; ?>"><?php echo $manga["Name"]; ?> </a>-
            Tập <?php echo $chapter["Chap"]; ?>: <?php echo $chapter["Name"]; ?> (Cập nhật
            lúc: <?php echo date("d/m/Y H:i", strtotime($manga["DateUpdate"])); ?>)</p>
    </div>
    <div class="">
        <p class="w3-center">Nếu không xem được truyện vui lòng đổi "SERVER HÌNH" bên dưới</p>
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
        <p class="w3-bar w3-light-blue w3-padding w3-center">Sử dụng mũi tên trái (←) hoặc phải (→) để chuyển
            chapter</p>
        <center>
            <?php if ($chapterBack) { ?>
                <a class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-cell"
                   href="?action=readManga&id=<?php echo $manga['Id']; ?>&chap=<?php echo $chapterBack['Chap']; ?>">Chap
                    trước</a>
            <?php } else { ?>
                <p class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-disabled w3-cell">Chap
                    trước</p>
            <?php } ?>
            <div class="w3-cell">
                <!-- <p class="w3-button w3-white w3-hover-white w3-margin w3-card-2">Chọn tập</p> -->
                <select name="color" class="w3-button w3-hover-none w3-hover-text-gray w3-border w3-boder-white"
                        style="margin: 0 10px;" onchange="goToChapter(this, <?php echo $manga['Id'];?>)">
                    <?php foreach ($chapters as $chapter2) { ?>
                        <option value="<?php echo $chapter2["Chap"]; ?>" <?php echo ($chapter2['Chap'] == $chapter['Chap']) ? 'selected' : ''; ?>>
                            Tập <?php echo $chapter2["Chap"]; ?>: <?php echo $chapter2["Name"]; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <?php if ($chapterNext) { ?>
                <a class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-cell"
                   href="?action=readManga&id=<?php echo $manga['Id']; ?>&chap=<?php echo $chapterNext['Chap']; ?>">Chap
                    sau</a>
            <?php } else { ?>
                <p class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-disabled w3-cell">Chap
                    sau</p>
            <?php } ?>
        </center>
    </div>
</div>

<div id="chapterSelect" class="w3-center">
    <?php
    $dir = 'manga/' . $manga["Name"] . '/Chap' . $chapter['Chap'] . '/';
    $files = glob($dir . '*.*');
    natsort($files); //Sap xep theo so thu tu
    foreach ($files as $file) {
        echo '<img style="max-width: 80%;" src="' . $file . '" alt="' . basename($file) . '" />' . PHP_EOL;
    }
    ?>
</div>

<center>
    <?php if ($chapterBack) { ?>
        <a class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-cell"
           href="?action=readManga&id=<?php echo $manga['Id']; ?>&chap=<?php echo $chapterBack['Chap']; ?>">Chap
            trước</a>
    <?php } else { ?>
        <p class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-disabled w3-cell">Chap
            trước</p>
    <?php } ?>
    <div class="w3-cell">
        <!-- <p class="w3-button w3-white w3-hover-white w3-margin w3-card-2">Chọn tập</p> -->
        <select name="color" class="w3-button w3-hover-none w3-hover-text-gray w3-border w3-boder-white"
                style="margin: 0 10px;" onchange="goToChapter(this, <?php echo $manga['Id'];?>)">
            <?php foreach ($chapters as $chapter2) { ?>
                <option value="<?php echo $chapter2["Chap"]; ?>" <?php echo ($chapter2['Chap'] == $chapter['Chap']) ? 'selected' : ''; ?>>
                    Tập <?php echo $chapter2["Chap"]; ?>: <?php echo $chapter2["Name"]; ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <?php if ($chapterNext) { ?>
        <a class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-cell"
           href="?action=readManga&id=<?php echo $manga['Id']; ?>&chap=<?php echo $chapterNext['Chap']; ?>">Chap
            sau</a>
    <?php } else { ?>
        <p class="w3-button w3-aqua w3-hover-aqua w3-margin w3-card-2 w3-disabled w3-cell">Chap
            sau</p>
    <?php } ?>
</center>

<script>
    function goToChapter(selectElement, mangaId) {
        const selectedValue = selectElement.value;
        window.location.href = "?action=readManga&id="+mangaId+"&chap="+selectedValue;
    }

    document.addEventListener('keydown', function(event) {

        <?php if ($chapterBack) { ?>
            if (event.keyCode === 37) {
                window.location.href = "?action=readManga&id=<?php echo $manga["Id"]; ?>&chap=" + (parseInt(<?php echo $chapter["Chap"]; ?>) - 1);
            }
        <?php } ?>
        <?php if ($chapterNext) { ?>
            if (event.keyCode === 39) {
                window.location.href = "?action=readManga&id=<?php echo $manga["Id"]; ?>&chap=" + (parseInt(<?php echo $chapter["Chap"]; ?>) + 1);
            }
        <?php } ?>
    });
</script>
