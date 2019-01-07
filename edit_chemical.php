<?php
ob_start();
include_once("config/config.php");
if (isset($_POST) && $_POST['submit'] == 'Submit' && $_POST['update'] > 0) {

    if ($_POST['chem_name'] != '' && $_POST['chem_formula'] != '' && $_POST['chem_cas'] != '' && $_POST['chem_hazard_type'] != '' &&  $_POST['chem_owner_id'] != ''  && $_POST['chem_department_id'] != '') {

        $chem_name = $mysqli->real_escape_string(trim($_POST['chem_name']));
        $chem_formula = $mysqli->real_escape_string(trim($_POST['chem_formula']));
        $chem_cas = $mysqli->real_escape_string(trim($_POST['chem_cas']));
        $chem_hazard_type = $mysqli->real_escape_string(trim($_POST['chem_hazard_type']));
        $chem_owner_id = $mysqli->real_escape_string(trim($_POST['chem_owner_id']));
        $chem_department_id = $mysqli->real_escape_string(trim($_POST['chem_department_id']));
        $chem_update = $mysqli->real_escape_string(trim($_POST['update']));
          $insert_row = $mysqli->query("update  chemicals set chem_name = '" . $chem_name . "' , chem_formula = '" . $chem_formula . "' ,
        chem_cas = '" . $chem_cas . "' , chem_hazard_type = '" . $chem_hazard_type . "', chem_owner_id = '" . $chem_owner_id . "' , chem_added_date = '" . date("Y-m-d H:i:s") . "' ,chem_hazard_type = '" . $chem_hazard_type . "', chem_owner_id = '" . $chem_owner_id . "', chem_department_id = '" . $chem_department_id . "',  chem_ip_address = '" . $_SERVER['REMOTE_ADDR'] . "', chem_modify_date = '" . date("Y-m-d H:i:s") . "' ,  chem_status  = 1 where chem_id = '" . $chem_update . "' limit 1  ");

            if ($insert_row) {
                $msg = "Chemical Updated Successfully";
            } else {
                $msg = "Error In Updation";
            }
        
    } else {
        $msg = "All Fields are mandatory";
    }
}

 
if ($_GET['action'] == 'edit' && trim($_GET['chem_id']) <> '') {
    $results = $mysqli->query("SELECT * FROM chemicals where chem_id='" . trim($_GET["chem_id"]) . "' limit 1");
    $row = $results->fetch_assoc();
    if (!is_array($row)) {
        $msg = "Not found ID=" . $_GET["id"];
    } else {
        $db_chem_id = $row['chem_id']; 
        $chem_name = $row['chem_name'];
        $chem_formula = $row['chem_formula'];
        $chem_cas = $row['chem_cas'];
        $chem_hazard_type = $row['chem_hazard_type'];
        $chem_description = $row['chem_description'];
        $chem_department_id = $row['chem_department_id'];
        $chem_owner_id = $row['chem_owner_id'];
    }
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
<h3>Edit Chemical</h3>

<form role="form" method="post" action="">
<br/> 
<div class="form-group  input-group col-md-12">
<div class="col-md-6">
<span class="input-group-addon"><strong>Chemical Name</strong></span>
<input type="text" name="chem_name" class="form-control" placeholder="Chemical Name" value="<?php echo (isset($chem_name) && $chem_name != '' ) ? $chem_name : ''; ?>" required />
</div>

<div class="col-md-6">
<span class="input-group-addon"><strong>Molecular Formula</strong></span>
<input type="text" name="chem_formula" class="form-control" placeholder="Molecular Formula" value="<?php echo (isset($chem_formula) && $chem_formula != '' ) ? $chem_formula : ''; ?>" required />
</div>
</div>
<div class="form-group input-group col-md-12">
<div class="  col-md-6 ">
<span class="input-group-addon"><strong>CAS</strong></span>
<input type="text" name="chem_cas" class="form-control" placeholder="CAS" value="<?php echo (isset($chem_cas) && $chem_cas != '' ) ? $chem_cas : ''; ?>"  required/>
</div>

<div class="  col-md-6 ">

<span class="input-group-addon"><strong>Hazard Classification</strong></span> 
<select class="form-control" name="chem_hazard_type" id="role" required>
    <option value="" selected>Hazard Classification</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'A' )? 'selected' : '';  ?>  value="A">A</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'B' )? 'selected' : '';  ?> value="B">B</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'C' )? 'selected' : '';  ?> value="C">C</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'D' )? 'selected' : '';  ?> value="D">D</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'E' )? 'selected' : '';  ?> value="E">E</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'F' )? 'selected' : '';  ?> value="F">F</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'G' )? 'selected' : '';  ?> value="G">G</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'H' )? 'selected' : '';  ?> value="H">H</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'I' )? 'selected' : '';  ?> value="I">I</option>
    <option <?php echo (isset($chem_hazard_type) && $chem_hazard_type == 'J' )? 'selected' : '';  ?> value="J">J</option>
</select>
</div>

</div>


<div class="form-group input-group col-md-12">


<div class="  col-md-6 ">
  <span class="input-group-addon"><strong>Owner</strong></span> 
<select class="form-control" name="chem_owner_id" id="chem_owner_id" required>
    <option value="" selected disabled>Select Owner</option>
    <?php
    $results = $mysqli->query(" select *  from users  order by id desc ");
    /* determine number of rows result set */
    $row_cnt = $results->num_rows;
    $selected_owner = "";
    if ($row_cnt > 0) {
        while ($row = $results->fetch_assoc()) {
            if($chem_owner_id == $row['id']){
                $selected_owner = " selected ";
            }
            ?> 

            <option <?php echo $selected_owner; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
    <?php } } ?>
</select>
</div>


<div class="  col-md-6 ">
 <span class="input-group-addon"><strong>Department</strong></span> 
<select class="form-control" name="chem_department_id" id="chem_department_id" required>
    <option value="" selected disabled>Select Department</option>
    <?php
    $results = $mysqli->query(" select *  from departments  order by id desc ");
    /* determine number of rows result set */
    $row_cnt = $results->num_rows;
    if ($row_cnt > 0) {
         $selected_hazard = "";
        while ($row = $results->fetch_assoc()) {
            if($chem_department_id == $row['id']){
                $selected_hazard = " selected ";
            }
            ?> 
            <option <?php echo $selected_hazard; ?>  value="<?php echo $row['id']; ?>"><?php echo $row['dept_name']; ?></option>
        <?php }
    } ?>
</select>
</div>

</div>

<input type="hidden" name="update" value="<?php echo $db_chem_id; ?>" >

<div class="form-group input-group col-md-12">  
<div class="form-group   col-md-6 ">
<span  class="input-group-addon control-label"><strong>Description</strong></span> 
 
<textarea required cols="58" rows="5" name="chem_description" placeholder="Description (400 characters):" ><?php echo (isset($chem_description) && $chem_description != '') ? $chem_description : '' ?></textarea>
</div> 
</div>
 
<input type="submit" class="btn btn-default" value="Submit" name="submit" >
&nbsp;&nbsp;
<input type="reset" class="btn btn-primary" value="Reset">
    </form>
    <br />
    </div>
    </div>
    </div>
    <!-- End Form Elements -->
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