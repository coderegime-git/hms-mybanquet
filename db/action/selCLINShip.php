<?php  
session_start();
include("../config.php");

$clin_dest=$_GET['clin_dest'];
$rfqNO=$_GET['rfqNO'];

/* echo "select * from customer_po where rfq_no='$rfqNO'";  */
/* echo "select * from client_master where clin_dest='$clin_dest'"; */

$sql=mysql_query("select * from client_master where clin_dest='$clin_dest'");
$row=mysql_fetch_array($sql);

$sqll=mysql_query("select * from quotation where rfq_no='$rfqNO'");
$rowl=mysql_fetch_array($sqll);
$quote_rate=$rowl['quote_rate'];
$unit_issue=$rowl['unit_issue'];
$currency=$rowl['currency'];
		
$sqlC=mysql_query("select * from customer_po where rfq_no='$rfqNO'");
$rowC=mysql_fetch_array($sqlC);
$clin_qty=$rowC['clin_qty'];
$customerpo_no=$rowC['customerpo_no'];

$sqlCo=mysql_query("select * from company_details where company_id='".$_SESSION['companyId']."'");
$rowCo=mysql_fetch_array($sqlCo);
$compName=$rowCo['company_name'];

$sqlPR=mysql_query("select * from property_master where prop_code='$compName'");
$rowPR=mysql_fetch_array($sqlPR);
$billadd1=$rowPR['address1'];
$billadd2=$rowPR['address2'];
$billcity=$rowPR['city'];
$billpin=$rowPR['pincode'];

echo $row['saddress1'].','.$row['saddress2'].','.$row['scity'].','.$row['spincode'].','.$row['sstate'].','.$row['scountry'].','.$quote_rate.','.$clin_qty.','.$unit_issue.','.$customerpo_no.','.$currency.','.$billadd1.','.$billadd2.','.$billcity.','.$billpin;   

?>