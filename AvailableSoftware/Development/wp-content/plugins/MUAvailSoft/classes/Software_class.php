<?php

/* -------------------------------------------------------------------------- */
/*                CLASS ACCESSES SOFTWARE TABLE OF WP DATABASE                */
/* -------------------------------------------------------------------------- */
    

    class Software 
    {
        
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
         * getSoftwareNames();
         * Takes no parameters. Returns the names of all software packages in the
         * software table
         */
        public function getSoftwareNames()
        {
            global $wpdb;
            $query = "";

            $query = "SELECT soft_id, soft_company, soft_name
                        FROM software
                        ORDER BY soft_company";
            
            $results = $wpdb->get_results($query);
            return $results;
        }

        /**
         * checkDuplicate($name, $company);
         * Takes two string parameters. Checks if software company and name have already
         * been added to the DB for single row
         */
        public function checkDuplicate($manu, $name)
        {
            global $wpdb;
            $wild = '%';
            $secName = $wild . $wpdb->esc_like($name) . $wild;
            $secManu = $wild . $wpdb->esc_like($manu) . $wild;

            $query = "";

            $query = $wpdb->prepare("SELECT COUNT(soft_id) AS duplicates 
                                        FROM software
                                        WHERE soft_company LIKE %s 
                                        AND soft_name LIKE %s", array($secManu, $secName));

            $results = $wpdb->get_results($query);

            //Return the number of duplicate entries for entered software
            return $results[0]->duplicates;
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
            //Declare global wordpress database class var
            global $wpdb;

            $data = array(
                'soft_name' => $name,
                'soft_company' => $manu,
                'soft_type' => $cat,
                'soft_price' => $price,
                'soft_description' => $desc,
                'soft_download' => $location
            );

            //Insert the software package
            $wpdb->insert('software', $data);

            //Return last auto-incremented ID for further data table input
            $lastID = $wpdb->insert_id;

            return $lastID;
        }
    }

?>