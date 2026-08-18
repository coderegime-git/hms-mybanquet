<?php
/* include("../../config.php"); */
define("host","localhost");
define("user","root");
define('password',"");
define('dbname','hms'); 

$conn = mysql_connect(host,user,password);
mysql_select_db(dbname,$conn); 

date_default_timezone_set('Asia/Kolkata');
require_once('../../pdf-tcpdf/tcpdf.php');
require_once('../../pdf/amountToWords.php');


/* $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A5", true, 'UTF-8', false); */
$pdf = new TCPDF('P', PDF_UNIT, "A4", true, 'UTF-8', false);
/* $pdf->SetCreator(PDF_CREATOR); */
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set margins
/*  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); */ 
 $pdf->SetMargins(2, 0, 8);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(5); 
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, -25);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set font
$pdf->AddFont('DejaVuSansCondensed','','DejaVuSansCondensed.ttf',true);

// add a page
$pdf->AddPage();
$pdf->Write(0,'', '', 0, 'R', true, 0, false, false, 0);
$pdf->SetFont('DejaVuSans','',8);

$sqlPd=mysql_query("select * from  property_definition where propdef_id='1'");
$rowPd=mysql_fetch_array($sqlPd); 
$tin_number=$rowPd['tin_number'];

$curDte=$_GET['curDte'];
$rcptNo=$_GET['rcptNo'];
$roomNo=$_GET['roomNo'];
$gustNme=$_GET['gustNme'];
$remarks=$_GET['remks'];
$amt=sprintf("%01.2f",$_GET['amt']);
$payMde=$_GET['payMde'];


/* $sqlRD=mysql_query("select * from  room_advance where receipt_no='".$rcptNo."'");
$rowRd=mysql_fetch_array($sqlRD); 
$remarks=$rowRd['remarks']; */

/* "select * from guest_register gr, guest_trans gt where gr.room_no='".$_GET['roomNo']."' AND gt.room_no='".$_GET['roomNo']."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'" */

$sqlG=mysql_query("select * from guest_register gr, guest_trans gt where gr.room_no='".$_GET['roomNo']."' AND gt.room_no='".$_GET['roomNo']."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'");
/* $sqlG=mysql_query("select * from guest_register where room_no='".$_GET['roomNo']."'"); */
$rowG=mysql_fetch_array($sqlG);
$grcNo=$rowG['grc_number'];
$title=ucfirst($rowG['title']);

$NETpAYy=sprintf("%01.2f",$_GET['amt']);
$aWords = new Currency();
$finTot =$NETpAYy;
$finInWords =strtoupper($aWords->get_bd_amount_in_text(round($finTot,2))); 

$mm="";
$mm ="<br/>";

$mm1="";
$mm1 ="<br/><br/>";	
$tbl = <<<EOD
EOD;
$tbl.=<<<EOD
<table style="" cellpadding="" cellspacing="">
<tr>
<td style="text-align:center">Guest Copy</td>
</tr>
</table>
<table style="" cellpadding="" cellspacing="">
<tr><td colspan="3" style="text-align:center;"></td></tr>
<tr>
<td style="width:70px;">
<img src="../../images/Akshaya.JPG" style="width:65px;height:75px;"/>
</td>
<td style="width:480px;">
$mm
	<label style="font-weight:bold;font-size:14px;">AKSHAY BUSINESS HOTEL</label>$mm
	New no:282, Old no:261, Arcot road Vadapalani $mm 
	Chennai - 600 026.$mm 
	Tamilnadu, India$mm 
</td>
<td style="width:269px;margin-left:100px;">
Ph: 044-42697000, 044-2376 3665$mm
Email: reservation@akshayinn.com$mm
</td>
</tr>
</table>

EOD;
$mm2="";
$mm2 ="<br/><br/><br/>";
$tbl.=<<<EOD
$mm2
<table style="" cellpadding="5" cellspacing="5">
<tr>
<td style="">Receipt No:&nbsp;$rcptNo</td>
<td style="text-decoration:underline;font-size:10px;font-weight:bold;text-align:center;">Check-in Advance Receipt</td>
<td style="width:400px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;$curDte</td>
</tr>
</table>
EOD;

$tbl.=<<<EOD
$mm2
<table style="" cellpadding="3" cellspacing="3">
<tr>
<td style="width:140px;">Received with thanks from</td><td style="text-decoration: underline dotted #000;width:600px;">$title.&nbsp;$gustNme&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width:92px;">A Sum of Rupees</td><td style="text-decoration: underline dotted #000;width:700px;">$finInWords&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;by $payMde </td>
</tr>
<tr>
<td style="width:195px;">being Advance Payment for Room No</td><td style="text-decoration: underline dotted #000;width:200px;"> $roomNo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td style="width:60px;"></td><td style="width:100px;text-decoration: underline dotted #000;"></td>
</tr>
<br/>
<tr>
<td style="text-decoration:underline;font-size:10px;">Remarks: $remarks</td>
</tr>
</table>

EOD;

$tbl.=<<<EOD
$mm2
<table style="" cellpadding="3" cellspacing="">
<tr>
<td style="text-align:right;">For AKSHAY BUSINESS HOTEL</td>
</tr>
<tr>
<td style="border:1px solid #000;width:80px;">&nbsp;Rs. $amt</td>
</tr>
<br/>
<tr>
	<td style="width:1250px;text-align:center;">Cashier</td>
</tr>
</table>
<br/><br/><br/>
EOD;

$mm="";
$mm ="<br/>";

$mm1="";
$mm1 ="<br/><br/><br/><br/><br/><br/><br/><br/>";	
$tbl.=<<<EOD
$mm1
<table style="" cellpadding="" cellspacing="">
<tr>
<td style="text-align:center">Office Copy</td>
</tr>
</table>
<table style="" cellpadding="" cellspacing="">
<tr><td colspan="3" style="text-align:center;"></td></tr>
<tr>
<td style="width:70px;">
<img src="../../images/Akshaya.JPG" style="width:65px;height:75px;"/>
</td>
<td style="width:480px;">
$mm
	<label style="font-weight:bold;font-size:14px;">AKSHAY BUSINESS HOTEL</label>$mm
	New no:282, Old no:261, Arcot road Vadapalani $mm 
	Chennai - 600 026.$mm 
	Tamilnadu, India$mm 
</td>
<td style="width:269px;margin-left:100px;">
Ph: 044-42697000, 044-2376 3665$mm
Email: reservation@akshayinn.com$mm
</td>
</tr>
</table>

EOD;
$mm2="";
$mm2 ="<br/><br/><br/><br/><br/>";
$tbl.=<<<EOD
$mm2
<table style="" cellpadding="3" cellspacing="">
<tr>
<td style="">Receipt No:&nbsp;$rcptNo</td>
<td style="text-decoration:underline;font-size:10px;font-weight:bold;text-align:center;">Check-in Advance Receipt</td>
<td style="width:400px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:&nbsp;$curDte</td>
</tr>
</table>
EOD;

$tbl.=<<<EOD
$mm2
<table style="" cellpadding="3" cellspacing="3">
<tr>
<td style="width:140px;">Received with thanks from</td><td style="text-decoration: underline dotted #000;width:600px;">$title.&nbsp;$gustNme&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td style="width:92px;">A Sum of Rupees</td><td style="text-decoration: underline dotted #000;width:700px;">$finInWords&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;by $payMde </td>
</tr>
<tr>
<td style="width:195px;">being Advance Payment for Room No</td><td style="text-decoration: underline dotted #000;width:200px;"> $roomNo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td style="width:60px;"></td><td style="width:100px;text-decoration: underline dotted #000;"></td>
</tr>
<br/>
<tr>
<td style="text-decoration:underline;font-size:10px;">Remarks: $remarks</td>
</tr>
</table>

EOD;

$tbl.=<<<EOD
$mm2
<table style="" cellpadding="3" cellspacing="">
<tr>
<td style="text-align:right;">For AKSHAY BUSINESS HOTEL</td>
</tr>
<tr>
<td style="border:1px solid #000;width:80px;">&nbsp;Rs. $amt</td>
</tr>
<br/>
<tr>
	<td style="width:1250px;text-align:center;">Cashier</td>
</tr>
</table>
<br/><br/><br/>
EOD;


	
$pdf->writeHTML($tbl, true, false, false, false,'');
$pdf->Output('example_048.pdf', 'I');