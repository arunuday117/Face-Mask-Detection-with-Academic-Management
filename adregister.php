<?php
include 'includes/dbconnect.php';
$sql="select max(did) as did from departmentreg";
$data=mysql_query($sql);
$id=0;
while($row=mysql_fetch_array($data))
{
 $did=$row['did'];
}

$did=$did+1;
if(isset($_POST['register']))
{
	$flag=0;
    $first_name=$_POST['fname'];
    $last_name=$_POST['lname'];
    $email=$_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $phone=$_POST['phone'];
    $housename=$_POST['housename'];
    $street=$_POST['street'];
    $district=$_POST['district'];
    $state=$_POST['state'];
    $pin=$_POST['pincode'];
    $qualification=$_POST['qualification'];
    $experience=$_POST['experience'];
    if($_POST['published']=='')
    {
        $published='NULL';
    }
    else 
    {
        $published=$_POST['published'];   
    }
    $course=$_POST['course'];
    $batch=$_POST['batch'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
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
    if(empty($qualification))
    {
    	$error_msg['qualification']="**Qualification is required";
    	$flag=1;
    }
    if(empty($experience))
    {
    	$error_msg['experience']="**Experience is required";
    	$flag=1;
    }
    if(empty($course))
    {
        $error_msg['course']="**Course is required";
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
        $data="SELECT * FROM departmentreg natural join login";
        $c=0;
        $sd="SELECT * FROM departmentreg";
        $p=mysql_query($sd,$con);
        while($row=mysql_fetch_array($p))
        {
            $c++;
        }
        $c++;
        $sql=mysql_query($data,$con);
        while($row=mysql_fetch_array($sql))
        {
            if($row['userid']==$email||$row['phone']==$phone)
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
            $sql="INSERT INTO `departmentreg`VALUES ('$did','$first_name','$last_name','$email','$housename','$street','$district','$state','$pin','$phone','$qualification','$experience','$published','$course','$batch')";
            if(mysql_query($sql,$con))
            {
                $sql="INSERT INTO `login`VALUES ('$email','$pass','advisor',0,'','')";
                if(mysql_query($sql,$con))
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
              <h6>ADVISOR REGISTER</h6>
            </div>
            <form id="contact" action="" method="post">
              <div class="row">
                <div class="col-md-12">
                  <fieldset>
                    <input name="fname" type="text" class="form-control" id="name" placeholder="First Name" value="<?php if(isset($first_name)){echo $first_name;}  ?>" required>
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
                    <input name="lname" type="text" class="form-control" id="name" placeholder="Last Name"value="<?php if(isset($last_name)){echo $last_name;}  ?>"required>
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
                    <input name="qualification" type="text" class="form-control" id="qualification" placeholder="Qualification"value="<?php if(isset($qualification)){echo $qualification;}  ?>"required>
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['qualification']))
                    {
                        echo "<font color=red >".$error_msg['qualification']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <input name="experience" type="text" class="form-control" id="experience" placeholder="Years of Experience"value="<?php if(isset($experience)){echo $experience;}  ?>"required>
                  </fieldset>
                </div>
                <?php
                    if(isset($error_msg['experience']))
                    {
                        echo "<font color=red >".$error_msg['experience']."</font>";
                    }
                  	?>
                <div class="col-md-12">
                  <fieldset>
                    <textarea name="published" type="text" class="form-control" id="published" placeholder="Papers Published"value="<?php if(isset($published)){echo $published;}  ?>"></textarea>
                  </fieldset>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <select id="select"name="course" required>
                      <option selected value="" disabled>--Select Course--</option>
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
                    <input name="batch" type="text" class="form-control" id="batch" placeholder="Batch (eg..2018-2021)"value="<?php if(isset($batch)){echo $batch;}  ?>" required>
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
