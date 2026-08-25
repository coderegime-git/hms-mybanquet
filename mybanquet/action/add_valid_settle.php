<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

foreach($_POST['option'] as $menuId)
{
	$i++;
	if($i<sizeof($_POST['option']))
	{
		$menuStr .=$menuId.',';
	}
	else
	{
		$menuStr .=$menuId;
	}
}

$sql="insert into pos_validsettle(outlet_code,outlet_name,outlets,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['outlet_code']."',";
	$sql.="'".strtolower($_POST['outlet_name'])."',";
	$sql.="'".$menuStr."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

/*  echo $sql;
die(); */ 

$UsQuery =mysql_query($sql);
if($UsQuery){
header('location:'.$home_path.'/masters/banquet/view_valid_settlement_bqt.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/banquet/view_valid_settlement_bqt.php?msg=Error in insertion');
}


?>