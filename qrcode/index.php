<?php 
include_once("config.php");
$results = $mysqli->query(" select *  from chemicals where chem_id = '" . trim($_GET['chem_id']) . "' order by chem_id desc ");
/* determine number of rows result set */
$row_cnt = $results->num_rows;
$data = "";
if ($row_cnt > 0) {
    $row = $results->fetch_assoc();
    $data = "Chemical Name: " . $row['chem_name'] . "\n" . "Chemical Formula: " . $row['chem_formula'] . "\n" . "Chemical CAS: " . $row['chem_cas'] . "\n" .
            "Chemical Supplier: " . $row['chem_supplier'] . "\n" . "Chemical Dae Received: " . date("Y-m-d", strtotime($row['chem_date_received'])) . "\n" . "Chemical Expiry Date: " . date("Y-m-d", strtotime($row['chem_date_expiry'])) . "\n" . "Chemical Hazard Type: " . $row['chem_hazard_type'] . "\n" . "Chemical Safety URL: " . $row['chem_safety_url'];
}
//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'temp/';

include "qrlib.php";

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);


$filename = $PNG_TEMP_DIR . 'test.png';

//processing form input
//remember to sanitize user input in real-life solution !!!
$errorCorrectionLevel = 'L';

$errorCorrectionLevel = "H";

$matrixPointSize = 4;

$_REQUEST['data'] = $data;

if (isset($_REQUEST['data'])) {

    //it's very important!
    if (trim($_REQUEST['data']) == '')
        die('data cannot be empty! <a href="?">back</a>');

    // user data
    $filename = $PNG_TEMP_DIR . 'test' . md5($_REQUEST['data'] . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
    QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
}

//display generated file
echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /> ';

?>