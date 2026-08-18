<?php  

include("../config.php");
$added_on= date('Y-m-d H:i:s');

$sql="UPDATE user SET ";
$sql=$sql."usercode='".$_POST['usercode']."',";
$sql=$sql."user_name='".$_POST['username']."',";
$sql=$sql."password='".$_POST['password']."',";
$sql=$sql."reenter_pass='".$_POST['repass']."',";
$sql=$sql."email='".$_POST['email']."',";
$sql=$sql."mobile='".$_POST['mobile']."',";
$sql=$sql."status='".$_POST['status']."',";
$sql=$sql."added_on='".$added_on."'";
$sql=$sql." where user_name='".$_POST['username']."'";
 
/*  echo $sql;
die();  */

$result=mysql_query($sql);
$msg='User details updated successfully';
header('location:'.$home_path.'/admin/admin/Update-user-master.php?msg='.$msg);

?>