<?php
session_start();
if (isset($_SESSION['utype'])) {     
    session_destroy();
    $_SESSION[''] = array();
    header("Location:index.php");
} 
session_destroy();
header("Location:index.php");
?> 