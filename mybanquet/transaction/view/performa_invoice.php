<?php
//error_reporting(0);
//session_start();

include '../../dbconnect.php';
//$pid = $_SESSION['propid'];
date_default_timezone_set('Asia/Kolkata');
require_once('../../pdf-tcpdf/tcpdf.php');
require_once('../../pdf/amountToWords.php');
	$bkN=$_GET['bkNo'];
    class MYPDF extends TCPDF {
protected $last_page_flag = false;

 public function Close() {
    $this->last_page_flag = true;
    parent::Close();
  }
	

    public function Header() {
$sqlR=mysql_query("select * from property_definition");
$rowPd=mysql_fetch_array($sqlR);
$statecode = $rowPd['gst_code'];
$city = $rowPd['city'];		
$add=$rowPd['address1'];
$add5=$rowPd['address2'];
$add1=$rowPd['city'].' - '.$rowPd['pin_code'].', '.$rowPd['country'];
$add9= $rowPd['phone'];
$add2= $rowPd['mobile'];
$add3=$rowPd['email']; 
$add4=$rowPd['email1']; 
$header_image=$rowPd['header_image'];
$prop_name=$rowPd['prop_name'];
$logo_text=$rowPd['logo_text'];
$gststate=$rowPd['gst_state'];
$service_tax=$rowPd['service_tax'];
$ttfFile = 'fonts/BeVietnam-Regular.ttf';
$fontname = TCPDF_FONTS::addTTFfont($ttfFile, 'TrueTypeUnicode', '', 96);
  $home_path='http://'.$_SERVER['HTTP_HOST'].'/hms';  
$this->SetFont($fontname, 'C', 11);
//$pdf->SetFont($fontname,'',12);
//$regoffice=$rowPd['regoffice'];
		$html = '<table style="width:100%;border:none;font-size:11px;"> 
<tr style="border-bottom:0px solid black;"> 
<td style="width:50%;border:none;">
<table style=" width: 50%;text-align: right;">
<tr>
<td><div style="text-align: left;
    float: left;
    position: absolute;"><img src="'.$home_path.'/img/headerimg/'.$header_image.'" style="margin-top:20px;" /></div></td>           
</tr>
</table>
</td>
<td>
<table style=" width: 100%;text-align: right;">
<tr>
<td colspan=6><div style="font-weight:bold;font-size:20px;">'.$prop_name.'</div></td>
</tr>
<tr>
<td colspan=6><div style="font-size: 12px;">'.$logo_text.'</div></td>
</tr>
<tr>
<td colspan=6><div style="font-size: 12px;">'.$add.'</div></td>
</tr>
<tr>
<td colspan=6><div style="font-size: 12px;">'.$add1.'</div></td>
</tr>
<tr>
<td colspan=6><div style="font-size: 12px;">Tel No :  '.$add9.','.$add2.'</div></td>
</tr>
<tr>
<td colspan=6><div style="font-size: 12px;">Email :  '.$add3.'</div></td>
</tr>
<tr>
<td colspan=6><div style="font-size: 12px;">Website:  '.$add4.' </div></td>
</tr>
</table>
</td>
</tr>
</table>';
		$this->writeHTML($html, true, false, false, false, '');
    }

    // Page footer
    public function Footer() {
        // Position at 25 mm from bottom
		$ttfFile = 'fonts/BeVietnam-Regular.ttf';
$fontname = TCPDF_FONTS::addTTFfont($ttfFile, 'TrueTypeUnicode', '', 96);
  $home_path='http://'.$_SERVER['HTTP_HOST'].'/hms';  
$this->SetFont($fontname, 'C', 11);
		$blN=$_GET['PIno'];
$sqlR=mysql_query("select * from property_definition");
$rowPd=mysql_fetch_array($sqlR);
$service_tax=$rowPd['service_tax'];
$gst_state=$rowPd['gst_state'];
  $gst_code=$rowPd['gst_code'];

$aWords = new Currency();

$totalPageCount = $this->getNumPages();;
$html='';

if($this->PageNo() == 1){
	$bkN=$_GET['bkNo'];
$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$bkN."'");
$rowBb=mysql_fetch_array($sqlBb);
$top_code=$rowBb['top_code'];
$rwSt=mysql_fetch_array(mysql_query("select state_name from states where state_code='".$rowBb['state']."'"));
$Stated=strtoupper($rwSt['state_name']);
$rwB=mysql_fetch_array(mysql_query("select bill_desc from bq_billinstruc where bill_code='".$top_code."'"));
$billi=ucfirst($rwB['bill_desc']);
$Mrate=$rowBb['plan_rate'];
$Epax=$rowBb['guaranted'];
$Tpax1=sprintf("%01.2f",$Mrate*$Epax);
$Tpax2=sprintf("%01.2f",$rowBb['hall_rate']*1);
$totval=sprintf("%01.2f",$Tpax1+$Tpax2);
$tax=$totval*18/100;
$gst=sprintf("%01.2f",$tax/2);
$net=sprintf("%01.2f",$totval+$tax);

$aWords = new Currency();
$finInWords =ucfirst($aWords->get_bd_amount_in_text(round($net,2)));
$html.='
<hr/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:67%;">
</td>
<td style="width:33%;">
<table>
<tr>
<td style="text-align:right;">Sub Total</td>
<td style="text-align:right;">'.$totval.'</td>
</tr>
<tr>
<td style="text-align:right;">CGST 9%</td>
<td style="text-align:right;">'.$gst.'</td>
</tr>
<tr>
<td style="text-align:right;">SGST 9%</td>
<td style="text-align:right;">'.$gst.'</td>
</tr>
<tr>
<hr/>
<td style="text-align:right;font-weight:bold;line-height:20px;">Net Amount</td>
<td style="text-align:right;">'.$net.'</td>
</tr>';

$html.='</table>
</td>
</tr>
</table>
<hr/>
<br/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:100%;text-align:left;font-weight:bold;">('.$finInWords.')</td>
</tr>
</table>
<hr/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:60%;text-align:left;">GSTIN : '.$service_tax.'</td>
<td style="width:40%;text-align:right;">State: '.$gst_state.'</td>
</tr>
</table>
<hr/>
<br/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:30px;">
<tr>
<td style="width:30%;text-align:left;border-right:1px solid black;"></td>
<td style="width:40%;text-align:center;border-right:1px solid black;"></td>
<td style="width:30%;text-align:right;"></td>
</tr>
</table>
<table style="width:100%;font-size:13px;padding-bottom:6px;">
<tr>
<td style="width:30%;text-align:left;border-right:1px solid black;">Cashier Signature</td>
<td style="width:40%;text-align:center;border-right:1px solid black;">Billing Instruction :'.$billi.'</td>
<td style="width:30%;text-align:center;">Guest Signature</td>
</tr>
</table>
<hr/>
<!--<table style="width:100%;font-size:13px;padding-bottom:6px;">
<tr>
<td style="width:100%;text-align:CENTER;">(This Invoice is computer generated)</td>
</tr>
</table>-->';
}

       $this->writeHTML($html, true, false, false, false, '');
    }
    
}

///////////////// End of class ////////////////////////////
$slGnr=mysql_query("SELECT count(*) as cnt FROM `hms_parameters` WHERE description = 'Enable Footer type'");
$rwGnr=mysql_fetch_array($slGnr);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false); 
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "A4", true, 'UTF-8', false);
/* $pdf = new TCPDF('P', PDF_UNIT, "A6", true, 'UTF-8', false);  */
/* $pdf->SetCreator(PDF_CREATOR); */

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

/* $pdf->SetDisplayMode('default','continuous'); */
// set margins
/*  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT); */ 
$pdf->SetMargins(5, 50, 5);
$pdf->SetHeaderMargin(7);
if($rwGnr['cnt'] == '1')
{
$pdf->SetFooterMargin(65); 
}else{
$pdf->SetFooterMargin(110); 
}
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
$pdf->Write(0,'', '', 0, 'R', true, 0, false, false, 0);
/* $pdf->SetFont('DejaVuSans','',12); */
$ttfFile = 'fonts/BeVietnam-Regular.ttf';
$fontname = TCPDF_FONTS::addTTFfont($ttfFile, 'TrueTypeUnicode', '', 96);
    
$pdf->SetFont($fontname,'',12);
$blN=$_GET['PIno'];
$type = 'O';
$sqlAC=mysql_query("select * from audt_control");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];


$sqlhb=mysql_query("select * from bq_hallbooking where booking_no='".$bkN."'");
$rowhb=mysql_fetch_array($sqlhb);
//echo "select * from bq_opfpmenuhdr where bkno='".$rowB['bkno']."' and fpno='".$rowB['fpno']."'";

$sqlfn=mysql_query("select func_code,func_desc from bq_function where func_code='".$rowhb['funct']."'");
$rowfn=mysql_fetch_array($sqlfn);
$fnct=strtoupper($rowfn['func_desc']);


$sqlv=mysql_query("select * from bq_venue where venue_code='".$rowhb['venue']."' AND status ='1'");
$rovv=mysql_fetch_array($sqlv);
$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$bkN."'");
$rowBb=mysql_fetch_array($sqlBb);
 if($rowBb['title']!=""){
	$title=$rowBb['title'];
}else{
	$title="";
}
$tname=strtoupper($title.'. '.$rowBb["guest_name"]);
$gadd1=strtoupper($rowBb["address1"]);
$gadd2=strtoupper($rowBb["address2"]);
$gadd3=strtoupper($rowBb["city"]).'  '.$rowBb["pin"];
$ggst=strtoupper($rowBb['gstin']);
$hall=strtoupper($rovv['venue_desc']);
$billno=$blN;
$bkdt=$rowBb['book_date'];
$exp=$rowBb['guaranted'];
$bkno=$rowBb['booking_no'];

$sqlR=mysql_query("select * from property_definition");
$rowPd=mysql_fetch_array($sqlR);
$statecode = $rowPd['gst_code'];
$city = $rowPd['city'];		
$add=$rowPd['address1'];
$add5=$rowPd['address2'];
$add1=$rowPd['city'].' - '.$rowPd['pin_code'].', '.$rowPd['country'];
$add9= $rowPd['phone'];
$add2= $rowPd['mobile'];
$add3=$rowPd['email']; 
$add4=$rowPd['email1']; 
$header_image=$rowPd['header_image'];
$prop_name=$rowPd['prop_name'];
$logo_text=$rowPd['logo_text'];
$service_tax=$rowPd['service_tax'];
$gst_state=$rowPd['gst_state'];
$gst_code=$rowPd['gst_code'];

$mm="";
$mm ="<br/>";

$tbl = <<<EOD
EOD;

$tbl.=<<<EOD
<br/>
<table style="width:100%;border-top:1px solid black;border-bottom:1px solid black;font-size:11px;">
<tr>
<td><div style="font-weight:bold;text-align:center;font-size:19px;">Performa Invoice</div></td>
</tr>
</table>
EOD;


$tbl.=<<<EOD
<table id="comty"  style="width:100%;border-collopse:collapse;padding: 2px;font-size:11px;padding-bottom:10px;"> 
<tr style="width:40%;padding:0px;text-align:center;"> 
<td style="width:50%;padding:0px;text-align:left;border-right:1px solid black;" >
$tname<br/>
$gadd1<br/>
$gadd2<br/>
$gadd3<br/>
GSTIN : $ggst
</td> 
<td style="width:25%;padding:0px;text-align:center;" >
<table>
<tr>
<td style="font-weight:bold;width:50%;padding:0px;text-align:left;">Bill No :</td>
<td style="width:50%;padding:0px;text-align:left;">$billno</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">Function name:</td>
<td style="width:50%;padding:0px;text-align:left;">$fnct</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">Venue:</td>
<td style="width:50%;padding:0px;text-align:left;">$hall</td>
</tr>
</table>
</td> 
<td style="width:25%;padding:0px;text-align:center;">
<table>
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">Booking Date :</td>
<td style="width:50%;padding:0px;text-align:left;">$bkdt</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">Pax:</td>
<td style="width:50%;padding:0px;text-align:left;">$exp</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">Reservation No:</td>
<td style="width:50%;padding:0px;text-align:left;">$bkno</td>
</tr>
</table>
</td> 
</tr>
</table>
EOD;
$tbl.=<<<EOD
<table style="font-size:12px;">
<tr style="line-height:20px;">
<th style="border-top: 1px solid black;width:40%;border-bottom: 1px solid black;border-collopse:collapse;padding: 0px;font-weight:bold;">PARTICULARS</th>
<th style="border-top: 1px solid black;text-align:left;width:20%;border-bottom: 1px solid black;border-collopse:collapse;font-weight:bold;">QTY</th>
<th style="border-top: 1px solid black;width:20%;text-align:right;border-bottom: 1px solid black;border-collopse:collapse;font-weight:bold;">UNIT RATE</th>
<th style="border-top: 1px solid black;text-align:right;width:20%;border-bottom: 1px solid black;border-collopse:collapse;font-weight:bold;">AMOUNT</th>
</tr>
EOD;
if($rowBb['plan_rate'] > 0){
	$menuA='Food';
$Mrate=$rowBb['plan_rate'];
$Epax=$rowBb['guaranted'];
$Tpax1=sprintf("%01.2f",$Mrate*$Epax);
$tbl.=<<<EOD
<tr>
<td style="width:40%;border-collopse:collapse;padding: 2px;text-align:left;">$menuA</td>
<td style="width:20%;border-collopse:collapse;padding: 2px;text-align:left;">$Epax</td>
<td style="width:20%;border-collopse:collapse;padding: 2px;text-align:right;">$Mrate</td>
<td style="width:20%;border-collopse:collapse;padding: 2px;text-align:right;">$Tpax1</td>
</tr>
EOD;
}
if($rowBb['hall_rate']>0){
	$menuA='Hall Rate';
	$Epax='1';
$Mrate=$rowBb['hall_rate'];
$Tpax2=sprintf("%01.2f",$Mrate*$Epax);
	$tbl.=<<<EOD
<tr>
<td style="width:40%;border-collopse:collapse;padding: 2px;text-align:left;">$menuA</td>
<td style="width:20%;border-collopse:collapse;padding: 2px;text-align:left;">$Epax</td>
<td style="width:20%;border-collopse:collapse;padding: 2px;text-align:right;">$Mrate</td>
<td style="width:20%;border-collopse:collapse;padding: 2px;text-align:right;">$Tpax2</td>
</tr>
</table>
EOD;
}

$pdf->writeHTML($tbl, true, false, false, false,'');

$pdf->Output('outletBillDuplicate.pdf', 'I');
