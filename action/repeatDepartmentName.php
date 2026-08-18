<?php  
ob_start();

include("../config.php");
$dept_name=$_GET['dept_name'];


$checkDet=mysql_query("select deptname from bqt_mas_department where deptname='$dept_name'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>