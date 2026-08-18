<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

$sqlB="UPDATE bq_opkothdr SET ";
$sqlB=$sqlB."kotstatus='3'";
$sqlB=$sqlB." where fpno='".$_GET['fpno']."' AND opkothdr_id='".$_GET['kotId']."'";
/* echo $sqlB;
die(); */ 
$UsQuery=mysql_query($sqlB);


			
if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/view-fpkot.php?fromdate='.$curDate.'&todate='.$curDate);
}else {
header('location:'.$home_path.'/transaction/frontdesk/view-fpkot.php?msg=Error in insertion');
}


?>