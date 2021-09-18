<?php
  session_start();
  if(!isset($_SESSION['username'])||$_SESSION['user']!='admin')
  {
    echo"<script>alert('You are not authorized to view this page!');</script>";
    echo"<script>location.href='../login.php';</script>";
  }
	include('includes/dbconnect.php');
	$id=$_GET['id'];
	$sq=mysql_query("UPDATE login SET status='2'WHERE userid='$id'");
	if($sq)
	{
		echo"<script>alert('Account Rejected!');</script>";
        echo"<script>window.history.go(-1);</script>";
	}
?>