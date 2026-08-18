<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

/* $sql="insert into partnumber(company_id,nsnnumber,partnumber,partname,added_by,added_on) values ('$_SESSION[companyId]','$_POST[nsnnumber]','$_POST[partnumber]','$_POST[partname]','$added_by','$added_on')"; */

$sql="insert into partnumber(company_id,nsnnumber,partnumber,partname,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".strtoupper($_POST['nsnnumber'])."',";
	$sql.="'".strtoupper($_POST['partnumber'])."',";
	$sql.="'".strtoupper($_POST['partname'])."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/*    echo $sql;
die();   */ 
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/view-partnumber-master.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/view-partnumber-master.php?msg=Error in insertion');
}


?>