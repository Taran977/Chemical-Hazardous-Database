<?php 
session_start();
?>
<div class="sidebar-collapse" style="background-color:#1ABC9C;">
    <ul class="nav" id="main-menu">
        <?php
        $full_name = $_SERVER['PHP_SELF'];
        $name_array = explode('/', $full_name);
        $count = count($name_array);
        $page_name = $name_array[$count - 1];
        ?>
        <li class="text-center" > </li>
        <li> <a class="<?php echo ($page_name == 'home.php') ? 'active-menu' : ''; ?>"   href="home.php"><i class="fa fa-home fa-2x"></i> Dashboard</a> </li>
		<?php if($_SESSION["role"] == 1 || $_SESSION["role"] == 2 ) { ?>
        <li> <a class="<?php echo ($page_name == 'add_users.php') ? 'active-menu' : ''; ?>"  href="add_users.php"><i class="fa fa-user fa-2x"></i>Manage Users</a> </li>
		<?php } ?>
        <li> <a class="<?php echo ($page_name == 'add_departments.php') ? 'active-menu' : ''; ?>" href="add_departments.php"><i class="fa fa-building fa-2x"></i>Manage Departments</a> </li>	
        <li> <a class="<?php echo ($page_name == 'change_password.php') ? 'active-menu' : ''; ?>" href="change_password.php"><i class="fa fa-lock fa-2x"></i>Change Password</a> </li>	
        <li> <a class="<?php echo ($page_name == 'new_chemical.php') ? 'active-menu' : ''; ?>" href="add_chemical.php"><i class="fa fa-flask fa-2x"></i>Add Chemical</a> </li>	
        <li> <a class="<?php echo ($page_name == 'inventory_search.php') ? 'active-menu' : ''; ?>" href="inventory_search.php"><i class="fa fa-search fa-2x"></i>Inventory Search</a> </li>
        <li> <a class="<?php echo ($page_name == 'check_out_chemical.php') ? 'active-menu' : ''; ?>" href="check_out_chemical.php"><i class="fa fa-arrow-right fa-2x"></i>Check Out Chemical</a> </li>
		<li> <a class="<?php echo ($page_name == 'check_in_chemical.php') ? 'active-menu' : ''; ?>" href="check_in_chemical.php"><i class="fa fa-arrow-left fa-2x"></i>Check In Chemical</a> </li>
		<li> <a class="<?php echo ($page_name == 'logs.php') ? 'active-menu' : ''; ?>" href="logs.php"><i class="fa fa-history  fa-2x"></i>Logs</a> </li>
        <?php  if(isset($_SESSION['role']) && ($_SESSION['role'] == 1 ||  $_SESSION['role'] == 2) ){ ?> 	<li> <a class="<?php echo ($page_name == 'export.php') ? 'active-menu' : ''; ?>" href="export.php"><i class="fa fa-file-excel-o  fa-2x"></i>Export All Database</a> </li> <?php } ?>
        <li> <a  href="logout.php"><i class="fa fa-table fa-3x"></i>Logout</a> </li>
    </ul>
</div>