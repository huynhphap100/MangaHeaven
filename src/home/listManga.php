<?php
$itemsPerPage = 6;

$totalPages = ceil(count($mangas) / $itemsPerPage);
$page = isset($_GET['page']) ? max(1, min($_GET['page'], $totalPages)) : 1;
$startIndex = ($page - 1) * $itemsPerPage;
$mangasOnCurrentPage = array_slice($mangas, $startIndex, $itemsPerPage);
?>
<div class="" style="display: flex; flex-wrap: wrap; margin: 12px;">
	<?php foreach ($mangasOnCurrentPage as $manga) { ?>
		<div class="w3-card" style="width: 300px; margin: 8px;">
			<div class="w3-hover-opacity w3-border w3-round-large" style="width: 95%; height: 300px; overflow: hidden; position: relative;">
				<a href="?action=manga&id=<?php echo $manga["Id"] ?>">
					<img style="width: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" src="<?php echo $manga["Image"] ?>" alt="<?php echo $manga["Name"] ?>">
				</a>
			</div>
			<div style="text-align: center;">
				<a href="?action=manga&id=<?php echo $manga["Id"] ?>" style="text-decoration: none;"><?php echo $manga["Name"] ?></a>
			</div>
		</div>
	<?php } ?>
</div>
<div class="w3-col" style="width: 100%; text-align: center;">
    <?php
    $currentParams = $_GET;
    if ($page > 1) {
        $prevLinkParams = http_build_query(array_merge($currentParams, ['page' => $page - 1]));
        echo '<a class="w3-btn w3-hover-blue" href="?' . $prevLinkParams . '">&#10094; Trang trước</a> ';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        $linkParams = http_build_query(array_merge($currentParams, ['page' => $i]));
        $activeClass = ($i == $page) ? 'w3-green' : '';

        echo '<a class="w3-btn w3-hover-blue ' . $activeClass . '" href="?' . $linkParams . '">' . $i . '</a> ';
    }

    if ($page < $totalPages) {
        $nextLinkParams = http_build_query(array_merge($currentParams, ['page' => $page + 1]));
        echo '<a class="w3-btn w3-hover-blue" href="?' . $nextLinkParams . '">Trang sau &#10095;</a>';
    }
    ?>
</div>

<div class="w3-col" style="width: 100%; text-align: center;"><!--
    <?php
/*    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $pageNext = $page + 1;
        $pageBack = $page - 1;

        function createPageLink($pageNumber, $currentPage)
        {
            $class = ($pageNumber == $currentPage) ? 'w3-red ' : '';
            $link = ($pageNumber == $currentPage) ? '#' : "?page=$pageNumber#listmanga";
            return "<a href=\"$link\" class=\"w3-bar-item {$class}w3-button\">$pageNumber</a>";
        }

        // Giữ lại các tham số GET khác và thêm tham số search
        $query = $_GET;
        unset($query['page']); // Loại bỏ trang để tránh trùng lặp
        $query['search'] = 'your_search_value'; // Thay 'your_search_value' bằng giá trị tìm kiếm thực tế

        echo createPageLink('&laquo;', 1);

        for ($i = 1; $i <= 4; $i++) {
            echo createPageLink($i, $page);
        }

        echo createPageLink('&raquo;', 4);
    } else {
        function createPageLink($pageNumber)
        {
            // Giữ lại các tham số GET khác và thêm tham số search
            $query = $_GET;
            unset($query['page']); // Loại bỏ trang để tránh trùng lặp
            $query['search'] = 'your_search_value'; // Thay 'your_search_value' bằng giá trị tìm kiếm thực tế

            $link = ($pageNumber == 1) ? '#listmanga' : "?page=$pageNumber#" . http_build_query($query);
            return "<a href=\"$link\" class=\"w3-bar-item w3-button\">$pageNumber</a>";
        }

        echo createPageLink('&laquo;');
        for ($i = 1; $i <= 4; $i++) {
            echo createPageLink($i);
        }
        echo createPageLink('&raquo;');
    }
    */?>

-->
</div>