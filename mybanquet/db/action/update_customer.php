<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$sqll="UPDATE client_master SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."client_type='".$_POST['client_type']."',";
$sqll=$sqll."client_code='".$_POST['client_code']."',";
$sqll=$sqll."client_name='".$_POST['client_name']."',";
$sqll=$sqll."contact_person='".$_POST['contact_person']."',";
$sqll=$sqll."phone='".$_POST['phone']."',";
$sqll=$sqll."email='".$_POST['email']."',";
$sqll=$sqll."fax='".$_POST['fax']."',";
$sqll=$sqll."baddress1='".$_POST['baddress1']."',";
$sqll=$sqll."baddress2='".$_POST['baddress2']."',";
$sqll=$sqll."bcity='".$_POST['bcity']."',";
$sqll=$sqll."bpincode='".$_POST['bpincode']."',";
$sqll=$sqll."bstate='".$_POST['bstate']."',";
$sqll=$sqll."bcountry='".$_POST['bcountry']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where client_id='".$_POST['client_id']."'";

/*   echo $sqll;
die(); */  

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/view-client-master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/view-client-master.php?msg='.$msg);	
}

?>