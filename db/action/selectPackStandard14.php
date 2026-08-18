<?php  
session_start();
include("../config.php");
$code14=$_GET['code14'];
$heading14=$_GET['heading14'];

$sql="select * from packing_requirements where packing_code='$code14' AND packing_heading='$heading14' AND packreq_id='14'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo $row['packing_code'].','.$row['packing_req'];

/*  echo $nsn_no.'@'.$part_no.'@'.$part_name.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue.'@'.$part_no.'@'.$part_name;  */ 
?>