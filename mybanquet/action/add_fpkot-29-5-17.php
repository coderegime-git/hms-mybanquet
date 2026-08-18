<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

$sqlS=mysql_query("select * from bq_gennextvalue where field='kotno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$ktNo=$rowS['currvalue']+1;
$ktNum=$prefix.$ktNo;

for($cc=0;$cc<count($_POST['kot_itemcode']);$cc++) {
	if($_POST['kot_itemcode'][$cc]!=''){
$subk=mysql_query("select itmsubmnu_code,itmsub_cat,tax_struc from bq_itemmaster where item_code='".$_POST['kot_itemcode'][$cc]."'");
$robk=mysql_fetch_array($subk);

$sub=mysql_query("select subgrp_code from bq_submenugrp where submenu_code='".$robk['itmsubmnu_code']."'");
$row=mysql_fetch_array($sub);

$subc=mysql_query("select cat_code from bq_subcatitem where subcat_code='".$robk['itmsub_cat']."'");
$rowc=mysql_fetch_array($subc);		

$suc=mysql_query("select grp_name from bq_itemcat where cat_code='".$robk['itmsub_cat']."'");
$roc=mysql_fetch_array($suc);

	$sql="insert into bq_opkothdr(kot_date,kotno,fpno,bkno,item_code,item_name,item_qty,item_rate,item_value,taxstructcode,subcatcode,catcode,grpcode, 	kotstatus,added_by,added_on)";
	$sts='1';
		$sql.=" values(";
		$sql.="'".$curDate."',";
		$sql.="'".$ktNum."',";
		$sql.="'".$_POST['fp_no']."',";
		$sql.="'".$_POST['booking_no']."',";
		$sql.="'".$_POST['kot_itemcode'][$cc]."',";
		$sql.="'".$_POST['kot_itemdesc'][$cc]."',";
		$sql.="'".$_POST['kot_itemqty'][$cc]."',";
		$sql.="'".$_POST['item_rate'][$cc]."',";
		$sql.="'".$_POST['kot_itemval'][$cc]."',";
		$sql.="'".$robk['tax_struc']."',";
		$sql.="'".$robk['itmsubmnu_code']."',";
		$sql.="'".$row['cat_code']."',";
		$sql.="'".$roc['grp_name']."',";
		$sql.="'".$sts."',";
		$sql.="'".$added_by."',";
		$sql.="'".$added_on."')";
	/* echo $sql; */
	$UsQuery =mysql_query($sql);
	}
}
/* die(); */ 
$sqlLk="UPDATE gennext_value SET ";
$sqlLk=$sqlLk."currvalue='".$ktNo."'";
$sqlLk=$sqlLk." where field='kotno'" ;
$UsQLk =mysql_query($sqlLk);


if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/view-fpkot.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpkot.php?msg=Error in insertion');
}


?>