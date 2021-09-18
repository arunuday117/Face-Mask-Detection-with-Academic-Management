<?php
  session_start();
  //Authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='hod')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
include('includes/dbconnect.php');
if(isset($_POST['add']))
{
$type=$_POST['type'];
$batch=$_POST['batch'];
$sem=$_POST['sem'];
$subject=$_POST['sub'];
$previous=isset($_POST['previous']);
}
if(isset($_POST['back']))
{
  echo"<script>location.href='viewmarks.php';</script>";
}
if(isset($_POST['update']))
{
  foreach ($_POST['mark'] as $key => $value) {
  $sq="UPDATE exammark SET mark='$value' WHERE emid='$key'";//Data insertion code
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
      echo "<script>alert('Mark Successfully Updated')</script>";
      echo"<script>location.href='viewmarks.php';</script>";
      
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
</script>
  </head>

<body>
  <div class="loader">
        <img src="../assets/images/loader.gif" alt="Loading..." />
    </div>
  <!--header-->
 <?php
  include('includes/header.php');
  $username=$_SESSION['username'];
  $sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
  $ro=mysql_fetch_array($sq);
  $did=$ro['did'];
  $p=mysql_query("SELECT * FROM exammark WHERE batch='$batch' AND type='$type' AND sem='$sem' AND subject='$subject'");
  $n=mysql_num_rows($p);
 ?>
  <!-- ***** Course creation ***** -->
  <div class="main">
    <div class="course">
          <?php
          if($n>0)
          {
          if($previous=='false')
          {
          ?>
        <div class="heading">
            <h6>View Mark</h6>
        </div>
        <form  method="POST" action=""id="course">
          <table>
            <tr id="header">
              <th>Id</th>
              <th>Student Name</th>
              <th>Mark</th>
              <th>Out of</th>     
            </tr>
              <?php
              $c=1;
              $query =mysql_query("SELECT * FROM exammark WHERE batch='$batch' AND type='$type' AND sem='$sem' AND subject='$subject'AND status='0'ORDER BY rlno ASC",$con);
              while($row = mysql_fetch_array($query))
              {
                $sq=mysql_query("SELECT * FROM studentlist WHERE rlno='$row[rlno]'");
                while ($s=mysql_fetch_array($sq))
                {
                  $name=$s['sfname'].' '.$s['slname'];
                }
              ?>
              <tr>
               <td><?php echo $row['rlno'];?></td>
               <td><?php echo $name;?></td>
               <td>
               <?php if($did==$row['did']){?>
                <input type="number" name="mark[<?php echo $row['emid'];?>]" value="<?php echo $row['mark'];?>"><?php }else{ echo $row['mark'];}?></td>
               <td><?php echo $row['outof'];?></td>
            </tr>
            <?php 
              $c++;
              }?>
            </table>
            <button type="submit" id="submit" onclick="return confirm('Do you want to continue?')" name="submit">submit</button>
          </form>
            <?php }
          else
          {
          ?>
        <form  method="POST" action=""id="course">
        <div class="heading">
            <h6>Current Marks</h6>
        </div>
          <table>
            <tr id="header">
              <th>Id</th>
              <th>Student Name</th>
              <th>Mark</th>
              <th>Out of</th>     
            </tr>
              <?php
              $c=1;
              $query =mysql_query("SELECT * FROM exammark WHERE batch='$batch' AND type='$type' AND sem='$sem' AND subject='$subject' AND status='0'ORDER BY rlno ASC",$con);
              while($row = mysql_fetch_array($query))
              {
                $sq=mysql_query("SELECT * FROM studentlist WHERE rlno='$row[rlno]'");
                while ($s=mysql_fetch_array($sq))
                {
                  $name=$s['sfname'].' '.$s['slname'];
                }
              ?>
              <tr>
               <td><?php echo $row['rlno'];?></td>
               <td><?php echo $name;?></td>
               <td><?php if($did==$row['did']){?>
                <input type="number" name="mark[<?php echo $row['emid'];?>]" value="<?php echo $row['mark'];?>"><?php }else{ echo $row['mark'];}?></td>
               <td><?php echo $row['outof'];?></td>
            </tr>
            <?php 
              $c++;
              }?>
              </table>
              <button type="submit" id="submit" onclick="return confirm('Do you want to continue?')" name="update">Update</button>
            </form>
          <div class="heading">
            <h6>Previous Marks</h6>
          </div>
          <table>
            <tr id="header">
              <th>Id</th>
              <th>Student Name</th>
              <th>Mark</th>
              <th>Out of</th>     
            </tr>
              <?php
              $c=1;
              $query =mysql_query("SELECT * FROM exammark WHERE batch='$batch' AND type='$type' AND sem='$sem' AND subject='$subject' AND status='1'ORDER BY rlno ASC",$con);
              while($row = mysql_fetch_array($query))
              {
                $sq=mysql_query("SELECT * FROM studentlist WHERE rlno='$row[rlno]'");
                while ($s=mysql_fetch_array($sq))
                {
                  $name=$s['sfname'].' '.$s['slname'];
                }
              ?>
              <tr>
               <td><?php echo $row['rlno'];?></td>
               <td><?php echo $name;?></td>
               <td><?php echo $row['mark'];?></td>
               <td><?php echo $row['outof'];?></td>
            </tr>
            <?php 
              $c++;
              }?>
              </table>
                    </form>
            <?php }
          }
            else
              {
                echo "<form method='post'>";
                echo "<div class='heading'>
                        <h6>No Data Found</h6>
                    </div>";
                  echo"<button type='submit'id='back'  name='back'>BACK</button>";
                  echo"</form>";
              }?>
        
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

