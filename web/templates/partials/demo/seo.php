<!-- Google -->

<title><?=$seo->meta_title?></title>
<meta name="description" content="<?=$seo->meta_description?>">
<meta name="keywords" content="<?=$seo->meta_keywords?>">

<!-- Facebook -->
<meta property="og:url"           content="https://<?= $_SERVER['SERVER_NAME']; ?>" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="<?=$seo->meta_title?>" />
<meta property="og:description"   content="<?=$seo->meta_description?>" />
<meta property="og:image"         content="" />

<!-- Twitter -->

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@nytimes">
<meta name="twitter:title" content="<?=$seo->meta_title?>">
<meta name="twitter:description" content="<?=$seo->meta_description?>">
<meta name="twitter:image" content="">


<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "http://www.allaboutpeloponnisos.com",
      "logo": "http://www.allaboutpeloponnisos.com/templates/sj_resorts/images/logo_new.png",
      "name": "AllAboutPeloponnisos.com",
      "sameAs": [
        "https://www.facebook.com/allaboutpeloponnisos",
        "https://twitter.com/AllPeloponnisos"
      ]
    }
</script>