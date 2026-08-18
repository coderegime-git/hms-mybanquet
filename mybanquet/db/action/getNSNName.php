<?php  
session_start();
include("../config.php");

$nsnnumber=$_GET['nsnNmber'];

$sql="select nsnname from nsnnumber where nsnnumber='$nsnnumber'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$nsnname=$row['nsnname'];

echo $nsnname;

?>