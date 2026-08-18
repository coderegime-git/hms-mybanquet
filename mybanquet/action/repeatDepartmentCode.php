<?php  
ob_start();

include("../config.php");
$dept_code=$_GET['dept_code'];

$checkDet=mysql_query("select deptcode from bqt_mas_department where deptcode='$dept_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>