<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
$fpNum=$_POST['fpno'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

$sqlb=mysql_query("select book_date,guaranted,expected from bq_hallbooking where booking_no='".$_POST['booking_no']."' AND hallbook_id='".$_POST['hallbook_id']."'");
$rowb=mysql_fetch_array($sqlb);


$aprsts='2';
    $sql="UPDATE bq_opfpmenuhdr SET ";
		$sql=$sql."aprove_sts='".$aprsts."',";
		$sql=$sql."added_by='".$added_by."',";
		$sql=$sql."added_on='".$added_on."'";
		$sql=$sql." where fpno='".$fpNum."'";
	    /*echo $sql; 
	    die(); */ 
		$UsQuery =mysql_query($sql);


if($UsQuery){
$link = "<script>window.open('$home_path/transaction/view/print-fp-creation.php?fpNum=$fpNum', '_blank','width=1000,height=700')</script>";
echo $link;
$link1 = "<script>window.open('$home_path/transaction/frontdesk/view-fb-creation-chk.php?val=', '_self','')</script>";
echo $link1;
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpvoucher.php?msg=Error in insertion');
}
?>