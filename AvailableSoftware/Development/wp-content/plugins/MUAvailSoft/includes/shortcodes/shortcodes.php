<?php

//Add config class autoloader dependency
require_once(__DIR__ . '/../../config/config.php');


/**
 * List all software shortcode
 */
function list_all_software_sc() {

    ob_start();

    printf(print_all_software());
    return ob_get_clean();
}


function print_all_software() {

    $software = new Software();
    $allProducts = $software->getAllSoftware();
    
    $output = '<table>
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Download Location</th>
                    </tr>
                </thead>';

    //Iterate and load table rows from db query
    foreach($allProducts as $product)
    {
        $output .= "<tr>
                        <td>" . $product->soft_company . "</td>
                        <td>" . $product->soft_name . "</td>
                        <td>" . $product->soft_price . "</td>
                        <td><a href='" . $product->soft_download . "'>Download</a></td>
                    </tr>";
    }

    $output .= "<table>";

    return $output;
}


?>