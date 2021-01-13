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


        /**
         * addSoftware(string, string, string, double, string, string);
         * Takes 6 parameters and returns the auto incremented id after adding the software
         * package to DB.
         * 
         * Ex:
         *      soft = software->addSoftware(manufacturer, name, category, price, description, location)
         */
        public function addSoftware($manu, $name, $cat, $price, $desc, $location)
    }

?>