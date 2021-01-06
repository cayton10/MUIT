<?php
/**
 * Plugin Name: MU Available Software
 * Plugin Description: Custom WP plugin to display available software packages for Marshall University Students, Faculty, and Staff. References a mySQL Database for dynamic page output. Eliminates need for constant static updating.
 * 
 * Author: Benjamin Cayton - IT Admin, Student Assistant
 * Version: 1.0
 *  
 */

    // exit if file is called directly
    if( ! defined('ABSPATH')) 
    {
        exit;
    }


    echo plugin_dir_path(__FILE__) . 'admin/admin_menu.php';
    // if admin area
    if(is_admin())
    {
        //include dependencies administration dependencies
        require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
        require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
    }

?>
