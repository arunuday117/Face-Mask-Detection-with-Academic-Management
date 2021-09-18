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
$sq=mysql_query("SELECT * FROM departmentreg WHERE userid='$username'");
$ro=mysql_fetch_array($sq);
$did=$ro['did'];
$course=$ro['course'];
$output=array();
$query =mysql_query("SELECT * FROM assignment NATURAL JOIN assignmentmark WHERE assignment.asid=assignmentmark.asid AND did='$did'");
$tot=0;
while($total_set=mysql_fetch_array($query))
{
	if($total_set['mark']==null)
	{
	$tot=$tot+1;
	}
}
if(isset($_GET['assin']))
{
	$tot=0;
}
array_push($output,$tot);
$query =mysql_query("SELECT * FROM maskviolations WHERE `desc`='nomask' AND `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
array_push($output,$total_row);

$query =mysql_query("SELECT * FROM timetable WHERE did!='$did'AND status='0'AND `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row);
$query =mysql_query("SELECT * FROM notice WHERE (type='hod' OR type='public') AND (course='$course' OR course='NULL') AND  `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row); 
$query =mysql_query("SELECT * FROM exam WHERE did!='$did'AND `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row); 
$query =mysql_query("SELECT * FROM materials WHERE did!='$did' AND`date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row); 
$query =mysql_query("SELECT * FROM message WHERE `to`='$username' AND `rdate` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row); 
array_splice($output,2,0,$total);
echo json_encode($output);


?>