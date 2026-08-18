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
	
	<a href="<?php echo $home_path;?>/transaction/frontdesk/view-fb-creation-chk.php"><button type="button" id="exit" name="exit" class="buttExaS" style="" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
</td>
</tr>
</table>

<div style="margin:10px 20px 10px 20px;" id="dvContainer" class="print">
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

/* $sqllG=mysql_query("select * from bq_opfpmenuhdr where fpno='".$_GET['fpNum']."'");
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
	$jj++;	 */

?>

<table style="height:30px;">
<tr>
<td>&nbsp;</td>
</tr>
</table>

<?php 
$sqlB=mysql_query("select * from bq_opfpmenuhdr where fpno='".$_GET['fpNum']."'");
$rowB=mysql_fetch_array($sqlB);

$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$rowB['bkno']."' AND hallbook_id='".$rowB['hallbook_id']."'");
$rowBb=mysql_fetch_array($sqlBb);

$sqS=mysql_query("select * from bqt_session where sess_code='".$rowBb['session']."'");
$roS=mysql_fetch_array($sqS);

$sqT=mysql_query("select bill_desc from bq_billinstruc where bill_code='".$rowBb['top_code']."'");
$roT=mysql_fetch_array($sqT);

$sqF=mysql_query("select func_desc from bq_function where func_code='".$rowBb['funct']."'");
$roF=mysql_fetch_array($sqF);

	/* $ds=explode('/',$rowB['fpdate']); */
	$ds=explode('/',$rowB['bkdate']);
	$df=$ds[2].'-'.$ds[1].'-'.$ds[0];
	$dys=strtotime($df);
	$day = date("l", $dys);
	

?>
<table class="table" style="width:100%;margin-bottom:0px;height:45px;float:right;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;">
	<tr><td style="font-weight:bold;font-size:18px;float:left;margin:5px 39px 0 5px;"><?php echo $rowPd['prop_name'];?></td></tr>
	<tr>
	<td style="font-size:16px;font-weight:bold;float:left;margin:5px 0 5px 5px;">BANQUET FUNCTION PROSPECTUS</td>
<?php if(isset($_GET['amend']) && $_GET['amend']!=""){?>
	<td style="font-size:16px;font-weight:bold;text-align:center;float:right;margin:5px 0 5px 5px;">AMENDMENT&nbsp;&nbsp;</td>
<?php } ?>	
	</tr>
</table>

<table class="table" style="width:33%;margin-bottom:0px;height:130px;float:left;border-top:1px solid #000;border-left:1px solid #000;font-size:13px;">
	<tr>
	<td style="font-weight:bold;width:100px;">DAY</td>
	<td style="width:200px;"><?php echo strtoupper($day);?></td>
	</tr>
	<tr>
	<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;">HALL</td>
	<td style="font-size:13px;letter-spacing: 0px;"><?php echo strtoupper($rowBb['venue']); ?></td>
	</tr>
	<tr>
	<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;">FUNCTION</td>
	<td style="font-size:13px;letter-spacing: 0px;"><?php echo strtoupper($roF['func_desc']); ?></td>
	</tr>
	<tr>
	<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;">NAME</td>
	<td style="font-size:13px;letter-spacing: 0px;"><?php echo strtoupper($rowBb['title'].'. '.$rowBb['guest_name']); ?></td>
	</tr>
	
	<!--<tr><td style="font-weight:bold;width:100px;">Address</td></tr>
	<tr><td style="font-weight:bold;width:100px;">&nbsp;</td><td style="font-size:13px;"><?php /* echo ucwords($rowBb['address1']).'&nbsp;'.ucwords($rowBb['address2']); */?></td></tr>
	<tr><td style="font-weight:bold;width:100px;">&nbsp;</td><td style="font-size:13px;"><?php /* echo ucwords($rowBb['city']).' - '.$rowBb['pin']; */?></td></tr>-->
	<tr><td style="font-weight:bold;width:100px;">MOBILE</td><td style="font-size:13px;"><?php echo ucwords($rowBb['phone']);?></td></tr>
	<!--<tr><td style="font-weight:bold;width:100px;">Email</td><td style="font-size:13px;"><?php /* echo $rowBb['email']; */?></td></tr>-->
	

</table>



<table class="table" style="width:33%;margin-bottom:0px;height:130px;float:left;border-top:1px solid #000;">	
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;">DATE</td>
<td style="font-size:13px;letter-spacing: 0px;"><?php echo $rowB['bkdate']; ?></td>
</tr>
<?php
 if($rowB['hallchgnoincl']>0 && $rowB['hallincl']!=''){
	 $hallchrg=round($rowB['hallchgnoincl']).'/-NETT';
 }else if($rowB['hallchrg']>0){
	 $hallchrg=round($rowB['hallchrg']).'+ taxes';
 }else{
	 $hallchrg='0.00';
 }
?>
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;">HIRE RS</td>
<td style="font-size:13px;letter-spacing: 0px;"><?php echo $hallchrg; ?></td>
</tr>
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;font-weight:bold;">DURATION</td>
<td style="font-size:13px;letter-spacing: 0px;"><?php echo $rowBb['from_time'].' To '.$rowBb['to_time']; ?></td>
</tr>


<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;width;100px;">PAX RATE</td>
<td style="font-size:13px;letter-spacing: 0px;width;100px;">
<?php /* if($rowB['ratechrg']>=$rowBb['hall_rate']) {
	 $ratechrg=round($rowB['ratechrg']);
 }else if($rowB['ratechrg']<=$rowBb['hall_rate']){
	 $ratechrg=round($rowBb['hall_rate']);
 }else{
	 $ratechrg='0.00';
 }  */
 if($rowB['ratechgnoincl']>0 && $rowB['rateincl']!=''){
	 $ratechrg=round($rowB['ratechgnoincl']).'/-NETT';
 }else if($rowB['ratechrg']>0 ){
	 $ratechrg=round($rowB['ratechrg']).'+ taxes';
 }else{
	 $ratechrg='0.00';
 }
 
if(isset($_GET['amend']) && $_GET['amend']!='') { 
	$sqfp=mysql_query("select * from bq_amendments where amendno='".$_GET['amend']."'");
	$rofp=mysql_fetch_array($sqfp); 
}
?>
<?php echo $ratechrg; ?></td>
</tr>
<!--<tr><td style="font-weight:bold;width:100px;font-size:13px;">Chief Guest</td><td style="font-size:13px;"><?php /* echo $rowBb['chief_guest']; */?></td></tr>-->
<tr><td style="font-weight:bold;width:100px;font-size:13px;">BOOKED BY</td><td style="font-size:13px;"><?php echo strtoupper($rowBb['contact_person']);?></td></tr>

<?php if(isset($_GET['amend']) && $_GET['amend']!='') { ?>
<tr><td style="font-weight:bold;width:100px;font-size:13px;">AMEND BY</td><td style="font-size:13px;"><?php echo strtoupper($rofp['amend_by']);?></td></tr>
<?php } ?>
<?php if(isset($_GET['amend']) && $_GET['amend']!='') { ?>
<tr><td style="font-weight:bold;width:100px;font-size:13px;">AUTHOR BY</td><td style="font-size:13px;"><?php echo strtoupper($rofp['author_by']);?></td></tr>
<?php } ?>


	<!--<tr><td style="font-weight:bold;font-size:13px;letter-spacing: 0px;">Booker no</td><td style="font-size:13px;letter-spacing: 0px;"><?php/*  echo ucwords($rowBb['contact_mobile']); */ ?></td></tr>-->
<!--<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;width;100px;">BOOKING NO</td>
<td style="font-size:13px;letter-spacing: 0px;width;100px;" colspan="4"><?php echo strtoupper($rowB['bkno']); ?></td>
</tr>-->
</table>
<?php 
/* echo "select * from bq_hallresvadv where booking_no='".$rowB['bkno']."'"; */
$sbk=mysql_query("select * from bq_hallresvadv where booking_no='".$rowB['bkno']."'");
$rwk=mysql_fetch_array($sbk);
?>

<table class="table" style="width:34%;margin-bottom:0px;height:130px;float:left;border-top:1px solid #000;border-right:1px solid #000;">	
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;width;100px;">FP NO</td>
<td style="font-size:13px;letter-spacing: 0px;width;100px;"><?php echo $rowB['fpno']; ?></td>
</tr>
<?php if(isset($_GET['amend']) && $_GET['amend']!=""){?>
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;width;100px;">AMEND NO</td>
<td style="font-size:13px;letter-spacing: 0px;width;100px;" colspan="4"><?php echo strtoupper($_GET['amend']); ?></td>
</tr>
<?php } ?>
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;width;100px;">BOOKING NO</td>
<td style="font-size:13px;letter-spacing: 0px;width;100px;" colspan="4"><?php echo strtoupper($rowB['bkno']); ?></td>
</tr>
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;width;100px;">BILLING INS</td>
<td style="font-size:13px;letter-spacing: 0px;width;100px;"><?php echo ucwords($roT['bill_desc']); ?></td>
</tr>
<tr><td style="font-weight:bold;width:100px;font-size:13px;">ARRIVAL TIME</td><td style="font-size:13px;"><?php echo $rowB['arrtime'];?></td></tr>
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;width;100px;">AMOUNT</td>
<td style="font-size:13px;letter-spacing: 0px;width;100px;"><?php echo ucwords($rwk['amount']); ?></td>
</tr>
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;width;100px;">RECEIPT NO</td>
<td style="font-size:13px;letter-spacing: 0px;width;100px;"><?php echo ucwords($rwk['receipt_no']); ?></td>
</tr>

<!--<tr>
<td style="font-weight:bold;font-size:12px;letter-spacing: 0px;width;100px;">Dated</td>
<td style="font-size:12px;letter-spacing: 0px;width;100px;"><?php /* echo ucwords($rwk['cur_date']); */ ?></td>
</tr>-->


</table>

<table class="table" style="width:100%;margin-bottom:0px;border-left:1px solid #000;border-right:1px solid #000;font-size:13px;">
<tr>
<td style="font-weight:bold;font-size:13px;letter-spacing: 0px;width;100px;">SIGNBOARD</td>
<td style="font-size:13px;letter-spacing: 0px;" ><?php echo strtoupper($rowB['signboard']); ?></td>
</tr>
</table>


<table style="width:100%;height:12px;border-left:1px solid #000;border-right:1px solid #000;border-top:1px solid #000;">
<tr style="font-size:13px;">
	<td style="font-weight:bold;text-align:center;width:35.2%;border-right:1px solid #000;">&nbsp;</td>
	<td style="font-weight:bold;text-align:center;width:35.2%;border-right:1px solid #000;">MENU ITEMS</td>
	<td style="font-weight:bold;text-align:center;width:30%;">REQUIREMENTS</td>
</tr>
</table>

<?php /* } */ ?>




<table style="width:35%;height:560px;float:left;border-left:1px solid #000;">
<?php
$rwf=mysql_fetch_array(mysql_query("select menucode from bq_opfpmenudetail where fpno='".$rowB['fpno']."'"));
/* $rwf=mysql_fetch_array(mysql_query("select menucode from bq_opfpmenudetail where fpno='".$rowB['fpno']."'")); */
$rwf=mysql_fetch_array(mysql_query("select menu_code from bq_opfpmenuhdr where fpno='".$rowB['fpno']."'"));
$rw=mysql_fetch_array(mysql_query("select itmnu_name from bq_itemmaster where itmnu_code='".$rwf['menu_code']."'"));

if(isset($_GET['amend']) && $_GET['amend']!=""){
	$guaranted=$rowB['grpax'];
	$expected=$rowB['exppax'];
}else{
	$guaranted=$rowBb['guaranted'];
	$expected=$rowBb['expected'];
}

?>
<tr style="font-size:13px;">
<td style="text-align:left;width:35%;vertical-align:top;font-weight:bold;word-break: break-all;">
TYPE OF MENU&nbsp;:&nbsp;&nbsp;<?php echo $rw['itmnu_name']; ?><br/><br/>
GUARANTED PAX&nbsp;:&nbsp;<?php echo $guaranted; ?><br/><br/>
EXPECTED PAX&nbsp;:&nbsp;<?php echo $expected; ?><br/><br/>
FOOD PICK UP AT&nbsp;:&nbsp;<?php echo $rowB['pictime']; ?><br/><br/>
FOOD SERVICE AT&nbsp;:&nbsp;&nbsp;<?php echo $rowB['sertime']; ?><br/><br/>
M.T &nbsp;:&nbsp;&nbsp;<?php echo $rowB['mortea']; ?><br/><br/>
E.T &nbsp;:&nbsp;&nbsp;<?php echo $rowB['evetea']; ?><br/><br/>


</td>
</tr>
</table>



<table style="width:35%;height:560px;float:left;border-left:1px solid #000;">
<tr style="font-size:13px;">
<td style="text-align:left;width:35%;vertical-align:top;font-weight:bold;word-break: break-all;">
<?php
$sqFu=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."' and bill_status='1'");
$x=0;
while($roFu=mysql_fetch_array($sqFu)){
	$x++;
	$srl=sprintf('%02d', $x);
?>

&nbsp;&nbsp;<?php echo strtoupper($roFu['itemname'].'</br>('.$roFu['preference'].')'); ?><br/>

<?php 
}
?>
</td>
</tr>
</table>


<table style="width:30%;height:560px;float:left;border-left:1px solid #000;border-right:1px solid #000;word-break: break-all;">
<tr style="font-size:13px;">
<td style="text-align:left;vertical-align:top;word-break: break-all;">&nbsp;
<?php
$sqFu=mysql_query("select * from bq_opfpdeptinst where fpno='".$rowB['fpno']."' AND bill_status!='3'");
$x=0;
while($roFu=mysql_fetch_array($sqFu)){
	$x++;
	$rw=mysql_fetch_array(mysql_query("select * from bq_deptmt where dept_code='".$roFu['deptcode']."'"));
?>

<span style="border-bottom: 1px dotted #000;font-weight:bold;word-break: break-all;"><?php echo strtoupper($rw['dept_name']); ?></span><br/>
<?php echo strtoupper($roFu['deptdesc']); ?><br/>

<?php 
 } 
?>
</td>
</tr>


</table>



<table style="width:30%;float:right;height:21px;border-right:1px solid #000;border-left:1px solid #000;margin:-25px 0 0px 0;" >
<?php 
$rsea=mysql_fetch_array(mysql_query("select seat_desc from bq_seating where seat_code='".$rowBb['seating']."'"));
?>
<tr>
<td style="text-align:left;float:left;vertical-align:top;font-size:13px;font-weight:bold;">&nbsp;&nbsp;<?php echo strtoupper($rsea['seat_desc']); ?>

</td>
</tr>
</table>

<table style="width:100%;height:50px;border:1px solid #000;text-wrap:none;" >
<!--<tr>
<td style="font-weight:bold;font-size:13px;">&nbsp;SEATING PLAN&nbsp;&nbsp;</td>
<td style="font-weight:bold;text-align:left;font-size:13px;color:#000;margin:0 0 0 0px;"><?php echo strtoupper($rowBb['seating']); ?></td>
</tr>-->
<tr>
<td style="font-weight:bold;font-size:13px;">&nbsp;REMARKS&nbsp;&nbsp;</td>
<td style="font-weight:bold;text-align:left;font-size:13px;color:#000;margin:0 0 0 0px;"><?php echo strtoupper($rowB['remarks']); ?></td>
</tr>
</table>

<table style="width:100%; font-size:13px;border-right:1px solid #000;border-left:1px solid #000;" >
<tr>
	<td style="color:#000;width:40%;">&nbsp;</td><td style="color:#000;width:50%;">&nbsp;</td><td style="width:10%;">&nbsp;</td>
</tr>
<tr>
	<td style="color:#000;width:40%;">&nbsp;</td><td style="color:#000;width:50%;">&nbsp;</td><td style="width:10%;">&nbsp;</td>
</tr>
</table>

<table style="width:100%; font-size:13px;border-bottom:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;" >
<tr>
	<td style="color:#000;font-weight:bold;">&nbsp;BANQUET DEPT.</td><td style="color:#000;font-weight:bold;">MAIN KITCHEN</td><td style="width:20%;text-align:right;font-weight:bold;">BQT MANAGER&nbsp;&nbsp;</td>
</tr>
</table>

</div>
</form>




















