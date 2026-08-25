<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bqt_session(sess_code,sess_name,from_time,to_time,status,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$_POST['sess_code']."',";
	 $sql.="'".$_POST['sess_name']."',";
	 $sql.="'".$_POST['from_time']."',";
	 $sql.="'".$_POST['to_time']."',";
	 $sql.="'".$_POST['status']."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
 /* echo $sql;
die(); */ 
$UsQuery =mysql_query($sql);

if($UsQuery){
header('location:'.$home_path.'/masters/banquet/view_session_master.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/banquet/view_session_master.php?msg=Error in insertion');
}


?>