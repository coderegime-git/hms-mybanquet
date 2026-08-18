<?php  

include("../config.php");

$output="";
$sql=mysql_query("select * from bq_opfpmenudetail where fpno='".$_GET['fpN']."'");
while($row=mysql_fetch_array($sql)){
	$sqM=mysql_fetch_array(mysql_query("select * from bq_menumaster where menu_code='".$row['menucode']."'"));
	$output.='<p>'.$sqM['menu_name'].'</p>';
	$output.='<p>'.$row['itemname'].'</p>';
	
	
}
echo $output;