<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='parent')
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
  </head>

<body>
  <div class="loader">
        <img src="../assets/images/loader.gif" alt="Loading..." />
    </div>
  <!--Viewing student complaints -->
  <!--Date of creation:02/01/2021-->
  <!--Developed by :Arun-->
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>
  <!-- ***** Course creation ***** -->
  <div class="main">
    <div class="course">
      <div class="heading">
            <h6>Student Complaints</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Student Name</th>
              <th>Complaint</th>
              <th>Date</th>     
            </tr>
              <?php
              $c=1;
              include 'includes/dbconnect.php';
              $username=$_SESSION['username'];
              $q=mysql_query("SELECT * FROM parentreg WHERE userid='$username'");
              $r=mysql_fetch_array($q);
              $stid=$r['stid'];
              $result = mysql_query("SELECT * FROM student_complaint WHERE stid='$stid'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $c;?></td>
              <td><?php 
                    $sql=mysql_query("UPDATE student_complaint SET status='1' WHERE stcid='$row[stcid]'");

                    $s=mysql_query("SELECT * FROM studentreg WHERE stid='$row[stid]'");
                    while($res=mysql_fetch_array($s))
                    {
                      echo $res['stfname']." ".$res['stlname'];
                    }
                     ?></td>
              <td><?php echo$row['desc'];?></td>
              <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo $date=$datetime[0].' ';
                                $time=$datetime[1];
                                echo date("g:ia",strtotime($time));?></td>
            </tr>
            <?php 
              $c++;
              }?>
            
        </table>
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
