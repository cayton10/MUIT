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
        $response = [];
        //Declare global wpdb
        global $wpdb;

        //Sort the department array
        sort($deptName);
        $data = [];

        //Search for the department in department table
        foreach($deptName as $dept) 
        {
            $data = array(
                'dept_id' => $dept,
                'soft_id' => $soft_id,
            ); 

            //Insert loaded array as row in table 'soft_alternative
            $confirm = $wpdb->insert('dept_software', $data);

            if($confirm < 1)
            {
                $response['success'] = false;
                $response['message'] = "Could not add department id: '" . $dept . "'";

                return $response;
            }
        }

        $response['success'] = true;
        $response['message'] = "Department ids successfully added.";

        return $response;
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