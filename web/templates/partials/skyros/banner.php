<section>
    <div class="">
        <?php if(isset($data->header_banner) && ($data->header_banner != '')) {?>
            <img src="<?= configController::getImagePath($data->header_banner,0,0) ?>" alt="banner" class="img-fluid maxwidth height300">
        <?php }else{ ?>
            <img src="/dist/img/history.png" alt="banner" class="img-fluid maxwidth height300">
        <?php } ?>
    </div>
    <div class="container border_dotted">
        <p class="text-blue mt-3"><a class="text-blue" href="/">Αρχική</a> >
            <?php if (isset($data->category_news_title ) && (isset($data->category_news_caption))){ ?>
                <?= "<a class='text-blue' href=".$data->category_news_caption.">".$data->category_news_title."</a> >" ?>
            <?php } ?>
            <?= $data->title?></p>
    </div>
</section>