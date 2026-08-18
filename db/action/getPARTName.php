<?php  
session_start();
include("../config.php");

$partnumber=$_GET['partNM'];

$sql="select * from partnumber where partnumber='$partnumber'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$partname=$row['partname'];


echo $partname;

?>