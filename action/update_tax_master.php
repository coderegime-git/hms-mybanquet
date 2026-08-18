<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE bq_taxmast SET ";
$sqll=$sqll."tax_code='".$_POST['tax_code']."',";
$sqll=$sqll."tax_desc='".$_POST['tax_desc']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where taxmast_id='".$_POST['taxmast_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_tax_mast.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_tax_mast.php?msg='.$msg);	
}

?>