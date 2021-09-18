<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='hod')
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
<!--
    
TemplateMo 557 Grad School

https://templatemo.com/tm-557-grad-school

-->
  </head>

<body>
<div class="loader">
        <img src="../assets/images/loader.gif" alt="Loading..." />
    </div>
   
  <!--header-->
 <?php
  include('includes/header.php');
 ?>

  <!-- ***** Main Banner Area Start ***** -->

  <div class="cover">
    <div class="table">
        <div class="table-heading">
            <h6>Students</h6>
        </div>
         <table >
            <tr id="header">
              <th>Id</th>
              <th>Student Name</th>
              <th>Address</th>
              <th>Phone No</th>     
              <th>Email</th>
            </tr>
              <?php
              $c=1;
              include 'includes/dbconnect.php';
              $username=$_SESSION['username'];
              $sq=mysql_query("SELECT course FROM departmentreg WHERE userid='$username'");
              $ro=mysql_fetch_array($sq);
              $course=$ro['course'];
              $result = mysql_query("SELECT * FROM studentreg NATURAL JOIN login WHERE studentreg.userid=login.userid AND type='student'AND course='$course'AND status='1'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $c;?></td>
              <td><?php echo $row['stfname'].'  '.$row['stlname'];?></td>
              <td><?php echo $row['sthousename'].' , '.$row['ststreet'].' , '.$row['stdistrict'].' , '.$row['ststate'].' , '.$row['stpincode'];?></td>
              <td><?php echo $row['stphone'];?></td>
              <td><?php echo $row['userid'];?></td>
              </tr>
            <?php 
              $c++;
              }?>
            
          </table>
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