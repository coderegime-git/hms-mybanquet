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
//$pdf->RoundedRect(112, 23, 55, 40, 12.0, '1111', null, $style6);
//$pdf->Write(0,'', '', 0, 'R', true, 0, false, false, 0);
/* $pdf->SetFont('DejaVuSans','',12); */
$ttfFile = 'fonts/Calibri_Regular.ttf';
$fontname = TCPDF_FONTS::addTTFfont($ttfFile, 'TrueTypeUnicode', '', 96);  
//$pdf->SetFont($fontname,'',12);
$pdf->SetFont('helvetica', '', 7);

$sqlAC=mysql_query("select * from audt_control");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$sqlB=mysql_query("select * from bq_opfpmenuhdr where fpno='".$_GET['fpNum']."'");
$rowB=mysql_fetch_array($sqlB);
$remarks=$rowB['remarks'];
$sign=strtoupper($rowB['signboard']);
//die();
$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$rowB['bkno']."' AND hallbook_id='".$rowB['hallbook_id']."'");
$rowBb=mysql_fetch_array($sqlBb);
$sqlcm=mysql_query("select * from bq_function where func_code='".$rowBb['funct']."' and status='1'");
$rowcm=mysql_fetch_array($sqlcm);
$sqlv=mysql_query("select * from bq_venue where venue_code='".$rowBb['venue']."' AND status ='1'");
$rov=mysql_fetch_array($sqlv);
	//$fdesc=$rowcm['description'];
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
$title=strtoupper($rowBb['title']);
$guest_name=strtoupper($title.' . '.$rowBb['guest_name']);
$date=$rowB['bkdate'];
$venue=strtoupper($rov['venue_desc']);
$time1=$rowBb['from_time'];
$time=$rowBb['from_time'].' To '.$rowBb['to_time'];
$gpax=$rowBb['guaranted'].'  PAX';
$epax=$rowBb['expected'].'  PAX';
$incharge=strtoupper($rowBb['contact_person']);
$remarks=strtoupper($rowB['remarks']);
$signb=strtoupper($rowB['signboard']);
$rate='Rs.'.$rowB['ratechrg'].' + GST';


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
<table style="width:100%;text-align:center;line-height:15px;font-size:11px;font-weight:700px;"> 
<tr>
<td style="width:100%;border-collopse:collapse;"><b>FUNCTION PROSPRCTUS OF $guest_name</b></td>
</tr>
EOD;

$tbl.=<<<EOD
<br/>
<table style="width:100%;border-collopse:collapse;font-size:11px;">
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
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;border: 1px solid black;"><b>SIGNBOARD</b></td>
<td style="width:113%;border-collopse:collapse;padding: 2px;border: 1px solid black;">$sign</td>
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
<td style="width:50%;border-collopse:collapse;padding: 2px;">FUNCTION</td>
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
<td style="width:50%;border-collopse:collapse;padding: 2px;">GUARANTEED PAX</td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$gpax</td>
</tr>
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;">EXPECTED PAX</td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$epax</td>
</tr>
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;">RATE</td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$rate</td>
</tr>
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;"><b>REMARKS</b></td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$remarks</td>
</tr>
</table>
EOD;
$tbl.=<<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;padding-top:6px;">
<tr>
<td style="width:100%;border-collopse:collapse;text-align:left;"><b>SPECIAL INSTRUCTIONS</b></td>
</tr>
</table>
EOD;
$sAC=mysql_query("select * from bq_opfpdeptinst where fpno='".$rowB['fpno']."' AND bill_status!='3'");
if(mysql_num_rows($sAC)==0){
$tbl.=<<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;padding-top:6px;">
<tr>
<td style="width:50%;border-collopse:collapse;padding: 2px;border: 1px solid black;"></td>
<td style="width:113%;border-collopse:collapse;padding: 2px;border: 1px solid black;"></td>
</tr>
</table>
EOD;
}
$tbl.=<<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;padding-top:6px;line-height:3px;border: 1px solid black;">
EOD;
$sqFu=mysql_query("select * from bq_opfpdeptinst where fpno='".$rowB['fpno']."' AND bill_status!='3'");
$x=0;
while($roFu=mysql_fetch_array($sqFu)){
	$x++;
	$rw=mysql_fetch_array(mysql_query("select * from bq_deptmt where dept_code='".$roFu['deptcode']."'"));
	$depname=strtoupper($rw['dept_name']);
$tbl.=<<<EOD
<tr style="">
<td style="width:50%;border-collopse:collapse;padding: 2px;border: 1px solid black;">$depname</td>
EOD;
$str=$roFu['deptdesc'];
$rt=(explode("\n",trim($str)));
for($cc=0;$cc<count($rt);$cc++){
$ww=wordwrap($rt[$cc],70,"<br>\n");
$wT=strtoupper($ww).'<br/>';
$tbl.=<<<EOD
<td style="width:113%;border-collopse:collapse;padding: 2px;border: 1px solid black;">$wT</td>
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
<table style="font-size:11px;width:100%;padding-top:6px;">
<tr>
<td style="width:200%;border-collopse:collapse;text-align:left;"><b>MENU ITEMS</b></td>
</tr>
</table>
</td>
<td style="width:30%;padding:0px;text-align:center;">
<table style="width:100%;text-align:center;padding-bottom:30px;"> 
<tr>
<td style="width:100%;border-collopse:collapse;"></td>
</tr>
</table>
<!--<table style="width:100%;text-align:center;"> 
<tr>
<td style="width:100%;border-collopse:collapse;">$dvenue</td>
</tr>
<tr>
<td style="width:100%;border-collopse:collapse;">$dgname</td>
</tr>
</table>-->
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
$sqFu=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and itemcode!='55555' and bill_status='1' GROUP by menugrpcode ");
$x=0;
while($roFu=mysql_fetch_array($sqFu)){
	$x++;
	$srl=sprintf('%02d', $x);
	$rw=mysql_fetch_array(mysql_query("select * from bq_menugrp where menu_code='".$roFu['menugrpcode']."'"));
	$menunm=strtoupper($rw['menu_name']);
	if($menunm=='OTHERS'){
	$mnu='AMENITIES';
	}else{
	$mnu=$menunm;
	}
$tbl.=<<<EOD
<tr style="">
<td style="width:25%;border-collopse:collapse;">$mnu</td>
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
EOD;
$sqll=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and itemcode!='55555' and menugrpcode='".$roFu['menugrpcode']."' and bill_status='1'");
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


	$tbl.=<<<EOD
	<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"><b>OTHER ITEMS</b></td>
</tr>
</table>
EOD;
$sqop=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1' and itemcode='55555'");
$x=0;
while($roop=mysql_fetch_array($sqop)){
	$x++;
	//$srl=sprintf('%02d', $x);
	//$item=strtoupper($roop['itemname'].' - Rs.'.$roop['qty']*$roop['rate'].' ('.$roop['preference'].')');
	$item=strtoupper($roop['itemname'].' - '.$roop['qty']);
	$tbl.=<<<EOD
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
<td style="width:50%;border-collopse:collapse;padding: 2px;">$item</td>
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
<table style="font-size:11px;width:100%;padding-bottom:3px;">
<tr style="">
<td style="width:25%;border-collopse:collapse;"></td>
</tr>
</table>
<table style="font-size:11px;width:100%;padding-bottom:3px;padding-top:3px;border: 1px solid black;">
<tr>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:center;">DESCRIPTION</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">ITEM NAME</td>
<td style="width:10%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">QTY</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">RATE</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">TOTAL</td>
</tr>
EOD;
$Tpax1=0;$Tpax2=0;
$sqlrr=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1'");
$rowrr=mysql_fetch_array($sqlrr);
$sqlsb=mysql_query("select * from bq_menumaster where status='1' and menu_code='".$rowB['menu_code']."'");
$rowsb=mysql_fetch_array($sqlsb);
$menuA=$rowsb['menu_name'];
if($rowB['ratechrg'] > 0){
$Mrate=$rowB['ratechrg'];
$Epax=$rowB['grpax'];
$Tpax1=sprintf("%01.2f",$Mrate*$Epax);
$tbl.=<<<EOD
<tr>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:center;">$menuA</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;"></td>
<td style="width:10%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$Epax</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$Mrate</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">$Tpax1</td>
</tr>
EOD;
}
if($rowB['hallchrg'] > 0){
$menuA='Hall Charge';
$Epax='1';
$Mrate=$rowB['hallchrg'];
$Tpax2=sprintf("%01.2f",$Mrate*$Epax);
$tbl.=<<<EOD
<tr>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:center;">$menuA</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;"></td>
<td style="width:10%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$Epax</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$Mrate</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">$Tpax2</td>
</tr>
EOD;
}
$sqop=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1' and itemcode='55555'");
$x=0;$GtoO=0;
while($roop=mysql_fetch_array($sqop)){
	$x++;
	//$srl=sprintf('%02d', $x);
	$item=strtoupper($roop['itemname']);
	$qty=$roop['qty'];
	$rate=$roop['rate'];
	$total=sprintf("%01.2f",$qty*$rate);
	$GtoO+=$total;
	
	
	
	if($x=='1'){
	$itm='OTHER ITEMS';
	}else{
	$itm='';
	}
$tbl.=<<<EOD
<tr>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:center;">$itm</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$item</td>
<td style="width:10%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$qty</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$rate</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">$total</td>
</tr>
EOD;
//echo $Ggtot;
}
$sqop=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1' and catcode='oth'");
$x=0;$GtotA=0;
while($roop=mysql_fetch_array($sqop)){
	$x++;
	//$srl=sprintf('%02d', $x);
	$item=strtoupper($roop['itemname']);
	$qty=$roop['qty'];
	$rate=$roop['rate'];
	$total=sprintf("%01.2f",$qty*$rate);
	$GtotA+=$total;
	
	
	
	if($x=='1'){
	$itm='AMENITIES';
	}else{
	$itm='';
	}
$tbl.=<<<EOD
<tr>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:center;">$itm</td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$item</td>
<td style="width:10%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$qty</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:left;">$rate</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">$total</td>
</tr>
EOD;
//echo $Ggtot;
}
if(isset($GtotA) && $GtotA!=""){$totGA=$GtotA;}else{$totGA="0";}
if(isset($GtoO) && $GtoO!=""){$totGO=$GtoO;}else{$totGO="0";}
$totval=sprintf("%01.2f",$totGA+$totGO+$Tpax1+$Tpax2);
$tbl.=<<<EOD
</table>
<table style="font-size:12px;width:100%;padding-bottom:3px;border: none;">
<tr>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: none;text-align:center;"></td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: none;text-align:left;"></td>
<td style="width:10%;border-collopse:collapse;padding: 2px;border: none;text-align:left;"></td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">Sub Total</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">$totval</td>
</tr>
EOD;
$tax=$totval*18/100;
$gst=sprintf("%01.2f",$tax/2);
$net=sprintf("%01.2f",$totval+$tax);
$tbl.=<<<EOD
<tr>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: none;text-align:center;"></td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: none;text-align:left;"></td>
<td style="width:10%;border-collopse:collapse;padding: 2px;border: none;text-align:left;"></td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">SGST 9%</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">$gst</td>
</tr>
<tr>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: none;text-align:center;"></td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: none;text-align:left;"></td>
<td style="width:10%;border-collopse:collapse;padding: 2px;border: none;text-align:left;"></td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">CGST 9%</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">$gst</td>
</tr>
<tr>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: none;text-align:center;"></td>
<td style="width:25%;border-collopse:collapse;padding: 2px;border: none;text-align:left;"></td>
<td style="width:10%;border-collopse:collapse;padding: 2px;border: none;text-align:left;"></td>
<td style="width:15%;border-collopse:collapse;padding: 4px;border: 1px solid black;text-align:right;">Net amount</td>
<td style="width:15%;border-collopse:collapse;padding: 2px;border: 1px solid black;text-align:right;">$net</td>
</tr>
</table>
EOD;
$pdf->writeHTML($tbl, true, false, false, false,'');

$pdf->Output('outletBillDuplicate.pdf', 'I');