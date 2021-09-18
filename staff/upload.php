<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='staff')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');
  $username=$_SESSION['username'];
  $sq=mysql_query("SELECT * FROM staffreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sq);
  $sid=$ro['sid'];
  date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d H:i:s',time());
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
    $timestamp=$date;
    $datetime=explode(" ",$timestamp);
    $dateq=$datetime[0];
    $description=$_POST['description'];
    $type=$_POST['type'];
    $course='NULL';
    if($_POST['course']==1)
    {
      $course='NULL';
    }
    else
    {
      $course=$_POST['course'];
    }
    $file=$_FILES['fileToUpload'];
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
        $sql="INSERT INTO notice VALUES('$nid',NULL,'$sid','$description','$type','$course',NULL,'$date')";
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
 <!--View notice-->
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>
<div class="main">
    <div class="course">
      <div class="heading">
            <h6>Upload Notice</h6>
        </div>
         <form action="" method="post" id="course" enctype="multipart/form-data">
           <input type="file" name="fileToUpload" id="file"><br><br>
           <input type="text" name="description" id="name" placeholder="Enter Description">
           <input type="text" name="type" value="hod" readonly id="name">
           <select id="select" name="course">
            <option value="1" selected>--Select Course--</option>
            <?php
              $st=mysql_query("SELECT * FROM course");
              while($row=mysql_fetch_array($st))
              {
            ?>
            <option value="<?php echo $row['cname'];?>"><?php echo $row['cname'];?></option>
          <?php }?>
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
            <button type="submit" class="submit" name="upload">Upload</button>
         </form>
         <div class="heading">
            <h6>Notice</h6>
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
              $result = mysql_query("SELECT * FROM notice WHERE sid='$sid'");

              while($row = mysql_fetch_array($result))
              {
              ?>
              <tr>
              <td><?php echo $c;?></td>
              <td><?php echo $row['description'];?></td>
              <td><?php $timestamp=$row['date'];
                                $datetime=explode(" ",$timestamp);
                                echo$date=$datetime[0];?></td>
              <td><a href="../uploads/notice/<?php echo$row['nid'].$row['description'].'('.$date.')';?>.pdf"id="view"  target="blank">View</a></td>
              <?php if($sid==$row['sid']){ ?>
              <td><a href="updatenotice.php?id=<?php echo$row['nid'];?>&task=up"class="approve">Update</a></td>
              <td><a href="updatenotice.php?id=<?php echo$row['nid'];?>&task=del"class="reject">Delete</a></td><?php }?>
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
    </script>
</body>
</html>