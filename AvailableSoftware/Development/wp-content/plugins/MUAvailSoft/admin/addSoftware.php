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
                            <input id='softwareManufacturer' class='softwareInput' placeholder='I.E. Microsoft, Adobe, etc.' type='text'></input>
                        <h2><label for='softwareName'>Software Package Name</label></h2>
                            <input id='softwareName' class='softwareInput' placeholder='I.E. Word, Excel, Photoshop' type='text'></input>
                        <h2><label for='softwareCat'>Software Category</label></h2>
                            <input id='softwareCat' class='softwareInput' placeholder='I.E. Antivirus, Word Processor, etc.' type='text'></input>
                        <h2><label for='softwarePrice'>Software Package Price</label></h2>
                            <input id='softwarePrice' class='softwareInput' placeholder='199.99'  step='0.01' type='number'></input>
                        <h2><label for='softwareDesc'>Software Package Description</label></h2>
                            <textarea id='softwareDesc' class='softwareTextArea' placeholder='Please use manufacturer description of software package.'></textarea>
                        <h2><label for='softwareDownload'>Software Download Location</label></h2>
                            <input id='softwareDownload' class='softwareInput' placeholder='Preferably a link to download location.' type='text'></input>
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
                                <input type='text' id='softwareAlternatives' placeholder="Ex: Google Sheets" class='softwareInput smartField' autocomplete='off' data-fieldType="alts">
                                <div class='smartResults'></div>
                                <button type='button' class='button-primary' id='addAlternative'>Add</button>
                                <div>
                                    <ul id='alternativeList'></ul>
                                </div>
                            </div>
                        
                <!-- Operating System Section -->
                        <h2><label for='operatingSystem'>Operating System</label></h2>
                            <div class='osSection' id='osCheckBoxes'>

                                <input type='checkbox' id='windows' name='windows' value='1' class='osCheck'>
                                <label for='windows'>Windows</label><br>

                                <input type='checkbox' id='mac' name='mac' value='2' class='osCheck'>
                                <label for='mac'>MacOS</label><br>

                                <input type='checkbox' id='linux' name='linux' value='3' class='osCheck'>
                                <label for='linux'>Linux</label><br>

                                <input type='checkbox' id='ios' name='ios' value='4' class='osCheck'>
                                <label for='ios'>iOS</label><br>

                                <input type='checkbox' id='android' name='android' value='5' class='osCheck'>
                                <label for='android'>Android</label><br>

                            </div>

                <!-- Associated Search Terms -->
                        <h2><label for='searchTerms'>Associated Search Terms</label></h2>
                            <div class='searchTermsSection'>
                                <input type='text' id='searchTerm' placeholder="Ex: Spreadsheets, Word Processor, etc." class='softwareInput smartField' data-fieldType="terms" autocomplete="off">
                                <div class='smartResults'></div>
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
        
        <?php

	
}
?>