<?php
ob_start();
error_reporting(0);
include("../../config.php");
include("../../header.php");

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=trim($rowAC['cur_date']);
?>
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script>
	jQuery(document).ready(function(){
	$(".datepicker" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});
	
		 $("#msgFo").fadeOut(5000);
	
	jQuery("#roommaster").validationEngine();
	});

shortcut.add("Ctrl+A",function() { 
	window.location.href = "view-fpvoucher.php";
}); 
	
function clkSubmit() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
srtx=$('#searchTxt').val();
document.location="view-fpvoucher-details.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
}

function srcSub(){
	$('#searchTxt').val('');
	$('#from_date').val('');
	$('#to_date').val('');
}
</script>
 
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
check.png

.butExample {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 66px;
}

</style>	

<body class="bgBODY">

<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>

<div style="margin:10px 0 0 0;">
<table style="">
<tr>

<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date" value="<?php if(isset($_GET['fromdate'])){ echo $_GET['fromdate'];}else{ echo $adtCurDt; }?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date" value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}else{ echo $adtCurDt; }?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Guest name / FP No / Booking No / Voucher No" style="margin-left: 30px;width:280px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt" class="btnH" value="Display" onClick="clkSubmit()" />
</td>
	<!--<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="myButSRc btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>-->
</td>
<!--<td>
	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
</td>-->

<td>
<a href="view-fpvoucher.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Voucher</button></a>
</td>
</tr>
</table>
 </div>

<table cellpadding="0" cellspacing="0" border="1" class="table" style="margin:10px 0 0px 0px;text-align:center;font-size:12px;position;absolute;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDTT" style=""><b>View Function Prospectus Voucher Details</b></h3><b></b></td>
	</tr>
</table>

 <form id="taxTypes" name="taxTypes" class="" > 
<div  >
<div class="scrollingtable frmCentrR" id="dvContainer" style="width:100%;">
  <div>
    <div>

<table style="text-align:center;font-size:12px;" border="1" cellpadding="0" cellspacing="0">
	<thead style="width:500px;">
	<tr>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Sl.no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Voucher#" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Voucher Date" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Booking#" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="BK Date" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="FP#" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="FP Date" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Pax" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Gst name" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Tot Amount" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Tax Amount" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Adv Amount" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Voucher Amt" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Status" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Print" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Voucher Cancel" ></div></th>
    	<th class="scrollbarhead"></th>
	</tr>
	</thead>
	<thead class="dispSHw" style="display:none;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDT" id=""><b>View Function Prospectus Voucher Details</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Voucher#</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Voucher Date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booking#</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">BK Date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">FP#</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">FP Date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Pax</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Gst name</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Tot Amount</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Tax Amount</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Adv Amount</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Voucher Amt</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Status</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Print</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Voucher Cancel</th>
	</tr>
	</thead>
	<style>
.butExample {
    padding: 4px 9px;
}
.butDisable{
	padding: 4px 9px;
}
</style>
<?php 
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$ad=explode('/',$adtCurDt);
$cur=$ad[2].'/'.$ad[1].'/'.$ad[0];

	$fr=explode('/',$_GET['fromdate']);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	$to=explode('/',$_GET['todate']);
	$tod=$to[2].'-'.$to[1].'-'.$to[0];

if(isset($_GET['fromdate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']!='') {
$v = mysql_real_escape_string($_GET['val']);
$item_where= " where str_to_date(vouchrdate,'%d/%m/%Y') >= '$frm' AND str_to_date(vouchrdate,'%d/%m/%Y') <= '$tod' AND (fname like '%$v%' OR vouchrno like '%$v%' OR fpno like '%$v%' OR bkno like '%$v%') AND bill_status!='3' order by str_to_date(vouchrdate,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_opvchrhdr $item_where");
}else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']=='') {
$item_where= " where str_to_date(vouchrdate,'%d/%m/%Y') >= '$frm' AND str_to_date(vouchrdate,'%d/%m/%Y') <= '$tod' AND bill_status!='3' order by str_to_date(vouchrdate,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_opvchrhdr $item_where");
}else if(isset($_GET['val']) && $_GET['val']!='') {
	$v = mysql_real_escape_string($_GET['val']);
	$item_where= " where (fname like '%$v%' OR vouchrno like '%$v%' OR fpno like '%$v%' OR bkno like '%$v%') AND bill_status!='3' order by str_to_date(vouchrdate,'%d/%m/%Y') DESC";
	$sql=mysql_query("select * from bq_opvchrhdr $item_where");
}else{
	$sql=mysql_query("select * from bq_opvchrhdr where bill_status!='3' order by str_to_date(vouchrdate,'%d/%m/%Y') DESC");
}

$x=0;
if($sql && mysql_num_rows($sql)>0) {
while($row=mysql_fetch_array($sql)) {
$x++;

if($row['bill_status']==1){
	$stats='Processing';
}else if($row['bill_status']==2){
	$stats='Billed';
}else if($row['bill_status']==3){
	$stats='Cancelled';
}else{
	$stats='';
}

?>

<tr>
	<td width="80" style="text-align:center;"><?php echo $x;  ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['vouchrno'];?></td>
	<td width="80" style="text-align:center;"><?php echo $row['vouchrdate']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['bkno']); ?></td>
	<td width="80" style="text-align:center;"><?php echo strtoupper($row['bkdate']); ?></td>
	<td width="80" style="text-align:right;"><?php echo strtoupper($row['fpno']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['fpdate']; ?></td>
	<td width="80" style="text-align:right;"><?php echo $row['gpax']; ?></td>
	<td width="80" style="text-align:right;"><?php echo strtoupper($row['fname']); ?></td>
	<td width="80" style="text-align:right;"><?php echo sprintf("%01.2f",$row['nontaxableamt']); ?></td>
	<td width="80" style="text-align:right;"><?php echo sprintf("%01.2f",$row['taxableamt']); ?></td>
	<td width="80" style="text-align:right;"><?php echo sprintf("%01.2f",$row['advamt']); ?></td>
	<td width="80" style="text-align:right;"><?php echo sprintf("%01.2f",$row['vchramt']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($stats); ?></td>
	
<td width="80" style="text-align:center;"><a href="<?php echo $home_path;?>/transaction/view/print-voucher-billing.php?vuNum=<?php echo $row['vouchrno'];?>"><input type="button" class="btnH" value="Print"/></a></td>

<td width="80" style="text-align:center;">
<?php if($row['bill_status']==1) { ?>
<a href="<?php echo $home_path;?>/action/cancel-voucher-details.php?vucNo=<?php echo $row['vouchrno'];?>&fpNum=<?php echo $row['fpno'];?>&bkno=<?php echo $row['bkno'];?>"><input type="button" class="butExample" value="Cancel"/></a>
<?php }else{?>
<a href="#"><input type="button" class="butDisable" value="Cancel"/></a>
<?php }?>
</td>

</tr>
<?php } } else { ?>
<tr>
	<td colspan="16">
		<div style="margin: 21px 0 26px 10px;width:95%;" class="alert alert-success">
			No Voucher records found...
		</div>
	</td>
</tr>
<?php } ?>
</table>
	
	</div>
	<?php include("../../footer.php"); ?>
	</body>
 </form>