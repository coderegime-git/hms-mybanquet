<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE unitof_issue SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."uoi_code='".$_POST['uoi_code']."',";
$sqll=$sqll."uoi_desc='".$_POST['uoi_desc']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where uoi_id='".$_POST['uoi_id']."'";

/*   echo $sqll;
die(); */  

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/view-unitofissue-master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/view-unitofissue-master.php?msg='.$msg);	
}

?>