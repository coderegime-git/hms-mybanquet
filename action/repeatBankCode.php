<?php  
ob_start();

include("../config.php");
$bank_code=$_GET['bank_code'];

$checkDet=mysql_query("select bank_code,bank_name from bq_bankname where bank_code='$bank_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>