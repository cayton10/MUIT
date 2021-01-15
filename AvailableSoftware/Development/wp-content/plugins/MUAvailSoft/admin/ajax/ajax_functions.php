<?php

    //Add config class autoloader dependency
    require_once(__DIR__ . '/../../config/config.php');



    function add_software()
    {
        //Store all data sent from form into variables
        $manu = htmlspecialchars(trim($_POST['manufacturer']));
        $name = htmlspecialchars(trim($_POST['name']));
        $cat = htmlspecialchars(trim($_POST['cat']));
        $price = htmlspecialchars(trim($_POST['price']));
        $desc = htmlspecialchars(trim($_POST['desc']));
        $download = htmlspecialchars(trim($_POST['download']));


        $soft = new Software();

        $lastID = $soft->addSoftware($manu, $name, $cat, $price, $desc, $download);

        echo json_encode($lastID);

        wp_die();

    }

    add_action('wp_ajax_add_software', 'add_software');

?>