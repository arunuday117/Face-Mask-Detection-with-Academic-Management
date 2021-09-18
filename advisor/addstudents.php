<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='advisor')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');//Databse connection
  $username=$_SESSION['username'];
  $sql=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sql);
  $batch=$ro['batch'];
  $course=$ro['course'];
  if(isset($_POST['add']))
  {
    $rlno=$_POST['rlno'];//this is for getting student id
    $username=$_SESSION['username'];
    $fname=$_POST['fname'];//this is for getting complaints
    $lname=$_POST['lname'];//this is for getting complaints
    $flag=0;
    if(empty($rlno))
    {
      $flag=1;
    }
    if(empty($fname))
    {
      $flag=1;
    }
    if(empty($lname))
    {
      $flag=1;
    }
    if($flag!=1)
    { 
        if (!preg_match('/^\d{11}$/', $rlno))
        {
            $flag=2;
        }
        if (!preg_match('/^[a-zA-Z]*$/',$fname))
        {
            $flag=3;                  
        }
        if (!preg_match('/^[a-zA-Z]*$/',$lname))
        {
            $flag=4;
        }
    }
    if($flag==0)
    {
      $sql=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
      $ui=mysql_fetch_array($sql);
      $sql="INSERT INTO studentlist VALUES('$rlno','$fname','$lname','$course','$batch')";//Data insertion code
      if(mysql_query($sql,$con))
      {
        echo"<script>alert('Student Added!!');</script>";
      }
      else
      {
        echo "<script>alert('Something went wrong')</script>";
      }

    }
    if($flag==1)
    {
       echo "<script>alert('Fields cannot be empty')</script>";
    }
    if($flag==2)
    {
       echo "<script>alert('Invalid Roll No')</script>";
    }
    if($flag==3)
    {
       echo "<script>alert('Invalid First name')</script>";
    }
    if($flag==4)
    {
       echo "<script>alert('Invalid last name')</script>";
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
    <script src="vendor/jquery/jquery.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script type="text/javascript">
      if(performance.navigation.type==2){
        location.reload(true);
      }
    </script>
  </head>

<body>
<div class="loader">
        <img src="../assets/images/loader.gif" alt="Loading..." />
    </div>
   
  <!--header-->
 <?php
  include('includes/header.php');
 ?>

  <!-- ***** Main Banner Area Start ***** -->

  <div class="cover">
    <div class="table">
        <div class="table-heading">
            <h6>Add Students</h6>
        </div>
        <div class="tab">
         <table >
          <form action="" method="post">
            <tr id="header">
              <th>Roll No</th>
              <th>Student First Name</th>
              <th>Student Last Name</th>
              <th>Batch</th>
              <th></th>
            </tr>
            <tr>
              <td><input type="number" name="rlno"required></td>
              <td><input type="text" name="fname"></td>
              <td><input type="text" name="lname"></td>
              <td><input type="text" value="<?php echo $batch; ?>" readonly name="batch"></td>
              <td><input type="submit" class="approve" name="add" value="ADD"></td>
            </tr>
          </form>
          </table>
        </div>
        <div class="tab">
         <table >
            <tr id="header">
              <th>Roll No</th>
              <th>Student First Name</th>
              <th>Student Last Name</th>
              <th>Course</th>
              <th>Batch</th>
              <th></th>
              <th></th>
            </tr>
            <?php
              $result = mysql_query("SELECT * FROM studentlist WHERE course='$course' AND batch='$batch' ORDER BY rlno ASC");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $row['rlno'];?></td>
              <td><?php echo $row['sfname'];?></td>
              <td><?php echo $row['slname'];?></td>
              <td><?php echo $row['course'];?></td>
              <td><?php echo $row['batch'];?></td>
              <td><a href="updatestudent.php?id=<?php echo$row['rlno'];?>&task=up"class="approve">Update</a></td>
              <td><a href="updatestudent.php?id=<?php echo$row['rlno'];?>&task=del"class="reject">Delete</a></td>
              </tr>
            <?php 
              }?>
          </table>
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