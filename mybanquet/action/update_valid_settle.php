<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$menuStr = '';
$i = 0;
if(isset($_POST['option']) && is_array($_POST['option'])){
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
}

$sql="UPDATE pos_validsettle SET ";
$sql.="outlet_code='".$_POST['outlet_code']."',";
$sql.="outlet_name='".strtolower($_POST['outlet_name'])."',";
$sql.="outlets='".$menuStr."',";
$sql.="added_by='".$added_by."',";
$sql.="added_on='".$added_on."'";
$sql.=" WHERE valid_id='".$_POST['valid_id']."'";

$UsQuery = mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/banquet/view_valid_settlement_bqt.php?msg=Data modified successfully!');
}else {
	header('location:'.$home_path.'/masters/banquet/view_valid_settlement_bqt.php?msg=Error in updation');
}
?>
