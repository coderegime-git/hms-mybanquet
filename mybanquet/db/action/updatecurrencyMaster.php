<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql=mysql_query("select * from currency_master where currency_default='".$_POST['currency_default']."'");
$nmRows=mysql_num_rows($sql);
if($nmRows>0){
	if($_POST['currency_default']!=1){
		$sqll="UPDATE currency_master SET ";
		$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
		$sqll=$sqll."currency_code='".$_POST['currency_code']."',";
		$sqll=$sqll."currency_desc='".$_POST['currency_desc']."',";
		$sqll=$sqll."conversion_rate='".$_POST['conversion_rate']."',";
		$sqll=$sqll."currency_default='".$_POST['currency_default']."',";
		$sqll=$sqll."status='".$_POST['status']."',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where currency_id='".$_POST['currency_id']."'";
		$resultt=mysql_query($sqll);
			if($resultt){
			$msg='Data modified successfully!';
			header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);
			}else{
			$msg='Error in updation';
			header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);	
			}
	}else{
		$msg='Currency Default already set';
		header('location:'.$home_path.'/masters/update-currency-master.php?msg='.$msg);
	}
}else{
	$sqll="UPDATE currency_master SET ";
	$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
	$sqll=$sqll."currency_code='".$_POST['currency_code']."',";
	$sqll=$sqll."currency_desc='".$_POST['currency_desc']."',";
	$sqll=$sqll."conversion_rate='".$_POST['conversion_rate']."',";
	$sqll=$sqll."currency_default='".$_POST['currency_default']."',";
	$sqll=$sqll."status='".$_POST['status']."',";
	$sqll=$sqll."added_by='".$added_by."',";
	$sqll=$sqll."added_on='".$added_on."'";
	$sqll=$sqll." where currency_id='".$_POST['currency_id']."'";
	
	$resut=mysql_query($sqll);

	if($resut){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);	
	}
	
}


/* if($_POST['currency_default']=='0'){
	$sqll="UPDATE currency_master SET ";
	$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
	$sqll=$sqll."currency_code='".$_POST['currency_code']."',";
	$sqll=$sqll."currency_desc='".$_POST['currency_desc']."',";
	$sqll=$sqll."conversion_rate='".$_POST['conversion_rate']."',";
	$sqll=$sqll."currency_default='".$_POST['currency_default']."',";
	$sqll=$sqll."status='".$_POST['status']."',";
	$sqll=$sqll."added_by='".$added_by."',";
	$sqll=$sqll."added_on='".$added_on."'";
	$sqll=$sqll." where currency_id='".$_POST['currency_id']."'";
	
	$resut=mysql_query($sqll);

	if($resut){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);	
	}
} */




/* if($nmRows>0){
	$msg='Currency Default already set';
	header('location:'.$home_path.'/masters/update-currency-master.php?msg='.$msg);
}else{
	$sqll="UPDATE currency_master SET ";
	$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
	$sqll=$sqll."currency_code='".$_POST['currency_code']."',";
	$sqll=$sqll."currency_desc='".$_POST['currency_desc']."',";
	$sqll=$sqll."conversion_rate='".$_POST['conversion_rate']."',";
	$sqll=$sqll."currency_default='".$_POST['currency_default']."',";
	$sqll=$sqll."status='".$_POST['status']."',";
	$sqll=$sqll."added_by='".$added_by."',";
	$sqll=$sqll."added_on='".$added_on."'";
	$sqll=$sqll." where currency_id='".$_POST['currency_id']."'";
	
	$resultt=mysql_query($sqll);

	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);	
	}
}

if($_POST['currency_default']=='0'){
	
	$sqll="UPDATE currency_master SET ";
	$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
	$sqll=$sqll."currency_code='".$_POST['currency_code']."',";
	$sqll=$sqll."currency_desc='".$_POST['currency_desc']."',";
	$sqll=$sqll."conversion_rate='".$_POST['conversion_rate']."',";
	$sqll=$sqll."currency_default='".$_POST['currency_default']."',";
	$sqll=$sqll."status='".$_POST['status']."',";
	$sqll=$sqll."added_by='".$added_by."',";
	$sqll=$sqll."added_on='".$added_on."'";
	$sqll=$sqll." where currency_id='".$_POST['currency_id']."'";

	$resultt=mysql_query($sqll);


	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/masters/view-currency-master.php?msg='.$msg);	
	}
	
} */


?>