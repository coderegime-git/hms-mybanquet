<?php  
ob_start();
session_start();
include("../config.php");
$str_code=$_GET['str_code'];

$checkDet=mysql_query("select str_code from tax_structure where str_code='$str_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>