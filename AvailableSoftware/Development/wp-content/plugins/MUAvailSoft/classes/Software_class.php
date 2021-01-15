<?php

/* -------------------------------------------------------------------------- */
/*                CLASS ACCESSES SOFTWARE TABLE OF WP DATABASE                */
/* -------------------------------------------------------------------------- */
    

    class Software 
    {
        //Construct the parent database class so we can access its' functions
        public function __construct()
        {
            
        }

        

        //Test function to grab all software dummy data
        public function getSoftware()
        {
            //Declare global wordpress database class
            global $wpdb;

            $query = "";

            $query = "SELECT *
                        FROM software";
            
            $results = $wpdb->get_results($query);

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
        {
            
        }
    }

?>