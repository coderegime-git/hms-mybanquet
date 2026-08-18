<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bq_submenugrp SET ";
$sqll=$sqll."submenu_code='".$_POST['submenu_code']."',";
$sqll=$sqll."submenu_name='".$_POST['submenu_name']."',";
$sqll=$sqll."subgrp_code='".$_POST['subgrp_code']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where submng_id='".$_POST['submng_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_submenuBqt_bqt.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_submenuBqt_bqt.php?msg='.$msg);	
}

?>