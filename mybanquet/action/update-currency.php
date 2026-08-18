<?php  
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE currency SET ";
$sqll=$sqll."currency_code='".$_POST['currency_code']."',";
$sqll=$sqll."currency_desc='".$_POST['currency_desc']."',";
$sqll=$sqll."base_currency='".$_POST['base_currency']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where currency_id='".$_POST['currency_id']."'";
  echo $sqll;
die(); 
$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/view_currency.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/view_currency.php?msg='.$msg);	
}
?>