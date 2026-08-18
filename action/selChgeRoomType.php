<?php  

include("../config.php");

$room_no=$_GET['room_no'];

$sql=mysql_query("select room_type from room_master where room_number='$room_no' AND occupy_status!='3'");
if(mysql_num_rows($sql)>0){
	$row=mysql_fetch_array($sql);
	$room_type=$row['room_type'];
	echo $room_type;
}else{
	echo 1;
}



?>