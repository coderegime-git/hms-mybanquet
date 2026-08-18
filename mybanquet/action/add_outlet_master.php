<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into pos_outlet(outlet_code,outlet_name,round_off,rnd_value,rnd_amount,kot_gen,kot_pre,bill_pre,status,outlet_type,classif,settle_port,kot_progid,bill_progid,kot_prtport,bill_prtport,noofcopies,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".strtoupper($_POST['outlet_code'])."',";
	$sql.="'".$_POST['outlet_name']."',";
	$sql.="'".$_POST['round_off']."',";
	$sql.="'".$_POST['rnd_value']."',";
	$sql.="'".$_POST['rnd_amount']."',";
	$sql.="'".$_POST['kot_gen']."',";
	$sql.="'".$_POST['kot_pre']."',";
	$sql.="'".$_POST['bill_pre']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$_POST['outlet_type']."',";
	$sql.="'".$_POST['classif']."',";
	$sql.="'".$_POST['settle_port']."',";
	$sql.="'".$_POST['kot_progid']."',";
	$sql.="'".$_POST['bill_progid']."',";
	$sql.="'".$_POST['kot_prtport']."',";
	$sql.="'".$_POST['bill_prtport']."',";
	$sql.="'".$_POST['noofcopies']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

/* echo $sql;
die(); */

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/frontoffice/outlet-master.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/frontoffice/outlet-master.php?msg=Error in insertion');
}


?>