<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$file1 =$_FILES['header_img']['name'];
$upload1=$_SERVER['DOCUMENT_ROOT']."/myerp/img/headerimg/"; 
$target_path2 = $upload1 . basename( ($_FILES['header_img']['name']));
move_uploaded_file($_FILES['header_img']['tmp_name'], $target_path2);

$sqll="UPDATE property_master SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."prop_code='".$_POST['prop_code']."',";
$sqll=$sqll."prop_name='".$_POST['prop_name']."',";
$sqll=$sqll."cst='".$_POST['cst']."',";
$sqll=$sqll."tin='".$_POST['tin']."',";
$sqll=$sqll."ie_code='".$_POST['ie_code']."',";
$sqll=$sqll."ritc_code='".$_POST['ritc_code']."',";
$sqll=$sqll."draw_code='".$_POST['draw_code']."',";
$sqll=$sqll."prefix='".strtoupper($_POST['prefix'])."',";
$sqll=$sqll."address1='".$_POST['address1']."',";
$sqll=$sqll."address2='".$_POST['address2']."',";
$sqll=$sqll."city='".$_POST['city']."',";
$sqll=$sqll."pincode='".$_POST['pincode']."',";
$sqll=$sqll."state='".$_POST['state']."',";
$sqll=$sqll."country='".$_POST['country']."',";
$sqll=$sqll."phone='".$_POST['phone']."',";
$sqll=$sqll."email='".$_POST['email']."',";
$sqll=$sqll."header_image='".$file1."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where propmaster_id='".$_POST['propmaster_id']."'";

/*   echo $sqll;
die(); */  

$resultt=mysql_query($sqll);


if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/view-property-master.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/view-property-master.php?msg='.$msg);	
}

?>