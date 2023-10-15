<?php $this->layout($myTemplate) ?>

<!-- top section picture -->
<?php $this->insert("partials/{$myTemplate}/banner") ?>

<div class="container">
    <!-- main body -->
    <main id="main">
        <section class="mb-5">
            <div>
                <h1 class="text-center text-blue py-5"><?= $data->title ?></h1>
                <div class="offset-md-2 col-md-8">
                    <?php if($data->img != ''){ ?>
                <img style="margin-bottom:40px;" src="<?= configController::getImagePath($data->img,0,800) ?>" alt="main-image" class="img-fluid maxwidth">
                    <?php } ?>
                </div>
                <div>
                    <p class="text-blue"><em><?= date('d/m/Y', strtotime($data->pub_date)) ?></em></p>
                </div>
                <div class="text-descr-neo">
                <?= $data->descr ?>
                </div>


            </div>
        </section>
    </main>
</div>
<!-- map spacer -->
<?php $this->insert("partials/{$myTemplate}/spacer_map") ?>
