<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_function(func_code,func_desc,status,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$_POST['func_code']."',";
	 $sql.="'".$_POST['func_desc']."',";
	 $sql.="'".$_POST['status']."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
echo $sql;
die();
$UsQuery =mysql_query($sql);

if($UsQuery){
header('location:'.$home_path.'/masters/banquet/view_func_mast.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/banquet/view_func_mast.php?msg=Error in insertion');
}


?>