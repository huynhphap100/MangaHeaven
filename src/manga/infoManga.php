<div>
    <div class="w3-container">
        <a href="../WebDocTruyen"><i class="fa fa-home w3-btn w3-xlarge"></i></a>
        <a class="w3-round-xlarge w3-btn w3-blue" href="../WebDocTruyen">Trang chủ</a>
        <p class="w3-btn w3-hover-none"> > <?php echo $manga["Name"]; ?></p>

        <?php if(isset($user) && ($user['Permission'] == 'Admin' || $user['Id'] == $userManga['Id'])){ ?>
            <a class="w3-btn w3-red w3-right w3-hover-orange" href="?action=user&group=removemanga&id=<?php echo $manga['Id']; ?>">Xoá truyện</a>
        <?php } ?>
    </div>
    <div class="w3-row-padding">
        <div class="w3-quarter">
            <img width="100%" src="<?php echo $manga["Image"]; ?>">
        </div>
        <div class="w3-half" style="padding-left: 5%;">
            <h2><?php echo $manga["Name"]; ?></h2>
            <p>
                <span class="w3-text-amber">Mô tả: </span>
                <span><?php echo htmlspecialchars_decode($manga["Description"]); ?></span>
            </p>
            <p>
                <span class="w3-text-amber">Thể loại: </span>
                <?php foreach ($categories as $category) { ?>
                    <a href="?caterogy=<?php echo $category['Id']; ?>" style="text-decoration: none;">
                        <span class="w3-border w3-border-white w3-round-xlarge w3-hover-blue"
                              style="padding: 2px 4px 2px 4px;"><?php echo $category["Name"]; ?></span></a>
                <?php } ?>
            </p>
            <p>
                <span class="w3-text-amber">Tác giả: </span>
                <span><?php echo $userManga['Name']; ?></span>
            </p>
            <p>
                <span class="w3-text-amber">Trạng thái: </span>
                <span><?php
                    if ($manga["Status"] == 1) {
                        echo "Đang tiến hành";
                    } else {
                        echo "Đã hoàn thành";
                    }
                    ?></span>
            </p>
            <p>
                <span class="w3-text-amber">Ngày cập nhật: </span>
                <span><?php echo date("d/m/Y H:i", strtotime($manga["DateUpdate"])); ?></span>
            </p>
            <div class="w3-cell-row" style="width: 100%;">
                <div class="w3-cell" style="width: 33%;">
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <div style="text-align: center;">
                            <i class="bi bi-heart w3-xxlarge w3-text-red w3-btn"></i>
                            <p><?php echo $amountLike; ?></p>
                        </div>
                    <?php } else {
                        $userMangaAction = getUserMangaAction($_SESSION['user']['Id'], $_REQUEST['id']);
                        if ($userMangaAction && $userMangaAction['Like']) { ?>
                            <div id="like-off" class="w3-hide" style="text-align: center;">
                                <i class="bi bi-heart w3-xxlarge w3-text-red w3-btn" onclick="like(event)"></i>
                                <p class="like-amount"><?php echo $amountLike; ?></p>
                            </div>
                            <div id="like-on" style="text-align: center;">
                                <i class="bi bi-heart-fill w3-xxlarge w3-text-red w3-btn" onclick="like(event)"></i>
                                <p class="like-amount"><?php echo $amountLike; ?></p>
                            </div>
                        <?php } else { ?>
                            <div id="like-off" style="text-align: center;">
                                <i class="bi bi-heart w3-xxlarge w3-text-red w3-btn" onclick="like(event)"></i>
                                <p class="like-amount"><?php echo $amountLike; ?></p>
                            </div>
                            <div id="like-on" class="w3-hide" style="text-align: center;">
                                <i class="bi bi-heart-fill w3-xxlarge w3-text-red w3-btn" onclick="like(event)"></i>
                                <p class="like-amount"><?php echo $amountLike; ?></p>
                            </div>
                        <?php }
                    } ?>

                </div>
                <div class="w3-cell" style="width: 33%;">
                    <div style="text-align: center;">
                        <i class="bi bi-eye-fill w3-xxlarge w3-text-blue w3-btn w3-hover-none"></i>
                        <p><?php echo $manga["View"]; ?></p>
                    </div>
                </div>
                <div class="w3-cell" style="width: 33%;">
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <div style="text-align: center;">
                            <i class="bi bi-person w3-xxlarge w3-text-blue w3-btn"></i>
                            <p><?php echo $amountFollow; ?></p>
                        </div>
                    <?php } else {
                        $userMangaAction = getUserMangaAction($_SESSION['user']['Id'], $_REQUEST['id']);
                        if ($userMangaAction && $userMangaAction['Follow']) { ?>
                            <div id="follow-off" class="w3-hide" style="text-align: center;">
                                <i class="bi bi-person w3-xxlarge w3-text-blue w3-btn" onclick="follow(event)"></i>
                                <p class="follow-amount"><?php echo $amountFollow; ?></p>
                            </div>
                            <div id="follow-on" style="text-align: center;">
                                <i class="bi bi-person-fill w3-xxlarge w3-text-blue w3-btn" onclick="follow(event)"></i>
                                <p class="follow-amount"><?php echo $amountFollow; ?></p>
                            </div>
                        <?php } else { ?>
                            <div id="follow-off" style="text-align: center;">
                                <i class="bi bi-person w3-xxlarge w3-text-blue w3-btn" onclick="follow(event)"></i>
                                <p class="follow-amount"><?php echo $amountFollow; ?></p>
                            </div>
                            <div id="follow-on" class="w3-hide" style="text-align: center;">
                                <i class="bi bi-person-fill w3-xxlarge w3-text-blue w3-btn" onclick="follow(event)"></i>
                                <p class="follow-amount"><?php echo $amountFollow; ?></p>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-border w3-border-white w3-margin w3-padding" style="width: 70%;">
        <h2 class="w3-text-blue w3-bar w3-border-bottom w3-border-white">
            <i class="bi bi-card-list w3-xxlarge"></i> Danh sách tập</h2>
        <div style="overflow: auto; max-height: 200px;">
            <?php foreach ($chapters as $chap) { ?>
                <div style="width: 100%;">
                    <a class="w3-button w3-hover-none w3-bar w3-hover-opacity w3-hover-gray w3-hover-text-white"
                       style="text-align: left;"
                       href="?action=readManga&id=<?php echo $chap["Id_manga"]; ?>&chap=<?php echo $chap["Chap"] ?>">Tập <?php echo $chap["Chap"]; ?>
                        : <?php echo $chap["Name"]; ?></a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">

    function like(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

        // Gửi yêu cầu AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'src/manga/handle_like.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            let i;
            if (xhr.readyState === 4 && xhr.status === 200) {
                const result = xhr.responseText;
                const like_off = document.getElementById("like-off");
                const like_on = document.getElementById("like-on");
                const like_amount = document.getElementsByClassName("like-amount");
                if (like_off.classList.contains("w3-hide")) {
                    like_off.classList.remove("w3-hide");
                    like_on.classList.add("w3-hide");
                    for (i = 0; i < like_amount.length; i++)
                        like_amount[i].innerText = (parseInt(like_amount[i].innerText) - 1).toString();
                } else {
                    like_on.classList.remove("w3-hide");
                    like_off.classList.add("w3-hide");
                    for (i = 0; i < like_amount.length; i++)
                        like_amount[i].innerText = (parseInt(like_amount[i].innerText) + 1).toString();
                }
            }
        };
        xhr.send('id=' + encodeURIComponent(<?php echo $_REQUEST['id']; ?>));
    }

    function follow(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

        // Gửi yêu cầu AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'src/manga/handle_follow.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var result = xhr.responseText;
                var follow_off = document.getElementById("follow-off");
                var follow_on = document.getElementById("follow-on");
                var follow_amount = document.getElementsByClassName("follow-amount");
                if (follow_off.classList.contains("w3-hide")) {
                    follow_off.classList.remove("w3-hide");
                    follow_on.classList.add("w3-hide");
                    for (var i = 0; i < follow_amount.length; i++)
                        follow_amount[i].innerText = (parseInt(follow_amount[i].innerText) - 1).toString();
                } else {
                    follow_on.classList.remove("w3-hide");
                    follow_off.classList.add("w3-hide");
                    for (var i = 0; i < follow_amount.length; i++)
                        follow_amount[i].innerText = (parseInt(follow_amount[i].innerText) + 1).toString();
                }
            }
        };
        xhr.send('id=' + encodeURIComponent(<?php echo $_REQUEST['id']; ?>))
    }
</script>