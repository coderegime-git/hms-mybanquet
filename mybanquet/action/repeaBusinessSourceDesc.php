<?php  
ob_start();

include("../config.php");
$source_desc=$_GET['source_desc'];


$checkDet=mysql_query("select source_desc from business_source where source_desc='$source_desc'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>