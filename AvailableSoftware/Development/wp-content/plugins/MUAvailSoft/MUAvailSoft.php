<?php
/**
 * Plugin Name: MU Available Software
 * Description: Custom WP plugin to display available software packages for Marshall University Students, Faculty, and Staff. Also includes ability for admin to add/remove software packages and associated information from the WP admin page. Eliminates need for constant static updating.
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



    // if admin area
    if(is_admin())
    {
        //include dependencies administration dependencies
        require_once plugin_dir_path( __FILE__ ) . 'admin/admin-menu.php';
        require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
        require_once plugin_dir_path( __FILE__ ) . 'admin/addSoftware.php';
        require_once plugin_dir_path( __FILE__ ) . 'config/config.php'; //For touching DB
        //Include dependency for ajax handler functions
        require_once plugin_dir_path( __FILE__ ) . 'admin/ajax/ajax_functions.php';
    }






    /**
     * Must register style sheets and scripts to be inserted into the WP Admin header
     * This should only take effect on the MUAvailSoft admin pages.
     * Registration works as anticipated, by registering the stylesheet / script with the WP admin file structure
     * Enqueue actually inserts the url or file path into the HTML head section of the WP admin page.
     */

    function wpdocs_enqueue_custom_admin_style() {

        //Prevents css from caching
        $rand = rand(1, 999999999999);
        //Adds style sheet
        wp_register_style( 'custom_wp_admin_css', plugin_dir_url( __FILE__ ) . 'admin/css/adminStyle.css');
        wp_enqueue_style( 'custom_wp_admin_css', get_stylesheet_uri(), '', $rand );

        //Custom js
        wp_register_script( 'custom_wp_admin_js', plugin_dir_url( __FILE__ ) . 'admin/js/adminjs.js');
        wp_enqueue_script( 'custom_wp_admin_js');
        
    }

    //Hook to implement adding scripts and styles to admin page.

    add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style');


?>
