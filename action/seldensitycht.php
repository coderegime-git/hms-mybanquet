<?php
ob_start();

include("../config.php");

$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
$date=date('Y-m-d');
$dateYr=date('d/m/Y');

$venu=$_GET['venu'];
$val=$_GET['val'];
$dte=$_GET['dte'];
$fr=explode('/',$dte);
$dtee=$fr[2].'-'.$fr[1].'-'.$fr[0];

$chkR=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y')='".$dtee."' and venue='".$venu."' and session='".$val."'");
if(mysql_num_rows($chkR) > 0) {
$out = 1;
}
else {
$out = 0;
}

echo $out;
?>