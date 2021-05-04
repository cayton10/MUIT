<?php

/* -------------------------------------------------------------------------- */
/*                CLASS TO ADD / RETRIEVE SEARCH TERMS FROM DB                */
/* -------------------------------------------------------------------------- */

class SearchTerm
{
    public function __construct()
    {
        
    }

    /**
     * addSearchTerms(array, int);
     * Adds searching "keywords" associated with specific software packages upon
     * entry
     */
    public function addSearchTerms($termsArray, $soft_id)
    {
        //Declare global wp database accessor
        global $wpdb;

        //Iteratively insert the search terms into the search_terms table
        foreach($termsArray as $term)
        {
            $response = [];
            $data = array(
                'search_term' => $term,
                'soft_id' => $soft_id
            );

            $result = $wpdb->insert('search_terms', $data);

            if($result < 1)
            {
                $response['success'] = false;
                $response['message'] = "Unable to add search term: '" . $term . "' to search_term table.";

                return $response;
            }
        }

        $response['success'] = true;
        $response['message'] = "Search terms added successfully.";

        return $response;

    }
}

?>