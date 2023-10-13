<!-- top picks block -->
<!-- START PLACE DESIGN AREA -->
<section id="" class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="section-title text-center">
                    <h2 class="text-center text-blue mb-5"><?= $homepage->label_box_1 ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- START SINGLE WORK DESIGN AREA -->
            <?php foreach ($homepage->box1 AS $box1){ ?>
            <div class="col-md-4 col-sm-6 p-0">
                <div class="project-item">
                    <a href="<?= $box1->url_link ?>" class="work-popup">
                        <img src="<?= configController::getImagePath($box1->img,0,0) ?>" class="img-responsive" alt="<?= $box1->caption ?>">
                        <div class="project-overlay">
                            <div class="project-info">
                                <h2 class="wow fadeInUp">
                                    <?= $box1->title ?>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php } ?>

            <!-- END SINGLE WORK DESIGN AREA -->
        </div>
    </div>
</section>
<!-- / END PLACE WORK DESIGN AREA -->


