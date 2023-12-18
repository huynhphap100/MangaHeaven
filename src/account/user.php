<style>
    #menu div {
        background-image: linear-gradient(to right, rgba(255, 255, 255, 0) 50%, rgba(255, 255, 255, 0.3) 50%);
        background-size: 200% 100%; /* Kích thước background là 200% x 100% */
        transition: background-position 0.1s ease;
    }

    #menu div:hover {
        background-position: -100% 0;
    }
</style>
<div class="w3-display-container"
     style="width: 100%; min-height: 1500px; background-image: url('image/imgOrigin/wp2758170.gif'); background-size: cover;">
    <div id="form" class="w3-display-middle w3-row-padding w3-padding w3-black w3-card w3-round-large"
         style="width: 80%; opacity: 85%;">
        <div id="menu" class="w3-quarter">
            <p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red"
               style="font-size: 20px; font-weight: bold;">Tài khoản</p>
            <div style="margin: 16px 0;"><a
                        style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;"
                        href="?action=user&group=info#form">&#129456; Thông tin tài khoản</a></div>
            <div style="margin: 16px 0;"><a
                        style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;"
                        href="?action=user&group=password#form">&#128477; Quản lý mật khẩu</a></div>
            <p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red"
               style="font-size: 20px; font-weight: bold;">Truyện tranh</p>
            <div style="margin: 16px 0;"><a
                        style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;"
                        href="?action=user&group=manga#form">&#128218; Truyện đã đăng</a></div>
            <div style="margin: 16px 0;"><a
                        style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;"
                        href="?action=user&group=addmanga#form">&#128393; Đăng truyện mới</a></div>
            <?php if ($user['Permission'] == "Admin") { ?>
                <p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red w3-text-blue"
                   style="font-size: 20px; font-weight: bold;">Quản trị viên</p>
                <div style="margin: 16px 0;"><a
                            style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;"
                            href="?action=user&group=categories#form">Quản lý thể loại</a></div>
                <div style="margin: 16px 0;"><a
                            style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;"
                            href="?action=user&group=users#form">Quản lý người dùng</a></div>
            <?php } ?>
            <p class="w3-bar w3-container w3-leftbar w3-rightbar w3-border-red"
               style="font-size: 20px; font-weight: bold;">Đăng xuất</p>
            <div style="margin: 16px 0;"><a
                        style="margin: 8px 8px; padding: 0; max-width: calc(100% - 16px); text-decoration: none;"
                        href="?action=logout">&#9940; Đăng xuất</a></div>
        </div>
        <div class="w3-threequarter">
            <?php

            $group = (isset($_REQUEST['group'])) ? $_REQUEST['group'] : "null";

            if (!isset($_SESSION['user']) || !isset($user)) {
                header("Location: ../WebDocTruyen");
                exit();
            }

            switch ($group) {
                //---------------------------------------USER
                case "password":
                    include "user_password.php";
                    break;
                case "addmanga":
                    include "user_addmanga.php";
                    break;
                case "addchapter":
                    if(!checkUser($user, !isset($_REQUEST['id']), false)) break;

                    $missingChapter = getMissingChapterManga($_REQUEST['id']);
                    $manga = getMangaById($_REQUEST['id']);

                    include "user_addchapter.php";
                    break;
                case "editchapter":
                    if(!checkUser($user, !isset($_REQUEST['id']) || !isset($_REQUEST['idchap']), false)) break;

                    $manga = getMangaById($_REQUEST['id']);
                    $chap = getChapterByIdManga($_REQUEST['idchap'], $_REQUEST['id']);
                    include "user_editchapter.php";
                    break;
                case "editmanga":
                    if(!checkUser($user, !isset($_REQUEST['id']), false)) break;

                    $manga = getMangaById($_REQUEST['id']);
                    include "user_editmanga.php";
                    break;
                case "removemanga":
                    if(!($user['Permission'] == 'Admin') && !checkUser($user, !isset($_REQUEST['id']), false)) break;

                    $manga = getMangaById($_REQUEST['id']);
                    $userManga = getUserManga($manga['Id']);
                    include "user_removemanga.php";
                    break;
                case "removechapter":
                    if(!checkUser($user, false, true)) break;
                    else if(!checkUser($user, !isset($_REQUEST['id']), false)) break;
                    include "user_removechapter.php";
                    break;
                case "manga":
                    include "user_manga.php";
                    break;
                //---------------------------------------ADMIN
                case "categories":
                case "editcategory":
                    if(!checkUser($user, false, true)) break;
                    include "admin_categories.php";
                    break;
                case "removecategory":
                    if(!checkUser($user, false, true)) break;
                    if(!isset($_GET['id'])) {
                        header("Location: ?action=user&group=categories#form");
                        break;
                    }
                    deleteCategory($_GET['id']);
                    header("Location: ?action=user&group=categories#form");
                    break;
                case "users":
                    if(!checkUser($user, false, true)) break;
                    $users = getUsers();
                    include "admin_users.php";
                    break;
                case "lockuser":
                    if(!checkUser($user, false, true)) break;
                    lockUser($_GET['id'], 1);
                    header("Location: ?action=user&group=users#form");
                    break;
                case "unlockuser":
                    if(!checkUser($user, false, true)) break;
                    lockUser($_GET['id'], 0);
                    header("Location: ?action=user&group=users#form");
                    break;
                default:
                    include "user_info.php";
                    break;
            }
            ?>
        </div>
    </div>
</div>
<?php
    function checkUser($user, $boolFalse, $isAdmin){
        if($boolFalse){
//        if (!isset($_REQUEST['id']) || !isset($_REQUEST['idchap'])) {
            header("Location: ../WebDocTruyen");
            return false;
        }
        if($isAdmin && $user['Permission'] == 'Admin') {
            return true;
        } else {
            $mangaByUser = getMangaByUser($user['Id']);
            $check = 0;
            foreach ($mangaByUser as $manga) {
                if ($manga["Id_manga"] == $_REQUEST['id']) {
                    $check = 1;
                }
            }
            if ($check == 0) {
                header("Location: ../WebDocTruyen");
                return false;
            }
        }
        return true;
    }
?>