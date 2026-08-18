<?php
ob_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$fpno=$_GET['fpno'];
$val=$_GET['val'];

$updateData = mysql_query("UPDATE `bq_opfpmenudetail` SET `bill_status`='2' WHERE itemcode = "."'".$val."'"." AND fpno = "."'".$fpno."'"."");
?>