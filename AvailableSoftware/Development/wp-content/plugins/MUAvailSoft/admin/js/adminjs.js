
//Set jQuery dollar sign variable
var $ = jQuery;

$(document).ready(function(){
    //alert("Works");


/* -------------------------------------------------------------------------- */
/*                      SUBMIT ADD SOFTWARE FORM FUNCTION                     */
/* -------------------------------------------------------------------------- */

    /**
     * FUNCTION TO ADD SOFTWARE TO DATABASE VIA AJAX
     * This function is called from the plugin 'addSoftware' admin page
     */
    $('#addSoftwareForm').on('submit', function(e){


        e.preventDefault();

        //Primary array to send to DB
        var packageArray = {};

        //Declare all necessary arrays to store information
        var softwareArray = {};
        var alternativesArray = [];
        var searchTermsArray = [];
        var users = [];
        var operatingSystem = [];
        var departments = [];

/* ------------------------ GET SOFTWARE INFORMATION ------------------------ */

        softwareArray['manu'] = $('#softwareManufacturer').val();
        softwareArray['name'] = $('#softwareName').val();
        softwareArray['cat'] = $('#softwareCat').val();
        softwareArray['price'] = $('#softwarePrice').val();
        softwareArray['desc'] = $('#softwareDesc').val();
        softwareArray['download'] = $('#softwareDownload').val();
        
        //Load the software information into the main 'package' array at software index
        packageArray['software'] = softwareArray;
        

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
                //Add some success handler here
                alert(response);
                //Clear all user input
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
                $('#facultyUsers').prop("disabled", true);
                $('#staffUsers').prop("disabled", true);
            }
            else
            {
                $('.userCheck').removeAttr("disabled");
            }
       });

});