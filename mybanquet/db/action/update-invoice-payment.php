<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE invoice_payment SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."ebsinv_no='".$_POST['ebsinv_no']."',";
$sqll=$sqll."inv_date='".$_POST['inv_date']."',";
$sqll=$sqll."inv_amount='".$_POST['inv_amount']."',";
$sqll=$sqll."payment_amount='".$_POST['payment_amount']."',";
$sqll=$sqll."payment_type='".$_POST['payment_type']."',";
$sqll=$sqll."payment_details='".$_POST['payment_details']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where invpayment_id='".$_POST['invpayment_id']."'";

/* echo $sqll;
die(); */
$resultt=mysql_query($sqll);
	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/operations/view-payment-receipt.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/operations/view-payment-receipt.php?msg='.$msg);	
	}

?>