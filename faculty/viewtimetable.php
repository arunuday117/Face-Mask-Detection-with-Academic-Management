<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='faculty')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>ANV ACADEMICS</title>
    
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
  <!--header-->
 <?php
 	include('includes/header.php');
  include 'includes/dbconnect.php';
  $username=$_SESSION['username'];
  $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sq);
  $course=$ro['course'];
  $c=mysql_query("SELECT * FROM course WHERE cname='$course'");
  $re=mysql_fetch_array($c);
  $cd=$re['cid'];
 ?>
<div class="main">
  <div class="bt">
        <a id="bt1" class="btn active">Your Department<?php 
      $ti="SELECT * FROM timetable WHERE cid='$cd' AND `date` BETWEEN '$from' AND '$to'";
      $sql=mysql_query($ti,$con);
      $no=mysql_num_rows($sql);
       ?><span class="badge-btn"><?php echo $no; ?></span></a>
        <a id="bt2" class="btn">Different Department<?php 
      $ti="SELECT * FROM timetable WHERE cid!='$cd'AND `date` BETWEEN '$from' AND '$to'";
      $sql=mysql_query($ti,$con);
      $no=mysql_num_rows($sql);
       ?><span class="badge-btn"><?php echo $no; ?></span></a>
  </div>
    <div class="course">
      <div class="hide" id='1'>
        <div class="heading">
            <h6>Timetable</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Date</th>
              <th>Course</th>
              <th>Semester</th>     
              <th>Action</th>
            </tr>
              <?php
              $o=1;
              $result = mysql_query("SELECT * FROM timetable NATURAL JOIN course WHERE timetable.cid=course.cid AND status='0' AND cid='$cd'ORDER BY sem ASC");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $o;?></td>
              <td><?php echo $row['date'];?></td>
              <td><?php echo $row['cname'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><a href="../uploads/timetable/<?php echo$row['tid'];?>.pdf"id="view" target="blank">View</a></td>
              </tr>
            <?php 
              $o++;
              }?>
            
        </table>
        <div class="heading">
          <h6>Previous Timetable</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Date</th>
              <th>Course</th>
              <th>Semester</th>     
              <th>Action</th>
            </tr>
              <?php
              $o=1;
              include 'includes/dbconnect.php';
              $result = mysql_query("SELECT * FROM timetable NATURAL JOIN course WHERE timetable.cid=course.cid AND status='1' AND cid='$cd'ORDER BY sem ASC");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $o;?></td>
              <td><?php echo $row['date'];?></td>
              <td><?php echo $row['cname'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><a href="../uploads/timetable/<?php echo$row['tid'];?>.pdf" id="view"target="blank">View</a></td>
              </tr>
            <?php 
              $o++;
              }?>
            
          </table>
        </div>
        <div class="hide" id='2'>
          <div class="heading">
            <h6>Timetable</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Date</th>
              <th>Course</th>
              <th>Semester</th>     
              <th>Action</th>
            </tr>
              <?php
              $o=1;
              include 'includes/dbconnect.php';
              $username=$_SESSION['username'];
              $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
              $ro=mysql_fetch_array($sq);
              $course=$ro['course'];
              $c=mysql_query("SELECT * FROM course WHERE cname='$course'");
              $re=mysql_fetch_array($c);
              $cd=$re['cid'];
              $result = mysql_query("SELECT * FROM timetable NATURAL JOIN course WHERE timetable.cid=course.cid AND status='0' AND cid!='$cd'ORDER BY cname ASC");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $o;?></td>
              <td><?php echo $row['date'];?></td>
              <td><?php echo $row['cname'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><a href="../uploads/timetable/<?php echo$row['tid'];?>.pdf"id="view"target="blank">View</a></td>
              </tr>
            <?php 
              $o++;
              }?>
            
        </table>
        <div class="heading">
          <h6>Previous Timetable</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Date</th>
              <th>Course</th>
              <th>Semester</th>     
              <th>Action</th>
            </tr>
              <?php
              $o=1;
              include 'includes/dbconnect.php';
              $result = mysql_query("SELECT * FROM timetable NATURAL JOIN course WHERE timetable.cid=course.cid AND status='1' AND cid!='$cd'ORDER BY cname ASC");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $o;?></td>
              <td><?php echo $row['date'];?></td>
              <td><?php echo $row['cname'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><a href="../uploads/timetable/<?php echo$row['tid'];?>.pdf" id="view"target="blank">View</a></td>
              </tr>
            <?php 
              $o++;
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
      $("#1").show();
        $("#bt1").on("click",function(){
        $("#1").show();
        $("#2").hide();
        });
        $("#bt2").on("click",function(){
        $("#2").show();
        $("#1").hide();
        });
        var btns = document.getElementsByClassName("btn");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
          });
        }
    </script>
</body>
</html>