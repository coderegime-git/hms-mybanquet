<?php  
ob_start();

include("../config.php");
$itmCde=$_GET['itmCde'];

$checkDet=mysql_query("select item_code from bq_itemmaster where item_code='$itmCde'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>