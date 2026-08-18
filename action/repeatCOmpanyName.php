<?php  
ob_start();

include("../config.php");
$comp_name=$_GET['comp_name'];

$checkDet=mysql_query("select vendor_code,vendor_name from company_master where vendor_name='$comp_name'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>