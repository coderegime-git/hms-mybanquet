<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE payment_mode SET ";
$sqll=$sqll."payment_mode='".$_POST['payment_mode']."',";
$sqll=$sqll."description='".$_POST['description']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where paymode_id='".$_POST['paymode_id']."'";

/*  echo $sqll;
die();  */  

$resultt=mysql_query($sqll);

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/paymode-fom.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/paymode-fom.php?msg='.$msg);	
}

?>