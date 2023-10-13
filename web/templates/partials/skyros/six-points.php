<!-- top picks block -->
<section class="bg-smoke p-5">
    <h2 class="text-center text-blue mb-5"><?= $homepage->label_box_2 ?></h2>
    <div class="row justify-content-center">

        <?php foreach ($homepage->box2 AS $box2){ ?>
        <div class="col-md-3 col-sm-6 text-center bg-blue m-3 rounded">
            <img class="py-3" src="<?= configController::getImagePath($box2->img,0,0) ?>" alt="<?= $box2->caption ?>"><br>
            <h4 class="pb-3"><a class="text-smoke" href="<?= $box2->url_link ?>"><?= $box2->title ?></a></h4>

<!--            <p class="text-smoke">--><?php //= $box2->descr ?><!--</p>-->
        </div>
        <?php } ?>

    </div>
</section>
