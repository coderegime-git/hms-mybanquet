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

/* if($_POST['kot_itemcode'][$cc]=='55555'){
	$tax_struc=$_POST['strCode'][$cc];
}else{
	$tax_struc=$robk['tax_struc'];
}

if($_POST['kot_itemcode'][$cc]=='55555'){
	$grp_name=$_POST['menu_type'][$cc];
}else{
	$grp_name=$roc['grp_name'];
} */

/* $tax_struc=$_POST['strCode'][$cc];
$grp_name=$_POST['menu_type'][$cc]; */

if($_POST['strCode'][$cc]!=""){
	$tax_struc=$_POST['strCode'][$cc];
}else{
	$tax_struc='FOODTAX';
}

if($_POST['strCode'][$cc]!=""){
	$grp_name=$_POST['menu_type'][$cc];
}else{
	$grp_name='food';
}


	$sql="insert into bq_opkothdr(kot_date,kotno,fpno,bkno,sac,item_code,item_name,item_qty,item_rate,item_value,taxstructcode,subcatcode,catcode,grpcode, 	kotstatus,added_by,added_on)";
	$sts='1';
		$sql.=" values(";
		$sql.="'".$curDate."',";
		$sql.="'".$ktNum."',";
		$sql.="'".$_POST['fp_no']."',";
		$sql.="'".$_POST['booking_no']."',";
		$sql.="'".$_POST['kot_sac'][$cc]."',";
		$sql.="'".$_POST['kot_itemcode'][$cc]."',";
		$sql.="'".$_POST['kot_itemdesc'][$cc]."',";
		$sql.="'".$_POST['kot_itemqty'][$cc]."',";
		$sql.="'".$_POST['item_rate'][$cc]."',";
		$sql.="'".$_POST['kot_itemval'][$cc]."',";
		$sql.="'".$tax_struc."',";
		$sql.="'".$robk['itmsubmnu_code']."',";
		$sql.="'".$rowc['cat_code']."',";
		$sql.="'".$grp_name."',";
		$sql.="'".$sts."',";
		$sql.="'".$added_by."',";
		$sql.="'".$added_on."')";
	//echo $sql; 
	//die();
	$UsQuery =mysql_query($sql);
	
	
 /*$sqF=mysql_query("select * from bq_taxstruct where str_code='".$_POST['tax_code'][$ce]."' AND status='1' AND factor_value>0");
 while($roF=mysql_fetch_array($sqF)){
		
		$totItmVl=floatval($_POST['item_qty'][$ce])*floatval($_POST['item_rate'][$ce]);
		
		$txVal=$totItmVl*$roF['factor_value']/100;
	
		/* $txVal=$_POST['item_value'][$ce]*$roF['factor_value']/100; 
	
		$rem="";
		$blN="";
		$sts="1";
		
		$sql="insert into bq_opvchrtaxdtl(vouchrno,vchrdate,item_code,item_name,taxcode,taxableamt,taxamt,remarks,billno,bill_status)";
		$sql.=" values(";
		$sql.="'".$vucNum."',";
		$sql.="'".$curDate."',";
		$sql.="'".$_POST['item_code'][$ce]."',";
		$sql.="'".$_POST['item_name'][$ce]."',";
		$sql.="'".$roF['tax_code']."',";
		$sql.="'".sprintf("%01.2f",$totItmVl)."',";
		$sql.="'".sprintf("%01.2f",$txVal)."',";
		$sql.="'".$_POST['remarks']."',";
		$sql.="'".$blN."',";
		$sql.="'".$sts."')";
		  /* echo $sql; */ 
		//mysql_query($sql); 
	//}*/ 

	
	
	 } 
}
 /* die(); */
$sqlLk="UPDATE bq_gennextvalue SET ";
$sqlLk=$sqlLk."currvalue='".$ktNo."'";
$sqlLk=$sqlLk." where field='kotno'" ;
$UsQLk =mysql_query($sqlLk);


if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/view-fpkot.php?fromdate='.$curDate.'&todate='.$curDate);
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpkot.php?msg=Error in insertion');
}


?>