<?php
ob_start();
include_once("config/config.php");  

if ($_POST['submit'] == 'Filter' ) {
    
        $chem_name = isset($_POST['chem_name'])?$_POST['chem_name']:''; 
        $chem_location = isset($_POST['chem_location'])?$_POST['chem_location']:''; 
        $chem_hazard_type = isset($_POST['chem_hazard_type'])?$_POST['chem_hazard_type']:''; 
        $chem_owner_id = isset($_POST['chem_owner_id'])?$_POST['chem_owner_id']:''; 
     
}
$where_cond = "";
if($_GET['action'] == 'chemical_log' && trim($_GET['chem_id']) >0 ){
    $where_cond = " and a.chem_id = '".trim($_GET['chem_id'])."'";
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
<h3>Logs</h3>
<form role="form" method="post" action="">
<br/> 
<div class="form-group  input-group col-md-12">
<div class="col-md-3">
<span class="input-group-addon"><strong>Chemical Name</strong></span>
<input type="text" name="chem_name" class="form-control" placeholder="Chemical Name" value="<?php echo (isset($chem_name) && $chem_name != '' ) ? $chem_name : ''; ?>"   /> 
<br/><br/> 
<input type="submit" class="btn btn-default" value="Filter" name="submit" >
&nbsp;&nbsp;
<input type="reset" class="btn btn-primary" value="Reset" onClick="window.location.reload();">
</div> 
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
            <div class="panel-heading"><strong> Manage Inventory</strong></div>

            <div class="panel-body">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr> 
                                <th>ID</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>From</th>
                                <th>To</th> 
                                <th>Owner</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($_POST['submit'] == 'Filter') {
                                $cond = "";
                                if(isset($_POST['chem_name']) && $_POST['chem_name'] != ''){
                                    $cond .= " and a.chem_name like '%".$_POST['chem_name']."%'  "; 
                                }
                                 
                            }
                               
                            $results = $mysqli->query(" select d.log_type, d.log_new_value,d.log_prev_value,  a.*,b.name ,c.dept_short_name 
                                                            from chemicals as a 
                                                        left join users as b on a.chem_owner_id = b.id
                                                        left join departments as c on a.chem_department_id = c.id 
                                                         left join logs as d on a.chem_id = d.log_chem_id
                                                        where   a.chem_id > 0 $cond  $where_cond and d.log_id is not null  order by d.log_id desc ");
                            /* determine number of rows result set */
                            $row_cnt = $results->num_rows;
                            if ($row_cnt > 0) {
                                $sr = 0;
                                while ($row = $results->fetch_assoc()) { $sr++;
                                
                                    $log_type = 0;
                                    if($row['log_type'] == 1){
                                        $log_type_text = "Check In";
                                        $class = " background-color: #12C400;";
                                    }elseif($row['log_type'] == 2){
                                        $log_type_text = "Check Out";
                                        $class = " background-color: #E60E16;";
                                    }
                                    ?>
                            <tr class="odd gradeX" style="text-align: center;">
                                <td width="1%" style="<?php echo $class; ?>"><?php echo $log_type_text; ?></td> 
                                        <td width="1%"><?php echo $row['dept_short_name'].'-'.$row['chem_id']; ?></td> 
                                        <td width="3%"><?php echo $row['chem_name']; ?></td>
                                        <td width="3%"><?php echo $row['log_prev_value']; ?></td>
                                        <td width="3%"><?php echo $row['log_new_value']; ?></td> 
                                        

                                        <td width="5%" > <?php echo $row['name']; ?></td>
                                        
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