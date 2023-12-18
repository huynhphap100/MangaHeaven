<head>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Sửa truyện</p>
<form id="formHandle" method="post" action="src/account/handle/editmanga.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $manga['Id']; ?>">
    <input type="hidden" name="nameOld" value="<?php echo $manga['Name']; ?>">
    <input type="hidden" name="pathImageOld" value="<?php echo $manga['Image']; ?>">
    <div style="display: grid; grid-template-columns: 20% 80%; row-gap: 20px;">

        <p style="margin: 0; align-self: center;">Tên truyện</p>
        <input class="w3-black w3-border-0 w3-border-left w3-border-bottom"
               style="width: 100%; align-self: center;" type="text" name="name" placeholder="Tên truyện"
               value="<?php echo $manga['Name']; ?>">

        <p style="margin: 0; align-self: center;">Ảnh truyện</p>
        <input style="align-self: center;" type="file" name="uploadImage">

        <p style="margin: 0; align-self: center;">Thể loại</p>
        <div class="w3-black w3-border-0 w3-border-left w3-border-bottom"
             style="overflow: auto; max-height: 100px; display: flex; flex-wrap: wrap;">
            <?php $category = getCategories();
            $categoryManga = getCategoriesByIdManga($manga['Id']);
            $categoryManga = array_map(function ($item) {
                return $item['Id_category'];
            }, $categoryManga);
            foreach ($category as $c) { ?>
                <div style="width: 120px; margin: 4px 8px; display: flex; align-items: center;">
                    <input class="w3-btn" type="checkbox" name="categories[]" value="<?php echo $c["Id"]; ?>"
                        <?php echo (in_array($c['Id'], $categoryManga)) ? 'checked' : ''; ?>/>
                    <p id="labelCheck" class="w3-cell" style="margin: 0;"><?php echo $c["Name"]; ?></p>
                </div>
            <?php } ?>
        </div>

        <p style="margin: 0; align-self: center;">Trạng thái</p>
        <select style="align-self: center;" name="status">
            <option value="1" <?php echo ($manga['Status'] == 1) ? 'selected' : ''; ?>>Đang tiến hành</option>
            <option value="2" <?php echo ($manga['Status'] == 2) ? 'selected' : ''; ?>>Đã hoàn thành</option>
        </select>

        <label style="margin: 0; align-self: center;" for="editor">Mô tả</label>
        <textarea style="align-self: center;" id="editor" class="w3-black w3-border-0 w3-border-left w3-border-bottom"
                  name="description" placeholder="Mô tả" rows="4"
                  cols="50"><?php echo $manga['Description']; ?></textarea>

        <button id="submit" class="w3-white w3-hover-white w3-hover-opacity w3-btn w3-round-large"
                style="width: 200px; grid-column: 2/3; align-items: center; justify-self: center;"
                onclick="changeEditor()">
            Sửa truyện
        </button>
    </div>
</form>

<script>
    CKEDITOR.replace('editor');

    function changeEditor() {
        CKEDITOR.instances['editor'].updateElement();
        /*const editorContent = CKEDITOR.instances['editor'].getData();
        console.log("Editor Content: ", editorContent);*/
    }

    SubmitForm("formHandle", "submit",
        function (response) {
            if (response.type == "success") {
                showBox(`<h3 class='w3-text-green'>Thành công</h3>`, `<p>${response.message}</p>`);
                setTimeout(() => window.location.href = "?action=user&group=manga", 1000);
            }
            if (response.type == "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
        }
    );

</script>