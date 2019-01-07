<?php
ob_start();
include_once("config/config.php"); 
$chem_id = trim($_GET['chem_id']);
$results = $mysqli->query(" select a.*,b.name ,c.dept_short_name,c.dept_name from chemicals as a 
                        left join users as b on a.chem_owner_id = b.id
                        left join departments as c on a.chem_department_id = c.id 
                        where a.chem_id = '".$chem_id."' order by a.chem_id desc ");
/* determine number of rows result set */
$row_cnt = $results->num_rows;
if ($row_cnt > 0) {
    $sr = 0;
    $row = $results->fetch_assoc(); 
}
                                
      
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Hazardous Materials Database</title>
<!-- BOOTSTRAP STYLES-->
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<!-- FONTAWESOME STYLES-->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<!-- CUSTOM STYLES-->
<link href="assets/css/custom.css" rel="stylesheet" />
<!-- GOOGLE FONTS-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<style>
    th{
        text-align: center;
    }
</style>
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <?php include_once("header.php"); ?>
    </nav>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <?php include_once("leftside.php"); ?>
    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <!--                    <div class="row">

            </div>-->
            <!-- /. ROW  -->
<div class="row"> <div class="col-md-6">
                     <!--    Context Classes  -->
                    <div class="panel panel-default">
                       
                        <div class="panel-heading" style="text-align: center;">
                            <strong>Chemical Details</strong>
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                     
                                    <tbody>
                                        <tr class=" "> 
                                            <td>Chemical ID:</td>
                                            <td><?php echo $row['dept_short_name'].'-'.$row['chem_id']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Chemical Name:</td>
                                            <td><?php echo $row['chem_name']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Date Added:</td>
                                            <td><?php echo date("Y-m-d",strtotime($row['chem_date_received'])); ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Expiry Date:</td>
                                            <td><?php echo date("Y-m-d",strtotime($row['chem_date_expiry'])); ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>CAS:</td>
                                            <td><?php echo $row['chem_cas']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Tare Weight:</td>
                                            <td><?php echo $row['chem_tare_mass']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Supplier:</td>
                                            <td><?php echo $row['chem_supplier']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Hazard:</td>
                                            <td><?php echo $row['chem_hazard_type']; ?></td> 
                                        </tr>
                                         
                                        <tr class=" "> 
                                            <td>Location:</td>
                                            <td><?php echo $row['chem_location']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Location Detail:</td>
                                            <td><?php echo $row['chem_location_details']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Chemical State:</td>
                                            <td><?php echo $row['chem_state']; ?></td> 
                                        </tr>
                                        
                                        <tr class=" "> 
                                            <td>Description:</td>
                                            <td><?php echo $row['chem_description']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Category:</td>
                                            <td><?php echo $row['dept_name']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Owner:</td>
                                            <td><?php echo $row['name']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <td>Safety Sheet:</td>
                                            <td><?php echo $row['chem_safety_url']; ?></td> 
                                        </tr>
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <!--  end  Context Classes  -->
                </div>
            
                        <div id="printlabel" class="panel-heading" style="text-align: center;">
                            <strong>Chemical Code</strong>
                            <br/>
                            <?php  
                                    $resultss = $mysqli->query(" select *  from chemicals where chem_id = '" . trim($_GET['chem_id']) . "' order by chem_id desc ");
                                    /* determine number of rows result set */
                                    $row_cnt = $resultss->num_rows;
                                    $data = "";
                                    if ($row_cnt > 0) {
                                        $rows = $resultss->fetch_assoc();
                                        $data = "Chemical Name: " . $rows['chem_name'] . "\n" . "Chemical Formula: " . $rows['chem_formula'] . "\n" . "Chemical CAS: " . $rows['chem_cas'] . "\n" .
                                                "Chemical Supplier: " . $rows['chem_supplier'] . "\n" . "Chemical Dae Received: " . date("Y-m-d", strtotime($rows['chem_date_received'])) . "\n" . "Chemical Expiry Date: " . date("Y-m-d", strtotime($rows['chem_date_expiry'])) . "\n" . "Chemical Hazard Type: " . $rows['chem_hazard_type'] . "\n" . "Chemical Safety URL: " . $rows['chem_safety_url'];
                                    }
                                    //set it to writable location, a place for temp generated PNG files
                                    $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

                                    //html PNG location prefix
                                    $PNG_WEB_DIR = 'temp/';

                                    include "qrcode/qrlib.php";

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
 
                         $filename = $PNG_TEMP_DIR . 'test' . md5($_REQUEST['data'] . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
                                        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
                                    }

                                    //display generated file
                                    echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" /> ';
                                    
                                    ?>
                                    
                                <table class=" " align="center">
                                     
                                    <tbody>
                                        <tr class=" "> 
                                            <th>Chemical ID:</th>
                                            <td><?php echo $row['dept_short_name'].'-'.$row['chem_id']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <th>Chemical Name:</th>
                                            <td><?php echo $row['chem_name']; ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <th>Date Added:</th>
                                            <td><?php echo date("Y-m-d",strtotime($row['chem_date_received'])); ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <th>Expiry Date:</th>
                                            <td><?php echo date("Y-m-d",strtotime($row['chem_date_expiry'])); ?></td> 
                                        </tr>
                                        <tr class=" "> 
                                            <th>CAS:</th>
                                            <td><?php echo $row['chem_cas']; ?></td> 
                                        </tr>
                                        
                                        <tr class=" "> 
                                            <th>Safety Sheet:</th>
                                            <td><?php echo $row['chem_safety_url']; ?></td> 
                                        </tr>
                                         
                                    </tbody>
                                </table>
                                <br/>
                            <input type="button"  class="btn btn-primary waves-effect waves-light" value="Print Label" onclick="printPage('printlabel');" /> 
                        </div>
                        
    
    </div>
<!-- /. ROW  -->
<!-- /. ROW  -->
</div>
<!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- CUSTOM SCRIPTS -->

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script> 
    $( "#datepicker1,#datepicker2" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    
     function printPage(id)
    {
        var html = "<html>";
        html += document.getElementById(id).innerHTML;
        html += "</html>";

        var printWin = window.open('', '', 'left=500,top=100,toolbar=0,scrollbars=1,status=0,width=500,height=500');
        printWin.document.write(html);
        printWin.document.close();
        printWin.focus();
        printWin.print();
// printWin.close();
    }
    
    
    
  </script>
</body>
</html>