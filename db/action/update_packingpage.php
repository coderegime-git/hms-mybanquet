<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE packingpage SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."rfq_no='".$_POST['rfq_no']."',";
$sqll=$sqll."clin_no='".$_POST['clin_no']."',";
$sqll=$sqll."packing_date='".$_POST['packing_date']."',";
$sqll=$sqll."contract_no='".$_POST['contract_no']."',";
$sqll=$sqll."nsn_no='".$_POST['nsn_no']."',";
$sqll=$sqll."part_no='".$_POST['part_no']."',";
$sqll=$sqll."part_name='".$_POST['part_name']."',";
$sqll=$sqll."total_qty='".$_POST['total_qty']."',";
$sqll=$sqll."clin_qty='".$_POST['clin_qty']."',";
$sqll=$sqll."dest_code='".$_POST['dest_code']."',";
$sqll=$sqll."dest_address='".$_POST['dest_address']."',";
$sqll=$sqll."packing_req='".$_POST['packing_req']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where packingpage_id='".$_POST['packingpage_id']."'";

/* echo $sqll;
die(); */
$resultt=mysql_query($sqll);
	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/operations/view-packingpage.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/operations/view-packingpage.php?msg='.$msg);	
	}

?>