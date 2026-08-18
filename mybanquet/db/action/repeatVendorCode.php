<?php  
session_start();
include("../config.php");
$vendorCode=$_GET['vendorCode'];

$checkDet=mysql_query("select vendor_code from vendor_master where vendor_code='$vendorCode'");
if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>