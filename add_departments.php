<?php
ob_start();
include_once("config/config.php");
if (isset($_POST) && $_POST['submit'] == 'Submit' && $_POST['update'] > 0) {

    if ($_POST['name'] != '' && $_POST['place'] != '' && $_POST['desc'] != '' && $_POST['dept_short_name'] != '') {

        $name = $mysqli->real_escape_string(trim($_POST['name']));
        $place = $mysqli->real_escape_string(trim($_POST['place']));
        $desc = $mysqli->real_escape_string(trim($_POST['desc']));
        $dept_short_name = $mysqli->real_escape_string(trim($_POST['dept_short_name']));
        $uid = $mysqli->real_escape_string(trim($_POST['update']));

        $insert_row = $mysqli->query("update  departments set dept_name = '" . $name . "' , dept_short_name = '".$dept_short_name."' ,dept_place = '" . $place . "' , dept_desc= '" . $desc . "',
       added_date = '" . date("Y-m-d H:i:s") . "' , ip_address = '" . $_SERVER['REMOTE_ADDR'] . "', status  = 1 where id = '" . $uid . "' limit 1  ");

        if ($insert_row) {
            $msg = "Department Updated Successfully";
        } else {
            $msg = "Error In Updation";
        }
    } else {
        $msg = "All Fields are mandatory";
    }
}



if ($_GET['action'] == 'updation' && $_GET['id'] <> '' && $_GET['status'] <> '') {
    $update_query = $mysqli->query("UPDATE departments SET status='" . $_GET['status'] . "' WHERE id='" . $_GET['id'] . "' limit 1");
    $message = $msg = "";
    if($_GET['status']==0){
       $message = "Department disabled Successfully"; 
    }
    else{
       $message = "Department Enabled Successfully"; 
    }
    if ($update_query) {
        $msg = $message;
        } else {
        $msg = $message;
    }
}

if ($_GET['action'] == 'edit' && $_GET['id'] <> '') {
 
    $results = $mysqli->query("SELECT * FROM departments where id='" . $_GET["id"] . "' limit 1");
    $row = $results->fetch_assoc();
    if (!is_array($row)) {
        $msg = "Not found ID=" . $_GET["id"];
    } else {
        $uid = $row['id'];
        $dept_name = $row['dept_name'];
        $dept_place = $row['dept_place'];
        $dept_desc = $row['dept_desc'];
        $dept_short_name = $row['dept_short_name'];
    }
}

if ($_POST['submit'] == 'Submit' && $_POST['update'] <= 0) {
     
    if ($_POST['name'] != '' && $_POST['place'] != '' && $_POST['desc'] != '' && $_POST['dept_short_name'] != '') {

        $name = $mysqli->real_escape_string(trim($_POST['name']));
        $place = $mysqli->real_escape_string(trim($_POST['place']));
        $desc = $mysqli->real_escape_string(trim($_POST['desc']));
        $dept_short_name = $mysqli->real_escape_string(trim($_POST['dept_short_name']));

        $insert_row = $mysqli->query("INSERT INTO departments set dept_name = '" . $name . "' , dept_short_name = '".$dept_short_name."' ,  dept_place = '" . $place . "' , dept_desc= '" . $desc . "',
         added_date = '" . date("Y-m-d H:i:s") . "' , ip_address = '" . $_SERVER['REMOTE_ADDR'] . "', status  = 1 ");
        $last_insert_id = $mysqli->insert_id;
        if ($last_insert_id > 0) {
            $msg = "Department Added Successfully";
        } else {
            $msg = "Error In Insertion";
        }
    } else {
        $msg = "All Fields are mandatory.";
    }
}


if($_GET['action']=='excel') {
    $results = $mysqli->query(" select id,dept_name,dept_place,dept_desc,status  from departments  order by id asc ");
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
    <?php  if(isset($_SESSION['role']) && ($_SESSION['role'] == 1 ||  $_SESSION['role'] == 2) ){ ?> 
<div class="panel-heading"><strong> &nbsp;</strong> <a href="add_departments.php?action=excel"> <span style="float: right;margin-top: -7px;"> <button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button> </span> </a> <?php echo (isset($msg) && $msg != '') ? '<strong>'.$msg.'</strong>' : ''; ?> </div>
<?php } ?>
<div class="panel-body" style="padding: 0px;"> 
<div class="col-md-8">
    <h3>Add Department</h3>

    <form role="form" method="post" action="">
        <br/>
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
            <input type="text" name="name" class="form-control" placeholder="Department Name" value="<?php echo (isset($dept_name) && $dept_name != '' ) ? $dept_name : ''; ?>" required />
        </div>
		 <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
            <input type="text" name="dept_short_name" class="form-control" placeholder="Department Short Name" value="<?php echo (isset($dept_short_name) && $dept_short_name != '' ) ? $dept_short_name : ''; ?>" required />
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
            <input type="text" name="place" class="form-control" placeholder="Department Place" value="<?php echo (isset($dept_place) && $dept_place != '' ) ? $dept_place : ''; ?>" required />
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">@</span>
            <textarea cols="69" rows="5" name="desc" placeholder="Depatment Description" ><?php echo (isset($dept_desc) && $dept_place != '') ? $dept_desc : '' ?></textarea>
        </div>

        <input type="hidden" name="update" value="<?php echo $uid; ?>" >


            <input type="submit" class="btn btn-default" value="Submit" name="submit" >
                &nbsp;&nbsp;
                <input type="reset" class="btn btn-primary" value="Reset">
                    </form> 
                    <br/>
                    </div> 
                    </div>
                    </div>
                    <!-- End Form Elements -->
                    </div>
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong> Manage Departments</strong></div>

                            <div class="panel-body">
                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Department Name</th>
												<th>Department Short Name</th>
                                                <th>Place</th>
                                                <th>Description</th> 
                                                <th align="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$results = $mysqli->query(" select *  from departments  order by id desc ");
/* determine number of rows result set */
$row_cnt = $results->num_rows;
if ($row_cnt > 0) {
while ($row = $results->fetch_assoc()) {
?>
                                                    <tr class="odd gradeX">
                                                        <td width="5%"><?php echo $row['id']; ?></td>
                                                        <td width="5%"><?php echo $row['dept_name']; ?></td>
														<td width="5%"><?php echo $row['dept_short_name']; ?></td>
                                                        <td width="5%"><?php echo $row['dept_place']; ?></td>
                                                        <td width="5%"><?php echo $row['dept_desc']; ?></td> 
                                                        <td width="10%" class="center"><a  class="btn btn-default" href="add_departments.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>&nbsp;&nbsp;
<?php if ($row['status'] == 1) { ?>
                                                                <a  class="btn btn-default" href="add_departments.php?action=updation&status=0&id=<?php echo $row['id']; ?>">Disable</a> 
                                                            <?php } else { ?>
                                                                <a  class="btn btn-default" href="add_departments.php?action=updation&status=1&id=<?php echo $row['id']; ?>">Enable</a><?php } ?></td>
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
                    <script src="assets/js/custom.js"></script>
                    <script src="assets/js/jquery-1.10.2.js"></script>
                    <!-- BOOTSTRAP SCRIPTS -->
                    <script src="assets/js/bootstrap.min.js"></script> 
                    </body>
                    </html>
