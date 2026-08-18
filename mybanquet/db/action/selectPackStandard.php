<?php  
session_start();
include("../config.php");
$code1=$_GET['code1'];
$heading1=$_GET['heading1'];

$sql="select * from packing_requirements where packing_code='$code1' AND packing_heading='$heading1'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo $row['packing_code'].','.$row['packing_req'];

/*  echo $nsn_no.'@'.$part_no.'@'.$part_name.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue.'@'.$part_no.'@'.$part_name;  */ 
?>