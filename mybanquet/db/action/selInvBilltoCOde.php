<?php  
session_start();
include("../config.php");

$bcode=$_GET['bcode'];

$sql=mysql_query("select * from client_master where client_code='$bcode'");
$row=mysql_fetch_array($sql);

echo $row['baddress1'].','.$row['baddress2'].','.$row['bcity'].','.$row['bpincode'].','.$row['bstate'].','.$row['bcountry'];  
?>