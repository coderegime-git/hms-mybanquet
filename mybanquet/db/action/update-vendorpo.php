<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

if($_POST['typo_po']=='purchase order'){
	$prefix=$_POST['prefixpo'];
	$poNumber=$_POST['po_no'];
}
if($_POST['typo_po']=='job order'){
	$prefix=$_POST['prefixjo'];
	$poNumber=$_POST['jo_no'];
}

$sqll="UPDATE vendor_po SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."typo_po='".$_POST['typo_po']."',";
$sqll=$sqll."rfq_no='".$_POST['rfq_no']."',";
$sqll=$sqll."vendor_name='".$_POST['vendor_name']."',";
$sqll=$sqll."vend_add1='".$_POST['vend_add1']."',";
$sqll=$sqll."vend_add2='".$_POST['vend_add2']."',";
$sqll=$sqll."vend_city='".$_POST['vend_city']."',";
$sqll=$sqll."vend_pincode='".$_POST['vend_pincode']."',";
$sqll=$sqll."cur_date='".$_POST['cur_date']."',";
$sqll=$sqll."qty='".$_POST['qty']."',";
$sqll=$sqll."quote_qty='".$_POST['quote_qty']."',";
$sqll=$sqll."bal_qty='".$_POST['bal_qty']."',";
$sqll=$sqll."unit_issue='".$_POST['unit_issue']."',";
$sqll=$sqll."currency='".$_POST['currency']."',";
$sqll=$sqll."rate='".$_POST['rate']."',";
$sqll=$sqll."req_deldate='".$_POST['req_deldate']."',";
$sqll=$sqll."custreq_deldate='".$_POST['custreq_deldate']."',";
$sqll=$sqll."prefix='".$prefix."',";
$sqll=$sqll."po_no='".$poNumber."',";
$sqll=$sqll."part_no='".$_POST['part_no']."',";
$sqll=$sqll."part_name='".$_POST['part_name']."',";
$sqll=$sqll."total_amount='".$_POST['total_amount']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where vendorpo_id='".$_POST['vendorpo_id']."'";

/* echo $sqll;
die(); */
$resultt=mysql_query($sqll);
	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/operations/view-vendorpo.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/operations/view-vendorpo.php?msg='.$msg);	
	}

?>