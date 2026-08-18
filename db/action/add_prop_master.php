<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$file1 =$_FILES['header_img']['name'];
$upload1=$_SERVER['DOCUMENT_ROOT']."/myerp/img/headerimg/"; 
$target_path2 = $upload1 . basename( ($_FILES['header_img']['name']));
move_uploaded_file($_FILES['header_img']['tmp_name'], $target_path2);

$sql="insert into property_master(company_id,prop_code,cst,tin,ie_code,ritc_code,draw_code,prefix,prop_name,address1,address2,city,pincode,state,country,phone,email,header_image,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['prop_code']."',";
	$sql.="'".$_POST['prop_name']."',";
	$sql.="'".$_POST['cst']."',";
	$sql.="'".$_POST['tin']."',";
	$sql.="'".$_POST['ie_code']."',";
	$sql.="'".$_POST['ritc_code']."',";
	$sql.="'".$_POST['draw_code']."',";
	$sql.="'".strtoupper($_POST['prefix'])."',";
	$sql.="'".$_POST['address1']."',";
	$sql.="'".$_POST['address2']."',";
	$sql.="'".$_POST['city']."',";
	$sql.="'".$_POST['pincode']."',";
	$sql.="'".$_POST['state']."',";
	$sql.="'".$_POST['country']."',";
	$sql.="'".$_POST['phone']."',";
	$sql.="'".$_POST['email']."',";
	$sql.="'".$file1."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/*  echo $sql;
die();   */
$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/view-property-master.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/view-property-master.php?msg=Error in insertion');
}


?>