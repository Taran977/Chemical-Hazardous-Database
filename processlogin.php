<?php 
include_once("config/config.php");
$login = $mysqli->real_escape_string(trim($_POST["username"]));
$pwd = $mysqli->real_escape_string(trim($_POST["password"])); 
$results = $mysqli->query("SELECT * FROM users where status='1' and username = '".$login."' and password = '".md5($pwd)."' ");
$row_cnt = $results->num_rows;
if ($row_cnt > 0) {
    $record = $results->fetch_assoc();
    if ($login == $record["username"] && md5($pwd) == $record["password"]) {
        $_SESSION["ulogin"] = $record["username"];
        $_SESSION["status"] = $record["status"];
        if ($record["status"] == 1) { 
            $update_query = $mysqli->query("UPDATE users SET last_login='" .date("Y-m-d H:i:s"). "' WHERE id='" . $record["id"] . "' limit 1");
            $_SESSION["utype"] = "active";
            $_SESSION["uid"] = $record["id"];
            $_SESSION["role"] = $record["role_type"];
            $_SESSION["name"] = $record["name"];
            $_SESSION["department_id"] = $record["department_id"];
            header("Location:home.php");
            exit;
        }
    }
}
header("Location:index.php?invalid=1");
?>
