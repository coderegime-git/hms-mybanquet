<?php  
ob_start();

include("../config.php");
$itmName = isset($_GET['itmName']) ? mysql_real_escape_string(trim($_GET['itmName'])) : '';

$checkDet = mysql_query("select item_name from bq_itemmaster where item_name='$itmName'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
