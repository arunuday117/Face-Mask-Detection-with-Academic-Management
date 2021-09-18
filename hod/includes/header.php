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
        document.getElementById("pt2").innerHTML = data[1];
        document.getElementById("pt3").innerHTML = data[3];
        document.getElementById("pt4").innerHTML = data[5];
        document.getElementById("pt5").innerHTML = data[7];
        document.getElementById("pt6").innerHTML = data[9];
        document.getElementById("pt7").innerHTML = data[11];
        document.getElementById("pt8").innerHTML = data[13];
        document.getElementById("pt9").innerHTML = data[15];
        document.getElementById("pt10").innerHTML = data[15];
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
        <li><a href="viewadvisors.php">Advisors</a></li>
        <li><a href="viewstudents.php">Students</a></li>
         <li class="has-submenu"><a href="assignmentmark.php">Assignments<span id="pt1" class="badge"></span></a>
          <ul class="sub-menu">
            <li><a href="addassignment.php">Add Assignments</a></li>
            <li><a href="assignmentmark.php">Add Mark</a><span id="pt2" class="badge-sub2"></span></li>
            <li><a href="mark-download.php">Mark Download</a></li>
          </ul></li>
         <li class="has-submenu"><a href="">Exam Marks</a>
          <ul class="sub-menu">
            <li><a href="addmark.php">Add Mark</a></li>
            <li><a href="viewmarks.php">View Marks</a></li>
            <li><a href="exam-download.php">Download</a></li>
          </ul></li>
        <li><a href="maskviolations.php">Mask Violations<span id="pt3" class="badge"></span></a></li>
        <li class="has-submenu"><a href="">Uploads<span id="pt4" class="badge"></span></a>
        <ul class="sub-menu">
            <li><a href="uploadtimetable.php">Time Table<span id="pt5"class="badge-sub"></span></a></li>
            <li><a href="uploadnotice.php">Notice<span id="pt6" class="badge-sub"></span></a></li>
            <li><a href="uploadschedules.php">Exam Schedule<span id="pt7" class="badge-sub"></span></a></li>
            <li><a href="materials.php">Study Materials<span id="pt8" class="badge-sub"></span></a></li>
          </ul></li>
        <li class="has-submenu"><a href="">Message<span id="pt9" class="badge"></span></span></a>
        <ul class="sub-menu">
            <li><a href="send.php">Send Message</a></li>
            <li><a href="viewmsg.php">View Message</a><span id="pt10" class="badge-sub2"></li>
          </ul></li>
        <li><li class="has-submenu"><a href="">Account</a>
          <ul class="sub-menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../logout.php">Log Out</a></li>
          </ul></li>
      </ul>
  </nav>
</header>