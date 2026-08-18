<?php  
ob_start();

include("../config.php");
$room_code=$_GET['room_code'];

$checkDet=mysql_query("select room_code from room_type where room_code='$room_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>