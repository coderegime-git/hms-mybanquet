<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
$fpNum=$_POST['fpno'];
/*echo "<pre>";
print_r ($_POST);
echo "</pre>";*/
//$prefnew = array_values(array_filter($_POST['pref']));
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

        $sql="UPDATE bq_hallbooking SET ";
		$sql=$sql."expected='".$_POST['exppax']."',";
        $sql=$sql."guaranted='".$_POST['gaupax']."',";
        $sql=$sql."hall_rate='".$_POST['ratetax_chg']."',";
        $sql=$sql."added_on='".$added_on."'";
		$sql=$sql." where hallbook_id='".$_POST['hallbook_id']."' and fpno='".$fpNum."'";
	   /* echo $sql; 
	    die(); */
	   $UsQuery =mysql_query($sql);

$sqlb=mysql_query("select book_date,guaranted,expected from bq_hallbooking where booking_no='".$_POST['booking_no']."' AND hallbook_id='".$_POST['hallbook_id']."'");
$rowb=mysql_fetch_array($sqlb);

for($dp=0;$dp<count($_POST['dept_code']);$dp++){
	$sqC=mysql_query("select * from bq_opfpdeptinst where deptcode='".$_POST['dept_code'][$dp]."' and fpno='".$fpNum."' AND bill_status!='3'");
if(mysql_num_rows($sqC)>0){
	$sql="UPDATE bq_opfpdeptinst SET ";
		$sql=$sql."deptdesc='".$_POST['dept_instr'][$dp]."'";
		$sql=$sql." where deptcode='".$_POST['dept_code'][$dp]."' and fpno='".$fpNum."'";
	   /* echo $sql; 
	    die(); */
	   $UsQuery =mysql_query($sql);
}else{
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
}}


$st='0';
$sts='1';
$vucsts='';
    $sql="UPDATE bq_opfpmenuhdr SET ";
		$sql=$sql."fpno='".$fpNum."',";
		$sql=$sql."fpdate='".$curDate."',";
		$sql=$sql."bkno='".$_POST['booking_no']."',";
		$sql=$sql."hallbook_id='".$_POST['hallbook_id']."',";
		$sql=$sql."bkdate='".$_POST['book_date']."',";
		$sql=$sql."hallchrg='".$_POST['halltax_chg']."',";
		$sql=$sql."halltax='".$_POST['halltax_det']."',";
		$sql=$sql."hallincl='".$_POST['halltaxincl']."',";
		$sql=$sql."hallchgnoincl='".$_POST['hallchgnoincl']."',";
		$sql=$sql."ratechrg='".$_POST['ratetax_chg']."',";
		$sql=$sql."ratetax='".$_POST['ratetax_det']."',";
		$sql=$sql."rateincl='".$_POST['ratetaxincl']."',";
		$sql=$sql."ratechgnoincl='".$_POST['ratechgnoincl']."',";
		$sql=$sql."arrtime='".$_POST['arrtime']."',";
		$sql=$sql."pictime='".$_POST['pictime']."',";
		$sql=$sql."sertime='".$_POST['sertime']."',";
		$sql=$sql."depinst='".$st."',";
		$sql=$sql."signboard='".mysql_real_escape_string($_POST['sign_board'])."',";
		$sql=$sql."remarks='".mysql_real_escape_string($_POST['remarks'])."',";
		$sql=$sql."evetea='".$_POST['evetea']."',";
		$sql=$sql."mortea='".$_POST['mortea']."',";
		$sql=$sql."menu_code='".mysql_real_escape_string($_POST['menu'])."',";
		$sql=$sql."grpax='".mysql_real_escape_string($rowb['guaranted'])."',";
		$sql=$sql."exppax='".mysql_real_escape_string($rowb['expected'])."',";
		$sql=$sql."bill_status='".$sts."',";
		$sql=$sql."vuc_status='".$vucsts."',";
		$sql=$sql."added_by='".$added_by."',";
		$sql=$sql."added_on='".$added_on."'";
		$sql=$sql." where fpno='".$fpNum."'";
	    /*echo $sql; 
	    die(); */ 
		$UsQuery =mysql_query($sql);
$qty='';

for($cc=0;$cc<count($_POST['menusel']);$cc++){
$sqC=mysql_query("select * from bq_opfpmenudetail  where itemcode='".$_POST['menusel'][$cc]."' and fpno='".$fpNum."'");
if(mysql_num_rows($sqC)>0){
	$sql="UPDATE bq_opfpmenudetail SET ";
		$sql=$sql."bill_status='1',";
		$sql=$sql."preference='".$_POST['pref'][$cc]."'";
		$sql=$sql." where itemcode='".$_POST['menusel'][$cc]."' and fpno='".$fpNum."'";
	     /*echo $sql; */
	    
	   $UsQuery =mysql_query($sql);
	
}else{
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
	$sql.="'pref',";
	$sql.="'".$rIM['item_rate']."',";
	$sql.="'".$rIM['tax_struc']."',";
	$sql.="'".$rIM['itmsubmnu_code']."',";
	$sql.="'".$row['subgrp_code']."',";
	$sql.="'".$_POST['menu']."',";
	$sql.="'".$rIM['itmsub_cat']."',";
	$sql.="'".$rowc['cat_code']."',";
	$sql.="'".$roc['grp_name']."',";
	$sql.="'".$sts."')";
 /* echo $sql; 
  die();*/
	mysql_query($sql);
	/* } */
	
	
}}		

//die();

for($co=0;$co<count($_POST['open_itemname']);$co++){
	$sqC=mysql_query("select * from bq_opfpmenudetail  where itemname='".$_POST['open_itemname'][$co]."' and fpno='".$fpNum."'");
if(mysql_num_rows($sqC)>0){
	$sql="UPDATE bq_opfpmenudetail SET ";
		$sql=$sql."bill_status='1',";
		$sql=$sql."qty='".$_POST['opn_qty'][$co]."',";
		$sql=$sql."rate='".$_POST['open_itemrate'][$co]."',";
		$sql=$sql."submenugrpcode='".$_POST['open_submenu'][$co]."',";
		$sql=$sql." where itemname='".$_POST['open_itemname'][$co]."' and fpno='".$fpNum."'";
	    /*echo $sql; 
	    die(); */
	   $UsQuery =mysql_query($sql);
	   
}else{
 if($_POST['open_itemname'][$co]!=''){
	$opitmCde='55555';
	$qty='';
	$item_rate='';
	$tax_struc='FOODTAX';

$sub=mysql_query("select subgrp_code from bq_submenugrp where submenu_code='".$_POST['open_submenu'][$co]."'");
$row=mysql_fetch_array($sub);

$subc=mysql_query("select cat_code from bq_subcatitem where subcat_code='".$_POST['open_submenu'][$co]."'");
$rowc=mysql_fetch_array($subc);		

$suc=mysql_query("select grp_name,cat_code from bq_itemcat where cat_code='".$_POST['open_subcate'][$co]."'");
$roc=mysql_fetch_array($suc);

	$sql="insert into bq_opfpmenudetail(fpno,fpdate,itemcode,itemname,qty,rate,preference,taxstructcode,submenugrpcode,menugrpcode, 	menucode,subcatcode,catcode,grpcode,bill_status)";
	$sql.=" values(";
	$sql.="'".$fpNum."',";
	$sql.="'".$curDate."',";
	$sql.="'".$opitmCde."',";
	$sql.="'".mysql_real_escape_string($_POST['open_itemname'][$co])."',";
	$sql.="'".$_POST['opn_qty'][$co]."',";
	$sql.="'".mysql_real_escape_string($_POST['open_itemrate'][$co])."',";
	$sql.="'".mysql_real_escape_string($_POST['open_itempreference'][$co])."',";
	$sql.="'".$tax_struc."',";
	$sql.="'".mysql_real_escape_string($_POST['open_submenu'][$co])."',";
	$sql.="'".$row['subgrp_code']."',";
	$sql.="'".$_POST['menu']."',";
	$sql.="'".$_POST['open_submenu'][$co]."',";
	$sql.="'".$rowc['cat_code']."',";
	$sql.="'".$_POST['open_submenu'][$co]."',";
	$sql.="'".$sts."')";

	mysql_query($sql);
 }
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


if($UsQuery){
$link = "<script>window.open('$home_path/transaction/view/print-fp-creation.php?fpNum=$fpNum', '_blank','width=1000,height=700')</script>";
echo $link;
$link1 = "<script>window.open('$home_path/transaction/frontdesk/view-fb-creation-chk.php?val=', '_self','')</script>";
echo $link1;
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpvoucher.php?msg=Error in insertion');
}
?>