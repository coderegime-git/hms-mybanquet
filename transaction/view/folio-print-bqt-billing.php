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
	
	<button type="button" id="exit" name="exit" class="buttExaS" style="" onClick="self.close();" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button>
</td>
</tr>
</table>

<div style="margin:10px 20px 10px 20px;" id="dvContainer" class="print">
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$sqllG=mysql_query("select * from bq_opbillhdtl where bill_no='".$_GET['blN']."'");
$count_no_rows=mysql_num_rows($sqllG);
$count_i=0;
$jj=0;

$nmRs=25;
$totpg =ceil($count_no_rows/$nmRs);
$nRws=$count_no_rows;
$cc=0;

$yy=$totpg-1;

$rWs=$yy*$nmRs;
$lstPgRws=$count_no_rows-$rWs;

while($rowwG=mysql_fetch_array($sqllG)) {
	
if($lstPgRws>=20 && $count_i>=20){
	$nmRs=25;
} 
if($count_i == 0 || $count_i % $nmRs == 0)
{
	$jj++;	

?>

<?php if($lstPgRws>=20 && $count_i>=20) { ?>
<table style="height:80px;">
	<tr>
	<td>&nbsp;</td>
	</tr>
	</table>
<?php } else { ?>
	<table style="height:80px;">
	<tr>
	<td>&nbsp;</td>
	</tr>
	</table>
<?php } ?>

<?php 
$sqlB=mysql_query("select * from bq_opbillhdr where bill_no='".$_GET['blN']."'");
$rowB=mysql_fetch_array($sqlB);

$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$rowB['bkno']."'");
$rowBb=mysql_fetch_array($sqlBb);
?>
<table class="table" style="width:55%;margin-bottom:0px;height:70px;float:left;border-top:1px solid #000;border-left:1px solid #000;font-size:12px;">
	<tr><td style="font-weight:bold;letter-spacing: 0px;"><?php echo $rowBb['guest_name'];?></td></tr>
	<tr><td style="font-size:13px;"><?php echo $rowBb['address1'].'&nbsp;'.$rowBb['address2'];?></td></tr>
	<tr><td style="font-size:13px;"><?php echo $rowBb['city'].'  '.$rowBb['pin'];?></td></tr>
	<!--<tr><td style="font-size:13px;"><?php echo $rowBb['phone']; ?></td></tr>
	<tr><td style="font-size:13px;"><?php echo $rowBb['email']; ?></td></tr>-->
</table>
<table class="table" style="width:45%;margin-bottom:0px;height:70px;float:left;border-top:1px solid #000;border-right:1px solid #000;">	
<tr>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Bill No<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowB['bill_no']; ?></td>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Bill Date<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowB['bill_date']; ?></td>
</tr>
<tr>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">FP No<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowB['fpno']; ?></td>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Fn. Date<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowB['fpdate']; ?></td>
</tr>
<tr>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Voucher No<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowwG['vouchrno']; ?></td>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;">Hall<td style="width:15px;">:</td><td style="font-size:12px;"><?php echo $rowB['fpno']; ?></td>
</tr>
</table>

<table style="width:100%;height:12px;border-left:1px solid #000;border-right:1px solid #000;border-top:1px solid #000;">
<tr style="font-size:12px;">
	<td style="font-weight:bold;text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;width:25%;">PARTICULARS</td>
	<td style="font-weight:bold;text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;width:25%;">QUANTITY</td>
	<td style="font-weight:bold;text-align:center;border-bottom:1px solid #000;border-right:1px solid #000;width:25%;">UNIT RATE</td>
	<td style="font-weight:bold;text-align:center;border-bottom:1px solid #000;width:25%;">AMOUNT</td>
</tr>

<?php } ?>

<tr>
<td style="font-size:12px;width:170px;"><?php echo strtoupper($rowwG['itemname']); ?></td>
<td style="font-size:12px;width:100px;text-align:right;"><?php echo sprintf("%01.2f",$rowwG['itemqty']); ?></td>
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
<table style="width:60%;height:130px;float:left;border-left:1px solid #000;" >
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;</td>
</tr>
</table>
<table style="width:40%;height:60px;float:right;border-right:1px solid #000;" >
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;Sub Total</td><td style="text-align:right;font-size:12px;"><?php echo sprintf("%01.2f",$totl);?></td>
</tr>
<?php
$sqTru=mysql_query("select SUM(taxamt)AS taxAamt,taxcode from bq_opvchrtaxdtl where vouchrno='".$vouchrno."' group by taxcode");
$taxAamtt=0;
while($roTru=mysql_fetch_array($sqTru)) {	
$taxAamtt+=$roTru['taxAamt'];
?>
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;<?php echo strtoupper($roTru['taxcode']);?></td><td style="text-align:right;font-size:12px;"><?php echo sprintf("%01.2f",$roTru['taxAamt']);?></td>
</tr>
<?php } ?>
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;Bill Amount</td><td style="text-align:right;font-size:12px;"><?php echo sprintf("%01.2f",$totl+$taxAamtt);  ?></td>
</tr>
<tr>
	<td style="font-weight:bold;font-size:12px;">&nbsp;Net Amount</td><td style="text-align:right;font-size:12px;"><?php echo sprintf("%01.2f",$totl+$taxAamtt); ?></td>
	</td>
</tr>
</table>

<table style="width:100%;height:15px;border:1px solid #000;" >
<tr>
<td style="font-weight:bold;font-size:12px;">&nbsp;TIN NO.<?php echo $rowPd['tin_number'];?></td>
	<td style="font-weight:bold;text-align:right;font-size:12px;color:#000;">PAN NO. <?php echo $rowPd['luxury_tax'];?>&nbsp;</td>
</tr>
</table>

<table style="width:100%; font-size:12px;border-bottom:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;" >

<tr>
	<td style="color:#000;width:40%;">&nbsp;GUEST SIGNATURE</td><td style="color:#000;width:50%;">BILLING INSTRUCTION</td><td style="width:10%;">CASHIER</td>
</tr>
<tr>
<td style="font-weight:bold;font-size:12px;">&nbsp;</td>
</tr>
<tr>
<td style="font-weight:bold;font-size:12px;">&nbsp;</td>
</tr>
<tr>
<td style="font-weight:bold;font-size:12px;">&nbsp;</td>
</tr>
</table>

</div>
</form>




















