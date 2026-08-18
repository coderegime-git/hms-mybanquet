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
$pdf->RoundedRect(112, 23, 55, 40, 12.0, '1111', null, $style6);
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
$sqlcm=mysql_query("select * from bq_function where func_code='".$rowBb['funct']."' and status='1'");
$rowcm=mysql_fetch_array($sqlcm);
	$fdesc=$rowcm['description'];
	$func=strtoupper($rowcm['func_desc']);

$str = $rowBb['chief_guest'];
$str2=trim($str, ',');
$str3=explode(',',$str2);
foreach($str3 as $i =>$key) {
if($i==0){
$dvenue=strtoupper($str3[0]);
}else{
$dvenue=strtoupper($str3[0].' '.$fdesc.' '.$str3[1]);
}
}
$dgname='( '.strtoupper($rowBb['guest_name'].'  Welcomes You )');

$sqlrr=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1'");
$rowrr=mysql_fetch_array($sqlrr);
$guest_name=strtoupper($rowBb['guest_name']);
$date=$rowB['bkdate'];
$venue=strtoupper($rowBb['venue']);
$time1=$rowBb['from_time'];
$time=$rowBb['from_time'].' To '.$rowBb['to_time'];
$gpax=$rowBb['guaranted'].'  PAX';
$epax=$rowBb['expected'].'  PAX';
$incharge=strtoupper($rowBb['contact_person']);
$remarks=strtoupper($rowB['remarks']);
$signb=strtoupper($rowB['signboard']);
$rate='Rs.'.$rowBb['hall_rate'].' + GST';
$Mrate=$rowBb['hall_rate'];
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
<table style="width:100%;text-align:left;line-height:15px;font-size:13px;font-weight:700px;"> 
<tr>
<td style="width:100%;border-collopse:collapse;">PROPOSED MENU FOR $guest_name</td>
</tr>
EOD;

$tbl.=<<<EOD
<br/>
<table style="width:100%;border-collopse:collapse;font-size:12px;">
<tr> 
<td style="width:50%;padding:0px;text-align:left;border:none;border-collopse:collapse;">
<table style="width:100%;text-align:left;line-height:15px;"> 
<tr>
<td style="width:50%;border-collopse:collapse;">DATE</td>
<td style="width:50%;border-collopse:collapse;">$date</td>
</tr>

<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;">TIME</td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$time1</td>
</tr>
</table>

<table style="width:100%;text-align:left;line-height:15px;"> 
<tr>
<td style="width:50%;border-collopse:collapse;"></td>
<td style="width:50%;border-collopse:collapse;"></td>
</tr>
<tr>
<td style="width:50%;border-collopse:collapse;"></td>
<td style="width:50%;border-collopse:collapse;"></td>
</tr>
</table>
<table style="width:100%;text-align:left;line-height:15px;">
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;"></td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$func</td>
</tr>
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;">TIME</td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$time</td>
</tr>
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;">VENUE</td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$venue</td>
</tr>
</table>
<table style="width:100%;text-align:left;line-height:15px;"> 
<tr>
<td style="width:50%;border-collopse:collapse;"></td>
<td style="width:50%;border-collopse:collapse;"></td>
</tr>
<tr>
<td style="width:50%;border-collopse:collapse;"></td>
<td style="width:50%;border-collopse:collapse;"></td>
</tr>
</table>
<table style="width:100%;text-align:left;line-height:17px;">
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;">Guaranteed PAX</td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$gpax</td>
</tr>
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;">Expected PAX</td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$epax</td>
</tr>
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;">RATE</td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$rate</td>
</tr>
</table>
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
</table>
<table style="font-size:11px;width:100%;padding-bottom:3px;padding-top:6px;border: 1px solid black;">
<tr>
<td style="width:200%;border-collopse:collapse;text-align:center;">MENU ITEMS</td>
</tr>
</table>
</td>
<td style="width:30%;padding:0px;text-align:center;">
<table style="width:100%;text-align:center;padding-bottom:30px;"> 
<tr>
<td style="width:100%;border-collopse:collapse;"></td>
</tr>
</table>
<table style="width:100%;text-align:center;"> 
<tr>
<td style="width:100%;border-collopse:collapse;">$dvenue</td>
</tr>
<tr>
<td style="width:100%;border-collopse:collapse;">$dgname</td>
</tr>
</table>
</td>
</tr>
</table>
<table style="font-size:11px;width:100%;padding-bottom:20px;padding-top:-80px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
</table>

<br/>
EOD;





$tbl.=<<<EOD

<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
</table>
EOD;

$tbl.=<<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;">

EOD;
$sqFu=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1' GROUP by menugrpcode ");
$x=0;
while($roFu=mysql_fetch_array($sqFu)){
	$x++;
	$srl=sprintf('%02d', $x);
	$rw=mysql_fetch_array(mysql_query("select * from bq_menugrp where menu_code='".$roFu['menugrpcode']."'"));
	$menunm=strtoupper($rw['menu_name']);
$tbl.=<<<EOD
<tr style="">
<td style="width:25%;border-collopse:collapse;">$menunm</td>
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
EOD;
$sqll=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and menugrpcode='".$roFu['menugrpcode']."' and bill_status='1'");
while($roww=mysql_fetch_array($sqll)){
	$mitem=strtoupper($roww['itemname']);
$tbl.=<<<EOD
<tr>
<td style="width:25%;border-collopse:collapse;"></td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$mitem</td>
</tr>
EOD;
}}
$tbl.=<<<EOD


</table>
EOD;

$sqop=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1' and itemcode='55555'");
$x=0;
while($roop=mysql_fetch_array($sqop)){
	$x++;
	//$srl=sprintf('%02d', $x);
	$item=strtoupper($roop['itemname'].' - Rs.'.$rowBb['guaranted']*$roop['rate'].' ('.$roop['preference'].')');
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
$sqop=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1' and catcode='oth'");
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
<table style="font-size:11px;width:100%;padding-bottom:3px;padding-top:6px;border: 1px solid black;">
<tr>
<td style="width:100%;border-collopse:collapse;text-align:center;">SPECIAL INSTRUCTIONS</td>
</tr>
</table>
EOD;
$tbl.=<<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;padding-top:6px;">
EOD;
$sqFu=mysql_query("select * from bq_opfpdeptinst where fpno='".$rowB['fpno']."' AND bill_status!='3'");
$x=0;
while($roFu=mysql_fetch_array($sqFu)){
	$x++;
	$rw=mysql_fetch_array(mysql_query("select * from bq_deptmt where dept_code='".$roFu['deptcode']."'"));
	$depname=strtoupper($rw['dept_name']);
$tbl.=<<<EOD
<tr style="">
<td style="width:25%;border-collopse:collapse;">$depname</td>
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
EOD;
$str=$roFu['deptdesc'];
$rt=(explode("\n",trim($str)));
for($cc=0;$cc<count($rt);$cc++){
$ww=wordwrap($rt[$cc],70,"<br>\n");
$wT=strtoupper($ww).'<br/>';
$tbl.=<<<EOD
<tr>
<td style="width:25%;border-collopse:collapse;"></td>
<td style="width:25%;border-collopse:collapse;padding: 2px;">$wT</td>
</tr>
EOD;
} 
 } 
$tbl.=<<<EOD
</table>
EOD;
$tbl.=<<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
</table>
<table style="font-size:11px;width:100%;padding-bottom:3px;padding-top:3px;border: 1px solid black;">
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: 1px solid black;">MENU A</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: 1px solid black;">$Mrate</td>
</tr>
<tr>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: 1px solid black;">TOTAL</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: 1px solid black;">$Mrate</td>
</tr>
</table>
EOD;
$pdf->writeHTML($tbl, true, false, false, false,'');

$pdf->Output('outletBillDuplicate.pdf', 'I');