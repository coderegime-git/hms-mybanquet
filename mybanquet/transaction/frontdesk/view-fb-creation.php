<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");
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
		$('#searchBtn').click(function(){
		item="?val="+$('#searchTxt').val();
		document.location.href="view-reservroom-booking.php"+item;
	}); 
	
	jQuery("#roommaster").validationEngine();
	});
	
function clkSubmit() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
srtx=$('#searchTxt').val();
/* if(fromdate!="" && todate!="")
{ */
document.location="view-fb-creation.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
/* } */

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


</style>	

<body class="bgBODY">


<div style="margin:10px 0 0 0;">
<table style="">
<tr>

<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['fromdate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="FP No / Booking No" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
	
</td>

<td>
<a href="fp_creation.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd FP Creation</button></a>
</td>
</tr>
</table>
</div>
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>

<table cellpadding="0" cellspacing="0" border="1" class="table" style="margin:10px 0 0px 0px;text-align:center;font-size:12px;position;absolute;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDTT" style=""><b>View Function Prospectus Creation Details</b></h3><b></b></td>
	</tr>
</table>

<form id="taxTypes" name="taxTypes" class="" style=""> 
<div  >
<div class="scrollingtable frmCentrR" id="dvContainer" style="width:100%;">
  <div>
    <div>

<table style="text-align:center;font-size:12px;" border="1" cellpadding="0" cellspacing="0">
	<thead style="width:500px;">
	<tr>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Sl.no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="FP no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="FP date" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Guest Name" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Booking#" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="BK Date" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Hallchrg" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Halltax" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Ratechrg" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Ratetax" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Status" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Print" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="FP Cancel" ></div></th>
		
		 <th class="scrollbarhead"></th>
	</tr>
	</thead>
	<thead class="dispSHw" style="display:none;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDT" id=""><b>View Function Prospectus Creation Details</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">FP.No</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">FP date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Guest Name</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booking#</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">BK Date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Hallchrg</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Halltax</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Ratechrg</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Ratetax</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Status</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Print</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">FP Cancel</th>
	</tr>
	</thead>
	<tbody>
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
$item_where= " where str_to_date(bkdate,'%d/%m/%Y') >= '$frm' AND str_to_date(bkdate,'%d/%m/%Y') <= '$tod' AND bkno='".$_GET['val']."' AND bill_status!='3' order by str_to_date(bkdate,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_opfpmenuhdr $item_where");
}else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']=='') {
$item_where= " where str_to_date(bkdate,'%d/%m/%Y') >= '$frm' AND str_to_date(bkdate,'%d/%m/%Y') <= '$tod' AND bill_status!='3' order by str_to_date(bkdate,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_opfpmenuhdr $item_where");
}else if(isset($_GET['val']) && $_GET['val']!='') {
	$item_where= " where bkno like '%".$_GET['val']."%' OR fpno like '%".$_GET['val']."%' AND bill_status!='3' order by str_to_date(bkdate,'%d/%m/%Y') DESC";
	$sql=mysql_query("select * from bq_opfpmenuhdr $item_where");
}else{
	$sql=mysql_query("select * from bq_opfpmenuhdr where bill_status!='3' order by str_to_date(bkdate,'%d/%m/%Y') DESC");
}	

$x=0;
while($row=mysql_fetch_array($sql)) {
$x++;

$sqlH=mysql_query("select * from bq_hallbooking where fpno='".$row['fpno']."'");
$rowH=mysql_fetch_array($sqlH);

if($row['bill_status']==1){
	$stats='Processing';
}else if($row['bill_status']==2){
	$stats='Billed';
}else if($row['bill_status']==3){
	$stats='Cancelled';
}else{
	$stats='';
}

if($row['hallchgnoincl']>0){
	$hslChg=$row['hallchgnoincl'];
}else{
	$hslChg=$row['hallchrg'];
}

if($row['ratechgnoincl']>0){
	$rteChg=$row['ratechgnoincl'];
}else{
	$rteChg=$row['ratechrg'];
}


?>


<tr>
	<td width="80" style="text-align:center;"><?php echo $x;  ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['fpno'];?></td>
	<td width="80" style="text-align:center;"><?php echo $row['bkdate']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $rowH['guest_name']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['bkno']); ?></td>
	<td width="80" style="text-align:center;"><?php echo strtoupper($row['bkdate']); ?></td>
	<td width="80" style="text-align:right;"><?php echo strtoupper($hslChg); ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['halltax']; ?></td>
	<td width="80" style="text-align:right;"><?php echo $rteChg; ?></td>
	<td width="80" style="text-align:right;"><?php echo strtoupper($row['ratetax']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($stats); ?></td>
	<td width="80" style="text-align:center;"><a href="<?php echo $home_path;?>/transaction/view/print-fp-creation.php?fpNum=<?php echo $row['fpno'];?>"><input type="button" class="btnH" value="Print"/></a></td>
<td width="80" style="text-align:center;">	
<?php if($row['bill_status']==1) { ?>
<a href="<?php echo $home_path;?>/action/cancel-fp-creation.php?fpNum=<?php echo $row['fpno'];?>&bkno=<?php echo $row['bkno'];?>"><input type="button" class="butExample" value="Cancel"/></a>
<?php }else{?>
<a href="#"><input type="button" class="butDisable" value="Cancel"/></a>
<?php }?>
</td>
	<!--<td width="80" style="text-align:center;"><a href="<?php echo $home_path;?>/action/cancel-fp-creation.php?fpNum=<?php echo $row['fpno'];?>&bkno=<?php echo $row['bkno'];?>"><input type="button" class="butExample" value="Cancel"/></a></td>-->
</tr>
<?php } ?>	
</tbody>
</table>

	</div>
	</div>
	</div>
	</div>


	<?php include("../../footer.php"); ?>
	</body>
 </form>