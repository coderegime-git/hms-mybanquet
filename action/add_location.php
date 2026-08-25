<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_location(loc_code,loc_desc,status,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$_POST['loc_code']."',";
	 $sql.="'".$_POST['loc_desc']."',";
	 $sql.="'".$_POST['status']."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
 /* echo $sql;
die(); */
$UsQuery =mysql_query($sql);

if($UsQuery){
header('location:'.$home_path.'/masters/banquet/view_location.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/banquet/view_location.php?msg=Error in insertion');
}


?>