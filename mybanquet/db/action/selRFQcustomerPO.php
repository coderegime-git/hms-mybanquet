<?php  
session_start();
include("../config.php");
$rfqNO=$_GET['rfqNO'];

$sql="select * from quotation where rfq_no='$rfqNO'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

$qty=$row['qty'];
$unit_issue=$row['unit_issue'];
$quote_rate=$row['quote_rate'];
$days_possible=$row['days_possible']; 
$part_no=$row['part_no'];
$part_name=$row['part_name'];
$quote_amt=$row['quote_amt'];

$date = date('d-m-Y');
$date = strtotime($date);
$date = strtotime('+'.$days_possible.'days', $date);
/* echo date('M d, Y', $date); */
$dayPosble=date('d-m-Y', $date);

echo $qty.'@'.$unit_issue.'@'.$quote_rate.'@'.$dayPosble.'@'.$part_no.'@'.$part_name.'@'.$quote_amt; 
?>