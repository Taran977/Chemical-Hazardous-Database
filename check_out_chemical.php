<?php
ob_start();
include_once("config/config.php");  

if ($_POST['submit'] == 'Filter' ) {
    
        $chem_name = isset($_POST['chem_name'])?$_POST['chem_name']:''; 
        $chem_location = isset($_POST['chem_location'])?$_POST['chem_location']:''; 
        $chem_hazard_type = isset($_POST['chem_hazard_type'])?$_POST['chem_hazard_type']:''; 
        $chem_owner_id = isset($_POST['chem_owner_id'])?$_POST['chem_owner_id']:''; 
}
 
if(!empty($_POST['action']) && $_POST['action'] == 'edit'  && $_POST['message_id'] != '' && $_POST['txtmessage'] != '' && $_POST['prev_value'] != '') {
    // echo $_POST['message_id'];die;
    $chem_id = $mysqli->real_escape_string(trim($_POST['message_id']));
    $new_value = $mysqli->real_escape_string(trim($_POST['txtmessage']));
    $prev_value = $mysqli->real_escape_string(trim($_POST['prev_value']));
    $insert_row = $mysqli->query("INSERT INTO logs set log_chem_id = '" . $chem_id . "' , log_new_value = '" . $new_value . "' , log_prev_value= '" . ($prev_value) . "',  log_added_user_id = '" . $_SESSION["uid"] . "', log_added_date = '" . date("Y-m-d H:i:s") . "', log_type = '2',  log_ip_address = '" . $_SERVER['REMOTE_ADDR'] . "' ");
     echo trim($new_value);die;
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
<style> 
.message-box{margin-bottom:20px;border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
.btnEditAction{background-color:#2FC332;border:0;padding:2px 10px;color:#FFF;}
.btnDeleteAction{background-color:#D60202;border:0;padding:2px 10px;color:#FFF;margin-bottom:15px;}
#btnAddAction{background-color:#09F;border:0;padding:5px 10px;color:#FFF;}
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
<h3>Check-Out Chemical</h3>

<form role="form" method="post" action="">
<br/> 
<div class="form-group  input-group col-md-12">
<div class="col-md-3">
<span class="input-group-addon"><strong>Chemical Name</strong></span>
<input type="text" name="chem_name" class="form-control" placeholder="Chemical Name" value="<?php echo (isset($chem_name) && $chem_name != '' ) ? $chem_name : ''; ?>"   /> 
<br/><br/> 
<input type="submit" class="btn btn-default" value="Filter" name="submit" >
&nbsp;&nbsp;
   <a  class="btn btn-primary" href="inventory_search.php" >Reset</a>
</div> 
</div> 
    </form> 
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
                                <th>Item</th> 
                                <th>Category</th> 
                                <th>Location</th> 
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
                                 
                            }
                              
                            $results = $mysqli->query(" select a.*,b.name ,c.dept_short_name,c.dept_name,d.log_new_value from chemicals as a 
                                                        left join users as b on a.chem_owner_id = b.id
                                                        left join departments as c on a.chem_department_id = c.id 
                                                        left join logs as d on a.chem_id = d.log_chem_id
                                                        where   a.chem_id > 0  $cond  group by a.chem_id order by d.log_id desc ");
                            /* determine number of rows result set */
                            $row_cnt = $results->num_rows;
                            if ($row_cnt > 0) {
                                $sr = 0;
                                while ($row = $results->fetch_assoc()) { $sr++;
                                    ?>
                                <tr class="message-box" id="message_<?php echo $row["chem_id"];?>">
                                        <td width="1%"><?php echo $row['dept_short_name'].'-'.$row['chem_id']; ?></td> 
                                        <td width="3%"><?php echo $row['chem_name']; ?></td>
                                        <td width="3%"><?php echo $row['dept_name']; ?></td>
                                        <?php 
                                        
                                         $sub_query = "select log_new_value from logs where log_chem_id = '".$row["chem_id"]."'  order by log_id desc limit 1  ";
                                        $sub_results  = $mysqli->query($sub_query);
                                        $row_sub_cnt = $sub_results->num_rows;
                                        if ($row_sub_cnt > 0) {
                                            $sub_row = $sub_results->fetch_assoc();
                                            
                                        }
                                        if($row_sub_cnt >0 ){
                                            $loc = $sub_row['log_new_value'];
                                        }else{
                                            $loc = $row['chem_location'];
                                        }
                                        
                                        
                                        ?>
                                        
                                        <td width="3%" class="message-content"><?php echo $loc; ?></td> 
                                        

                                        <td width="5%" > <?php echo $row['name']; ?></td>
                                        <td width="2%" class="center">
<!--                                            <a  class="btnEditAction btn btn-default" name="edit" onClick="showEditBox(this,<?php echo $row["chem_id"]; ?>)" title="Edit" class="btn btn-default"  >Edit</a>  -->
                                            <button class="btnEditAction" name="edit" onClick="showEditBox(this,<?php echo $row["chem_id"]; ?>,'<?php echo $row['chem_location']; ?>')">Edit</button>

                                        </td>
                                        <?php }
                                    } else { ?>
                                    <tr><td colspan="7"  style="text-align: center;">No record found</td></tr>
                                <?php } ?>
                            </tr>
                            <img src="LoaderIcon.gif" id="loaderIcon" style="display:none" />
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
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
function showEditBox(editobj,id,prev_value) {
	 
	$(editobj).prop('disabled','true');
	var currentMessage = $("#message_" + id + " .message-content").html();
	var editMarkUp = '<input type="text" value="'+currentMessage+'"  id="txtmessage_'+id+'"><br/>\n\
<button name="ok" onClick="callCrudAction(\'edit\','+id+',\''+prev_value+'\')">Save</button>\n\
<button name="cancel" onClick="cancelEdit(\''+currentMessage+'\',\''+id+'\')">Cancel</button>';
	$("#message_" + id + " .message-content").html(editMarkUp);
}
function cancelEdit(message,id) {
	$("#message_" + id + " .message-content").html(message);
	//$('#frmAdd').show();
        window.location.reload();
        
}
function callCrudAction(action,id,prev_value) {
	$("#loaderIcon").show();
	var queryString;
        if($("#txtmessage_"+id).val() == 0 || $("#txtmessage_"+id).val() == ''){
            alert("Cannot be zero or empty");
            $("#loaderIcon").hide();
            return false;
        }
	switch(action) {
		case "add":
			queryString = 'action='+action+'&txtmessage='+ $("#txtmessage").val();
		break;
		case "edit":
			queryString = 'action='+action+'&message_id='+ id + '&txtmessage='+ $("#txtmessage_"+id).val()+'&prev_value='+prev_value;
		break;
		case "delete":
			queryString = 'action='+action+'&message_id='+ id;
		break;
	}	 
	jQuery.ajax({
	url: "check_out_chemical.php",
	data:queryString,
	type: "POST",
	success:function(data){
		switch(action) {
			case "add":
				$("#comment-list-box").append(data);
			break;
			case "edit":
				$("#message_" + id + " .message-content").html(data);
				//$('#frmAdd').show();
				$("#message_"+id+" .btnEditAction").prop('disabled','');	
			break;
			case "delete":
				$('#message_'+id).fadeOut();
			break;
		} 
		$("#loaderIcon").hide();
	},
	error:function (){}
	});
}
</script>
  
  
  
</body>
</html>