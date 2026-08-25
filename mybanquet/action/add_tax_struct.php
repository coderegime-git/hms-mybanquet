<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
$txCode=$_POST['tax_code'];


for($cc=0;$cc<count($txCode);$cc++){
if(isset($_POST['source'][$cc])	&& $_POST['source'][$cc]!=""){
	$source=$_POST['source'];
}
if(isset($_POST['source1'][$cc]) && $_POST['source1'][$cc]!=""){
	$source=$_POST['source1'];
}
if($_POST['tax_code'][$cc]!='' && $_POST['tax_desc'][$cc] && $_POST['factor'][$cc]!='' && $_POST['factor_value'][$cc] && $source!=''){
$sql="insert into bq_taxstruct(applicable_date,str_code,description,status,tax_code,tax_desc,factor,factor_value,source,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['applicable_date']."',";
	$sql.="'".$_POST['str_code']."',";
	$sql.="'".$_POST['description']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$_POST['tax_code'][$cc]."',";
	$sql.="'".$_POST['tax_desc'][$cc]."',";
	$sql.="'".$_POST['factor'][$cc]."',";
	$sql.="'".$_POST['factor_value'][$cc]."',";
	$sql.="'".$source[$cc]."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
	/*  echo $sql;
	 die(); */
$UsQuery =mysql_query($sql);
}
}
 
if($UsQuery){
	header('location:'.$home_path.'/masters/banquet/view-fotax-structure.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/banquet/view-fotax-structure.php?msg=Error in insertion');
}
	


?>