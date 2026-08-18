<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
/*echo "<pre>";
print_r ($_POST);*/

$prefnew = array_values(array_filter($_POST['pref']));
// print_r($prefnew);
	
//echo "</pre>";
//echo $prefnew[1];
//die();

$sqlS=mysql_query("select * from bq_gennextvalue where field='fpno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$fpNo=$rowS['currvalue']+1;
$fpNum=$prefix.$fpNo;

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

$sqlb=mysql_query("select book_date,guaranted,expected from bq_hallbooking where booking_no='".$_POST['booking_no']."' AND hallbook_id='".$_POST['hallbook_id']."'");
$rowb=mysql_fetch_array($sqlb);


for($dp=0;$dp<count($_POST['dept_code']);$dp++){
	if($_POST['dept_code'][$dp]!=''){
		$sts='1';
		$amd='';
		$sql="insert into bq_opfpdeptinst(bkno,hallbook_id,bkdate,fpno,fpdate,deptcode,deptdesc,amendno,bill_status)";
		$sql.=" values(";
		$sql.="'".$_POST['booking_no']."',";
		$sql.="'".$_POST['hallbook_id']."',";
		$sql.="'".$rowb['book_date']."',";
		$sql.="'".$fpNum."',";
		$sql.="'".$curDate."',";
		$sql.="'".$_POST['dept_code'][$dp]."',";
		$sql.="'".mysql_real_escape_string($_POST['dept_instr'][$dp])."',";
		$sql.="'".$amd."',";
		$sql.="'".$sts."')";
		/* echo $sql; */ 
		mysql_query($sql);
	}
}
 /* die(); */ 





	$pictime='';
	$sertime='';
	$evetea='';
	$mortea='';
$sfp=mysql_query("select * from bq_opfpdeptinst where fpno='".$fpNum."'");
if($rfp=mysql_num_rows($sfp)>0){
	$st='1';
}else{
	$st='0';
}
$sts='1';
$vucsts='';
$apsts='1';

	$sql="insert into bq_opfpmenuhdr(fpno,fpdate,bkno,hallbook_id,bkdate,hallchrg,halltax,hallincl,hallchgnoincl,ratechrg,ratetax,rateincl,ratechgnoincl,arrtime,pictime,sertime,depinst,signboard,remarks,evetea,mortea,menu_code,grpax,exppax,bill_status,aprove_sts,vuc_status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$fpNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$_POST['booking_no']."',";
	$sql.="'".$_POST['hallbook_id']."',";
	$sql.="'".$rowb['book_date']."',";
	$sql.="'".$_POST['halltax_chg']."',";
	$sql.="'".$_POST['halltax_det']."',";
	$sql.="'".$_POST['halltaxincl']."',";
	$sql.="'".$_POST['hallchgnoincl']."',";
	$sql.="'".$_POST['ratetax_chg']."',";
	$sql.="'".$_POST['ratetax_det']."',";
	$sql.="'".$_POST['ratetaxincl']."',";
	$sql.="'".$_POST['ratechgnoincl']."',";
	$sql.="'".$_POST['arrtime']."',";
	$sql.="'".$_POST['pictime']."',";
	$sql.="'".$_POST['sertime']."',";
	$sql.="'".$st."',";
	$sql.="'".mysql_real_escape_string($_POST['sign_board'])."',";
	$sql.="'".mysql_real_escape_string($_POST['remarks'])."',";
	$sql.="'".$_POST['evetea']."',";
	$sql.="'".$_POST['mortea']."',";
	$sql.="'".mysql_real_escape_string($_POST['menu'])."',";
	$sql.="'".mysql_real_escape_string($rowb['guaranted'])."',";
	$sql.="'".mysql_real_escape_string($rowb['expected'])."',";
	$sql.="'".$sts."',";
	$sql.="'".$apsts."',";
	$sql.="'".$vucsts."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
	/*  echo $sql; 
	 die(); */
	$UsQuery=mysql_query($sql);

/* echo count($_POST['menusel']);
die(); */


for($cc=0;$cc<count($_POST['menusel']);$cc++){
		$qty='';
		$sts='1';
$sim=mysql_query("select * from bq_itemmaster where item_code='".$_POST['menusel'][$cc]."' and status='1'");
$rIM=mysql_fetch_array($sim);

$sub=mysql_query("select subgrp_code from bq_submenugrp where submenu_code='".$rIM['itmsubmnu_code']."'");
$row=mysql_fetch_array($sub);

$subc=mysql_query("select cat_code from bq_subcatitem where subcat_code='".$_POST['itmsub_cat'][$cc]."'");
$rowc=mysql_fetch_array($subc);		

$suc=mysql_query("select grp_name from bq_itemcat where cat_code='".$_POST['itmsub_cat'][$cc]."'");
$roc=mysql_fetch_array($suc);	


	$sql="insert into bq_opfpmenudetail(fpno,fpdate,itemcode,itemname,qty,preference,rate,taxstructcode,submenugrpcode,menugrpcode, 	menucode,subcatcode,catcode,grpcode,bill_status)";
	$sql.=" values(";
	$sql.="'".$fpNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$rIM['item_code']."',";
	$sql.="'".mysql_real_escape_string($rIM['item_name'])."',";
	$sql.="'".$qty."',";
	$sql.="'".$prefnew[$cc]."',";
	$sql.="'".$rIM['item_rate']."',";
	$sql.="'".$rIM['tax_struc']."',";
	$sql.="'".$rIM['itmsubmnu_code']."',";
	$sql.="'".$row['subgrp_code']."',";
	$sql.="'".$_POST['menu']."',";
	$sql.="'".$rIM['itmsub_cat']."',";
	$sql.="'".$rowc['cat_code']."',";
	$sql.="'".$roc['grp_name']."',";
	$sql.="'".$sts."')";
   // print_r($prefnew);
  
	mysql_query($sql);
	/* } */
}	




for($co=0;$co<count($_POST['open_itemname']);$co++){
 if($_POST['open_itemname'][$co]!=''){
	$opitmCde='55555';
	$qty='';
	$item_rate='';
	$tax_struc='';

$sub=mysql_query("select subgrp_code from bq_submenugrp where submenu_code='".$_POST['open_submenu'][$co]."'");
$row=mysql_fetch_array($sub);

$subc=mysql_query("select cat_code from bq_subcatitem where subcat_code='".$_POST['open_subcate'][$co]."'");
$rowc=mysql_fetch_array($subc);		

$suc=mysql_query("select grp_name,cat_code from bq_itemcat where cat_code='".$_POST['open_subcate'][$co]."'");
$roc=mysql_fetch_array($suc);


	$sql="insert into bq_opfpmenudetail(fpno,fpdate,itemcode,itemname,qty,rate,preference,taxstructcode,submenugrpcode,menugrpcode, 	menucode,subcatcode,catcode,grpcode,bill_status)";
	$sql.=" values(";
	$sql.="'".$fpNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$opitmCde."',";
	$sql.="'".mysql_real_escape_string($_POST['open_itemname'][$co])."',";
	$sql.="'".$qty."',";
	$sql.="'".mysql_real_escape_string($_POST['open_itemrate'][$co])."',";
	$sql.="'".mysql_real_escape_string($_POST['open_itempreference'][$co])."',";
	$sql.="'".$tax_struc."',";
	$sql.="'".mysql_real_escape_string($_POST['open_submenu'][$co])."',";
	$sql.="'".$row['subgrp_code']."',";
	$sql.="'".$_POST['menu']."',";
	$sql.="'".$roc['cat_code']."',";
	$sql.="'".$rowc['cat_code']."',";
	$sql.="'".$roc['grp_name']."',";
	$sql.="'".$sts."')";

	mysql_query($sql);
 }
}			


for($ca=0;$ca<count($_POST['amen_itemcode']);$ca++){
if($_POST['amen_itemcode'][$ca]!='') { 
	
$suI=mysql_query("select tax_struc,itmsubmnu_code,itmsub_cat from bq_itemmaster where item_code='".$_POST['amen_itemcode'][$ca]."'");
$roI=mysql_fetch_array($suI);

$sub=mysql_query("select subgrp_code from bq_submenugrp where submenu_code='".$roI['itmsubmnu_code']."'");
$row=mysql_fetch_array($sub);

$subc=mysql_query("select cat_code from bq_subcatitem where subcat_code='".$roI['itmsub_cat']."'");
$rowc=mysql_fetch_array($subc);		

$suc=mysql_query("select grp_name from bq_itemcat where cat_code='".$roI['itmsub_cat']."'");
$roc=mysql_fetch_array($suc);
$sts='1';
	$sql="insert into bq_opfpmenudetail(fpno,fpdate,itemcode,itemname,qty,rate,taxstructcode,submenugrpcode,menugrpcode, 	menucode,subcatcode,catcode,grpcode,bill_status)";
	$sql.=" values(";
	$sql.="'".$fpNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$_POST['amen_itemcode'][$ca]."',";
	$sql.="'".mysql_real_escape_string($_POST['amen_itemname'][$ca])."',";
	$sql.="'".$_POST['amen_itemqty'][$ca]."',";
	$sql.="'".$_POST['amen_itemrate'][$ca]."',";
	$sql.="'".$roI['tax_struc']."',";
	$sql.="'".$roI['itmsubmnu_code']."',";
	$sql.="'".$row['subgrp_code']."',";
	$sql.="'".$_POST['menu']."',";
	$sql.="'".$roI['itmsub_cat']."',";
	$sql.="'".$rowc['cat_code']."',";
	$sql.="'".$roc['grp_name']."',";
	$sql.="'".$sts."')";
	/* echo $sql; */
	mysql_query($sql);
  }
}
/* die(); */

$hid_regsp=$_POST['hid_menu'];
$hidRrR=trim($hid_regsp, ',');
$rmNSpt=explode(',',$hidRrR);
$cd=0;
for($ia=0;$ia<count($rmNSpt);$ia++) {
	
$sqlLk="UPDATE bq_tempfp SET ";
$sqlLk=$sqlLk."status='0'";
$sqlLk=$sqlLk." where item_code!='".$rmNSpt[$ia]."'" ;
$UsQLk =mysql_query($sqlLk);
	
}

/* $sql=$sql." where petcsh_id=".$_GET['petid']; */

$sqlD="delete from bq_tempfp";
$sqlD=$sqlD." where bkNo=".$_POST['booking_no'];
mysql_query($sqlD);


$sqlLk="UPDATE bq_gennextvalue SET ";
$sqlLk=$sqlLk."currvalue='".$fpNo."'";
$sqlLk=$sqlLk." where field='fpno'" ;
$UsQLk =mysql_query($sqlLk);

$sqlB="UPDATE bq_hallbooking SET ";
$sqlB=$sqlB."fp_status='1',";
$sqlB=$sqlB."fpno='".$fpNum."'";
$sqlB=$sqlB." where booking_no='".$_POST['booking_no']."'";
mysql_query($sqlB);

/* fromdate=28/05/2017&todate=28/05/2017&val= */

if($UsQuery){
$link = "<script>window.open('$home_path/transaction/view/print-fp-creation.php?fpNum=$fpNum', '_blank','width=1000,height=700')</script>";
echo $link;
$link1 = "<script>window.open('$home_path/transaction/frontdesk/view-fb-creation-chk.php?val=', '_self','')</script>";
echo $link1;
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpvoucher.php?msg=Error in insertion');
}
			
/* if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/fp_creation.php?msg='.$fpNum.' created successfully!.');
}else {
header('location:'.$home_path.'/transaction/frontdesk/fp_creation.php?msg=Error in insertion');
} */


?>