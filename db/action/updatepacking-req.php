<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE packing_requirements SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."packing_heading='".strtoupper($_POST['packing_heading'])."',";
$sqll=$sqll."packing_code='".strtoupper($_POST['packing_code'])."',";
$sqll=$sqll."packing_req='".$_POST['packing_req']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where packreq_id='".$_POST['packreq_id']."'";
/* 
  echo $sqll;
die();  */  

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/view-packing_requirements.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/view-packing_requirements.php?msg='.$msg);	
}

?>