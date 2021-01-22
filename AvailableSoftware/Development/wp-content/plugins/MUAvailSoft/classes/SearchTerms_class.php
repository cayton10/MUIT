<?php
/* -------------------------------------------------------------------------- */
/*                             SEARCH TERMS CLASS                             */
/* -------------------------------------------------------------------------- */

    class searchTerms
    {

        public function __construct()
        {
            
        }

        /**
         * addSearchTerm(string, int)
         * Takes string (search term) and int (software ID) and adds info to database
         */
        public function addSearchTerm($term, $soft_id)
        {
            global $wpdb;

            $data = array(

                'search_term' => $term,
                'soft_id' => $soft_id
            );

            $wpdb->insert('search_terms', $data);
        }
    }

?>