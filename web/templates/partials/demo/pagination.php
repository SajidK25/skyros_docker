<?php
$pages = $category->pages;
$page = $category->page;

if ($pages > 1) {

    $prev = ($page > 1) ? $page - 1 : 1;
    $next = ($page < $pages) ? $page + 1 : $pages;

    $step = 4;

    $start = ($page <= (ceil($step / 2))) ? 1 : (($page < ($pages - ($step / 2))) ? ($page - ceil($step / 2)) : ($pages - $step));
    $end = $start + $step;
    $end = ($end > $pages) ? $pages : $end;

    $mainUrl = $category->link;

    ?>

    <!-- start of pagination  -->
    <ul class="pagination">

        <?php if($pages>5): ?>

        <li class="page-item">
            <a class="page-link" href="javascript: void(0);" aria-label="<?= $this->translate('pagination.first') ?>">
                <span aria-hidden="true">«</span>

            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="javascript: void(0);" aria-label="<?= $this->translate('pagination.previous') ?>">
                <span aria-hidden="true">‹</span>

            </a>
        </li>

        <?php endif; ?>
        <?php
        $listitems = $pages;
//        $listitems = 93;
        $b = 0;
        for ($x = 1; $x <= $listitems; $x++) {
            ; ?>
            <li class="page-item num <?php if ($x == $page) echo 'active'; ?>" data-num="<?= $x; ?>"
                data-group="<?php if ($x % 5 == 0) {
                    echo $b;
                    $b++;
                } else {
                    echo $b;

                } ?>" data-last="<?= floor($listitems / 5); ?>"><a class="page-link"
                                                                   href="<?= $mainUrl ?>/page<?= $x ?>"><?= $x; ?></a>
            </li>
        <?php } ?>


    <?php if($pages>5): ?>
        <li class="page-item">
            <a class="page-link" href="javascript: void(0);" aria-label="<?= $this->translate('pagination.next') ?>">
                <span aria-hidden="true">›</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="javascript: void(0);" aria-label="<?= $this->translate('pagination.last') ?>">
                <span aria-hidden="true">»</span>
            </a>
        </li>

    <?php endif; ?>

    </ul>

    <style>

        .page-item.num:not(.shown) {
            display: none;
        }

    </style>

    <?php
}