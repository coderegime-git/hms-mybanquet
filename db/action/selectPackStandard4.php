<?php  
session_start();
include("../config.php");
$code4=$_GET['code4'];
$heading4=$_GET['heading4'];

$sql="select * from packing_requirements where packing_code='$code4' AND packing_heading='$heading4'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo $row['packing_code'].','.$row['packing_req'];

/*  echo $nsn_no.'@'.$part_no.'@'.$part_name.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue.'@'.$part_no.'@'.$part_name;  */ 
?>