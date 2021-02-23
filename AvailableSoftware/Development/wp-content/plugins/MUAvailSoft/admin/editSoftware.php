<?php

    // exit if file is called directly
    if( ! defined('ABSPATH')) 
    {
        exit;
    }


    // display the plugin settings page
    function muavailsoft_edit_software() {
        
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
                        $output .= "<option value='" . $item->soft_id . "'>" . $item->soft_company . " - " . $item->soft_name . "</option>";
                    }

                    echo $output;
                ?>

                </select>
            </div>
            <div id='editSoftwareForm'>
                <form action="" method="post" id='addSoftwareForm'>
                    <div class='addSoftwareGrid'>
                    <!-- Software input section -->
                        <div class='softwareGridColumn'>
                            <h2><label for='softwareManufac'>Software Manufacturer</label></h2>
                                <input id='softwareManufacturer' class='softwareInput' placeholder='I.E. Microsoft, Adobe, etc.' type='text' spellcheck='true' required></input>
                            <h2><label for='softwareName'>Software Package Name</label></h2>
                                <input id='softwareName' class='softwareInput' placeholder='I.E. Word, Excel, Photoshop' type='text' spellcheck='true' required></input>
                            <h2><label for='softwareCat'>Software Category</label></h2>
                                <input id='softwareCat' class='softwareInput' placeholder='I.E. Antivirus, Word Processor, etc.' type='text' spellcheck="true" required></input>
                            <h2><label for='softwarePrice'>Software Package Price</label></h2>
                                <input id='softwarePrice' class='softwareInput' placeholder='199.99'  step='0.01' type='number' required></input>
                            <h2><label for='softwareDesc'>Software Package Description</label></h2>
                                <textarea id='softwareDesc' class='softwareTextArea' placeholder='Please use manufacturer description of software package.' spellcheck="true" required></textarea>
                            <h2><label for='softwareDownload'>Software Download Location</label></h2>
                                <input id='softwareDownload' class='softwareInput' placeholder='https://portal.azure.com/?Microsoft_Azure_Education_correlationId=22e80e44-4b74-411b-9593-69e7ed40fc2f' type='url'></input>
                                <input type='submit' class='button-primary' id='submitAddSoftware'></input>
                        </div>

                    <!-- User information section -->
                        <div class='userGridColumn'>
                            <h2><label for='userAvailability'>Available to Users</label></h2>
                                <div id='userCheckBoxes' class='userCheckBoxes'>

                                    <input type='checkbox' id='allUsers' name='allUsers' value='all' class='userCheck'>
                                    <label for='allUsers'>All Users</label><br>

                                    <input type='checkbox' id='studentUsers' name='studentUsers' value='student' class='userCheck'>
                                    <label for='studentUsers'>Students</label><br>

                                    <input type='checkbox' id='facultyUsers' name='facultyUsers' value='faculty' class='userCheck'>
                                    <label for='facultyUsers'>Faculty</label><br>

                                    <input type='checkbox' id='staffUsers' name='staffUsers' value='staff' class='userCheck'>
                                    <label for='staffUsers'>Staff</label><br>

                                </div>

                    <!-- Alternatives to Software Entered -->
                            <h2><label for='softwareAlternatives'>Software Package Alternatives<label></h2>
                                <div class='alternativeFields' id='alternativeFields'>
                                    <input type='text' id='softwareAlternatives' placeholder="Ex: Google Sheets" class='softwareInput'>
                                    <button type='button' class='button-primary' id='addAlternative'>Add</button>
                                    <div>
                                        <ul id='alternativeList'></ul>
                                    </div>
                                </div>
                            
                    <!-- Operating System Section -->
                            <h2><label for='operatingSystem'>Operating System</label></h2>
                                <div class='osSection' id='osCheckBoxes'>

                                    <input type='checkbox' id='windows' name='windows' value='1'>
                                    <label for='windows'>Windows</label><br>

                                    <input type='checkbox' id='mac' name='mac' value='2'>
                                    <label for='mac'>MacOS</label><br>

                                    <input type='checkbox' id='linux' name='linux' value='3'>
                                    <label for='linux'>Linux</label><br>

                                    <input type='checkbox' id='ios' name='ios' value='4'>
                                    <label for='ios'>iOS</label><br>

                                    <input type='checkbox' id='android' name='android' value='5'>
                                    <label for='android'>Android</label><br>

                                </div>

                    <!-- Associated Search Terms -->
                            <h2><label for='searchTerms'>Associated Search Terms</label></h2>
                                <div class='searchTermsSection'>
                                    <input type='text' id='searchTerm' placeholder="Ex: Spreadsheets, Word Processor, etc." class='softwareInput'>
                                    <button type='button' class='button-primary' id='addSearchTerm'>Add</button>
                                    <div>
                                        <ul id='searchTermList'></ul>
                                    </div>
                                </div>

                    <!-- Department Testing field -->
                            <h2><label for='departmentField'>Available to Department:<label></h2>
                                <div class='departmentField' id='departmentField'>
                                    <input type='text' id='departmentName' placeholder="Ex: Computer Information Technology" class='softwareInput'>
                                </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
        
        <?php

	
}
?>