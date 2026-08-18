<?php  

include("../config.php");
$openL=$_GET['openL'];

/* echo "select * from pos_outlet where outlet_code='$openL'"; */
$sql=mysql_query("select * from pos_outlet where outlet_code='$openL'");
$row=mysql_fetch_array($sql);

echo $row['outlet_type'];

?>