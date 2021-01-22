<?php

/* -------------------------------------------------------------------------- */
/*             CLASS ACCESSES USER TABLE OF AVAILABLE SOFTWARE DB             */
/* -------------------------------------------------------------------------- */

    class User
    {
        public function __construct()
        {
            
        }

        /**
         * getUserID(string)
         * Takes only one string parameter which is sent from the checkbox value
         * on the addsoftware page form
         */
        public function getUserID($userType)
        {
            global $wpdb;

            $query = "SELECT user_id id
                        FROM user
                        WHERE user_type = '" . $userType . "'";
            
            $userID = $wpdb->get_results($query);

            return $userID[0]->id;

        }

        /**
         * addSoftwareUser(int, int, int)
         * The parameters for this function are essentially auto populated based
         * on the user's input to add software, along with what is returned from
         * the Software auto-incremented id
         */
        public function addSoftwareUser($eligible, $soft_id, $user_id)
        {
            global $wpdb;

            //Delcare array to store software_user tuple information
            $data = array(
                'su_eligible' => $eligible,
                'soft_id' => $soft_id,
                'user_id' => $user_id
            );

            $wpdb->insert('software_user', $data);

        }
    }



?>