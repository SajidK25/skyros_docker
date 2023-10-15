
<!-- ============================================================= SLIDER SECTION ============================================================= -->
<section>
    <div class="owl-carousel owl-theme">

        <?php foreach($homepage->slides AS $slide) {?>
        <div class="owl-slide d-flex align-items-center cover" style="background-image: url(<?= configController::getImagePath($slide->img,0,0) ?>);">
            <div class="container front">
                <div class="row justify-content-center justify-content-md-start">
                    <div class="col-10 col-md-6 static">
                        <div class="owl-slide-text">
                            <h2 class="owl-slide-animated owl-slide-title"><?= $slide->title ?></h2>
                            <div class="owl-slide-animated owl-slide-subtitle mb-3">
                                <?= $slide->descr ?>
                            </div>
                            <a class="btn owl-slide-animated owl-slide-cta" href="<?= $slide->url_link ?>" role="button"><?= $slide->url_text ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/owl-slide-->
        <?php } ?>

    </div>
    <div class="arrows">
        <img src="/dist/img/double-arrows.png" alt="arrows" id="go">
    </div>
</section>
