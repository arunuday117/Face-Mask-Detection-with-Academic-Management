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
    $sem=$_POST['sem'];
    $sbname=$_POST['sbname'];
    $sq="UPDATE subject SET sbname='$sbname',sbsem='$sem' WHERE sbid='$id' ";//Data insertion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Subject Updated!!');</script>";
      echo"<script>location.href='subjects.php';</script>";
    }

  }
  if($_GET['task']=='del')
  {
     $sq="DELETE FROM subject WHERE sbid='$id' ";//Data Deletion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Subject Deleted!!');</script>";
      echo"<script>location.href='subjects.php';</script>";
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
        <h6>Add Subject</h6>
      </div>
      <?php
        $id=$_GET['id'];
        $sq=mysql_query("SELECT * FROM subject WHERE sbid='$id'");
        while($ro=mysql_fetch_array($sq))
        {
      ?>
      <form  method="POST" action=""id="course">
        <input type="number" name="sem" id="name"value="<?php echo $ro['sbsem']; ?>">
        <input type="text" name="sbname" id="name"value="<?php echo $ro['sbname']; ?>">
        <button type="submit" id="submit" name="add">Update</button>
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
