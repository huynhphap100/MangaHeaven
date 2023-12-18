<head>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Thêm truyện</p>
<form id="formHandle" method="post" action="src/account/handle/addmanga.php" enctype="multipart/form-data">
    <div style="display: grid; grid-template-columns: 20% 80%; row-gap: 20px;">

        <p style="margin: 0; align-self: center;">Tên truyện</p>
        <input class="w3-black w3-border-0 w3-border-left w3-border-bottom"
               style="width: 100%; align-self: center;" type="text" name="name" placeholder="Tên truyện" value="">

        <p style="margin: 0; align-self: center;">Ảnh truyện</p>
        <input style="align-self: center;" type="file" name="uploadImage">

        <p style="margin: 0; align-self: center;">Thể loại</p>
        <div class="w3-black w3-border-0 w3-border-left w3-border-bottom"
             style="overflow: auto; max-height: 100px; display: flex; flex-wrap: wrap;">
            <?php $category = getCategories();
            foreach ($category as $c) { ?>
                <div style="width: 120px; margin: 4px 8px; display: flex; align-items: center;">
                    <input class="w3-btn" type="checkbox" name="categories[]" value="<?php echo $c["Id"]; ?>"/>
                    <p id="labelCheck" class="w3-cell" style="margin: 0;"><?php echo $c["Name"]; ?></p>
                </div>
            <?php } ?>
        </div>

        <p style="margin: 0; align-self: center;">Trạng thái</p>
        <select style="align-self: center;" name="status">
            <option value="1">Đang tiến hành</option>
            <option value="2">Đã hoàn thành</option>
        </select>

        <p style="margin: 0; align-self: center;">Mô tả</p>
        <textarea style="align-self: center;" id="editor" class="w3-black w3-border-0 w3-border-left w3-border-bottom"
                  type="text"
                  name="description" placeholder="Mô tả" rows="4" cols="50" value=""></textarea>

        <button id="submit" class="w3-white w3-hover-white w3-hover-opacity w3-btn w3-round-large"
                style="width: 200px; grid-column: 2/3; align-items: center; justify-self: center;"
                onclick="changeEditor()">
            Tạo truyện
        </button>
    </div>
    <!--<table>
		<tr>
			<td>Tên truyện</td>
			<td><input class="w3-black w3-border-0 w3-border-left w3-border-bottom"
                       style="width: 100%;"
                       type="text" name="name" placeholder="Tên truyện" value=""></td>
		</tr>
		<tr>
			<td>Ảnh truyện</td>
			<td>
				<input type="file" name="uploadImage">
			</td>
		</tr>
		<tr>
			<td>Thể loại</td>
			<td><div class="w3-black w3-border-0 w3-border-left w3-border-bottom"
                     style="overflow: auto; height: 100px; display: grid; grid-template-columns: repeat(3, 1fr);">
				<?php /*$category = getCategories();
				foreach($category as $c){ */ ?>
					<div style="margin: 1px 8px; display: flex;">
                        <input type="checkbox" name="categories[]" value="<?php /*echo $c["Id"]; */ ?>" />
						<p id="labelCheck" class="w3-cell"><?php /*echo $c["Name"]; */ ?></p>
					</div>
				<?php /*} */ ?>
			</div></td>
		</tr>
		<tr>
			<td>Trạng thái</td>
			<td>
				<select name="status">
					<option value="1">Đang tiến hành</option>
					<option value="2">Đã hoàn thành</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Mô tả</td>
			<td><textarea id="editor" class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="text" name="description" placeholder="Mô tả"rows="4" cols="50" value=""></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td><button id="submit" class="w3-white" style="padding-left: 20px; padding-right: 20px">Tạo truyện</button></td>
		</tr>
	</table>-->
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
                setInterval(() => location.reload(), 1000);
            }
            if (response.type == "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
        }
    );

</script>