<?php

/* -------------------------------------------------------------------------- */
/*                CLASS ACCESSES SOFTWARE TABLE OF WP DATABASE                */
/* -------------------------------------------------------------------------- */

    class Software extends DB
    {
        //Construct the parent database class so we can access its' functions
        public function __construct()
        {
            parent::__construct();
        }

        

        //Test function to grab all software dummy data
        public function getSoftware()
        {
            $query = "";

            $query = "SELECT *
                        FROM software";
            
            $results = $this->get_results($query);

            return $results;
        }
    }

?>