<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='faculty')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');
  $username=$_SESSION['username'];
  $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sq);
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
    <div class="bt">
        <a id="bt1" class="btn active">Your Department</a>
        <a id="bt2" class="btn">Different Department</a>
      </div>
    <div class="course">
      <div class="heading">
            <h6>Add Mark</h6>
        </div>
         <?php
        $course=$ro['course'];
      ?>
      <div class="hide" id='1'>
      <form  method="POST" action="fetch.php"id="course">
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
           <select id="select" name="subject" required>
          <option value="" selected disabled>--Select Subject--</option>
          <?php
            $st=mysql_query("SELECT * FROM subject WHERE sbcourse='$course'");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['sbname'];?>"><?php echo $row['sbname'];?></option>
        <?php }?>
         </select><br><br>
         <input type="text" class="name" name="course" value="<?php echo$course; ?>">
        <input type="number" class="name" name="outof" placeholder="Enter Total Mark For Test"> 
        <input type="text" class="name" id="myInput" name="batch" placeholder="Enter Year Of batch"> 
        <br><br>
        <button type="submit" id="submit" onclick="return confirm('Do you want to continue?')" name="submit">submit</button>
      </form>
    </div>
    <div class="hide" id='2'>
      <form  method="POST" action="fetch.php"id="course">
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
           <select id="select" name="subject" required>
          <option value="" selected disabled>--Select Subject--</option>
          <?php
            $st=mysql_query("SELECT * FROM subject WHERE sbcourse!='$course'");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['sbname'];?>"><?php echo $row['sbname'];?></option>
        <?php }?>
         </select><br><br>
         <select id="select" name="course" required>
          <option value="" selected disabled>--Select Course--</option>
          <?php
            $st=mysql_query("SELECT * FROM course WHERE cname!='$course'");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['cname'];?>"><?php echo $row['cname'];?></option>
        <?php }?>
         </select><br><br>
        <input type="number" class="name" name="outof" placeholder="Enter Total Mark For Test"> 
        <input type="text" class="name" id="myInput" name="batch" placeholder="Enter Year Of batch"> 
        <br><br>
        <button type="submit" id="submit" onclick="return confirm('Do you want to continue?')" name="submit">submit</button>
      </form>
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
    <script>
</script>
</body>
</html>

