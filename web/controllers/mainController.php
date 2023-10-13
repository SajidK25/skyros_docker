<?php

class mainController
{

    /**
     *
     *  An prostethei nea Class sto arxeio na ginei include
     *  kai sto admin/system/betonews.php
     *
     */

    protected $templates;
    protected $language;

    public $configs;
    public $site_url;
    public $menu;
    public $site;
    public $roi;
    public $top;
    public $cssCall;
    public $jsCall;
    public $mylang;
    public $myTemplate = 'skyros';

    public function __construct(\League\Plates\Engine $templates, Language $language)
    {

        $this->templates = $templates;
        $this->language = $language;

        $this->site_url = Config::get('Domain');

        $this->getSite();
        $this->getCss();
        $this->getJs();
        //$this->addJsModule('Home');

        $this->getTemplate();
        $this->getMenu();
        $this->getConfigs();

        $lang = $this->language->code();

        $this->mylang = $this->language->code();

        $this->templates->addData(compact('lang'));

    }

    public function getTemplate(){

        $myTemplate = $this->myTemplate;

        if(isset($this->site) && isset($this->site->template) && $this->site->template!=='') {

            $this->myTemplate = $this->site->template;
            $myTemplate = $this->site->template;

        }


        $this->templates->addData(compact('myTemplate'));


    }

    public function getCss(){
        $this->cssCall = [
            "/dist/light_gallery/lightgallery.css",
            "/dist/bootstrap-4.3.1/css/bootstrap.min.css",
            "/dist/animate/animate.min.css",
            "/dist/fonts/linear-fonts.css",
            "/dist/font-awesome-4.7.0/css/font-awesome.min.css",
            "/dist/owl-carousel2-2.3.4/dist/assets/owl.carousel.min.css",
            "/dist/owl-carousel2-2.3.4/dist/assets/owl.theme.default.min.css",
            "/dist/css/owl_full_cover.css",
            "/dist/css/layout2.css",
            "/dist/css/main.css"
        ];

        $this->templates->addData(['cssCall'=>$this->cssCall]);
    }

    public function addCssSimple($css){

        $this->cssCall[] = $css;

        $this->templates->addData(['cssCall'=>$this->cssCall]);

    }
    public function getJs(){

        $this->jsCall = [
            [
                'file'=>'/dist/jquery/jquery-3.4.1.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/popper/popper.min.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/bootstrap-4.3.1/js/bootstrap.min.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/moderinizer/modernizr.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/light_gallery/lightgallery-all.min.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/wow/wow.min.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/easing-1.3/jquery.easing.1.3.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/owl-carousel2-2.3.4/dist/owl.carousel.min.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/js/owl_full_cover.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/js/4-cards.js',
                'module'=>''
            ],
            [
                'file'=>'/dist/js/main.js',
                'module'=>''
            ]
        ];

        $this->templates->addData(['jsCall'=>$this->jsCall]);

    }

    public function addJsModule($js){

        $this->jsCall[] = [
            "file" => "/dist/js/modules/{$js}.js",
            "module" => $js
        ];

        $this->templates->addData(['jsCall'=>$this->jsCall]);

    }

    public function addJsSimple($js){

        $this->jsCall[] = [
            "file" => $js,
            "module" => ""
        ];

        $this->templates->addData(['jsCall'=>$this->jsCall]);

    }

    public function getErrorPage($error){

        if($error == 405){

            Header("HTTP/1.0 405 Method Not Allowed");
            $body_classes = "405_page error_page";

            $this->getSeo(false);

            $this->templates->addData(compact('body_classes','menu'));
            echo $this->templates->render("errors/405");
            exit;

        } else {

            Header("HTTP/1.0 404 Not Found");
            $body_classes = "404_page error_page";

            $this->getSeo(false);

            $this->templates->addData(compact('body_classes','menu'));
            echo $this->templates->render("errors/404");
            exit;

        }

    }

    public function getSite()
    {

        $main = new mainModel();

        $this->site = $main->getMinisite($this->site_url);

        if(!$this->site){

            $this->getErrorPage('404');

        }


    }

    public function getMenu()
    {

        $main = new mainModel($this->language->code());

        $menu = new stdClass();
        //$menu->top      = $main->getMenu(1 , $this->site->id );
        $menu->main     = $main->getMenu(1 , $this->site->id );
        $menu->footer_1   = $main->getMenu(2 , $this->site->id );
        $menu->footer_2   = $main->getMenu(3 , $this->site->id );
        //$menu->quick1   = $main->getMenu(4 , $this->site->id );
        //$menu->quick2   = $main->getMenu(5 , $this->site->id );


        $this->templates->addData(compact('menu'));

    }

    public function getConfigs()
    {

        $main = new mainModel();
        //$configs = $main->getConfigs($this->site->id);
        $configs = new stdClass();
        $settings = $main->getSettings();
        $configs->settings = $settings;

        $this->configs = $configs;
        $this->configs->title = $settings->meta_title;
        $this->configs->meta_description = $settings->meta_description;
        $this->configs->meta_keywords = $settings->meta_keywords;

        //var_dump($settings);
        //$this->configs->title = "";
        //$this->configs->meta_description = "";
        //$this->configs->meta_keywords = "";

        $this->templates->addData(compact('configs'));



    }

    public function addhittoart($articleId)
    {

        if ($articleId > 0) {

            $main = new mainModel();
            $main->addhittoart($articleId);

        }

    }

    public function get_body_classes($now_url)
    {

        $body_classes = explode('/', strtok($now_url, '?'));
        $body_classes = implode(' ', $body_classes);
        return $body_classes;

    }

    public function get_dfp_str($now_url)
    {

        $now_url = strtok($now_url, '?');
        $dfp_str = ($now_url === '/') ? ["'home'"] : ["'ros'"];
        $body_classes = explode('/', $now_url);

        foreach ($body_classes as $bc){

            if($bc!==''){

                array_push($dfp_str,"'" . $bc . "'");

            }

        }

        return implode(',',$dfp_str);

    }

    public function getSeo($data)
    {

        $seo = new stdClass();
        $seo->meta_title = ($data && $data->meta_title && $data->meta_title != '' ) ? $data->meta_title : $this->configs->title;
        $seo->meta_description = ($data && $data->meta_description && $data->meta_description != '' ) ? $data->meta_description : $this->configs->meta_description;
        $seo->meta_keywords = ($data && $data->meta_keywords && $data->meta_keywords != '' ) ? $data->meta_keywords : $this->configs->meta_keywords;
        $this->templates->addData(compact( 'seo'));

    }

    public function getBreadcrumb($data)
    {

        $breadcrumb = new stdClass();
        if($data) {
            $breadcrumb->links = Helper::explode($data->breadcrumbLinks);
            $breadcrumb->titles = Helper::explode($data->breadcrumbTitles);
        }
        $this->templates->addData(compact( 'breadcrumb'));

    }

    public function get_admin()
    {

        $_SESSION['has_access'] = Config::get('ACCESS_TOKEN_ADMIN');
        Header("HTTP/1.1 301 Moved Permanently");
        Header('Location: /admin');
        exit();

    }

    public function is_admin()
    {

        if(isset($_SESSION['has_access']) && $_SESSION['has_access'] == Config::get('ACCESS_TOKEN_ADMIN') && isset($_COOKIE['disable_cdn_caching']) && $_COOKIE['disable_cdn_caching'] == 1){

            return true;

        }

        return false;

    }

    public function get_sh($vars)
    {

        $main = new mainModel();
        $link = $main->getArticleLinkFromId($vars['article_id']);

        if($link) {

            Header("HTTP/1.1 301 Moved Permanently");
            Header('Location: ' . $link[0][0] );
            exit();

        } else {

            Header("HTTP/1.0 404 Not Found");
            echo $this->templates->render('errors/404');
            exit();

        }

    }

    protected function formatValitronErrorsToText($errors = []) {

        $formattedErrors = '';
        foreach ($errors as $errorName) {

            foreach ($errorName as $errorText) {

                $formattedErrors .= "<div>{$errorText}</div>";

            }

        }

        return $formattedErrors;

    }

    protected function formatValitronErrorsToArray($errors = []) {

        $formattedErrors = [];
        foreach ($errors as $errorName) {

            foreach ($errorName as $errorText) {

                $formattedErrors[] = "<div>{$errorText}</div>";

            }

        }

        return $formattedErrors;

    }

    public static function changetoENG($url,$lang){

        if($lang == 'el') {
            $url = '/en' . $url;
        }
        return $url;

    }

    public static function changetoGR($url,$lang){

        $link = explode('/', $url);
        if( $url == '/en'){
            $url = str_replace("en","",$url);
        } else if(($lang == 'en') && $link[1] == 'en'){

            unset ($link[1]);
            $url = implode('/', $link);

        }
        return $url;

    }


}
