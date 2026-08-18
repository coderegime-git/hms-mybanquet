<?php  
ob_start();

include("../config.php");
$comp_code=$_GET['comp_code'];

$checkDet=mysql_query("select vendor_code,vendor_name from company_master where vendor_code='$comp_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>