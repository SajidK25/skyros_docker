<?php
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8" ?>';

$site_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc><?= $site_url ?></loc>
        <priority>1.00</priority>
    </url>

    <?php foreach ($map->content AS $content) { ?>
        <url>
            <loc><?= $site_url ?>/<?= $content->caption ?></loc>
            <priority>0.5</priority>

            <xhtml:link xmlns:xhtml="http://www.w3.org/1999/xhtml"
                        rel="alternate"
                        hreflang="en"
                        href="<?= $site_url ?>/en/"
            />

        </url>

    <?php } ?>

    <?php foreach ($map->news AS $neo) { ?>
        <url>
            <loc><?= $site_url ?>/neo/<?= $neo->id ?>/<?= $neo->caption ?></loc>
            <priority>0.5</priority>

            <xhtml:link xmlns:xhtml="http://www.w3.org/1999/xhtml"
                        rel="alternate"
                        hreflang="en"
                        href="<?= $site_url ?>/en/neo/<?= $neo->id ?>/<?= $neo->caption ?>"
            />

        </url>

    <?php } ?>

    <?php foreach ($map->news_cats AS $cat) { ?>
        <url>
            <loc><?= $site_url ?>/news/<?= $cat->caption ?></loc>
            <priority>0.5</priority>

            <xhtml:link xmlns:xhtml="http://www.w3.org/1999/xhtml"
                        rel="alternate"
                        hreflang="en"
                        href="<?= $site_url ?>/en/news/<?= $cat->caption ?>"
            />

        </url>

    <?php } ?>

    <url>
        <loc><?= $site_url ?>/contact</loc>
        <priority>0.5</priority>

        <xhtml:link xmlns:xhtml="http://www.w3.org/1999/xhtml"
                    rel="alternate"
                    hreflang="en"
                    href="<?= $site_url ?>/en/contact"
        />

    </url>

    <url>
        <loc><?= $site_url ?>/gallery</loc>
        <priority>0.5</priority>

        <xhtml:link xmlns:xhtml="http://www.w3.org/1999/xhtml"
                    rel="alternate"
                    hreflang="en"
                    href="<?= $site_url ?>/en/gallery"
        />

    </url>



</urlset>