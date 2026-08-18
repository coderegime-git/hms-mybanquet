<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

/* $sql="insert into partnumber(company_id,nsnnumber,partnumber,partname,added_by,added_on) values ('$_SESSION[companyId]','$_POST[nsnnumber]','$_POST[partnumber]','$_POST[partname]','$added_by','$added_on')"; */

$sql="insert into packing_requirements(company_id,packing_heading,packing_code,packing_req,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".strtoupper($_POST['packing_heading'])."',";
	$sql.="'".strtoupper($_POST['packing_code'])."',";
	$sql.="'".$_POST['packing_req']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/*    echo $sql;
die();   */ 
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/packing_standard.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/packing_standard.php?msg=Error in insertion');
}


?>