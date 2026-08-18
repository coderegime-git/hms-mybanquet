<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$vucNo=$_GET['vucNo'];
$itCd=$_GET['itCd'];
$per=$_GET['per'];

$SqVc=mysql_query("select * from bq_opvchrdtl where vouchrno='".$_GET['vucNo']."' AND item_code='".$itCd."' AND bill_status='1'"); 
$rwVc=mysql_fetch_array($SqVc);

$txVal=0;

$sqF=mysql_query("select * from bq_taxstruct where str_code='".$rwVc['taxstruccode']."' AND status='1'");
while($roF=mysql_fetch_array($sqF)){
	$lneTot=$rwVc['line_total']-$per;
	$txVal+=$lneTot*$roF['factor_value']/100;
	
}
	
echo sprintf("%01.2f",$txVal); 

?>