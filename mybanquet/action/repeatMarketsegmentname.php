<?php  
ob_start();

include("../config.php");
$segment_name=$_GET['segment_name'];

$checkDet=mysql_query("select msname from bqt_mas_mrkseg where msname='$segment_name'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>