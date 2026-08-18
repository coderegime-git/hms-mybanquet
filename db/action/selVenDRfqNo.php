<?php  
session_start();
include("../config.php");

$rfqNO=$_GET['rfqNO'];
 
$queryVal =mysql_query("SELECT distinct vendor_name FROM vendor_po WHERE rfq_no='$rfqNO' AND status='generated'");
if(mysql_num_rows($queryVal)>0){
$VEnVal="";	$VEnValM="";
$VEnVal.='<option value="">--Select--</option>';
while($rowVal=mysql_fetch_array($queryVal)){
	$sqle=mysql_query("select * from vendor_master where vendor_code='".$rowVal['vendor_name']."'");
	$VEnValM.='<option value="">--Select--</option>';
	while($rowVm=mysql_fetch_array($sqle)) {
		$VEnValM.='<option value="'.$rowVm['vendor_code'].'">'.$rowVm['vendor_name'].'</option>';
	}
}

if($VEnValM==''){
	$VEnValM.='<option value="">--Select--</option>';
}

$sqll=mysql_query("select * from vendor_po where rfq_no='$rfqNO' AND status='generated'");
$rowl=mysql_fetch_array($sqll);
 
echo $rowl['po_no'].','.$rowl['part_no'].','.$rowl['part_name'].','.$rowl['total_amount'].','.$rowl['qty'].','.$rowl['rate'].','.$rowl['cur_date'].','.$VEnValM;  
}else{
	/* echo 1; */
}
?>