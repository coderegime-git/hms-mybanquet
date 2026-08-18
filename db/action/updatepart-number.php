<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE partnumber SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."nsnnumber='".strtoupper($_POST['nsnnumber'])."',";
$sqll=$sqll."partnumber='".strtoupper($_POST['partnumber'])."',";
$sqll=$sqll."partname='".strtoupper($_POST['partname'])."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where partno_id='".$_POST['partno_id']."'";
/* 
  echo $sqll;
die();  */  

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/view-partnumber-master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/view-partnumber-master.php?msg='.$msg);	
}

?>