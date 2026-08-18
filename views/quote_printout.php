<?php
session_start();
define("host","localhost");
define("user","root");
define('password',"");
define('dbname','myerp');

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

$quoteID=$_GET['uid'];
$sqlSet=mysql_query("select * from setting where setting_id='1'");
$rowSet=mysql_fetch_array($sqlSet);
$headerImg=$rowSet['header_image'];

$date= date('d/m/Y');

$resultP=mysql_query("select * from quotation where quote_id='$quoteID'");
$rowP=mysql_fetch_array($resultP);
$rfq_no=$rowP['rfq_no'];
$vendorNm=$rowP['vendor_name'];
	
$resultV=mysql_query("select * from vendor_master where vendor_code='$vendorNm'");
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

	
$mm1="";
$mm1 ="<br/>";

$mm="";
$mm ="<br/><br/><br/><br/><br/><br/>";	
	
$tbl = <<<EOD
EOD;
$tbl.=<<<EOD
<div style="width:100%;">
	<img src="../img/headerimg/$headerImg" style="width:1000px;height:150px;"/>
	<hr>

<h3 style="text-align:center;">QUOTATION</h3>
</div>


<table border="" cellpadding="" cellspacing="">
<tr>
	<td style="width:70%;"><b>Ref:</b></td>
	<td style="width:30%;"><b>Date:</b>&nbsp;&nbsp;$date</td>
</tr>
<tr>
	<td style="width:70%;"></td>
	<td style="width:18%;"><hr></td>
</tr>
$mm1
<tr>
	<td style="width:50%;"><b>Cust RFQ REF:</b>&nbsp;&nbsp;$rfq_no</td>
</tr>
$mm1
<tr>
	<td style="width:60%;"><b>To</b></td>
	<td style="width:40%;"><b>POC</b></td>
</tr>
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
$mm
<tr>
	<td style="width:70%;"><b>Tels:</b>&nbsp;$phone</td>
	<td style="width:50%;"><b>E Mail:</b>&nbsp;$email</td>
</tr>
$mm
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
	<td  style="text-align:center;font-weight:bold;">Price</td>
	<td  style="text-align:center;font-weight:bold;">Unit</td>
</tr>


EOD;
$result_pay=mysql_query("select * from quotation where quote_id='$quoteID'");
$x=0;
while($rowPay=mysql_fetch_array($result_pay)){
	$x++;
	$part_no=$rowPay['part_no'];
	$part_name=$rowPay['part_name'];
	$qty=$rowPay['qty'];
	$quote_amt=$rowPay['quote_amt'];
	$unit_issue=$rowPay['unit_issue'];
	
$tbl.=<<<EOD
<tr>
	<td style="text-align:center;">$x</td>
	<td style="text-align:center;">$part_no</td>
	<td style="text-align:center;">$part_name</td>
	<td style="text-align:center;">$qty</td>
	<td style="text-align:right;">$quote_amt</td>
	<td style="text-align:center;">$unit_issue</td>
</tr>
</table>
EOD;
}

$tbl.=<<<EOD
<table border="" cellpadding="3" cellspacing="3">
<tr>
	<td style=""><b>Notes</b></td><td></td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td style="width:170px;">1 Quotation Validity</td><td>:</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:170px;">2 Delivery time</td><td>:</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:170px;">3 FOB</td><td>:</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:170px;">4 Payment terms</td><td>:</td>
</tr>	
</table>
EOD;



$mm1="";
$mm1 ="<br/><br/>";

$mm="";
$mm ="<br/><br/><br/><br/>";

$tbl.=<<<EOD
$mm
<table border="" cellpadding="3" cellspacing="3">
<tr>
	<td style=""><b>For Cresent Engineering Solutions,</b></td>
</tr>
$mm1
<tr>
	<td style="width:15px;">&nbsp;</td><td style="width:170px;">D.Daniyal Antony Prabhu</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:170px;">Manager - Operations</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:170px;">Ph : +91 90036 424848</td>
</tr>
<tr>
	<td style="width:15px;">&nbsp;</td><td  style="width:270px;">E-mail:dantonyprabhu@gmail.com</td>
</tr>	
</table>
EOD;


	
$pdf->writeHTML($tbl, true, false, false, false,'');
$pdf->Output('example_048.pdf', 'I');