<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$vucNo=$_GET['vucNo'];
/* $sql=mysql_query("select * from bq_opvchrdtl where vouchrno='".$vucNo."' AND bill_status='1'"); */
$sql=mysql_query("select * from bq_opbillhdtl where vouchrno='".$vucNo."' AND bill_status='1'");
if(mysql_num_rows($sql)>0){
	echo 1;
}else{
	
}

?>