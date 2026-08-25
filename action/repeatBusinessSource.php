<?php  
ob_start();

include("../config.php");
$source_code = isset($_GET['source_code']) ? mysql_real_escape_string($_GET['source_code']) : '';

$checkDet = mysql_query("select bs_code from bq_bssource where bs_code='$source_code'");

if ($checkDet && is_resource($checkDet) && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>