<?php
/**
 * Created by PhpStorm.
 * User: emilios
 */


class TemplatesFactory {


    public static function create(Language $language)
    {

        // Create new Plates instance
        $templates = new League\Plates\Engine($_SERVER['DOCUMENT_ROOT'].'/templates/');

        // Add any any additional folders of templates
        $templates->addFolder('errors', $_SERVER['DOCUMENT_ROOT'].'/templates/errors');
        $templates->addFolder('partials', $_SERVER['DOCUMENT_ROOT'].'/templates/partials');
        $templates->addFolder('pages', $_SERVER['DOCUMENT_ROOT'].'/templates/pages');

        /**
         * Register a one-off function to use inside the templates
         * this function will be used inside templates like : $this->translate('exampleTextToTranslate');
         */
        $templates->registerFunction('translate', function ($string) use ($language){

            return $language->translate($string);

        });

        /**
         * Register a one-off function to use inside the templates
         * this function will be used inside templates like : $this->truncate('exampleTextToTruncate', 'exampleLength int :  200');
         */
        $templates->registerFunction('printTruncatedHtml', function ($length, $string){

            Helper::printTruncatedHtml( $length, $string );

        });

        return $templates;

    }
    

}