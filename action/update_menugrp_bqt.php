<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bq_menugrp SET ";
$sqll=$sqll."menu_code='".$_POST['menu_code']."',";
$sqll=$sqll."menu_name='".$_POST['menu_name']."',";
$sqll=$sqll."disp_order='".$_POST['disp_order']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where menugrp_id='".$_POST['menugrp_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_menugrp_bqt.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_menugrp_bqt.php?msg='.$msg);	
}

?>