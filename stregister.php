<?php
include 'includes/dbconnect.php';
if(isset($_POST['register']))
{
	$flag=0;
    $regno=$_POST['regno'];
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $housename=$_POST['housename'];
    $street=$_POST['street'];
    $district=$_POST['district'];
    $state=$_POST['state'];
    $pin=$_POST['pincode'];
    $whatsapp=$_POST['whatsapp'];
    $fname=$_POST['fname'];
    $course=$_POST['course'];
    $batch=$_POST['batch'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    if(empty($regno))
    {
        $error_msg['regno']="**University Registration Number is required";
        $flag=1;
    }
    if(empty($first_name))
    {
    	$error_msg['first_name']="**First Name is required";
    	$flag=1;
    }
    if(empty($housename))
    {
    	$error_msg['housename']="**House Name is required";
    	$flag=1;
    }
    if(empty($email))
    {
    	$error_msg['email']="**Email ID is required";
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
    if(empty($fname))
    {
    	$error_msg['fname']="**Father's Name is required";
    	$flag=1;
    }
    if(empty($course))
    {
        $error_msg['course']="**Course Name is required";
        $flag=1;
    }
    if(empty($batch))
    {
        $error_msg['batch']="**Batch is required";
        $flag=1;
    }
    if(empty($password))
    {        
        $error_msg['password']="**Password is required";
        $flag=1;
    }
    if($flag!=1)
    {	
        if (!preg_match("/^\d{11}$/", $regno))
        {
            $error_msg['regno']="*Invalid Registration Number";
            $flag=1;
        }
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
            $error_msg['phone']="*Invalid Phone Number";
            $flag=1;
        }
        if (!preg_match("/^[6-9]\d{9}$/", $whatsapp))
        {
            $error_msg['phone']="*Invalid Phone Number";
            $flag=1;
        }
        if (!preg_match("/^[2][0]\d{2}-[2][0]\d{2}$/", $batch))
        {
            $error_msg['batch']="*Invalid batch eg.(2018-2021)";
            $flag=1;
        }
        if (!preg_match("/^[1-9]\d{5}$/", $pin))
        {
            $error_msg['pin']="*Invalid pin";
            $flag=1;
        }
        if (!preg_match("/^[A-Z\d]/",$password)||!preg_match('/[^\w]/', $password)||strlen($password)<8)
        {
            $error_msg['password']="*Password should be at least 8 characters in length and should include at least one uppercase letter, one number and one special character";
            $flag=1;
        }
        if($password!=$cpassword)
        {
            $error_msg['password']="*Passwords doesn't match";
            $flag=1;
        }
    }
    if($flag==0)
    {
        $pass=md5($_POST['password']);
        $data="SELECT * FROM studentreg natural join login";
        $c=0;
        $sd="SELECT * FROM studentreg";
        $p=mysql_query($sd,$con);
        while($row=mysql_fetch_array($p))
        {
            $c++;
        }
        $c++;
        $sq=mysql_query($data,$con);
        while($row=mysql_fetch_array($sq))
        {
            if($row['userid']==$email||$row['stid']==$regno||$row['stphone']==$phone)
            {
                $flag=1;
            }
        }
        if($flag==1)
        {
            echo"<script>alert('This  account already exits');</script>";
        }
        else if($flag==0)
        {
            $sql="INSERT INTO `studentreg`VALUES ('$regno','$first_name','$last_name','$email','$housename','$street','$district','$state','$pin','$phone','$whatsapp','$fname','$course','$batch')";
            if(mysql_query($sql,$con))
            {
                $sql1="INSERT INTO `login`VALUES ('$email','$pass','student',0,'','')";
                if(mysql_query($sql1,$con))
                {
                    echo"<script>alert('Account created ! Please login ');</script>";
                    echo"<script>location.href='login.php';</script>";
                }
            }
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
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
              <h6>STUDENT REGISTER</h6>
            </div>
            <form id="contact" action="" method="post">
              <div class="row">
                <div class="col-md-12">
                  <fieldset>
                    <input name="regno" type="text" class="form-control" id="regno" placeholder="University Register Number" value="<?php if(isset($regno)){echo $regno;}  ?>"required>
                  </fieldset>
                </div>
                    <?php
                    if(isset($error_msg['regno']))
                    {
                        echo "<font color=red >".$error_msg['regno']."</font>";
                    }
                    ?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="first_name" type="text" class="form-control" id="name" placeholder="First Name" value="<?php if(isset($first_name)){echo $first_name;}  ?>"required>
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
                    <input name="last_name" type="text" class="form-control" id="name" placeholder="Last Name"value="<?php if(isset($last_name)){echo $last_name;}  ?>">
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
                    <input name="email" type="email" class="form-control" id="email" placeholder=" Email ID"value="<?php if(isset($email)){echo $email;}  ?>"required>
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
                    <input name="housename" type="text" class="form-control" id="housename" placeholder="House Name"value="<?php if(isset($housename)){echo $housename;}  ?>"required>
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
                    <input name="street" type="text" class="form-control" id="street" placeholder="Street Name"value="<?php if(isset($street)){echo $street;}  ?>"required>
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
                    <input name="district" type="text" class="form-control" id="district" placeholder="District"value="<?php if(isset($district)){echo $district;}  ?>"required>
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
                    <input name="state" type="text" class="form-control" id="state" placeholder="State"value="<?php if(isset($state)){echo $state;}  ?>"required>
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
                    <input name="pincode" type="text" class="form-control" id="pincode" placeholder="Pincode" value="<?php if(isset($pin)){echo $pin;}  ?>"required>
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
                    <input name="phone" type="text" class="form-control" id="phone-number" placeholder="Your Phone Number"value="<?php if(isset($phone)){echo $phone;}  ?>"required>
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
                    <input name="whatsapp" type="text" class="form-control" id="whatsapp" placeholder="Your Whatsapp Number"value="<?php if(isset($whatsapp)){echo $whatsapp;}  ?>"required>
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['whatsapp']))
                    {
                        echo "<font color=red >".$error_msg['whatsapp']."</font>";
                    }
                    ?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="fname" type="text" class="form-control" id="fname" placeholder="Father's Name"value="<?php if(isset($fname)){echo $fname;}  ?>"required>
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['fname']))
                    {
                        echo "<font color=red >".$error_msg['fname']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <select id="select"name="course" required>
                      <option value="" selected disabled>--Select Course--</option>
                        <?php
                          $sq=mysql_query("SELECT * FROM course");
                          while ($ro=mysql_fetch_array($sq)) {
                          ?>
                          <option value="<?php echo $ro['cname']; ?>"><?php echo$ro['cname'];?></option>
                        <?php }?>
                  </select>
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['course']))
                    {
                        echo "<font color=red >".$error_msg['course']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="batch" type="text" class="form-control" id="batch" placeholder="Batch"value="<?php if(isset($batch)){echo $batch;}  ?>"required>
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['batch']))
                    {
                        echo "<font color=red >".$error_msg['batch']."</font>";
                    }
                    ?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="password" type="text" class="form-control" id="password" placeholder="Password"required>
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
                    <input name="cpassword" type="text" class="form-control" id="cpassword" placeholder="Confirm Password"required>
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <button type="submit" id="form-submit" class="button" name="register">Register</button>
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
