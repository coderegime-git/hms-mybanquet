<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sql="insert into pos_menucat(menu_type,menu_catcd,menu_catnam,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['menu_type']."',";
	$sql.="'".($_POST['menu_catcd'])."',";
	$sql.="'".($_POST['menu_catnam'])."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

/* echo $sql;
die(); */   

$UsQuery =mysql_query($sql);
if($UsQuery){
header('location:'.$home_path.'/masters/frontoffice/menu-category.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/frontoffice/menu-category.php?msg=Error in insertion');
}


?>