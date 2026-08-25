<?php
ob_start();
session_start();
include("../config.php");

$added_on = date('Y-m-d H:i:s');
$added_by = isset($_SESSION['user']) ? $_SESSION['user'] : '';

$bs_code = isset($_POST['bs_code']) ? mysql_real_escape_string(trim($_POST['bs_code'])) : '';
$bs_name = isset($_POST['bs_name']) ? mysql_real_escape_string(trim($_POST['bs_name'])) : '';
$status  = isset($_POST['status']) ? mysql_real_escape_string($_POST['status']) : '1';

if($bs_code == '' || $bs_name == '') {
    header('location:'.$home_path.'/masters/banquet/view_business_source.php?msg=Please fill in required fields!');
    exit();
}

$sql = "INSERT INTO bq_bssource(bs_code, bs_name, status, added_by, added_on) 
        VALUES('$bs_code', '$bs_name', '$status', '$added_by', '$added_on')";

$UsQuery = mysql_query($sql);
if($UsQuery){
    header('location:'.$home_path.'/masters/banquet/view_business_source.php?msg=Data saved Successfully!');
} else {
    header('location:'.$home_path.'/masters/banquet/view_business_source.php?msg=Error in insertion');
}
exit();
?>