<!-- main navigation -->
<nav id="mainNav" class="navbar navbar-expand-xl navbar-dark mx-auto">
    <button class="navbar-toggler rounded p-2" type="button" data-toggle="" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<!--        <span class="navbar-toggler-icon"></span>-->
        <img src="/dist/img/menu.svg" alt="menu">
    </button>
    <a href="/"><img class="logo-btn" src="/dist/img/logo-skirou-SVG.svg" alt="Destination Skiros"></a>
    <div class=" navbar-collapse" id="navbarSupportedContent">
        <div id="logo_white" class="logo px-5">
            <a href="<?= $menu->main[0]->url ?>">
                <img class="" src="/dist/img/logo-skirou-SVG.svg" alt="Destination Skiros">
            </a>
        </div>

        <ul class="navbar-nav mx-auto">
            ​
            <?php foreach ($menu->main AS $main) { ?>
                ​
                <li class="nav-item  <?= (isset($main->submenu) && $main->submenu != '') ? 'dropdown' : '' ?>">
                    <a class="nav-link <?= (isset($main->submenu) && $main->submenu != '') ? 'dropdown-toggle' : '' ?>"
                       href="<?= $main->url ?>" <?php if (isset($main->submenu) && ($main->submenu != '')) { ?> id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php } ?> >
                        <?= $main->title ?>
                    </a>
                    <?php if (isset($main->submenu) && $main->submenu != '') { ?>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php foreach ($main->submenu AS $sub) { ?>
                                <a class="dropdown-item" href="<?= $sub->url ?>"><?= $sub->title ?></a>
                            <?php } ?>
                        </div>
                <?php } ?>
                </li>
            <?php } ?>

        </ul>
    </div>
    <div class="languages">
        <a href="<?= mainController::changetoGR($_SERVER['REQUEST_URI'],$lang) ?>"><img src="/dist/img/flags/greek-flag.svg" alt="greek-flag"></a>
        <a href="<?= mainController::changetoENG($_SERVER['REQUEST_URI'],$lang) ?>"><img src="/dist/img/flags/Flag_of_the_United_Kingdom.svg" alt="eng-flag"></a>
    </div>
</nav>