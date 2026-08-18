<?php  
ob_start();

include("../config.php");
$source_code=$_GET['source_code'];

$checkDet=mysql_query("select source_code from business_source where source_code='$source_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>