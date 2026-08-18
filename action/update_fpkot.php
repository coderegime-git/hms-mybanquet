<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

/* echo "select * from bq_gennextvalue where field='kotno'";
die(); */
/* $sqlS=mysql_query("select * from bq_gennextvalue where field='kotno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$ktNo=$rowS['currvalue']+1;
$ktNum=$prefix.$ktNo; */
$ktNum=$_POST['kotno'];


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

if($_POST['kot_itemcode'][$cc]=='55555' && $_POST['strCode'][$cc]!=''){
	$tax_struc=$_POST['strCode'][$cc];
}else{
	$tax_struc='FOODTAX';
}

if($_POST['kot_itemcode'][$cc]=='55555'){
	$grp_name=$_POST['menu_type'][$cc];
}else{
	$grp_name=$roc['grp_name'];
}

/* echo "select * from bq_opkothdr where fpno='".$_POST['fp_no']."' AND opkothdr_id='".$_POST['opkothdr_id'][$cc]."' AND kotstatus='1'";
die(); */
$sKot=mysql_query("select * from bq_opkothdr where fpno='".$_POST['fp_no']."' AND opkothdr_id='".$_POST['opkothdr_id'][$cc]."' AND kotstatus='1'");
if(mysql_num_rows($sKot)==0){

$rkot=mysql_fetch_array($sKot);

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
		$sql.="'".$row['cat_code']."',";
		$sql.="'".$grp_name."',";
		$sql.="'".$sts."',";
		$sql.="'".$added_by."',";
		$sql.="'".$added_on."')";
	 echo $sql;
	$UsQuery =mysql_query($sql);
		
}else{
	$sts='1';
$sqll="UPDATE bq_opkothdr SET ";
$sqll=$sqll."kot_date='".$curDate."',";
$sqll=$sqll."kotno='".$ktNum."',";
$sqll=$sqll."fpno='".$_POST['fp_no']."',";
$sqll=$sqll."bkno='".$_POST['booking_no']."',";
$sqll=$sqll."sac='".$_POST['kot_sac'][$cc]."',";
$sqll=$sqll."item_code='".$_POST['kot_itemcode'][$cc]."',";
$sqll=$sqll."item_name='".$_POST['kot_itemdesc'][$cc]."',";
$sqll=$sqll."item_qty='".$_POST['kot_itemqty'][$cc]."',";
$sqll=$sqll."item_rate='".$_POST['item_rate'][$cc]."',";
$sqll=$sqll."item_value='".$_POST['kot_itemval'][$cc]."',";
$sqll=$sqll."taxstructcode='".$tax_struc."',";
$sqll=$sqll."subcatcode='".$robk['itmsubmnu_code']."',";
$sqll=$sqll."catcode='".$row['cat_code']."',";
$sqll=$sqll."grpcode='".$grp_name."',";
$sqll=$sqll."kotstatus='".$sts."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";

$sqll=$sqll." where fpno='".$_POST['fp_no']."' AND opkothdr_id='".$_POST['opkothdr_id'][$cc]."'";
 //echo $sqll; 
$UsQuery =mysql_query($sqll);
	
}
 //die(); 








	 } 
}




if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/view-fpkot.php?fromdate='.$curDate.'&todate='.$curDate);
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpkot.php?msg=Error in insertion');
}


?>