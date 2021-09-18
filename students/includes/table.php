<?php
session_start();
  //Authorization
include('dbconnect.php');
date_default_timezone_set('Asia/Kolkata');// change according timezone
$to=date('Y-m-d H:i:s',time());
$timestamp=$to;
$datetime=explode(" ",$timestamp);
$date=$datetime[0];
$total=0;
$username=$_SESSION['username'];
$p=mysql_query("SELECT * FROM login WHERE userid='$username'");
$sp=mysql_fetch_array($p);
$login=$sp['login'];
$logout=$sp['logout'];
$sq=mysql_query("SELECT * FROM studentreg WHERE userid='$username'");
$ro=mysql_fetch_array($sq);
$stid=$ro['stid'];
$st=0;
$course=$ro['course'];
$batch=$ro['batch'];
$ps=mysql_query("SELECT * FROM course WHERE cname='$course'");
$tr=mysql_fetch_array($ps);
$cid=$tr['cid'];
$output=array();

$query =mysql_query("SELECT * FROM timetable WHERE cid='$cid' AND status='0'AND `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row);

$query =mysql_query("SELECT * FROM attendance WHERE cid='$cid' AND batch='$batch' AND `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row);

$query =mysql_query("SELECT * FROM assignment NATURAL JOIN assignmentmark WHERE assignment.asid=assignmentmark.asid AND course='$course'AND batch='$batch' AND duedate>='$date' AND `date` BETWEEN '$logout' AND '$to'");
while($ro=mysql_fetch_array($query))
{
	if($ro['stid']==NULL)
	{
		$st=$st+1;
	}
}
$total_row=$st;
$total=$total+$total_row;
array_push($output,$total_row);

$query =mysql_query("SELECT * FROM materials WHERE mtcourse='$course' AND`date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row); 

$query =mysql_query("SELECT * FROM exam WHERE cid='$cid' AND `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row);

$query =mysql_query("SELECT * FROM notice WHERE (type='public'OR type='student') AND (batch='$batch' OR course='$course') AND  `date` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row); 
 
$query =mysql_query("SELECT * FROM message WHERE `to`='$username' AND `sdate` BETWEEN '$logout' AND '$to'");
$total_row=mysql_num_rows($query);
$total=$total+$total_row;
array_push($output,$total_row); 

echo json_encode($output);


?>