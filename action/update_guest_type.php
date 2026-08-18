<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE guest_type SET ";
$sqll=$sqll."guesttype_code='".$_POST['guesttype_code']."',";
$sqll=$sqll."description='".$_POST['description']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where guesttype_id='".$_POST['guesttype_id']."'";

/* echo $sqll;
die(); */  

$resultt=mysql_query($sqll);

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/guest-type.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/guest-type.php?msg='.$msg);	
}

?>