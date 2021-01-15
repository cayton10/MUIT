<?php

    //REQUIRE WP-CONFIG FILE TO GET DB CONSTANTS
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-config.php');
    
    //CREATE DB CONNECTION
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    mysqli_select_db($connection, DB_NAME);
   
    define('DISPLAY_DEBUG', true);
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