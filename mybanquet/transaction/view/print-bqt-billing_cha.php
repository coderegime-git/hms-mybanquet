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
  $home_path='http://'.$_SERVER['HTTP_HOST'].'/rms/hms';  
$this->SetFont($fontname, 'C', 11);
		$blN=$_GET['blN'];
$sqlR=mysql_query("select * from property_definition");
$rowPd=mysql_fetch_array($sqlR);
$service_tax=$rowPd['service_tax'];
$gst_state=$rowPd['gst_state'];
  $gst_code=$rowPd['gst_code'];
	$sqllG=mysql_query("select * from bq_opbillhdtl where bill_no='".$blN."' ");
$count_no_rows=mysql_num_rows($sqllG);	
		
	$sqBl=mysql_query("select * from bq_opbillstldtl where bill_no='".$blN."' ");
	if(mysql_num_rows($sqBl)>0){
	$rowst=mysql_fetch_array($sqBl);
    if($rowst['cash']>0 && $rowst['card']==0 && $rowst['company']==0 && $rowst['upi']==0 && $rowst['neft']==0){
	   $settle='Cash';
	   $bal=$rowst['billamt']-$rowst['cash'];
	}elseif($rowst['cash']==0 && $rowst['card']>0 && $rowst['company']==0 && $rowst['upi']==0 && $rowst['neft']==0){
	 $settle='Card';
	 $bal=$rowst['billamt']-$rowst['card'];
	}elseif($rowst['cash']==0 && $rowst['card']==0 && $rowst['company']>0 && $rowst['upi']==0 && $rowst['neft']==0){
	 $settle='Company';
	 $bal=$rowst['billamt'];
	}elseif($rowst['cash']==0 && $rowst['card']==0 && $rowst['company']==0 && $rowst['upi']>0 && $rowst['neft']==0){
	 $settle='Upi';
	 $bal=$rowst['billamt']-$rowst['upi'];
	}elseif($rowst['cheque']>0){
	 $settle='Cheque';
	 $bal=$rowst['billamt']-$rowst['cheque'];
	}elseif($rowst['cash']>0 && $rowst['card']>0 && $rowst['company']==0 && $rowst['neft']==0 && $rowst['upi']==0){
	 $settle='Cash & Card';
	 $bal=$rowst['billamt']-($rowst['cash']+$rowst['card']);
	}elseif($rowst['cash']>0 && $rowst['card']==0 && $rowst['company']==0 && $rowst['neft']==0 && $rowst['upi']>0){
	 $settle='Cash & Upi';
	 $bal=$rowst['billamt']-($rowst['cash']+$rowst['upi']);
	}elseif($rowst['cash']==0 && $rowst['card']>0 && $rowst['company']==0 && $rowst['neft']==0 && $rowst['upi']>0){
	 $settle='Card & Upi';
	 $bal=$rowst['billamt']-($rowst['card']+$rowst['upi']);
	}elseif($rowst['cash']>0 && $rowst['card']>0 && $rowst['company']==0 && $rowst['neft']==0 && $rowst['upi']>0){
	 $settle='Cash,Card & Upi';
	 $bal=$rowst['billamt']-($rowst['card']+$rowst['card']+$rowst['upi']);
	}elseif($rowst['cash']==0 && $rowst['card']==0 && $rowst['company']==0 && $rowst['neft']>0){
	 $settle='Neft';
	 $bal=$rowst['billamt']-$rowst['neft'];
	}elseif($rowst['room']>0){
	 $settle='Room';
	 $bal=$rowst['billamt']-$rowst['room'];
	}else{
	 $settle='';
	 $bal='0';
	}
	}	
	$sqlrr=mysql_query("select * from bq_opbillhdr where bill_no='".$blN."'");
$rowrr=mysql_fetch_array($sqlrr);	

    $payamt = round($rowrr['nontaxableamt']+$rowrr['taxableamt']);
	

	
//$finTot = $rowrr['tax_total']+$datyr;
$aWords = new Currency();
//$finInWords =ucfirst($aWords->get_bd_amount_in_text(round($tryuo,2)));

$user = $rowrr['added_by'];
$sqS=mysql_query("select * from bq_opbillhdtl where bill_no='".$_GET['blN']."' AND bill_status!='3'");
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
<td style="width:30%;text-align:right;">State: '.$gst_state.'</td>
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
Cashier
</td>
</tr>
</table>
<hr/>';
$slGnr=mysql_query("SELECT count(*) as cnt FROM `hms_parameters` WHERE description = 'Enable Footer type'");
$rwGnr=mysql_fetch_array($slGnr);
if($rwGnr['cnt'] == '1')
{	
$html.='<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:100%;text-align:center;">
 <img style="width:5000%" src="'.$home_path.'/img/bottom.jpg" />
</td>
</tr>
</table>';
    } else {
      $html.='';
    }
	
}
}else
{
if($this->PageNo() == 1){
$sqlrr=mysql_query("select * from bq_opbillhdr where bill_no='".$blN."'");
$rowB=mysql_fetch_array($sqlrr);
$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$rowB['bkno']."'");
$rowBb=mysql_fetch_array($sqlBb);
$top_code=$rowBb['top_code'];
$rwSt=mysql_fetch_array(mysql_query("select state_name from states where state_code='".$rowBb['state']."'"));
$Stated=strtoupper($rwSt['state_name']);
$rwB=mysql_fetch_array(mysql_query("select bill_desc from bq_billinstruc where bill_code='".$top_code."'"));
$billi=ucfirst($rwB['bill_desc']);
$sqS=mysql_query("select * from bq_opbillhdtl where bill_no='".$blN."' and bill_status!='3'");
$tax_valGT=0;$debitGT=0;$creditGT=0;$totl=0;
while($rowS=mysql_fetch_array($sqS)) {
	$totl+=sprintf("%01.2f",$rowS['itemqty']*$rowS['itemrate']);
	$vouchrno=$rowS['vouchrno'];
}
$rBq=mysql_fetch_array(mysql_query("select sum(tax_amt)as tx from bq_opbillhdtl where bill_no='".$blN."' AND bill_status!='3' and taxstruccode!='BEV'"));
$taxAamtG=$rBq['tx'];
$taxAamtt2=sprintf("%01.2f",$rBq['tx'] / 2);
$rBev=mysql_fetch_array(mysql_query("select sum(tax_amt)as tx,item_total from bq_opbillhdtl where bill_no='".$blN."' AND bill_status!='3' and taxstruccode='BEV'"));
$taxAamtB=$rBev['tx'];
$taxB=$rBev['item_total']*28/100;
$gstBv=sprintf("%01.2f",$taxB/2);
$cessB=$rBev['item_total']*12/100;
$cesBv=sprintf("%01.2f",$cessB);
//discount
$sqv=mysql_query("select SUM(discamt)AS Dsc from bq_opbillhdtl where bill_no='".$blN."' AND discamt>0");
if(mysql_num_rows($sqv)>0){
$roV=mysql_fetch_array($sqv);
$Dsc=$roV['Dsc'];
$Subtt=$totl-$roV['Dsc'];
}
if($Dsc>0){
	$DscC=$Dsc;
}else{
	$DscC=0;
}
$billamt=sprintf("%01.2f",$totl+$taxAamtG+$taxAamtB-$DscC);
$sqAd=mysql_query("select SUM(advamt)AS advAamt from bq_opbillhdr where bill_no='".$blN."' AND advamt>0 AND advamt!='Null'");
if(mysql_num_rows($sqAd)>0){
$roAd=mysql_fetch_array($sqAd);
}
$sign='-';
$tt=round($roAd['advAamt']);
$adv=sprintf("%01.2f",$sign.$tt);
$sqd=mysql_query("select * from bq_opbillhdtl where bill_no='".$blN."' AND itemcode='RND' AND bill_status!='3'");
$rndof=0;
if(mysql_num_rows($sqd)>0){
$rod=mysql_fetch_array($sqd);
/* if($rod['itemrate']>=0.5){
	$sign=' + ';
	$rndof=$rod['itemrate'];
}else if($rod['itemrate']<=0.5){
	$sign=' - ';
	$rndof=$rod['itemrate'];
} */
if($rod['itemrate']!=''){
	$rndof=$rod['itemrate'];
}else{
	
	$rndof=0;
}
}
 $totAmt=$totl+$taxAamtG+$taxAamtB-$roAd['advAamt']-$DscC;
if($rndof>0){
$baAt=fmod($totAmt, 1);
$baAt=sprintf("%01.2f",$baAt);
	if($baAt<.5){
		$TottotAmt=$totAmt-$rndof;
	}else{
		$TottotAmt=$totAmt+$rndof;
	}
}else{
	$TottotAmt=$totAmt;
}

$netamt=sprintf("%01.2f",round($TottotAmt));
$aWords = new Currency();
$finInWords =ucfirst($aWords->get_bd_amount_in_text(round($netamt,2)));
$html.='
<hr/>
<table style="width:100%;font-size:13px;padding-bottom:6px;padding-top:6px;">
<tr>
<td style="width:67%;">
<table>
<tr>
<td style="text-align:left;"></td>
<td style="text-align:left;"></td>
</tr>
<tr>
<td style="text-align:left;"></td>
<td style="text-align:left;"></td>
</tr>
<tr>
<td style="text-align:left;"></td>
<td style="text-align:left;"></td>
</tr>
<tr>
<hr/>
<td style="text-align:left;font-weight:bold;line-height:20px;">Advance Details</td>
<td style="text-align:left;"></td>
</tr>
<hr/>
<tr style="">
<td style="text-align:left;width:20%;">Date</td>
<td style="text-align:left;width:30%;">Receipt No</td>
<td style="text-align:left;width:27%;">PayMode</td>
</tr>';
$sqlAdv=mysql_query("select * from bq_hallresvadv where booking_no='".$rowBb['booking_no']."' AND amount>0 AND amount!='Null'");
while($rowAdv=mysql_fetch_array($sqlAdv)){
$Adate=$rowAdv['cur_date'];
$Rcptno=$rowAdv['receipt_no'];
$Paymd=$rowAdv['pay_mode'];
$html.='
<tr>
<td style="text-align:left;width:20%;">'.$Adate.'</td>
<td style="text-align:left;width:30%;">'.$Rcptno.'</td>
<td style="text-align:left;width:27%;">'.$Paymd.'</td>
</tr>';
}
$html.='
</table>
</td>
<td style="width:33%;">
<table>
<tr>
<td style="text-align:right;">Sub Total</td>
<td style="text-align:right;">'.sprintf("%01.2f",$totl).'</td>
</tr>
<tr>
<td style="text-align:right;">CGST 9%</td>
<td style="text-align:right;">'.$taxAamtt2.'</td>
</tr>
<tr>
<td style="text-align:right;">SGST 9%</td>
<td style="text-align:right;">'.$taxAamtt2.'</td>
</tr>
<!--<tr>
<td style="text-align:right;">CGST 14%</td>
<td style="text-align:right;">'.$gstBv.'</td>
</tr>
<tr>
<td style="text-align:right;">SGST 14%</td>
<td style="text-align:right;">'.$gstBv.'</td>
</tr>
<tr>
<td style="text-align:right;">CESS 12%</td>
<td style="text-align:right;">'.$cesBv.'</td>
</tr>-->
<tr>
<hr/>
<td style="text-align:right;font-weight:bold;line-height:20px;">Total Amount</td>
<td style="text-align:right;">'.$billamt.'</td>
</tr>
<hr/>
<tr>
<td style="text-align:right;">Advance</td>
<td style="text-align:right;">'.$adv.'</td>
</tr>
<tr>
<td style="text-align:right;">Rounded off</td>
<td style="text-align:right;">'.sprintf("%01.2f",$rndof).'</td>
</tr>
<tr>
<hr/>
<td style="text-align:right;font-weight:bold;">Net Amount</td>
<td style="text-align:right;">'.$netamt.'</td>
</tr>';

$sqStl=mysql_query("select * from bq_opbillstldtl where bill_no='".$blN."' ");
	if(mysql_num_rows($sqStl)>0){
	$rowstl=mysql_fetch_array($sqStl);
$html.='<hr/>
<tr>
<td style="text-align:right;">Settled By</td>
<td style="text-align:right;">'.$settle.'</td>
</tr>
<tr>
<td style="text-align:right;">Balance Amount</td>
<td style="text-align:right;">'.sprintf("%01.2f",$bal).'</td>
</tr>';
	}
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
$pdf->SetMargins(5, 47, 5);
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
$blN=$_GET['blN'];
$type = 'O';
$sqlAC=mysql_query("select * from audt_control");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$sqlrr=mysql_query("select * from bq_opbillhdr where bill_no='".$blN."' and bill_status!='3'");
$rowB=mysql_fetch_array($sqlrr);
$bilStats=$rowB['bill_status'];
$taxaStats=$rowB['taxableamt'];

$sqlhb=mysql_query("select * from bq_hallbooking where booking_no='".$rowB['bkno']."'");
$rowhb=mysql_fetch_array($sqlhb);
//echo "select * from bq_opfpmenuhdr where bkno='".$rowB['bkno']."' and fpno='".$rowB['fpno']."'";
$sqlop=mysql_query("select * from bq_opfpmenuhdr where bkno='".$rowB['bkno']."' and fpno='".$rowB['fpno']."'");
$rowop=mysql_fetch_array($sqlop);
$exp=$rowop['grpax'];
$bkno=$rowhb['booking_no'];
$sqlfn=mysql_query("select func_code,func_desc from bq_function where func_code='".$rowhb['funct']."'");
$rowfn=mysql_fetch_array($sqlfn);
$fnct=strtoupper($rowfn['func_desc']);


$sqdtl=mysql_query("select * from bq_opbillhdtl where bill_no='".$blN."'");
$rowdtl=mysql_fetch_array($sqdtl);

$sqlv=mysql_query("select * from bq_venue where venue_code='".$rowB['venue']."' AND status ='1'");
$rovv=mysql_fetch_array($sqlv);
$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$rowB['bkno']."'");
$rowBb=mysql_fetch_array($sqlBb);
if($rowB['title']!=""){
	$title=$rowB['title'];
}else if($rowBb['title']!=""){
	$title=$rowBb['title'];
}else{
	$title="";
}
$tname=strtoupper($title.'. '.$rowB["fname"]);
$gadd1=strtoupper($rowB["add1"]);
$gadd2=strtoupper($rowB["add2"]);
$gadd3=strtoupper($rowB["city"]).'  '.$rowB["pin"];
$ggst=strtoupper($rowB['gst_no']);
$billno=$rowB['bill_no'];
$billdt=$rowB['bill_date'];
$fpno=$rowB['fpno'];
$fndt=$rowB['bill_date'];
$vchno=$rowdtl['vouchrno'];
$hall=strtoupper($rovv['venue_desc']);

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
<td><div style="font-weight:bold;text-align:center;font-size:19px;">Tax Invoice</div></td>
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
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">FP No:</td>
<td style="width:50%;padding:0px;text-align:left;">$fpno</td>
</tr>
</table>
</td> 
<td style="width:25%;padding:0px;text-align:center;">
<table>
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">Bill Date :</td>
<td style="width:50%;padding:0px;text-align:left;">$billdt</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">Pax:</td>
<td style="width:50%;padding:0px;text-align:left;">$exp</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">Reservation No:</td>
<td style="width:50%;padding:0px;text-align:left;">$bkno</td>
</tr>
<tr>
<td style="width:50%;padding:0px;text-align:left;font-weight:bold;">Voucher No:</td>
<td style="width:50%;padding:0px;text-align:left;">$vchno</td>
</tr>
</table>
</td> 
</tr>
</table>
EOD;
$tbl.=<<<EOD
<table style="font-size:12px;">
<tr style="line-height:20px;">
<th style="border-top: 1px solid black;width:35%;border-bottom: 1px solid black;border-collopse:collapse;padding: 0px;font-weight:bold;">PARTICULARS</th>
<th style="border-top: 1px solid black;border-bottom: 1px solid black;width:20%;border-collopse:collapse;font-weight:bold;">HSN/SAC</th>
<th style="border-top: 1px solid black;text-align:left;width:15%;border-bottom: 1px solid black;border-collopse:collapse;font-weight:bold;">QTY</th>
<th style="border-top: 1px solid black;width:15%;text-align:right;border-bottom: 1px solid black;border-collopse:collapse;font-weight:bold;">UNIT RATE</th>
<th style="border-top: 1px solid black;text-align:right;width:15%;border-bottom: 1px solid black;border-collopse:collapse;font-weight:bold;">AMOUNT</th>
</tr>
</table>
EOD;

$sqlGs=mysql_query("SELECT * FROM `bq_opbillhdtl` WHERE bill_no = '".$blN."' AND itemcode!='RND' AND bill_status!='3'");
while($rowGs=mysql_fetch_array($sqlGs)){
$slB=mysql_fetch_array(mysql_query("select hsn from bq_grpcode where grpcode='".$rowGs['grpcode']."'"));
$hsn=strtoupper($rowGs['sac']);
$itm_name=strtoupper($rowGs['itemname']);
$qty=$rowGs['itemqty'];
$unit_rate=sprintf("%01.2f",$rowGs['itemrate']);
$amt=sprintf("%01.2f",$rowGs['itemqty']*$rowGs['itemrate']);

$tbl.=<<<EOD
<table style="font-size:12px;padding-top:4px;">
<tr style="line-height:12px;">
<td style="width:35%;text-align:left;">$itm_name</td>
<td style="width:20%;text-align:left;">$hsn</td>
<td style="width:15%;text-align:left;">$qty</td>
<td style="width:15%;text-align:right;">$unit_rate</td>
<td style="text-align:right;width:15%;">$amt</td>
</tr>
EOD;

}

$hpayMde = '';
$sqsS=mysql_query("select * from bq_opbillhdtl where bill_no='".$_GET['blN']."'");
$rowsS=mysql_fetch_array($sqsS);



$tbl.=<<<EOD
</table>
EOD;





$pdf->writeHTML($tbl, true, false, false, false,'');

$pdf->Output('outletBillDuplicate.pdf', 'I');