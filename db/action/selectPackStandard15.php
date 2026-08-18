<?php  
session_start();
include("../config.php");
$code15=$_GET['code15'];
$heading15=$_GET['heading15'];

$sql="select * from packing_requirements where packing_code='$code15' AND packing_heading='$heading15' AND packreq_id='15'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo $row['packing_code'].','.$row['packing_req'];

/*  echo $nsn_no.'@'.$part_no.'@'.$part_name.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue.'@'.$part_no.'@'.$part_name;  */ 
?>