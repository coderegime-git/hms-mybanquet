<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into pos_openoutlet(open_outlet,outlet_sess,outlet_date,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['open_outlet']."',";
	$sql.="'".$_POST['outlet_sess']."',";
	$sql.="'".$_POST['outlet_date']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/* echo $sql;
die(); */
$UsQuery =mysql_query($sql);
if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/open-outlet.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/transaction/frontdesk/open-outlet.php?msg=Error in insertion');
}


?>