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

<?php
$sqlPd=mysql_query("select * from  property_definition where propdef_id='1'");
$rowPd=mysql_fetch_array($sqlPd);
for($cc=0;$cc<2;$cc++){
?>

<table class="table" style="width:45%;margin-bottom:0px;height:79px;float:left;border-top:1px solid #000;border-left:1px solid #000;font-size:12px;">
	<tr><td>
	<!--<img src="<?php echo $home_path;?>/img/headerimg/<?php echo $rowPd['header_image'];?>" style="width:100px;height:70px;margin:3px 0 0 0;"/>-->
	</td></tr>
</table>
	
<table class="table" style="width:55%;margin-bottom:0px;height:70px;float:left;border-top:1px solid #000;border-right:1px solid #000;">	
		<tr><td style="font-weight:bold;font-size:15px;letter-spacing: 0px;"><?php echo $rowPd['prop_name'];?></td></tr>
		<tr><td style="font-size:12px;"><?php echo $rowPd['address1'].'&nbsp;'.$rowPd['city'].' - '.$rowPd['pin_code'];?></td></tr>
		<tr><td style="font-size:12px;"><?php echo 'Ph : '.$rowPd['phone'].' Email : '.$rowPd['email']; ?></td></tr>
</table>


<table style="width:100%;margin:0 0 0 0px;border-top:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;font-size:12px;">
<tr>
<td style="font-weight:bold;font-size:12px;text-align:center;">RESERVATION ADVANCE REFUND</td>
</tr>
</table>

<?php
$sqPd=mysql_query("select * from bqt_reservrefund where receipt_no='".$_GET['rcptNo']."' AND booking_no='".$_GET['bkNo']."'");
$roPd=mysql_fetch_array($sqPd);

$sqlG=mysql_query("select * from bq_hallresvadv where receipt_no='".$roPd['receipt_no']."' AND status!='3'");
$rowG=mysql_fetch_array($sqlG);

$sqlH=mysql_query("select * from bq_hallbooking where booking_no='".$roPd['booking_no']."' AND confirm_status!='3'");
$rowh=mysql_fetch_array($sqlH);

$sqlF=mysql_query("select * from bq_function where func_code='".$rowh['funct']."' AND status='1'");
$rowf=mysql_fetch_array($sqlF);
?>

<table class="table" style="width:65%;margin-bottom:0px;height:79px;float:left;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;font-size:12px;">
	<tr>
		<td style="font-weight:bold;">Guest:</td>
		<td><?php echo strtoupper($rowG['title'].'. '.$rowG['guest_name']);?></td>
	</tr>
	<tr>
		<td style="font-weight:bold;">Company:</td>
		<td><?php echo strtoupper($rowG['company_name']);?></td>
	</tr>
</table>
	
<table class="table" style="width:35%;margin-bottom:0px;height:70px;float:left;border-top:1px solid #000;border-right:1px solid #000;font-size:12px;">	
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
		<td style="border-bottom:1px solid #000;font-weight:bold;">Book Dt</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Venue</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Function</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Pax</td>
		<td style="border-bottom:1px solid #000;font-weight:bold;">Advance Amount</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid #000;"><?php echo $rowh['booking_no'];?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $rowh['book_date'];?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $rowh['venue'];?></td>
		<td style="border-bottom:1px solid #000;"><?php echo strtoupper($rowf['func_desc']);?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $rowh['expected'];?></td>
		<td style="border-bottom:1px solid #000;"><?php echo $roPd['ref_amt'];?></td>
	</tr>
</table>
<?php
$NETpAYy=sprintf("%01.2f",$roPd['ref_amt']);
$aWords = new Currency();
$finTot =$NETpAYy;
$finInWords =ucfirst($aWords->get_bd_amount_in_text(round($finTot,2))); 
?>
<table class="table" style="width:100%;margin-bottom:0px;height:50px;float:left;border-bottom:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;font-size:12px;">	
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
		<td style=""><?php echo $roPd['ref_amt'];?></td>
		
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

<table class="table" style="width:100%;margin-bottom:0px;height:70px;float:left;border-top:1px solid #000;border-left:1px solid #000;border-right:1px solid #000;border-bottom:1px solid #000;font-size:12px;">	
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td style="text-decoration:underline;font-weight:bold;">Cashier's Signature</td>
		<td style="text-decoration:underline;font-weight:bold;float:right;margin:0 0 0 -10px;">Guest Signature</td>
	</tr>
</table>

<table class="table" style="height:20px;">	

	<tr>
		<td style="">&nbsp;</td>
	</tr>
	
	
</table>


<?php } ?>

</div>
</form>




















