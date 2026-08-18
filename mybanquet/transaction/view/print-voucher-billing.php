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
$service_tax=$rowPd['service_tax'];
$ttfFile = 'fonts/Calibri_Regular.ttf';
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
    position: absolute;"><img src="'.$home_path.'/img/headerimg/'.$header_image.'" style="width:1050%;" /></div></td>           
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
<td colspan=6><div style="font-size: 12px;">'.$add5.',</div></td>
</tr>
<tr>
<td colspan=6><div style="font-size: 12px;">'.$add1.'</div></td>
</tr>
<tr>
<td colspan=6><div style="font-size: 12px;">Tel No :  '.$add9.','.$add2.'</div></td>
</tr>
<tr>
<td colspan=6><div style="font-size: 12px;">Email :  '.$add3.' Website:  '.$add4.' </div></td>
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
		$ttfFile = 'fonts/Calibri_Regular.ttf';
$fontname = TCPDF_FONTS::addTTFfont($ttfFile, 'TrueTypeUnicode', '', 96);
  $home_path='http://'.$_SERVER['HTTP_HOST'].'/hms';  
$this->SetFont($fontname, 'C', 11);
		$VucNo=$_GET['vuNum'];
$sqlR=mysql_query("select * from property_definition");
$rowPd=mysql_fetch_array($sqlR);
$service_tax=$rowPd['service_tax'];
$gst_state=$rowPd['gst_state'];
  $gst_code=$rowPd['gst_code'];
	$sqllG=mysql_query("select * from bq_opbillhdtl where bill_no='".$VucNo."' ");
$count_no_rows=mysql_num_rows($sqllG);	
		
		

		
	$sqlrr=mysql_query("select * from bq_opbillhdr where bill_no='".$VucNo."'");
$rowrr=mysql_fetch_array($sqlrr);	

    $payamt = round($rowrr['nontaxableamt']+$rowrr['taxableamt']);
	

	
//$finTot = $rowrr['tax_total']+$datyr;
$aWords = new Currency();
//$finInWords =ucfirst($aWords->get_bd_amount_in_text(round($tryuo,2)));

$user = $rowrr['added_by'];
$sqS=mysql_query("select * from bq_opbillhdtl where bill_no='".$_GET['vuNum']."' AND bill_status!='3'");
$tax_valGT=0;$debitGT=0;$creditGT=0;
while($rowS=mysql_fetch_array($sqS)) {
	
	
}
$totalPageCount = $this->getNumPages();;
$html='';
if($count_no_rows > 35)
{

 if ($this->last_page_flag) {
     $html.='
<hr/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:67%;">
<br/>
</td>
<td style="width:33%;">
<table>
<tr>
<td style="text-align:right;">Total</td>
<td style="text-align:right;">tt</td>
</tr>
<tr>
<td style="text-align:right;">ADV Paid</td>
<td style="text-align:right;">ap</td>
</tr>
<tr>
<td style="text-align:right;">Round Off</td>
<td style="text-align:right;">r</td>
</tr>
<tr>
<td style="text-align:right;">settled by</td>
<td style="text-align:right;">admin</td>
</tr>
<tr>
<td style="text-align:right;">Payable Amount</td>
<td style="text-align:right;">0.00</td>
</tr>
</table>
</td>
</tr>
</table>
<hr/>
<br/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:60%;text-align:left;">GSTIN : '.$service_tax.'</td>
<td style="width:30%;text-align:right;">State: PUDUCHERRY</td>
<td style="width:10%;text-align:right;">ST Code: 34</td>
</tr>
</table>
<hr/>
<br/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:100%;text-align:left;">
 I Agree that I am responsible for the full payment of this bill in the event it is not paid by the Company,Organisation or Person indicated
</td>
</tr>
</table>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:60%;text-align:left;">
Cashier s Signature
</td>
<td style="width:40%;text-align:right;">
Guest Signature
</td>
</tr>
</table>
<hr/>';
	
}
}else
{
if($this->PageNo() == 1){

$sqS=mysql_query("select * from bq_opvchrdtl where vouchrno='".$VucNo."'");
$tax_valGT=0;$debitGT=0;$creditGT=0;$totl=0;
while($rowS=mysql_fetch_array($sqS)) {
	$totl+=sprintf("%01.2f",$rowS['item_qty']*$rowS['item_rate']);
	$vouchrno=$rowS['vouchrno'];
}
$rBq=mysql_query("select sum(taxamt)as tx from bq_opvchrtaxdtl where vouchrno='".$vouchrno."' group by taxcode");
$taxAamtt2=0;
while($roTru=mysql_fetch_array($rBq)) {	
$taxAamtt2+=sprintf("%01.2f",$roTru['tx']);
}
//echo $taxAamtt2;
$taxtot=sprintf("%01.2f",$taxAamtt2/2);
//$taxAamtG=$rBq['taxamt']+$rBq['taxamt'];
$rBev=mysql_fetch_array(mysql_query("select sum(taxamt)as tx from bq_opvchrtaxdtl where vouchrno='".$vouchrno."' AND bill_status!='3' and taxcode='BEV'"));
$taxAamtB=$rBev['tx'];
/*$taxB=$rBev['item_total']*28/100;
$gstBv=sprintf("%01.2f",$taxB/2);
$cessB=$rBev['item_total']*12/100;
$cesBv=sprintf("%01.2f",$cessB);*/
$gstBv='0.00';
$cesBv='0.00';
$billamt=sprintf("%01.2f",$totl+$taxAamtt2+$taxAamtB);
$sqAd=mysql_query("select SUM(advamt)AS advAamt from bq_opvchrhdr where vouchrno='".$_GET['vuNum']."' AND advamt>0 AND advamt!='Null'");
if(mysql_num_rows($sqAd)>0){
$roAd=mysql_fetch_array($sqAd);
}
$sign='-';
$tt=round($roAd['advAamt']);
$adv=sprintf("%01.2f",$sign.$tt);
 $totAmt=$totl+$taxAamtt2+$taxAamtB-$roAd['advAamt'];
 $netamt=sprintf("%01.2f",$totAmt);
$html.='
<hr/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:67%;"><br/>
</td>
<td style="width:33%;">
<table>
<tr>
<td style="text-align:right;">Sub Total</td>
<td style="text-align:right;">'.sprintf("%01.2f",$totl).'</td>
</tr>
<tr>
<td style="text-align:right;">SGST 9%</td>
<td style="text-align:right;">'.$taxtot.'</td>
</tr>
<tr>
<td style="text-align:right;">CGST 9%</td>
<td style="text-align:right;">'.$taxtot.'</td>
</tr>
<!--<tr>
<td style="text-align:right;">CGST 14%</td>
<td style="text-align:right;">'.$gstBv.'</td>
</tr>
<tr>
<td style="text-align:right;">CGST 14%</td>
<td style="text-align:right;">'.$gstBv.'</td>
</tr>
<tr>
<td style="text-align:right;">CESS 12%</td>
<td style="text-align:right;">'.$cesBv.'</td>
</tr>-->
<tr>
<hr/>
<td style="text-align:right;">Bill Amount</td>
<td style="text-align:right;">'.$billamt.'</td>
</tr>
<hr/>
<tr>
<td style="text-align:right;">Advance</td>
<td style="text-align:right;">'.$adv.'</td>
</tr>
<tr>
<hr/>
<td style="text-align:right;">Net Amount</td>
<td style="text-align:right;">'.$netamt.'</td>
</tr>
</table>
</td>
</tr>
</table>
<hr/>
<br/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:10%;text-align:left;">Remarks</td>
<td style="width:90%;text-align:right;"></td>
</tr>
</table>
<hr/>
<br/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<!--<tr>
<td style="width:100%;text-align:left;">I/We hereby agree to pay for the above mentioned items. I/We have signed this going through the number and quantity of the items. Further, I/We hereby agree to pay the bill in full which is raised as per this challan without any deductions.</td>
</tr>--->
</table>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:30px;">
<tr>
<td style="width:50%;text-align:left;"></td>
<td style="width:50%;text-align:right;"></td>
</tr>
</table>
<table style="width:100%;font-size:13px;padding-bottom:6px;">
<tr>
<td style="width:50%;text-align:left;">GUEST SIGNATURE</td>
<td style="width:50%;text-align:right;">CASHIER</td>
</tr>
</table>
<hr/>';
}
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
$pdf->SetMargins(5, 40, 5);
$pdf->SetHeaderMargin(7);
if($rwGnr['cnt'] == '1')
{
$pdf->SetFooterMargin(65); 
}else{
$pdf->SetFooterMargin(90); 
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
$ttfFile = 'fonts/Calibri_Regular.ttf';
$fontname = TCPDF_FONTS::addTTFfont($ttfFile, 'TrueTypeUnicode', '', 96);
    
$pdf->SetFont($fontname,'',12);
$VucNo=$_GET['vuNum'];
$type = 'O';
$sqlAC=mysql_query("select * from audt_control");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$sqlrr=mysql_query("select * from bq_opvchrhdr where vouchrno='".$VucNo."'");
$rowB=mysql_fetch_array($sqlrr);

$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$rowB['bkno']."' and fpno='".$rowB['fpno']."'");
$rowBb=mysql_fetch_array($sqlBb);

$sqlV=mysql_query("select * from bq_venue where venue_code='".$rowBb['venue']."' and status='1'");
$rowV=mysql_fetch_array($sqlV);

$title=$rowBb['title'];
$tname=strtoupper($title.'. '.$rowB['fname']);
$gadd1=strtoupper($rowBb['address1']);
$gadd2=strtoupper($rowBb['address2']);
$gadd3=strtoupper($rowBb['city']).'  '.$rowB['pin'];
$ggst=strtoupper($rowBb['gstin']);
$vucno=$rowB['vouchrno'];
$vucdt=$rowB['vouchrdate'];
$fpno=$rowB['fpno'];
$fndt=$rowB['vouchrdate'];
$vchno=$rowBb['booking_no'];
$hall=strtoupper($rowV['venue_desc']);

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
<table style="width:100%;border-top:1px solid black;border-bottom:1px solid black;font-size:11px;">
<tr>
<td><div style="font-weight:bold;text-align:center;font-size:19px;">Voucher Billing</div></td>
</tr>
</table>
EOD;


$tbl.=<<<EOD
<table id="comty"  style="width:100%;border-collopse:collapse;padding: 2px;font-size:11px;padding-bottom:10px;"> 
<tr style="width:40%;padding:0px;text-align:center;"> 
<td style="width:40%;padding:0px;text-align:left;border-right:1px solid black;" >
$tname<br/>
$gadd1<br/>
$gadd2<br/>
$gadd3<br/>
GSTIN : $ggst
</td> 
<td style="width:30%;padding:0px;text-align:center;border-right:1px solid black;" >
<table>
<tr>
<td style="width:50%;padding:0px;text-align:left;">Voucher No :</td>
<td style="width:50%;padding:0px;text-align:left;">$vucno</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;">FP No :</td>
<td style="width:50%;padding:0px;text-align:left;">$fpno</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;">Booking No :</td>
<td style="width:50%;padding:0px;text-align:left;">$vchno</td>
</tr>
</table>
</td> 
<td style="width:30%;padding:0px;text-align:center;" >
<table>
<tr>
<td style="width:50%;padding:0px;text-align:left;">Voucher Date :</td>
<td style="width:50%;padding:0px;text-align:left;">$vucdt</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;">Fn. Date :</td>
<td style="width:50%;padding:0px;text-align:left;">$fndt</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;">Venue :</td>
<td style="width:50%;padding:0px;text-align:left;">$hall</td>
</tr>
</table>
</td> 

</tr>
</table>
EOD;
$tbl.=<<<EOD
<table style="font-size:12px;">
<tr >
<th style="border-top: 1px solid black;border-bottom: 1px solid black;width:15%;border-collopse:collapse;line-height">HSN/SAC</th>
<th style="border-top: 1px solid black;width:40%;border-bottom: 1px solid black;border-collopse:collapse;padding: 0px;">ITEM NAME</th>
<th style="border-top: 1px solid black;text-align:left;width:15%;border-bottom: 1px solid black;border-collopse:collapse;">QTY</th>
<th style="border-top: 1px solid black;width:15%;text-align:right;border-bottom: 1px solid black;border-collopse:collapse;">UNIT RATE</th>
<th style="border-top: 1px solid black;text-align:right;width:15%;border-bottom: 1px solid black;border-collopse:collapse;">AMOUNT</th>
</tr>
</table>
EOD;

$sqlGs=mysql_query("SELECT * FROM `bq_opvchrdtl` WHERE vouchrno = '".$VucNo."'");
while($rowGs=mysql_fetch_array($sqlGs)){
$slB=mysql_fetch_array(mysql_query("select hsn from bq_grpcode where grpcode='".$rowGs['grpcode']."'"));
$hsn=strtoupper($rowGs['sac']);
$itm_name=strtoupper($rowGs['item_name']);
$qty=$rowGs['item_qty'];
$unit_rate=sprintf("%01.2f",$rowGs['item_rate']);
$amt=sprintf("%01.2f",$rowGs['item_qty']*$rowGs['item_rate']);

$tbl.=<<<EOD
<table style="font-size:12px;padding-top:4px;">
<tr style="line-height:12px;">
<td style="width:15%;text-align:left;">$hsn</td>
<td style="width:40%;text-align:left;">$itm_name</td>
<td style="width:15%;text-align:left;">$qty</td>
<td style="width:15%;text-align:right;">$unit_rate</td>
<td style="text-align:right;width:15%;">$amt</td>
</tr>
EOD;

}

$hpayMde = '';
$sqsS=mysql_query("select * from bq_opbillhdtl where vouchrno = '".$VucNo."'");
$rowsS=mysql_fetch_array($sqsS);



$tbl.=<<<EOD
</table>
EOD;





$pdf->writeHTML($tbl, true, false, false, false,'');

$pdf->Output('outletBillDuplicate.pdf', 'I');