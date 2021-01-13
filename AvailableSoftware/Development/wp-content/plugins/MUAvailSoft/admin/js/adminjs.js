
//Set jQuery dollar sign variable
var $ = jQuery;

$(document).ready(function(){
    //alert("Works");


    $('#addSoftwareForm').on('submit', function(e){

        e.preventDefault();

        //Store data from the addSoftware page form
        var manu = $('#softwareManufac').val();
        var name = $('#softwareName').val();
        var cat = $('#softwareCat').val();
        var price = $('#softwarePrice').val();
        var desc = $('#softwareDesc').val();
        var download = $('#softwareDownload').val();

        //Load data into var data object
        var data = 
        {
            'action': 'add_software',
            'manufacturer': manu,
            'name': name,
            'cat': cat,
            'price': price,
            'desc': desc,
            'download': download
        };

        console.log(data);
    });
});