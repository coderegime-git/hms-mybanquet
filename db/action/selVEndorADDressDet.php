<?php  
session_start();
include("../config.php");
$venNO=$_GET['venNO'];

$sql="select * from vendor_master where vendor_code='$venNO'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$vendor_code=$row['vendor_code'];
$vendor_name=$row['vendor_name'];
$address1=$row['address1'];
$address2=$row['address2']; 
$city=$row['city'];
$pincode=$row['pincode'];
$state=$row['state'];


echo $address1.'@'.$address2.'@'.$city.'@'.$pincode; 
?>