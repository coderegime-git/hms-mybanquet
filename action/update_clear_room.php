<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$room_no=$_POST['room_no'];

for($cc=0;$cc<count($room_no);$cc++){
$sqll="UPDATE room_master SET ";
$sqll=$sqll."occupy_status='".$_POST['room_status'][$cc]."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where room_number='".$_POST['room_no'][$cc]."'";

/*  echo $sqll;
die();  */  

$resultt=mysql_query($sqll);
}

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/transaction/frontdesk/clear_room.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/transaction/frontdesk/clear_room.php?msg='.$msg);	
}

?>