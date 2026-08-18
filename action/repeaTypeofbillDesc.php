<?php  
ob_start();

include("../config.php");
$topDesc=$_GET['topDesc'];

$checkDet=mysql_query("select tob_desc from type_ofbilling where tob_desc='$topDesc'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>