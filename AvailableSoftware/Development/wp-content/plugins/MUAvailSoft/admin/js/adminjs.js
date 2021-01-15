
//Set jQuery dollar sign variable
var $ = jQuery;

$(document).ready(function(){
    //alert("Works");


    $('#addSoftwareForm').on('submit', function(e){


        e.preventDefault();

        //Store data from the addSoftware page form
        var manu = $('#softwareManufacturer').val();
        var name = $('#softwareName').val();
        var cat = $('#softwareCat').val();
        var price = $('#softwarePrice').val();
        var desc = $('#softwareDesc').val();
        var download = $('#softwareDownload').val();

        alert(manu);

        //Construct the ajax request and fire 
        $.ajax({
            url: ajaxurl,
            type: "POST",
            dataType: "JSON",
            data: 
            {
                action: "add_software",
                manufacturer: manu,
                name: name,
                cat: cat,
                price: price,
                desc: desc,
                download: download

            },
            success: function(response)
            {
                alert(response);
            },
            error: function(xhr, status, error)
            {
                alert(xhr.responseText);
            }
        });
    });
});