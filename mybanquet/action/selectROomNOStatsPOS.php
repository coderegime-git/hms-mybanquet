<?php  


 $connection_1 = mysql_connect("localhost", "root", "") or die(mysql_error());
 mysql_select_db("mypos", $connection_1) or die(mysql_error());

 $connection_2 = mysql_connect("localhost", "root", "") or die(mysql_error());
 mysql_select_db("hms", $connection_2) or die(mysql_error()); 



$checkDet=mysql_query("select * from guest_trans where room_no='".$_GET['rmNo']."' AND bill_status='4'");
if (mysql_num_rows($checkDet) > 0) {
	echo 1 .','.$_GET['blAmt'];
}else{
 
$sqR=mysql_query("select * from guest_register where room_no='".$_GET['rmNo']."' AND bill_status='1'");
$roR=mysql_fetch_array($sqR);
$guest_name=$roR['guest_name'];	
echo $_GET['rmNo'].', '.$guest_name;			
}			
?>