<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bq_seating SET ";
$sqll=$sqll."seat_code='".$_POST['seat_code']."',";
$sqll=$sqll."seat_desc='".$_POST['seat_desc']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where seat_id='".$_POST['seat_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_seating.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_seating.php?msg='.$msg);	
}

?>