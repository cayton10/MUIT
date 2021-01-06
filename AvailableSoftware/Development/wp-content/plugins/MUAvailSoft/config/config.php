<?php
//CREATE DB CONNECTION
    define('DB_HOST', 'db:3306');
    define('DB_USER', 'wordpress');
    define('DB_PASS', 'wordpress');
    define('DB_NAME', 'wordpress');

    define('DISPLAY_DEBUG', true);
    define('PATH_TO_CLASSES', dirname(__DIR__) . '/classes/');
    // PHP 7 way to do autoload of classes
    spl_autoload_register(function($class)
    {
        include PATH_TO_CLASSES . $class . '_class.php';
    });

?>