<?php $this->layout($myTemplate) ?>

<?php include('configs/dummyData/dummy_data.php'); ?>
<!-- top section picture -->
<?php include('templates/partials/skyros/banner.php'); ?>
<div class="container">
    <!-- main body -->
    <main id="main">

        <!--list section   -->
        <section class="mb-5">

            <?php if(isset($data->news) && ($data->news != '')) {?>
                <h1 class="text-center text-blue py-5"><?= $data->title ?></h1>
                <!-- article loop -->
                <?php foreach($data->news AS $neo) { ?>
                    <div class="row py-2">
                        <div class="col-md-3 col-sm-6">
                            <?php if($neo->file == ''){ ?>
                            <a href="<?= $lang_pre ?>/neo/<?= $neo->id ?>/<?= $neo->caption ?>">
                            <?php }else{ ?>
                            <a target="_blank" href="<?= configController::getImagePath($neo->file) ?>">
                            <?php } ?>
                                <?php if($neo->img != ''){ ?>
                                <img src="<?= configController::getImagePath($neo->img,600,0) ?>" alt="picture" class="img-fluid">
                                <?php }else{ ?>
                                <img src="<?= configController::getImagePath('logo/logo_skyros_blue.png',600,0) ?>" alt="picture" class="img-fluid">
                                <?php } ?>
                            </a>
                        </div>

                        <div class="col-md-9 col-sm-6">
                            <?php if($neo->file == ''){ ?>
                            <a href="<?= $lang_pre ?>/neo/<?= $neo->id ?>/<?= $neo->caption ?>"><h3 class="text-blue"><?= $neo->title ?></h3></a>
                            <?php }else{ ?>
                                <a target="_blank" href="<?= configController::getImagePath($neo->file) ?>"><h3 class="text-blue"><?= $neo->title ?></h3></a>
                            <?php } ?>
                            <p class="text-blue"><em><?= date('d/m/Y', strtotime($neo->pub_date)) ?></em></p>
                            <p class="text-blue"><?= substr($neo->short_descr,0,490) ?></p>
                        </div>
                    </div>
                <?php  } ?>
            <?php }else{ ?>
                <h1 class="text-center text-blue py-5">Δεν υπάρχει περιεχόμενο</h1>
            <?php } ?>


        </section>
    </main>
</div>
<!-- map spacer -->

<?php include('templates/partials/skyros/pagination.php'); ?>

<?php include('templates/partials/skyros/spacer_map.php'); ?>
<!--    </body>-->
<!--</html>-->