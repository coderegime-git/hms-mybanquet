<?php  
session_start();
include("../config.php");
$code16=$_GET['code16'];
$heading16=$_GET['heading16'];

$sql="select * from packing_requirements where packing_code='$code16' AND packing_heading='$heading16' AND packreq_id='16'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo $row['packing_code'].','.$row['packing_req'];

/*  echo $nsn_no.'@'.$part_no.'@'.$part_name.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue.'@'.$part_no.'@'.$part_name;  */ 
?>