<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql="insert into bq_compmast(comp_code,comp_name,classf,cont_name,address1,address2,city,pin_code,country,state,phone,email,tin_number,iata_num,sales_exe,market_seg,sales_off,busin_src,room_nights,commission,credit,credit_limit,credit_days,black_list,remarks,food,beverage,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['comp_code']."',";
	$sql.="'".$_POST['comp_name']."',";
	$sql.="'".$_POST['classf']."',";
	$sql.="'".$_POST['cont_name']."',";
	$sql.="'".$_POST['address1']."',";
	$sql.="'".$_POST['address2']."',";
	$sql.="'".$_POST['city']."',";
	$sql.="'".$_POST['pin_code']."',";
	$sql.="'".$_POST['country']."',";
	$sql.="'".$_POST['state']."',";
	$sql.="'".$_POST['phone']."',";
	$sql.="'".$_POST['email']."',";
	$sql.="'".$_POST['tin_number']."',";
	$sql.="'".$_POST['iata_num']."',";
	$sql.="'".$_POST['sales_exe']."',";
	$sql.="'".$_POST['market_seg']."',";
	$sql.="'".$_POST['sales_off']."',";
	$sql.="'".$_POST['busin_src']."',";
	$sql.="'".$_POST['room_nights']."',";
	$sql.="'".$_POST['commission']."',";
	$sql.="'".$_POST['credit']."',";
	$sql.="'".$_POST['credit_limit']."',";
	$sql.="'".$_POST['credit_days']."',";
	$sql.="'".$_POST['black_list']."',";
	$sql.="'".$_POST['remarks']."',";
	$sql.="'".$_POST['food']."',";
	$sql.="'".$_POST['beverage']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/*   echo $sql;
die();  */

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/banquet/company_master_bqt.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/banquet/company_master_bqt.php?msg=Error in insertion');
}


?>