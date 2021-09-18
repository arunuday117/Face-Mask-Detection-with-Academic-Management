<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='hod')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include 'includes/dbconnect.php';
  $username=$_SESSION['username'];
  $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sq);
  $did=$ro['did'];
  if(isset($_POST['upload']))
  {
    $sql="select max(tid) as tid from timetable";
    $data=mysql_query($sql);
    $tid=0;
    while($row=mysql_fetch_array($data))
    {
     $tid=$row['tid'];
    }
    $tid=$tid+1;
    $target_dir = "../uploads/timetable/";//target folder
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d H:i:s',time());
    $cname=$_POST['course'];//course
    $sp=mysql_query("SELECT * FROM course WHERE cname='$cname'");
    $p=mysql_fetch_array($sp);
    $cid=$p['cid'];
    $sem=$_POST['sem'];//semester
    $file=$_FILES['fileToUpload'];
    $target_file =basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $result=mysql_query("SELECT * FROM timetable");
    $no=mysql_num_rows($result);
    $id=$no+1;
    $msg='';
    $msg1='';
    $msg2='';
    $msg3='';
    $msg4='';
    $newfilename=$target_dir .$id.".".$FileType;
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
    $check="SELECT * FROM timetable WHERE cid='$cid'AND sem='$sem'";
    if(mysql_query($check))
    {
      $up=mysql_query("UPDATE timetable SET status='1' WHERE cid='$cid' AND sem='$sem'");
    }
      if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) 
      {  
        $sql="INSERT INTO timetable VALUES('$tid','$did','$date','$cid','$sem','0')";
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
 <!--Form to Upload Timetable-->
  <!--Date of creation:31/12/2020-->
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>
<div class="main">
  <div class="bt">
      <a id="btn1" class="btn active">Your Department</a>
      <a id="btn2" class="btn">Other Department<?php 
                $ti="SELECT * FROM timetable WHERE did!='$did'AND status='0'AND `date` BETWEEN '$from' AND '$to'";
                $sql=mysql_query($ti,$con);
                $no=mysql_num_rows($sql);
                 ?><span class="badge-btn"><?php echo $no; ?></span></a>
    </div>
    <div class="course">
      <div class="hide" id="t1">
        <div class="heading">
            <h6>Upload Timetable</h6>
        </div>
        <?php
          $course=$ro['course'];
        ?>
         <form action="" method="post" id="course" enctype="multipart/form-data">
           <input type="file" name="fileToUpload" id="file" required><br><br>
           <input type="text" name="course" id="name"readonly value="<?php echo$course;?>">
           <select id="select" name="sem" required>
            <option selected value="" disabled>--Select Semester--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
           </select>
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
         <div class="bt">
            <a id="btk1" class="btn">Current</a>
            <a id="btk2" class="btn">Previous</a>
          </div>
        <div class="hide" id="k1">
        <div class="heading">
            <h6>Current Timetable</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Date</th>
              <th>Course</th>
              <th>Semester</th>     
              <th></th>
              <th></th>
              <th></th>
            </tr>
              <?php
              $o=1;
              
              $c=mysql_query("SELECT * FROM course WHERE cname='$course'");
              $re=mysql_fetch_array($c);
              $cd=$re['cid'];
              $result = mysql_query("SELECT * FROM timetable NATURAL JOIN course WHERE timetable.cid=course.cid AND status='0' AND cid='$cd'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $o;?></td>
              <td><?php $timestamp=$row['date'];
                        $datetime=explode(" ",$timestamp);
                        echo$date=$datetime[0];?></td>
              <td><?php echo $row['cname'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><a href="../uploads/timetable/<?php echo$row['tid'];?>.pdf"id="view" target="blank">View</a></td>
              <?php if($did==$row['did']){ ?>
              <td><a href="updatetimetable.php?id=<?php echo$row['tid'];?>&task=up"class="approve">Update</a></td>
              <td><a href="updatetimetable.php?id=<?php echo$row['tid'];?>&task=del"class="reject">Delete</a></td><?php }?>
              </tr>
            <?php 
              $o++;
              }?>
            
        </table>
      </div>
      <div class="hide" id="k2">
        <div class="heading">
          <h6>Previous Timetable</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Date</th>
              <th>Course</th>
              <th>Semester</th>     
              <th></th>
            </tr>
              <?php
              $o=1;
              $result = mysql_query("SELECT * FROM timetable NATURAL JOIN course WHERE timetable.cid=course.cid AND status='1' AND cid='$cd'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $o;?></td>
              <td><?php $timestamp=$row['date'];
                        $datetime=explode(" ",$timestamp);
                        echo$date=$datetime[0];?></td>
              <td><?php echo $row['cname'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><a href="../uploads/timetable/<?php echo$row['tid'];?>.pdf" id="view">View</a></td>
              </tr>
            <?php 
              $o++;
              }?>
            
          </table>
        </div>
        </div>
      </div>
      <div class="hide" id="t2">
       <div class="btd">
            <a id="bts1" class="bti">Current<?php 
                $ti="SELECT * FROM timetable WHERE did!='$did'AND status='0'AND `date` BETWEEN '$from' AND '$to'";
                $sql=mysql_query($ti,$con);
                $no=mysql_num_rows($sql);
                 ?><span class="badge-btn"><?php echo $no; ?></a>
            <a id="bts2" class="bti">Previous</a>
          </div>
        <div class="hide" id="s1">
        <div class="heading">
            <h6>Current Timetable</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Date</th>
              <th>Course</th>
              <th>Semester</th>     
              <th></th>
            </tr>
              <?php
              $o=1;
              
              $c=mysql_query("SELECT * FROM course WHERE cname='$course'");
              $re=mysql_fetch_array($c);
              $cd=$re['cid'];
              $result = mysql_query("SELECT * FROM timetable NATURAL JOIN course WHERE timetable.cid=course.cid AND cid!='$cd' AND status='0'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $o;?></td>
              <td><?php $timestamp=$row['date'];
                        $datetime=explode(" ",$timestamp);
                        echo$date=$datetime[0];?></td>
              <td><?php echo $row['cname'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><a href="../uploads/timetable/<?php echo$row['tid'];?>.pdf"id="view" target="blank">View</a></td>
              </tr>
            <?php 
              $o++;
              }?>
            
        </table>
      </div>
      <div class="hide" id="s2">
        <div class="heading">
          <h6>Previous Timetable</h6>
        </div>
        <table>
            <tr id="header">
              <th>Id</th>
              <th>Date</th>
              <th>Course</th>
              <th>Semester</th>     
              <th></th>
            </tr>
              <?php
              $o=1;
              $result = mysql_query("SELECT * FROM timetable NATURAL JOIN course WHERE timetable.cid=course.cid AND cid!='$cd' AND status='1'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $o;?></td>
              <td><?php $timestamp=$row['date'];
                        $datetime=explode(" ",$timestamp);
                        echo$date=$datetime[0];?></td>
              <td><?php echo $row['cname'];?></td>
              <td><?php echo $row['sem'];?></td>
              <td><a href="../uploads/timetable/<?php echo$row['tid'];?>.pdf" id="view">View</a></td>
              </tr>
            <?php 
              $o++;
              }?>
            
          </table>
        </div>
        </div>
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
       function button(){
        confirm('Are you sure you want to continue?')
      }
      $("#t1").show();
      $("#btk1").on("click",function(){
      $("#k1").show();
      $("#k2").hide();
      });
        $("#btk2").on("click",function(){
        $("#k2").show();
        $("#k1").hide();
        });
      $("#btn1").on("click",function(){
        $("#t1").show();
        $("#t2").hide();
        $("#btk1").on("click",function(){
        $("#k1").show();
        $("#k2").hide();
        });
        $("#btk2").on("click",function(){
        $("#k2").show();
        $("#k1").hide();
        });
      });
      $("#btn2").on("click",function(){
        $("#t2").show();
        $("#t1").hide();
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
         var btk = document.getElementsByClassName("btk");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
          btk[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("wow");

            // If there's no active class
            if (current.length > 0) {
              current[0].className = current[0].className.replace(" wow", "");
            }

            // Add the active class to the current/clicked button
            this.className += " wow";
          });
        }
    </script>
</body>
</html>