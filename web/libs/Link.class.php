<?php

class Link {

    protected static function prefixLink()
    {

        $language = App::get('Language');

        // check if is object of Language class
        if ( is_a($language, 'Language') )
            return Config::get('Root') . $language->linkPrefix();

        return '';

    }


    public static function languageLink($langCode)
    {

        $language = App::get('Language');

        // check if is object of Language class
        if ( is_a($language, 'Language') )
            return $language->getLink($langCode);


        return '';

    }


    public static function make($linkName = '')
    {

        if ( empty($linkName) || $linkName == '/') {

            return self::prefixLink();

        }


        return self::prefixLink() . ltrim($linkName, '/');

    }
    
    
    public static function toSelf()
    {

        return rawurldecode(
            rtrim(
                parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/')
        );
        
        
    }


    public static function bannerLink($bannerLink)
    {
        $stirngToReplace1 = 'https://'.$_SERVER['HTTP_HOST'].'/en';
        $stirngToReplace2 = 'https://'.$_SERVER['HTTP_HOST'];

        if (strpos($bannerLink, $stirngToReplace1) !== false && App::get('Language')->code() != 'en' ) {

            $bannerLink = str_replace($stirngToReplace1, '', $bannerLink);

        }elseif (strpos($bannerLink, $stirngToReplace2) !== false) {

            $bannerLink = str_replace($stirngToReplace2, '', $bannerLink);

        }



        return $bannerLink;


    }
    
    
}