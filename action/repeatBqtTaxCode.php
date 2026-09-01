<?php  
ob_start();

include("../config.php");
$tax_code = isset($_GET['tax_code']) ? mysql_real_escape_string(trim($_GET['tax_code'])) : '';

$checkDet = mysql_query("select tax_code from bq_taxmast where tax_code='$tax_code'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
