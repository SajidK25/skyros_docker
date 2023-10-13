<?php
$pages = $data->pages;
$page = $data->page;

if ($pages > 1) {

    $prev = ($page > 1) ? $page - 1 : 1;
    $next = ($page < $pages) ? $page + 1 : $pages;

    $step = 4;

    $start = ($page <= (ceil($step / 2))) ? 1 : (($page < ($pages - ($step / 2))) ? ($page - ceil($step / 2)) : ($pages - $step));
    $end = $start + $step;
    $end = ($end > $pages) ? $pages : $end;

    $mainUrl = $data->link;

    ?>

    <!-- start of pagination  -->
    <div class="row flex-row justify-content-center p-0">
        <ul class="pagination pagination-area">

            <li class="page-item">
                <a class="page-link" href="<?= $mainUrl ?>/page1">«</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $mainUrl ?>/page<?= $prev ?>">‹</i></a>
            </li>

            <?php for ($i = $start; $i <= $end; $i++): ?>

                <li data-lp="<?= $i ?>" class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $mainUrl ?>/page<?= $i ?>"><?= $i ?></a>
                </li>

            <?php endfor; ?>

            <li class="page-item">
                <a class="page-link" href="<?= $mainUrl ?>/page<?= $next ?>">›</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $mainUrl ?>/page<?= $pages ?>">»</a>
            </li>

        </ul>


    </div>

<?php } ?>