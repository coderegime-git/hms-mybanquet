<?php  
ob_start();

include("../config.php");
$roomDesc=$_GET['roomDesc'];

$checkDet=mysql_query("select room_desc from room_type where room_desc='$roomDesc'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>