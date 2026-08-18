<?php
ob_start();
error_reporting(0);
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
	
	
	jQuery("#roommaster").validationEngine();
	});
	
function clkSubmit() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
srtx=$('#searchTxt').val();
document.location="view-fpkot.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
}

function srcSub(){
	$('#from_date').val('');
	$('#to_date').val('');
	$('#searchTxt').val('');
}

function fpCancel(){
kotno=$('#kotno').val();
kotId=$('#kotId').val();
fpno=$('#fpno').val();
r=confirm("Are you sure.Do you want to cancel?");
if(r==true){
	document.location.href='<?php echo $home_path;?>/action/cancel-kot-bill.php?fpno='+fpno+'&kotno='+kotno+'&kotId='+kotId;	
}else{
	
}
	
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


<div style="margin:10px 0 0 0;">
<table style="">
<tr>

<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter Item name / FP No / Booking No" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
</td>
<td>
<a href="kot-bill.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd KOT</button></a>
</td>
</tr>
</table>
</div>
 
 
 
 
 
<table cellpadding="0" cellspacing="0" border="1" class="table" style="margin:10px 0 0px 0px;text-align:center;font-size:12px;position;absolute;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDTT" style=""><b>View FP KOT</b></h3><b></b></td>
	</tr>
</table>

<form id="taxTypes" name="taxTypes" class="" style="overflow:auto;"> 
<div style="" >
<div class="scrollingtable frmCentrR" id="dvContainer" style="width:100%;" >
<div>
<div style="">

<table style="text-align:center;font-size:12px;" border="1" cellpadding="0" cellspacing="0">
<thead style="width:500px;">
<tr>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Sl.no" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="FP No#" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Booking no" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Date" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Item code" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Item name" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Qty" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Item rate" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Item value" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Subcatcode" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Catcode" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Grpcode" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Status" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Edit" ></div></th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Cancel" ></div></th>
</tr>
</thead>

<thead class="dispSHw" style="display:none;">
<tr class="info">
	<td colspan="19" style="text-align:center;"><h3 class="viewDT" id=""><b>View FP KOT</b></h3><b></b></td>
</tr>
<tr>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Sl.no</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">FP No#</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booking no</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Date</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Item code</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Item name</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Qty</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Item rate</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Item value</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Subcatcode</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Catcode</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Grpcode</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Status</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Edit</th>
	<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Cancel</th>
</tr>
</thead>

<tbody>
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
$item_where= " where str_to_date(kot_date,'%d/%m/%Y') >= '$frm' AND str_to_date(kot_date,'%d/%m/%Y') <= '$tod' AND kotstatus!='3' order by str_to_date(kot_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_opkothdr $item_where");
}else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']=='') {
$item_where= " where str_to_date(kot_date,'%d/%m/%Y') >= '$frm' AND str_to_date(kot_date,'%d/%m/%Y') <= '$tod' AND kotstatus!='3' order by str_to_date(kot_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_opkothdr $item_where");
}else if(isset($_GET['val']) && $_GET['val']!='') {
$item_where= " where item_name like '%".$_GET['val']."%' OR fpno like '%".$_GET['val']."%' OR bkno like '%".$_GET['val']."%' AND kotstatus!='3' AND str_to_date(kot_date,'%d/%m/%Y') >= '$cur' order by str_to_date(kot_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_opkothdr $item_where");
}else{
$sql=mysql_query("select * from bq_opkothdr where str_to_date(kot_date,'%d/%m/%Y') >= '$frm' AND str_to_date(kot_date,'%d/%m/%Y') <= '$tod' AND kotstatus!='3' order by str_to_date(kot_date,'%d/%m/%Y') DESC"); 
}
$x=0;
while($row=mysql_fetch_array($sql)) {
$x++;
		if($row['kotstatus']==1){
			$status="Processing";
		}else  if($row['kotstatus']==2){
			$status="Billed";
		}else  if($row['kotstatus']==3){
			$status="Cancelled";
		}
		
		 
	$rVc=mysql_fetch_array(mysql_query("select * from  bq_opvchrhdr where fpno='".$row['fpno']."'"));
	$bilStatus=$rVc['bill_status'];
	if($bilStatus==1){
		
	}
?>
<tr>
<input type="hidden" id="kotno" name="kotno" value="<?php echo $row['kotno']; ?>"/>
<input type="hidden" id="kotId" name="kotId" value="<?php echo $row['opkothdr_id']; ?>"/>
<input type="hidden" id="fpno" name="fpno" value="<?php echo $row['fpno']; ?>"/>

	<td width="80" style="text-align:center;"><?php echo $x;  ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['fpno'];?></td>
	<td width="80" style="text-align:center;"><?php echo $row['bkno']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['kot_date']; ?></td>
	<td width="80" style="text-align:left;"><?php echo $row['item_code']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['item_name']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['item_qty']; ?></td>
	<td width="80" style="text-align:right;"><?php echo $row['item_rate']; ?></td>
	<td width="80" style="text-align:right;"><?php echo sprintf("%01.2f",$row['item_value']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['subcatcode']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['catcode']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['grpcode']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($status); ?></td>
	<td width="80" style="text-align:center;"><a href="kot-bill-edit.php?fpno=<?php echo $row['fpno']; ?>&kotno=<?php echo $row['kotno']; ?>&kotId=<?php echo $row['opkothdr_id']; ?>" style="" class="btnH">Edit</a></td>
	
<td width="80" style="text-align:center;">	
<?php $rVc=mysql_query("select * from  bq_opvchrhdr where fpno='".$row['fpno']."' AND bill_status!='2' AND bill_status!='3'"); 
if(mysql_num_rows($rVc)==0){
?>
<input type="button" class="butExample" value="Cancel" onclick="fpCancel();"/>
<?php }else{?>
<a href="#"><input type="button" class="butDisable" value="Cancel"/></a>
<?php }?>
</td>

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