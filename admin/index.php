<?php
  session_start();
  //authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='admin')
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

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
  <!----loader ---->
  <div class="loader">
    <img src="../assets/images/loader.gif" alt="Loading..." />
  </div>
  <!--header-->
  <?php
    include('includes/header.php');
  ?>
  <!-- ***** Admin Dashboard ***** -->
  <section class="section video" data-section="section5">
    <h3 class="dashboard">ADMIN DASHBOARD</h3>
    <div class="alert hide">
      <i class="fas fa-user-circle"></i>
      <span class="msg">WELCOME : ADMIN</span><br>
      <span class="msg-2">ADMINISTRATOR</span>
      <div class="close-btn">
        <span class="fas fa-times"></span>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="board">
          <div class="col-lg-3 col-6">
            <a class="small-box bg-info"href="viewhod.php">
              <div class="inner">
                <?php
                  include'includes/dbconnect.php';
                  $s="SELECT * FROM login WHERE type='hod' AND status='1'";
                  if($sql1=mysql_query($s,$con))
                  {
                  $num=mysql_num_rows($sql1);
                  echo "<h3>".$num."</h3>";
                  }
                  else
                  {
                    echo "<h3> 0</h3>";
                  }
                ?>
                <p>Registered Hods</p>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a class="small-box bg-success"href="viewadvisor.php" >
              <div class="inner">
                <?php
                  include'includes/dbconnect.php';
                  $s="SELECT * FROM login WHERE type='advisor' AND status='1'";
                  if($sql1=mysql_query($s,$con))
                  {
                  $num=mysql_num_rows($sql1);
                  echo "<h3>".$num."</h3>";
                  }
                  else
                  {
                    echo "<h3> 0</h3>";
                  }
                ?>
                <p>Registered Advisors</p>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a class="small-box bg-warning"href="viewfaculty.php" >
              <div class="inner">
                <?php
                  include'includes/dbconnect.php';
                  $s="SELECT * FROM login WHERE type='faculty' AND status='1'";
                  if($sql1=mysql_query($s,$con))
                  {
                  $num=mysql_num_rows($sql1);
                  echo "<h3>".$num."</h3>";
                  }
                  else
                  {
                    echo "<h3> 0</h3>";
                  }
                ?>
                <p>Registered Faculty</p>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a class="small-box bg-danger" href='viewstudent.php'>
              <div class="inner">
                <?php
                  include'includes/dbconnect.php';
                  $s="SELECT * FROM login WHERE type='student' AND status='1'";
                  if($sql1=mysql_query($s,$con))
                  {
                  $num=mysql_num_rows($sql1);
                  echo "<h3>".$num."</h3>";
                  }
                  else
                  {
                    echo "<h3> 0</h3>";
                  }
                ?>
                <p>Registered Students</p>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a class="small-box bg-parent"href='viewparent.php'>
              <div class="inner">
                <?php
                  include'includes/dbconnect.php';
                  $s="SELECT * FROM login WHERE type='parent' AND status='1'";
                  if($sql1=mysql_query($s,$con))
                  {
                  $num=mysql_num_rows($sql1);
                  echo "<h3>".$num."</h3>";
                  }
                  else
                  {
                    echo "<h3>0</h3>";
                  }
                ?>
                <p>Registered Parents</p>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-6">
            <a class="small-box bg-staff"href='viewstaff.php'>
              <div class="inner">
                <?php
                  include'includes/dbconnect.php';
                  $s="SELECT * FROM login WHERE type='staff' AND status='1'";
                  if($sql1=mysql_query($s,$con))
                  {
                  $num=mysql_num_rows($sql1);
                  echo "<h3>".$num."</h3>";
                  }
                  else
                  {
                    echo "<h3>0</h3>";
                  }
                ?>
                <p>Registered Staffs</p>
              </div>
            </a>
          </div>
        </div>    
      </div>
    </div>
  </section>

<!--footer-->
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
      $(document).ready(function(){
           $('.alert').addClass("show");
           $('.alert').removeClass("hide");
           $('.alert').addClass("showAlert");
           setTimeout(function(){
             $('.alert').removeClass("show");
             $('.alert').addClass("hide");
           },7000);
         });
         $('.close-btn').click(function(){
           $('.alert').removeClass("show");
           $('.alert').addClass("hide");
         });
    </script>
</body>
</html>