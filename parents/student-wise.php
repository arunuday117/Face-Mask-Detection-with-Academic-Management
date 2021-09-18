<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='parent')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
include('includes/dbconnect.php');
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
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>
  <!-- ***** Course creation ***** -->
  <div class="main">
    <div class="course">
      <div class="heading">
            <h6>Download Student Wise Marklist</h6>
        </div>
         <?php
        $username=$_SESSION['username'];
        $q=mysql_query("SELECT * FROM parentreg WHERE userid='$username'");
        $r=mysql_fetch_array($q);
        $stid=$r['stid'];
        $sq=mysql_query("SELECT * FROM studentreg WHERE stid='$stid'");
        $ro=mysql_fetch_array($sq);
        $course=$ro['course'];
        $batch=$ro['batch'];
      ?>
      <form  method="POST" action="pdf.php"id="course">
        <input type="hidden" name="course" value="<?php echo$course;?>">
        <select id="select" name="type" required>
            <option value="" selected disabled>--Select Exam Type--</option>
            <option value="Class Test">Class Test</option>
            <option value="Series Exam">Series Exam</option>
            <option value="Model Test">Model Test</option>
           </select><br>
          <select id="select" name="sem" required>
            <option value="" selected disabled>--Select Semester--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
           </select><br>
           <select id="select" name="subject">
          <option value="" selected>--Select Subject--</option>
          <?php
            $st=mysql_query("SELECT * FROM subject WHERE sbcourse='$course'");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['sbname'];?>"><?php echo $row['sbname'];?></option>
        <?php }?>
         </select><br><br>
           <input type="number" id="name" name="id" required placeholder="Enter Roll No"> 

           <input type="checkbox" name="previous">View Previous<br>

        <button type="submit" id="submit" name="stu">DOWNLOAD</button>
      </form>
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

