<?php  
session_start();
include("../config.php");
$rfqNO=$_GET['rfqNO'];

$sql="select * from quotation where rfq_no='$rfqNO'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

echo $row['qty'].','.$row['unit_issue'].','.$row['quote_rate'].','.$row['quote_amt'];
/*  echo $qty.'@'.$unit_issue.'@'.$quote_rate.'@'.$dayPosble.'@'.$part_no.'@'.$part_name.'@'.$quote_amt.'@'.$custreq_deldate.'@'.$preQty;  
 */?>