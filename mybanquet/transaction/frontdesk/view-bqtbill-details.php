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
	window.location.href = "bqt_billing.php?vucNo=";
}); 
	
function clkSubmit() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
srtx=$('#searchTxt').val();
document.location="view-bqtbill-details.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
}

function srcSub(){
	$('#from_date').val('');
	$('#to_date').val('');
	$('#searchTxt').val('');
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
	<input name="to_date" style="width:100px;margin-margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date" value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}else{ echo $adtCurDt; }?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter Guest name / Bill# / Book#" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt" class="btnH" value="Display" onClick="clkSubmit()" />

</td>


<td>
<a href="bqt_billing.php?vucNo="><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Bill</button></a>
</td>
</tr>
</table>
 </div>



<table cellpadding="0" cellspacing="0" border="1" class="table" style="margin:10px 0 0px 0px;text-align:center;font-size:12px;position;absolute;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDTT" style=""><b>View Bill Details</b></h3><b></b></td>
	</tr>
</table>

 <form id="taxTypes" name="taxTypes" class="" style="overflow:auto;"> 
<div style="" >
<div class="scrollingtable frmCentrR" id="dvContainer"  >
  <div>
    <div style="">

<table style="text-align:center;font-size:12px;" border="1" cellpadding="0" cellspacing="0">
	<thead style="width:500px;">
	<tr>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:5%;"><div label="Sl.no" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:5%;"><div label="Bill#" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Bill Date" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Booking#" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="BK Date" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="FP#" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="FP Date" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Pax" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Gst name" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Tot Amount" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Tax Amount" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Adv Amount" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Bill Amt" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Status" ></div></th>
		<th  style="text-align:center;background-color:#d3524e;color:#fff;width:10%;"><div label="Print" ></div></th>
		<th class="scrollbarhead"></th>
	</tr>
	</thead>
	<thead class="dispSHw" style="display:none;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDT" id=""><b>View Bill Details</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Bill#</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Bill Date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booking#</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">BK Date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">FP#</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">FP Date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Pax</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Gst name</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Tot Amount</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Tax Amount</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Adv Amount</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Bill Amt</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Status</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Print</th>
	</tr>
	</thead>
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
$item_where= " where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' and bill_status!='3'   order by str_to_date(bill_date,'%d/%m/%Y') ASC";
$sql=mysql_query("select * from bq_opbillhdr $item_where");
}else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']=='') {
$item_where= " where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' and bill_status!='3' order by str_to_date(bill_date,'%d/%m/%Y') ASC";
$sql=mysql_query("select * from bq_opbillhdr $item_where");
} else if(isset($_GET['val']) && $_GET['val']!='') {
$item_where= " where fname like '%".$_GET['val']."%' OR bill_no like '%".$_GET['val']."%' OR bkno like '%".$_GET['val']."%'  order by str_to_date(bill_date,'%d/%m/%Y') ASC";
$sql=mysql_query("select * from bq_opbillhdr $item_where");
}else{
$sql=mysql_query("select * from bq_opbillhdr where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' and bill_status!='3' order by str_to_date(bill_date,'%d/%m/%Y') ASC"); 
}
/* $sql=mysql_query("select * from bq_opbillhdr where bill_status!='3'"); */
$x=0;
while($row=mysql_fetch_array($sql)) {
$x++;

$rRnd=mysql_fetch_array(mysql_query("select * from bq_opbillhdtl where itemcode='RND' AND bill_no='".$row['bill_no']."' and bill_status!='3'"));
if($row['bill_status']==1){
	$blSts='Processing';
}else if($row['bill_status']==2){
	$blSts='Settled';
}else if($row['bill_status']==3){
	$blSts='Cancelled';
}

$rVc=mysql_fetch_array(mysql_query("select * from bq_opbillhdtl where bill_no='".$row['bill_no']."' and bill_status!='3'"));

?>
<tr>
	<td width="80" style="text-align:center;"><?php echo $x;  ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['bill_no'];?></td>
	<td width="80" style="text-align:center;"><?php echo $row['bill_date']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['bkno']); ?></td>
	<td width="80" style="text-align:center;"><?php echo strtoupper($row['bkdate']); ?></td>
	<td width="80" style="text-align:right;"><?php echo strtoupper($row['fpno']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['fpdate']; ?></td>
	<td width="80" style="text-align:right;"><?php echo $row['gpax']; ?></td>
	<td width="80" style="text-align:right;"><?php echo strtoupper($row['fname']); ?></td>
	<td width="80" style="text-align:right;"><?php echo sprintf("%01.2f",$row['nontaxableamt']); ?></td>
	<td width="80" style="text-align:right;"><?php echo sprintf("%01.2f",$row['taxableamt']); ?></td>
	<td width="80" style="text-align:right;"><?php echo sprintf("%01.2f",$row['advamt']); ?></td>
	<td width="80" style="text-align:right;"><?php echo round($row['billamt']+$rRnd['itemrate']); ?></td>
	<td width="80" style="text-align:right;"><?php echo $blSts; ?></td>
<?php
$bl=explode('/',$row['bill_date']);
$bll=$bl[2].'-'.$bl[1].'-'.$bl[0];
if(strtotime($bll)>=strtotime('2017-07-01') && $row['bill_status']!='3') {
?>
<td width="80" style="text-align:center;"><a href="<?php echo $home_path;?>/transaction/view/print-bqt-billing_cha.php?blN=<?php echo $row['bill_no'];?>&vucNo=<?php echo $rVc['vouchrno'];?>"><input type="button" class="btnH" value="Print"/></a></td>
<?php }else if(strtotime($bll)>=strtotime('2017-07-01') && $row['bill_status']==3) { ?>
<td width="80" style="text-align:center;"><a href="<?php echo $home_path;?>/transaction/view/print-bqt-billing-cancelled.php?blN=<?php echo $row['bill_no'];?>&vucNo=<?php echo $rVc['vouchrno'];?>"><input type="button" class="btnH" value="Print"/></a></td>
<?php } else{ ?>
<td width="80" style="text-align:center;"><a href="<?php echo $home_path;?>/transaction/view/print-bqt-billing-previous.php?blN=<?php echo $row['bill_no'];?>&vucNo=<?php echo $rVc['vouchrno'];?>"><input type="button" class="btnH" value="Print"/></a></td>
<?php }  ?>

</tr>
<?php } ?>	

</table>

	</div>
	</div>
	</div>
	</div>	

	<?php include("../../footer.php"); ?>
	</body>
 </form>