<?php  
ob_start();

include("../config.php");
$taxCode=$_GET['taxCode'];

$checkDet=mysql_query("select tax_code from tax_type where tax_code='$taxCode'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
} 

?>