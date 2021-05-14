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
         * alone. I tested these queries with dbDelta every time I added a new one / or did
         * an insert. Hopefully this continues to behave appropriately.
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
                    `dept_id` int NOT NULL AUTO_INCREMENT,
                    `dept_name` varchar(75) NOT NULL,
                    PRIMARY KEY (`dept_id`)
                    ) {$collate};";

        //Check department table for existing values
        $table = "department";
        $key = "dept_id";

        $result = check_table($table, $key);
        
        if(count($result) == 0)
        {
            $sql .= "INSERT INTO `department` (`dept_name`) VALUES ";
            //Read departments from text file in dir and insert them iteratively
            $deptArray = array();

            $fstream = fopen(dirname(__FILE__) . "/departments.txt", "r") or wp_die("Cannot read departments.txt file");
            
            while(($line=fgets($fstream)) !== false) {
                array_push($deptArray, trim($line));
            }

            fclose($fstream);

            for($i = 0; $i < sizeof($deptArray); $i++)
            {
                if($i == sizeof($deptArray) - 1) {
                    $sql .= "('" . $deptArray[$i] . "');";
                }
                else {
                    $sql .= "('" . $deptArray[$i] . "'),";
                }
            }
        }

        //Operating system table creation
        $sql .= "CREATE TABLE `operating_system` (
                    `os_id` int NOT NULL,
                    `os_name` varchar(25) NOT NULL,
                    PRIMARY KEY (`os_id`)
                    ) {$collate};";
        
        $table = "operating_system";
        $key = "os_id";

        //Check if table already has info:
        $result = check_table($table, $key);

        if(count($result) == 0)
        {
            $sql .= "INSERT INTO `operating_system` (`os_id`, `os_name`) VALUES
                    (1, 'Windows 10'),
                    (2, 'MacOSX'),
                    (3, 'Linux'),
                    (4, 'iOS'),
                    (5, 'Android');";
        }

        //User table creation
        $sql .= "CREATE TABLE `user` (
                    `user_id` int NOT NULL,
                    `user_type` varchar(8) NOT NULL,
                    PRIMARY KEY (`user_id`)
                    ) {$collate};";

        $table = "user";
        $key = "user_id";
        $result = check_table($table, $key);

        if(count($result) == 0)
        {
            $sql .= "INSERT INTO `user` (`user_id`, `user_type`) VALUES
                        (1, 'student'),
                        (2, 'faculty'),
                        (3, 'staff'),
                        (4, 'all');";
        }

        //Search terms table creation
        $sql .= "CREATE TABLE `search_terms` (
                    `search_id` int NOT NULL AUTO_INCREMENT,
                    `search_term` varchar(18) NOT NULL,
                    `soft_id` int NOT NULL,
                    PRIMARY KEY (`search_id`)
                ) {$collate}; ";
        //FK Constraints
        $sql .= "ALTER TABLE `search_terms`
                    ADD CONSTRAINT `FK_st_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;";

        
        //Software alternative table creation
        $sql .= "CREATE TABLE `soft_alternative` (
                    `alt_id` int NOT NULL AUTO_INCREMENT,
                    `alt_name` varchar(45) NOT NULL,
                    `soft_id` int NOT NULL,
                    PRIMARY KEY (`alt_id`)
                ) {$collate};";
        //FK Constraints
        $sql .= "ALTER TABLE `soft_alternative`
                    ADD CONSTRAINT `FK_alternative` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                COMMIT;";

        
        //Software user table creation
        $sql .= "CREATE TABLE `software_user` (
                    `su_id` int NOT NULL AUTO_INCREMENT,
                    `su_eligible` tinyint(1) NOT NULL,
                    `soft_id` int NOT NULL,
                    `user_id` int NOT NULL,
                    PRIMARY KEY (`su_id`)
                ) {$collate};";
        //FK Constraints
        $sql .= "ALTER TABLE `software_user`
                    ADD CONSTRAINT `FK_su_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                    ADD CONSTRAINT `FK_su_soft_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                COMMIT;";


        //Department software table creation
        $sql .= "CREATE TABLE `dept_software` (
                    `dept_soft_id` int NOT NULL AUTO_INCREMENT,
                    `dept_id` int NOT NULL,
                    `soft_id` int NOT NULL,
                    PRIMARY KEY (`dept_soft_id`)
                ) {$collate};";
        //FK Constraints
        $sql .= "ALTER TABLE `dept_software`
                    ADD CONSTRAINT `FK_ds_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                    ADD CONSTRAINT `FK_ds_dept_id` FOREIGN KEY (`dept_id`) REFERENCES `department` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                COMMIT;";

        


        //Software platform table creation
        $sql .= "CREATE TABLE `software_platform` (
                    `soft_plat_id` int NOT NULL AUTO_INCREMENT,
                    `os_id` int NOT NULL,
                    `soft_id` int NOT NULL,
                    PRIMARY KEY (`soft_plat_id`)
                ) {$collate};";
        //FK Constraints
        $sql .= "ALTER TABLE `software_platform`
                    ADD CONSTRAINT `FK_sp_os_id` FOREIGN KEY (`os_id`) REFERENCES `operating_system` (`os_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                    ADD CONSTRAINT `FK_sp_soft_id` FOREIGN KEY (`soft_id`) REFERENCES `software` (`soft_id`) ON DELETE CASCADE ON UPDATE CASCADE;
                COMMIT;";

        dbDelta($sql);
    }
    add_action('muplugin_on_activation', 'muplugin_on_activation');


    /**
     * When deactivating in current form, plugin will remove all data associated
     * with the data tables. Keeps db structure.
     */
    function muplugin_on_deactivate() {
        if( ! current_user_can( 'activate_plugins' )) return;

        //Require for dbDelta
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        //Delete info related to plugin db

        global $wpdb;

        $sql = "DROP TABLE dept_software;";
        $sql .= "TRUNCATE TABLE department;";
        
        dbDelta($sql);


    }
    add_action('muplugin_on_deactivate', 'muplugin_on_deactivate');

    /**
     * Self documenting:
     * Run this script on uninstall...
     */
    function muplugin_on_uninstall() {
        if( ! current_user_can( 'activate_plugins')) return;
        
        /* -------------------- REMOVE ALL CREATED PLUGIN TABLES -------------------- */
    }
    add_action('muplugin_on_uninstall', 'muplugin_on_uninstall');




    /**
     * check_table(string, string)
     * Checks provided tablename and key strings for values already entered into the database
     * Couldn't think of a better way to add the data over hardcoding because I'm running
     * out of time.
     */
    function check_table($tableName, $key) {
        global $wpdb;

        $result = $wpdb->get_results("SELECT {$key} FROM {$tableName}
                                        WHERE {$key} IS NOT NULL");

        
        return $result;
    }

    



?>