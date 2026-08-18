<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_itemcat(cat_code,cat_name,grp_name,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['cat_code']."',";
	$sql.="'".$_POST['cat_name']."',";
	$sql.="'".$_POST['grp_name']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
	  /* echo $sql;
	 die(); */
$UsQuery =mysql_query($sql);

 
if($UsQuery){
	header('location:'.$home_path.'/masters/banquet/item_category_bqt.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/banquet/item_category_bqt.php?msg=Error in insertion');
}
	


?>