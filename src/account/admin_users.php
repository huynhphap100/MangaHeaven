<p class="w3-bar w3-container" style="font-size: 20px; font-weight: bold;">Quản lý người dùng</p>
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
        foreach ($users as $u) { ?>
            <tr class="w3-border w3-border-white">
                <td><?php echo $u['Account']; ?></td>
                <td><?php echo $u['Email']; ?></td>
                <td><?php echo $u['Permission']; ?></td>
                <td><?php echo $u['Name']; ?></td>
                <td><?php echo $u['AccountDate']; ?></td>
                <td>
                    <?php
                    if($u['Permission'] != 'Admin'){
                        if($u['LockUser'] == 0){ ?>
                            <a class="w3-green w3-btn w3-hover-opacity w3-round-large"
                               href="?action=user&group=lockuser&id=<?php echo $u["Id"]; ?>#form">Khoá</a>
                        <?php } else { ?>
                            <a class="w3-red w3-btn w3-hover-opacity w3-round-large"
                               href="?action=user&group=unlockuser&id=<?php echo $u["Id"]; ?>#form">Mở khoá</a>
                        <?php
                        }
                    }
                    ?>
                </td>
                <!--<td style="width: 30%;">
                    <div class="w3-container">
                        <?php /*if(isset($_GET['group']) && isset($_GET['id'])
                            && $_GET['group'] == "editcategory"
                            && $_GET['id'] == $c['Id']){ */?>
                            <div style="text-align: center;">
                                <form id="formHandle" action="src/account/handle/editcategory.php" method="post">
                                    <label style="display: flex;">
                                        <input type="hidden" name="id" value="<?php /*echo $c['Id']*/?>">
                                        <input type="text" name="name" value="<?php /*echo $c['Name']; */?>">
                                        <button id="submit" class="w3-green w3-btn" type="submit">Xác nhận</button>
                                    </label>
                                </form>
                            </div>
                        <?php /*} else { */?>
                            <div style="text-align: center;"><p><?php /*echo $c['Name']; */?></p></div>
                        <?php /*} */?>
                    </div>
                </td>
                <td style="width: 30%;">
                    <div style="text-align: center;">
                        <a class="w3-green w3-btn w3-hover-opacity w3-round-large"
                           href="?action=user&group=editcategory&id=<?php /*echo $c["Id"]; */?>#form">Sửa</a>
                    </div>
                </td>
                <td style="width: 10%;">
                    <a class="w3-red w3-btn w3-hover-opacity w3-round-large"
                       href="?action=user&group=removecategory&id=<?php /*echo $c["Id"]; */?>#form">Xoá</a>
                </td>-->
            </tr>
        <?php } ?>
    </table>
</div>