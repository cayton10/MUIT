<?php

/* -------------------------------------------------------------------------- */
/*              SMART SEARCH CLASS ACCESSES KEYWORDS IN DB TABLES             */
/* Required jQuery to make function work is under "SMART SEARCH" comment in   */
/* adminjs.js file in the "admin" directory for this plugin.
/* -------------------------------------------------------------------------- */

    class SmartSearch
    {
        public function __construct()
        {
            
        }

        public function SearchString($dataField, $str)
        {
            global $wpdb;

            //WPDB doesn't automatically escape for strings so...
            $wild = '%';
            $secStr = $wild . $wpdb->esc_like($str) . $wild;

            $table = "";
            $field = "";
            //Set up logic here
            if($dataField == "terms")
            {
                $table = "search_terms";
                $field = "search_term";
            }
            else if($dataField == "alts")
            {
                $table = "soft_alternative";
                $field = "alt_name";
            }
            else if($dataField == "departments")
            {
                $table = "department";
                $field = "dept_name";
            }

            $query = "";

            $query = $wpdb->prepare("SELECT $field AS 'keyword'
                                        FROM $table
                                        WHERE $field LIKE %s
                                        ORDER BY $field", array($secStr));

            $results = $wpdb->get_results($query);

            return $results;
        }
    }