<?php  
ob_start();

include("../config.php");
$povcode=$_GET['povcode'];

$checkDet=mysql_query("select purposeofvisit_code from purposeof_visit where purposeofvisit_code='$povcode'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>