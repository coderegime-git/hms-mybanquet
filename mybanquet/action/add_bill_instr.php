<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_billinstruc(bill_code,bill_desc,status,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$_POST['bill_code']."',";
	 $sql.="'".$_POST['bill_desc']."',";
	 $sql.="'".$_POST['status']."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
/* echo $sql;
die(); */ 
$UsQuery =mysql_query($sql);


if($UsQuery){
header('location:'.$home_path.'/masters/banquet/view_bill_inst.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/banquet/view_bill_inst.php?msg=Error in insertion');
}


?>