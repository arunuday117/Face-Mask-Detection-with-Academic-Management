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
  $batch=$ro['batch'];
  if(isset($_POST['upload']))
  {
    $sql="SELECT max(nid) as nid from notice";
    $data=mysql_query($sql);
    $nid=0;
    while($row=mysql_fetch_array($data))
    {
     $nid=$row['nid'];
    }
    $nid=$nid+1;
    $target_dir = "../uploads/notice/";//target folder
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d H:i:s',time());
    $timestamp=$date;
    $datetime=explode(" ",$timestamp);
    $dateq=$datetime[0];
    $description=$_POST['description'];
    $type=$_POST['type'];
    $file=$_FILES['fileToUpload'];
    $course=$_POST['course'];
    $uploadOk = 1;
    $result=mysql_query("SELECT * FROM notice");
    $no=mysql_num_rows($result);
    $id=$no+1;
    $msg='';
    $msg1='';
    $msg2='';
    $msg3='';
    $msg4='';
    $s=basename($_FILES["fileToUpload"]["name"]);
    $FileType = strtolower(pathinfo($s,PATHINFO_EXTENSION));
    $newfilename=$target_dir .$nid.$description.'('.$dateq.')'.".".$FileType;
  // Check if file already exists
  if (file_exists($newfilename)) {
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
        
          $sql="INSERT INTO notice VALUES('$nid','$did',NULL,'$description','$type','$course','$batch','$date')";
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

    <title>ACADEMIC MANAGEMENT</title>
    
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
 <!--Form to Upload Notice-->
  <!--header-->
 <?php
  include('includes/header.php');
  $course=$ro['course'];
 ?>
<div class="main">
  <div class="bt">
    <a id="btn1" class="btn active">Your Notice</a>
    <a id="btn2" class="btn">Notice<?php 
                $ti="SELECT * FROM notice WHERE did!='$did' AND (type='advisor'OR type='public' OR type='faculty') AND course='$course' AND `date` BETWEEN '$from' AND '$to'";
                $sql=mysql_query($ti,$con);
                $no=mysql_num_rows($sql);
                 ?><span class="badge-btn"><?php echo $no; ?></span></a>
  </div>
  <div class="course">
    <div class="hide" id="t1">
      <div class="heading">
          <h6>Upload Notice</h6>
      </div>
         <form action="" method="post" id="course" enctype="multipart/form-data">
           <input type="file" name="fileToUpload" id="file" required><br><br>
           <input type="text" name="description" id="name" placeholder="Enter Description" required>
           <input type="hidden" name="course" id="name"readonly value="<?php echo $course; ?>">
           <input type="text" name="type" id="name"readonly value="<?php echo'student'; ?>">
           <input type="text" name="batch" id="name"readonly value="<?php echo $batch; ?>">
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
            <button type="submit" id="submit" onclick="button()" name="upload">Upload</button>
         </form>
          <div class="heading">
                     <h6>Your Notice</h6>
                 </div>
                 <table>
                     <tr id="header">
                       <th>Id</th>
                       <th>Notice</th>
                       <th>Date</th>     
                       <th></th>
                       <th></th>
                       <th></th>
                     </tr>
                       <?php
                       $c=1;
                       $result = mysql_query("SELECT * FROM notice WHERE did='$did'");
         
                       while($row = mysql_fetch_array($result))
                       {
                       ?>
                       <tr>
                       <td><?php echo $c;?></td>
                       <td><?php echo $row['description'];?></td>
                       <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
                       <td><a href="../uploads/notice/<?php echo$row['nid'].$row['description'].'('.$date.')';?>.pdf"id="view" target="blank">View</a></td>
                       <?php if($did==$row['did']){ ?>
              <td><a href="updatenotice.php?id=<?php echo$row['nid'];?>&task=up"class="approve">Update</a></td>
              <td><a href="updatenotice.php?id=<?php echo$row['nid'];?>&task=del"class="reject">Delete</a></td><?php }?>
                       </tr>
                     <?php 
                       $c++;
                       }?>
                     
                 </table>
          </div>
      <div class="hide" id="t2">
          <div class="btd">
            <a id="bts1" class="bti">Public<?php 
                $ti="SELECT * FROM notice WHERE did!='$did'AND type='public' AND course='$course' AND `date` BETWEEN '$from' AND '$to'";
                $sql=mysql_query($ti,$con);
                $no=mysql_num_rows($sql);
                 ?><span class="badge-btn"><?php echo $no; ?></span></a>
            <a id="bts2" class="bti">HOD<?php 
                $ti="SELECT * FROM notice WHERE did!='$did'AND (type='advisor' OR type='faculty') AND batch='$batch' AND course='$course' AND `date` BETWEEN '$from' AND '$to'";
                $sql=mysql_query($ti,$con);
                $no=mysql_num_rows($sql);
                 ?><span class="badge-btn"><?php echo $no; ?></span></a>
          </div>
        <div class="hide" id='s1'>
          <div class="heading">
                     <h6>Public Notice</h6>
                 </div>
                 <table>
                     <tr id="header">
                       <th>Id</th>
                       <th>Notice</th>
                       <th>Date</th> 
                       <th></th>    
                     </tr>
                       <?php
                       $c=1;
                       $result = mysql_query("SELECT * FROM notice WHERE type='public' AND course='$course'");
         
                       while($row = mysql_fetch_array($result))
                       {
                       ?>
                       <tr>
                       <td><?php echo $c;?></td>
                       <td><?php echo $row['description'];?></td>
                       <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
                       <td><a href="../uploads/notice/<?php echo$row['nid'].$row['description'].'('.$date.')';?>.pdf"id="view" target="blank">View</a></td>
                       </tr>
                     <?php 
                       $c++;
                       }?>
                     
                 </table>
          </div>
          <div class="hide" id="s2">
            <div class="heading">
              <h6>HOD Notice</h6>
             </div>
             <table>
                 <tr id="header">
                   <th>Id</th>
                   <th>Notice</th>
                   <th>Date</th> 
                   <th></th>    
                 </tr>
                   <?php
                   $c=1;
                   $result = mysql_query("SELECT * FROM notice WHERE did!='$did'AND type='advisor' AND course='$course'");
     
                   while($row = mysql_fetch_array($result))
                   {
                   ?>
                   <tr>
                   <td><?php echo $c;?></td>
                   <td><?php echo $row['description'];?></td>
                   <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
                   <td><a href="../uploads/notice/<?php echo$row['nid'].$row['description'].'('.$date.')';?>.pdf"id="view" target="blank">View</a></td>
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
        function button(){
        confirm('Are you sure you want to continue?')
      }
      $("#t1").show();
      $("#btn1").on("click",function(){
        $("#t1").show();
        $("#t2").hide();
        });
      //
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