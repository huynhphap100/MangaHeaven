<link rel="stylesheet" href="css/title.css">
<div id="title">
    <div class="title__left">
        <a style="width: 60px;" href="../WebDocTruyen"><img src="image/imgOrigin/Logo.gif" alt="Home"
                                                            style="width: 100%;"></a>
<!--        <a href="#">Tìm kiếm nâng cao</a>-->
        <div class="dropdown">
            <a class="dropdown__title w3-btn" href="#">Thể loại</a>
            <div class="dropdown__items">
                <?php foreach ($categoryAll as $c){ ?>
                    <a class="dropdown__items--item" href="?category=<?php echo $c['Id']; ?>"><?php echo $c['Name']; ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
    <form method="get">
        <label class="title__middle">
            <input type="text" name="search" placeholder="Tìm kiếm..." value=""/>
            <button>&#128269;</button>
        </label>
    </form>
    <?php
    if (isset($user) && $user != null) { ?>
        <div class="title__right-account dropdown">
            <a class="title__right-avatar dropdown__title" href="?action=user"><img
                        src="<?php echo $user["Avatar"]; ?>" alt="<?php echo $user["Account"]; ?>"></a>
            <div class="dropdown__items">
                <a class="dropdown__items--item" href="?action=user">Trang cá nhân</a>
                <a class="dropdown__items--item" href="?action=logout">Đăng xuất</a>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="title__right">
            <a class="w3-button w3-hover-opacity w3-hover-none w3-hover-text-white" href="?action=login">Đăng nhập</a>
            <a class="w3-button w3-hover-opacity w3-hover-none w3-hover-text-white" href="?action=register">Đăng ký</a>
        </div>
        <?php
    }
    ?>

</div>