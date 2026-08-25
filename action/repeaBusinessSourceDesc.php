<?php  
ob_start();

include("../config.php");
$source_desc = isset($_GET['source_desc']) ? mysql_real_escape_string($_GET['source_desc']) : '';

$checkDet = mysql_query("select bs_name from bq_bssource where bs_name='$source_desc'");

if ($checkDet && is_resource($checkDet) && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>