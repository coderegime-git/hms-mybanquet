<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bq_venue SET ";
$sqll=$sqll."venue_code='".$_POST['venue_code']."',";
$sqll=$sqll."venue_desc='".$_POST['venue_desc']."',";
$sqll=$sqll."location='".$_POST['location']."',";
$sqll=$sqll."length='".$_POST['length']."',";
$sqll=$sqll."breadth='".$_POST['breadth']."',";
$sqll=$sqll."height='".$_POST['height']."',";
$sqll=$sqll."area='".$_POST['area']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where venue_id='".$_POST['venue_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_venue_master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_venue_master.php?msg='.$msg);	
}

?>