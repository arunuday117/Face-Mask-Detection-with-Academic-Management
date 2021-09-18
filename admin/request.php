<?php
  session_start();
  //authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='admin')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
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
    <script type="text/javascript">
      if(performance.navigation.type==2){
        location.reload(true);
      }
    </script>
  </head>
<body>
  <!----loader---->
  <div class="loader">
    <img src="../assets/images/loader.gif" alt="Loading..." />
  </div>
  <!--header-->
  <?php
    include('includes/header.php');
  ?>
  <!-- ***** Viewing approved users ***** -->
  <div class="cover">
    <div class="table">
      <div class="table-heading">
        <h6>Approved Users</h6>
      </div>
      <table>
        <tr id="header">
          <th>Id</th>
          <th>Name</th>
          <th>Address</th>
          <th>Phone No</th> 
          <th>Email</th>     
          <th>Action</th>
        </tr>
          <?php
          $c=1;
          include 'includes/dbconnect.php';
          $result = mysql_query("SELECT * FROM departmentreg NATURAL JOIN login WHERE departmentreg.userid=login.userid AND status='0'");
          $no=mysql_num_rows($result);
          while($row = mysql_fetch_array($result))
          {
          ?>
          <tr>
          <td><?php echo $c;?></td>
          <td><?php echo $row['f_name'].'  '.$row['l_name'];?></td>
          <td><?php echo $row['housename'].' , '.$row['street'].' , '.$row['district'].' , '.$row['state'].' , '.$row['pincode'];?></td>
          <td><?php echo $row['phone'];?></td>
          <td><?php echo $row['userid']; ?></td>
          <td><a href="approve.php?id=<?php echo$row['userid'];?>" class="approve" >Approve<a><a href="reject.php?id=<?php echo$row['userid'];?>" class="reject">Reject</a></td>
          </tr>
        <?php 
          $c++;
          }
          $c=1;
          include 'includes/dbconnect.php';
          $result = mysql_query("SELECT * FROM studentreg NATURAL JOIN login WHERE studentreg.userid=login.userid AND status='0'");
          $no+=mysql_num_rows($result);
          while($row = mysql_fetch_array($result))
          {
          ?>
          <tr>
          <td><?php echo $c;?></td>
          <td><?php echo $row['stfname'].'  '.$row['stlname'];?></td>
          <td><?php echo $row['sthousename'].' , '.$row['ststreet'].' , '.$row['stdistrict'].' , '.$row['ststate'].' , '.$row['stpincode'];?></td>
          <td><?php echo $row['stphone'];?></td>
          <td><?php echo $row['userid']; ?></td>
          <td><a href="approve.php?id=<?php echo$row['userid'];?>" class="approve" >Approve<a><a href="reject.php?id=<?php echo$row['userid'];?>" class="reject">Reject</a></td>
          </tr>
        <?php 
          $c++;
          }
          $c=1;
          include 'includes/dbconnect.php';
          $result = mysql_query("SELECT * FROM parentreg NATURAL JOIN login WHERE parentreg.userid=login.userid AND status='0'");
          $no+=mysql_num_rows($result);
          while($row = mysql_fetch_array($result))
          {
          ?>
          <tr>
          <td><?php echo $c;?></td>
          <td><?php echo $row['pfname'].'  '.$row['plname'];?></td>
          <td><?php echo $row['phousename'].' , '.$row['pstreet'].' , '.$row['pdistrict'].' , '.$row['pstate'].' , '.$row['ppincode'];?></td>
          <td><?php echo $row['pphone'];?></td>
          <td><?php echo $row['userid']; ?></td>
          <td><a href="approve.php?id=<?php echo$row['userid'];?>" class="approve" >Approve<a><a href="reject.php?id=<?php echo$row['userid'];?>" class="reject">Reject</a></td>
          </tr>
        <?php 
          $c++;
          }
          $c=1;
          include 'includes/dbconnect.php';
          $result = mysql_query("SELECT * FROM staffreg NATURAL JOIN login WHERE staffreg.userid=login.userid AND status='0'");
          $no+=mysql_num_rows($result);
          while($row = mysql_fetch_array($result))
          {
          ?>
          <tr>
          <td><?php echo $c;?></td>
          <td><?php echo $row['sfname'].'  '.$row['slname'];?></td>
          <td><?php echo $row['shousename'].' , '.$row['sstreet'].' , '.$row['sdistrict'].' , '.$row['sstate'].' , '.$row['spincode'];?></td>
          <td><?php echo $row['sphone'];?></td>
          <td><?php echo $row['userid']; ?></td>
          <td><a href="approve.php?id=<?php echo$row['userid'];?>" class="approve" >Approve<a><a href="reject.php?id=<?php echo$row['userid'];?>" class="reject">Reject</a></td>
          </tr>
        <?php 
          $c++;
          }
          if($no<=0)
          {
            echo "<tr><td>NO RESULTS TO SHOW</td></tr>";
          }?>
      </table>
    </div>
  </div>
</div>
<!--footer-->
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