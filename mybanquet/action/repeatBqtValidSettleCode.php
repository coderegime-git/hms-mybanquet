<?php  
ob_start();

include("../config.php");
$outlet_code = isset($_GET['outlet_code']) ? mysql_real_escape_string(trim($_GET['outlet_code'])) : '';

$checkDet = mysql_query("select outlet_code from pos_validsettle where outlet_code='$outlet_code'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
