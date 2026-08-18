<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bq_bankname SET ";
$sqll=$sqll."bank_code='".$_POST['bank_code']."',";
$sqll=$sqll."bank_name='".$_POST['bank_name']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where bank_id='".$_POST['bank_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_bank_name.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_bank_name.php?msg='.$msg);	
}

?>