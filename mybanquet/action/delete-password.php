<?php

include("../config.php");
$added_on= date('Y-m-d H:i:s');
$suser=$_SESSION['user'];

$sql="delete from user";
$sql=$sql." where user_id=".$_GET['userId'];

$result=mysql_query($sql);

$msg=" $suser Username Deleted.";
header('location:'.$home_path.'/admin/admin/change-password.php?msg='.$msg); 

?>
