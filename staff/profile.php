<?php
session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='staff')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
include 'includes/dbconnect.php';
$username=$_SESSION['username'];
$sql=mysql_query("SELECT * FROM staffreg WHERE userid='$username'");
$row=mysql_fetch_array($sql);
$btn='';
$flag=0;
if(isset($_POST['pass']))
{
    $btn='pass';
    $cupassword=md5($_POST['cupassword']);
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    if(empty($cupassword))
    {        
        $error_msg['cupassword']="**Current Password is required";
        $flag=1;
    }
    if(empty($password))
    {        
        $error_msg['password']="**Password is required";
        $flag=1;
    }
    if (!preg_match("/^[A-Z\d]/",$cupassword)||strlen($cupassword)<8)
    {
        $error_msg['password']="*Password should be at least 8 characters in length and should include at least one uppercase letter, one number and one special character";
        $flag=1;
    }
     if (!preg_match("/^[A-Z\d]/",$password)||strlen($password)<8)
    {
        $error_msg['password']="*Password should be at least 8 characters in length and should include at least one uppercase letter, one number and one special character";
        $flag=1;
    }
    $pa=mysql_query("SELECT * FROM login WHERE userid='$username'");
    $p=mysql_fetch_array($pa);
    $cupass=$p['password'];
    if($cupassword==$cupass)
    {
        if($password!=$cpassword)
        {
            $error_msg['password']="*Passwords doesn't match";
            $flag=1;
        }
        $pass=md5($_POST['password']);
        if($flag==0)
        {
            $sql="UPDATE`login`SET password='$pass'WHERE userid='$username'";
            if(mysql_query($sql,$con))
            {
                $btn='success';
                echo"<script>alert('Password Updated');</script>";
                echo"<script>location.href='profile.php';</script>";
            }
        }
    }
    else
    {
        $error_msg['cupassword']="*Incorrect Password";
    }
    
}
if(isset($_POST['update']))
{
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $housename=$_POST['housename'];
    $street=$_POST['street'];
    $district=$_POST['district'];
    $state=$_POST['state'];
    $pin=$_POST['pincode'];
    $sposition=$_POST['sposition'];
    if(empty($first_name))
    {
    	$error_msg['first_name']="**First Name is required";
    	$flag=1;
    }
    if(empty($housename))
    {
    	$error_msg['housename']="**Email ID is required";
    	$flag=1;
    }
    if(empty($email))
    {
    	$error_msg['email']="**House Name is required";
    	$flag=1;
    }
    if(empty($street))
    {
    	$error_msg['street']="**Street Name is required";
    	$flag=1;
    }
    if(empty($district))
    {
    	$error_msg['district']="**District is required";
    	$flag=1;
    }
    if(empty($state))
    {
    	$error_msg['state']="**State is required";
    	$flag=1;
    }
    if(empty($pin))
    {
    	$error_msg['pin']="**Pincode is required";
    	$flag=1;
    }
    if(empty($phone))
    {
    	$error_msg['phone']="**Phone number is required";
    	$flag=1;
    }
    if(empty($sposition))
    {
      $error_msg['sposition']="**Position is required";
      $flag=1;
    }
    if($flag!=1)
    {	
        if (!preg_match('/^[a-zA-Z]*$/',$first_name))
        {
            $error_msg['first_name']="*Invalid name"; 
            $flag=1;                  
        }
        if (!preg_match('/^[a-zA-Z]*$/',$last_name))
        {
            $error_msg['last_name']="*Invalid name";
            $flag=1;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error_msg['email']="*Invalid email";
            $flag=1;
        }
        if (!preg_match("/^[6-9]\d{9}$/", $phone))
        {
            $error_msg['phone']="*Invalid phone";
            $flag=1;
        }
        if (!preg_match("/^[1-9]\d{5}$/", $pin))
        {
            $error_msg['pin']="*Invalid pin";
            $flag=1;
        }
       
    }
    if($flag==0)
    {
        $sql="UPDATE`staffreg`SET sfname='$first_name',slname='$last_name',shousename='$housename',sstreet='$street',sdistrict='$district',sstate='$state',spincode='$pin',sphone='$phone',sposition='$sposition'WHERE userid='$username'";
        if(mysql_query($sql,$con))
        {
            
            echo"<script>alert('Profile Updated');</script>";
            echo"<script>location.href='profile.php';</script>";
        }
        
    }
    $btn='up';
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
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

  <section class="section coming-soon" data-section="section3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="right-content">
            <div class="bt">
                <a id="bt1" class="btn active">Account</a>
                <a id="bt2" class="btn">Change Password</a>
              </div>
            <div class="hide" id='1'>
            <div class="top-content">
              <h6>Profile</h6>
            </div>
            <form id="contact" action="" method="post">
              <div class="row">
                <div class="col-md-12">
                  <fieldset>
                    <input name="first_name" type="text" class="form-control"placeholder="First Name" id="name"value="<?php echo$row['sfname'];  ?>">
                  </fieldset>
                </div>
                    <?php
                    if(isset($error_msg['first_name']))
                    {
                        echo "<font color=red >".$error_msg['first_name']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="last_name" type="text" class="form-control" id="name" placeholder="Last Name"value="<?php echo$row['slname'];  ?>">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['last_name']))
                    {
                        echo "<font color=red >".$error_msg['last_name']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="email" readonly type="text" class="form-control" id="email" placeholder=" Email ID"value="<?php echo$row['userid'];  ?>">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['email']))
                    {
                        echo "<font color=red >".$error_msg['email']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="housename" type="text" class="form-control" id="housename" placeholder="House Name"value="<?php echo$row['shousename'];  ?>">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['housename']))
                    {
                        echo "<font color=red >".$error_msg['housename']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="street" type="text" class="form-control" id="street" placeholder="Street Name"value="<?php echo$row['sstreet'];  ?>">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['street']))
                    {
                        echo "<font color=red >".$error_msg['street']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="district" type="text" class="form-control" id="district" placeholder="District"value="<?php echo$row['sdistrict'];  ?>">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['district']))
                    {
                        echo "<font color=red >".$error_msg['district']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="state" type="text" class="form-control" id="state" placeholder="State"value="<?php echo$row['sstate'];  ?>">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['state']))
                    {
                        echo "<font color=red >".$error_msg['state']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="pincode" type="text" class="form-control" id="pincode" placeholder="Pincode" value="<?php echo$row['spincode'];  ?>">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['pin']))
                    {
                        echo "<font color=red >".$error_msg['pin']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="phone" type="text" class="form-control" id="phone-number" placeholder="Your Phone Number"value="<?php echo$row['sphone'];  ?>">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['phone']))
                    {
                        echo "<font color=red >".$error_msg['phone']."</font>";
                    }
                  	?>
                    <div class="col-md-12">
                  <fieldset>
                    <input name="sposition"placeholder="Your Position" type="text" class="form-control" id="sposition"value="<?php echo$row['sposition'];  ?>">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['sposition']))
                    {
                        echo "<font color=red >".$error_msg['sposition']."</font>";
                    }
                    ?>
               </div>
               <div class="col-md-12">
                  <fieldset>
                    <button type="submit" id="form-submit" class="button" name="update">Update</button>
                  </fieldset>
                </div>
            </form>
          </div>
          <div class="hide" id='2'>
            <div class="top-content">
              <h6>Password</h6>
            </div>
            <form id="contact" action="" method="post">
              <div class="row">
                <div class="col-md-12">
                  <fieldset>
                    <input name="cupassword" type="text" class="form-control" id="cupassword" placeholder="Current Password">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['cupassword']))
                    {
                        echo "<font color=red >".$error_msg['cupassword']."</font>";
                    }
                    ?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="password" type="text" class="form-control" id="password" placeholder="New Password">
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['password']))
                    {
                        echo "<font color=red >".$error_msg['password']."</font>";
                    }
                    ?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="cpassword" type="text" class="form-control" id="cpassword" placeholder="Confirm Password">
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <button type="submit" id="form-submit pass" class="button" name="pass">Change</button>
                  </fieldset>
                </div>
              </div>
            </form>
           </div> 
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
      $("#1").show();
      var btn="<?php echo$btn; ?>";
      if(btn=='pass')
      {
        $("#2").show();
        $("#1").hide();
      }
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

            // If there's no active class
            if (current.length > 0) {
              current[0].className = current[0].className.replace(" active", "");
            }

            // Add the active class to the current/clicked button
            this.className += " active";
          });
        }
    </script>
</body>
</html>
