<?php  
ob_start();

include("../config.php");
$str_code = isset($_GET['str_code']) ? mysql_real_escape_string(trim($_GET['str_code'])) : '';

$checkDet = mysql_query("select str_code from bq_taxstruct where str_code='$str_code'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
