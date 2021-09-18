<?php
include 'includes/dbconnect.php';
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
    <link rel="stylesheet" href="assets/css/style.css">
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
  $id=$_GET['id'];
  $sql=mysql_query("SELECT * FROM course WHERE cid='$id'",$con);
  if($sql)
  {
    while ($row=mysql_fetch_array($sql)) 
    {
       $course=$row['cname'];
       $desc=$row['cdesc'];
       $eligibility=$row['eligibility'];
       $duration=$row['duration'];
       $semester=$row['semester'];
       $fees=$row['fees'];
    }
  }
  else
  {
    $course="Course Not Available";
  }
 ?>

  <!-- ***** Main Banner Area Start ***** -->

  <div class="main">
    <div class="course">
        <div class="heading">
            <h6><?php echo $course; ?></h6>
        </div>
        <div id="#course">
            <img src="admin/uploads/<?php echo$id; ?>.jpg" alt="No Image Available">
            <div class="details">
                <h6>About Course</h6>
                <p><?php echo $desc; ?></p>
                <h6>Eligibility</h6>
                <p><?php echo $eligibility; ?></p>
                <h6>Other Details</h6>
                <p><?php echo "Duration:"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$duration; ?></p>
                <p><?php echo "Semesters:"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$semester; ?></p>
                <p><?php echo "Fee per semester:"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$fees."/sem"; ?></p>
            </div>
        </div>
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
