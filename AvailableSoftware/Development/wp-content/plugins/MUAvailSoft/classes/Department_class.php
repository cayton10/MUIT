<?php

/* -------------------------------------------------------------------------- */
/*          DEPARTMENT CLASS ADDS / QUERIES DEPT INFORMATION FROM DB          */
/* -------------------------------------------------------------------------- */

class Department
{
    public function __construct()
    {
        
    }

    public function addDepartment($deptName, $soft_id)
    {
        //Declare global wpdb
        global $wpdb;

        //Sort the department array
        sort($deptName);
        $data = [];

        //Search for the department in department table
        foreach($deptName as $dept) 
        {
            $data['dept_id'] = $dept;
            $data['soft_id'] = $soft_id; 
        }

        //Insert loaded array as row in table 'soft_alternative
        $wpdb->insert('dept_software', $data);
    }
    

    public function getDepartment($str)
    {
        global $wpdb;

        $query = '';

        $query = "SELECT * FROM department
                    WHERE dept_name = '" . $str . "'";

        $result = $wpdb->get_results($query);
       
        return $result;
    }
}