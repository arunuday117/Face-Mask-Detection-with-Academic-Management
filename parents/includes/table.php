<?php
session_start();
  //Authorization
include('dbconnect.php');
date_default_timezone_set('Asia/Kolkata');// change according timezone
$to=date('Y-m-d H:i:s',time());
$total=0;
$username=$_SESSION['username'];
$p=mysql_query("SELECT * FROM login WHERE userid='$username'");
$sp=mysql_fetch_array($p);
$login=$sp['login'];
$logout=$sp['logout'];
$sq=mysql_query("SELECT * FROM parentreg WHERE userid='$username'");
$ro=mysql_fetch_array($sq);
$stid=$ro['stid'];
$sq=mysql_query("SELECT * FROM studentreg WHERE stid='$stid'");
$ro=mysql_fetch_array($sq);
$course=$ro['course'];
$batch=$ro['batch'];
$ps=mysql_query("SELECT * FROM course WHERE cname='$course'");
$tr=mysql_fetch_array($ps);
$cid=$tr['cid'];
$output=array();

$query =mysql_query("SELECT * FROM student_complaint WHERE stid='$stid' AND status='0' AND`date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row); 

$query =mysql_query("SELECT * FROM attendance WHERE cid='$cid' AND `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row);

$query =mysql_query("SELECT * FROM notice WHERE type='public' AND course='$course' AND batch='$batch' AND  `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row); 

$query =mysql_query("SELECT * FROM timetable WHERE cid='$cid' AND status='0'AND `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row);

$query =mysql_query("SELECT * FROM exam WHERE cid='$cid' AND batch='$batch' AND `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row);

echo json_encode($output);


?>