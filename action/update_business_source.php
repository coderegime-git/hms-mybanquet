<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bq_bssource SET ";
$sqll=$sqll."bs_code='".$_POST['bs_code']."',";
$sqll=$sqll."bs_name='".$_POST['bs_name']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where bssrc_id='".$_POST['bssrc_id']."'";

/*  echo $sqll;
die();   */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_business_source.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_business_source.php?msg='.$msg);	
}

?>