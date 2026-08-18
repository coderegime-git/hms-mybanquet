<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE guest_class SET ";
$sqll=$sqll."guestclass_code='".$_POST['guestclass_code']."',";
$sqll=$sqll."description='".$_POST['description']."',";
$sqll=$sqll."remarks='".$_POST['remarks']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where guestclass_id='".$_POST['guestclass_id']."'";

/*  echo $sqll;
die();  */  

$resultt=mysql_query($sqll);

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/guest-class.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/guest-class.php?msg='.$msg);	
}

?>