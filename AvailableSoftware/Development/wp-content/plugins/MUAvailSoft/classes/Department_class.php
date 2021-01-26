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

        //Search for the department in department table
        foreach()
    }
}