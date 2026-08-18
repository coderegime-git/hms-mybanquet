<?php  
session_start();
include("../config.php");
$rfqNO=$_GET['rfqNO'];
$qtyS=$_GET['qty'];

					
$queryVal =mysql_query("SELECT distinct vendor_name FROM vendor_allocation WHERE rfq_no='$rfqNO'");
$VEnVal="";
$VEnVal.='<option value="">--Select--</option>';
while($rowVal=mysql_fetch_array($queryVal)){
	$sqle=mysql_query("select * from vendor_master where vendor_code='".$rowVal['vendor_name']."'");
	$VEnValM="";
	$VEnValM.='<option value="">--Select--</option>';
	while($rowVm=mysql_fetch_array($sqle)) {
		$VEnValM.='<option value="'.$rowVm['vendor_code'].'">'.$rowVm['vendor_name'].'</option>';
	}
	/*  $VEnVal.='<option value="'.$rowVal['vendor_name'].'">'.$rowVal['vendor_name'].'</option>'; */
}	
		
$queryVA =mysql_query("SELECT rfq_no,status,vendor_name FROM vendor_allocation WHERE rfq_no='$rfqNO'");
	$rowVA=mysql_fetch_array($queryVA);	
	$statusVA=$rowVA['status'];
	
if($statusVA=='Approved'){
	$sql="select * from quotation where rfq_no='$rfqNO'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);

	$qty=$row['qty'];
	$unit_issue=$row['unit_issue'];
	$quote_rate=$row['quote_rate'];
	$days_possible=$row['days_possible']; 
	$part_no=$row['part_no'];
	$part_name=$row['part_name'];
	$quote_amt=$row['quote_amt'];

	$balQty=(int)($qty-$qtyS);
	/* echo $balQty; */

	$date = date('d-m-Y');
	$date = strtotime($date);
	$date = strtotime('+'.$days_possible.'days', $date);
	/* echo date('M d, Y', $date); */
	$dayPosble=date('d-m-Y', $date);

	/* $sqlCu="select * from customer_po where rfq_no='$rfqNO' where company_id='".$_SESSION['companyId']."'"; */
	$sqlCu="select * from customer_po where rfq_no='$rfqNO'";
	$resultCu=mysql_query($sqlCu);
	$rowCu=mysql_fetch_array($resultCu);
	$custreq_deldate=$rowCu['req_deldate'];

			$sqlSU=mysql_query("select sum(qty) as preQty from vendor_po where rfq_no='$rfqNO' AND company_id='".$_SESSION['companyId']."'");
			$rowSu=mysql_fetch_array($sqlSU);
			$preQty=$rowSu['preQty'];

	 echo $qty.'@'.$unit_issue.'@'.$quote_rate.'@'.$part_no.'@'.$part_name.'@'.$quote_amt.'@'.$custreq_deldate.'@'.$preQty.'@'.$VEnValM;  
}

if($statusVA=='Pending' || $statusVA=='Cancelled'){
	echo 1;
}
?>