<?php
ob_start();
include_once("config/config.php");  

if ($_POST['submit'] == 'Filter' ) {
    
        $chem_name = isset($_POST['chem_name'])?$_POST['chem_name']:''; 
        $chem_location = isset($_POST['chem_location'])?$_POST['chem_location']:''; 
        $chem_hazard_type = isset($_POST['chem_hazard_type'])?$_POST['chem_hazard_type']:''; 
        $chem_owner_id = isset($_POST['chem_owner_id'])?$_POST['chem_owner_id']:''; 
     
}


if ($_GET['action'] == 'deletion' && trim($_GET['chem_id']) <> ''  ) { 
    $delete_query = $mysqli->query("update chemicals set chem_status = 0   WHERE chem_id='" .trim($_GET['chem_id']) . "' limit 1");
    if ($delete_query) {
        //header("location:add_chemical.php");
        $msg = "Chemical Deleted Successfully";
    } else {
        $msg = "Error In Disable Operation";
    }
}

if($_GET['action']=='excel') {
    $results = $mysqli->query(" select *  from chemicals  order by chem_id desc ");
    /* determine number of rows result set */
    $row_cnt = $results->num_rows;
    if ($row_cnt > 0) {
         while ($row = $results->fetch_assoc()){
         $developer_records[] = $row;
           }
    }
     
        $filename = "hazardous_data_export_".date('Y-m-d') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $show_coloumn = false;
        if(!empty($developer_records)) {
        foreach($developer_records as $record) {
        if(!$show_coloumn) {
        // display field/column names in first row
        echo implode("\t", array_keys($record)) . "\n";
        $show_coloumn = true;
        }
        echo implode("\t", array_values($record)) . "\n";
        }
        }
        exit;  
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
<div class="row">
<div class="col-md-12">
<!-- Form Elements -->
<div class="panel panel-default">
<div class="panel-heading"> <?php echo (isset($msg) && $msg != '') ? '<strong>' . $msg . '</strong>' : ''; ?> </div>
<div class="panel-body" style="padding: 0px;">
<div class="col-md-12">
<h3>Inventory Search</h3>

<form role="form" method="post" action="">
<br/> 
<div class="form-group  input-group col-md-12">
<div class="col-md-3">
<span class="input-group-addon"><strong>Chemical Name</strong></span>
<input type="text" name="chem_name" class="form-control" placeholder="Chemical Name" value="<?php echo (isset($chem_name) && $chem_name != '' ) ? $chem_name : ''; ?>"   />
</div>
    
    <div class="col-md-3 ">

<span class="input-group-addon"><strong>Location</strong></span> 
<select class="form-control" name="chem_location" id="role"  >
    <option value="" selected disabled>Filter By Location</option>
    <?php
    $results = $mysqli->query(" select *  from chemicals   group by chem_location   order by chem_id desc ");
    /* determine number of rows result set */
    $row_cnt = $results->num_rows;
    if ($row_cnt > 0) {
        $chem_location_selected = "";
        while ($row = $results->fetch_assoc()) {
            
            if($chem_location == $row['chem_location'] ){
                $chem_location_selected =   " selected "; 
            }
            ?> 
    
            <option <?php echo $chem_location_selected; ?>  value="<?php echo $row['chem_location']; ?>"><?php echo $row['chem_location']; ?></option>
    <?php } } ?>
</select>
</div>
    
    

<div class="  col-md-3 ">

<span class="input-group-addon"><strong>Hazard</strong></span> 
<select class="form-control" name="chem_hazard_type" id="role"  >
    <option value="" selected disabled>Filter By Hazard</option>
    <option style="background:#0095D0;" title="Compatible Organic Bases" <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'A' )? 'selected' : '';  ?>  value="A">A</option>
    <option  style="background:#E60E16;" title="Compatible Pyrophoric & Water Reactive Materials"  <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'B' )? 'selected' : '';  ?> value="B">B</option>
    <option style="background:#FFD500;" title="Compatible Inorganic Bases" <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'C' )? 'selected' : '';  ?> value="C">C</option>
    <option style="background:#07C8BE;" title="Compatible Organic Acids"  <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'D' )? 'selected' : '';  ?> value="D">D</option>
    <option style="background:#B87BD5;" title="Compatible Oxidizers including Peroxides"<?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'E' )? 'selected' : '';  ?> value="E">E</option>
    <option style="background:#A5CA03;" title="Compatible Inorganic Acids not including Oxidizers or Combustibles"  <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'F' )? 'selected' : '';  ?> value="F">F</option>
    <option  style="background:#009846;" title="Not Intrinsically Reactive or Flammable or Combustible" <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'G' )? 'selected' : '';  ?> value="G">G</option>
    <option  style="background:#A7803E;" title="Poisons including Toxic Compressed Gases" <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'J' )? 'selected' : '';  ?> value="J">J</option>
    <option style="background:#F59300;" title="Compatible Explosive or other highly unstable materials" <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'K' )? 'selected' : '';  ?> value="K">K</option>
    <option style="background:#EB7FAF;" title="Non-Reactive Flammable and Combustibles, including solvents" <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'L' )? 'selected' : '';  ?> value="L">L</option>
	
	 <option style="background:#808080;" title="Incompatible with ALL other storage groups" <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'X' )? 'selected' : '';  ?> value="X">X</option>
	
	 <option style="background:#8B42AB;" title="Oxidizing Acids" <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'OA' )? 'selected' : '';  ?> value="OA">OA</option>
	
	 <option style="background:#F7F8F9;" title="Corrosive, not including acids or bases"  <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'S' )? 'selected' : '';  ?> value="S">S</option>
	
	   
</select>
</div>
    
<div class="  col-md-3 ">
  <span class="input-group-addon"><strong>Owner</strong></span> 
<select class="form-control" name="chem_owner_id" id="chem_owner_id"  >
    <option value="" selected disabled>Filter By Owner</option>
    <?php
    $results = $mysqli->query(" select *  from users  where status = 1  order by id desc ");
    /* determine number of rows result set */
    $row_cnt = $results->num_rows;
    if ($row_cnt > 0) {
        $chem_owner_selected = "";
        while ($row = $results->fetch_assoc()) {
            
             
            if($chem_owner_id == $row['id'] ){
                $chem_owner_selected =  " selected "; 
            } 
            ?>
             
            <option <?php echo $chem_owner_selected; ?>  value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
    <?php } } ?>
</select>
</div> 
    
</div>
<div style=" text-align: center;">
<input type="submit" class="btn btn-default" value="Filter" name="submit" >
&nbsp;&nbsp;
        <a  class="btn btn-primary" href="inventory_search.php" >Reset</a>
    </div>
    </form>
    <br />
    </div>
    </div>
    </div>
    <!-- End Form Elements -->
    </div>
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <?php  if(isset($_SESSION['role']) && ($_SESSION['role'] == 1 ||  $_SESSION['role'] == 2) ){ ?> 
            <div class="panel-heading"><strong> Manage Inventory</strong> <a href="inventory_search.php?action=excel"> <span style="float: right;margin-top: -7px;"> <button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button> </span> </a></div><?php } ?>
            
            <div class="panel-body">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr> 
                                <th>ID</th>
                                <th>Name</th>
                                <th>Formula</th>
                                <th>CAS</th>
                                <th>Quantity</th>
                                <th>Hazard Class</th>
                                <th>Owner</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_POST['submit'] == 'Filter') {
                                $cond = "";
                                if(isset($_POST['chem_name']) && $_POST['chem_name'] != ''){
                                    $cond .= " and a.chem_name like '%".$_POST['chem_name']."%'  "; 
                                }
                                if(isset($_POST['chem_location']) && $_POST['chem_location'] != ''){
                                    $cond .= " and a.chem_location = '".$_POST['chem_location']."'  "; 
                                }
                                
                                if(isset($_POST['chem_hazard_type']) && $_POST['chem_hazard_type'] != ''){
                                    $cond .= " and a.chem_hazard_type =  '".$_POST['chem_hazard_type']."'  "; 
                                }
                                
                                if(isset($_POST['chem_owner_id']) && $_POST['chem_owner_id'] != ''){
                                    $cond .= " and a.chem_owner_id =  '".$_POST['chem_owner_id']."'  "; 
                                } 
                            }
                              
                            $results = $mysqli->query(" select a.*,b.name ,c.dept_short_name from chemicals as a 
                                                        left join users as b on a.chem_owner_id = b.id
                                                        left join departments as c on a.chem_department_id = c.id 
                                                        where   a.chem_id > 0  $cond  order by a.chem_id desc ");
                            /* determine number of rows result set */
                            $row_cnt = $results->num_rows;
                            if ($row_cnt > 0) {
                                $sr = 0;
                                while ($row = $results->fetch_assoc()) { $sr++;
								$style = "";
                                if($row['chem_hazard_type'] == 'A'){
                                    $style = " style='background-color:#0095D0;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'B'){
                                     $style = " style='background-color:#E60E16;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'C'){
                                     $style = " style='background-color:#FFD500;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'D'){
                                     $style = " style='background-color:#07C8BE;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'E'){
                                     $style = " style='background-color:#B87BD5;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'F'){
                                     $style = " style='background-color:#A5CA03;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'G'){
                                     $style = " style='background-color:#009846;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'J'){
                                     $style = " style='background-color:#A7803E;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'K'){
                                     $style = " style='background-color:#F59300;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'L'){
                                     $style = " style='background-color:#EB7FAF;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'X'){
                                     $style = " style='background-color:#808080;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'OA'){
                                     $style = " style='background-color:#8B42AB;' ";
                                }
                                elseif($row['chem_hazard_type'] == 'S'){
                                     $style = " style='background-color:#F7F8F9;' ";
                                }
                                    ?>
                            <tr class="odd gradeX" style="text-align: center;">
                                        <td width="1%"><?php echo $row['dept_short_name'].'-'.$row['chem_id']; ?></td> 
                                        <td width="3%"><?php echo $row['chem_name']; ?></td>
                                        <td width="3%"><?php echo $row['chem_formula']; ?></td>
                                        <td width="3%"><?php echo $row['chem_cas']; ?></td>
                                        <td width="3%"><?php echo $row['chem_mass']; ?></td>
                                       <td width="10%" <?php echo $style;  ?>><?php echo $row['chem_hazard_type']; ?></td>
                                        

                                        <td width="5%" > <?php echo $row['name']; ?></td>
                                        <td width="30%" class="center"><a  title="Edit" class="btn btn-default"
                                                       href="edit_chemical.php?action=edit&chem_id=<?php echo $row['chem_id']; ?>">Edit</a> 
                                  
                                                <a title="Delete" class="btn btn-default" href="inventory_search.php?action=deletion&chem_id=<?php echo $row['chem_id']; ?>">Delete</a> 
                                                <a  title="Logs" class="btn btn-default" href="logs.php?action=chemical_log&chem_id=<?php echo $row['chem_id']; ?>">Logs</a> 
                                                <a  title="Code" class="btn btn-default" href="qrcode/index.php?action=chemical_code&chem_id=<?php echo $row['chem_id']; ?>">Code</a> 
                                                <a  title="Details" class="btn btn-default" href="chemical_detail.php?action=chemical_detail&chem_id=<?php echo $row['chem_id']; ?>">Details</a>  
                                        </td>
                                        <?php }
                                    } else { ?>
                                    <tr><td colspan="7"  style="text-align: center;">No record found</td></tr>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!--End Advanced Tables -->
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
  </script>
</body>
</html>