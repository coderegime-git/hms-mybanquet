<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqlS=mysql_query("select * from bq_gennextvalue where field='amend'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$fpNo=$rowS['currvalue']+1;
$fpAme=$prefix.$fpNo;

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

$sqlb=mysql_query("select book_date from bq_hallbooking where booking_no='".$_POST['booking_no']."' and fpno='".$_POST['fp_no']."' AND hallbook_id='".$_POST['hallbook_id']."'");
$rowb=mysql_fetch_array($sqlb);

if(isset($_POST['amd_halltxincl'])){
	$amd_halltxincl=$_POST['amd_halltxincl'];
	
}else{
	$amd_halltxincl="";
}
if(isset($_POST['amend_by'])){
	$amend_by=$_POST['amend_by'];
	
}else{
	$amend_by="";
}
if(isset($_POST['author_by'])){
	$author_by=$_POST['author_by'];
	
}else{
	$author_by="";
}



if(isset($_POST['amd_halldet']) && $_POST['amd_halldet']!=""){
	$amd_halldet=$_POST['amd_halldet'];
}else{
	$amd_halldet="GST";
}

if(isset($_POST['amd_ratetax_det']) && $_POST['amd_ratetax_det']!=""){
	$amd_ratetax_det=$_POST['amd_ratetax_det'];
}else{
	$amd_ratetax_det="GST";
}


		$sts='1';
		$amd='';
		$sql="insert into bq_amendments(audit_date,fp_no,amendno,booking_no,guest_name,amd_add1,amd_add2,amd_city,amd_pin,	amd_phone,amd_gst,venue,session,fromsess,tosess,func_type,seat_type,func_date,grntpax,exppax,halltax_det,halltax_chg,hallchgnoincl,halltaxincl,ratetax_det,ratetax_chg,ratechgnoincl,ratetaxincl,amd_ven,amd_sess,amd_frm,amd_to,amd_func,amd_seat,amd_fundt,amd_grpx,amd_expx,amd_halldet,amd_hallchg,amd_hallincl,amd_halltxincl,amd_ratetax_det,amd_ratetax_chg,amd_ratechgnoincl,amd_ratetaxincl,amd_arrtime,amd_pictime,amd_sertime,amd_evetea,amd_mortea,amend_by,author_by,status)";
		$sql.=" values(";
		$sql.="'".$curDate."',";
		$sql.="'".$_POST['fp_no']."',";
		$sql.="'".$fpAme."',";
		$sql.="'".$_POST['booking_no']."',";
		$sql.="'".$_POST['guest_name']."',";
		$sql.="'".$_POST['amd_add1']."',";
		$sql.="'".$_POST['amd_add2']."',";
		$sql.="'".$_POST['amd_city']."',";
		$sql.="'".$_POST['amd_pin']."',";
		$sql.="'".$_POST['amd_phone']."',";
		$sql.="'".$_POST['amd_gst']."',";
		$sql.="'".$_POST['venue']."',";
		$sql.="'".$_POST['session']."',";
		$sql.="'".$_POST['fromsess']."',";
		$sql.="'".$_POST['tosess']."',";
		$sql.="'".$_POST['func_type']."',";
		$sql.="'".$_POST['seat_type']."',";
		$sql.="'".$_POST['func_date']."',";
		$sql.="'".$_POST['grntpax']."',";
		$sql.="'".$_POST['exppax']."',";
		$sql.="'".$_POST['halltax_det']."',";
		$sql.="'".$_POST['halltax_chg']."',";
		$sql.="'".$_POST['hallchgnoincl']."',";
		$sql.="'',";
		$sql.="'".$_POST['ratetax_det']."',";
		$sql.="'".$_POST['ratetax_chg']."',";
		$sql.="'".$_POST['ratechgnoincl']."',";
		$sql.="'',";
		$sql.="'".$_POST['amd_ven']."',";
		$sql.="'".$_POST['amd_sess']."',";
		$sql.="'".$_POST['amd_frm']."',";
		$sql.="'".$_POST['amd_to']."',";
		$sql.="'".$_POST['amd_func']."',";
		$sql.="'".$_POST['amd_seat']."',";
		$sql.="'".$_POST['amd_fundt']."',";
		$sql.="'".$_POST['amd_grpx']."',";
		$sql.="'".$_POST['amd_expx']."',";
		$sql.="'".$amd_halldet."',";
		$sql.="'".$_POST['amd_hallchg']."',";
		$sql.="'".$_POST['amd_hallincl']."',";
		$sql.="'".$amd_halltxincl."',";
		$sql.="'".$amd_ratetax_det."',";
		$sql.="'".$_POST['amd_ratetax_chg']."',";
		$sql.="'".$_POST['amd_ratechgnoincl']."',";
		$sql.="'".$_POST['amd_ratetaxincl']."',";
		$sql.="'".$_POST['amd_arrtime']."',";
		$sql.="'".$_POST['amd_pictime']."',";
		$sql.="'".$_POST['amd_sertime']."',";
		$sql.="'".$_POST['amd_evetea']."',";
		$sql.="'".$_POST['amd_mortea']."',";
		$sql.="'".$amend_by."',";
		$sql.="'".$author_by."',";
		$sql.="'".$sts."')";
		 /* echo $sql;
		die(); */ 
		mysql_query($sql);
 
$sqlLk="UPDATE bq_gennextvalue SET ";
$sqlLk=$sqlLk."currvalue='".$fpNo."'";
$sqlLk=$sqlLk." where field='amend'" ;
$UsQLk =mysql_query($sqlLk);

 $sqlB="UPDATE bq_hallbooking SET ";
$sqlB=$sqlB."fp_status='1'";
$sqlB=$sqlB." where booking_no='".$_POST['booking_no']."'";
mysql_query($sqlB);

$sqlB="UPDATE bq_opfpmenuhdr SET ";
$sqlB=$sqlB."bill_status='3'";
$sqlB=$sqlB." where fpno='".$_POST['fp_no']."'";
mysql_query($sqlB);

$sqlB="UPDATE bq_opfpmenudetail SET ";
$sqlB=$sqlB."bill_status='3'";
$sqlB=$sqlB." where fpno='".$_POST['fp_no']."'";
mysql_query($sqlB); 



$sqlS=mysql_query("select * from bq_gennextvalue where field='fpno'");
$rowS=mysql_fetch_array($sqlS);
$prefix=$rowS['prefix'];
$fpNo=$rowS['currvalue']+1;
$fpNum=$prefix.$fpNo;

$sqlb=mysql_query("select book_date from bq_hallbooking where booking_no='".$_POST['booking_no']."' AND hallbook_id='".$_POST['hallbook_id']."'");
$rowb=mysql_fetch_array($sqlb);


for($dp=0;$dp<count($_POST['dept_code']);$dp++){  
	if($_POST['dept_code'][$dp]!=''){
		$sts='1';
		
		$sql="insert into bq_opfpdeptinst(bkno,hallbook_id,bkdate,fpno,fpdate,deptcode,deptdesc,amendno,bill_status)";
		$sql.=" values(";
		$sql.="'".$_POST['booking_no']."',";
		$sql.="'".$_POST['hallbook_id']."',";
		$sql.="'".$rowb['book_date']."',";
		$sql.="'".$fpNum."',";
		$sql.="'".$curDate."',";
		$sql.="'".$_POST['dept_code'][$dp]."',";
		$sql.="'".mysql_real_escape_string($_POST['dept_instr'][$dp])."',";
		$sql.="'".$pAme."',";
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



if(isset($_POST['amd_halldet']) && $_POST['amd_halldet']!=""){
	$amd_halldet=$_POST['amd_halldet'];
	
}else{
	$amd_halldet="GST";
}

if(isset($_POST['amd_ratetax_det']) && $_POST['amd_ratetax_det']!=""){
	$amd_ratetax_det=$_POST['amd_ratetax_det'];
	
}else{
	$amd_ratetax_det="GST";
}


$sts='1';
$vucsts='';

	$sql="insert into bq_opfpmenuhdr(fpno,fpdate,bkno,hallbook_id,venue,session,bkdate,hallchrg,halltax,hallincl,hallchgnoincl,ratechrg,ratetax,rateincl,ratechgnoincl,arrtime,pictime,sertime,depinst,signboard,remarks,evetea,mortea,menu_code,grpax,exppax,bill_status,vuc_status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$fpNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$_POST['booking_no']."',";
	$sql.="'".$_POST['hallbook_id']."',";
	$sql.="'".$_POST['amd_ven']."',";
	$sql.="'".$_POST['amd_sess']."',";
	$sql.="'".$rowb['book_date']."',";
	$sql.="'".$_POST['amd_hallchg']."',";
	$sql.="'".$amd_halldet."',";
	$sql.="'".$amd_halltxincl."',";
	$sql.="'".$_POST['amd_hallincl']."',";
	$sql.="'".$_POST['amd_ratetax_chg']."',";
	$sql.="'".$amd_ratetax_det."',";
	$sql.="'".$_POST['amd_ratetaxincl']."',";
	$sql.="'".$_POST['amd_ratechgnoincl']."',";
	$sql.="'".$_POST['amd_arrtime']."',";
	$sql.="'".$_POST['amd_pictime']."',";
	$sql.="'".$_POST['amd_sertime']."',";
	$sql.="'".$st."',";
	$sql.="'".mysql_real_escape_string($_POST['sign_board'])."',";
	$sql.="'".mysql_real_escape_string($_POST['remarks'])."',";
	$sql.="'".$_POST['amd_evetea']."',";
	$sql.="'".$_POST['amd_mortea']."',";
	$sql.="'".mysql_real_escape_string($_POST['menu_code'])."',";
	$sql.="'".mysql_real_escape_string($_POST['amd_grpx'])."',";
	$sql.="'".mysql_real_escape_string($_POST['amd_expx'])."',";
	$sql.="'".$sts."',";
	$sql.="'".$vucsts."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
 /* echo $sql; 
	 die(); */
	$UsQuery=mysql_query($sql);

/* echo count($_POST['menusel']);
die(); */

/* for($cc=0;$cc<count($_POST['menusel']);$cc++){
		$qty='';
		$sts='1';
$sub=mysql_query("select subgrp_code from bq_submenugrp where submenu_code='".$_POST['itmsubmnu_code'][$cc]."'");
$row=mysql_fetch_array($sub);

$subc=mysql_query("select cat_code from bq_subcatitem where subcat_code='".$_POST['itmsub_cat'][$cc]."'");
$rowc=mysql_fetch_array($subc);		

$suc=mysql_query("select grp_name from bq_itemcat where cat_code='".$_POST['itmsub_cat'][$cc]."'");
$roc=mysql_fetch_array($suc);	

	$sql="insert into bq_opfpmenudetail(fpno,fpdate,itemcode,itemname,qty,rate,taxstructcode,submenugrpcode,menugrpcode, 	menucode,subcatcode,catcode,grpcode,bill_status)";
	$sql.=" values(";
	$sql.="'".$fpNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$_POST['itemcode'][$cc]."',";
	$sql.="'".mysql_real_escape_string($_POST['itemname'][$cc])."',";
	$sql.="'".$qty."',";
	$sql.="'".$_POST['item_rate'][$cc]."',";
	$sql.="'".$_POST['tax_struc'][$cc]."',";
	$sql.="'".$_POST['itmsubmnu_code'][$cc]."',";
	$sql.="'".$row['subgrp_code']."',";
	$sql.="'".$_POST['menu_code']."',";
	$sql.="'".$_POST['itmsub_cat'][$cc]."',";
	$sql.="'".$rowc['cat_code']."',";
	$sql.="'".$roc['grp_name']."',";
	$sql.="'".$sts."')";
	mysql_query($sql);
} */		
/* if(isset($_POST['open_itemname'])){
	$open_itemname=$_POST['open_itemname'];
	
}else{
	$open_itemname="";
} */

$sqlB="UPDATE bq_hallbooking SET ";
$sqlB=$sqlB."fpno='".$fpNum."',";
$sqlB=$sqlB."gstin='".$_POST['amd_gst']."',";
$sqlB=$sqlB."session='".$_POST['amd_sess']."'";
$sqlB=$sqlB." where booking_no='".$_POST['booking_no']."'";
mysql_query($sqlB);

for($co=0;$co<count($_POST['open_itemname']);$co++){
 if($_POST['open_itemname'][$co]!=''){
	 
$sw=mysql_query("select * from bq_opfpmenudetail where fpno='".$_POST['fp_no']."' AND itemcode='55555' AND itemname='".$_POST['open_itemname'][$co]."'"); 
if(mysql_num_rows($sw)>0){
	while($rw=mysql_fetch_array($sw)){
			$sql="insert into bq_opfpmenudetail(fpno,fpdate,itemcode,itemname,qty,rate,taxstructcode,submenugrpcode,menugrpcode, 	menucode,subcatcode,catcode,grpcode,bill_status)";
			$sql.=" values(";
			$sql.="'".$fpNum."',";
			$sql.="'".$curDate."',";
			$sql.="'".$rw['itemcode']."',";
			$sql.="'".mysql_real_escape_string($rw['itemname'])."',";
			$sql.="'".mysql_real_escape_string($rw['qty'])."',";
			$sql.="'".mysql_real_escape_string($rw['rate'])."',";
			$sql.="'".mysql_real_escape_string($rw['taxstructcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['submenugrpcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['menugrpcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['menucode'])."',";
			$sql.="'".mysql_real_escape_string($rw['subcatcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['catcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['grpcode'])."',";
			$sql.="'".$sts."')";
			/* echo $sql; */
			mysql_query($sql);
	}
}else{
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


	$sql="insert into bq_opfpmenudetail(fpno,fpdate,itemcode,itemname,qty,rate,taxstructcode,submenugrpcode,menugrpcode, 	menucode,subcatcode,catcode,grpcode,bill_status)";
	$sql.=" values(";
	$sql.="'".$fpNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$opitmCde."',";
	$sql.="'".mysql_real_escape_string($_POST['open_itemname'][$co])."',";
	$sql.="'".$qty."',";
	$sql.="'".$item_rate."',";
	$sql.="'".$tax_struc."',";
	$sql.="'".mysql_real_escape_string($_POST['open_submenu'][$co])."',";
	$sql.="'".$row['subgrp_code']."',";
	$sql.="'".$_POST['menu']."',";
	$sql.="'".$roc['cat_code']."',";
	$sql.="'".$rowc['cat_code']."',";
	$sql.="'".$roc['grp_name']."',";
	$sql.="'".$sts."')";
/* echo $sql; */
	mysql_query($sql);
 }
 }
 }			
/*  die();  */

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
  }else{
	$sw=mysql_query("select * from bq_opfpmenudetail where fpno='".$_POST['fp_no']."' AND itemcode!='55555'"); 
	if(mysql_num_rows($sw)>0){
	while($rw=mysql_fetch_array($sw)){
			$sql="insert into bq_opfpmenudetail(fpno,fpdate,itemcode,itemname,qty,rate,taxstructcode,submenugrpcode,menugrpcode, 	menucode,subcatcode,catcode,grpcode,bill_status)";
			$sql.=" values(";
			$sql.="'".$fpNum."',";
			$sql.="'".$curDate."',";
			$sql.="'".$rw['itemcode']."',";
			$sql.="'".mysql_real_escape_string($rw['itemname'])."',";
			$sql.="'".mysql_real_escape_string($rw['qty'])."',";
			$sql.="'".mysql_real_escape_string($rw['rate'])."',";
			$sql.="'".mysql_real_escape_string($rw['taxstructcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['submenugrpcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['menugrpcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['menucode'])."',";
			$sql.="'".mysql_real_escape_string($rw['subcatcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['catcode'])."',";
			$sql.="'".mysql_real_escape_string($rw['grpcode'])."',";
			$sql.="'".$sts."')";
			/* echo $sql; */
			mysql_query($sql);
	} 
	} 
	 
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





if($UsQuery){
$link = "<script>window.open('$home_path/transaction/view/print-fp-creation.php?fpNum=$fpNum&amend=$fpAme', '_blank','width=1000,height=700')</script>";
echo $link;
$link1 = "<script>window.open('$home_path/transaction/frontdesk/view-amendments.php?fromdate=$curDate&todate=$curDate&val=', '_self','')</script>";
echo $link1;
} else {
header('location:'.$home_path.'/transaction/frontdesk/view-amendments.php?msg=Error in insertion');
}


