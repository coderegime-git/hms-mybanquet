<?php  
ob_start();

include("../config.php");
$added_on = date('Y-m-d H:i:s');
$added_by = isset($_SESSION['user']) ? $_SESSION['user'] : 'admin';

$msid = isset($_POST['msid']) ? mysql_real_escape_string(trim($_POST['msid'])) : '';
$segment_code = isset($_POST['segment_code']) ? strtoupper(mysql_real_escape_string(trim($_POST['segment_code']))) : '';
$segment_name = isset($_POST['segment_name']) ? mysql_real_escape_string(trim($_POST['segment_name'])) : '';
$status = isset($_POST['status']) ? mysql_real_escape_string(trim($_POST['status'])) : '1';

if($msid != '' && $segment_name != '') {
    $sqll = "UPDATE bq_marketseg SET ";
    $sqll .= "mscode='$segment_code', ";
    $sqll .= "msname='$segment_name', ";
    $sqll .= "status='$status', ";
    $sqll .= "added_by='$added_by', ";
    $sqll .= "added_on='$added_on' ";
    $sqll .= "WHERE marseg_id='$msid'";

    $resultt = mysql_query($sqll);

    if($resultt){
        $msg = 'Data modified successfully!';
        header('location:'.$home_path.'/masters/banquet/view_market_segment.php?msg='.$msg);
        exit;
    } else {
        $msg = 'Error in updation';
        header('location:'.$home_path.'/masters/banquet/view_market_segment.php?msg='.$msg);
        exit;
    }
} else {
    header('location:'.$home_path.'/masters/banquet/view_market_segment.php?msg=Invalid Request');
    exit;
}
?>