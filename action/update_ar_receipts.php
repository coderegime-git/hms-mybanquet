<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE ar_receipts SET ";
$sqll=$sqll."rcpt_date='".$_POST['rcpt_date']."',";
$sqll=$sqll."rcpt_no='".$_POST['rcpt_no']."',";
$sqll=$sqll."vendor_code='".$_POST['vendor_code']."',";
$sqll=$sqll."amount='".$_POST['amount']."',";
$sqll=$sqll."pay_mode='".$_POST['pay_mode']."',";
$sqll=$sqll."cheque_num='".$_POST['cheque_num']."',";
$sqll=$sqll."cheque_date='".$_POST['cheque_date']."',";
$sqll=$sqll."remarks='".$_POST['remarks']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where arreceipt_id='".$_POST['arreceipt_id']."'";

/*  echo $sqll;
die();  */ 

$resultt=mysql_query($sqll);

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/transaction/frontdesk/view_payment_rcvbl.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/transaction/frontdesk/view_payment_rcvbl.php?msg='.$msg);	
}

?>