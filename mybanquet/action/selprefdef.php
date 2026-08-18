<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$pref=$_GET['pref'];

 echo $pref; 
 
?>
