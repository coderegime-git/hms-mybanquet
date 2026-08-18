<?php  
ob_start();

include("../config.php");
$roomfeature_code=$_GET['roomfeature_code'];

$checkDet=mysql_query("select roomfeature_code from roomfeatures where roomfeature_code='$roomfeature_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>