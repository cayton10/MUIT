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

        //Response array for user update
        $response = [];

        $package = $_POST['data'];

        $software = $package['software'];
        $users = $package['users'];
        $terms = $package['searchTerms'];
        $alts = $package['alternatives'];
        $osArray = $package['os'];
        $deptArray = $package['department'];


        
        //Store all data sent from form into variables
        $manu = htmlspecialchars(trim($software['manu']));
        $name = htmlspecialchars(trim($software['name']));
        $cat = htmlspecialchars(trim($software['cat']));
        $price = htmlspecialchars(trim($software['price']));
        $desc = htmlspecialchars(trim($software['desc']));
        $download = htmlspecialchars(trim($software['download']));

/* ---------------------- CHECK FOR SOFTWARE DUPLICATE ---------------------- */
        
        //Instantiate software object
        $soft = new Software();

        $result = $soft->checkDuplicate($manu, $name);

        if($result > 0)
        {
            $response['success'] = false;
            $response['message'] = "A package with that name already exists. Do you want to edit?";
            echo json_encode($response);
            wp_die();
        }

/* --------------------------- ADD SOFTWARE TO DB --------------------------- */
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

/* ---------------- ADD DEPARTMENT AVAILABILITY INFO (BRIDGE) --------------- */

        //$department = new Department();

        //$department->addDepartment($deptArray, $softID);


        //WP Ajax calls require wp_die() at end of function
        wp_die();

    }

    add_action('wp_ajax_add_software', 'add_software');


/* -------------------------------------------------------------------------- */
/*                  SMART SEARCH FUNCTIONALITY ON DATA ENTRY                  */
/* -------------------------------------------------------------------------- */

    /**
     * Function acts as ajax handler to query DB for data input fields
     * Instantiates object of SmartSearch class to query appropriate table
     * based on passed args
     */

    function smart_search()
    {

        $package = $_REQUEST['data'];

        $fieldType = $package['dataField'];
        $keyWord = htmlspecialchars(trim($package['keyWord']));


        $search = new SmartSearch();

        $result = $search->SearchString($fieldType, $keyWord);

        echo json_encode($result);

        wp_die();
    }

    add_action('wp_ajax_smart_search', 'smart_search');


/* -------------------------------------------------------------------------- */
/*                       EDIT SELECTED SOFTWARE PACKAGE                       */
/* -------------------------------------------------------------------------- */

    /**
     * Function acts as ajax handler to query DB for selected software
     * package the user wants to edit. Takes the software ID and brings
     * back all associated data for altering.
     */

     function edit_software_package()
     {
        $package = $_REQUEST['data'];

        $softID = $package['id'];

        $software = new Software();

        $results = $software->getAllSoftDetails($softID);

        echo json_encode($results);

        wp_die();
     }

     add_action('wp_ajax_edit_software_package', 'edit_software_package');

?>