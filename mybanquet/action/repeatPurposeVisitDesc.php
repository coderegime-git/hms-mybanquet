povcode<?php  
ob_start();

include("../config.php");
$povdesc=$_GET['povdesc'];

$checkDet=mysql_query("select purposeofvisit_desc from purposeof_visit where purposeofvisit_desc='$povdesc'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>