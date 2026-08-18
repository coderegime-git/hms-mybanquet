<?php
ob_start();
 error_reporting(0); 
include("../../config.php");
include("../../header.php");
?>
<head>
<link href="<?php echo $home_path; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $home_path; ?>/css/dataTables.bootstrap.min.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
</head>
<script>
	jQuery(document).ready(function(){
		
	$(".datepicker" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	 minDate: 0, 
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	 minDate: 0, 
	dateFormat:"dd/mm/yy"
	});
	
		 $("#msgFo").fadeOut(5000);
		$('#adave').DataTable({
		 /*"scrollY": 350,*/
	 });
	
	});
	
function clkSubmit() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
srtx=$('#searchTxt').val();
if(fromdate!="" && todate!="")
{ 
document.location="view-fpapproval.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
} 
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

<!--<td>
<a href="fp_creation.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd FP Creation</button></a>
</td>-->
</tr>
</table>
</div>

<form id="taxTypes" name="taxTypes" class="" style="" autocomplete="off"> 
<table class="table table-striped table-success" id="adave" border="1" style="text-align:center;font-size:12px; border-color:#ddd;">
<thead style="background-color:#FFFFFF;">
<tr class="info">
		<td colspan="21" style="text-align:center;"><h3 class="viewDTT" style=""><b>View FP from <?php  echo $_GET['fromdate'];?> to <?php  echo $_GET['todate'];?></b></h3><b></b></td>
	</tr>
	<tr>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Sl.no</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Booking_No#</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Id#</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Guest name</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Venue</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Session</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Function Date</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Approval Status</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Created by</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Created on</th>
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
	
	$sql=mysql_query("select * from bq_hallbooking where  confirm_status='2' and str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' and aprove_sts='1' order by str_to_date(book_date,'%d/%m/%Y') ASC");
	

$x=0;
while($row=mysql_fetch_array($sql)) {
$x++;
	$sqlC=mysql_fetch_array(mysql_query("select * from bq_opfpmenuhdr where fpno='".$row['fpno']."'"));

?>


<tr>
	<td  style="text-align:center;"><?php echo $x;  ?></td>
	<td  style="text-align:center;"><?php echo $row['booking_no'];?></td>
	<td  style="text-align:center;"><?php echo $row['hallbook_id']; ?></td>
	<td  style="text-align:left;width:250px;"><?php echo strtoupper($row['guest_name']); ?></td>
	<td  style="text-align:center;"><?php echo strtoupper($row['venue']); ?></td>
	<td  style="text-align:center;"><?php echo strtoupper($row['session']); ?></td>
	<td  style="text-align:center;"><?php echo strtoupper($row['book_date']); ?></td>
	<td  style="text-align:center;">
	<?php if($sqlC['aprove_sts']==1) { ?>
	<a href="<?php echo $home_path;?>/transaction/frontdesk/approve_fp.php?fpNo=<?php echo $row['fpno'];?>">Pending</a>
	<?php }elseif($sqlC['aprove_sts']==2){?>
    Approved
    <?php }?>
	</td>
<td><?php echo $row['added_by']; ?></td>
<td><?php echo $row['added_on']; ?></td>
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