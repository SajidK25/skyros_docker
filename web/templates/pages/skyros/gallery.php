<?php $this->layout($myTemplate) ?>

<!-- top section picture -->
<?php include('templates/partials/skyros/banner.php'); ?>
<div class="container">
    <!-- main body -->

    <style>
        .img-items {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            max-height: 170px;
            min-height: 170px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <main id="main">
        <!--list section   -->
        <section class="mb-5">
            <h1 class="text-center text-blue py-5"><?= $data->title ?></h1>
            <div id="gallery" class="row justify-content-center lightgallery mb-5">

            </div>
            <div class="text-center">
                <button class="btn btn-primary" id="loadMore" data-page="0" data-items="<?= $data->max_items ?>" data-step="20">Load More</button>
            </div>

        </section>
    </main>
</div>

<!-- map spacer -->
<?php include('templates/partials/skyros/spacer_map.php'); ?>
