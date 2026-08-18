<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");
require_once('../../pdf/amountToWords.php');

$aWords = new Currency();


?>

<script>
function checkBillBtn() {
	hidReg=$("#hid_reg").val();
	blNoM=$("#blNoM").val();
	blNoM=$("#blNo").val(blNoM);
	$("#printble").show();
	$("#billable").hide();
	
	
}

function printPage() {
	var divContents = $("#dvContainer").html();
	var printWindow = window.open('', '', 'height=600,width=800');
	printWindow.document.write('<html><head><title></title>');
	printWindow.document.write('</head><body >');
	printWindow.document.write(divContents);
	printWindow.document.write('</body></html>');
	printWindow.document.close();
	printWindow.print();  
	
	self.close();
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
<form id="taxTypes" name="taxTypes" enctype="multipart/form-data" action="#" method="post" class="" style="">
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
<tr class="info">
	<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#C3C3C3;color:#333333;margin:1px 0 0 0;text-transform:uppercase;"><b>View Print</b></h3><b></b></td>
</tr>
</table>

<table style="margin:20px 0 20px 20px;">
<tr>
<td>
	<button type="button" id="billable" name="billable" class="buttExaS" style="display:none;" onclick="checkBillBtn();" ><img src="../../images/imprimer.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">B</span>ill</button>
	
	<button type="button" id="printble" name="printble" class="buttExaS" style="" onclick="printPage();" ><img src="../../images/imprimer.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">P</span>rint</button>
	
	<a href="<?php echo $home_path; ?>/transaction/view/gp_print_view.php"><button type="button" id="exit" name="exit" class="buttExaS" style="" onClick="self.close();" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
</td>
</tr>
</table>
<div style="margin:10px 20px 10px 20px;" id="dvContainer" class="print">
<?php /* for($c=0;$c<2;$c++) { */ ?>

<?php
$sqlPd=mysql_query("select * from property_definition");
$rowPd=mysql_fetch_array($sqlPd);
$header_image=$rowPd['header_image'];
for($cc=0;$cc<2;$cc++){
?>

<table class="table" style="width:35%;margin-bottom:0px;height:79px;float:left;border-top:1px solid #000;border-left:1px solid #000;font-size:12px;">
	<tr><td><img src="<?php echo $ippath;?>/img/headerimg/<?php echo $header_image;?>" style="width:200px;height:80px;margin:15px 0 0 0;"/></td></tr>
</table>
<?php
if(isset($_GET['sts']) && $_GET['sts']==7){
?>
<table class="table" style="width:10%;margin-bottom:0px;height:79px;float:left;border-top:1px solid #000;font-size:14px;">
	<tr><td style="color:#520701;">Cancelled</td></tr>
</table>
<?php }else{ ?>	
<table class="table" style="width:10%;margin-bottom:0px;height:79px;float:left;border-top:1px solid #000;font-size:14px;">
	<tr><td style="color:#520701;">&nbsp;</td></tr>
</table>
<?php } ?>
<table class="table" style="width:55%;margin-bottom:0px;height:95px;float:left;border-top:1px solid #000;border-right:1px solid #000;">	
		<tr><td style="font-weight:bold;font-size:15px;letter-spacing: 0px;"><?php echo $rowPd['prop_name'];?></td></tr>
		<tr><td style="font-size:12px;"><?php echo $rowPd['address1'].'&nbsp;'.$rowPd['city'].' - '.$rowPd['pin_code'];?></td></tr>
		<tr><td style="font-size:12px;"><?php echo 'Ph : '.$rowPd['phone'].' Email : '.$rowPd['email']; ?></td></tr>
</table>


<table style="width:100%;margin:0 0 0 0px;border-top:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;font-size:12px;">
<tr>
<td style="font-weight:bold;font-size:12px;text-align:center;">BOOKING ADVANCE</td>
</tr>
</table>

<?php
$sqPd=mysql_query("select * from bq_hallresvadv where receipt_no='".$_GET['rcptNo']."' AND booking_no='".$_GET['rserNo']."'");
$roPd=mysql_fetch_array($sqPd);

/* echo "select * from bq_hallbooking where booking_no='".$roPd['booking_no']."' AND confirm_status='2'"; */
$sqlG=mysql_query("select * from bq_hallbooking where booking_no='".$roPd['booking_no']."' AND confirm_status!='7' AND hallbook_id='".$roPd['hallbook_id']."'");
$rowG=mysql_fetch_array($sqlG);

$sqlR=mysql_query("select * from bq_hallbooking where booking_no='".$roPd['booking_no']."' AND confirm_status!='7' AND hallbook_id='".$roPd['hallbook_id']."' group by booking_no order by booking_no ASC ");
$roR=mysql_fetch_array($sqlR);	

$sqlv=mysql_query("select * from bq_venue where venue_code='".$rowG['venue']."' AND status ='1'");
$rov=mysql_fetch_array($sqlv);


/* if($rowG['single']!='' && $rowG['single']!='0'){
$pax='1';	
}else if($rowG['doubl']!='' && $rowG['doubl']!='0'){
$pax='2';	
}else if($rowG['exp']!='' && $rowG['exp']!='0'){
$pax='3';	
}else{
$pax='';	
} */
$slGnr=mysql_query("SELECT count(*) as cnt FROM `hms_parameters` WHERE description = 'Enable Advance tax' and status='1' and module_name='Banquets'");
$rwGnr=mysql_fetch_array($slGnr);
if($rwGnr['cnt'] == '1'){
$nett=$roPd['amount'];
$tax1=$roPd['sgst']+$roPd['cgst'];
$ttot=sprintf("%01.2f",round($roPd['amount']+$roPd['sgst']+$roPd['cgst']));
}else{
$nett=$roPd['netamt'];
$tax1="0.00";
$ttot=sprintf("%01.2f",round($roPd['amount']+$roPd['sgst']+$roPd['cgst']));
}



?>
<table class="table" style="width:65%;margin-bottom:0px;height:20px;float:left;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;font-size:12px;">
	<tr style="">
		<td style="font-weight:bold;">Guest:</td>
		<td><?php echo strtoupper($rowG['guest_name']);?></td>
	</tr>
	<tr>
		<td style="font-weight:bold;">Company:</td>
		<td><?php echo strtoupper($rowG['company_name']);?></td>
	</tr>
</table>
	
<table class="table" style="width:35%;margin-bottom:0px;height:20px;float:left;border-top:1px solid #000;border-right:1px solid #000;font-size:12px;">	
		<tr>
		<td style="font-weight:bold;">Advance No:</td>
		<td><?php echo $roPd['receipt_no'];?></td>
	</tr>
	<tr>
		<td style="font-weight:bold;">Advance Dt:</td>
		<td><?php echo $roPd['cur_date'];?></td>
	</tr>
</table>

<table class="table" style="width:100%;margin-bottom:0px;height:70px;float:left;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;font-size:12px;">	
	<tr>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Booking No</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Function Dt</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Venue</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">From time</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">To Time</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Net Amount</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Tax</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Advance Amount</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid #000;"><?php echo $rowG['booking_no'];?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $rowG['book_date'];?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $rov['venue_desc'];?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $roR['from_time'];?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $roR['to_time'];?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $nett;?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $tax1;?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $ttot;?></td>
		
	</tr>
</table>
<?php
$NETpAYy=sprintf("%01.2f",round($ttot));
$aWords = new Currency();
$finTot =$NETpAYy;
$finInWords =ucfirst($aWords->get_bd_amount_in_text(round($finTot,2))); 
?>
<table class="table" style="width:100%;margin-bottom:0px;height:30px;float:left;border-bottom:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;font-size:12px;">	
	<tr>
		<td style="font-weight:bold;width:100px;">Amount :</td>
		<td style="width:300px;"><?php echo ucwords($finInWords); ?></td>
	</tr>
</table>


<table class="table" style="width:70%;margin-bottom:0px;height:50px;float:left;border-left:1px solid #000;font-size:12px;">	
	<tr>
		<td style="text-decoration:underline;font-weight:bold;">Payment Mode</td>
		<td style="text-decoration:underline;font-weight:bold;">Amount</td>
		<td style="text-decoration:underline;font-weight:bold;">Details</td>
	</tr>
	<tr>
		<td style=""><?php echo ucwords($roPd['pay_mode']);?></td>
		<td style=""><?php echo $ttot;?></td>
		
		<td style=""><?php if(isset($roPd['cc_cheqno'])) {echo $roPd['cc_cheqno'].' '.$roPd['cheque_date'];} ?></td>
	</tr>
</table>

<table class="table" style="width:30%;margin-bottom:0px;height:50px;float:left;border-right:1px solid #000;font-size:12px;">	
	<tr>
		<td style="">&nbsp;</td>
		<td style="">&nbsp;</td>
	</tr>
</table>

<table class="table" style="width:100%;margin-bottom:0px;height:50px;float:left;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;font-size:12px;">	
	<tr>
		<td style="text-decoration:underline;font-weight:bold;">Narration :</td>
		<td style=""><?php echo ucwords($roPd['remarks']);?></td>
	</tr>
</table>
<table class="table" style="width:100%;margin-bottom:0px;height:30px;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;font-size:12px;">	
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="text-decoration:underline;font-weight:bold;width:30%;">Cashier's Signature</td>
		<td style="text-decoration:underline;font-weight:bold;width:50%;text-align:right;">Guest Signature</td>
	</tr>
	
</table>
<table class="table" style="width:100%;margin-bottom:0px;height:70px;border:1px solid #000;font-size:12px;">	

	<tr>
		<td style="font-weight:bold;font-size:13px;text-align:left;width:100%;">1. Deposits & advance amount are non refundable at given circumstances.</td>
	</tr>
	<tr>
		<td style="font-weight:bold;font-size:13px;text-align:left;width:100%;">2. I have read & agree the Terms & Condition (Annexue 1&2) mentioned in the banquet booking form.</td>
	</tr>
</table>

<table class="table" style="height:20px;">	

	<tr>
		<td style="text-decoration:underline;">&nbsp;</td>
	</tr>
	
	
</table>


<?php } ?>

</div>
</form>




















