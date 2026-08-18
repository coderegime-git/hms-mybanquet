<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sess=$_GET['sess'];

/* echo $bid; */

$sqlb=mysql_query("select * from bqt_session where sess_code='".$sess."'");
$rowb=mysql_fetch_array($sqlb);

echo $rowb['from_time'].','.$rowb['to_time'];

?>