<?php  

include("../config.php");

$submCat=$_GET['submCat'];

$sql=mysql_query("select * from pos_submenucat where submn_catcd='$submCat'");
$row=mysql_fetch_array($sql);

$sqlM=mysql_query("select * from pos_menucat where menu_catcd='".$row['submn_cat']."'");
$rowM=mysql_fetch_array($sqlM);

echo $rowM['menu_type'].','.$rowM['menu_catcd'];
 







?>