<?php

    //Add config class autoloader dependency
    require_once(__DIR__ . '/../../config/config.php');

    /** 
     * Ajax handler to process the department entered by the user adding /
     * editing software package(s). Queries DB to ensure a valid dept
     * name exists.
     */
    function check_department()
    {
        //Response array to return to client
        $response = [];

        

        $check = $_GET['data'];

        $checkDept = new Department();
        
        $result = $checkDept->getDepartment($check);
        
        if(!empty($result)) {
            $response['success'] = "true";
            $response['id'] = $result[0]->dept_id;
            $response['name'] = $result[0]->dept_name;
        }
        else {
            $response['success'] = "false";
            $response['message'] = "No department by that name.";
        }

        echo json_encode($response);

        wp_die();
    }

    add_action('wp_ajax_check_department', 'check_department');


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

        $department = new Department();

        $department->addDepartment($deptArray, $softID);


        //WP Ajax calls require wp_die() at end of function
        $response['success'] = true;
        $response['message'] = "Software package added";

        echo json_encode($response);

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
/*                       FETCH SELECTED SOFTWARE PACKAGE                       */
/* -------------------------------------------------------------------------- */

    /**
     * Function acts as ajax handler to query DB for selected software
     * package the user wants to edit. Takes the software ID and brings
     * back all associated data for altering.
     */

     function fetch_software_package()
     {
        $package = $_REQUEST['data'];

        $software = new Software();

        $results = $software->getAllSoftDetails($package);

        echo json_encode($results);

        wp_die();
     }

     add_action('wp_ajax_fetch_software_package', 'fetch_software_package');


/* -------------------------------------------------------------------------- */
/*                             SAVE SOFTWARE EDITS                            */
/* -------------------------------------------------------------------------- */

     /**
      * Function acts as ajax handler to apply changes to software package
      * from editing and update all related fields in database.
      */

      function save_software_edits()
      {
          $package = $_POST['data'];

          //Taking the easy route and just deleting the package vs checking
          //comparing edits to what's in DB tables. I came up with some solutions
          //to this problem, but the implementation will probably take a good 8 hours.
          //Deleting the software id and inserting the new info will take less time

          $softID = $package['id'];
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

          $sftware = new Software();

          //Remove the software so we can insert updated data.
          $result = $sftware->removeSoftware($softID);

          echo json_encode($result);
          wp_die();
      }

      add_action('wp_ajax_save_software_edits', 'save_software_edits');



?>