<?php

/* -------------------------------------------------------------------------- */
/*          DEPARTMENT CLASS ADDS / QUERIES DEPT INFORMATION FROM DB          */
/* -------------------------------------------------------------------------- */

class Department
{
    public function __construct()
    {
        
    }

    /*public function addDepartment($deptName, $soft_id)
    {
        //Declare global wpdb
        global $wpdb;

        //Sort the department array
        sort($deptName);

        //Search for the department in department table
        foreach()
    }
    */

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

        $query = "";

        $query = $wpdb->prepare("SELECT $field AS 'keyword'
                                    FROM $table
                                    WHERE $field LIKE %s
                                    ORDER BY $field", array($secStr));

        $results = $wpdb->get_results($query);

        return $results;
    }
}