<?php

    //REQUIRE WP-CONFIG FILE TO GET DB CONSTANTS
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
    
    define('PATH_TO_CLASSES', dirname(__DIR__) . '/classes/');
    
    spl_autoload_register(function($class) {

        
        $filePathName = PATH_TO_CLASSES . $class . '_class.php';

        //Error handling to not go running for all classes across WP installation
        if(file_exists($filePathName))
        {
            include $filePathName;
        }
        
    });
?>