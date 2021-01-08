<?php

    // exit if file is called directly
    if( ! defined('ABSPATH')) 
    {
        exit;
    }


    // display the plugin settings page
    function muavailsoft_add_software() {
        
        // check if user is allowed access
        if ( ! current_user_can( 'manage_options' ) ) return;
        
        ?>
        
        <div class="wrap">
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
            <form action="softwareData.php" method="post">
                <div class='form-group'>
                    <h2><label for='softManufacturer'>Software Manufacturer</label></h2>
                        <input id='softwareManufacturer' class='softwareInput' placeholder='I.E. Microsoft, Adobe, etc.' required></input>
                    <h2><label for='softwareName'>Software Package Name</label></h2>
                        <input id='softwareName' class='softwareInput' placeholder='I.E. Word, Excel, Photoshop' required></input>
                    <h2><label for='softwareCat'>Software Category</label></h2>
                        <input id='softwareCat' class='softwareInput' placeholder='I.E. Antivirus, Word Processor, etc.' required></input>
                    <h2><label for='softwarePrice'>Software Package Price</label></h2>
                        <input id='softwarePrice' class='softwareInput' placeholder='199.99' type='number'></input>
                    <h2><label for='softwareDesc'>Software Package Description</label></h2>
                        <textarea id='softwareDesc' placeholder='Please use manufacturer description of software package.'></textarea>
                    <h2><label for='softwareDownload'>Software Download Location</label></h2>
                        <input id='softwareDownload' class='softwareInput' placeholder='Preferably a link to download location.'></input>
                        <button type='submit'>Save</button>
                </div>
                
                <?php
                
                // output security fields
                settings_fields( 'muavailsoft_data' );
                
                // output setting sections
                do_settings_sections( 'muavailsoft' );
                
                // submit button
                submit_button();
                
                ?>
                
            </form>
        </div>
        
        <?php
	
}
?>