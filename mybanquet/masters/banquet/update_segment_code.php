<?php  
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bqt_mas_mrkseg SET ";
$sqll=$sqll."mscode='".$_POST['segment_code']."',";
$sqll=$sqll."msname='".$_POST['segment_name']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."cby='".$added_by."',";
$sqll=$sqll."con='".$added_on."'";
$sqll=$sqll." where msid='".$_POST['msid']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/market-segment-master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/market-segment-master.php?msg='.$msg);	
}

?>