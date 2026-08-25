<?php
ob_start();
session_start();
include("config.php");
$userName=$_POST['username'];
$sqll=mysql_query("select * from access_rights where user_name='".$userName."'");
$resultt=mysql_fetch_array($sqll);
$menu_id=$resultt['menu_id'];
$_SESSION['menuOption']=$menu_id;


$sqlC=mysql_query("select * from user where user_name='".$_POST['username']."'");
$rowC=mysql_fetch_array($sqlC);
$company_id=$rowC['company_id'];
$companyId=explode(',',$company_id);
$size=count($companyId);

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$dt=$adtCurDt;
$dte=explode('/',$dt);
$dtea=$dte[1].'/'.$dte[2];

$fromdate1=$dte[2].'/'.$dte[1].'/'.$dte[0];
$fromdate=$dte[0].'/'.$dte[1].'/'.$dte[2];

	
	
for($y=0;$y<$size;$y++) {	
/* echo $companyId[$y].'gfgfg'.$_POST['company_name']; */
	if($companyId[$y]==$_POST['company_name'])	{
		$sql=mysql_query("select * from user where user_name='".$_POST['username']."'");
		$result=mysql_fetch_array($sql);
		$username= $result['user_name'];

		$password= $result['password']; 
		$status= $result['status']; 
		$UserName=$_POST['username'];
		$passWord=$_POST['password'];
		 /*  echo $username.$password.$status; */
		 
	} 	
}
/* echo $username.$password.$status; 
die(); */
	if(isset($_POST['submit'])){
		if($UserName==$username && $password==$passWord && $status=='1'){
		
		$_SESSION['companyId']=$_POST['company_name'];
		$_SESSION['user']=$UserName;
		header('location:preloader.php?fromdate='.$fromdate.'&todate='.$fromdate);
		}else{	
		header('location:index.php?msg=Login Failed...');		
		}	
	}
	
?>