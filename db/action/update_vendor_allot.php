<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$file1 =$_FILES['draw_attach']['name'];
$upload1=$_SERVER['DOCUMENT_ROOT']."/myerp/library/"; 
$target_path2 = $upload1 . basename( ($_FILES['draw_attach']['name']));
move_uploaded_file($_FILES['draw_attach']['tmp_name'], $target_path2);

$sqll="UPDATE vendor_allocation SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."rfq_no='".$_POST['rfq_no']."',";
$sqll=$sqll."vendor_name='".$_POST['vendor_name']."',";
$sqll=$sqll."vendor_price='".$_POST['vendor_price']."',";
$sqll=$sqll."draw_attach='".$file1."',";
$sqll=$sqll."unit_price='".$_POST['unit_price']."',";
$sqll=$sqll."qty='".$_POST['qty']."',";
$sqll=$sqll."total_amount='".$_POST['total_amount']."',";
$sqll=$sqll."proceed_po='".$_POST['proceed_po']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where vendorallot_id='".$_POST['vendorallot_id']."'";

/*      echo $sqll;
die();  */ 

$resultt=mysql_query($sqll);

	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/operations/view-vendorallocation.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/operations/view-vendorallocation.php?msg='.$msg);	
	}

?>