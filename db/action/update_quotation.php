<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

/* echo "rterer".$_POST['nsn_no'];
die(); */

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


$sqll="UPDATE quotation SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."solicit_number='".$_POST['solicit_number']."',";
$sqll=$sqll."prop_code='".$_POST['prop_code']."',";
$sqll=$sqll."cur_date='".$_POST['cur_date']."',";
$sqll=$sqll."nsn_no='".$_POST['nsn_no']."',";
$sqll=$sqll."part_no='".$menuPArtNO."',";
$sqll=$sqll."new_partno='".$_POST['new_partno']."',";
$sqll=$sqll."new_partname='".$_POST['new_partname']."',";
$sqll=$sqll."part_name='".$menuPArtName."',";
$sqll=$sqll."perior_status='".$_POST['perior_status']."',";
$sqll=$sqll."rfq_no='".$_POST['rfq_no']."',";
$sqll=$sqll."currency='".$_POST['currency']."',";
$sqll=$sqll."req_days='".$_POST['req_days']."',";
$sqll=$sqll."days_possible='".$_POST['days_possible']."',";
$sqll=$sqll."qty='".$_POST['qty']."',";
$sqll=$sqll."unit_issue='".$_POST['unit_issue']."',";
$sqll=$sqll."inspec_place='".$_POST['inspec_place']."',";
$sqll=$sqll."fob='".$_POST['fob']."',";
$sqll=$sqll."quote_rate='".$_POST['quote_rate']."',";
$sqll=$sqll."quote_amt='".$_POST['quote_amt']."',";
$sqll=$sqll."quote_number='".$_POST['quote_number']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where quote_id='".$_POST['quote_id']."'";

/*    echo $sqll;
die(); */ 

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/operations/view-quotation-master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/operations/view-quotation-master.php?msg='.$msg);	
}

?>