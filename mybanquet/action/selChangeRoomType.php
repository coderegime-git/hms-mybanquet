<?php  

include("../config.php");
$roomNo=$_GET['roomNo'];

$sql="select * from guest_register where room_no='$roomNo' AND bill_status='1'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

echo $row['room_no'].','.$row['room_type'].','.$row['guest_name'].','.$row['guestreg_id'];

?>