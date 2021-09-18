<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='advisor')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');//Databse connection
  $id=$_GET['id'];
  if(isset($_POST['add']))
  {
    $flag=0;
    $rlno=$_POST['rlno'];
    $f_name=$_POST['f_name'];
    $l_name=$_POST['l_name'];
    if(empty($rlno))
    {
        $error_msg['rlno']="**University Registration Number is required";
        $flag=1;
    }
    if(empty($f_name))
    {
      $error_msg['f_name']="**First Name is required";
      $flag=1;
    }
    if(empty($l_name))
    {
      $error_msg['l_name']="**Last Name is required";
      $flag=1;
    }
    if($flag!=1)
    { 
        if (!preg_match('/^\d{11}$/', $rlno))
        {
            $error_msg['rlno']="*Invalid Registration Number";
            $flag=1;
        }
        if (!preg_match('/^[a-zA-Z]*$/',$f_name))
        {
            $error_msg['f_name']="*Invalid first name"; 
            $flag=1;                  
        }
        if (!preg_match('/^[a-zA-Z]*$/',$l_name))
        {
            $error_msg['l_name']="*Invalid last name";
            $flag=1;
        }
    }
    if($flag==0)
    {
      $sq="UPDATE studentlist SET rlno='$rlno',sfname='$f_name',slname='$l_name' WHERE rlno='$id' ";//Data updation code
      if(mysql_query($sq,$con))
      {
        echo "<script>alert('Student Details Updated')</script>";
        echo"<script>location.href='addstudents.php';</script>";

      }
      else
      {
        echo "<script>alert('Something went wrong')</script>";
      }

    }
    else
    {
       echo "<script>alert('Somethings not correct')</script>";
    }
  }
  if($_GET['task']=='del')
  {
     $sq="DELETE FROM studentlist WHERE rlno='$id' ";//Data Deletion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Student Details Deleted!!');</script>";
      echo"<script>location.href='addstudents.php';</script>";
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
    <script src="vendor/jquery/jquery.min.js"></script>
  </head>

<body>
  <!----loader---->
  <div class="loader">
    <img src="../assets/images/loader.gif" alt="Loading..." />
  </div>
  <!--header-->
  <?php
  include('includes/header.php');
  if($_GET['task']=='up')
  {
  ?>
  <!-- ***** Update Students ***** -->
  <div class="main">
    <div class="course">
      <div class="heading">
        <h6>Update Student</h6>
      </div>
      <?php
        $id=$_GET['id'];
        $sq=mysql_query("SELECT * FROM studentlist WHERE rlno='$id'");
        while($ro=mysql_fetch_array($sq))
        {
      ?>
      <form  method="POST" action=""id="course">
        <input type="text" name="rlno" id="name" value="<?php echo $ro['rlno'];?>">
        <?php
          if(isset($error_msg['rlno']))
          {
              echo "<font color=red >".$error_msg['rlno']."</font>";
          }
          ?>
        <input type="text" name="f_name"id="name"value="<?php echo $ro['sfname'];?>">
        <?php
          if(isset($error_msg['f_name']))
          {
              echo "<font color=red >".$error_msg['f_name']."</font>";
          }
          ?>
        <input type="text" name="l_name" value="<?php echo $ro['slname'];?>" id="name">
        <?php
          if(isset($error_msg['l_name']))
          {
              echo "<font color=red >".$error_msg['l_name']."</font>";
          }
          ?>
        <input type="text" name="batch" readonly value="<?php echo $ro['batch'];?>" id="name">
        <button type="submit" id="submit" onclick="return confirm('Do you want to continue?')"name="add">Update</button>
      </form>
    <?php }?>
    </div>
  </div>
  <?php }?>
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
