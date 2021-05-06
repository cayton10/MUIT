<?php

/* -------------------------------------------------------------------------- */
/*                   PLUGIN ACTIVATION / DELETION CALLBACKS                   */
/* -------------------------------------------------------------------------- */


 //Primary function with MUAvailSoft activation is to create our tables for software info
    function muplugin_on_activation() {
        if(! current_user_can( 'activate_plugins' )) return;

        //Require for dbDelta
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        /* ------------------- CREATE ALL REQUIRED DATABASE TABLES ------------------ */
        
        global $wpdb;

        $collate = $wpdb->get_charset_collate();

        /**
         * NOTE: In order to limit the use of dbDelta calls, IF NOT EXISTS cannot be used
         * in these queries. See: https://www.youtube.com/watch?v=QYCQ4HINfRc
         * The only way I've found to create all tables and structures is to use CREATE TABLE
         * alone.
         */

        //Software table creation
        $sql = "CREATE TABLE `software` (
                    `soft_id` int NOT NULL AUTO_INCREMENT,
                    `soft_name` varchar(45) NOT NULL,
                    `soft_company` varchar(45) NOT NULL,
                    `soft_type` varchar(45) NOT NULL,
                    `soft_price` decimal(5, 2) NOT NULL,
                    `soft_description` varchar(2083) NOT NULL,
                    `soft_download` varchar(2083) NOT NULL,
                    PRIMARY KEY (`soft_id`)
                    ) {$collate};";

        //Department table creation
        $sql .= "CREATE TABLE `department` (
                    `dept_id` int NOT NULL,
                    `dept_name` varchar(75) NOT NULL,
                    PRIMARY KEY (`dept_id`)
                    ) {$collate};";

        //Operating system table creation
        $sql .= "CREATE TABLE `operating_system` (
                    `os_id` int NOT NULL,
                    `os_name` varchar(25) NOT NULL,
                    PRIMARY KEY (`os_id`)
                    ) {$collate};";
        
        $table = "operating_system";

        //Check if table already has info:
        $result = check_table($table);

        if(count($result) == 0)
        {
            $sql .= "INSERT INTO `operating_system` (`os_id`, `os_name`) VALUES
                    (1, 'Windows 10'),
                    (2, 'MacOSX'),
                    (3, 'Linux'),
                    (4, 'iOS'),
                    (5, 'Android');";
        }

        dbDelta($sql);
        

    }
    add_action('muplugin_on_activation', 'muplugin_on_activation');

//Remove all tables and information related to plugin on uninstall
    function muplugin_on_uninstall() {
        if( ! current_user_can( 'activate_plugins')) return;
        
        /* -------------------- REMOVE ALL CREATED PLUGIN TABLES -------------------- */
    }
    add_action('muplugin_on_uninstall', 'muplugin_on_uninstall');


    //Check if table is empty
    function check_table($tableName) {
        global $wpdb;

        $result = $wpdb->get_results("SELECT os_id FROM operating_system
                                        WHERE `os_id` IS NOT NULL");
        
        return $result;
    }

    



?>