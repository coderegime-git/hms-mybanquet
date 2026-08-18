<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bq_itemcat SET ";
$sqll=$sqll."cat_code='".$_POST['cat_code']."',";
$sqll=$sqll."cat_name='".$_POST['cat_name']."',";
$sqll=$sqll."grp_name='".$_POST['grp_name']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where itemcat_id='".$_POST['itemcat_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_categ_bqt.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_categ_bqt.php?msg='.$msg);	
}

?>