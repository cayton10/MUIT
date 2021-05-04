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
        $response = [];
        global $wpdb;

        foreach($osArray as $os)
        {
            $data = array(
                'os_id' => $os,
                'soft_id' => $soft_id
            );

            $result = $wpdb->insert('software_platform', $data);

            if($result < 1)
            {
                $response['success'] = false;
                $response['message'] = "Could not add operating system id: '" . $os . "'";

                return $response;
            }
        }

        $response['success'] = true;
        $response['message'] = "Operating system info added successfully.";

        return $response;
    }
}