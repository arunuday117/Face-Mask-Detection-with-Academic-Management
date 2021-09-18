<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='faculty')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');
  $username=$_SESSION['username'];
  $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sq);
  $did=$ro['did'];
  $batch=$ro['batch'];
  ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>ACADEMIC MANAGEMENT</title>
    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="assets/css/test.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/loader.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript">
      if(performance.navigation.type==2){
        location.reload(true);
      }
    </script>
</head>
<body>
  <div class="loader">
        <img src="../assets/images/loader.gif" alt="Loading..." />
    </div>
 <!--Form to Upload Timetable-->
  <!--Date of creation:01/01/2021-->
  <!--Developed by :Arun-->
  <!--header-->
 <?php
  include('includes/header.php');
  $course=$ro['course'];
 ?>
<div class="main">
  <div class="btd">
      <a id="bts1" class="bti wow">Public<?php 
                $ti="SELECT * FROM notice WHERE type='public' AND course='$course' AND `date` BETWEEN '$from' AND '$to'";
                $sql=mysql_query($ti,$con);
                $no=mysql_num_rows($sql);
                 ?><span class="badge-btn"><?php echo $no; ?></span></a>
      <a id="bts2" class="bti">HOD<?php 
                $ti="SELECT * FROM notice WHERE type='faculty' AND course='$course' AND `date` BETWEEN '$from' AND '$to'";
                $sql=mysql_query($ti,$con);
                $no=mysql_num_rows($sql);
                 ?><span class="badge-btn"><?php echo $no; ?></span></a>
    </div>
  <div class="course">
        <div class="hide" id='s1'>
          <div class="heading">
                     <h6>Public Notice</h6>
                 </div>
                 <table>
                     <tr id="header">
                       <th>Id</th>
                       <th>Notice</th>
                       <th>Date</th> 
                       <th></th>    
                     </tr>
                       <?php
                       $c=1;
                       $result = mysql_query("SELECT * FROM notice WHERE type='public' AND course='$course'");
         
                       while($row = mysql_fetch_array($result))
                       {
                       ?>
                       <tr>
                       <td><?php echo $c;?></td>
                       <td><?php echo $row['description'];?></td>
                       <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
                       <td><a href="../uploads/notice/<?php echo$row['nid'].$row['description'].'('.$date.')';?>.pdf"id="view" target="blank">View</a></td>
                       </tr>
                     <?php 
                       $c++;
                       }?>
                     
                 </table>
          </div>
          <div class="hide" id="s2">
            <div class="heading">
              <h6>HOD Notice</h6>
             </div>
             <table>
                 <tr id="header">
                   <th>Id</th>
                   <th>Notice</th>
                   <th>Date</th> 
                   <th></th>    
                 </tr>
                   <?php
                   $c=1;
                   $result = mysql_query("SELECT * FROM notice WHERE did!='$did'AND type='faculty' AND course='$course'");
     
                   while($row = mysql_fetch_array($result))
                   {
                   ?>
                   <tr>
                   <td><?php echo $c;?></td>
                   <td><?php echo $row['description'];?></td>
                   <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
                   <td><a href="../uploads/notice/<?php echo$row['nid'].$row['description'].'('.$date.')';?>.pdf"id="view" target="blank">View</a></td>
                   </tr>
                 <?php 
                   $c++;
                   }?>
                 
             </table>
         </div>
      </div>
  </div>
</div>


  <?php include('includes/footer.php');?>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
        }
         window.addEventListener("load", function (){
            const loader = document.querySelector(".loader");
            loader.className += " hidden"; // class "loader hidden"
  });
        function button(){
        confirm('Are you sure you want to continue?')
      }
      $("#s1").show();
          $("#bts1").on("click",function(){
          $("#s1").show();
          $("#s2").hide();
          });
          $("#bts2").on("click",function(){
          $("#s2").show();
          $("#s1").hide();
          });
        var bti = document.getElementsByClassName("bti");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < bti.length; i++) {
          bti[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("wow");

            // If there's no active class
            if (current.length > 0) {
              current[0].className = current[0].className.replace(" wow", "");
            }

            // Add the active class to the current/clicked button
            this.className += " wow";
          });
        }
    </script>
</body>
</html>