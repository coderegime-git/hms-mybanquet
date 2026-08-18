<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE property_definition SET ";
$sqll=$sqll."prop_code='".$_POST['prop_code']."',";
$sqll=$sqll."prop_name='".$_POST['prop_name']."',";
$sqll=$sqll."address1='".$_POST['address1']."',";
$sqll=$sqll."address2='".$_POST['address2']."',";
$sqll=$sqll."city='".$_POST['city']."',";
$sqll=$sqll."pin_code='".$_POST['pin_code']."',";
$sqll=$sqll."country='".$_POST['country']."',";
$sqll=$sqll."state='".$_POST['state']."',";
$sqll=$sqll."phone='".$_POST['phone']."',";
$sqll=$sqll."email='".$_POST['email']."',";
$sqll=$sqll."tin_number='".$_POST['tin_number']."',";
$sqll=$sqll."service_tax='".$_POST['service_tax']."',";
$sqll=$sqll."billing='".$_POST['billing']."',";
$sqll=$sqll."pre_text='".$_POST['pre_text']."',";
$sqll=$sqll."round_off='".$_POST['round_off']."',";
$sqll=$sqll."rnd_value='".$_POST['rnd_value']."',";
$sqll=$sqll."financial_year='".$_POST['financial_year']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where propdef_id='".$_POST['propdef_id']."'";

/*  echo $sqll;
die();  */

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/view-prop-definit.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/view-prop-definit.php?msg='.$msg);	
}

?>