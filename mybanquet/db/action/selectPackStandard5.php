<?php  
session_start();
include("../config.php");
$code5=$_GET['code5'];
$heading5=$_GET['heading5'];

$sql="select * from packing_requirements where packing_code='$code5' AND packing_heading='$heading5'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo $row['packing_code'].','.$row['packing_req'];

/*  echo $nsn_no.'@'.$part_no.'@'.$part_name.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue.'@'.$part_no.'@'.$part_name;  */ 
?>