<?php  
ob_start();

include("../config.php");
$Topcode=$_GET['Topcode'];
/* 
echo "select tob_code from type_ofbilling where tob_code='$Topcode'"; */
$checkDet=mysql_query("select tob_code from type_ofbilling where tob_code='$Topcode'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>