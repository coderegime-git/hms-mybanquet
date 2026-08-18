<?php  
session_start();
include("../config.php");
$code12=$_GET['code12'];
$heading12=$_GET['heading12'];

$sql="select * from packing_requirements where packing_code='$code12' AND packing_heading='$heading12'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo $row['packing_code'].','.$row['packing_req'];

/*  echo $nsn_no.'@'.$part_no.'@'.$part_name.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue.'@'.$part_no.'@'.$part_name;  */ 
?>