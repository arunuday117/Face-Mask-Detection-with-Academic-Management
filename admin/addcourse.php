<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='admin')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');//Databse connection
  //For inserting course details in to database
  if(isset($_POST['add']))
  {
    $sql="select max(cid) as cid from course";
    $data=mysql_query($sql);
    $id=0;
    while($row=mysql_fetch_array($data))
    {
     $cid=$row['cid'];
    }

    $cid=$cid+1;
    $target_dir = "uploads/";//target directory
    $cname=$_POST['course'];//course
    $desc=$_POST['desc'];//description
    $eli=$_POST['eligibility'];//eligibility
    $duration=$_POST['duration'];//duration
    $sem=$_POST['sem'];//semester
    $fees=$_POST['fees'];//fees
    $file=$_FILES['fileToUpload'];//file to be uploaded
    $target_file =basename($_FILES["fileToUpload"]["name"]);//file base name
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $result=mysql_query("SELECT * FROM course");
    $no=mysql_num_rows($result);
    $id=$no+1;
    $msg='';
    $msg1='';
    $msg2='';
    $msg3='';
    $msg4='';
    $newfilename=$target_dir .$id.".".$FileType;
  // Check if file already exists
  if (file_exists($target_file)) {
      $msg="Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      $msg1="Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($FileType !="jpg") {
      $msg2="Sorry, only jpg or jpeg files are allowed.";
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
        $sql="INSERT INTO course VALUES('$cid','$cname','$desc','$eli','$duration','$sem','$fees')";
        if(mysql_query($sql))
        {
          echo "<script>alert('Course is added')</script>";
          $msg4="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
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
  </head>

<body>
  <div class="loader">
    <img src="../assets/images/loader.gif" alt="Loading..." />
  </div>
  <!--Form for course creation-->
  <!--header-->
  <?php
 	  include('includes/header.php');
  ?>
  <!-- ***** Course creation ***** -->
  <div class="main">
    <div class="course">
      <div class="heading">
        <h6>Add Course</h6>
      </div>
      <form action="" method="post" id="course" enctype="multipart/form-data">
        <label>Add Image</label><br>
        <input type="file" name="fileToUpload" id="file" required><br><br>
        <label>Course</label><br>
        <input type="text" name="course" placeholder="Enter Course" id="name"required ><br><br>
        <label>Description</label><br>
        <textarea type="text" name="desc" placeholder="Enter Course Description" id="name"required></textarea> 
        <br>
        <label>Eligibility</label><br>
        <textarea type="text" name="eligibility" placeholder="Enter Course Eligibility" id="name"required></textarea> 
        <br>
        <label>Duration</label><br>
        <input type="text" name="duration" placeholder="Enter Duration" id="name"required><br><br>
        <label>Number of Semesters</label><br>
        <input type="number" name="sem" placeholder="Enter Number of Semesters" id="name"required min="0" max="12" ><br><br>
        <label>Course Fees</label><br>
        <input type="number" name="fees" placeholder="Enter Course Feees" id="name"required min="1000" max="1000000"><br><br>
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
            ?></span></br>
        <button type="submit" id="submit" name="add">Add Course</button>
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
