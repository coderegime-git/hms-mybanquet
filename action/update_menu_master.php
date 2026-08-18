<?php
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

for($cc=0;$cc<count($_POST['menu_group']);$cc++){
if($_POST['menu_group'][$cc]!=""){
	$sqC=mysql_query("select * from bq_menumaster where menmas_id='".$_POST['menmas_id'][$cc]."'");
	if(mysql_num_rows($sqC)>0){
		$sql="UPDATE bq_menumaster SET ";
		$sql=$sql."menu_code='".$_POST['menu_code']."',";
		$sql=$sql."menu_name='".$_POST['menu_name']."',";
		$sql=$sql."menu_group='".$_POST['menu_group'][$cc]."',";
		$sql=$sql."submenu='".$_POST['submenu'][$cc]."',";
		$sql=$sql."allow_qty='".$_POST['allow_qty'][$cc]."',";
		$sql=$sql."status='".$_POST['status']."',";
		$sql=$sql."added_by='".$added_by."',";
		$sql=$sql."added_on='".$added_on."'";
		$sql=$sql." where menmas_id='".$_POST['menmas_id'][$cc]."'";
	    /*echo $sql; 
	    die(); */ 
		$UsQuery =mysql_query($sql);
	}else{
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
		/* echo $sql; */
		$UsQuery =mysql_query($sql);
		
	}
 }
}
/* die(); */	
if($UsQuery){
	header('location:'.$home_path.'/masters/banquet/view-menu-master.php?msg=Data saved Successfully!');
}else{
	header('location:'.$home_path.'/masters/banquet/view-menu-master.php?msg=Error in insertion');
}		
?>