<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='student')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
include('includes/dbconnect.php');
$id=$_GET['id'];
$username=$_SESSION['username'];
if(isset($_POST['add']))
{
    $sql="select max(amid) as amid from assignmentmark";
    $data=mysql_query($sql);
    while($row=mysql_fetch_array($data))
    {
     $amid=$row['amid'];
    }
  $amid=$amid+1;
  $sql="SELECT * FROM studentreg WHERE userid='$username'";
  $query=mysql_query($sql);
  while($row=mysql_fetch_array($query))
  {
  $stid=$row['stid'];
  }
  $target_dir = "../uploads/assignment/";//target folder
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d');//current date
    $file=$_FILES['fileToUpload'];
    $target_file =basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $msg='';
    $msg1='';
    $msg2='';
    $msg3='';
    $msg4='';
    $newfilename=$target_dir .$amid.".".$FileType;
  // Check if file already exists
  if (file_exists($target_file)) {
      $msg="Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 100485760) {
    //100MB file limit
      $msg1="Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($FileType != "pdf") {
      $msg2="Sorry, only PDF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      $msg3="Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } 
  else 
  {
      if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) 
      {  
        $sql="INSERT INTO assignmentmark VALUES('$amid','$id','$date','$stid',NULL)";
        if(mysql_query($sql))
        {
            echo"<script>location.href='viewassignment.php';</script>";
            echo"<script>alert('Assignment has been succesfully uploaded');</script>";
        }
        else{$msg="ERROR";}
      } 
      else 
      {
          $msg="Sorry, there was an error uploading your file.";
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
            <h6>Upload Assignment</h6>
        </div>
        <form action="" method="post" id="course" enctype="multipart/form-data">
           <input type="file" name="fileToUpload" id="file" required>
            <span id="error"><?php 
           if(isset($msg)||isset($msg1)||isset($msg2)||isset($msg4))
            {
              echo$msg;
              echo$msg1;
              echo$msg2;
              echo$msg3;
              echo $msg4;
            }
            else
            {
              echo"Choose a file";
            }
            ?></span>
           <button type="submit" id="submit" name="add">Upload</button>
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

