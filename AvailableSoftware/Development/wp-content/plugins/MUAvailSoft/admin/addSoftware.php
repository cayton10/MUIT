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
            <form action="" method="post" id='addSoftwareForm'>
                <div class='addSoftwareGrid'>
                <!-- Software input section -->
                    <div class='softwareGridColumn'>
                        <h2><label for='softwareManufac'>Software Manufacturer</label></h2>
                            <input id='softwareManufacturer' class='softwareInput' placeholder='I.E. Microsoft, Adobe, etc.' required></input>
                        <h2><label for='softwareName'>Software Package Name</label></h2>
                            <input id='softwareName' class='softwareInput' placeholder='I.E. Word, Excel, Photoshop' required></input>
                        <h2><label for='softwareCat'>Software Category</label></h2>
                            <input id='softwareCat' class='softwareInput' placeholder='I.E. Antivirus, Word Processor, etc.' required></input>
                        <h2><label for='softwarePrice'>Software Package Price</label></h2>
                            <input id='softwarePrice' class='softwareInput' placeholder='199.99' type='number'></input>
                        <h2><label for='softwareDesc'>Software Package Description</label></h2>
                            <textarea id='softwareDesc' class='softwareTextArea' placeholder='Please use manufacturer description of software package.'></textarea>
                        <h2><label for='softwareDownload'>Software Download Location</label></h2>
                            <input id='softwareDownload' class='softwareInput' placeholder='Preferably a link to download location.'></input>
                            <input type='submit' id='submitAddSoftware'></input>
                    </div>

                <!-- User information section -->
                    <div class='userGridColumn'>
                        <h2><label for='userAvailability'>Available to Users</label></h2>
                            <div id='userCheckBoxes' class='userCheckBoxes'>
                                <input type='checkbox' id='allUsers' name='allUsers' value='All'>
                                <label for='allUsers'>All Users</label><br>
                                <input type='checkbox' id='studentUsers' name='studentUsers' value='Students'>
                                <label for='studentUsers'>Students</label><br>
                                <input type='checkbox' id='facultyUsers' name='facultyUsers' value='Faculty'>
                                <label for='facultyUsers'>Faculty</label><br>
                                <input type='checkbox' id='staffUsers' name='staffUsers' value='Staff'>
                                <label for='staffUsers'>Staff</label><br>
                            </div>

                        <h2><label for='softwareAlternatives'>Software Package Alternatives<label></h2>
                            <div class='alternativeFields' id='alternativeFields'>
                                <input type
                            </div>
                    </div>
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