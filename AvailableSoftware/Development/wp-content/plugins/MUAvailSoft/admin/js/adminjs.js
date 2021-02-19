
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
        alert(this.value);

        //Show the form
        $('#editSoftwareForm').slideDown(800);
        //Grab the value of the selected software package

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

                console.log(packageArray['dataField']);
                console.log(packageArray['keyWord']);

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

                            console.log(response);

                            $.each(response, function(i, result) 
                            {
                                if(result.keyword != prevKeyword)
                                {
                                    output += "<span><a href='#' onclick='return false;' class='smartKeyword'>" + result.keyword + "</a></span><br />";
                                }

                                prevKeyword = result.keyword;
                            });

                            if(output.length != 0)
                            {
                                element.next('.smartResults').html(output);
                                element.next('.smartResults').fadeIn('200');

                                /*$('.smartResults').html(output);
                                $('.smartResults').fadeIn('200');*/
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
    })

















});