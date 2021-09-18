<?php
	include('includes/dbconnect.php');
	$id=$_GET['id'];
	$sql="DELETE FROM student_complaint WHERE stcid='$id'";
	if(mysql_query($sql))
	{
		echo"<script>alert('Complaint Deleted!!');</script>";
		echo "<script>location.href='complaints.php'</script>";
	}
	else
	{
		echo"<script>alert('Something Went Wrong!!');</script>";
		echo "<script>location.href='complaints.php'</script>";
	}
?>