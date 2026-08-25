<?php
ob_start();

include("../config.php");
$added_on = date('Y-m-d H:i:s');
$added_by = isset($_SESSION['user']) ? $_SESSION['user'] : 'admin';

$mscode = isset($_POST['mscode']) ? strtoupper(mysql_real_escape_string(trim($_POST['mscode']))) : '';
$msname = isset($_POST['msname']) ? mysql_real_escape_string(trim($_POST['msname'])) : '';
$status = isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '1';

if($mscode != '' && $msname != '') {
    $sql = "INSERT INTO bq_marketseg (mscode, msname, status, added_by, added_on) VALUES ('$mscode', '$msname', '$status', '$added_by', '$added_on')";
    $UsQuery = mysql_query($sql);

    if($UsQuery){
        header('location:'.$home_path.'/masters/banquet/view_market_segment.php?msg=Data saved Successfully!');
        exit;
    } else {
        header('location:'.$home_path.'/masters/banquet/view_market_segment.php?msg=Error in insertion');
        exit;
    }
} else {
    header('location:'.$home_path.'/masters/banquet/view_market_segment.php?msg=Please fill in all required fields');
    exit;
}
?>