<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

/* echo "rterer".$_POST['nsn_no'];
die(); */

$sqll="UPDATE unsuccessful_quotes SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."rfq_no='".$_POST['rfq_no']."',";
$sqll=$sqll."solic_no='".$_POST['solic_no']."',";
$sqll=$sqll."nsn_no='".$_POST['nsn_no']."',";
$sqll=$sqll."qty='".$_POST['qty']."',";
$sqll=$sqll."price='".$_POST['price']."',";
$sqll=$sqll."award_whom='".$_POST['award_whom']."',";
$sqll=$sqll."award_price='".$_POST['award_price']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where unsucc_quoteId='".$_POST['unsucc_quoteId']."'";

/* echo $sqll;
die(); */
$resultt=mysql_query($sqll);
	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/operations/view-unsuccessfulquotes.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/operations/view-unsuccessfulquotes.php?msg='.$msg);	
	}

?>