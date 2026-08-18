<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$file1 =$_FILES['add_po']['name'];
$upload1=$_SERVER['DOCUMENT_ROOT']."/myerp/library/"; 
$target_path2 = $upload1 . basename( ($_FILES['add_po']['name']));
move_uploaded_file($_FILES['add_po']['tmp_name'], $target_path2);

$clinQty=$_POST['clin_qty'];
for($cc=0;$cc<count($clinQty);$cc++)
{ 
$sql="insert into customer_po(	company_id,quote_ref,customerpo_no,cur_date,inspec_place,fob,no_clin,clin_qty,clin_dest,spec_req,nsn_no,part_no,part_name,rfq_no,total_qty,req_deldate,order_value,packing_req,qup,add_po,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['quote_ref']."',";
	$sql.="'".$_POST['customerpo_no']."',";
	$sql.="'".$_POST['cur_date']."',";
	$sql.="'".$_POST['inspec_place']."',";
	$sql.="'".$_POST['fob']."',";
	$sql.="'".$_POST['no_clin']."',";
	$sql.="'".$_POST['clin_qty'][$cc]."',";
	$sql.="'".$_POST['clin_dest'][$cc]."',";
	$sql.="'".$_POST['spec_req']."',";
	$sql.="'".$_POST['nsn_no']."',";
	$sql.="'".$_POST['part_no']."',";
	$sql.="'".$_POST['part_name']."',";
	$sql.="'".$_POST['rfq_no']."',";
	$sql.="'".$_POST['total_qty']."',";
	$sql.="'".$_POST['req_deldate']."',";
	$sql.="'".$_POST['order_value']."',";
	$sql.="'".$_POST['packing_req']."',";
	$sql.="'".$_POST['qup']."',";
	$sql.="'".$file1."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
	/*  echo $sql;
	die(); */ 
	$UsQuery =mysql_query($sql);
	if($UsQuery){
		header('location:'.$home_path.'/operations/customerpo.php?msg=Data saved Successfully!');
	}
	else{
		header('location:'.$home_path.'/operations/customerpo.php?msg=Error in insertion');
	}
}

?>