<?php
session_start();
if (!isset($_SESSION['utype'])) {
    header("location:index.php");
}
?>