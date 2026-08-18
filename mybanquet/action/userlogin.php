<?php


include("../config.php");
$added_on= date('Y-m-d H:i:s');

$sqll=mysql_query("select * from user where user_name='".$_POST['username']."'");
$resultt=mysql_fetch_array($sqll);
$userName=$resultt['user_name'];

if($userName!=$_POST['username']){
$sql="insert into user(usercode,user_name,password,reenter_pass,email,mobile,status,added_on)";
$sql.=" values(";
$sql.="'".$_POST['usercode']."',";
$sql.="'".$_POST['username']."',";
$sql.="'".$_POST['password']."',";
$sql.="'".$_POST['repass']."',";
$sql.="'".$_POST['email']."',";
$sql.="'".$_POST['mobile']."',";
$sql.="'".$_POST['status']."',";
$sql.="'".$added_on."')";
$UsQuery =mysql_query($sql);
header('location:'.$home_path.'/admin/user-master.php');
}
else{
header('location:'.$home_path.'/admin/user-master.php?msg=User Name Already exists');	
}

?>