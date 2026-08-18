<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE vendor_invoicercpt SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."rfq_no='".$_POST['rfq_no']."',";
$sqll=$sqll."vendor_name='".$_POST['vendor_name']."',";
$sqll=$sqll."vendor_invno='".$_POST['vendor_invno']."',";
$sqll=$sqll."vendor_invdate='".$_POST['vendor_invdate']."',";
$sqll=$sqll."qty_accepted='".$_POST['qty_accepted']."',";
$sqll=$sqll."qty_rework='".$_POST['qty_rework']."',";
$sqll=$sqll."qty_reject='".$_POST['qty_reject']."',";
$sqll=$sqll."reason_rework='".$_POST['reason_rework']."',";
$sqll=$sqll."bal_qty='".$_POST['bal_qty']."',";
$sqll=$sqll."purorder_no='".$_POST['purorder_no']."',";
$sqll=$sqll."part_name='".$_POST['part_name']."',";
$sqll=$sqll."part_no='".$_POST['part_no']."',";
$sqll=$sqll."order_qty='".$_POST['order_qty']."',";
$sqll=$sqll."rate='".$_POST['rate']."',";
$sqll=$sqll."tax='".$_POST['tax']."',";
$sqll=$sqll."amount='".$_POST['amount']."',";
$sqll=$sqll."amount_payable='".$_POST['amount_payable']."',";
$sqll=$sqll."vendor_dlno='".$_POST['vendor_dlno']."',";
$sqll=$sqll."vendor_dldate='".$_POST['vendor_dldate']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where vendor_invrcpt_id='".$_POST['vendor_invrcpt_id']."'";

/* echo $sqll;
die(); */
$resultt=mysql_query($sqll);
	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/operations/view-vendorinvrecpt.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/operations/view-vendorinvrecpt.php?msg='.$msg);	
	}

?>