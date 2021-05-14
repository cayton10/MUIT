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

            $query = "";

            $query = $wpdb->prepare("SELECT COUNT(soft_id) AS duplicates 
                                        FROM software
                                        WHERE soft_company = %s
                                        AND soft_name = %s", array($manu, $name));

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
                'soft_description' => stripslashes($desc),
                'soft_download' => $location
            );

            //Escape special character for sanitization
            $wpdb->escape($data);
            //Insert the software package
            $wpdb->insert('software', $data);

            //Return last auto-incremented ID for further data table input
            $lastID = $wpdb->insert_id;


            return $lastID;
        }

        /**
         * getAllSoftDetails(int);
         * Takes one integer parameter (soft_id) to return all associated information
         * related to that specific software package. Requires multiple queries
         */
        public function getAllSoftDetails($soft_id)
        {
            //Declare global wp database
            global $wpdb;

            $results = [];

            //Construct query #1 to return base software information
            $query = "";

            $query = "SELECT soft_name, soft_company, soft_type, soft_price, soft_description, soft_download
                        FROM software
                        WHERE soft_id = $soft_id";

            $results['soft_package'] = $wpdb->get_results($query);

            //Construct query #2 for user information
            $query = "SELECT user_type
                        FROM user t1
                        LEFT JOIN software_user t2 ON t1.user_id = t2.user_id
                        WHERE t2.soft_id = $soft_id";
            $results['user_info'] = $wpdb->get_results($query);

            //Construct query #3 for software alternatives
            $query = "SELECT alt_name
                        FROM soft_alternative
                        WHERE soft_id = $soft_id";
            $results['soft_alts'] = $wpdb->get_results($query);

            //Construct query #4 for operating system info
            $query = "SELECT t1.os_id
                        FROM operating_system t1
                        LEFT JOIN software_platform t2 ON t1.os_id = t2.os_id
                        WHERE t2.soft_id = $soft_id";
            $results['operating_sys'] = $wpdb->get_results($query);

            //Construct query #5 for search terms info
            $query = "SELECT search_term
                        FROM search_terms
                        WHERE soft_id = $soft_id";
            $results['search_terms'] = $wpdb->get_results($query);

            //Construct query #5 for department availability
            $query = "SELECT t1.dept_id, t1.dept_name
                        FROM department t1
                        LEFT JOIN dept_software t2 ON t1.dept_id = t2.dept_id
                        WHERE t2.soft_id = $soft_id";
            $results['departments'] = $wpdb->get_results($query);

            return $results;
        }

        /**
         * Takes no parameters
         * Returns basic software information for users to view.
         */
        public function getAllSoftware()
        {
            global $wpdb;
            $query = "";
            $query = "SELECT * FROM software";
            $result = $wpdb->get_results($query);

            return $result;
        }


        /**
         * removeSoftware(int);
         * Takes one parameter (soft_id) and deletes all records associated with
         * specified software package. Database design cascades deletion of records,
         * so a simple delete record for software table will propagate to all related
         * tables.
         */
        public function removeSoftware($soft_id)
        {
            //Declare global wp database
            global $wpdb;

            $query = "";

            $query = "DELETE FROM software WHERE soft_id = $soft_id";

            //WPDB auto returns the number of affected rows
            $result = $wpdb->query($query);

            return $result;
        }
    }

?>