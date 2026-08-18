<?php  

include("../config.php");
$baseCUr=$_GET['baseCUr'];
/* echo $native; */
$sql="select * from currency where base_currency='$baseCUr'";
$result=mysql_query($sql);
if (mysql_num_rows($result) > 0) {
	echo 1;
}
else {
	echo 0;
}



?>