<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_seating(seat_code,seat_desc,status,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$_POST['seat_code']."',";
	 $sql.="'".$_POST['seat_desc']."',";
	 $sql.="'".$_POST['status']."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
/* echo $sql;
die(); */
$UsQuery =mysql_query($sql);

if($UsQuery){
header('location:'.$home_path.'/masters/banquet/seating_master_bqt.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/banquet/seating_master_bqt.php?msg=Error in insertion');
}


?>