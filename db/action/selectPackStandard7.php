<?php  
session_start();
include("../config.php");
$code7=$_GET['code7'];
$heading7=$_GET['heading7'];

$sql="select * from packing_requirements where packing_code='$code7' AND packing_heading='$heading7'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo $row['packing_code'].','.$row['packing_req'];

/*  echo $nsn_no.'@'.$part_no.'@'.$part_name.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue.'@'.$part_no.'@'.$part_name;  */ 
?>