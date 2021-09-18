<?php
include('includes/dbconnect.php');
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
$id=$_GET['id'];
$name="image".$_GET['img'].".png";
$sql="INSERT INTO maskviolations VALUES('mid','$date','$name','nomask')";
$sq=mysql_query($sql);

?>