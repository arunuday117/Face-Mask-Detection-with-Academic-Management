<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='hod')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');//Databse connection
  $id=$_GET['id'];
  if(isset($_POST['add']))
  {
    $target_dir = "../uploads/materials/";//target folder
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d H:i:s',time());
    $timestamp=$date;
    $datetime=explode(" ",$timestamp);
    $dateq=$datetime[0];
    $file=$_FILES['fileToUpload'];
    $target_file =basename($_FILES["fileToUpload"]["name"]);
    $result = mysql_query("SELECT * FROM materials WHERE mtid='$id'");
    $row = mysql_fetch_array($result);
    $sem=$row['mtsem'];
    $sub=$row['mtsub'];
    $timestamp=$row['date'];
    $datetime=explode(" ",$timestamp);
    $odate=$datetime[0];
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $msg='';
    $msg1='';
    $msg2='';
    $msg3='';
    $msg4='';
    $filename=$target_dir .$id.' '.$sem.' '.$sub.'('.$odate.')'.".".$FileType;
    $newfilename=$target_dir .$id.' '.$sem.' '.$sub.'('.$dateq.')'.".".$FileType;
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
    unlink($filename);
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) 
      {  
        $sq=mysql_query("UPDATE materials SET `date`='$date'WHERE mtid='$id'");
         echo "<script>alert('Study material Updated')</script>";
        echo"<script>location.href='materials.php';</script>";
      } 
      else 
      {
          $msg="Sorry, there was an error uploading your file.";
      }
  }
}
if($_GET['task']=='del')
  {
    $result = mysql_query("SELECT * FROM materials WHERE mtid='$id'");
    $row = mysql_fetch_array($result);
    $sem=$row['mtsem'];
    $sub=$row['mtsub'];
    $odate=$row['date'];
    unlink('../uploads/materials/'.$id.' '.$sem.' '.$sub.'('.$odate.')'.".".'pdf');
     $sq="DELETE FROM materials WHERE mtid='$id' ";//Data Deletion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Study material Deleted!!');</script>";
      echo"<script>location.href='materials.php';</script>";
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
  if($_GET['task']=='up')
  {
 ?>
  <!-- ***** Course creation ***** -->
  <div class="main">
    <div class="course">
      <div class="heading">
        <h6>Update Study Materials</h6>
      </div>
      <?php
        $id=$_GET['id'];
        $sq=mysql_query("SELECT * FROM materials WHERE mtid='$id'");
        while($ro=mysql_fetch_array($sq))
        {
      ?>
      <form action="" method="post" id="course" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="file" required><br><br>
        <input type="text" readonly name="sem"id="name"value="<?php echo $ro['mtsem'];?>">
        <input type="text" name="course" readonly value="<?php echo $ro['mtcourse'];?>" id="name">
        <input type="text" name="type" readonly value="<?php echo $ro['mtsub'];?>" id="name">
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
