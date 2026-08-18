<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$amitmCde=$_GET['amitmCde'];

/* $sqlm=mysql_query("select item_name,item_rate from bq_itemmaster where item_code='".$amitmCde."' AND status='1' AND itmsub_cat='oth'"); */
$sqlm=mysql_query("select item_code,item_name,item_rate from bq_itemmaster where item_code='".$amitmCde."' AND status='1'");
$row=mysql_fetch_array($sqlm);

echo $row['item_code'].','.$row['item_rate'];

?>