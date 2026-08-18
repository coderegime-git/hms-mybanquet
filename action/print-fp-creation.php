<?php
//error_reporting(0);
//session_start();

include '../../dbconnect.php';
//$pid = $_SESSION['propid'];
date_default_timezone_set('Asia/Kolkata');
require_once('../../pdf-tcpdf/tcpdf.php');
require_once('../../pdf/amountToWords.php');
    class MYPDF extends TCPDF {
protected $last_page_flag = false;

 public function Close() {
    $this->last_page_flag = true;
    parent::Close();
  }
    
}

///////////////// End of class ////////////////////////////
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false); 
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
/* $pdf = new TCPDF('P', PDF_UNIT, "A6", true, 'UTF-8', false);  */
/* $pdf->SetCreator(PDF_CREATOR); */

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

/* $pdf->SetDisplayMode('default','continuous'); */
// set margins
/*  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); */ 
$pdf->SetMargins(20, 10, 5);
$pdf->SetHeaderMargin(1);

//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 40);
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set display mode
$pdf->SetDisplayMode($zoom='fullpage', $layout='TwoColumnRight', $mode='UseNone');

// set pdf viewer preferences
$pdf->setViewerPreferences(array('Duplex' => 'DuplexFlipLongEdge'));


$pdf->SetDisplayMode('default','OneColumn');
$pdf->SetDisplayMode('default','continuous');
// set auto page breaks
 /*  $pdf->SetAutoPageBreak(false, -25);  */
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set font
/* $pdf->AddFont('DejaVuSansCondensed','','DejaVuSansCondensed.ttf',true); */

// add a page
$pdf->AddPage();
$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,10', 'color' => array(0, 128, 0));
// Rounded rectangle
//$pdf->RoundedRect(115, 25, 40, 30, 10.0, '1111', null, $style6);
$pdf->Write(0,'', '', 0, 'R', true, 0, false, false, 0);
/* $pdf->SetFont('DejaVuSans','',12); */
$ttfFile = 'fonts/Calibri_Regular.ttf';
$fontname = TCPDF_FONTS::addTTFfont($ttfFile, 'TrueTypeUnicode', '', 96);  
$pdf->SetFont($fontname,'',12);
$sqlAC=mysql_query("select * from audt_control");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$sqlB=mysql_query("select * from bq_opfpmenuhdr where fpno='".$_GET['fpNum']."'");
$rowB=mysql_fetch_array($sqlB);

$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$rowB['bkno']."' AND hallbook_id='".$rowB['hallbook_id']."'");
$rowBb=mysql_fetch_array($sqlBb);

$sqlrr=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1'");
$rowrr=mysql_fetch_array($sqlrr);
$guest_name=strtoupper($rowBb['guest_name']);
$date=$rowB['bkdate'];
$venue=strtoupper($rowBb['venue']);
$time=$rowBb['from_time'].' To '.$rowBb['to_time'];
$pax=$rowBb['guaranted'].'  Pax';
$incharge=strtoupper($rowBb['contact_person']);
$remarks=strtoupper($rowB['remarks']);
$signb=strtoupper($rowB['signboard']);
$rate='Rs.'.$rowBb['hall_rate'].'/.';
/* $ds=explode('/',$rowB['fpdate']); */
	$ds=explode('/',$rowB['bkdate']);
	$df=$ds[2].'-'.$ds[1].'-'.$ds[0];
	$dys=strtotime($df);
	$day = date("l", $dys);

$mm="";
$mm ="<br/>";

$tbl = <<<EOD
EOD;
$tbl = <<<EOD
<p>PROPOSED MENU FOR $guest_name</p>
EOD;

$tbl.=<<<EOD
<br/>
<table style="font-size:11px;width:100%;padding-bottom:4px;">
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;">DATE</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$date</td>
</tr>
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;">VENUE</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$venue</td>
</tr>
</table>
EOD;
$tbl = <<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
</table>
<table style="font-size:11px;width:100%;padding-bottom:4px;">
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;">TIME</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$time</td>
</tr>
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;">PAX</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$pax</td>
</tr>
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;">INCHARGE</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$incharge</td>
</tr>
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;">RATE</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$rate</td>
</tr>
<br/>
EOD;





$tbl.=<<<EOD

</table>
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
</table>
EOD;
$sqFu=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1' and itemcode!='55555' and grpcode!='oth'");
$x=0;
while($roFu=mysql_fetch_array($sqFu)){
	$x++;
	//$srl=sprintf('%02d', $x);
	$item=strtoupper($roFu['itemname'].'('.$roFu['preference'].')');
$tbl.=<<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$item</td>
</tr>
</table>
EOD;
}
$sqop=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1' and itemcode='55555'");
$x=0;
while($roop=mysql_fetch_array($sqop)){
	$x++;
	//$srl=sprintf('%02d', $x);
	$item=strtoupper($roop['itemname'].' - Rs.'.$roop['rate'].' ('.$roop['preference'].')');
	$tbl.=<<<EOD
	<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"><u>OTHER ITEMS</u></td>
</tr>
</table>
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$item</td>
</tr>
</table>
EOD;
}
$sqop=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1' and grpcode='oth'");
$x=0;
while($roop=mysql_fetch_array($sqop)){
	$x++;
	//$srl=sprintf('%02d', $x);
	$item=strtoupper($roop['itemname'].' - Rs.'.$roop['rate']);
	$tbl.=<<<EOD
	<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"><u>AMENITIES</u></td>
</tr>
</table>
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$item</td>
</tr>
</table>
EOD;
}
$tbl.=<<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
</table>
<table style="font-size:11px;width:100%;padding-bottom:3px;border: 1px solid black;">
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;">SIGNBOARD</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$signb</td>
</tr>
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;">REMARKS</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$remarks</td>
</tr>
</table>
EOD;
$pdf->writeHTML($tbl, true, false, false, false,'');

$pdf->Output('outletBillDuplicate.pdf', 'I');