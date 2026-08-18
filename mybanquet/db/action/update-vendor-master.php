<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE vendor_master SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."vendor_code='".$_POST['vendor_code']."',";
$sqll=$sqll."vendor_name='".$_POST['vendor_name']."',";
$sqll=$sqll."contact_person='".$_POST['contact_person']."',";
$sqll=$sqll."contact_number='".$_POST['contact_number']."',";
$sqll=$sqll."address1='".$_POST['address1']."',";
$sqll=$sqll."address2='".$_POST['address2']."',";
$sqll=$sqll."city='".$_POST['city']."',";
$sqll=$sqll."pincode='".$_POST['pincode']."',";
$sqll=$sqll."state='".$_POST['state']."',";
$sqll=$sqll."country='".$_POST['country']."',";
$sqll=$sqll."phone='".$_POST['phone']."',";
$sqll=$sqll."email='".$_POST['email']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where vendor_id='".$_POST['vendor_id']."'";

 /*  echo $sqll;
die();  */  

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/view-vendor-master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/view-vendor-master.php?msg='.$msg);	
}

?>