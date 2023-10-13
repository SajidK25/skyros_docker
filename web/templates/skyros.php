<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head data-lang="<?= $lang ?>">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans&display=swap" rel="stylesheet">
    <meta charset="UTF-8">


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154203347-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-154203347-1');
    </script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <meta name="google-site-verification" content="ZqM3zrsC64VEtUs0KWbDozNrDilGqCyle4fYF6umo24" />

    <?php $this->insert("partials/{$myTemplate}/seo") ?>

    <?php $this->insert("partials/{$myTemplate}/favicon") ?>

    <?php $this->insert("partials/{$myTemplate}/css") ?>

    <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            margin: 0;
            padding: 0;
            z-index: 9999;
            background: url(/dist/img/loader_circle.gif) center no-repeat #fff;

        }
    </style>

    <?php //$this->insert("partials/{$myTemplate}/preClosingHead") ?>

</head>
<!-- Back to top button -->
<button onclick="topFunction()" id="myBtn" style="display: block;"></button>

<body id="top" class="<?= $body_classes ?>">

<?php //$this->insert("partials/{$myTemplate}/afterOpeningBody") ?>

<div class="se-pre-con"></div>
<!-- Main Container -->
    <div class="main-container">
        <header id="header" class="fixed">
            <!--     logo-->
            <div id="logo_black" class="logo px-5 bg-smoke hidden" >
                <a href="/">
                    <img class="img-fluid" src="/dist/img/logo.png" alt="Logo Skyros Municipality" >
                </a>
            </div>
            <!--     top navigation-->
            <?php $this->insert("partials/{$myTemplate}/_nav") ?>
        </header>

        <?php //$this->insert("modals/{$myTemplate}/modal") ?>

        <?= $this->section('content') ?>

        <?php $this->insert("partials/{$myTemplate}/_footer") ?>
    </div>


    <div id="mypopuplayer">   </div>
    <div id="mypopupvideo"  >

        <div id="mypopupclose" >✖</div>

        <iframe style="display: block" width="500" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

<!-- Javascripts -->
    <?php $this->insert("partials/{$myTemplate}/js") ?>
    <script type="text/javascript" id="cookieinfo"
            src="//cookieinfoscript.com/js/cookieinfo.min.js"
            data-message="<div><?= $configs->settings->cookies_text ?></div>"
            data-cookie="skiros-accept-cookie"
            data-divlinkbg="#000"
            data-divlink="#fff"
            data-link="#00abbd"
            data-linkmsg="<?= $this->translate('acceptCookies.learMore') ?>"
            data-moreinfo="/cookies"
            async defer>
    </script>


</body>
</html>
