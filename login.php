<?php
if(isset($_POST['login']))
{
	$username=$_POST['username'];
  $password=md5($_POST['password']);
  include('includes/dbconnect.php');
  date_default_timezone_set('Asia/Kolkata');// change according timezone
  $date=date('Y-m-d H:i:s',time());
  $result = mysql_query("SELECT * FROM login WHERE userid='$username'AND password='$password'",$con);
  $flag=0;
  $status='3';
  if($result)
  {
    while($row = mysql_fetch_array($result))
    {
      $status=$row['status'];
         if($status==1)
         {
          $flag=1;
          session_start();
          $type=$row['type'];
          $_SESSION['user'] = $type;
          $_SESSION['username'] = $username;
        }
    
    }
  }
  if($flag==1 && $type=="admin")
  {
    $result = mysql_query("UPDATE login SET login='$date' WHERE userid='$username'",$con);
    echo "<script>location.href='admin/index.php'</script>";
  }

  else if($flag==1 && $type=="hod")
  {
    $result = mysql_query("UPDATE login SET login='$date' WHERE userid='$username'",$con);
    echo "<script>location.href='hod/index.php'</script>";
  }
  else if($flag==1 && $type=="advisor")
  {
      $result = mysql_query("UPDATE login SET login='$date' WHERE userid='$username'",$con);
        echo "<script>location.href='advisor/index.php'</script>";
  }
  else if($flag==1 && $type=="student")
  {
    $result = mysql_query("UPDATE login SET login='$date' WHERE userid='$username'",$con);
    echo "<script>location.href='students/index.php'</script>";
  }
  else if($flag==1 && $type=="parent")
  {
    $result = mysql_query("UPDATE login SET login='$date' WHERE userid='$username'",$con);
    echo "<script>location.href='parents/index.php'</script>";
  }
  else if($flag==1 && $type=="staff")
  {
    $result = mysql_query("UPDATE login SET login='$date' WHERE userid='$username'",$con);
    echo "<script>location.href='staff/index.php'</script>";
  }
  else if($flag==1 && $type=="faculty")
  {
    $result = mysql_query("UPDATE login SET login='$date' WHERE userid='$username'",$con);
    echo "<script>location.href='faculty/index.php'</script>";
  }
  else if($status=='0')
    echo "<script>location.href='login.php?msg=Your account is not validated'</script>";
  else if($status=='2')
  {
    echo "<script>location.href='login.php?msg=Request for your account is rejected'</script>";
  }
  else
     echo "<script>location.href='login.php?msg=Invalid Username or Password'</script>";
    mysql_close($con);
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
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>

<body>
<div class="loader">
        <img src="assets/images/loader.gif" alt="Loading..." />
    </div>
   
  <!--header-->
 <?php
  include('includes/header.php');
 ?>

  <!-- ***** Main Banner Area Start ***** -->

  <section class="section coming-soon" data-section="section3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="right-content">
            <div class="top-content">
              <h6>LOGIN</h6>
               
            </div>
            <form id="contact" action="" method="post">
              <div class="row">
                <div class="col-md-5">
                  <fieldset>
                    <input name="username" type="email" class="form-control" id="username" placeholder="USERNAME" required>
                  </fieldset>
                </div>
                <div class="col-md-5">
                  <fieldset>
                    <input name="password" type="password" class="form-control" id="password" placeholder="PASSWORD" required>
                  </fieldset>
                </div>
                	<?php
          			     $msg="";
          			    
          			     if(isset($_GET['msg']))
          			     $msg=$_GET['msg'];
          			     if($msg=="Invalid Username or Password"||$msg=="Your account is not validated"||$msg=="Request for your account is rejected")
          			     echo "<font color=red >".$msg."</font>";
          			   ?>
                <div class="col-md-12">
                  <fieldset>
                    <button type="submit" id="form-submit" class="button" name="login">Login</button>
                    <a href="resetpass.php">Forget password</a>
                  </fieldset>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

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