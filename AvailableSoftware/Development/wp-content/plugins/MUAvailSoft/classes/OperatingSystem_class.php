<?php

/* -------------------------------------------------------------------------- */
/*           CLASS TO ADD / QUERY SOFTWARE OPERATING SYSTEMS FROM DB          */
/* -------------------------------------------------------------------------- */

class OperatingSystem
{
    public function __construct()
    {
        
    }

    public function addOperatingSystem($osArray, $soft_id)
    {
        global $wpdb;

        foreach($osArray as $os)
        {
            $data = array(
                'os_id' => $os,
                'soft_id' => $soft_id
            );

            $wpdb->insert('software_platform', $data);
        }
    }
}