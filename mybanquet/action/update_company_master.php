<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE company_master SET ";
$sqll=$sqll."vendor_code='".$_POST['comp_code']."',";
$sqll=$sqll."vendor_name='".$_POST['comp_name']."',";
$sqll=$sqll."cont_name='".$_POST['cont_name']."',";
$sqll=$sqll."service_tax='".$_POST['service_tax']."',";
$sqll=$sqll."address1='".$_POST['address1']."',";
$sqll=$sqll."address2='".$_POST['address2']."',";
$sqll=$sqll."city='".$_POST['city']."',";
$sqll=$sqll."state='".$_POST['state']."',";
$sqll=$sqll."country='".$_POST['country']."',";
$sqll=$sqll."pin_code='".$_POST['pin_code']."',";
$sqll=$sqll."phone='".$_POST['phone']."',";
$sqll=$sqll."email='".$_POST['email']."',";
$sqll=$sqll."tin_number='".$_POST['tin_number']."',";
$sqll=$sqll."busin_src='".$_POST['busin_src']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where company_id='".$_POST['company_id']."'";

/* echo $sqll;
die();  */ 

$resultt=mysql_query($sqll);

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/view_company_master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/view_company_master.php?msg='.$msg);	
}

?>