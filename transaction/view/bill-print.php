<?php
session_start();
define("host","localhost");
define("user","root");
define('password',"");
define('dbname','mybills');

$conn = mysql_connect(host,user,password);
mysql_select_db(dbname,$conn); 

date_default_timezone_set('Asia/Kolkata');
require('../../pdf/tfpdf.php');
/* require_once('../pdf/tcpdf.php'); */
require_once('../../pdf/amountToWords.php');
/* include('../../util.php'); */
/* $curr_symbol=  getCurrancy(); */

$pdf = new tFPDF();
$aWords = new Currency();

// Add a Unicode font (uses UTF-8)
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);

	$x2 = $pdf->x;
	 $pdf->AddPage($pdf->CurOrientation,$pdf->CurPageSize); 
	/*$pdf->AddPage('P','a4');*/
	$pdf->x = $x2;
	$x=5;
	$y=0;


$sqlb=mysql_query("select * from  bill_header where bill_no='".$_GET['billNo']."'"); 
$rowb=mysql_fetch_array($sqlb);

$sqlV=mysql_query("select * from company_master where vendor_code='".$rowb['vendor_code']."'"); 
$rowV=mysql_fetch_array($sqlV);
$date=Date('d.m.Y');
	/*$pdf->setXY($x+35,$y+45);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(200,4,'M/s.');*/
	
      $pdf->setXY($x+135,$y+45);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(200,4,$date);


	$pdf->setXY($x+45,$y+55);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(400,4,$rowV['vendor_name']);
	
	$pdf->setXY($x+45,$y+65);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(200,4,$rowV['city']);
	
	
	
	/*$pdf->setXY($x+5,$y+83);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(20,4,'S.No');
	
	$pdf->setXY($x+30,$y+83);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(200,4,'Particulars');*/
	
	$pdf->setXY($x+97,$y+77);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(20,4,'Patch'); 
	
	$pdf->setXY($x+115,$y+77);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(20,4,'Qty');
	
	$pdf->setXY($x+125,$y+77);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(20,4,'Rate');

	/*$pdf->setXY($x+140,$y+83);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(20,4,'Amount');*/
	
$sqlG=mysql_query("select * from bill_detail where bill_no='".$_GET['billNo']."'"); 
 	$srl=0;
	$nmRws=mysql_num_rows($sqlG);
while($rowG=mysql_fetch_array($sqlG)){
	$srl++;
$particulars=$rowG['particulars'];
$patch=$rowG['patch'];
$qty=$rowG['qty'];
$rate=$rowG['rate'];
$amount=(sprintf("%01.2f",$rowG['amount']));

	$y=$y+8;
	$pdf->setXY($x+5,$y+83);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(20,4,$srl);
	
	$pdf->setXY($x+20,$y+83);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(200,4,$particulars);
	
	$pdf->setXY($x+95,$y+83);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(20,4,$patch); 
	
	$pdf->setXY($x+115,$y+83);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(20,4,$qty);
	
	$pdf->SetFont('Arial','',12);
	$length = $pdf->GetStringWidth($rate);
	$pdf->setXY($x+120+(15-$length),$y+83);
	$pdf->MultiCell(20,4,$rate);

	$pdf->SetFont('Arial','',12);
    $length = $pdf->GetStringWidth($amount);
	$pdf->setXY($x+144+(15-$length),$y+83);
	$pdf->MultiCell(20,4,$amount);

}
$totalrows=10;
$noofRws=$totalrows-$nmRws;
for($i=0;$i<$noofRws;$i++)
{
	$y=$y+8;
}
$sqlBh=mysql_query("select * from bill_header where bill_no='".$_GET['billNo']."'"); 
$rowBh=mysql_fetch_array($sqlBh);
$BalAmt=$rowBh['bill_amt'];


	$pdf->Line($x+125,$y+121,$x+160,$y+121);
	$pdf->Line($x+125,$y+130,$x+160,$y+130);

	$pdf->setXY($x+125,$y+123);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(50,4,'Total');
	
	$pdf->SetFont('Arial','',12);
	$length = $pdf->GetStringWidth($BalAmt);
	$pdf->setXY($x+145+(15-$length),$y+123);
	$pdf->MultiCell(50,4,$BalAmt);

$NETpAYy=sprintf("%01.2f",($BalAmt));
$aWords = new Currency();
$finTot =$NETpAYy;
$finInWords =ucwords($aWords->get_bd_amount_in_text(round($finTot,2))); 

	$pdf->setXY($x+20,$y+128);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(250,4,'Rs.:'.$finInWords );

	$pdf->setXY($x+20,$y+113);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(250,4,'Second Retreat done under party risk');

    $pdf->setXY($x+20,$y+118);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(150,4,'No TDS Detected');

	$pdf->setXY($x+20,$y+123);
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell(250,4,'TNVAT - Compounding System 1/2%');
	
$pdf->Output();	
	
	
	
	
	