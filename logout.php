<?php
session_start();
include('includes/dbconnect.php');
date_default_timezone_set('Asia/Kolkata');// change according timezone
$date=date('Y-m-d H:i:s',time());
$username=$_SESSION['username'];
$result = mysql_query("UPDATE login SET logout='$date' WHERE userid='$username'",$con);
session_destroy();
echo "<script>location.href='index.php?msg=0'</script>";


?>