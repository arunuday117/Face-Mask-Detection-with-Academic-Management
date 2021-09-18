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
        document.getElementById("pt3").innerHTML = data[3];
        document.getElementById("pt4").innerHTML = data[5];
        document.getElementById("pt5").innerHTML = data[7];
        document.getElementById("pt6").innerHTML = data[9];
        document.getElementById("pt7").innerHTML = data[11];
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
        <li class="has-submenu"><a href="viewstudent.php">Students</a>
          <ul class="sub-menu">
            <li><a href="addstudents.php">Add Students</a></li>
            <li><a href="viewstudent.php">Registered Students</a></li>
          </ul></li>
        <li><a href="complaints.php">Complaints</a></li>
        <li><a href="subjects.php">Subjects</a></li>
        <li><a href="examschedule.php">Exam Schedules<span id="pt1" class="badge"></span></a></li>
        <li class="has-submenu"><a href="assignmentmark.php">Assignments<span id="pt2" class="badge"></span></a>
          <ul class="sub-menu">
            <li><a href="addassignment.php">Add Assignments</a></li>
            <li><a href="assignmentmark.php">Add Mark<span id="pt3" class="badge-sub2"></span></a></li>
            <li><a href="mark-download.php">Mark Download</a></li>
          </ul></li>
        <li class="has-submenu"><a href="">Exam Marks</a>
          <ul class="sub-menu">
            <li><a href="addmark.php">Add Mark</a></li>
            <li><a href="viewmarks.php">View Marks</a></li>
            <li><a href="exam-download.php">Download</a></li>
          </ul></li>
        <li><a href="viewtimetable.php">Time Table<span id="pt4" class="badge"></a></li>
        <li class="has-submenu"><a href="">Upload<span id="pt5" class="badge"></span></a>
        <ul class="sub-menu">
            <li><a href="materials.php">Study Materials<span id="pt6" class="badge-sub"></span></a></li>
            <li><a href="attendance.php">Attendance</a></li>
            <li><a href="uploadnotice.php">Notice<span id="pt7" class="badge-sub"></span></a></li>
          </ul></li>
         <li><li class="has-submenu"><a href="">Account</a>
          <ul class="sub-menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../logout.php">Log Out</a></li>
          </ul></li>
      </ul>
  </nav>
</header>