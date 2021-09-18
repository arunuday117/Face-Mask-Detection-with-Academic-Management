<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='staff')
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/css/loader.css">
  <link rel="stylesheet" href="assets/css/test.css">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script>
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }
    </script>
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
 
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="assets/images/course-video.mp4" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
        <div class="alert hides">
           <i class="fas fa-user-circle"></i>
           <span class="msg">WELCOME : <?php 
                                        include 'includes/dbconnect.php';
                                        $username=$_SESSION['username'];
                                        $sq=mysql_query("SELECT * FROM staffreg WHERE userid='$username'");
                                        $row=mysql_fetch_array($sq);
                                        echo $row['sfname'].' '.$row['slname'];  ?></span><br>
           <span class="msg-2">STAFF</span>
           <div class="close-btn">
              <span class="fas fa-times"></span>
         </div>
        </div>
          <div class="caption">
              <h6>Anv Academics</h6>
              <h2><em>Your</em> Academic Companion</h2>
          </div>
      </div>
  </section>

  <?php include'includes/footer.php';?>


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
    <script type="text/javascript">
      window.addEventListener("load", function (){
            const loader = document.querySelector(".loader");
            loader.className += " hidden"; // class "loader hidden"
  });
      $(document).ready(function(){
           $('.alert').addClass("show");
           $('.alert').removeClass("hides");
           $('.alert').addClass("showAlert");
           setTimeout(function(){
             $('.alert').removeClass("show");
             $('.alert').addClass("hides");
           },7000);
         });
         $('.close-btn').click(function(){
           $('.alert').removeClass("show");
           $('.alert').addClass("hides");
         });
    </script>
</body>
</html>