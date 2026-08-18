<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");
require_once('../../pdf/amountToWords.php');

$aWords = new Currency();

$sqlPd=mysql_query("select * from  property_definition where propdef_id='1'");
$rowPd=mysql_fetch_array($sqlPd); 

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
?>

<script>

function printPage() {
	var divContents = $("#dvContainer").html();
	var printWindow = window.open('', '', 'height=600,width=800');
	printWindow.document.write('<html><head><title></title>');
	printWindow.document.write('</head><body >');
	printWindow.document.write(divContents);
	printWindow.document.write('</body></html>');
	printWindow.document.close();
	printWindow.print();  
}

/* function extBUtton() {
adD=$("#adD").val();
	 document.location.href="<?php echo $home_path;?>/reports/checkout/check_out_bill.php?fromdate="+adD+"&todate="+adD; 
} */

</script>
<style>
	.buttExaS {
    background-color: #ffffff;
    border: 1px solid #888888;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
   /*  margin-left: -3px; */
    padding: 5px 0px;
    /* padding: 5px 59px; */
	width:90px;
}
</style>
<form id="taxTypes" name="taxTypes" enctype="multipart/form-data" action="#" method="post" class="frmBgClr" style="">
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
<tr class="info">
	<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#d3524e;color:#ffffff;margin:1px 0 0 0;text-transform:uppercase;"><b>BANQUET BILLING</b></h3><b></b></td>
</tr>
</table>

<table style="margin:20px 0 20px 20px;">
<tr>
<td>
	<button type="button" id="billable" name="billable" class="buttExaS" style="display:none;" onclick="printPage();" ><img src="../../images/imprimer.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">B</span>ill</button>
	
	<button type="button" id="printble" name="printble" class="buttExaS" style="" onclick="printPage();" ><img src="../../images/imprimer.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">P</span>rint</button>
	
	<a href="<?php echo $home_path;?>/transaction/frontdesk/view-bqtbill-details.php?fromdate=<?php echo $adtCurDt;?>&todate=<?php echo $adtCurDt;?>"><button type="button" id="exit" name="exit" class="buttExaS" style="" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
</td>
</tr>
</table>

<div style="margin:10px 20px 10px 20px;" id="dvContainer" class="print">
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$sqllG=mysql_query("select * from bq_opbillhdtl where bill_no='".$_GET['blN']."' AND itemcode!='RND'");
$count_no_rows=mysql_num_rows($sqllG);
$count_i=0;
$jj=0;

$nmRs=24;
$totpg =ceil($count_no_rows/$nmRs);
$nRws=$count_no_rows;
$cc=0;

$yy=$totpg-1;

$rWs=$yy*$nmRs;
$lstPgRws=$count_no_rows-$rWs;

while($rowwG=mysql_fetch_array($sqllG)) {

if($count_i == 0 || $count_i % $nmRs == 0)
{
	$jj++;	

?>

<table style="height:90px;">
<tr>
	<td>&nbsp;</td>
</tr>
</table>

<?php 
$sqlB=mysql_query("select * from bq_opbillhdr where bill_no='".$_GET['blN']."'");
$rowB=mysql_fetch_array($sqlB);
$bilStats=$rowB['bill_status'];
$taxaStats=$rowB['taxableamt'];

$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$rowB['bkno']."'");
$rowBb=mysql_fetch_array($sqlBb);
$top_code=$rowBb['top_code'];
?>
<?php if($rowB['bill_status']=='3') { ?>
<table class="" style="width:100%;text-align:center;font-size:14px;font-weight:bold;">
	<tr><td colspan="3" style="color:#F05E22;">CANCELLED BILL</td></tr>
</table>
<?php } ?>
<table class="table" style="width:100%;margin-bottom:0px;height:20px;float:right;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;">
<!--<tr><td style="font-weight:bold;font-size:18px;float:left;margin:5px 39px 0 5px;"><?php /* echo $rowPd['prop_name']; */?></td></tr>-->
		<tr><td style="font-size:16px;font-weight:bold;margin:5px 0 5px 5px;text-align:center;">Banquet Tax invoice</td></tr>
</table>
<table class="table" style="width:55%;margin-bottom:0px;height:85px;float:left;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;font-size:12px;">
	<tr><td style="font-weight:bold;letter-spacing: 0px;"><?php echo strtoupper($rowBb['title'].'. '.$rowB['fname']);?></td></tr>
	<tr><td style="font-size:13px;"><?php echo strtoupper($rowB['add1']).'&nbsp;'.strtoupper($rowB['add2']);?></td></tr>
	<tr><td style="font-size:13px;"><?php echo strtoupper($rowB['city']).'  '.$rowB['pin'];?></td></tr>
	<!--<tr><td style="font-size:13px;"><?php /* echo $rowBb['phone']; */ ?></td></tr>
	<tr><td style="font-size:13px;"><?php /* echo $rowBb['email']; */ ?></td></tr>-->
</table>
<table class="table" style="width:45%;margin-bottom:0px;height:85px;float:left;border-top:1px solid #000;border-right:1px solid #000;">	
<tr>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Bill No<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowB['bill_no']; ?></td>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Bill Date<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowB['bill_date']; ?></td>
</tr>
<tr>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">FP No<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowB['fpno']; ?></td>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Fn. Date<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowB['bill_date']; ?></td>
</tr>
<tr>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Voucher No<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowwG['vouchrno']; ?></td>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Hall<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowBb['venue']; ?></td>
</tr>
</table>

<table style="width:100%;border-left:1px solid #000;border-right:1px solid #000;border-top:1px solid #000;">
<tr style="font-size:12px;">
	<td style="font-weight:bold;text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;width:10%;height:40px;">HSN/SAC</td>
	<td style="font-weight:bold;text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;width:25%;height:40px;">Item name</td>
	<td style="font-weight:bold;text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;width:10%;height:40px; ">QUANTITY</td>
	<td style="font-weight:bold;text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;width:25%;height:40px;">UNIT RATE</td>
	<td style="font-weight:bold;text-align:center;border-bottom:1px solid #000;border-bottom:1px solid #000;width:25%;height:40px;">AMOUNT</td>
</tr>

<?php } ?>
<?php
$slB=mysql_fetch_array(mysql_query("select hsn from bq_grpcode where grpcode='".$rowwG['grpcode']."'"));
?>
<tr>
<td style="font-size:12px;width:170px;"><?php  if(isset($slB['hsn'])) { echo strtoupper($slB['hsn']);} ?></td>
<td style="font-size:12px;width:170px;"><?php echo strtoupper($rowwG['itemname']); ?></td>
<td style="font-size:12px;width:100px;text-align:right;"><?php echo $rowwG['itemqty']; ?></td>
<td style="font-size:12px;width:100px;text-align:right;"><?php echo sprintf("%01.2f",$rowwG['itemrate']); ?></td>
<td style="font-size:12px;width:100px;text-align:right;"><?php echo sprintf("%01.2f",$rowwG['itemqty']*$rowwG['itemrate']); ?></td>
</tr>
<?php 
$ft=$count_i+1;
for($cd=1;$cd<=$totpg;$cd++){
$ab=$nmRs;
$cf=$cd*$ab;
$cfF=$cd*$ab+1;
if($count_no_rows>$nmRs)
{
if($ft==$cf)
{	
?>
<table style="width:100%;height:50px;border-top:1px solid #000;">
	<tr>
	<!--<td colspan="" style="">page <?php echo $jj; ?> of   <?php  echo $totpg;  ?>&nbsp;Continue to Next Page...</td>-->
	<td colspan="" style="">&nbsp;</td>
	</tr>
</table>
	
<?php } } } ?>

<?php

$count_i++;	
$cc=$cc+$count_i;

} ?>

<?php 
 $lastPgNo=$jj-1; 

$lastPgRwCnt=$nmRs*$lastPgNo;
$lstpg=$count_no_rows-$lastPgRwCnt;
$newLine=$nmRs-$lstpg;
	$nLine=$newLine-9;
	for($n=0;$n<$nLine;$n++) {
?>
	<tr>
		<td style="font-weight:bold;">&nbsp;</td>
		<td style="font-weight:bold;">&nbsp;</td>
		<td style="font-weight:bold;">&nbsp;</td>
		<td style="font-weight:bold;">&nbsp;</td>
		<td style="font-weight:bold;">&nbsp;</td>
	</tr>
<?php } ?>
</table>
<?php 
$sqS=mysql_query("select * from bq_opbillhdtl where bill_no='".$_GET['blN']."'");
$tax_valGT=0;$debitGT=0;$creditGT=0;$totl=0;
while($rowS=mysql_fetch_array($sqS)) {
	$totl+=$rowS['itemqty']*$rowS['itemrate'];
	$vouchrno=$rowS['vouchrno'];
}
?>	

<table style="width:60%;height:148px;float:left;border-left:1px solid #000;" >
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;</td>
</tr>
</table>

<table style="width:40%;height:148px;float:right;border-right:1px solid #000;padding:0 0 0 0;" >
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;Sub Total</td><td style="text-align:right;font-size:12px;border-top:1px dotted #000;"><?php echo sprintf("%01.2f",$totl);?>&nbsp;&nbsp;</td>
</tr>
<?php
$sqv=mysql_query("select SUM(discamt)AS Dsc from bq_opbillhdtl where bill_no='".$_GET['blN']."' AND discamt>0");
if(mysql_num_rows($sqv)>0){
$roV=mysql_fetch_array($sqv);
$Dsc=$roV['Dsc'];
$Subtt=$totl-$roV['Dsc'];
if($roV['Dsc']!='Null' && $roV['Dsc']>0){
?>
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;Discount</td><td style="text-align:right;font-size:12px;border-bottom:1px dotted #000;"><?php echo sprintf("%01.2f",$roV['Dsc']);  ?>&nbsp;&nbsp;</td>
</tr>
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;</td><td style="text-align:right;font-size:12px;border-bottom:1px dotted #000;"><?php echo sprintf("%01.2f",$Subtt);  ?>&nbsp;&nbsp;</td>
</tr>
<?php } } ?>


<?php
/* if($bilStats=='3'){
	$ugsgTx=floatval($Subtt)*floatval(0.09);
	$taxAamtt=$taxaStats; */
	?>
<!--<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;<?php echo 'CGST';?></td><td style="text-align:right;font-size:12px;"><?php echo sprintf("%01.2f",$ugsgTx);?>&nbsp;&nbsp;</td>
</tr>
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;<?php echo 'SGST';?></td><td style="text-align:right;font-size:12px;"><?php echo sprintf("%01.2f",$ugsgTx);?>&nbsp;&nbsp;</td>
</tr>-->
<?php 
/* }else{ */
$sqTru=mysql_query("select SUM(taxamt)AS taxAamt,taxcode from bq_opvchrtaxdtl where vouchrno='".$vouchrno."' group by taxcode");
$taxAamtt=0;
while($roTru=mysql_fetch_array($sqTru)) {	
$taxAamtt+=$roTru['taxAamt'];

$rBq=mysql_fetch_array(mysql_query("select tax_desc from bq_taxmast where tax_code='".$roTru['taxcode']."'"));

?>
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;<?php echo strtoupper($rBq['tax_desc']);?></td><td style="text-align:right;font-size:12px;"><?php echo sprintf("%01.2f",$roTru['taxAamt']);?>&nbsp;&nbsp;</td>
</tr>
<?php }  ?>

<?php
if($Dsc>0){
	$DscC=$Dsc;
}else{
	$DscC=0;
}
$sAd=mysql_fetch_array(mysql_query("select * from bq_opfpmenuhdr where fpno='".$rowB['fpno']."'"));
$sqAd=mysql_query("select SUM(sgst)+SUM(cgst)AS advAmt from bq_hallresvadv where hallbook_id='".$sAd['hallbook_id']."'");
$rAd=mysql_fetch_array($sqAd);
$totadvAmt=$rAd['advAmt'];
?>

<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;Bill Amount</td><td style="text-align:right;font-size:12px;border-top:1px dotted #000;"><?php echo sprintf("%01.2f",$totl+$taxAamtt-$DscC); ?>&nbsp;&nbsp;</td>
</tr>
<?php
$sqAd=mysql_query("select SUM(advamt)AS advAamt from bq_opvchrhdr where vouchrno='".$vouchrno."' AND advamt>0 AND advamt!='Null'");
if(mysql_num_rows($sqAd)>0){
$roAd=mysql_fetch_array($sqAd);
if($roAd['advAamt']>0){
?>

<?php } } ?>
<?php

$sign='-';
$tt=$roAd['advAamt'];
?>
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;Advance</td><td style="text-align:right;font-size:12px;border-top:1px dotted #000;"><?php echo sprintf("%01.2f",$sign.$tt);  ?>&nbsp;&nbsp;</td>
</tr>
<?php

if($totadvAmt>0){
?>
<!--<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;Adv tax</td><td style="text-align:right;font-size:12px;"><?php echo sprintf("%01.2f",-$totadvAmt);  ?>&nbsp;&nbsp;</td>
</tr>-->

<?php } ?>
<?php $totAmt=$totl+$taxAamtt-$roAd['advAamt']-$DscC; ?>
<?php
$sqd=mysql_query("select * from bq_opbillhdtl where vouchrno='".$vouchrno."' AND itemcode='RND' AND bill_status!='3'");
$rndof=0;
if(mysql_num_rows($sqd)>0){
$rod=mysql_fetch_array($sqd);
if($rod['itemrate']>0){
	$sign=' + ';
	$rndof=$rod['itemrate'];
}else if($rod['itemrate']<0){
	$sign=' - ';
	$rndof=$rod['itemrate'];
}else{
	
	$rndof=0;
}

?>

<tr style="">
	<td style="font-weight:bold;font-size:12px;">Rounded off</td><td style="text-align:right;font-size:12px;"><?php if(isset($rndof)){ echo $sign.$rndof;}?>&nbsp;&nbsp;</td>
</tr>
<?php } ?>

<?php
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
/* die(); */
?>
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;Net Amount</td><td style="text-align:right;font-size:12px;font-weight:bold;border-top:1px dotted #000;border-bottom:1px dotted #000;"><?php echo sprintf("%01.2f",round($TottotAmt)); ?>&nbsp;&nbsp;</td>
	</td>
</tr>
<!--<tr>
<td>&nbsp;</td>
</tr>-->
</table>

<table style="width:100%;height:15px;border:1px solid #000;" >
<tr>
<td style="font-weight:bold;font-size:12px;width:33%;">&nbsp;GSTIN.<?php echo $rowPd['service_tax'];?></td>
<td style="font-weight:bold;font-size:12px;width:33%;text-align:center;">&nbsp;State:<?php echo ' Puducherry';?>&nbsp;&nbsp;&nbsp;&nbsp;ST Code:<?php echo ' 34';?></td>
<td style="font-weight:bold;text-align:right;font-size:12px;color:#000;width:33%;">CIN NO. <?php echo $rowPd['tin_number'];?>&nbsp;</td>
</tr>
</table>

<?php
$rwB=mysql_fetch_array(mysql_query("select bill_desc from bq_billinstruc where bill_code='".$top_code."'"));
?>

<table style="width:100%; font-size:12px;border-bottom:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;" >
<tr>
	<td style="font-weight:bold;font-size:12px;border-right:1px solid #000;">&nbsp;</td>
	<td style="font-weight:bold;font-size:12px;border-right:1px solid #000;">&nbsp;</td>
	<td style="font-weight:bold;font-size:12px;border-right:1px solid #000;">&nbsp;</td>
</tr>
<tr>
	<td style="font-weight:bold;font-size:12px;border-right:1px solid #000;">&nbsp;</td>
	<td style="font-weight:bold;font-size:12px;border-right:1px solid #000;">&nbsp;</td>
	<td style="font-weight:bold;font-size:12px;border-right:1px solid #000;">&nbsp;</td>
</tr>
<tr>
	<td style="color:#000;width:33%;border-right:1px solid #000;">&nbsp;</td><td style="color:#000;width:33%;font-weight:bold;border-right:1px solid #000;text-align:center;"><?php if(isset($rwB['bill_desc']))
	{ echo strtoupper($rwB['bill_desc']);}?></td><td style="width:33%;border-right:1px solid #000;">&nbsp;</td>
</tr>
<tr>
	<td style="color:#000;width:33%;font-weight:bold;border-right:1px solid #000;">&nbsp;GUEST SIGNATURE</td><td style="color:#000;width:33%;font-weight:bold;border-right:1px solid #000;text-align:center;">BILLING INSTRUCTION</td><td style="width:33%;font-weight:bold;border-right:1px solid #000;text-align:center;">CASHIER</td>
</tr>
</table>

</div>
</form>




















