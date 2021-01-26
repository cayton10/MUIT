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

        $package = $_POST['data'];
        //print_r($package);

        $software = $package['software'];
        $users = $package['users'];
        $terms = $package['searchTerms'];
        $alts = $package['alternatives'];
        $osArray = $package['os'];


        
        //Store all data sent from form into variables
        $manu = htmlspecialchars(trim($software['manu']));
        $name = htmlspecialchars(trim($software['name']));
        $cat = htmlspecialchars(trim($software['cat']));
        $price = htmlspecialchars(trim($software['price']));
        $desc = htmlspecialchars(trim($software['desc']));
        $download = htmlspecialchars(trim($software['download']));

/* --------------------------- ADD SOFTWARE TO DB --------------------------- */
        
        //Instantiate software object
        $soft = new Software();

        //Adds all relevant software information and stores last inserted ID
        $softID = $soft->addSoftware($manu, $name, $cat, $price, $desc, $download);

/* ------------------------- ADD SOFTWARE_USER TO DB ------------------------ */
        
        //Instaniate object of User class
        $user = new User();

        foreach($users as $key => $value)
        {
            //Get the appropriate userID value from the userType string
            $userID = $user->getUserID($value);
            
            //Insert the record for software_user table
            $user->addSoftwareUser(1, $softID, $userID);
        }
        
/* ------------------------- ADD SEARCH TERMS TO DB ------------------------- */
        
        //Control flow for !empty, being that user's aren't necessarily required
        //To enter information for search terms
        if(!empty($terms))
        {
            $addTerm = new SearchTerm();
            
            $addTerm->addSearchTerms($terms, $softID);
        }

/* ------------------ ADD ALTERNATIVE SOFTWARE NAMES TO DB ------------------ */

        if(!empty($alts))
        {
            $addAlt = new SoftwareAlternative();

            $addAlt->addAlternatives($alts, $softID);
        }

/* ---------------------- ADD OPERATING SYSTEM(S) TO DB --------------------- */

        $operSystem = new OperatingSystem();

        $operSystem->addOperatingSystem($osArray, $softID);


        //WP Ajax calls require wp_die() at end of function
        wp_die();

    }

    add_action('wp_ajax_add_software', 'add_software');

?>