<?php
  include('includes/dbconnect.php');//Databse connection
  //For inserting complaint details in to database
  //Date of creation:01/01/2021
  //Developed by Arun
  if(isset($_POST['add']))
  {
    $username=$_POST['email'];
    $message=$_POST['message'];//this is for getting complaints
    date_default_timezone_set('Asia/Kolkata');// change according timezone
    $date=date('Y-m-d h:i:sa');//current date
    $sq="INSERT INTO message VALUES('NULL','$message','admin@gmail.com','$date','$username','','','0')";//Data insertion code
    if(mysql_query($sq,$con))
    {
      echo"<script>alert('Thank you for your feedback!!');</script>";
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
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
<!--
    
TemplateMo 557 Grad School

https://templatemo.com/tm-557-grad-school

-->
  </head>

<body>
<div class="loader">
        <img src="assets/images/loader.gif" alt="Loading..." />
    </div>
   
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>

  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="assets/images/course-video.mp4" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
          <div class="caption">
              <h6>Anv Academics</h6>
              <h2><em>Your</em> Academic Companion</h2>
              <div class="main-button">
                  <div class="scroll-to-section"><a href="#section2">Discover more</a></div>
              </div>
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->
  <section class="section why-us" id="section2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Why choose Anv Academics?</h2>
          </div>
        </div>
        <div class="col-md-12">
          <div id='tabs'>
            <ul>
              <li><a href='#tabs-1'>Best Education</a></li>
              <li><a href='#tabs-2'>Top Management</a></li>
              <li><a href='#tabs-3'>Quality Faculties</a></li>
            </ul>
            <section class='tabs-content'>
              <article id='tabs-1'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/choose-us-image-01.png" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Best Education</h4>
                    <p>We provide the best for the best.</p>
                  </div>
                </div>
              </article>
              <article id='tabs-2'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/choose-us-image-02.png" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Top Level</h4>
                    <p>We have the top level management.</p>
                  </div>
                </div>
              </article>
              <article id='tabs-3'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/choose-us-image-03.png" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Quality Faculties</h4>
                    <p>We have the best faculties.</p>
                  </div>
                </div>
              </article>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section courses" id="section3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Choose Your Course</h2>
          </div>
        </div>
        <div class="owl-carousel owl-theme">
          <?php
          $sql="SELECT * FROM course";
          $result=mysql_query($sql,$con);
          if($result)
          {
            while ($row=mysql_fetch_array($result)) {?>
          <div class="item">
            <img src="admin/uploads/<?php echo $row['cid']; ?>.jpg">
            <div class="down-content">
              <h4><?php echo $row['cname']; ?></h4>
              <p><?php $pos=strpos($row['cdesc'],'. '); 
                        echo $cdesc=substr($row['cdesc'],'0',$pos+1);?>
              <a href="course.php?id=<?php echo $row['cid']; ?>">VIEW MORE</a></p>
            </div>
          </div>
          <?php
            }
          }

          ?>
        </div>
      </div>
    </div>
  </section>
  

  <section class="section video" id="section4">
    <div class="container">
      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <h4>CONTACT US</h4>
            <form id="contact" action="" method="post">
	            <div class="col-md-12">
	                <fieldset>
	                	<input name="email" type="text" class="form-control" id="email" placeholder=" Email ID"value="<?php if(isset($email)){echo $email;}  ?>">
	                </fieldset>
	            </div>
	                <?php
	                    if(isset($error_msg['email']))
	                    {
	                        echo "<font color=red >".$error_msg['email']."</font>";
	                    }
	                  	?>
	            <div class="col-md-12">
	                <fieldset>
	                	<textarea name="message" type="text" class="form-control" id="message" placeholder="Type Your Message"value="<?php if(isset($message)){echo $message;}  ?>"></textarea>
	                </fieldset>
	            </div> 
	            <div class="main-button">
	            	<button type="submit" name="add">SEND</button>
	            </div>
	        </form>
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <figure>
              <img src="assets/images/main-thumb.jpg">
            </figure>
          </article>
        </div>
      </div>
    </div>
  </section>

  <?php include('includes/footer.php');?>
  <script type="text/javascript">
    window.addEventListener("load", function (){
            const loader = document.querySelector(".loader");
            loader.className += " hidden"; // class "loader hidden"
  });
  </script>
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
</body>
</html>