<?php  
ob_start();

include("../config.php");
$cat_code = isset($_GET['cat_code']) ? mysql_real_escape_string(trim($_GET['cat_code'])) : '';

$checkDet = mysql_query("select cat_code from bq_itemcat where cat_code='$cat_code'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
