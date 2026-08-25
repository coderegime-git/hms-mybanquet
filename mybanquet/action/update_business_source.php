<?php
ob_start();
session_start();
include("../config.php");

$added_on = date('Y-m-d H:i:s');
$added_by = isset($_SESSION['user']) ? $_SESSION['user'] : '';

$bssrc_id = isset($_POST['bssrc_id']) ? mysql_real_escape_string($_POST['bssrc_id']) : '';
$bs_code  = isset($_POST['bs_code']) ? mysql_real_escape_string(trim($_POST['bs_code'])) : '';
$bs_name  = isset($_POST['bs_name']) ? mysql_real_escape_string(trim($_POST['bs_name'])) : '';
$status   = isset($_POST['status']) ? mysql_real_escape_string($_POST['status']) : '1';

if($bssrc_id == '' || $bs_name == '') {
    header('location:'.$home_path.'/masters/banquet/view_business_source.php?msg=Please fill in required fields!');
    exit();
}

$sqll = "UPDATE bq_bssource SET 
            bs_name='$bs_name',
            status='$status',
            added_by='$added_by',
            added_on='$added_on' 
         WHERE bssrc_id='$bssrc_id'";

$resultt = mysql_query($sqll);

if($resultt){
    $msg = 'Data modified successfully!';
} else {
    $msg = 'Error in updation';
}
header('location:'.$home_path.'/masters/banquet/view_business_source.php?msg='.$msg);
exit();
?>