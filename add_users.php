<?php
ob_start();
include_once("config/config.php"); 
if (isset($_POST) && $_POST['submit'] == 'Submit' && $_POST['update'] > 0 ) {
    
     if ($_POST['name'] != '' && $_POST['username'] != '' && $_POST['email'] != '' && $_POST['role'] != '' && 
            $_POST['department'] != ''  ) {

        $name = $mysqli->real_escape_string(trim($_POST['name']));
        $username = $mysqli->real_escape_string(trim($_POST['username']));
        $email = $mysqli->real_escape_string(trim($_POST['email']));
        $role = $mysqli->real_escape_string(trim($_POST['role']));
        $department = $mysqli->real_escape_string(trim($_POST['department'])); 
        $uid = $mysqli->real_escape_string(trim($_POST['update']));
        if ($re_password != $password) {
            $msg = "Password doesn't match";
        } else { 
            $insert_row = $mysqli->query("update  users set name = '" . $name . "' , username = '" . $username . "' , 
        email = '" . $email . "' , department_id = '" . $department . "', role_type = '" . $role . "' , added_date = '" . date("Y-m-d H:i:s") . "' ,
            ip_address = '" . $_SERVER['REMOTE_ADDR'] . "', status  = 1 where id = '".$uid."' limit 1  ");
             
            if($insert_row){
                $msg = "User Updated Successfully";
            } else {
                $msg = "Error In Updation";
            }
        }
    }  else {
        $msg = "All Fields are mandatory";
    }
}


if($_GET['action']=='excel') {
    $results = $mysqli->query(" select id,name,username,email,ip_address,added_date,last_login,status  from users  order by id asc ");
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

if ($_GET['action'] == 'updation' && $_GET['id'] <> '' && $_GET['status'] <> '') {
    $update_query = $mysqli->query("UPDATE users SET status='" . $_GET['status'] . "' WHERE id='" . $_GET['id'] . "' limit 1");
        
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

if ($_POST['submit'] == 'Submit' && $_POST['update'] <=0 ) {

    if ($_POST['name'] != '' && $_POST['username'] != '' && $_POST['email'] != '' && $_POST['role'] != '' && 
            $_POST['department'] != '' && $_POST['re_password'] != '' && $_POST['password'] != '') {

        $name = $mysqli->real_escape_string(trim($_POST['name']));
        $username = $mysqli->real_escape_string(trim($_POST['username']));
        $email = $mysqli->real_escape_string(trim($_POST['email']));
        $role = $mysqli->real_escape_string(trim($_POST['role']));
        $department = $mysqli->real_escape_string(trim($_POST['department']));
        $re_password = $mysqli->real_escape_string(trim($_POST['re_password']));
        $password = $mysqli->real_escape_string(trim($_POST['password']));
        if ($re_password != $password) {
            $msg = "Password doesn't match";
        } else { 
            $insert_row = $mysqli->query("INSERT INTO users set name = '" . $name . "' , username = '" . $username . "' , password= '".md5($password)."',
        email = '" . $email . "' , department_id = '" . $department . "', role_type = '" . $role . "' , added_date = '" . date("Y-m-d H:i:s") . "' ,
            ip_address = '" . $_SERVER['REMOTE_ADDR'] . "', status  = 1 , added_by = '".$_SESSION['uid']."' ");
            $last_insert_id = $mysqli->insert_id;
            if ($last_insert_id > 0) {
                $msg = "User Added Successfully";
            } else {
                $msg = "Error In Insertion";
            }
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
<div class="panel-heading"> <strong> &nbsp;</strong> <a href="add_users.php?action=excel"> <span style="float: right;margin-top: -7px;"> <button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button> </span> </a><?php echo (isset($msg) && $msg !='') ? '<strong>'.$msg.'</strong>' : ''; ?> </div> 
<?php } ?>
<div class="panel-body" style="padding: 0px;"> 
<div class="col-md-8">
    <h3>Add User</h3>

    <form role="form" method="post" action="">
        <br/>
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
            <input type="text" name="name" class="form-control" placeholder="Your Name" value="<?php echo (isset($name) && $name!= '' )?$name:''; ?>" required />
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
            <input type="text" name="username" class="form-control" placeholder="Desired Username" value="<?php echo (isset($username) && $username!= '' )?$username:''; ?>" required />
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">@</span>
            <input type="text" name="email" class="form-control" placeholder="Your Email" value="<?php echo (isset($email) && $email!= '' )?$email:''; ?>"  required/>
        </div>
        <?php if( !(isset($uid) && $uid > 0 )) { ?>
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
            <input type="password" name="password" class="form-control" placeholder="Enter Password"  value="" required />
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
            <input type="password" name="re_password" class="form-control" placeholder="Retype Password" value="" required/>
        </div>
        <?php } ?>
        <input type="hidden" name="update" value="<?php echo $uid; ?>" >

        <div class="form-group">
            <label for="role">Select Role</label>
            <select class="form-control" name="role" id="role" required>
                <option value="" selected>Select Role</option>
                <option <?php echo (isset($role_type) && $role_type== '1' )? "selected":''; ?> value="1">Administrator</option>
                <option <?php echo (isset($role_type) && $role_type== '2' )? "selected":''; ?> value="2">Department Administrator</option>
                <option <?php echo (isset($role_type) && $role_type== '3' )? "selected":''; ?>  value="3">Researcher </option>
                <option <?php echo (isset($role_type) && $role_type== '4' )? "selected":''; ?>  value="4">Student</option> 
            </select>
        </div> 
        <div class="form-group">
            <label for="department">Select Department</label>
            <select class="form-control" name="department" id="department" required>
                <option value="" selected>Select Department</option>
                <option  <?php echo (isset($department_id) && $department_id== '1' )? "selected":''; ?> value="1">Biology</option>
                <option  <?php echo (isset($department_id) && $department_id== '2' )? "selected":''; ?> value="2">Chemistry</option>
                <option  <?php echo (isset($department_id) && $department_id== '3' )? "selected":''; ?> value="3">Physics </option> 
            </select>
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
                        <div class="panel-heading"><strong> Manage Users</strong></div>
                    
                        <div class="panel-body">
                            <div class="table-responsive">
                                    
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Role</th> 
                                            <th align="center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        if($_SESSION["role"] == 2 ){
                                            $results = $mysqli->query(" select *  from users where id > 0 and 
                                               added_by = '".$_SESSION["uid"]."' and role_type in (3,4)  order by id desc ");
                                        }elseif($_SESSION["role"] == 1){
                                            $results = $mysqli->query(" select *  from users    where  id > 0   order by id desc ");
                                        }
                                        
                                        
                                         /* determine number of rows result set */
                                        $row_cnt = $results->num_rows;
                                        if($row_cnt > 0 ) { 
                                        while ($row = $results->fetch_assoc()) {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td width="5%"><?php echo $row['id']; ?></td>
                                                <td width="5%"><?php echo $row['name']; ?></td>
                                                <td width="5%"><?php echo $row['username']; ?></td>
                                                <td width="5%"><?php echo $row['email']; ?></td>
                                                <td width="5%"><?php 
                                                $department = "";
                                                if($row['department_id'] ==1){
                                                   $department = "Biology" ;
                                                }
                                                elseif($row['department_id'] ==2){
                                                    $department = "Chemistry" ;
                                                }
                                                elseif($row['department_id'] ==3){
                                                    $department = "Physics" ;
                                                }
                                                                                              
                                                echo $department; ?></td>

                                                <td width="5%" >
                                                 <?php 
                                                $role = ""; // 1 = administrator; 2 = dep admin; 3 = researcher; 4 = student
                                                
                                                if($row['role_type'] ==1){
                                                   $role = "Administrator" ;
                                                }
                                                elseif($row['role_type'] ==2){
                                                    $role = "Chemistry" ;
                                                }
                                                elseif($row['role_type'] ==3){
                                                    $role = "Researcher" ;
                                                }
                                                elseif($row['role_type'] == 4){
                                                    $role = "Student" ;
                                                }
                                                echo $role;
                                                
                                                 ?></td>
                                                <td width="10%" class="center"><a  class="btn btn-default" href="add_users.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>&nbsp;&nbsp;
                                                    <?php if($row['role_type'] != 1  ) {  if ($row['status'] == 1) { ?>
                                                        <a  class="btn btn-default" href="add_users.php?action=updation&status=0&id=<?php echo $row['id']; ?>">Disable</a> <?php } else { ?><a  class="btn btn-default" href="add_users.php?action=updation&status=1&id=<?php echo $row['id']; ?>">Enable</a><?php } ?></td>
                                        <?php }} } else { ?>
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
                </body>
                </html>
