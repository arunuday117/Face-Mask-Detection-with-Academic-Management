<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='advisor')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');//Databse connection
  if(isset($_POST['add']))
  {
    $course=$_POST['course'];
    $batch=$_POST['batch'];
    $sem=$_POST['sem'];
    $sbname=$_POST['subname'];
    $sql="select max(sbid) as sbid from subject";
    $data=mysql_query($sql);
    $id=0;
    while($row=mysql_fetch_array($data))
    {
     $sbid=$row['sbid'];
    }

    $sbid=$sbid+1;
    $sq="INSERT INTO subject VALUES('$sbid','$sbname','$sem','$course','$batch')";//Data insertion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Subject Added!!');</script>";
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
        <h6>Add Subject</h6>
      </div>
      <?php
        $username=$_SESSION['username'];
        $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
        $ro=mysql_fetch_array($sq);
        $course=$ro['course'];
        $batch=$ro['batch'];
      ?>
      <form  method="POST" action=""id="course">
        <input type="hidden" name="course" value="<?php echo $course ?>">
        <input type="hidden" name="batch" value="<?php echo $batch ?>">
        <select id="select" name="sem" required>
            <option selected value="" disabled>--Select Semester--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
           </select><br>
         <textarea type="text" name="subname" placeholder="Enter Subject Name" id="textarea" required></textarea> 
      <br><br>
        <button type="submit" id="submit" name="add">Add Subject</button>
      </form>
      <div class="heading">
            <h6>Subjects</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Subject Name</th>
              <th>Semester</th>
              <th>Course</th>     
              <th>Batch</th>
              <th></th>
              <th></th>
            </tr>
              <?php
              $c=1;
              include 'includes/dbconnect.php';
              $u=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
              $ui=mysql_fetch_array($u);
              $course=$ui['course'];
              $batch=$ui['batch'];
              $result = mysql_query("SELECT * FROM subject WHERE sbcourse='$course' AND sbbatch='$batch' ORDER BY sbsem ASC");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $c;?></td>
              <td><?php echo $row['sbname'];?></td>
              <td><?php echo$row['sbsem'];?></td>
              <td><?php echo $row['sbcourse'];?></td>
              <td><?php echo $row['sbbatch'];?></td>
              <td><a href="updatesub.php?id=<?php echo$row['sbid'];?>&task=up"class="approve">Update</a></td>
              <td><a href="updatesub.php?id=<?php echo$row['sbid'];?>&task=del"class="reject">Delete</a></td>
              </tr>
            <?php 
              $c++;
              }?>
            
        </table>
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
