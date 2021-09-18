<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='hod')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');//Databse connection
  $username=$_SESSION['username'];
  $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sq);
  $did=$ro['did'];
  if(isset($_POST['add']))
  {
    include('includes/dbconnect.php');
    $target_dir = "../uploads/materials/";//target folder
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d H:i:s',time());
    $timestamp=$date;
    $datetime=explode(" ",$timestamp);
    $dateq=$datetime[0];
    $course=$_POST['course'];
    $sem=$_POST['sem'];
    $sbname=$_POST['subject'];
    $sql="select max(mtid) as mtid from materials";
    $data=mysql_query($sql);
    $mtid=0;
    while($row=mysql_fetch_array($data))
    {
     $mtid=$row['mtid'];
    }
    $mtid=$mtid+1;
    $file=$_FILES['fileToUpload'];
    $target_file =basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $result=mysql_query("SELECT * FROM materials");
    $no=mysql_num_rows($result);
    $id=$no+1;
    $msg='';
    $msg1='';
    $msg2='';
    $msg3='';
    $msg4='';
    $newfilename=$target_dir .$mtid.' '.$sem." ".$sbname.'('.$dateq.')'.".".$FileType;
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
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) 
    {  
      $sql="INSERT INTO materials VALUES('$mtid','$did','$sbname','$sem','$course','$date')";
      if(mysql_query($sql))
      {
          $msg4="The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      }
      else{$msg=mysql_error($con);}
    } 
    else 
    {
        $msg="Sorry, there was an error uploading your file.";
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
  $course=$ro['course'];
 ?>
  <!-- ***** Course creation ***** -->
  <div class="main">
    <div class="bt">
      <a id="btn1" class="btn active">Your Materials</a>
      <a id="btn2" class="btn">Other Department Materials</a>
      <a id="btn3" class="btn">Study Materials<?php 
      $ti="SELECT * FROM materials WHERE did!='$did'AND `date` BETWEEN '$from' AND '$to'";
      $sql=mysql_query($ti,$con);
      $no=mysql_num_rows($sql);
       ?><span class="badge-btn"><?php echo $no; ?></span></a>
    </div>
    <div class="course">
      <div class="hide" id='t1'>
      <div class="heading">
        <h6>Add Study Materials</h6>
      </div>
      <?php
      ?>
        <form  method="POST" action=""id="course" enctype="multipart/form-data">
          <input type="file" name="fileToUpload" id="file" required>
        <br><br>
          <input type="text" readonly name="course" id="name" value="<?php echo $course; ?>">
          <select id="select" name="sem" required>
              <option selected value="" disabled>--Select Semester--</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
             </select><br><br>
         <select id="select" name="subject" required>
            <option selected value="" disabled>--Select Subject--</option>
            <?php
              $st=mysql_query("SELECT * FROM subject WHERE sbcourse='$course'");
              while($row=mysql_fetch_array($st))
              {
            ?>
            <option value="<?php echo $row['sbname'];?>"><?php echo $row['sbname'];?></option>
          <?php }?>
           </select><br><br>
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
          <button type="submit" id="submit" name="add">Upload</button>
        </form>
        <div class="heading">
              <h6>Materials</h6>
          </div>
          <table>
              <tr id="header">
                <th>Id</th>
                <th>Subject Name</th>
                <th>Semester</th>
                <th>Course</th>  
                <th>Date</th>   
                <th></th>
                <th></th>
                <th></th>
              </tr>
                <?php
                $c=1;
                include 'includes/dbconnect.php';
                $u=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
                $ui=mysql_fetch_array($u);
                $course=$ui['course'];
                $result = mysql_query("SELECT * FROM materials WHERE did='$did' AND mtcourse='$course' ORDER BY mtsem ASC");

                while($row = mysql_fetch_array($result))
                {
                ?>
                <tr>
                <td><?php echo $c;?></td>
                <td><?php echo $row['mtsub'];?></td>
                <td><?php echo$row['mtsem'];?></td>
                <td><?php echo $row['mtcourse'];?></td>
                <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
                <td><a href="../uploads/materials/<?php echo$row['mtid'].' '.$row['mtsem'].' '.$row['mtsub'].'('.$date.')';?>.pdf" target="blank" id="view">View</a></td>
                <?php if($did==$row['did']){ ?>
                <td><a href="updatematerials.php?id=<?php echo$row['mtid'];?>&task=up"class="approve">Update</a></td>
                <td><a href="updatematerials.php?id=<?php echo$row['mtid'];?>&task=del"class="reject">Delete</a></td><?php }?>
                </tr>
              <?php 
                $c++;
                }?>
              
          </table>
        </div>
      <div class="hide" id='t2'>
        <div class="heading">
        <h6>Add Study Materials</h6>
      </div>
      <form  method="POST" action=""id="course" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="file" required>
      <br><br>
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
        <select id="select" name="sem" required>
            <option selected value="" disabled>--Select Semester--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
           </select><br><br>
       <select id="select" name="subject" required>
          <option selected value="" disabled>--Select Subject--</option>
          <?php
            $st=mysql_query("SELECT * FROM subject WHERE sbcourse!='$course' ");
            while($row=mysql_fetch_array($st))
            {
          ?>
          <option value="<?php echo $row['sbname'];?>"><?php echo $row['sbname'];?></option>
        <?php }?>
         </select><br><br>
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
        <button type="submit" id="submit" name="add">Upload</button>
      </form>
      <div class="heading">
            <h6>Materials</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Subject Name</th>
              <th>Semester</th>
              <th>Course</th>  
              <th>Date</th>   
              <th></th>
              <th></th>
              <th></th>
            </tr>
              <?php
              $c=1;
              include 'includes/dbconnect.php';
              $u=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
              $ui=mysql_fetch_array($u);
              $course=$ui['course'];
              $result = mysql_query("SELECT * FROM materials WHERE did='$did' AND mtcourse!='$course' ORDER BY mtsem ASC");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $c;?></td>
              <td><?php echo $row['mtsub'];?></td>
              <td><?php echo$row['mtsem'];?></td>
              <td><?php echo $row['mtcourse'];?></td>
              <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
              <td><a href="../uploads/materials/<?php echo$row['mtid'].' '.$row['mtsem'].' '.$row['mtsub'].'('.$date.')';?>.pdf" target="blank" id="view">View</a></td>
              <?php if($did==$row['did']){ ?>
              <td><a href="updatematerials.php?id=<?php echo$row['mtid'];?>&task=up"class="approve">Update</a></td>
              <td><a href="updatematerials.php?id=<?php echo$row['mtid'];?>&task=del"class="reject">Delete</a></td><?php }?>
              </tr>
            <?php 
              $c++;
              }?>
            
        </table>
      </div>
       <div class="hide" id='t3'>
        <div class="btd">
            <a id="bts1" class="bti">Your Department<?php 
      $ti="SELECT * FROM materials WHERE did!='$did'AND mtcourse='$course' AND `date` BETWEEN '$from' AND '$to'";
      $sql=mysql_query($ti,$con);
      $no=mysql_num_rows($sql);
       ?><span class="badge-btn"><?php echo $no; ?></span></a>
            <a id="bts2" class="bti">Other Department<?php 
      $ti="SELECT * FROM materials WHERE did!='$did'AND mtcourse!='$course' AND `date` BETWEEN '$from' AND '$to'";
      $sql=mysql_query($ti,$con);
      $no=mysql_num_rows($sql);
       ?><span class="badge-btn"><?php echo $no; ?></span></a>
        </div>
        <div class="hide" id='s1'>
          <div class="heading">
            <h6>Materials</h6>
          </div>
          <table>
              <tr id="header">
                <th>Id</th>
                <th>Subject Name</th>
                <th>Semester</th>
                <th>Course</th>  
                <th>Date</th> 
                <th></th>  
              </tr>
                <?php
                $c=1;
                include 'includes/dbconnect.php';
                $u=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
                $ui=mysql_fetch_array($u);
                $course=$ui['course'];
                $result = mysql_query("SELECT * FROM materials WHERE mtcourse='$course' ORDER BY mtsem ASC");

                while($row = mysql_fetch_array($result))
                {
                ?>
                <tr>
                <td><?php echo $c;?></td>
                <td><?php echo $row['mtsub'];?></td>
                <td><?php echo$row['mtsem'];?></td>
                <td><?php echo $row['mtcourse'];?></td>
                <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
                <td><a href="../uploads/materials/<?php echo$row['mtid'].' '.$row['mtsem'].' '.$row['mtsub'].'('.$date.')';?>.pdf" target="blank" id="view">View</a></td>
                </tr>
              <?php 
                $c++;
                }?>
              
          </table>
        </div>
        <div class="hide" id='s2'>
          <div class="heading">
            <h6>Materials</h6>
          </div>
          <table>
              <tr id="header">
                <th>Id</th>
                <th>Subject Name</th>
                <th>Semester</th>
                <th>Course</th>  
                <th>Date</th>  
                <th></th> 
              </tr>
                <?php
                $c=1;
                include 'includes/dbconnect.php';
                $u=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
                $ui=mysql_fetch_array($u);
                $course=$ui['course'];
                $result = mysql_query("SELECT * FROM materials WHERE mtcourse!='$course' ORDER BY mtsem ASC");

                while($row = mysql_fetch_array($result))
                {
                ?>
                <tr>
                <td><?php echo $c;?></td>
                <td><?php echo $row['mtsub'];?></td>
                <td><?php echo$row['mtsem'];?></td>
                <td><?php echo $row['mtcourse'];?></td>
                <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
                <td><a href="../uploads/materials/<?php echo$row['mtid'].' '.$row['mtsem'].' '.$row['mtsub'].'('.$date.')';?>.pdf" target="blank" id="view">View</a></td>
                </tr>
              <?php 
                $c++;
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
      $("#t1").show();
      $("#btn1").on("click",function(){
        $("#t1").show();
        $("#t2").hide();
        $("#t3").hide();        
        });
      $("#btn2").on("click",function(){
        $("#t2").show();
        $("#t1").hide();
        $("#t3").hide();
        });
        $("#btn3").on("click",function(){
          $("#t3").show();
          $("#t1").hide();
          $("#t2").hide();
          $("#bts1").on("click",function(){
          $("#s1").show();
          $("#s2").hide();
          });
          $("#bts2").on("click",function(){
          $("#s2").show();
          $("#s1").hide();
        });
        });
        var btns = document.getElementsByClassName("btn");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");

            // If there's no active class
            if (current.length > 0) {
              current[0].className = current[0].className.replace(" active", "");
            }

            // Add the active class to the current/clicked button
            this.className += " active";
          });
        }
        var btn = document.getElementsByClassName("bti");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btn.length; i++) {
          btn[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("light");

            // If there's no active class
            if (current.length > 0) {
              current[0].className = current[0].className.replace(" light", "");
            }

            // Add the active class to the current/clicked button
            this.className += " light";
          });
        }
    </script>
</body>
</html>
