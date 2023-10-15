<?php

spl_autoload_register(function ($className) {

    $basePath = $_SERVER['DOCUMENT_ROOT'];

    if ( file_exists("{$basePath}/libs/{$className}.class.php") ) {

        require_once ("{$basePath}/libs/{$className}.class.php");

    }
    elseif ( file_exists("{$basePath}/controllers/site/{$className}.php") ) {

        require_once ("{$basePath}/controllers/site/{$className}.php");

    }
    elseif ( file_exists("{$basePath}/controllers/{$className}.php") ) {

        require_once ("{$basePath}/controllers/{$className}.php");

    }
    elseif ( file_exists("{$basePath}/models/{$className}.php") ) {

        require_once ("{$basePath}/models/{$className}.php");

    }
    elseif ( file_exists("{$basePath}/models/site/{$className}.php") ) {

        require_once ("{$basePath}/models/site/{$className}.php");

    }
    else {

        var_dump($className);

        throw new Exception("Class: {$className} does not exist to specified directories :

        {$basePath}/libs/{$className}.class.php |||

        {$basePath}/controllers/{$className}.php  |||
        
        {$basePath}/controllers/site/{$className}.php  |||
        
        {$basePath}/models/{$className}.php

        ");

    }


});