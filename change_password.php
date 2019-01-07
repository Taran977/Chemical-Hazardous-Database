<?php
ob_start();
include_once("config/config.php");
if (isset($_POST) && $_POST['submit'] == 'Submit' && $_POST['uid'] > 0) {

    if ($_POST['current_pwd'] != '' && $_POST['new_pwd'] != '' && $_POST['re_pwd'] != '') {

        $current_pwd = $mysqli->real_escape_string(trim($_POST['current_pwd']));
        $new_pwd = $mysqli->real_escape_string(trim($_POST['new_pwd']));
        $re_pwd = $mysqli->real_escape_string(trim($_POST['re_pwd']));
   //     echo "SELECT * FROM users password = '" . md5($current_pwd) . "' and id = '" . $_SESSION['uid'] . "' limit 1"; 
        $results = $mysqli->query("SELECT * FROM users where password = '" . md5($current_pwd) . "' and id = '" . $_SESSION['uid'] . "' limit 1");
        $row = $results->fetch_assoc();
        if (!is_array($row)) {
            $msg = "Invalid Current Password";
        } else {
            if ($new_pwd == $re_pwd) {

                $insert_row = $mysqli->query("update  users set password = '" . md5($new_pwd) . "'  where id = '" .  $_SESSION['uid'] . "' limit 1  ");

                if ($insert_row) {
                    $msg = "Password Updated Successfully";
                } else {
                    $msg = "Error In Updation";
                }
            } else {
                $msg = "New and Re-type password does not match";
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
            <div class="panel-heading"> <?php echo (isset($msg) && $msg != '') ? '<strong>' . $msg . '</strong>' : ''; ?> </div>
            <div class="panel-body" style="padding: 0px;"> 
                <div class="col-md-8">
                    <h3>Change Password</h3>

                    <form role="form" method="post" action="">
                        <br/>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                            <input type="password" name="current_pwd" class="form-control" placeholder="Current Password" value="" required />
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                            <input type="password" name="new_pwd" class="form-control" placeholder="New Password" value="" required />
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                            <input type="password" name="re_pwd" class="form-control" placeholder="Re-type New Password" value="" required />
                        </div>

                        <input type="hidden" name="uid" value="<?php echo  $_SESSION['uid'];  ?>" />


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
