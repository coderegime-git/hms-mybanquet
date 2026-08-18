<?php  
ob_start();
session_start();
include("../config.php");
$nsnNo=$_GET['nsnNo'];

$result=mysql_query("select * from partnumber where nsnnumber='$nsnNo'");
if (mysql_num_rows($result) > 0) {
	echo 1;
}
else{
	echo 0;
}

?>