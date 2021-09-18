 <!--Admin header-->

 <header class="main-header clearfix" role="header">
    <div class="logo">
      <a href="index.php"><em>ANV</em>ACADEMICS</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="index.php">Home</a></li>
        <li class="has-submenu"><a href="approvedus.php">Approved Users</a>
        <ul class="sub-menu">
            <li><a href="viewhod.php">HOD</a></li>
            <li><a href="viewadvisor.php">Advisor</a></li>
            <li><a href="viewfaculty.php">Faculty</a></li>
            <li><a href="viewstaff.php">Staff</a></li>
            <li><a href="viewstudent.php">Students</a></li>
            <li><a href="viewparent.php">Parents</a></li>
          </ul></li>
        <li class="has-submenu"><a href="request.php">User Requests<?php 
                include('includes/dbconnect.php');
                $state="SELECT * FROM login WHERE status='0'";
                $sql=mysql_query($state,$con);
                $no=mysql_num_rows($sql); ?><span class="badge"><?php echo $no; ?></span></a>
        <ul class="sub-menu">
            <li><a href="hodreq.php">HOD<?php 
                $state="SELECT * FROM login WHERE status='0' AND type='hod'";
                $sql=mysql_query($state,$con);
                $no=mysql_num_rows($sql); ?><span class="badge-sub"><?php echo $no; ?></span></a></li>
            <li><a href="advisorreq.php">Advisor</a><?php 
                $state="SELECT * FROM login WHERE status='0' AND type='advisor'";
                $sql=mysql_query($state,$con);
                $no=mysql_num_rows($sql); ?><span class="badge-sub"><?php echo $no; ?></span></a></li>
            <li><a href="facultyreq.php">Faculty</a><?php 
                $state="SELECT * FROM login WHERE status='0' AND type='faculty'";
                $sql=mysql_query($state,$con);
                $no=mysql_num_rows($sql); ?><span class="badge-sub"><?php echo $no; ?></span></a></li>
            <li><a href="staffreq.php">Staff</a><?php 
                $state="SELECT * FROM login WHERE status='0' AND type='staff'";
                $sql=mysql_query($state,$con);
                $no=mysql_num_rows($sql); ?><span class="badge-sub"><?php echo $no; ?></span></a></li>
            <li><a href="studentreq.php">Students</a><?php 
                $state="SELECT * FROM login WHERE status='0' AND type='student'";
                $sql=mysql_query($state,$con);
                $no=mysql_num_rows($sql); ?><span class="badge-sub"><?php echo $no; ?></span></a></li>
            <li><a href="parentreq.php">Parents<?php 
                $state="SELECT * FROM login WHERE status='0' AND type='parent'";
                $sql=mysql_query($state,$con);
                $no=mysql_num_rows($sql); ?><span class="badge-sub"><?php echo $no; ?></span></a></li>
          </ul></li>
        <li class="has-submenu"><a href="addcourse.php">Course</a>
        <ul class="sub-menu">
            <li><a href="addcourse.php">Add Course</a></li>
            <li><a href="viewcourse.php">View Course</a></li>
          </ul></li>
        <li><a href="feedback.php">Feedbacks<?php 
                date_default_timezone_set('Asia/Kolkata');// change according timezone
                $f1="00:00:00";
                $from=date('Y-m-d')." ".$f1;
                $t1="23:59:59";
                $to=date('Y-m-d')." ".$t1;
                $state="SELECT * FROM message WHERE `to`='admin@gmail.com' AND message.sdate BETWEEN '$from' AND '$to'";
                $sql=mysql_query($state,$con);
                $no=mysql_num_rows($sql); ?><span class="badge"><?php echo $no; ?></span></a></li>
        <li class="has-submenu"><a href="">Admin</a>
        <ul class="sub-menu">
            <li><a href="changepassword.php">Change Password</a></li>
           <li><a href="../logout.php">logout</a></li>
          </ul></li>
      </ul>
  </nav>
</header>
<?php

?>