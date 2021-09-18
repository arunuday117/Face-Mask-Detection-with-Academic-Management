<?php
include('includes/dbconnect.php');
$userdata=$_GET['id'];
$name=$_GET['nam'];
$sql="SELECT max(mid) as mid from maskviolations";
$data=mysql_query($sql);
$mid=0;
while($row=mysql_fetch_array($data))
{
 $mid=$row['mid'];
}
$mid=$mid+1;
date_default_timezone_set('Asia/Kolkata');// change according timezone
$date=date('Y-m-d H:i:s',time());
if($userdata=="nomask")
{
	$sql="INSERT INTO maskviolations VALUES('mid','$date','$name','$userdata')";
	$sq=mysql_query($sql);
	$img = "upload/".$name;
	$folderPath = "violation/".$name;
	rename ( $img, $folderPath );
}
elseif($userdata=='whitemask')
{
	print_r("whitemask");
	unlink('upload/'.$name);
}
elseif($userdata=='mask')
{
	$sql="INSERT INTO maskviolations VALUES('mid','$date','$name','$userdata')";
	$sq=mysql_query($sql);
	print_r("mask");
	unlink('upload/'.$name);
}
else
{
	$sql="INSERT INTO maskviolations VALUES('mid','$date','$name','$userdata')";
	$sq=mysql_query($sql);
	print_r("no face");
	unlink('upload/'.$name);
}
?>