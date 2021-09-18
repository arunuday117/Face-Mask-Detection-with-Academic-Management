<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='advisor')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');//Databse connection
  //For inserting complaint details in to database
  //Date of creation:01/01/2021
  //Developed by Arun
  if(isset($_POST['add']))
  {
    $sql="select max(stcid) as stcid from student_complaint";
    $data=mysql_query($sql);
    $stcid=0;
    while($row=mysql_fetch_array($data))
    {
     $stcid=$row['stcid'];
    }
    $stcid=$stcid+1;
    $stid=$_POST['id'];//this is for getting student id
    $username=$_SESSION['username'];
    $complaint=$_POST['complaint'];//this is for getting complaints
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d H:i:s',time());
    $u=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
    $ui=mysql_fetch_array($u);
    $uid=$ui['did'];
    $sq="INSERT INTO student_complaint VALUES('$stcid','$stid','$uid','$complaint','$date','0')";//Data insertion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Complaint Send!!');</script>";
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
  <!--Form for adding student complaints -->
  <!--Date of creation:01/01/2021-->
  <!--Developed by :Arun-->
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>
  <!-- ***** Course creation ***** -->
  <div class="main">
    <div class="course">
      <div class="heading">
        <h6>Add Complaints</h6>
      </div>
      <?php
        $username=$_SESSION['username'];
        $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
        $ro=mysql_fetch_array($sq);
        $course=$ro['course'];
        $batch=$ro['batch'];
      ?>
      <form  method="POST" action=""id="course">
        <select id="select" name="id" required>
            <option selected disabled>--Select Student--</option>
            <?php
              $st=mysql_query("SELECT * FROM studentlist WHERE batch='$batch' AND course='$course'");
              while($row=mysql_fetch_array($st))
              {
            ?>
            <option value="<?php echo$row['stid']?>"><?php echo$row['sfname']." ".$row['slname'];?></option>
          <?php }?>
           </select>
        <textarea type="text" name="complaint" placeholder="Enter Your Complaint" id="textarea"></textarea> 
        <br><br>
        <button type="submit" id="submit" name="add">Add Complaint</button>
      </form>
      <div class="heading">
            <h6>Student Complaints</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Student Name</th>
              <th>Complaint</th>
              <th>Date</th>     
              <th>Action</th>
            </tr>
              <?php
              $c=1;
              include 'includes/dbconnect.php';
              $u=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
              $ui=mysql_fetch_array($u);
              $uid=$ui['did'];
              $result = mysql_query("SELECT * FROM student_complaint WHERE did='$uid'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $c;?></td>
              <td><?php 
                    $s=mysql_query("SELECT * FROM studentlist WHERE rlno='$row[stid]'");
                    while($res=mysql_fetch_array($s))
                    {
                      echo $res['sfname']." ".$res['slname'];
                    }
                     ?></td>
              <td><?php echo$row['desc'];?></td>
              <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
              <td><a href="deletecomplaint.php?id=<?php echo$row['stcid'];?>"class="reject">Delete</a></td>
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
