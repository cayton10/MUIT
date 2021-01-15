<?php

    //Add config class autoloader dependency
    require_once(__DIR__ . '/../../config/config.php');



    /**
     * Function acts as ajax handler to process software added by the admin
     * to the database. Creates objects of all required class functions to 
     * touch appropriate database tables and update as necessary.
     */
    function add_software()
    {
        //Store all data sent from form into variables
        $manu = htmlspecialchars(trim($_POST['manufacturer']));
        $name = htmlspecialchars(trim($_POST['name']));
        $cat = htmlspecialchars(trim($_POST['cat']));
        $price = htmlspecialchars(trim($_POST['price']));
        $desc = htmlspecialchars(trim($_POST['desc']));
        $download = htmlspecialchars(trim($_POST['download']));


        //Instantiate software object
        $soft = new Software();

        //Adds all relevant software information and stores last inserted ID
        $lastID = $soft->addSoftware($manu, $name, $cat, $price, $desc, $download);

        //Instaniate NEXT object
        
        echo json_encode($lastID);

        wp_die();

    }

    add_action('wp_ajax_add_software', 'add_software');

?>