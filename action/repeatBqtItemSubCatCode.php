<?php  
ob_start();

include("../config.php");
$subcat_code = isset($_GET['subcat_code']) ? mysql_real_escape_string(trim($_GET['subcat_code'])) : '';

$checkDet = mysql_query("select subcat_code from bq_subcatitem where subcat_code='$subcat_code'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
