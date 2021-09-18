<?php
  include'includes/dbconnect.php';
  if(isset($_POST['submit']))
  {
    $flag=0;
    $email=$_POST['email'];
    $newpass=$_POST['newpassword'];
    $confirmpass=$_POST['confirmpassword'];
    if(empty($email))
    {
      $error_msg['email']="**Email ID is required";
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
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error_msg['email']="*Invalid email";
            $flag=1;
        }
        if (!preg_match("/^[A-Z\d]/",$newpass)||!preg_match('/[^\w]/', $password)||strlen($newpass)<8)
        {
            $error_msg['newpassword']="*Password should be at least 8 characters in length and should include at least one uppercase letter, one number and one special character";
            $flag=1;
        }
        if (!preg_match("/^[A-Z\d]/",$confirmpass)||!preg_match('/[^\w]/', $password)||strlen($confirmpass)<8)
        {
            $error_msg['confirmpassword']="*Password should be at least 8 characters in length and should include at least one uppercase letter, one number and one special character";
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
      $newpass=md5($_POST['newpassword']);
      $confirmpass=md5($_POST['confirmpassword']);
      $sql=mysql_query("SELECT * FROM  login WHERE userid='$email'",$con);
      if($sql)
      {
        $sqli=mysql_query("UPDATE login set password='$newpass' WHERE userid='$email'",$con);
        echo"<script>alert('Password Successfully Changed');</script>";
        echo"<script>location.href='login.php';</script>";
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
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script type="text/javascript">
      if(performance.navigation.type==2){
        location.reload(true);//code for previous page
      }
    </script>
<!--TemplateMo 557 Grad Schoolhttps://templatemo.com/tm-557-grad-school-->
  </head>

<body>
<div class="loader">
        <img src="assets/images/loader.gif" alt="Loading..." />
    </div>
   
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>

  <!-- ***** Table for viewing advisor requests ***** -->

  <section class="section coming-soon" data-section="section3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="right-content">
            <div class="top-content">
              <h6>Forget Password</h6>
            </div>
            <form id="contact" action="" method="post">
              <div class="row">
              <form  method="POST" action=""id="course">
                <div class="col-md-12">
                  <fieldset>
                  <input type="text" name="email" class="form-control" placeholder="Enter Your Email Id" id="name"required><br>
                  <?php
                    if(isset($error_msg['email']))
                    {
                      echo "<font color=red >".$error_msg['email']."</font><br>";
                    }
                  ?>
                </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                  <input type="text" name="newpassword" class="form-control" placeholder="Enter New Password" id="name"required><br>
                  <?php
                    if(isset($error_msg['newpassword']))
                    {
                      echo "<font color=red >".$error_msg['newpassword']."</font><br>";
                    }
                  ?>
                </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                  <input type="text" name="confirmpassword" class="form-control" placeholder="Confirm Password" id="name"required><br>
                  <?php
                    if(isset($error_msg['confirmpassword']))
                    {
                      echo "<font color=red >".$error_msg['confirmpassword']."</font><br>";
                    }
                  ?>
                </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                  <button type="submit" id="form-submit" name="submit">Change</button>
                </fieldset>
                </div>
              </div>
            </form>
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
    </script>
</body>
</html>