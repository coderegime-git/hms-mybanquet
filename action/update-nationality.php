<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE nationality SET ";
$sqll=$sqll."nationality_code='".$_POST['nationality_code']."',";
$sqll=$sqll."country='".$_POST['country']."',";
$sqll=$sqll."native='".$_POST['native']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where nationality_id='".$_POST['nationality_id']."'";

/* echo $sqll;
die();  */ 

$resultt=mysql_query($sqll);

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/nationality.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/nationality.php?msg='.$msg);	
}

?>