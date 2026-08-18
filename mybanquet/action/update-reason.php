<?php  
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE reasons SET ";
$sqll=$sqll."reason_code='".$_POST['reason_code']."',";
$sqll=$sqll."reason_desc='".$_POST['reason_desc']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where reason_id='".$_POST['reason_id']."'";

/* echo $sqll;
die();  */

$resultt=mysql_query($sqll);

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/reasons.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/reasons.php?msg='.$msg);	
}
?>