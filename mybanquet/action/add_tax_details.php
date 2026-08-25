<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlTx=mysql_query("select * from bq_taxdetail");
if(mysql_num_rows($sqlTx)>0){
	$sqll="UPDATE bq_taxdetail SET ";
	$sqll=$sqll."hall_tax='".$_POST['hall_tax']."',";
	$sqll=$sqll."food_tax='".$_POST['food_tax']."',";
	$sqll=$sqll."adv_tax='".$_POST['adv_tax']."'";
	$sqll=$sqll." where taxdet_id='1'";
	$UsQuery=mysql_query($sqll);
}else{
$sql="insert into bq_taxdetail(hall_tax,food_tax,adv_tax,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['hall_tax']."',";
	$sql.="'".$_POST['food_tax']."',";
	$sql.="'".$_POST['adv_tax']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
$UsQuery =mysql_query($sql);  
}

if($UsQuery){
header('location:'.$home_path.'/masters/banquet/view_tax_det.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/masters/banquet/view_tax_det.php?msg=Error in insertion');
}


?>