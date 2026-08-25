<?php  
ob_start();

include("../config.php");
$segment_name = isset($_GET['segment_name']) ? mysql_real_escape_string(trim($_GET['segment_name'])) : '';

$checkDet = mysql_query("select msname from bq_marketseg where msname='$segment_name'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>