<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_venue(venue_code,venue_desc,location,length,breadth,height,area,status,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$_POST['venue_code']."',";
	 $sql.="'".$_POST['venue_desc']."',";
	 $sql.="'".$_POST['location']."',";
	 $sql.="'".$_POST['length']."',";
	 $sql.="'".$_POST['breadth']."',";
	 $sql.="'".$_POST['height']."',";
	 $sql.="'".$_POST['area']."',";
	 $sql.="'".$_POST['status']."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
 /* echo $sql;
die(); */ 
$UsQuery =mysql_query($sql);

if($UsQuery){
header('location:'.$home_path.'/masters/banquet/venue_master_bqt.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/banquet/venue_master_bqt.php?msg=Error in insertion');
}


?>