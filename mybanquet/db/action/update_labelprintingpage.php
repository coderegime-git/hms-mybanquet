<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE labelprintingpage SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."label_type='".$_POST['label_type']."',";
$sqll=$sqll."rfq_no='".$_POST['rfq_no']."',";
$sqll=$sqll."date='".$_POST['date']."',";
$sqll=$sqll."dest_code='".$_POST['dest_code']."',";
$sqll=$sqll."clin_no='".$_POST['clin_no']."',";
$sqll=$sqll."shipment_no='".$_POST['shipment_no']."',";
$sqll=$sqll."label_qty='".$_POST['label_qty']."',";
$sqll=$sqll."tcn_no='".$_POST['tcn_no']."',";
$sqll=$sqll."package_type='".$_POST['package_type']."',";
$sqll=$sqll."total_nopieces='".$_POST['total_nopieces']."',";
$sqll=$sqll."piece_no='".$_POST['piece_no']."',";
$sqll=$sqll."package_dimension='".$_POST['package_dimension']."',";
$sqll=$sqll."cu_wt='".$_POST['cu_wt']."',";
$sqll=$sqll."cu_area='".$_POST['cu_area']."',";
$sqll=$sqll."contract_no='".$_POST['contract_no']."',";
$sqll=$sqll."nsn_no='".$_POST['nsn_no']."',";
$sqll=$sqll."cage_code='".$_POST['cage_code']."',";
$sqll=$sqll."part_no='".$_POST['part_no']."',";
$sqll=$sqll."part_name='".$_POST['part_name']."',";
$sqll=$sqll."bill_1='".$_POST['bill_1']."',";
$sqll=$sqll."bill_2='".$_POST['bill_2']."',";
$sqll=$sqll."bill_3='".$_POST['bill_3']."',";
$sqll=$sqll."bill_4='".$_POST['bill_4']."',";
$sqll=$sqll."ship_1='".$_POST['ship_1']."',";
$sqll=$sqll."ship_2='".$_POST['ship_2']."',";
$sqll=$sqll."ship_3='".$_POST['ship_3']."',";
$sqll=$sqll."ship_4='".$_POST['ship_4']."',";
$sqll=$sqll."qup='".$_POST['qup']."',";
$sqll=$sqll."priority='".$_POST['priority']."',";
$sqll=$sqll."serial_no='".$_POST['serial_no']."',";
$sqll=$sqll."uid_no='".$_POST['uid_no']."',";
$sqll=$sqll."rfid='".$_POST['rfid']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where labelprntpge_id='".$_POST['labelprntpge_id']."'";

/*   echo $sqll;
die(); */  

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/operations/view-labelprintingpage.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/operations/view-labelprintingpage.php?msg='.$msg);	
}

?>