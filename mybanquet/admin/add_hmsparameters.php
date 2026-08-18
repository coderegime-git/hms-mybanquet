<?php
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$description=$_POST['description'];

$sqlP=mysql_query("select * from hms_parameters where module_name='".$_POST['module_name']."'");
if(mysql_num_rows($sqlP)==0){
	for($cc=0;$cc<count($description);$cc++){
		$sql="insert into hms_parameters(module_name,description,status,applicable_date,added_by,added_on)";
			$sql.=" values(";
			$sql.="'".$_POST['module_name']."',";
			$sql.="'".$_POST['description'][$cc]."',";
			$sql.="'".$_POST['status'][$cc]."',";
			$sql.="'".$_POST['applicable_date'][$cc]."',";
			$sql.="'".$added_by."',";
			$sql.="'".$added_on."')";

		$UsQuery =mysql_query($sql);
		if($UsQuery){
			header('location:'.$home_path.'/admin/update_parameters.php?msg=Data saved Successfully!');
		}
		else{
			header('location:'.$home_path.'/admin/update_parameters.php?msg=Error in insertion');
		}
	}
}else{
	$description=$_POST['description'];
	for($cc=0;$cc<count($description);$cc++){
		$sqll="UPDATE hms_parameters SET ";
		$sqll=$sqll."module_name='".$_POST['module_name']."',";
		$sqll=$sqll."description='".$_POST['description'][$cc]."',";
		$sqll=$sqll."status='".$_POST['status'][$cc]."',";
		$sqll=$sqll."applicable_date='".$_POST['applicable_date'][$cc]."',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where module_name='".$_POST['module_name']."'";

		$resultt=mysql_query($sqll);
		if($resultt){
			header('location:'.$home_path.'/admin/update_parameters.php?msg=Data saved Successfully!');
		}
		else{
			header('location:'.$home_path.'/admin/update_parameters.php?msg=Error in insertion');
		}
	}
}

?>