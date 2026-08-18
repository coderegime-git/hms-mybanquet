<?php  

include("../config.php");
$taxCode=$_GET['taxCode'];

$sql="select tax_desc from bq_taxmast where tax_code='$taxCode'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

echo $row['tax_desc'];

?>