<?php  
ob_start();

include("../config.php");
$payment_mode=$_GET['payment_mode'];

$checkDet=mysql_query("select payment_mode from payment_mode where payment_mode='$payment_mode'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>