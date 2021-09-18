<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='advisor')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');
  $username=$_SESSION['username'];
  $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sq);
  $did=$ro['did'];
  if(isset($_POST['upload']))
  {
    $sql="SELECT max(atid) as atid from attendance";
    $data=mysql_query($sql);
    $atid=0;
    while($row=mysql_fetch_array($data))
    {
     $atid=$row['atid'];
    }
    $atid=$atid+1;
    $target_dir = "../uploads/attendance/";//target folder
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d H:i:s',time());
    $timestamp=$date;
    $datetime=explode(" ",$timestamp);
    $dateq=$datetime[0];
    $cname=$_POST['course'];//course
    $sp=mysql_query("SELECT * FROM course WHERE cname='$cname'");
    $p=mysql_fetch_array($sp);
    $cid=$p['cid'];
    $flag=0;
    $sem=$_POST['sem'];//semester
    $batch=$_POST['batch'];
    $file=$_FILES['fileToUpload'];
    $description=$_POST['description'];
    $target_file =basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $result=mysql_query("SELECT * FROM attendance");
    $no=mysql_num_rows($result);
    $id=$no+1;
    $msg='';
    $msg1='';
    $msg2='';
    $msg3='';
    $msg4='';
    $newfilename=$target_dir .$atid.' '.$sem.' '.$batch.' '.$description.'('.$dateq.')'.".".$FileType;
  // Check if file already exists
  if (file_exists($target_file)) {
      $msg="Sorry, file already exists.";
      $uploadOk = 0;
  }
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
    if (!preg_match("/^[2][0]\d{2}-[2][0]\d{2}$/", $batch))
    {
        $error_msg['batch']="*Invalid batch eg.(2018-2021)";
        $flag=1;
    }
    if($flag==0)
    {
      if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) 
      {  
        $sql="INSERT INTO attendance VALUES('$atid','$did','$description','$cid','$sem','$batch','$date')";
        if(mysql_query($sql))
        {
            $msg4="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        }
        else{$msg="ERROR";}
      } 
      else 
      {
          $msg="Sorry, there was an error uploading your file.";
      }
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
 <!--Form to Upload Exam Schdeules-->
  <!--Date of creation:31/12/2020-->
  <!--Developed by :Arun-->
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>
<div class="main">
    <div class="course">
        <div class="heading">
            <h6>Upload attendance Reports</h6>
        </div>
        <?php
          $course=$ro['course'];
          $batch=$ro['batch'];
        ?>
         <form action="" method="post" id="course" enctype="multipart/form-data">
           <input type="file" name="fileToUpload" id="file" required><br><br>
           <input type="text" name="course" id="name"readonly value="<?php echo$course;?>" required >
           <input type="text" name="description" id="name" placeholder="Enter Description" required >
           <select id="select" name="sem" required>
            <option value="" selected >--Select Semester--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
           </select><br>
           <input type="text" name="batch" id="name"readonly value="<?php echo$batch;?>">
           <?php
          if(isset($error_msg['batch']))
          {
              echo "<font color=red >".$error_msg['batch']."</font>";
          }
          ?>
           <span id="error"><?php 
           if(isset($msg)||isset($msg1)||isset($msg2)||isset($msg4))
            {
              echo$msg;
              echo$msg1;
              echo$msg2;
              echo$msg3;
              echo $msg4;
            }
            else
            {
              echo"Choose a file";
            }
            ?></span>
           <button type="submit" id="submit" name="upload">Upload</button>
         </form>
        <div class="heading">
            <h6>Attendance Report</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Description</th>
              <th>Semester</th> 
              <th>Batch</th>
              <th>Date</th>    
              <th></th>
              <th></th>
              <th></th>
            </tr>
              <?php
              $p=1;
              include 'includes/dbconnect.php';
              $c=mysql_query("SELECT * FROM course WHERE cname='$course'");
              $re=mysql_fetch_array($c);
              $cd=$re['cid'];
              $result = mysql_query("SELECT * FROM attendance NATURAL JOIN course WHERE attendance.cid=course.cid AND cid='$cd'AND batch='$batch'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $p;?></td>
              <td><?php echo $row['description'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><?php echo $row['batch']?></td>
              <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
              <td><a href="../uploads/attendance/<?php echo$row['atid'].' '.$row['sem'].' '.$row['batch'].' '.$row['description'].'('.$date.')';?>.pdf"id="view"  target="blank">View</a></td>
              <?php if($did==$row['did']){ ?>
              <td><a href="updateattendance.php?id=<?php echo$row['atid'];?>&task=up"class="approve">Update</a></td>
              <td><a href="updateattendance.php?id=<?php echo$row['atid'];?>&task=del"class="reject">Delete</a></td><?php }?>
              </tr>
            <?php 
              $p++;
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