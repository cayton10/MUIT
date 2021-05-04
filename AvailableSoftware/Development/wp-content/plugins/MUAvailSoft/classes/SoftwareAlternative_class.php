<?php

/* -------------------------------------------------------------------------- */
/*           SOFTWARE ALTERNATIVE CLASS TO ADD / QUERY ALTERNATIVES           */
/* -------------------------------------------------------------------------- */

class SoftwareAlternative
{
    public function __construct()
    {
        
    }

    /**
     * addAlternatives(array, int);
     * Adds software alternatives listed from addSoftware admin tool to
     * Soft_Alternative table in wp database
     */
    public function addAlternatives($alternativesArray, $soft_id)
    {
        $response = [];
        global $wpdb;

        //Iteratively add alternative software name to array for db insertion
        foreach($alternativesArray as $alternative)
        {
            
            $data = array(
                'alt_name' => $alternative,
                'soft_id' => $soft_id
            );

            //Insert loaded array as row in table 'soft_alternative
            $result = $wpdb->insert('soft_alternative', $data);

            if(!$result)
            {
                $response['success'] = false;
                $response['message'] = "Could not add alternative: '" . $alternative . "'";

                return $response;
            }
        }

        $response['success'] = true;
        $response['message'] = "Alternative software added.";

        return $response;
    }
}

?>