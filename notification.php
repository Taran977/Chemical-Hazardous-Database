<?php
include_once("config/config.php"); 
?>
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-red set-icon">
                <i class="fa fa-user"></i>
            </span>
            <div class="text-box">
                <?php
                $tot_category = $mysqli->query("SELECT count(*) as a FROM users where status = 1");
                $row = $tot_category->fetch_array();
                ?>
                <p class="main-text"><?php echo $row['a']; ?></p>
                <p class="text-muted">Active Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
                <i class="fa fa-bars"></i>
            </span>
            <div class="text-box" >
                <?php
                $tot_subcat = $mysqli->query("SELECT count(*) as a FROM users where status = 0 ");
                $row_subcat = $tot_subcat->fetch_array();
                ?>
                <p class="main-text"><?php echo $row_subcat['a']; ?></p>
                <p class="text-muted">Inactive Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
                <i class="fa fa-building"></i>
            </span>
            <div class="text-box" >
<?php
$tot_subcat = $mysqli->query("SELECT count(*) as a FROM departments");
$row_subcat = $tot_subcat->fetch_array();
?>
                <p class="main-text"><?php echo $row_subcat['a']; ?></p>
                <p class="text-muted">Departments</p>
            </div>
        </div>
    </div>
    
    
    <div class="col-md-4 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
                <i class="fa fa-flask"></i>
            </span>
            <div class="text-box" >
<?php
$tot_subcat = $mysqli->query("SELECT count(*) as a FROM chemicals where chem_status = 1");
$row_subcat = $tot_subcat->fetch_array();
?>
                <p class="main-text"><?php echo $row_subcat['a']; ?></p>
                <p class="text-muted">Total Chemicals</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-sm-6 col-xs-6">           
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
                <i class="fa fa-user"></i>
            </span>
            <div class="text-box" > 
                <p class="main-text"><?php echo $_SESSION["name"] ; ?></p>
                <p class="text-muted">Current Logged In User</p>
            </div>
        </div>
    </div>
     
     
</div>