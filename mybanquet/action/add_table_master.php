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

$sql="insert into pos_tablemaster(table_no,max_covers,location,outlets,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['table_no']."',";
	$sql.="'".strtolower($_POST['max_covers'])."',";
	$sql.="'".strtolower($_POST['location'])."',";
	$sql.="'".$menuStr."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

/* echo $sql;
die(); */ 

$UsQuery =mysql_query($sql);
if($UsQuery){
header('location:'.$home_path.'/masters/frontoffice/table-master.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/frontoffice/table-master.php?msg=Error in insertion');
}


?>