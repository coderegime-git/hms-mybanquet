<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sql=mysql_query("select * from setting");
if(mysql_num_rows($sql)>0){
$sqll="UPDATE setting SET ";
$sqll=$sqll."date_init='".$_POST['date_init']."',";
$sqll=$sqll."sett_text='".$_POST['sett_text']."',";
$sqll=$sqll."presuff='".$_POST['presuff']."',";
$sqll=$sqll."status='".$_POST['status']."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where setting_id='1'";

/*  echo $sqll;
die();  */  

$resultt=mysql_query($sqll);
if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/frontoffice/settings.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/frontoffice/settings.php?msg='.$msg);	
}
	
}else{

$sql="insert into setting(date_init,sett_text,presuff,status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['date_init']."',";
	$sql.="'".$_POST['sett_text']."',";
	$sql.="'".$_POST['presuff']."',";
	$sql.="'".$_POST['status']."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";

$UsQuery =mysql_query($sql);
if($UsQuery){
	header('location:'.$home_path.'/masters/frontoffice/settings.php?msg=Data saved Successfully!');
}
else{
	header('location:'.$home_path.'/masters/frontoffice/settings.php?msg=Error in insertion');
}
}

?>