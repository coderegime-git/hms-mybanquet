<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
/* echo $_SESSION['companyId'];
die(); */
$sql="insert into nsnnumber(company_id,nsnnumber,nsnname,added_by,added_on) values ('$_SESSION[companyId]','$_POST[nsnnumber]','$_POST[nsnname]','$added_by','$added_on')";
/*   echo $sql;
die();   */
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/nsnmaster.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/nsnmaster.php?msg=Error in insertion');
}


?>