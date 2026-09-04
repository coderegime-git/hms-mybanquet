<?php
ob_start();
include("../config.php");
include("../util.php");

$added_on = date('Y-m-d H:i:s');
$added_by = isset($_SESSION['user']) ? $_SESSION['user'] : 'admin';

if(isset($_POST['hallbook_id']) && $_POST['hallbook_id'] != '') {
    $hallbook_id = (int)$_POST['hallbook_id'];
    $book_date   = mysql_real_escape_string($_POST['book_date']);
    $venue       = mysql_real_escape_string($_POST['venue']);
    $session     = mysql_real_escape_string($_POST['session']);
    $from_time   = mysql_real_escape_string($_POST['from_time']);
    $to_time     = mysql_real_escape_string($_POST['to_time']);
    $remarks     = isset($_POST['remarks']) ? mysql_real_escape_string($_POST['remarks']) : '';

    // Fetch existing booking
    $sqOld = mysql_query("select booking_no from bq_hallbooking where hallbook_id='$hallbook_id'");
    $rowOld = ($sqOld && mysql_num_rows($sqOld) > 0) ? mysql_fetch_array($sqOld) : array();
    $booking_no = isset($rowOld['booking_no']) ? $rowOld['booking_no'] : '';

    $sqlUp = "UPDATE bq_hallbooking SET 
                book_date = '$book_date',
                venue = '$venue',
                session = '$session',
                from_time = '$from_time',
                to_time = '$to_time',
                remarks = '$remarks',
                added_by = '$added_by',
                added_on = '$added_on'
              WHERE hallbook_id = '$hallbook_id'";

    $resUp = mysql_query($sqlUp);

    // Refresh bq_dashhall slots
    mysql_query("DELETE FROM bq_dashhall WHERE hallbook_id='$hallbook_id'");

    $sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
    $rowAC = ($sqlAC && mysql_num_rows($sqlAC) > 0) ? mysql_fetch_array($sqlAC) : array();
    $curDate = isset($rowAC['cur_date']) ? $rowAC['cur_date'] : date('d/m/Y');

    $st = explode(':', $from_time); 
    $str = isset($st[0]) ? (int)$st[0] : 0;
    $en = explode(':', $to_time); 
    $enr = isset($en[0]) ? (int)$en[0] : 0;

    for($sT = $str; $sT <= $enr; $sT++) {
        $sqAR = "INSERT INTO bq_dashhall (audit_date, funtion_date, booking_no, hallbook_id, venue, session, from_time, to_time, hour, confirm_status, status, added_by, added_on)
                 VALUES ('$curDate', '$book_date', '$booking_no', '$hallbook_id', '$venue', '$session', '$from_time', '$to_time', '$sT', '6', '1', '$added_by', '$added_on')";
        mysql_query($sqAR); 
    }

    if($resUp) {
        header('Location: ' . $home_path . '/transaction/frontdesk/view-block-hall.php?msg=Block Hall updated successfully!');
        exit;
    } else {
        header('Location: ' . $home_path . '/transaction/frontdesk/view-block-hall.php?msg=Error in updating Block Hall');
        exit;
    }
} else {
    header('Location: ' . $home_path . '/transaction/frontdesk/view-block-hall.php');
    exit;
}
?>
