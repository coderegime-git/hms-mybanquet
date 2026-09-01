<?php  
ob_start();

include("../config.php");
$cat_name = isset($_GET['cat_name']) ? mysql_real_escape_string(trim($_GET['cat_name'])) : '';

$checkDet = mysql_query("select cat_name from bq_itemcat where cat_name='$cat_name'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
