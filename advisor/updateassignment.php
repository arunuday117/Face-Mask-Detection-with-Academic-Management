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
    $course=$_POST['course'];
    $title=$_POST['title'];
    $subject=$_POST['subject'];
    $batch=$_POST['batch'];
    $sem=$_POST['sem'];
    $duedate=$_POST['duedate'];
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d H:i:s',time());
    $timestamp=$date;
    $datetime=explode(" ",$timestamp);
    $dateq=$datetime[0];
    if($dateq<=$duedate)
    {
      $sq="UPDATE assignment SET course='$course',title='$title',subject='$subject',batch='$batch',sem='$sem',duedate='$duedate',`date`='$date' WHERE asid='$id' ";//Data insertion code
      if(mysql_query($sq,$con))
      {
        $sq=mysql_query("UPDATE assignment SET `date`='$date'WHERE asid='$id'");
      echo "<script>alert('Assignment Updated')</script>";
       echo"<script>location.href='addassignment.php';</script>";

      }
      else
      {
        echo "<script>alert('Something went wrong')</script>";
      }

    }
    else
    {
       echo "<script>alert('Due date is a past date ')</script>";
    }
  }
  if($_GET['task']=='del')
  {
     $sq="DELETE FROM assignment WHERE asid='$id' ";//Data Deletion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Assignment Deleted!!');</script>";
      echo"<script>location.href='addassignment.php';</script>";
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
        <h6>Update Assignment</h6>
      </div>
      <?php
        $id=$_GET['id'];
        $sq=mysql_query("SELECT * FROM assignment WHERE asid='$id'");
        while($ro=mysql_fetch_array($sq))
        {
      ?>
      <form  method="POST" action=""id="course">
        <select id="select" name="course" required>
          <option value="<?php echo$ro['course']; ?>" selected><?php echo$ro['course']; ?></option>
          <?php
            $st=mysql_query("SELECT * FROM course");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['cname'];?>"><?php echo $row['cname'];?></option>
        <?php }?>
         </select><br><br>
        <select id="select" name="subject" required>
          <option value="<?php echo$ro['subject']; ?>" selected><?php echo$ro['subject']; ?></option>
          <?php
            $st=mysql_query("SELECT * FROM subject");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['sbname'];?>"><?php echo $row['sbname'];?></option>
        <?php }?>
         </select><br><br>
         <select id="select" name="sem" required>
            <option value="<?php echo$ro['sem']; ?>"selected><?php echo$ro['sem']; ?></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
           </select><br><br>
         <input type="text" name="batch" id="name" value="<?php echo $ro['batch'];?>">
         <input type="date" name="duedate"id="name"value="<?php echo $ro['duedate'];?>">
        <input type="text" name="title" value="<?php echo $ro['title'];?>" id="name">
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
