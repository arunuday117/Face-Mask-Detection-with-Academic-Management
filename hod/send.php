<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='hod')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');//Databse connection
  //For inserting complaint details in to database
  //Date of creation:01/01/2021
  //Developed by Arun
  if(isset($_POST['add']))
  {
    $stid=$_POST['id'];//this is for getting student id
    $username=$_SESSION['username'];
    $message=$_POST['message'];//this is for getting complaints
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d h:i:sa');//current date
    $u=mysql_query("SELECT * FROM studentreg WHERE stid='$stid'");
    $ui=mysql_fetch_array($u);
    $uid=$ui['userid'];
    $sq="INSERT INTO message VALUES('NULL','$message','$uid','$date','$username','','','0')";//Data insertion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Message Send!!');</script>";
    }

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
</head>
<body>
  <div class="loader">
        <img src="../assets/images/loader.gif" alt="Loading..." />
    </div>
 <!--Form to Upload Timetable-->
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>
<div class="main">
    <div class="course">
        <div class="heading">
            <h6>SEND MESSAGE</h6>
        </div>
        <?php
          $username=$_SESSION['username'];
          $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
          $ro=mysql_fetch_array($sq);
          $course=$ro['course'];
        ?>
         <form  method="POST" action=""id="course">
        <select id="select" name="id" required>
            <option selected disabled>--Select Student--</option>
            <?php
              $st=mysql_query("SELECT * FROM studentreg NATURAL JOIN login WHERE studentreg.userid=login.userid AND course='$course' AND status='1'");
              while($row=mysql_fetch_array($st))
              {
            ?>
            <option value="<?php echo$row['stid']?>"><?php echo$row['stfname']." ".$row['stlname'];?></option>
          <?php }?>
           </select>
        <textarea type="text" name="message" placeholder="Enter Your Message" id="textarea"></textarea> 
        <br><br>
        <button type="submit" id="submit" name="add">SEND MESSAGE</button>
      </form>
         
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