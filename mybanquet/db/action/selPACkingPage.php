<?php  
session_start();
include("../config.php");

$rfqNO=$_GET['rfqNO'];
 
$sqlC=mysql_query("select * from customer_po where rfq_no='$rfqNO'");
$rowC=mysql_fetch_array($sqlC);
$no_clin=$rowC['no_clin'];
$customerpo_no=$rowC['customerpo_no'];
$nsn_no=$rowC['nsn_no'];
$part_no=$rowC['part_no'];
$part_name=$rowC['part_name'];
$total_qty=$rowC['total_qty'];
$clin_qty=$rowC['clin_qty'];
$clin_dest=$rowC['clin_dest'];
$req_deldate=$rowC['req_deldate'];

$sqlCl=mysql_query("select * from client_master where clin_dest='$clin_dest'");
$rowCl=mysql_fetch_array($sqlCl);
	$saddress1=$rowCl['saddress1'];
	$saddress2=$rowCl['saddress2'];
	$scity=$rowCl['scity'];

	
$partNMe="";
$partNMe.='<select name="dest_code" id="clin_dest" style="font-size:14px;" onChange="selClnDest();">';
$partNMe.='<option value="">--Select--</option>';
	
$sqlRF=mysql_query("select * from customer_po where rfq_no='$rfqNO'");
while($rowRF=mysql_fetch_array($sqlRF)) {
	$partNMe.='<option value="'.$rowRF['clin_dest'].'">'.$rowRF['clin_dest'].'</option>'; 
}

echo $no_clin.','.$customerpo_no.','.$nsn_no.','.$part_no.','.$part_name.','.$total_qty.','.$partNMe;  
?>








