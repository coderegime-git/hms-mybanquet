<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into pos_ncdepart(ncdept_code,ncdept_name,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".strtoupper($_POST['ncdept_code'])."',";
	$sql.="'".$_POST['ncdept_name']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

/*echo $sql;
die();*/ 

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/frontoffice/nc-department.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/frontoffice/nc-department.php?msg=Error in insertion');
}


?>