<?php

 if(isset($_POST['add']))
  {
    $username=$_POST['email'];
    $message=$_POST['message'];//this is for getting complaints
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d h:i:sa');//current date
    $sq="INSERT INTO message VALUES('NULL','$message','admin@gmail.com','$date','$username','','','0')";//Data insertion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Thank you for your feedback!!');</script>";
    }

  }

?>