<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sql="insert into pos_submenucat(submn_cat,submn_catcd,submn_catnm,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['submn_cat']."',";
	$sql.="'".($_POST['submn_catcd'])."',";
	$sql.="'".($_POST['submn_catnm'])."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

/*  echo $sql;
die(); */    

$UsQuery =mysql_query($sql);
if($UsQuery){
header('location:'.$home_path.'/masters/frontoffice/submenu-category.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/frontoffice/submenu-category.php?msg=Error in insertion');
}


?>