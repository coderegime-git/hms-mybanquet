<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE ar_bills SET ";
$sqll=$sqll."cur_date='".$_POST['cur_date']."',";
$sqll=$sqll."bill_date='".$_POST['bill_date']."',";
$sqll=$sqll."bill_no='".$_POST['bill_no']."',";
$sqll=$sqll."vendor_code='".$_POST['vendor_code']."',";
$sqll=$sqll."arreceipt_no='Null',";
$sqll=$sqll."cash='Null',";
$sqll=$sqll."card='Null',";
$sqll=$sqll."cheque='Null',";
$sqll=$sqll."neft='Null',";
$sqll=$sqll."commission='Null',";
$sqll=$sqll."disc='Null',";
$sqll=$sqll."balance='Null',";
$sqll=$sqll."adjusted_on='Null',";
$sqll=$sqll."adjusted_by='Null',";
$sqll=$sqll."remarks='".$_POST['remarks']."',";
$sqll=$sqll."status='Null',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where arbill_id='".$_POST['arbill_id']."'";

/*   echo $sqll;
die();   */

$resultt=mysql_query($sqll);

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/transaction/frontdesk/view_opening_balance.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/transaction/frontdesk/view_opening_balance.php?msg='.$msg);	
}

?>