<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bqt_session SET ";
$sqll=$sqll."sess_code='".$_POST['sess_code']."',";
$sqll=$sqll."sess_name='".$_POST['sess_name']."',";
$sqll=$sqll."from_time='".$_POST['from_time']."',";
$sqll=$sqll."to_time='".$_POST['to_time']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where sess_id='".$_POST['sess_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_session_master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_session_master.php?msg='.$msg);	
}

?>