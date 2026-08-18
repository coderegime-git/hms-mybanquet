<?php  
session_start();
include("../config.php");
$code13=$_GET['code13'];
$heading13=$_GET['heading13'];

$sql="select * from packing_requirements where packing_code='$code13' AND packing_heading='$heading13' AND packreq_id='13'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo $row['packing_code'].','.$row['packing_req'];

/*  echo $nsn_no.'@'.$part_no.'@'.$part_name.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue.'@'.$part_no.'@'.$part_name;  */ 
?>