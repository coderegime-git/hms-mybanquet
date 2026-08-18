<?php  
session_start();
include("../config.php");
$property_code=$_GET['propCode'];

$checkDet=mysql_query("select prop_code from property_master where prop_code='$property_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>