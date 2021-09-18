<?php
	include('includes/dbconnect.php');
	$id=$_GET['id'];
	$sql="UPDATE student_complaint SET status='1' WHERE stcid='$id'";
	if(mysql_query($sql))
	{
		echo"<script>alert('Complaint marked as viewed!!');</script>";
		echo "<script>location.href='complaints.php'</script>";
	}
	else
	{
		echo"<script>alert('Something Went Wrong!!');</script>";
		echo "<script>location.href='complaints.php'</script>";
	}

?>