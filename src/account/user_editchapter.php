<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Sửa tập</p>
<?php if (!isset($manga) || !isset($chap)) exit(); ?>
<form id="formHandle" method="post" action="src/account/handle/editchapter.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $chap['Id']; ?>">
    <input type="hidden" name="idManga" value="<?php echo $manga['Id']; ?>">
    <input type="hidden" name="nameManga" value="<?php echo $manga['Name']; ?>">
    <input type="hidden" name="chapOld" value="<?php echo $chap['Chap']; ?>">
    <table class="w3-table">
        <tr>
            <td style="width: 30%;">Tập:</td>
            <td style="width: 20%;"><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="number"
                                           name="chap" placeholder="Tập" value="<?php echo $chap['Chap']; ?>"></td>
        </tr>
        <tr>
            <td style="width: 30%;">Tên tập</td>
            <td style="width: 20%;"><input class="w3-black w3-border-0 w3-border-left w3-border-bottom" type="text"
                                           name="name" placeholder="Tên tập" value="<?php echo $chap['Name']; ?>"></td>
        </tr>
        <tr>
            <td>Ảnh tập</td>
            <td><input type="file" name="uploadImages[]" multiple="multiple"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button id="submit" class="w3-white w3-hover-white w3-hover-opacity w3-btn w3-round-large"
                        style="padding-left: 20px; padding-right: 20px">Sửa tập
                </button>
            </td>
        </tr>
    </table>
</form>
<script>
    SubmitForm("formHandle", "submit",
        function (response) {
            if (response.type === "success") {
                showBox(`<h3 class='w3-text-green'>Thành công</h3>`, `<p>${response.message}</p>`);
                setInterval(() => window.location.href = "../WebDocTruyen?action=user&group=manga", 1000);
            }
            if (response.type === "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
        }
    );

</script>