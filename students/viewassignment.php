<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='student')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
include('includes/dbconnect.php');
if(isset($_POST['add']))
{
    $sql="select max(asid) as asid from assignment";
    $data=mysql_query($sql);
    $id=0;
    while($row=mysql_fetch_array($data))
    {
     $asid=$row['asid'];
    }
  $asid=$asid+1;
  $flag=0;
  $username=$_SESSION['username'];
  $u=mysql_query("SELECT * FROM studentreg WHERE userid='$username'");
  $ui=mysql_fetch_array($u);
  $course=$ui['course'];
  $title=$_POST['title'];
  $subject=$_POST['subject'];
  $duedate=$_POST['duedate'];
  $date=date('Y-m-d');//current date
   $sq="INSERT INTO assignmentmark VALUES('$asid','$subject','$title','$course','$duedate','$date')";//Data insertion code
    if(mysql_query($sq,$con))
    {
      echo "<script>alert('Assignment Added')</script>";
    }
    else
    {
      echo "<script>alert('Something went wrong')</script>";
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
         <?php
        $username=$_SESSION['username'];

      ?>
      <div class="heading">
            <h6>Assignments</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Subject Name</th>
              <th>Title</th>
              <th>Due Date</th>     
              <th></th>
              <th></th>
            </tr>
              <?php
              $c=1;
              include 'includes/dbconnect.php';
              $u=mysql_query("SELECT * FROM studentreg WHERE userid='$username'");
              $ui=mysql_fetch_array($u);
              $course=$ui['course'];
              $stid=$ui['stid'];
              $batch=$ui['batch'];
              $date=date('Y-m-d');
              $result = mysql_query("SELECT * FROM assignment WHERE  course='$course' AND batch='$batch' ");

              while($row = mysql_fetch_array($result))
              {
                $res = mysql_query("SELECT * FROM assignment NATURAL JOIN assignmentmark WHERE assignment.asid=assignmentmark.asid AND asid='$row[asid]'");
                $ro = mysql_fetch_array($res);
              ?>
              <tr>
              <td><?php echo $c;?></td>
              <td><?php echo $row['subject']?></td>
              <td><?php echo$row['title'];?></td>
              <td><?php echo $row['duedate'];?></td>
              <td>
                <?php if($ro['stid']!=$stid) {
                  if($date<=$row['duedate']){?>
                <a href="uploadassign.php?id=<?php echo$row['asid'];?>"class="approve">Upload Assignment</a>
                <?php }
                  else
                  {
                    echo "Date Passed";
                  }
                 } 
                else
                  { echo"Assignment Uploaded";}?>
              </td>
              <td> <?php if($ro['mark']==NULL) 
              {
                  echo"Wait for assessment";
              }
              else
              {
                echo $ro['mark'];
              }
                ?></td>
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

