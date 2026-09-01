<?php  
ob_start();

include("../config.php");
$subcat_name = isset($_GET['subcat_name']) ? mysql_real_escape_string(trim($_GET['subcat_name'])) : '';

$checkDet = mysql_query("select subcat_name from bq_subcatitem where subcat_name='$subcat_name'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
