<?php

class Language {

    public $language;

    public $defaultLang;

    public $translations = [];

    public $langLinks;

    public $link;

    public $requestUri;

    public $supportedLanguages;

    public $siteRoot;

    public $cleanUriFromLangPrefix;


    public function __construct( $supportedLanguages = [], $defaultLang, $siteRoot = '/', $defaultTranslationPath = 'translations/default.php' )
    {

        $this->siteRoot = $siteRoot;

        $this->requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');;

        $this->supportedLanguages = $supportedLanguages;

        $this->defaultLang = $defaultLang;
        
        $this->_setLang();

        $this->loadTranslations($defaultTranslationPath);

    }


    public function loadTranslations($paths = [])
    {

        if ( is_string($paths) ) {

            settype($paths, 'array');

        }

        foreach ($paths as $path) {

            if ( file_exists($path) ) {

                $translationArray = require_once ($path);

                $this->translations = array_merge($this->translations, $translationArray);

            }

        }

    }


    public function get() {

        return $this->language;

    }

    public function code()
    {

        return $this->language;

    }


    public function translate($title) {

        if ( isset($this->translations[$title][$this->language]) ) {

            return $this->translations[$title][$this->language];

        }

        return '';
    }


    public function getLinks() {

        return $this->langLinks;

    }

    public function getLink($langLink)
    {

        if ( isset($this->langLinks[$langLink]) )
            return $this->langLinks[$langLink];

        return null;
        
    }

    /**
     * this function helps to make a link based on the language
     * @return string
     */
    public function linkPrefix() {

        if ( $this->language == $this->defaultLang ) {

            return '';

        }

        return $this->language.'/';

    }



    private function _setLangAndCleanUriFromLang()
    {

        $requestUri = $this->requestUri;

        $expRequestUri = explode('/', $requestUri);

        if ( array_key_exists(0, $expRequestUri) && in_array($expRequestUri[0], $this->supportedLanguages) ) {
            
            $this->language = $expRequestUri[0];

            unset($expRequestUri[0]);


            $this->cleanUriFromLangPrefix = implode('/', $expRequestUri);

        }else {

            $this->language = $this->defaultLang;

            $this->cleanUriFromLangPrefix = $requestUri;

        }

        return $this->cleanUriFromLangPrefix;

    }


    private function _setLangLinks($cleanUriFromLangPrefix)
    {

        $cleanUri = $cleanUriFromLangPrefix;

        foreach ( $this->supportedLanguages as $supportedLanguage ) {

            if ( $supportedLanguage != $this->defaultLang ) {

                $this->langLinks[$supportedLanguage] = $this->siteRoot . $supportedLanguage . '/' . $cleanUri;

            }else{

                // default language link does not have prefix to uri
                $this->langLinks[$supportedLanguage] = $this->siteRoot . $cleanUri;

            }

        }

    }


    private function _setLang()
    {
        
        $cleanUri = $this->_setLangAndCleanUriFromLang();

        $this->_setLangLinks($cleanUri);

    }


}