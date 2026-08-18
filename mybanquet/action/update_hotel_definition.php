<?php  
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqll="UPDATE property_definition SET ";
$sqll=$sqll."property_code='".$_POST['property_code']."',";
$sqll=$sqll."property_name='".$_POST['property_name']."',";
$sqll=$sqll."address1='".$_POST['address1']."',";
$sqll=$sqll."address2='".$_POST['address2']."',";
$sqll=$sqll."city='".$_POST['city']."',";
$sqll=$sqll."pincode='".$_POST['pincode']."',";
$sqll=$sqll."state='".$_POST['state']."',";
$sqll=$sqll."country='".$_POST['country']."',";
$sqll=$sqll."phone='".$_POST['phone']."',";
$sqll=$sqll."email='".$_POST['email']."',";
$sqll=$sqll."currency='".$_POST['currency']."',";
$sqll=$sqll."checkout_time='".$_POST['checkout_time']."',";
$sqll=$sqll."grace_time='".$_POST['grace_time']."',";
$sqll=$sqll."room_type='".$_POST['room_type']."',";
$sqll=$sqll."rack_table='".$_POST['rack_table']."',";
$sqll=$sqll."market_segment='".$_POST['market_segment']."',";
$sqll=$sqll."business_source='".$_POST['business_source']."',";
$sqll=$sqll."meal_plan='".$_POST['meal_plan']."',";
$sqll=$sqll."pay_mode='".$_POST['pay_mode']."',";
$sqll=$sqll."date_format='".$_POST['date_format']."',";
$sqll=$sqll."qty_decimals='".$_POST['qty_decimals']."',";
$sqll=$sqll."rate_decimals='".$_POST['rate_decimals']."',";
$sqll=$sqll."start_date='".$_POST['start_date']."',";
$sqll=$sqll."early_checkin='".$_POST['early_checkin']."',";
$sqll=$sqll."tin_number='".$_POST['tin_number']."',";
$sqll=$sqll."sertax_number='".$_POST['sertax_number']."',";
$sqll=$sqll."luxtax_number='".$_POST['luxtax_number']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where property_id='".$_POST['property_id']."'";

$resultt=mysql_query($sqll);
/*  echo $sqll;
die(); */  

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/update-hotel-definition.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/update-hotel-definition.php?msg='.$msg);	
}

?>