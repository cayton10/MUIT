<?php // MUAvailSoft - Admin Menu

    // exit if file is called directly
    if( ! defined('ABSPATH')) 
    {
        exit;
    }

    // add top-level administrative menu
    function muavailsoft_add_toplevel_menu() {
        
        /* 
            add_menu_page(
                string   $page_title, 
                string   $menu_title, 
                string   $capability, 
                string   $menu_slug, 
                callable $function = '', 
                string   $icon_url = '', 
                int      $position = null 
            )
        */
        
        add_menu_page(
            'MU Available Software Settings',
            'MUAvailSoft',
            'manage_options',
            'MUAvailSoft',
            'muavailsoft_display_settings_page',
            'dashicons-database-view',
            null
        );


        /*
            add_submenu_page
                string      $parent_slug,
                string      $page_title,
                string      $menu_title,
                string      $capability,
                string      $menu_slug,
                callable    $function = ''
        */

        /**
         * Add software menu page
         */

        add_submenu_page(
            'MUAvailSoft', //Parent slug
            'Add Software Package', //page title
            'Add Software', //menu title
            'manage_options', //capability
            'AddSoftware', //menu slug
            'muavailsoft_add_software'
        );

        /**
         * Edit software menu page
         */

        add_submenu_page(
            'MUAvailSoft',
            'Edit Software Package',
            'Edit Software',
            'manage_options',
            'EditSoftware',
            'muavailsoft_edit_software'
        );

        /**
         * Remove software menu page
         */

        add_submenu_page(
            'MUAvailSoft',
            'Remove Software Package',
            'Remove Software',
            'manage_options',
            'RemoveSoftware',
            'muavailsoft_rm_software'
        );
        
    }
    add_action( 'admin_menu', 'muavailsoft_add_toplevel_menu' );


?>