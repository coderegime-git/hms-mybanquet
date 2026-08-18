<?php  
ob_start();

include("../config.php");
$bank_name=$_GET['bank_name'];

$checkDet=mysql_query("select bank_code,bank_name from bq_bankname where bank_name='$bank_name'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>