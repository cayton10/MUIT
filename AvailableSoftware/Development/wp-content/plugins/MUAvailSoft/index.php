<?php

    require_once('includes/header.php');
    
    $soft = new Software();

    $software = $soft->getSoftware();


    //Software information output variable
    $output = "";
    
    
    foreach($software as $package)
    {
        print_r($package);
    }
    
?>