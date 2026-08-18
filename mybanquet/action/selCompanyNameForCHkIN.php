<?php  

include("../config.php");
$comp=$_GET['comp'];

$sql="select * from company_master where comp_code='$comp'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

echo $row['comp_name'].'&#'.$row['address1'].'&#'.$row['address2'].'&#'.$row['city'].'&#'.$row['pin_code'].'&#'.$row['state'].'&#'.$row['country'].'&#'.$row['phone'].'&#'.$row['email'].'&#'.$row['comp_code'];

?>