<?php  
ob_start();

include("../config.php");
$menu_name = isset($_GET['menu_name']) ? mysql_real_escape_string(trim($_GET['menu_name'])) : '';

$checkDet = mysql_query("select menu_name from bq_menugrp where menu_name='$menu_name'");

if ($checkDet && mysql_num_rows($checkDet) > 0) {
    echo 1;
} else {
    echo 0;
}
?>
