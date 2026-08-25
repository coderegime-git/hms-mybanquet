<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$menu_group=$_POST['menu_group'];

for($cc=0;$cc<count($menu_group);$cc++){
if($_POST['menu_group'][$cc]!='' && $_POST['submenu'][$cc]!='' && $_POST['allow_qty'][$cc] ){
	$disp=$_POST['disp_ord'][$cc];
$sql="insert into bq_menumaster(menu_code,menu_name,menu_group,disp_ord,submenu,allow_qty,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['menu_code']."',";
	$sql.="'".$_POST['menu_name']."',";
	$sql.="'".$_POST['menu_group'][$cc]."',";
	$sql.="'".$disp."',";
	$sql.="'".$_POST['submenu'][$cc]."',";
	$sql.="'".$_POST['allow_qty'][$cc]."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
  /* echo $sql; 
	die(); */
$UsQuery =mysql_query($sql);
}
}
 /*  die(); */ 
if($UsQuery){
	header('location:'.$home_path.'/masters/banquet/view-menu-master.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/banquet/view-menu-master.php?msg=Error in insertion');
}
	


?>