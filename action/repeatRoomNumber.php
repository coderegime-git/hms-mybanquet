<?php  
ob_start();

include("../config.php");
$roomNumber=$_GET['roomNumber'];

$checkDet=mysql_query("select room_number from room_master where room_number='$roomNumber'");
if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>