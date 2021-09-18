<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='faculty')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
include('includes/dbconnect.php');
 $username=$_SESSION['username'];
$sql=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
$ro=mysql_fetch_array($sql);
$did=$ro['did'];
date_default_timezone_set('Asia/Kolkata');// change according timezone
$date=date('Y-m-d H:i:s',time());
$timestamp=$date;
$datetime=explode(" ",$timestamp);
$dateq=$datetime[0];
if(isset($_POST['add']))
{
  $flag=0;
  $username=$_SESSION['username'];
    $sql="select max(asid) as asid from assignment";
    $data=mysql_query($sql);
    $id=0;
    while($row=mysql_fetch_array($data))
    {
     $asid=$row['asid'];
    }
  $asid=$asid+1;
  $flag=0;
  $course=$ro['course'];
  $title=$_POST['title'];
  $subject=$_POST['subject'];
  $batch=$_POST['batch'];
  $sem=$_POST['sem'];
  $duedate=$_POST['duedate'];
  if (!preg_match("/^[2][0]\d{2}-[2][0]\d{2}$/", $batch))
  {
      $error_msg['batch']="*Invalid batch eg.(2018-2021)";
      $flag=1;
  }
  if($flag==0)
  {
    if($dateq<=$duedate)
    {
     $sq="INSERT INTO assignment VALUES('$asid','$did','$subject','$title','$course','$sem','$batch','$duedate','$date')";//Data insertion code
      if(mysql_query($sq,$con))
      {
        echo "<script>alert('Assignment Added')</script>";
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
    <div class="bt">
        <a id="bt1" class="btn active">Your Department</a>
        <a id="bt2" class="btn">Different Department</a>
      </div>
    <div class="course">
      <div class="heading">
            <h6>Add Assignment</h6>
        </div>
         <?php
        $username=$_SESSION['username'];
        $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
        $ro=mysql_fetch_array($sq);
        $course=$ro['course'];
      ?>
      <div class="hide" id='1'>
      <form  method="POST" action=""id="course">
          <select id="select" name="subject" required>
          <option selected value="" disabled>--Select Subject--</option>
          <?php
            $st=mysql_query("SELECT * FROM subject WHERE sbcourse='$course'");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['sbname'];?>"><?php echo $row['sbname'];?></option>
        <?php }?>
         </select><br>
         <select id="select" name="sem" required>
            <option value="" selected disabled>--Select Semester--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
           </select><br>
         <input type="text" name="batch" id="name" placeholder="Enter Year of Batch" required>
         <?php
          if(isset($error_msg['batch']))
          {
              echo "<font color=red >".$error_msg['batch']."</font>";
          }
          ?>
         <input type="date" name="duedate"id="name" required>
        <textarea type="text" name="title" placeholder="Enter Assignment Title" id="textarea" required></textarea> 
        <br><br>
        <button type="submit" id="submit"onclick="return confirm('Do you want to continue?')" name="add">Add Assignment</button>
      </form>
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
              $date=date('Y-m-d');
              $result = mysql_query("SELECT * FROM assignment WHERE did='$did' AND course='$course'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $c;?></td>
              <td><?php echo $row['subject']?></td>
              <td><?php echo$row['title'];?></td>
              <td><?php echo $row['duedate'];?></td>
              <td>
                <?php if($date<=$row['duedate'])
                {?>
                <a href="updateassignment.php?id=<?php echo$row['asid'];?>&task=up"class="approve">Update</a><?php }?></td>
              <td>
                <?php 

                $timestamp=$row['date'];
                $datetime=explode(" ",$timestamp);
                $daten=$datetime[0];
                if($date==$daten)
                {?>
                <a href="updateassignment.php?id=<?php echo$row['asid'];?>&task=del"class="reject">Delete</a>
                <?php }?></td>
              </tr>
            <?php 
              $c++;
              }?>
            
        </table>
    </div>
    <div class="hide" id="2">
      <form  method="POST" action=""id="course">
        <select id="select" name="course" required>
          <option value="" selected disabled>--Select Course--</option>
          <?php
            $st=mysql_query("SELECT * FROM course WHERE cname!='$course'");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['cname'];?>"><?php echo $row['cname'];?></option>
        <?php }?>
         </select><br><br>
          <select id="select" name="subject" required>
          <option selected value="" disabled>--Select Subject--</option>
          <?php
            $st=mysql_query("SELECT * FROM subject WHERE sbcourse!='$course'");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['sbname'];?>"><?php echo $row['sbname'];?></option>
        <?php }?>
         </select><br><br>
         <select id="select" name="sem" required>
            <option value="" selected disabled>--Select Semester--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
           </select><br><br>
         <input type="text" name="batch" id="name" placeholder="Enter Year of Batch" required>
         <input type="date" name="duedate"id="name" required>
        <textarea type="text" name="title" placeholder="Enter Assignment Title" id="textarea" required></textarea> 
        <br><br>
        <button type="submit" id="submit"onclick="return confirm('Do you want to continue?')" name="add">Add Assignment</button>
      </form>
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
              $date=date('Y-m-d');
              $result = mysql_query("SELECT * FROM assignment WHERE did='$did' AND course!='$course'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $c;?></td>
              <td><?php echo $row['subject']?></td>
              <td><?php echo$row['title'];?></td>
              <td><?php echo $row['duedate'];?></td>
              <td>
                <?php if($date<=$row['duedate'])
                {?>
                <a href="updateassignment.php?id=<?php echo$row['asid'];?>&task=up"class="approve">Update</a><?php }?></td>
              <td>
                <?php 

                $timestamp=$row['date'];
                $datetime=explode(" ",$timestamp);
                $daten=$datetime[0];
                if($date==$daten)
                {?>
                <a href="updateassignment.php?id=<?php echo$row['asid'];?>&task=del"class="reject">Delete</a>
                <?php }?></td>
              </tr>
            <?php 
              $c++;
              }?>
            
        </table>
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
       $("#1").show();
        $("#bt1").on("click",function(){
        $("#1").show();
        $("#2").hide();
        });
        $("#bt2").on("click",function(){
        $("#2").show();
        $("#1").hide();
        });
        var btns = document.getElementsByClassName("btn");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
          });
        }
    </script>
</body>
</html>

