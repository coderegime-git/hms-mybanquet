<?php  
ob_start();

include("../config.php");
$tax_desc = isset($_GET['tax_desc']) ? mysql_real_escape_string(trim($_GET['tax_desc'])) : '';

$checkDet = mysql_query("select tax_desc from bq_taxmast where tax_desc='$tax_desc'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
