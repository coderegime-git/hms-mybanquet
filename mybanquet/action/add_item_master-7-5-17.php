<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$itemCd=$_POST['itmnu_code'];
for($cc=0;$cc<count($itemCd);$cc++){
	if($_POST['mnu_sts'][$cc]=='yes'){
		$sql="insert into bq_itemmaster(item_code,item_name,itmsub_cat,itmsubmnu_code,item_rate,tax_struc,allow_disc,allow_qty,allwrate_chg,itmnu_code,itmnu_name,mnu_sts,status,added_by,added_on)";
		$sql.=" values(";
		$sql.="'".$_POST['item_code']."',";
		$sql.="'".$_POST['item_name']."',";
		$sql.="'".$_POST['itmsub_cat']."',";
		$sql.="'".$_POST['itmsubmnu_code']."',";
		$sql.="'".$_POST['item_rate']."',";
		$sql.="'".$_POST['tax_struc']."',";
		$sql.="'".$_POST['allow_disc']."',";
		$sql.="'".$_POST['allow_qty']."',";
		$sql.="'".$_POST['allwrate_chg']."',";
		$sql.="'".$_POST['itmnu_code'][$cc]."',";
		$sql.="'".$_POST['itmnu_name'][$cc]."',";
		$sql.="'".$_POST['mnu_sts'][$cc]."',";
		$sql.="'".$_POST['status']."',";
		$sql.="'".$added_by."',";
		$sql.="'".$added_on."')";
		/* echo $sql;
		die(); */ 	 
		$UsQuery =mysql_query($sql);
	}
}

if($UsQuery){
		header('location:'.$home_path.'/masters/banquet/item_master_bqt.php?msg=Data saved Successfully!');
	}
	else{
		header('location:'.$home_path.'/masters/banquet/item_master_bqt.php?msg=Error in insertion');
	}
	


?>