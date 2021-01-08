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
    }


    // register plugin settings
    function myplugin_register_settings() {
        
        /*
        
        register_setting( 
            string   $option_group, 
            string   $option_name, 
            callable $sanitize_callback
        );
        
        */
        
        register_setting( 
            'muavailsoft_data', 
            'myplugin_options', 
            'myplugin_callback_validate_options' 
        );

        /*
	
        add_settings_section( 
            string   $id, 
            string   $title, 
            callable $callback, 
            string   $page
        );
        
        */
        
        add_settings_section( 
            'myplugin_section_login', 
            'Add Software Package', 
            'myplugin_callback_section_login', 
            'muavailsoft'
        );
        
        add_settings_section( 
            'myplugin_section_admin', 
            'Remove Softare Package', 
            'myplugin_callback_section_admin', 
            'muavailsoft'
        );

    }
    add_action( 'admin_init', 'myplugin_register_settings' );


    // validate plugin settings
    function myplugin_validate_options($input) {
        
        // todo: add validation functionality..
        
        return $input;
        
    }

    // callback: login section
    function myplugin_callback_section_login() {
        
        echo '<p>These settings enable you to customize the WP Login screen.</p>';
        
    }



    // callback: admin section
    function myplugin_callback_section_admin() {
        
        echo '<p>These settings enable you to customize the WP Admin Area.</p>';
        
    }


    /**
     * Add custom css stylesheet to plugin admin page
     */

    function wpdocs_enqueue_custom_admin_style() {
        wp_register_style( 'custom_wp_admin_css', plugin_dir_url( __FILE__ ) . 'admin/css/adminStyle.css');
        wp_enqueue_style( 'custom_wp_admin_css' );
        //From Google's jQuery CDN
        wp_register_script( 'custom_wp_admin_jquery' , 'https://ajax.googleapis.com/ajax/libs/d3js/6.3.1/d3.min.js');
        wp_enqueue_script( 'custom_wp_admin_jquery' );
        //Custom js
        wp_register_script( 'custom_wp_admin_js', plugin_dir_url( __FILE__ ) . 'admin/js/adminjs.js');
        wp_enqueue_script( 'custom_wp_admin_js');
        
        
    }

    add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style');

    /**
     * Add Google's jQuery CDN
     */

    /*add_action('init', 'use_jquery_from_google');

    function use_jquery_from_google () {
        if (is_admin()) {
            return;
        }
    
        global $wp_scripts;
        if (isset($wp_scripts->registered['jquery']->ver)) {
            $ver = $wp_scripts->registered['jquery']->ver;
                    $ver = str_replace("-wp", "", $ver);
        } else {
            $ver = '1.12.4';
        }
    
        wp_deregister_script('jquery');
        wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver);
    }*/

?>
