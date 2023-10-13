<!-- main footer -->

<?php //var_dump($configs); exit; ?>
<footer id="footer">
    <div class="bg-smoke">
        <h2 class="dotted text-center text-blue mb-5 pb-2"><?= mainModel::getLang("footer.title",$lang) ?></h2>
        <div class="row justify-content-center m-0">
            <div class="col-md-3 text-center">
                <ul class="footer-list inline-flex">
                    <?php if(isset($configs->settings->youtube) && ($configs->settings->youtube)) {?>
                        <li><a target="_blank" href="<?= $configs->settings->youtube ?>"><img src="/dist/img/asset1.png" alt="icon" class="icon"></a></li>
                    <?php } ?>
                    <?php if(isset($configs->settings->facebook) && ($configs->settings->facebook)) {?>
                        <li><a target="_blank" href="<?= $configs->settings->facebook ?>"><img src="/dist/img/asset2.png" alt="icon" class="icon"></a></li>
                    <?php } ?>
                    <?php if(isset($configs->settings->twitter) && ($configs->settings->twitter)) {?>
                        <li><a target="_blank" href="<?= $configs->settings->twitter ?>"><img src="/dist/img/asset3.png" alt="icon" class="icon"></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="footer-list ">
                    <?php foreach ($menu->footer_1 AS $footer1) {?>
                        <li><a href="<?= $footer1->url ?>"><?= $footer1->title ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-2">
                <ul class="footer-list">
                    <?php foreach ($menu->footer_2 AS $footer2) {?>
                        <li><a href="<?= $footer2->url ?>"><?= $footer2->title ?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="footer-list">
                    <?php if ($lang == 'el'){ ?>
                        <li><a href="/contact"><h6 class="text-blue mb-3">ΕΠΙΚΟΙΝΩΝΙΑ</h6></a></li>
                    <?php }else{ ?>
                        <li><a href="/en/contact"><h6 class="text-blue mb-3">CONTACT</h6></a></li>
                    <?php } ?>
                    <li><a href="tel:<?= $configs->settings->phone ?>"><?= mainModel::getLang("footer.title.phone_number",$lang) ?>: <?= $configs->settings->phone ?></a></li>
                    <li><a href="mailto:<?= $configs->settings->email ?>">Email: <?= $configs->settings->email ?></a></li>
                </ul>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="bg-blue mt-3 py-3">
            <p class="text-center text-smoke"><?= $configs->settings->copyrights_text ?></p>
            <a href="https://ibhellas.gr" target="_blank"><img src="/dist/images/iblogo.svg" width="100px" alt="logo" style="display: block;margin-left: auto;margin-right: auto;"></a>
        </div>
    </div>
</footer>