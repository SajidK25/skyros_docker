<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head data-lang="<?= $lang ?>">
    <meta charset="UTF-8">

    <?php if(Config::get('DemoSite')==1): ?>

        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <?php endif; ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <?php //$this->insert("partials/{$myTemplate}/seo") ?>

    <?php $this->insert("partials/{$myTemplate}/favicons") ?>

    <?php $this->insert("partials/{$myTemplate}/css") ?>

    <?php $this->insert("partials/{$myTemplate}/preClosingHead") ?>

</head>

<body class="<?= $body_classes ?>">

<?php $this->insert("partials/{$myTemplate}/afterOpeningBody") ?>
<div class="loader dragon-loader"><img src="/dist/images/dragon_loader.svg" style="width: 200px;"></div>
<style>
    .loader{
        background-color: #fff;
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 5000;
    }
    .loader img {
        -webkit-animation: anim 2s infinite linear;
        animation: anim 2s infinite linear;
    }
    @-webkit-keyframes anim {
        from {-webkit-transform: rotateY(0deg);}
        to {-webkit-transform: rotateY(360deg);}
    }

    @keyframes anim {
        from {transform: rotateY(0deg);}
        to {transform: rotateY(360deg);}
    }
</style>
<!-- Main Container -->
<div class="main-container">

    <?php $this->insert("partials/{$myTemplate}/_nav") ?>

    <?php $this->insert("modals/{$myTemplate}/modal") ?>

    <?= $this->section('content') ?>

    <?php $this->insert("partials/{$myTemplate}/_footer") ?>

</div>


<?php $this->insert("partials/{$myTemplate}/js") ?>

<script type="text/javascript" id="cookieinfo"
        src="//cookieinfoscript.com/js/cookieinfo.min.js"
        data-message="<div><?= $this->translate('acceptCookies.description') ?></div>"
        data-cookie="liberal-accept-cookie"
        data-divlinkbg="#000"
        data-divlink="#fff"
        data-link="#00abbd"
        data-linkmsg="<?= $this->translate('acceptCookies.learMore') ?>"
        data-moreinfo="/cookies"
        async defer>
</script>

</body>
</html>
