<?php  

include("../config.php");

$menGrp=$_GET['menGrp'];

$sqlUnt=mysql_query("select * from bq_menugrp where menu_code='$menGrp' AND status='1'");
$rowUnt=mysql_fetch_array($sqlUnt);
$menu_name=$rowUnt['menu_name'];

$payC="";				
$sqlP=mysql_query("select distinct submenu_code,submenu_name from bq_submenugrp where subgrp_code='$menGrp'");
if(mysql_num_rows($sqlP)>0){
	$payC="";
	$payC.='<option value="">--Select--</option>';
	while($rowP=mysql_fetch_array($sqlP)){
			 $payC.='<option value="'.$rowP['submenu_code'].'">'.$rowP['submenu_name'].'</option>';
	}
	echo $payC;
}else{
	$payC.='<option value="'.$menGrp.'">'.$menGrp.'</option>';
	echo $payC;
}
	 
?>