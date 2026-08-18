<?php  
ob_start();

include("../config.php");
$guest_code=$_GET['guest_code'];

$checkDet=mysql_query("select guestclass_code from guest_class where guestclass_code='$guest_code'");

if (mysql_num_rows($checkDet) > 0) {
echo 1;
}
else {
echo 0;
}

?>