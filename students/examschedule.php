<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='student')
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
 <!--Form to Upload Exam Schdeules-->
  <!--Date of creation:31/12/2020-->
  <!--Developed by :Arun-->
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>
<div class="main">
    <div class="course">
        <div class="heading">
            <h6>Exam Schedules</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Description</th>
              <th>Date</th>
              <th>Course</th>
              <th>Semester</th>     
              <th>Action</th>
            </tr>
              <?php
              $o=1;
              include 'includes/dbconnect.php';
              $username=$_SESSION['username'];
              $sq=mysql_query("SELECT * FROM studentreg WHERE userid='$username'");
              $ro=mysql_fetch_array($sq);
              $course=$ro['course'];
              $c=mysql_query("SELECT * FROM course WHERE cname='$course'");
              $re=mysql_fetch_array($c);
              $cd=$re['cid'];
              $result = mysql_query("SELECT * FROM exam NATURAL JOIN course WHERE exam.cid=course.cid AND cid='$cd'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $o;?></td>
              <td><?php echo $row['description'];?></td>
              <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                $date=$datetime[0];
                                echo $date.' ';
                                $time=$datetime[1];
                                echo date("g:ia",strtotime($time));?></td>
              <td><?php echo $row['cname'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><a href="../uploads/schedules/<?php echo$row['eid'].' '.$row['description'].'('.$date.')';?>.pdf"id="view" target="blank">View</a></td>
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
    </script>
</body>
</html>