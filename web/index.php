<?php

/**
 * Error reporting on front end, active only on development
 * delete on production
 */


$filePath = __DIR__ . '/templates/tmp/';
$myuri = explode('?',$_SERVER['REQUEST_URI'])[0];
$decacheLink=false;
if(isset($_GET['decache'])){
    $decacheLink=true;
}


$fileName = 'cached--' . str_replace(['/','=','?'], ['___','____','____'], $myuri) . '--ibhellas.html';

//$delete = unlink($filePath . $fileName);
//var_dump( $delete ); exit;

function checkIfAdmin(){
    if(isset($_COOKIE['disable_cdn_caching']) && $_COOKIE['disable_cdn_caching']==1 ){
        return true;
    }
    return false;
}


//function checkIfUpdatedByTime($filePath,$fileName){
//    $sql="SELECT udatetime FROM t_content_list WHERE title=? ORDER BY udatetime";
//    $ret = QueryModel::Find_Data($sql,$data["title"]);
//
//    if ($ret->udatetime > filemtime($filePath . $fileName)){
//        true;
//    }else{
//        false;
//    }
//
//
//
//}

function checkFileTime($file){


    $cacheTime = 12 * 60 * 60;
    //$cacheTime = 10;
    $path = explode('?',$_SERVER['REQUEST_URI'])[0];
//    if($path == '/'){
//
//        $cacheTime = 1 * 60;
//    }
//    if(substr($path, 0, strlen('/ajax/get/roi')) === '/ajax/get/roi') {
//        $cacheTime = 1 * 60;
//    }
//    if(substr($path, 0, strlen('/ajax/get/favorites')) === '/ajax/get/favorites') {
//        $cacheTime = 30 * 60;
//    }
//
//    if(substr($path, 0, strlen('/search/')) === '/search/') {
//        $cacheTime = 0;
//    }
//
//    if($path === '/news' || $path === '/news/' . date('d-m-Y') ) {
//        $cacheTime = 1 * 60;
//    }

    return time() - $cacheTime < filemtime($file);
}


//echo filemtime($filePath.$fileName);
//echo "<br>";
//echo time();
//echo $filePath . $fileName;
//exit;

if (!checkIfAdmin() && !$decacheLink && file_exists($filePath . $fileName)
    && checkFileTime($filePath . $fileName) ) {
    $html = file_get_contents($filePath . $fileName);
    echo $html;

} else {

    // $delete = unlink($filePath . $fileName);

    session_start();
    ob_start();

//    if (isset($_COOKIE['debug_mode']) && $_COOKIE['debug_mode'] == 'dev_mode') {
//        echo "<h2>DEBUG MODE</h2><hr>";
//        ini_set('display_errors', 1);
//        ini_set('display_startup_errors', 1);
//        error_reporting(E_ALL);
//    } else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);
//    }
    /**
     * require the composer autoload to load dependencies
     */

    require_once('libs/composer/vendor/autoload.php');

//require_once ('vendor/autoload.php');


    /**
     * require custom autoload to load custom classes
     */

    require_once('configs/autoload.php');

    /**
     * Require the config file where are set all the app configurations
     */

    require('configs/config.php');

    /**
     * configure database connection
     */


//require ('admin/common/common.php');


    /**
     * Set the language of the app based on requested uri
     * We bind the object to the App to use it static wherever we need
     * around the app
     */

    App::bind('Language',
        new Language(
            Config::get('supportedLanguages'),
            Config::get('defaultLanguage')
        )
    );

    require('configs/routes.php');

    /**
     * Create a templates League\Plates\Engine object
     * by passing the Language object into it to use the Language::translate method
     * inside the templates to translate static content
     */

    $templates = TemplatesFactory::create(App::get('Language'));

    $router = new RouteFactory($templates, App::get('Language'));

    $router->getResponse();

    if(!checkIfAdmin() && (strpos($myuri, 'load_more') === false)  ) {

        $cached = fopen($filePath . $fileName, 'w');
        fwrite($cached, ob_get_contents());
        fclose($cached);

    }



    ob_end_flush(); // Send the output to the browser

}