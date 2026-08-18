<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bq_subcatitem SET ";
$sqll=$sqll."subcat_code='".$_POST['subcat_code']."',";
$sqll=$sqll."subcat_name='".$_POST['subcat_name']."',";
$sqll=$sqll."cat_code='".$_POST['cat_code']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where subcat_id='".$_POST['subcat_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_subcateg_bqt.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_subcateg_bqt.php?msg='.$msg);	
}

?>