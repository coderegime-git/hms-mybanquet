<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlq="update room_advance set ";
$sqlq=$sqlq."bill_status='2'";
$sqlq=$sqlq." where roomadv_id='".$_GET['rmId']."'";
$result=mysql_query($sqlq);
			
$sqlE="update guest_trans set ";
$sqlE=$sqlE."bill_status='3'";
$sqlE=$sqlE." where reg_num='".$_GET['reg']."' AND receipt_no='".$_GET['rcpt']."'";
$resultt=mysql_query($sqlE);

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/transaction/frontdesk/view-roomadvance.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/transaction/frontdesk/view-roomadvance.php?msg='.$msg);	
}