<?php $this->layout($myTemplate) ?>

<!-- slider -->
<?php $this->insert("partials/{$myTemplate}/sliders/full-cover") ?>

<!-- main body -->
<main id="main">
    <!-- section 1: Welcome -->
    <section class="bg-smoke container-fluid">
        <header class="pb-5">
            <h2 class="text-center text-blue my-5"><?= $homepage->text_section_1->title ?></h2>
            <p class="text-blue px-5">
                <?= $homepage->text_section_1->descr ?>
                <a style="margin-left: auto; margin-right: auto; width: 150px; display: block;" href="<?= $homepage->text_section_1->url_link ?>" class="read-more wow fadeInDown text-blue btn owl-slide-animated owl-slide-cta" data-wow-delay=".6s"><?= $homepage->text_section_1->url_text ?></a>

            </p>

        </header>
    </section>
    <!-- 1st divider -->
    <div style="background-image: url(<?= configController::getImagePath($homepage->spacer_1,0,0) ?>);" class="parallax"></div>

    <!-- START THE MAYOR  AREA -->
    <section class="container bg-smoke py-5">
        <div class="row">
            <div class="col-md-3 wow fadeInLeft mr-auto" data-wow-delay=".2s">
                <div class="about-image text-center mb-3">
                    <img src="<?= configController::getImagePath($homepage->text_section_2->img,0,0) ?>" alt="mayor" class="img-fluid img-responsive maxwidth">
                </div>
            </div>
            <div class="col-md-9 ml-auto">
                <div class="about-text">
                    <h2 class="wow fadeInDown text-blue" data-wow-delay=".2s"><?= $homepage->text_section_2->title ?></h2>
                    <p class="wow fadeInDown text-blue" data-wow-delay=".4s"><?= $homepage->text_section_2->descr ?></p>
                    <a href="<?= $homepage->text_section_2->url_link ?>" class="read-more wow fadeInDown text-blue btn owl-slide-animated owl-slide-cta" data-wow-delay=".6s"><?= $homepage->text_section_2->url_text ?></a>
                </div>
            </div>
        </div>
    </section>
    <!-- END THE MAYOR  AREA -->


    <!-- 2nd divider video -->
    <div style="background-image: url(<?= configController::getImagePath($homepage->video_img,0,0) ?>);" class="text-center wow bounceIn parallax2">
        <h2 class="text-smoke pt-5 pb-3"><?= $homepage->video_title ?></h2>
        <a data-toggle="modal" data-target=".bd-example-modal-lg" style="cursor: pointer;">
            <i class="fa fa-play"></i>
        </a>
    </div>

    <!-- VIdeo divider Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-blue">
                <iframe width="560" height="315" src="<?= $homepage->video_url ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>
            </div>
        </div>
    </div>
    <!-- / END 2nd divider -->

    <!-- section PVS NA FTASETE -->
    <section class="container bg-smoke ">
        <div class="p-5">
            <h2 class="text-center text-blue mb-5"><?= $homepage->text_section_3->title ?></h2>
            <p class="text-blue">
                <?= $homepage->text_section_3->descr ?>
            </p>
        </div>
    </section>
    <!-- END section PVS NA FTASETE -->

    <?php $this->insert("partials/{$myTemplate}/top_picks_fullpage") ?>
    <?php $this->insert("partials/{$myTemplate}/six-points") ?>


    <!-- 3rd divider banner -->
    <div style="background-image: url(<?= configController::getImagePath($homepage->spacer_2,0,0) ?>);" class="parallax2"></div>

    <!-- START ADELFOPOIHMENES POLEIS -->
    <section class="bg-smoke">
        <div class="text-center pb-5">
            <h2 class="text-center text-blue py-5 bg-smoke"><?= $homepage->map_title ?></h2>
            <img class="img-fluid map" src="<?= configController::getImagePath($homepage->map_img,0,0) ?>" alt="<?= $homepage->map_img ?>">
        </div>
    </section>
    <!-- END ADELFOPOIHMENES POLEIS -->

    <!-- START GOOGLE MAPS -->
    <div class="">
        <h2 class="text-center text-blue"><?= mainModel::getLang("title.coastal_map",$lang) ?></h2>
<!--        <img src="/dist/img/skyros_map.jpg" alt="skyros map" class="img-flex maxwidth">-->
        <?php $this->insert("partials/{$myTemplate}/spacer_map") ?>
    </div>

    <!-- END GOOGLE MAPS -->




