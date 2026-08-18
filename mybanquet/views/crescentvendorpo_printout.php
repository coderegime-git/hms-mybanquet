<?php
session_start();
include("../config.php");

$conn = mysql_connect(host,user,password);
mysql_select_db(dbname,$conn);
date_default_timezone_set('Asia/Kolkata');
require_once('../pdf/tcpdf.php');
require_once('../pdf/amountToWords.php');
include('../util.php');
$curr_symbol=  getCurrancy();

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set margins
/* $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); */
$pdf->SetMargins(PDF_MARGIN_LEFT, 0, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, -25);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set font
$pdf->AddFont('DejaVuSansCondensed','','DejaVuSansCondensed.ttf',true);
/* $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14); */
//$pdf->SetFont('helvetica', 'B', 18);
// add a page
$pdf->AddPage();
$pdf->Write(0,'', '', 0, 'R', true, 0, false, false, 0);
$pdf->SetFont('DejaVuSans','',10);

$vendorID=$_GET['uid'];
$sqlSet=mysql_query("select * from setting where setting_id='1'");
$rowSet=mysql_fetch_array($sqlSet);
$headerImg=$rowSet['header_image'];

$date= date('d/m/Y');

$resultP=mysql_query("select * from vendor_po where vendorpo_id='$vendorID'");
$rowP=mysql_fetch_array($resultP);
$vendor_no=$rowP['vendor_no'];
$po_no=$rowP['po_no'];
$rfq_no=$rowP['rfq_no'];
$req_deldate=$rowP['req_deldate'];
/* $rfq_no=$rowP['rfq_no'];
$vendorNm=$rowP['vendor_name']; */
	
 $resultV=mysql_query("select * from vendor_master where vendor_code='$vendor_no'");
$rowV=mysql_fetch_array($resultV);
$vendor_name=$rowV['vendor_name'];
$address1=$rowV['address1'];
$address2=$rowV['address2'];
$city=$rowV['city'];
$pincode=$rowV['pincode'];
$state=$rowV['state'];
$country=$rowV['country'];
$phone=$rowV['phone'];
$email=$rowV['email']; 

$mm="";
$mm ="<br/><br/>";

$tbl = <<<EOD
EOD;

$tbl.=<<<EOD
<table border="" cellpadding="" cellspacing="" style="width:60%;float:left;">
	<tr>
		<td style=""><img src="../images/crescent-logo.png" style=" width:100px;height:80px; "/></td>
		<td style="width:80%;">
			
			<b>Cresent Engineering Solutions</b><br/>
			138, Subramaniyar Koil Street,<br/>
			Ramanatha Puram, Coimbatore- 641 045<br/>
			Tel : +91 422 4216693.
			
		</td>
	<td>
		<table border="1" cellpadding="3" cellspacing="" style="width:100%;text-align:center;">
	<tr>
		<td colspan="2" style="font-size:11px;width:200px;"><b>PURCHASE ORDER</b></td>
	</tr>
	<tr>
		<td><b>No</b></td>
		<td><b>Date</b></td>
	</tr>
	<tr>
		<td>$po_no</td>
		<td>$date</td>
	</tr>
</table>
		
		
		</td>
		
	</tr>
	
</table>
$mm
$mm



<table border="" cellpadding="3" cellspacing="" style="width:100%;text-align:center;">
	<tr>
		<td style="font-size:12px;width:250px;border:2px solid #000;"><b>VENDOR</b></td>
	</tr>
	<tr>
		<td style="height:80px;border:2px solid #000;">
		&nbsp;
<table border="" cellpadding="" cellspacing="" style="text-align:left;">
<tr>
<td>$vendor_name</td>
</tr>
<tr>
<td>$address1</td>
</tr>
<tr>
<td>$address2</td>
</tr>
<tr>
<td>$city</td>
</tr>
<tr>
<td>$pincode</td>
</tr>
<tr>
<td>$state</td>
</tr>
<tr>
<td>$country</td>
</tr>
<tr>
<td>$phone</td>
</tr>
<tr>
<td>$email</td>
</tr>
</table>

		</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<table border="1" cellpadding="6" cellspacing="" style="width:100%;text-align:left;">
	<tr>
		<td style="font-size:12px;width:250px;"><b>RFQ REF:</b>$rfq_no </td>
	</tr>
	<tr>
		<td style="font-size:12px;width:250px;"><b>Vendor Quote Ref:</b> </td>
	</tr>
	
</table>
		
		</td>
		
		
	</tr>
	
</table>
$mm
<table border="" cellpadding="6" cellspacing="" style="width:100%;text-align:left;">
	<tr>
		<td style="font-size:12px;width:250px;border:2px solid #000;"><b>Contact Person:</b>$vendor_name </td>
		
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<table border="1" cellpadding="6" cellspacing="" style="width:100%;text-align:left;">
				<tr>
					<td style="font-size:12px;width:250px;"><b>Delivery Date:</b> $req_deldate</td>
				</tr>
			</table>
		</td>
		
	</tr>
	<tr>
		<td style="font-size:12px;width:250px;border:2px solid #000;"><b>Contact Number:</b> $phone</td>
	</tr>
	
</table>
EOD;


$mm="";
$mm ="<br/><br/>";
$tbl.=<<<EOD
$mm 
<table border="1" cellpadding="3" cellspacing="">
<tr>
	<td  style="text-align:center;font-weight:bold;">Sl.No.</td>
	<td  style="text-align:center;font-weight:bold;">Part Number</td>
	<td  style="text-align:center;font-weight:bold;">Description</td>
	<td  style="text-align:center;font-weight:bold;">Qty</td>
	<td  style="text-align:center;font-weight:bold;">Rate/EA</td>
	<td  style="text-align:center;font-weight:bold;">Total Amount</td>
</tr>


EOD;
$resultVen=mysql_query("select * from vendor_po where vendorpo_id='$vendorID'");
$x=0;
while($rowVen=mysql_fetch_array($resultVen)){
	$x++;
	$part_no=$rowVen['part_no'];
	$part_name=$rowVen['part_name'];
	$qty=$rowVen['qty'];
	$rate=$rowVen['rate'];
	$total_amount=$rowVen['total_amount'];
	
$tbl.=<<<EOD
<tr>
	<td style="text-align:center;">$x</td>
	<td style="text-align:center;">$part_no</td>
	<td style="text-align:center;">$part_name</td>
	<td style="text-align:center;">$qty</td>
	<td style="text-align:right;">$rate</td>
	<td style="text-align:center;">$total_amount</td>
</tr>
</table>
EOD;
}


$tbl.=<<<EOD

<table border="" cellpadding="3" cellspacing="3" >
<tr>
	<td style=""><b><u>Terms & Conditions</u></b></td>
</tr>

<tr>
	<td style="width:15px;">&nbsp;</td><td style="width:800px;">1. Materials should be delivered to Cresent Engineering Solutions.</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:800px;">2. No variation in quantity is allowed</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:800px;">3. Packing should be done.</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:800px;">4. Packing should be done as per standard, if you are in doubt contact CES</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:800px;">5. Quality should be maintained strictly, if any item found non confermance the cost will be debited</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:800px;">6. All certificates required by the drawing should be submitted without fail</td>
</tr>
	
</table>
EOD;


$tbl.=<<<EOD
$mm 
<table border="1" cellpadding="3" cellspacing="">
<tr>
	<td  style="text-align:center;">Received & Accepted By</td>
	<td  style="text-align:center;">Prepared By</td>
	<td  style="text-align:center;">Authorized By</td>
</tr>
<tr>
	<td  style="text-align:center;height:70px;"></td>
	<td  style="text-align:center;height:70px;"></td>
	<td  style="text-align:center;height:70px;"></td>
</tr>
</table>
EOD;

	
$pdf->writeHTML($tbl, true, false, false, false,'');
$pdf->Output('example_048.pdf', 'I');