<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='admin')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include'includes/dbconnect.php';
  if(isset($_POST['submit']))
  {
    $flag=0;
    $pass=$_POST['password'];//old password
    $email=$_SESSION['username'];//username
    $newpass=$_POST['newpassword'];//new password
    $confirmpass=$_POST['confirmpassword'];//confirm password
    if(empty($pass))
    {        
        $error_msg['password']="**Current Password is required";
        $flag=1;
    }
    if(empty($newpass))
    {        
        $error_msg['newpassword']="**New Password is required";
        $flag=1;
    }
    if(empty($confirmpass))
    {        
        $error_msg['confirmpassword']="**Confirm Password is required";
        $flag=1;
    }
    if($flag!=1)
    { 
        if (!preg_match("/^[A-Z\d]/",$newpass)||strlen($newpass)<8)
        {
            $error_msg['newpassword']="*Password should be at least 8 characters in length and should include at least one uppercase letter, one number and one special character";
            $flag=1;
        }
        if (!preg_match("/^[A-Z\d]/",$confirmpass)||strlen($confirmpass)<8)
        {
            $error_msg['confirmpassword']="*Password should be at least 8 characters in length and should include at least one uppercase letter, one number and one special character";
            $flag=1;
        }
        if($pass==$newpass)
        {
            $error_msg['newpassword']="*Enter a new password";
            $flag=1;
        }
        if($newpass!=$confirmpass)
        {
            $error_msg['newpassword']="*Passwords doesn't match";
            $flag=1;
        }
    }
    if($flag==0)
    {
      $pass=md5($_POST['password']);
      $email=$_SESSION['username'];
      $newpass=md5($_POST['newpassword']);
      $confirmpass=md5($_POST['confirmpassword']);
      $sql=mysql_query("SELECT * FROM  login WHERE password='$pass' AND userid='$email'",$con);
      if($sql)
      {
        $sqli=mysql_query("UPDATE login set password='$newpass' WHERE userid='$email'",$con);
        echo"<script>alert('Password Successfull Changed');</script>";
      }
      else
      {
        echo "<script>alert('Cannot Update');</script>";
      }
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
    <script type="text/javascript">
      if(performance.navigation.type==2){
        location.reload(true);//code for previous page
      }
    </script>
  </head>

<body>
  <!----loader---->
  <div class="loader">
    <img src="../assets/images/loader.gif" alt="Loading..." />
  </div>
  <!--header-->
  <?php
    include('includes/header.php');
  ?>

  <!-- ***** Change Passord ***** -->

  <div class="main">
    <div class="course">
      <div class="heading">
        <h6>CHANGE PASSWORD</h6>
      </div>
      <form  method="POST" action=""id="course">
        <label>Current Password</label><br>
        <input type="text" name="password" placeholder="Enter Current Password" id="name"><br>
        <?php
          if(isset($error_msg['password']))
          {
            echo "<font color=red >".$error_msg['password']."</font><br>";
          }
        ?>
        <label>New Password</label><br>
        <input type="text" name="newpassword" placeholder="Enter New Password" id="name"><br>
        <?php
          if(isset($error_msg['newpassword']))
          {
            echo "<font color=red >".$error_msg['newpassword']."</font><br>";
          }
        ?>
        <label>Confirm Password</label><br>
        <input type="text" name="confirmpassword" placeholder="Confirm Password" id="name"><br>
        <?php
          if(isset($error_msg['confirmpassword']))
          {
            echo "<font color=red >".$error_msg['confirmpassword']."</font><br>";
          }
        ?>
        <button type="submit" id="submit" name="submit">Change</button>
      </form>
    </div>
  </div>
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
    </script>
</body>
</html>