<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

/* echo "rterer".$_POST['nsn_no'];
die(); */


$file1 =$_FILES['add_po']['name'];
$upload1=$_SERVER['DOCUMENT_ROOT']."/myerp/library/"; 
$target_path2 = $upload1 . basename( ($_FILES['add_po']['name']));
move_uploaded_file($_FILES['add_po']['tmp_name'], $target_path2);

$clinQty=$_POST['clin_qty'];
for($cc=0;$cc<count($clinQty);$cc++)
{ 
$sqll="UPDATE customer_po SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."quote_ref='".$_POST['quote_ref']."',";
$sqll=$sqll."customerpo_no='".$_POST['customerpo_no']."',";
$sqll=$sqll."cur_date='".$_POST['cur_date']."',";
$sqll=$sqll."inspec_place='".$_POST['inspec_place']."',";
$sqll=$sqll."fob='".$_POST['fob']."',";
$sqll=$sqll."no_clin='".$_POST['no_clin']."',";
$sqll=$sqll."clin_qty='".$_POST['clin_qty'][$cc]."',";
$sqll=$sqll."clin_dest='".$_POST['clin_dest'][$cc]."',";
$sqll=$sqll."spec_req='".$_POST['spec_req']."',";
$sqll=$sqll."nsn_no='".$_POST['nsn_no']."',";
$sqll=$sqll."part_no='".$_POST['part_no']."',";
$sqll=$sqll."part_name='".$_POST['part_name']."',";
$sqll=$sqll."rfq_no='".$_POST['rfq_no']."',";
$sqll=$sqll."total_qty='".$_POST['total_qty']."',";
$sqll=$sqll."req_deldate='".$_POST['req_deldate']."',";
$sqll=$sqll."order_value='".$_POST['order_value']."',";
$sqll=$sqll."packing_req='".$_POST['packing_req']."',";
$sqll=$sqll."qup='".$_POST['qup']."',";
$sqll=$sqll."add_po='".$file1."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where customerpo_id='".$_POST['customerpo_id']."'";

/*    echo $sqll;
die(); */ 

$resultt=mysql_query($sqll);

	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/operations/view-customerpo.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/operations/view-customerpo.php?msg='.$msg);	
	}
}
?>