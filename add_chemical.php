<?php
ob_start();
include_once("config/config.php"); 


if ($_GET['action'] == 'deletion' && trim($_GET['chem_id']) <> ''  ) { 
    $delete_query = $mysqli->query("update chemicals set chem_status = 0   WHERE chem_id='" .trim($_GET['chem_id']) . "' limit 1");
    if ($delete_query) {
        //header("location:add_chemical.php");
        $msg = "Chemical Deleted Successfully";
    } else {
        $msg = "Error In Disable Operation";
    }
}

if ($_GET['action'] == 'edit' && $_GET['id'] <> '') {
    $results = $mysqli->query("SELECT * FROM users where id='" . $_GET["id"] . "' limit 1");
    $row = $results->fetch_assoc();
    if (!is_array($row)) {
        $msg = "Not found ID=" . $_GET["id"];
    } else {
        $uid = $row['id'];
        $name = $row['name'];
        $username = $row['username'];
        $email = $row['email'];
        $role_type = $row['role_type'];
        $department_id = $row['department_id'];
    }
}

if ($_POST['submit'] == 'Submit' && $_POST['update'] <= 0) {

    if ( $_POST['chem_name'] != '' && $_POST['chem_formula'] != '' && $_POST['chem_cas'] != '' &&
            $_POST['chem_supplier'] != '' && $_POST['chem_hazard_type'] != '' && $_POST['chem_state'] != '' && $_POST['chem_tare_mass'] != ''   ) {

        $chem_name = $mysqli->real_escape_string(trim($_POST['chem_name']));
        $chem_formula = $mysqli->real_escape_string(trim($_POST['chem_formula']));
        $chem_cas = $mysqli->real_escape_string(trim($_POST['chem_cas']));
        $chem_supplier = $mysqli->real_escape_string(trim($_POST['chem_supplier']));
        $chem_date_received = $mysqli->real_escape_string(trim($_POST['chem_date_received']));
        $chem_date_expiry = $mysqli->real_escape_string(trim($_POST['chem_date_expiry']));
        $chem_hazard_type = $mysqli->real_escape_string(trim($_POST['chem_hazard_type']));
        $chem_location = $mysqli->real_escape_string(trim($_POST['chem_location']));
        $chem_location_details = $mysqli->real_escape_string(trim($_POST['chem_location_details']));
        $chem_state = $mysqli->real_escape_string(trim($_POST['chem_state']));
        $chem_tare_mass = $mysqli->real_escape_string(trim($_POST['chem_tare_mass']));
        $chem_mass = $mysqli->real_escape_string(trim($_POST['chem_mass']));
        $chem_description = $mysqli->real_escape_string(trim($_POST['chem_description']));
        $chem_safety_url = $mysqli->real_escape_string(trim($_POST['chem_safety_url']));
        $chem_department_id = $mysqli->real_escape_string(trim($_POST['chem_department_id']));
        $chem_owner_id = $mysqli->real_escape_string(trim($_POST['chem_owner_id'])); 
        $insert_row = $mysqli->query("INSERT INTO chemicals set chem_name = '" . $chem_name . "' , chem_formula = '" . $chem_formula . "' , chem_cas= '" . ($chem_cas) . "', chem_supplier = '" . $chem_supplier . "' , chem_date_received = '" . $chem_date_received . "', chem_date_expiry = '" . $chem_date_expiry . "' , chem_hazard_type = '" .$chem_hazard_type . "' , chem_location = '" . $chem_location . "', chem_location_details = '" . $chem_location_details . "', chem_state = '" . $chem_state . "', chem_tare_mass = '" . $chem_tare_mass . "', chem_mass = '" . $chem_mass . "', chem_description = '" . $chem_description . "', chem_safety_url = '" . $chem_safety_url . "', chem_department_id = '" . $chem_department_id . "', chem_owner_id = '" . $chem_owner_id . "', chem_user_added_id = '" . $_SESSION["uid"] . "', chem_added_date = '" . date("Y-m-d H:i:s") . "', chem_modify_date = '" . date("Y-m-d H:i:s") . "', chem_status = '1', chem_ip_address = '" . $_SERVER['REMOTE_ADDR'] . "' ");
            $last_insert_id = $mysqli->insert_id;
            if ($last_insert_id > 0) {
                $msg = "Chemical Added Successfully";
            } else {
                $msg = "Error In Insertion";
            }
       
    } else {
        $msg = "All Fields are mandatory";
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
<h3>Add Chemical</h3>

<form role="form" method="post" action="">
<br/> 
<div class="form-group  input-group col-md-12">
<div class="col-md-6">
<span class="input-group-addon"><strong>Chemical Name</strong></span>
<input type="text" name="chem_name" class="form-control" placeholder="Chemical Name" value="<?php echo (isset($name) && $name != '' ) ? $name : ''; ?>" required />
</div>

<div class="col-md-6">
<span class="input-group-addon"><strong>Molecular Formula</strong></span>
<input type="text" name="chem_formula" class="form-control" placeholder="Molecular Formula" value="<?php echo (isset($username) && $username != '' ) ? $username : ''; ?>" required />
</div>
</div>
<div class="form-group input-group col-md-12">
<div class="  col-md-6 ">
<span class="input-group-addon"><strong>CAS</strong></span>
<input type="text" name="chem_cas" class="form-control" placeholder="CAS" value="<?php echo (isset($email) && $email != '' ) ? $email : ''; ?>"  required/>
</div>

<div class="  col-md-6 ">
<span class="input-group-addon"><strong>Supplier</strong></span>
<input type="text" name="chem_supplier" class="form-control" placeholder="Supplier"  value="" required />
</div>

</div>


<div class="form-group input-group col-md-12">


<div class="  col-md-6 ">
<span class="input-group-addon"><strong>Date Received</strong></span>
<input type="text" name="chem_date_received" class="form-control" placeholder="Date Received" value="" required id="datepicker1"/>
</div>

<div class="  col-md-6 ">
<span class="input-group-addon"><strong>Expiry Date</strong></span>
<input type="text" name="chem_date_expiry" class="form-control" placeholder="Expiry Date" value="" required id="datepicker2" />
</div>

</div>

<input type="hidden" name="update" value="<?php echo $uid; ?>" >

<div class="form-group input-group col-md-12">
<div class="  col-md-6 ">

<span class="input-group-addon"><strong>Hazard Classification</strong></span> 
<select class="form-control" name="chem_hazard_type" id="role" required>
    <option value="" selected>Hazard Classification</option>
    <option value="A" style="background:#0095D0;" title="Compatible Organic Bases" >A</option>
    <option value="B" style="background:#E60E16;" title="Compatible Pyrophoric & Water Reactive Materials" >B</option>
    <option value="C" style="background:#FFD500;" title="Compatible Inorganic Bases" >C</option>
    <option value="D" style="background:#07C8BE;" title="Compatible Organic Acids" >D</option>
    <option value="E" style="background:#B87BD5;" title="Compatible Oxidizers including Peroxides" >E</option>
    <option value="F" style="background:#A5CA03;" title="Compatible Inorganic Acids not including Oxidizers or Combustibles" >F</option>
    <option value="G" style="background:#009846;" title="Not Intrinsically Reactive or Flammable or Combustible" >G</option> 
    <option value="J" style="background:#A7803E;" title="Poisons including Toxic Compressed Gases" >J</option>
    <option value="K" style="background:#F59300;" title="Compatible Explosive or other highly unstable materials" >K</option>
    <option value="L" style="background:#EB7FAF;" title="Non-Reactive Flammable and Combustibles, including solvents" >L</option>
    <option value="X" style="background:#808080;" title="Incompatible with ALL other storage groups" >X</option>
    <option value="OA" style="background:#8B42AB;" title="Oxidizing Acids" >OA</option>
    <option value="S" style="background:#F7F8F9;" title="Corrosive, not including acids or bases" >S</option>
</select>
</div>

<div class="  col-md-6 ">
<span class="input-group-addon"><strong>Location</strong></span> 
<input type="text" name="chem_location" class="form-control" placeholder="Location" value="" required/>
</div>

</div>

<div class="form-group input-group col-md-12">


<div class="  col-md-6 ">
 <span class="input-group-addon"><strong>Location Details</strong></span> 
<input type="text" name="chem_location_details" class="form-control" placeholder="Location Details" value="" required/>
</div>

<div class="  col-md-6 ">
<span class="input-group-addon"><strong>Select Chemical State</strong></span> 
<select class="form-control" name="chem_state" id="chem_state" required>
    <option value="" selected>Select Chemical State</option>
    <option value="Solid">Solid</option>
    <option value="Liquid">Liquid</option>
    <option value="Gas">Gas</option>
</select>
</div>
</div>


<div class="form-group input-group col-md-12">

<div class="  col-md-6 ">
<span class="input-group-addon"><strong>Tare Mass (g)</strong></span> 
<input type="text" name="chem_tare_mass" class="form-control" placeholder="Tare Mass (g)" value="" required/>
</div>


<div class=" form-group col-md-6 ">
<span class="input-group-addon control-label"><strong>Original Mass of Product (g)</strong></span> 
<input type="text" name="chem_mass" class="form-control" placeholder="Original Mass of Product (g)" value="" required/>
</div>
</div>

<div class="form-group   col-md-12">

<div class="form-group   col-md-6 ">
<span  class="input-group-addon control-label"><strong>Description</strong></span> 
 
<textarea required cols="58" rows="5" name="chem_description" placeholder="Description (400 characters):" ><?php echo (isset($dept_desc) && $dept_place != '') ? $dept_desc : '' ?></textarea>
</div>


<div class="form-group    col-md-6 ">
 <span class="input-group-addon"><strong>Post Safety Sheet URL</strong></span> 
 
<textarea required cols="58" rows="5" name="chem_safety_url" placeholder="Post Safety Sheet URL" ><?php echo (isset($dept_desc) && $dept_place != '') ? $dept_desc : '' ?></textarea>
</div>

</div>

<div class="form-group input-group col-md-12">

<div class="  col-md-6 ">
 <span class="input-group-addon"><strong>Department</strong></span> 
<select class="form-control" name="chem_department_id" id="chem_department_id" required>
    <option value="" selected disabled>Select Department</option>
    <?php
    $results = $mysqli->query(" select *  from departments  order by id desc ");
    /* determine number of rows result set */
    $row_cnt = $results->num_rows;
    if ($row_cnt > 0) {
        while ($row = $results->fetch_assoc()) {
            ?>

            <option  value="<?php echo $row['id']; ?>"><?php echo $row['dept_name']; ?></option>
        <?php }
    } ?>
</select>
</div>

<div class="  col-md-6 ">
  <span class="input-group-addon"><strong>Owner</strong></span> 
<select class="form-control" name="chem_owner_id" id="chem_owner_id" required>
    <option value="" selected disabled>Select Owner</option>
    <?php
    $results = $mysqli->query(" select *  from users  order by id desc ");
    /* determine number of rows result set */
    $row_cnt = $results->num_rows;
    if ($row_cnt > 0) {
        while ($row = $results->fetch_assoc()) {
            ?> 

            <option  value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
    <?php } } ?>
</select>
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
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading"><strong> Manage Chemicals</strong></div>

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
                            $results = $mysqli->query(" select a.*,b.name ,c.dept_short_name from chemicals as a 
                                                        left join users as b on a.chem_owner_id = b.id
                                                        left join departments as c on a.chem_department_id = c.id 
                                                        order by a.chem_id desc ");
                            /* determine number of rows result set */
                            $row_cnt = $results->num_rows;
                            if ($row_cnt > 0) {
                                $sr = 0;
                                while ($row = $results->fetch_assoc()) { $sr++;
                                    ?>
                            <tr class="odd gradeX" style="text-align: center;">
                                        <td width="1%"><?php echo $row['dept_short_name'].'-'.$row['chem_id']; ?></td> 
                                        <td width="3%"><?php echo $row['chem_name']; ?></td>
                                        <td width="3%"><?php echo $row['chem_formula']; ?></td>
                                        <td width="3%"><?php echo $row['chem_cas']; ?></td>
                                        <td width="3%"><?php echo $row['chem_mass']; ?></td>
                                        <td width="10%"><?php echo $row['chem_hazard_type']; ?></td>
                                        

                                        <td width="5%" > <?php echo $row['name']; ?></td>
                                        <td width="25%" class="center"><a  title="Edit" class="btn btn-default"
                                                       href="edit_chemical.php?action=edit&chem_id=<?php echo $row['chem_id']; ?>">Edit</a> 
                                  
                                                <a title="Delete" class="btn btn-default" href="add_chemical.php?action=deletion&chem_id=<?php echo $row['chem_id']; ?>">Delete</a> 
                                                <a  title="Logs" class="btn btn-default" href="logs.php?action=chemical_log&chem_id=<?php echo $row['chem_id']; ?>">Logs</a> 
                                                <a  title="Details" class="btn btn-default" href="chemical_detail.php?action=chemical_detail&chem_id=<?php echo $row['chem_id']; ?>">Details</a>  </td>
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