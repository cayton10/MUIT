<?php

/* -------------------------------------------------------------------------- */
/*                   PLUGIN ACTIVATION / DELETION CALLBACKS                   */
/* -------------------------------------------------------------------------- */


 //Primary function with MUAvailSoft activation is to create our tables for software info
    function muplugin_on_activation() {
        if(! current_user_can( 'activate_plugins' )) return;

        /* ------------------- CREATE ALL REQUIRED DATABASE TABLES ------------------ */        

    }
    add_action('muplugin_on_activation', 'muplugin_on_activation');

//Remove all tables and information related to plugin on uninstall
    function muplugin_on_uninstall() {
        if( ! current_user_can( 'activate_plugins')) return;
        
        /* -------------------- REMOVE ALL CREATED PLUGIN TABLES -------------------- */
    }
    add_action('muplugin_on_uninstall', 'muplugin_on_uninstall');

    



?>