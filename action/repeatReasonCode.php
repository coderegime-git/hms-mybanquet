<?php  
ob_start();

include("../config.php");
$reason_code=$_GET['reason_code'];

$checkDet=mysql_query("select reason_code from reasons where reason_code='$reason_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>