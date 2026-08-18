<?php  

include("../config.php");

$output="";
$sql=mysql_query("select * from bq_opfpmenuhdr where fpno='".$_GET['fpN']."'");
while($row=mysql_fetch_array($sql)){
	$output.='<p>'.$row['signboard'].'</p><br/>';
	
}
echo $output;