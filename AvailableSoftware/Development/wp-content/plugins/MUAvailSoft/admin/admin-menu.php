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
        
    }
    add_action( 'admin_menu', 'muavailsoft_add_toplevel_menu' );


?>