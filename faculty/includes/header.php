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
        <li><a href="viewstudents.php">Students</a></li>
        <li><a href="materials.php">Study Materials<span id="pt1" class="badge"></a></li>
        <li class="has-submenu"><a href="addassignment.php">Assignment<span id="pt2" class="badge"></a>
          <ul class="sub-menu">
            <li><a href="addassignment.php">Add Assignments</a></li>
            <li><a href="assignmentmark.php">Add Mark<span id="pt3" class="badge-sub2"></span></a></li>
            <li><a href="mark-download.php">Mark Download</a></li>
          </ul></li>
        <li><a href="examschedule.php">Exam Schedules<span id="pt4" class="badge"></a></li>
        <li><a href="viewtimetable.php">Time Table<span id="pt5" class="badge"></a></li>
        <li class="has-submenu"><a href="addmark.php">Exam Marks</a>
          <ul class="sub-menu">
            <li><a href="addmark.php">Add Mark</a></li>
            <li><a href="viewmarks.php">View Marks</a></li>
            <li><a href="exam-download.php">Download</a></li>
          </ul></li>
        <li><a href="viewnotice.php">Notice<span id="pt6" class="badge"></a></li>
         <li class="has-submenu"><a href="addmark.php">Account</a>
          <ul class="sub-menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../logout.php">Log out</a></li>
          </ul></li>
      </ul>
  </nav>
</header>