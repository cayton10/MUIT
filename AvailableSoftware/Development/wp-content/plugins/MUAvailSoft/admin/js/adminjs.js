
//Set jQuery dollar sign variable
var $ = jQuery;

$(document).ready(function(){

    $('.smartResults').hide();
    
    /**
     * getSoftwareArray();
     * Takes no parameters. Pulls software information from form and returns
     * as array
     */
    function getSoftwareArray()
    {
        var softwareArray = {};

        /* ------------------------ GET SOFTWARE INFORMATION ------------------------ */

        softwareArray['manu'] = $('#softwareManufacturer').val();
        softwareArray['name'] = $('#softwareName').val();
        softwareArray['cat'] = $('#softwareCat').val();
        softwareArray['price'] = $('#softwarePrice').val();
        softwareArray['desc'] = $('#softwareDesc').val();
        softwareArray['download'] = $('#softwareDownload').val();

        return softwareArray;

    }

/* -------------------------------------------------------------------------- */
/*                      SUBMIT ADD SOFTWARE FORM FUNCTION                     */
/* -------------------------------------------------------------------------- */

    /**
     * FUNCTION TO ADD SOFTWARE TO DATABASE VIA AJAX
     * This function is called from the plugin 'addSoftware' admin page
     */
    $('#addSoftwareForm').on('submit', function(e){

        e.preventDefault();
        //Ensure checkbox groups are complete
        userChecked = $('.userCheck:checked').length;

        if(!userChecked)
        {
            alert("You must select a user group.");
            return;
        }

        osChecked = $('.osCheck:checked').length;

        if(!osChecked)
        {
            alert("You must select a valid operating system");
            return;
        }


        

        //Primary array to send to DB
        var packageArray = {};

        var alternativesArray = [];
        var searchTermsArray = [];
        var users = [];
        var operatingSystem = [];
        var departments = [];


        
        //Load the software information into the main 'package' array at software index
        packageArray['software'] = getSoftwareArray();
        

/* -------------------- GET ALTERNATIVE SOFTWARE EXAMPLES ------------------- */

        var $alts = $('.altButton');

        //If alternatives have been listed, create an array of appropriate info
        if($alts.length)
        {
            $('.altButton').each(function(){
                alternativesArray.push($(this).data('name'));
            });

            packageArray['alternatives'] = alternativesArray;
        };

        
/* ------------------ GET SEARCH TERMS FOR ENTERED SOFTWARE ----------------- */

        var $terms = $('.termButton');

        //If search terms have been listed, create an array of appropriate info
        if($terms.length)
        {
            $('.termButton').each(function(){
                searchTermsArray.push($(this).data('term'));
            });

            packageArray['searchTerms'] = searchTermsArray;
        };

/* --------------------------- GET AVAILABLE USERS -------------------------- */

        $('#userCheckBoxes input[type="checkbox"]:checked').each(function(){
            users.push($(this).val());
        });

        //Add the users array to the package to send
        packageArray['users'] = users;
/* ------------------------- GET OPERATING SYSTEM(S) ------------------------ */

        $('#osCheckBoxes input[type="checkbox"]:checked').each(function(){
            operatingSystem.push($(this).val());
        });

        //Add os array to package to send
        packageArray['os'] = operatingSystem;

/* ----------------------------- GET DEPARTMENT ----------------------------- */

        departments.push($('#departmentName').val());

        packageArray['department'] = departments;

        //Construct the ajax request and fire 
        $.ajax({
            url: ajaxurl,
            type: "POST",
            dataType: "JSON",
            data: 
            {
                action: "add_software",
                data: packageArray
            },
            success: function(response)
            {
                if(response['success'] == false)
                alert(response['message']);
            },
            error: function(xhr, status, error)
            {
                console.log(xhr.responseText);
            }
        });

    });

/* -------------------------------------------------------------------------- */
/*                       ADD ALTERNATIVE SOFTWARE NAMES                       */
/* -------------------------------------------------------------------------- */

    /**
     * Function to add alternative software packages to array for db storage
     * associates with software being entered by user
     */

     $('#addAlternative').on('click', function(e)
     {

         if($('#softwareAlternatives').val() == '')
         {
             return;
         }

         e.preventDefault();

         //Get information from the input field
         var altName = $('#softwareAlternatives').val();

         //Append the alternatives div with a button of name corresponding to entered alt
         $('#alternativeList').append("<li class='altButton' data-name='" + altName + "'><button type='button' class='button-secondary removeAlt'>" + altName + "  <span class='cancelAlt'>&#x2715<span></button></li>");

         //Clear the input field for next entry
         $('#softwareAlternatives').val('');

     });

     /**
      * Function to remove software alternatives if the buttons added are clicked prior to
      * submitting the form
      */

      $(document).on('click', '.removeAlt', function(){
        
            $(this).parent('li').remove();
      });


/* -------------------------------------------------------------------------- */
/*                              ADD SEARCH TERMS                              */
/* -------------------------------------------------------------------------- */

      /**
       * Function to add search terms associated with entered software package
       * as visibile buttons which can be removed
       */
       
       $('#addSearchTerm').on('click', function(e){

            if($('#searchTerm').val() == '')
            {
                return;
            }

            e.preventDefault();

            //Get information from input field
            var searchTerm = $('#searchTerm').val();

            //Append the search terms <ul> with a list item button of name corresponding
            //to entered search term
            $('#searchTermList').append("<li class='termButton' data-term='" + searchTerm + "'><button type='button' class='button-secondary removeSearchTerm'>" + searchTerm + "   <span class='cancelTerm'>&#x2715<span></button></li>");

            //Clear input field for next entry
            $('#searchTerm').val('');
       });

       /**
        * Function to remove software search term if buttons added are clicked prior to 
        * submitting the form
        */
       $(document).on('click', '.removeSearchTerm', function(){

            $(this).parent('li').remove();
       });


/* -------------------------------------------------------------------------- */
/*            ADD SUGGESTED KEYWORD TO INPUT FIELD ON CLICK / ENTER           */
/* -------------------------------------------------------------------------- */

       /**
        * Function adds the suggested "smart searched" keyword retrieved
        * from DB either on click or TAB -> Enter to the input field. This
        * element has been dynamically created, so remember: $(document).on
        */

        $(document).on('click', '.smartKeyword', function(e){
            //Keep the window from reloading on anchor click
            e.preventDefault;

            var keyword = $(this).html();

            //Update the input field with selected term
            $(this).closest('.smartSearchDiv').find('input.smartField').val(keyword);

            //Hide the div with the suggestions since a KW was selected
            $('div.smartResults').hide();

            return false;

            
        });

        


/* -------------------------------------------------------------------------- */
/*                  PREVENT OTHER SELECTION WITH 'ALL USERS'                  */
/* -------------------------------------------------------------------------- */

       /**
        * If a user is adding software and selects the "All Users" checkbox,
        * we naturallly don't want them to select the other options since it
        * won't jive with our DB structure and querying
        */
       $('#allUsers').on('click', function()
       {
            if($(this).prop("checked") == true)
            {
                //Disable the other user type checkboxes
                $('#studentUsers').prop("disabled", true);
                $('#studentUsers').prop("checked", false);

                $('#facultyUsers').prop("disabled", true);
                $('#facultyUsers').prop("checked", false);

                $('#staffUsers').prop("disabled", true);
                $('#staffUsers').prop("checked", false);
            }
            else
            {
                $('.userCheck').removeAttr("disabled");
            }
       });



/* -------------------------------------------------------------------------- */
/*                            EDIT SOFTWARE JQUERY                            */
/* -------------------------------------------------------------------------- */
    $('#editSoftwareForm').hide();

/* -------------------------------------------------------------------------- */
/*                  ON EDITSOFTWAREFORM CHANGE, LOAD DETAILS                  */
/* -------------------------------------------------------------------------- */
    $('#editSelectElement').on('change', function()
    {
        var id = this.value;
        //Show the form
        $('#editSoftwareForm').slideDown(800);
        //Grab the value of the selected software package
        $.ajax(
            {
                url: ajaxurl,
                method: "GET",
                dataType: "JSON",
                data:
                {
                    action: "edit_software_package",
                    data: id
                },
                success: function(response)
                {
                    var soft = response['soft_package'][0];
                    var user = response['user_info'];
                    var os = response['operating_sys'];
                    var alts = response['soft_alts'];


                    //Populate returned base software info
                    $('#softwareManufacturer').val(soft['soft_company']);
                    $('#softwareName').val(soft['soft_name']);
                    $('#softwareCat').val(soft['soft_type']);
                    $('#softwarePrice').val(soft['soft_price']);
                    $('#softwareDesc').val(soft['soft_description']);
                    $('#softwareDownload').val(soft['soft_download']);

                    //Populate returned user info for checkbox form group
                    $.each(user, function(i, result)
                    {
                        $(":checkbox[value='" + result.user_type + "']").prop("checked", true);
                    });

                    //Populate returned operating system info checkbox form group
                    $.each(os, function(i, result)
                    {
                        $(":checkbox[value='" + result.os_id + "']").prop("checked", true);
                    });

                    //Populate returned alternative name buttons





                    console.log(response);
                },
                error: function(xhr, status, error)
                {
                    console.log(xhr.responseText);
                }
        });

    });


/* -------------------------------------------------------------------------- */
/*                     SMART SEARCH FOR DATA ENTRY FIELDS                     */
/* -------------------------------------------------------------------------- */
    $('.smartField').keyup(function()
    {
        var element = $(this);
        //if no content in data field, hide suggestion
        if($(this).val() == "")
            $('.smartResults').fadeOut('150');
        else
        {
            if($(this).val().length < 2)
                return;

            else
            {
                var packageArray = {};
                //Set up our arguments to pass
                packageArray['dataField'] = $(this).data('fieldtype');
                packageArray['keyWord'] = $(this).val();

                $.ajax(
                    {
                        url: ajaxurl,
                        method: "GET",
                        dataType: "JSON",
                        data: 
                        {
                            action: "smart_search",
                            data: packageArray
                        },
                        success: function(response)
                        {
                            var output = "";
                            var prevKeyword = "";

                            $.each(response, function(i, result) 
                            {
                                if(result.keyword != prevKeyword)
                                {
                                    output += "<span class='resultText'><a href='#' class='smartKeyword'>" + result.keyword + "</a></span>";
                                }

                                prevKeyword = result.keyword;
                            });

                            if(output.length != 0)
                            {
                                element.next('.smartResults').html(output);
                                element.next('.smartResults').fadeIn('200');
                            }
                        },
                        error: function(xhr, status, error)
                        {
                            console.log(xhr.responseText);
                        }
                    }
                )
            }
        }
    });

















});