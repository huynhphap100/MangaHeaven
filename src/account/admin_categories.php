<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Quản lý thể loại</p>
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
<div id="scrollManga" style="overflow: auto; max-height: 600px">
    <table class="w3-table">
        <?php
        foreach ($categoryAll as $c) { ?>
            <tr class="w3-border w3-border-white">
                <td style="width: 30%;">
                    <div class="w3-container">
                        <?php if(isset($_GET['group']) && isset($_GET['id'])
                            && $_GET['group'] == "editcategory"
                            && $_GET['id'] == $c['Id']){ ?>
                            <div style="text-align: center;">
                                <form id="formHandle" action="src/account/handle/editcategory.php" method="post">
                                    <label style="display: flex;">
                                        <input type="hidden" name="id" value="<?php echo $c['Id']?>">
                                        <input type="text" name="name" value="<?php echo $c['Name']; ?>">
                                        <button id="submit" class="w3-green w3-btn" type="submit">Xác nhận</button>
                                    </label>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div style="text-align: center;"><p><?php echo $c['Name']; ?></p></div>
                        <?php } ?>
                    </div>
                </td>
                <td style="width: 30%;">
                    <div style="text-align: center;">
                        <a class="w3-green w3-btn w3-hover-opacity w3-round-large"
                           href="?action=user&group=editcategory&id=<?php echo $c["Id"]; ?>#form">Sửa</a>
                    </div>
                </td>
                <td style="width: 10%;">
                    <a class="w3-red w3-btn w3-hover-opacity w3-round-large"
                       href="?action=user&group=removecategory&id=<?php echo $c["Id"]; ?>#form">Xoá</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div style="margin: 16px 8px; display: flex; justify-content: right;">
        <form id="formHandle2" action="src/account/handle/addcategory.php" method="post">
            <label style="display: flex;">
                <input type="text" name="name" placeholder="Nhập tên thể loại..." value="">
                <button id="submit2" class="w3-green w3-btn" style="margin: 0 8px;" type="submit">Thêm</button>
            </label>
        </form>
    </div>
</div>
<script>
    SubmitForm("formHandle", "submit",
        function (response) {
            if (response.type === "success") {
                showBox(`<h3 class='w3-text-green'>Thành công</h3>`, `<p>${response.message}</p>`);
                setInterval(() => window.location.href = "?action=user&group=categories#form", 1000);
            }
            if (response.type === "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
        }
    );
    SubmitForm("formHandle2", "submit2",
        function (response) {
            if (response.type === "success") {
                showBox(`<h3 class='w3-text-green'>Thành công</h3>`, `<p>${response.message}</p>`);
                setInterval(() => location.reload(), 1000);
            }
            if (response.type === "error") showBox(`<h3 class='w3-text-red'>Bị lỗi rồi</h3>`, `<p>${response.message}</p>`);
        }
    );

</script>