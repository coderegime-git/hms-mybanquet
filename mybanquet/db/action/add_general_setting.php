<?php  
session_start();
include("../config.php");
$added_on= date('Y-m-d H:i:s');
$added_by= $_SESSION['user'];

$file1 =$_FILES['header_img']['name'];
$upload1=$_SERVER['DOCUMENT_ROOT']."/myerp/img/headerimg/"; 
$target_path2 = $upload1 . basename( ($_FILES['header_img']['name']));
move_uploaded_file($_FILES['header_img']['tmp_name'], $target_path2);

$sqlSET=mysql_query("select * from setting");
if(mysql_num_rows($sqlSET)>0) {
	$sqlS="UPDATE setting SET ";
	$sqlS=$sqlS."company_code='".$_POST['company_code']."',";
	$sqlS=$sqlS."company_name='".$_POST['company_name']."',";
	$sqlS=$sqlS."address1='".$_POST['address1']."',";
	$sqlS=$sqlS."address2='".$_POST['address2']."',";
	$sqlS=$sqlS."city='".$_POST['city']."',";
	$sqlS=$sqlS."state='".$_POST['state']."',";
	$sqlS=$sqlS."pincode='".$_POST['pincode']."',";
	$sqlS=$sqlS."phone='".$_POST['phone']."',";
	$sqlS=$sqlS."email='".$_POST['email']."',";
	$sqlS=$sqlS."financial_year='".$_POST['financial_year']."',";
	$sqlS=$sqlS."header_image='".$file1."',";
	$sqlS=$sqlS."status='".$_POST['status']."'";
	$sqlS=$sqlS." where setting_id=". 1;
/* 	echo $sqlS;
	die(); */
	$resultS=mysql_query($sqlS);
	if($resultS){
	header('location:'.$home_path.'/masters/setting.php?msg=Data modified successfully!');
	}else{
	header('location:'.$home_path.'/masters/setting.php?msg=Error in updation');	
	}
	
}else{
	$sql="insert into setting (company_code,company_name,address1,address2,city,state,pincode,phone,email,financial_year,header_image,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['company_code']."',";
	$sql.="'".$_POST['company_name']."',";
	$sql.="'".$_POST['address1']."',";
	$sql.="'".$_POST['address2']."',";
	$sql.="'".$_POST['city']."',";
	$sql.="'".$_POST['state']."',";
	$sql.="'".$_POST['pincode']."',";
	$sql.="'".$_POST['phone']."',";
	$sql.="'".$_POST['email']."',";
	$sql.="'".$_POST['financial_year']."',";
	$sql.="'".$file1."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

	/* echo $sql;
	die(); */ 

	$UsQuery =mysql_query($sql);
	if($UsQuery){
	header('location:'.$home_path.'/masters/setting.php?msg=Data saved successfully!');
	}else{
	header('location:'.$home_path.'/masters/setting.php?msg=Error in insertion');	
	}
}
?>
