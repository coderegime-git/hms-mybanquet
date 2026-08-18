<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$i=0;
$menuPArtNO="";
foreach($_POST['part_no'] as $menuId)
{
	$i++;
	if($i<sizeof($_POST['part_no']))
	{
		$menuPArtNO .=$menuId.',';
	}
	else
	{
		$menuPArtNO .=$menuId;
	}
}


$j=0;
$menuPArtName="";
foreach($_POST['part_name'] as $menuId)
{
	$j++;
	if($j<sizeof($_POST['part_name']))
	{
		$menuPArtName .=$menuId.',';
	}
	else
	{
		$menuPArtName .=$menuId;
	}
}


$sql="insert into quotation(	company_id,solicit_number,prop_code,cur_date,nsn_no,part_no,new_partno,new_partname,part_name,perior_status,rfq_no,currency,req_days,days_possible,qty,unit_issue,inspec_place,fob,quote_rate,quote_amt,quote_number,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['solicit_number']."',";
	$sql.="'".$_POST['prop_code']."',";
	$sql.="'".$_POST['cur_date']."',";
	$sql.="'".$_POST['nsn_no']."',";
	$sql.="'".$menuPArtNO."',";
	$sql.="'".$_POST['new_partno']."',";
	$sql.="'".$_POST['new_partname']."',";
	$sql.="'".$menuPArtName."',";
	$sql.="'".$_POST['perior_status']."',";
	$sql.="'".$_POST['rfq_no']."',";
	$sql.="'".$_POST['currency']."',";
	$sql.="'".$_POST['req_days']."',";
	$sql.="'".$_POST['days_possible']."',";
	$sql.="'".$_POST['qty']."',";
	$sql.="'".$_POST['unit_issue']."',";
	$sql.="'".$_POST['inspec_place']."',";
	$sql.="'".$_POST['fob']."',";
	$sql.="'".$_POST['quote_rate']."',";
	$sql.="'".$_POST['quote_amt']."',";
	$sql.="'".$_POST['quote_number']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
 /* echo $sql;
die(); */   
$UsQuery =mysql_query($sql);

$sqll="insert into partnumber(company_id,nsnnumber,partnumber,partname,added_by,added_on) values ('$_SESSION[companyId]','$_POST[nsn_no]','$_POST[new_partno]','$_POST[new_partname]','$added_by','$added_on')";

$UsQueryy =mysql_query($sqll);

if($UsQuery){
	header('location:'.$home_path.'/operations/view-quotation-master.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/operations/view-quotation-master.php?msg=Error in insertion');
}


?>