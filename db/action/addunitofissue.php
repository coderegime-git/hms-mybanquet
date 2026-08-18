<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into unitof_issue(company_id,uoi_code,uoi_desc,status,added_by,added_on) values ('$_SESSION[companyId]','$_POST[uoi_code]','$_POST[uoi_desc]','$_POST[status]','$added_by','$added_on')";
/*   echo $sql;
die();   */
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/unitofissue.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/unitofissue.php?msg=Error in insertion');
}


?>