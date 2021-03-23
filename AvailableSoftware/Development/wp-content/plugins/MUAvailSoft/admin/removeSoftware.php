<?php

    // exit if file is called directly
    if( ! defined('ABSPATH')) 
    {
        exit;
    }


    // display the plugin settings page
    function muavailsoft_rm_software() {
        
        // check if user is allowed access
        if ( ! current_user_can( 'manage_options' ) ) return;

        $software = new Software();
        $softList = $software->getSoftwareNames();
        ?>

        
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <div id='softwareSelectDiv' class='softwareEditSelect'>
                <h2><label for='softwareSelect'>Select Software Package to Edit</h2></label>
                <select id='editSelectElement'>
                    <option selected disabled hidden>Select Software</option>
                <!-- select options drawn from database -->
                <?php
                    $output = "";

                    foreach($softList as $item)
                    {
                        $output .= "<option class='editPackage' value='" . $item->soft_id . "'>" . $item->soft_company . " - " . $item->soft_name . "</option>";
                    }

                    echo $output;
                ?>

                </select>
            </div>
            <div id="formSepBanner">
            </div>
            <div>
                <button id="removeSoftwareButton" class='button-primary'>Delete</button>
            </div>
            
        </div>
        
        <?php

	
}
?>