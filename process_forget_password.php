<?php

include_once("config/config.php");
$login = $mysqli->real_escape_string(trim($_POST["username"]));
$results = $mysqli->query("SELECT * FROM users where status='1' and email = '" . $login . "'  ");
$row_cnt = $results->num_rows;
if ($row_cnt > 0) {
    $record = $results->fetch_assoc();
    if ($login == $record["email"]) {
        $email = $record['email'];
        $message = '<html><body>';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr><td colspan =2 align=center><strong>Hazardous Materials Database</strong> </td> </tr>";
        $message .= "<tr><td><strong>Email:</strong> </td><td>" . $email . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        $to = $email;

        $subject = 'Hazardous Materials Database: Forgot Password';

        $headers = "From: Hazardous Materials Database \r\n";

        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        header("Location:forget_password.php?valid=1");
    }
}else{
    
header("Location:forget_password.php?invalid=1");
}
?>
