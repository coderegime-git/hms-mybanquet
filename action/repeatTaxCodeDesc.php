<?php  
ob_start();

include("../config.php");
$taxdesc=$_GET['taxDesc'];

$checkDet=mysql_query("select description from tax_type where description='$taxdesc'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
} 

?>