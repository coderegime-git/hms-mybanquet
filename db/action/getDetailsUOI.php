<?php  
session_start();
include("../config.php");
$uoi_code=$_GET['uoi_code'];

$sql=mysql_query("select * from unitof_issue where uoi_code='$uoi_code'");
if (mysql_num_rows($sql) > 0) {
echo 1;
}
else {
echo 0;
}

?>