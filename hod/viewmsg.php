<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='hod')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
  include('includes/dbconnect.php');//Databse connection
  //For inserting complaint details in to database
  //Date of creation:01/01/2021
  //Developed by Arun
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
 <!--Form to Upload Timetable-->
  <!--header-->
 <?php
 	include('includes/header.php');
 ?>
<div class="main">
    <div class="course">
        <?php
          $username=$_SESSION['username'];
        ?>
        <div class="heading">
            <h6>MESSAGES</h6>
        </div>
        <form  method="POST" action=""id="course">
          <table>
            <tr id="header">
              <th>Chat Name</th>
              <th>Message</th>
              <th>Send Date</th>     
              <th>Reply</th>
              <th>Reply Date</th>
            </tr>
              <?php
              $c=1;
              include 'includes/dbconnect.php';
              $res = "SELECT * FROM message WHERE `from`='$username'";
              $sq=mysql_query($res,$con);
              $n=mysql_num_rows($sq);
              if($n!=0)
                {
                  while($row = mysql_fetch_array($sq))
                    {
                    ?>
                    <tr>
                    <td><?php 
                          $s=mysql_query("SELECT * FROM studentreg WHERE userid='$row[to]'");
                          while($res=mysql_fetch_array($s))
                          {
                            echo $res['stfname']." ".$res['stlname'];
                          }
                           ?></td>
                    <td><?php echo $row['message'];?></td>
                    <td><?php echo $row['sdate'];?></td>
                    <td><?php if($row['reply']=='')
                              {
                                echo "No Reply";
                              }
                              else
                              {
                                echo $row['reply'];
                              }
                          ?></td>
                    <td><?php echo $row['rdate'];?></td>
                    </tr>
                  <?php 
                    $c++;
                    }
                }
                else
                {?>
                  <tr><td colspan='5' style="text-align: center;">No New Messages</td></tr>
                <?php }?>

            
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