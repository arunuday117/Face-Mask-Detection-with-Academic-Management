<?php
  session_start();
  //authorization
  if(!isset($_SESSION['username'])||$_SESSION['user']!='admin')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
	include('includes/dbconnect.php');//Database connection
	$id=$_GET['id'];//getting user id 
	$sq=mysql_query("UPDATE login SET status='1'WHERE userid='$id'");
	if($sq)
	{
		echo"<script>alert('Account Approved!');</script>";
    echo"<script>window.history.go(-1);</script>";
	}
?>