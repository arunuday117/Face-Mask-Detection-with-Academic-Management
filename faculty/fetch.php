<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='faculty')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
include('includes/dbconnect.php');
$type=$_POST['type'];
$batch=$_POST['batch'];
$sem=$_POST['sem'];
$subject=$_POST['subject'];
$outof=$_POST['outof'];
$course=$_POST['course'];
if(isset($_POST['add']))
{
  $username=$_SESSION['username'];
  $sql=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sql);
  $did=$ro['did'];
  $flag=0;
  $username=$_SESSION['username'];
  $date=date('Y-m-d');//current date
  $sq="SELECT * FROM exammark WHERE type='$type' AND batch='$batch' AND subject='$subject'AND course='$course'AND sem='$sem'";
  if(mysql_query($sq,$con))
  {
    $sp="UPDATE exammark SET status='1' WHERE type='$type' AND batch='$batch' AND subject='$subject' AND course='$course' AND sem='$sem' AND status='0'";
    $s=mysql_query($sp,$con);
  }
 foreach ($_POST['mark'] as $key => $value) {
    
  $sql="select max(emid) as emid from exammark";
    $data=mysql_query($sql);
    $emid=0;
    while($row=mysql_fetch_array($data))
    {
     $emid=$row['emid'];
    }

    $emid=$emid+1;
  $sq="INSERT INTO exammark VALUES('$emid','$did','$key','$value','$outof','$type','$batch','$subject','$course','$sem','$date','0')";//Data insertion code
    if(mysql_query($sq,$con))
    {
      $flag=1;
    }
    else
    {
      $flag=0;
    }
 }
 if($flag==0)
    {
      echo "<script>alert('Something went wrong')</script>";
    }
    else
    {
      echo "<script>alert('Mark Successfully added')</script>";
      echo"<script>location.href='addmark.php';</script>";
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
    <script type="text/javascript">
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
  <!-- ***** Course creation ***** -->
  <div class="main">
    <div class="course">
      <div class="heading">
            <h6>Add Mark</h6>
        </div>
         <?php
      ?>
      <form  method="POST" action="fetch.php"id="course">
        <input type="text" name="type" class="name" readonly value="<?php echo$type; ?>">
        <input type="text" name="sem"class="name" readonly value="<?php echo$sem; ?>">
        <input type="text" name="subject"class="name" readonly value="<?php echo$subject; ?>">
        <input type="text" name="course"class="name" readonly value="<?php echo$course; ?>">
        <input type="number" class="name" name="outof" readonly value="<?php echo$outof; ?>"> 
        <input type="text" class="name" id="myInput" name="batch" readonly value="<?php echo$batch;?>"> 
        <br><br>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Student Name</th>
              <th>Mark</th>     
            </tr>
              <?php
              $c=1;
              $query =mysql_query("SELECT * FROM studentlist WHERE batch='$batch'");

              while($row = mysql_fetch_array($query))
              {
              ?>
              <tr>
               <td><?php echo$row["rlno"];?></td>
               <td><?php echo$row["sfname"]." ".$row["slname"];?></td>
               <td><input type="number" name="mark[<?php echo $row["rlno"];?>]"> </td>
            </tr>
            <?php 
              $c++;
              }?>
            
        </table>
        <button type="submit" id="submit" onclick="return confirm('Do you want to continue?')" name="add">submit</button>
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
      window.addEventListener("load", function (){
            const loader = document.querySelector(".loader");
            loader.className += " hidden"; // class "loader hidden"
  });
    </script>
    <script>
</script>
</body>
</html>

