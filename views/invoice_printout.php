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

$mm1="";
$mm1 ="<br/>";

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
		<td colspan="2" style="font-size:18px;width:200px;"><b>Invoice</b></td>
	</tr>
	<tr>
		<td >Invoice No</td>
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



<table border="" cellpadding="3" cellspacing="" style="width:100%;text-align:left;">
	
	<tr>
		<td style="height:100px;border:1px solid #000;width:40%;">
		<b>Bill To:</b>$mm1
		&nbsp;&nbsp;$vendor_name$mm1
		&nbsp;&nbsp;$address1$mm1
		&nbsp;&nbsp;$address2$mm1
		&nbsp;&nbsp;$city$mm1
		&nbsp;&nbsp;$pincode$mm1
		&nbsp;&nbsp;$state$mm1
		&nbsp;&nbsp;$country$mm1

		</td>
		<td style="height:100px;border:1px solid #000;width:60%;">&nbsp;
		<b>Ship To:</b>
		
		</td>
		
		
	</tr>
	
</table>
$mm


<table border="" cellpadding="4" cellspacing="" style="width:100%;text-align:left;">
	<tr style="background-color:#a4f2a7;text-align:center;">
		<td style="font-size:12px;border:1px solid #000;width:40%;"><b>P.O.#</b></td>
		<td style="font-size:12px;border:1px solid #000;width:15%;"><b>Ship Date</b></td>
		<td style="font-size:12px;border:1px solid #000;width:15%;"><b>Ship Via</b></td>
		<td style="font-size:12px;border:1px solid #000;width:15%;"><b>Terms</b></td>
		<td style="font-size:12px;border:1px solid #000;width:15%;"><b>Due Date</b></td>
	</tr>
	<tr>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
		<td style="font-size:12px;border:1px solid #000;width:15%;"></td>
		<td style="font-size:12px;border:1px solid #000;width:15%;"></td>
		<td style="font-size:12px;border:1px solid #000;width:15%;"></td>
		<td style="font-size:12px;border:1px solid #000;width:15%;"></td>
	</tr>
	<tr>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
	</tr>
	<tr>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
	</tr>
	<tr>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
	</tr>
	<tr>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
		<td style="font-size:12px;border:1px solid #000;width:20%;"></td>
	</tr>
	
</table>
EOD;


$mm="";
$mm ="<br/><br/>";
$tbl.=<<<EOD
$mm 
<table border="1" cellpadding="3" cellspacing="">
<tr style="background-color:#a4f2a7;text-align:center;">
	<td  style="text-align:center;font-weight:bold;">Sl.No.</td>
	<td  style="text-align:center;font-weight:bold;">Invoice no</td>
	<td  style="text-align:center;font-weight:bold;">Description</td>
	<td  style="text-align:center;font-weight:bold;">Quantity</td>
	<td  style="text-align:center;font-weight:bold;">Unit Price</td>
	<td  style="text-align:center;font-weight:bold;">Line Total</td>
</tr>
EOD;

$invID=$_GET['uid'];
$resultVen=mysql_query("select * from invoice where invoice_id='$invID'");
$x=0;
while($rowVen=mysql_fetch_array($resultVen)){
	$x++;
	$invoice_no=$rowVen['invoice_no'];
	$part_name=$rowVen['part_name'];
	$qty=$rowVen['qty'];
	$unit_price=$rowVen['unit_price'];
	$invoice_total=$rowVen['invoice_total'];
	
$tbl.=<<<EOD
<tr>
	<td style="text-align:center;">$x</td>
	<td style="text-align:center;">$invoice_no</td>
	<td style="text-align:center;">$part_name</td>
	<td style="text-align:center;">$qty</td>
	<td style="text-align:right;">$unit_price</td>
	<td style="text-align:center;">$invoice_total</td>
</tr>
</table>
EOD;
}


$mm="";
$mm ="<br/><br/>";
$mm1="";
$mm1 ="<br/>";
$tbl.=<<<EOD
 
<table border="1" cellpadding="3" cellspacing="">
<tr style="">
	<td  style="text-align:left;font-size:11px;width:60%;height:70px;">
	Amount in words	:&nbsp;&nbsp;$mm
	<hr>
	$mm1
	CST	:	978053	/ 10.12.2010$mm
	TIN	:	33101884795	$mm
	IE Code :	3210024669	$mm
		

	</td>
	<td  style="text-align:right;font-size:11px;width:23.3%;">Sub Total	:&nbsp;&nbsp;$mm
	GST &nbsp;&nbsp;&nbsp;0%	:$mm
	Shipping Handling :$mm
	Total:
	</td>
	<td  style="text-align:right;font-size:11px;width:16.7%;">
	<label style="border:1px solid #000;">$state&nbsp;&nbsp;$mm</label>
	$state &nbsp;&nbsp;&nbsp;0%	$mm
	$state $mm
	$state
	</td>
</tr>
</table>
EOD;



$mm="";
$mm ="<br/><br/>";
$mm1="";
$mm1 ="<br/>";
$tbl.=<<<EOD
 
$mm
<table border="" cellpadding="3" cellspacing="">
<tr style="">
<td style="width:60%;">Note :</td>
<td style="width:40%;">For Cresent Engineering Solutions</td>
</tr>
$mm
<tr style="">
<td style="width:70%;"></td>
<td style="width:30%;">Authorized Signature</td>
</tr>
$mm
<tr style="">
<td style="text-align:center;background-color:#FE70BD;width:100%;font-size:11px;"><i>THANK YOU FOR YOUR BUSINESS!</i></td>
</tr>
</table>
EOD;

	
$pdf->writeHTML($tbl, true, false, false, false,'');
$pdf->Output('example_048.pdf', 'I');