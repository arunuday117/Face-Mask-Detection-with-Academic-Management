<?php
include('includes/dbconnect.php');
$username=$_SESSION['username'];
$p=mysql_query("SELECT * FROM login WHERE userid='$username'");
$sp=mysql_fetch_array($p);
date_default_timezone_set('Asia/Kolkata');// change according timezone
$to=date('Y-m-d H:i:s',time());
$from=$sp['logout'];
?>
<script>
$(document).ready(function() {

  $.ajax({
   url: "includes/table.php",
   type: "POST",
   datatype:"json",
   success: function(data){
        document.getElementById("pt1").innerHTML = data[1];
        document.getElementById("pt2").innerHTML = data[3];
        document.getElementById("pt3").innerHTML = data[5];
        document.getElementById("pt4").innerHTML = data[7];
        document.getElementById("pt5").innerHTML = data[9];
        document.getElementById("pt6").innerHTML = data[11];
        document.getElementById("pt7").innerHTML = data[13];
          }
      });
 });
 </script>
 <header class="main-header clearfix" role="header">
    <div class="logo">
      <a href="index.php"><em>ANV</em>ACADEMICS</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="timetable.php">Time Table<span id="pt1" class="badge"></a></li>
        <li><a href="attendance.php">Attendance Report<span id="pt2" class="badge"></a></li>
        <li><a href="viewassignment.php?assign=ok">Assignments<span id="pt3" class="badge"></a>
        <li><a href="material.php">Study Materials<span id="pt4" class="badge"></a></li>
         <li class="has-submenu"><a href="">Mark List</a>
          <ul class="sub-menu">
          <li><a href="class-wise.php">Class Wise</a></li>
          <li><a href="subject-wise.php">Subject Wise</a></li>
          <li><a href="student-wise.php">Student Wise</a></li>
          </ul></li>
        <li><a href="examschedule.php">Exam schedules<span id="pt5" class="badge"></a></li>
        <li><a href="notice.php">Notice<span id="pt6" class="badge"></a></li>
        <li><a href="message.php">Messages<span id="pt7" class="badge"></a></li>
        <li><li class="has-submenu"><a href="">Account</a>
          <ul class="sub-menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../logout.php">Log Out</a></li>
          </ul></li>
      </ul>
  </nav>
</header>