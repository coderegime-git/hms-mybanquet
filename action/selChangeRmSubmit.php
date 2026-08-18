<?php  

include("../config.php");
$crType=$_GET['crType'];
$tarRmtype=$_GET['tarRmtype'];

if($crType==$tarRmtype){
	echo 1;
}else if($crType!=$tarRmtype){
	echo 2;	
}




?>