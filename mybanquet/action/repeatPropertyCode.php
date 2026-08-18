<?php  

include("../config.php");
$propCode=$_GET['propCode'];

$checkDet=mysql_query("select prop_code from property_definition where prop_code='$propCode'");
if (mysql_num_rows($checkDet) > 0) {
	echo 1;
}
else {
	echo 0;
}

?>