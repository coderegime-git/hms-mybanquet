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
	yearRange:"-5:+5",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-5:+5",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});
	
	
	jQuery("#roommaster").validationEngine();
	});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});
shortcut.add("Ctrl+A",function() { 
	 $('#taxTypes').attr('action', 'define-tax.php');  
	 $('#taxTypes').submit(); 
}); 

/* shortcut.add("Ctrl+E",function() { 
	uid=$('#roomid').val();
	window.location.href = "edit_define_tax.php?roomid="+uid;
}); */

function checkPropertyCode(){
	propCode=$('#property_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatPropertyCode.php',
			data:{
			propCode:propCode
			},
			success:function(data){
				/* alert(data); */
				if(data==1){
					$('#propertycode_err').html('* Property Code already exists.');
					$('#property_code').val('');
				}
				else{
					$('#propertycode_err').html('');
				}
			}
	});
}

function clkSubmit() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
srtx=$('#searchTxt').val();
/* if(fromdate!="" && todate!="")
{ */
document.location="view-hall-booking.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
/* } */

}

function srcSub(){
	$('#searchTxt').val('');
	$('#from_date').val('');
	$('#to_date').val('');
	$('#searchTxt').val('');
}


function printPage(){
			/* $(".ckPrint").hide(); */
			 /* $('.ckPrint').delay(5000).hide(0);  */ 
			$('.ckPrint').hide().delay(3000).show(0);
			$('.Ckk').hide().delay(3000).show(0);	
			$('.dispSHw').show().delay(1000).hide(0);					
			var divContents = $("#dvContainer").html();
		    var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print(); 
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
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['fromdate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter Guest name / Phone / Venue" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
	<!--<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="myButSRc btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>-->
	
	<input type="button" value="Print" class="myButsprn" onclick="printPage();" style="margin:0 0 0 128px;font-weight: bold;padding: 5px;">
</td>
<!--<td>
	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
</td>-->

<td>
<a href="hall-booking.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Booking</button></a>
</td>
</tr>
</table>
 </div>

<table cellpadding="0" cellspacing="0" border="1" class="table" style="margin:10px 0 0px 0px;text-align:center;font-size:12px;position;absolute;">
	<tr class="info">
		<td colspan="21" style="text-align:center;"><h3 class="viewDTT" style=""><b>View Hall Booking Details</b></h3><b></b></td>
	</tr>
</table>

<form id="taxTypes" name="taxTypes" class="" style="overflow:auto;height:470px;"> 
<div style="" >
<div class="scrollingtable frmCentrR" id="dvContainer"  >
  <div>
    <div style="">

<table style="text-align:center;font-size:12px;" border="1" cellpadding="0" cellspacing="0">
	<thead style="width:500px;">
	<tr>
	<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Sl.no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Booking#" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Fn Date" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Gst Name" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Venue" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Session" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="From" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="To" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Function" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Exp Pax" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Guar Pax" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Phone" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:8%;"><div label="Email" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Company" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Booked by" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Booker no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Adv" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Recept no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Pay mode" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Status" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Edit" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Log" ></div></th>
    	<th class="scrollbarhead"></th>
	</tr>
	</thead>
	<thead class="dispSHw" style="display:none;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDT" id=""><b>View Hall Booking Details</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booking#</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Fn date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Gst Name</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Venue</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Session</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">From time</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">To time</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Function</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Exp Pax</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Guar Pax</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Phone</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Email</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Company</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booked by</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booker no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Adv</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Recept no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Pay mode</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Status</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Edit</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Log</th>
</tr>
<style>
.butExample {
    padding: 4px 9px;
}
.butDisable{
	padding: 4px 9px;
}
</style>
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
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status!='1' AND confirm_status!='7' order by str_to_date(book_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']=='') {
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status!='1' AND confirm_status!='7' order by str_to_date(book_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}else if(isset($_GET['val']) && $_GET['val']!='') {
$item_where= " where guest_name like '%".$_GET['val']."%' OR phone like '%".$_GET['val']."%' OR venue like '%".$_GET['val']."%' OR booking_no like '%".$_GET['val']."%' order by str_to_date(book_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}else{
$sql=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status!='7' AND confirm_status!='1' order by str_to_date(book_date,'%d/%m/%Y') DESC"); 
}

$x=0;
while($row=mysql_fetch_array($sql)) {
$x++;
$sqlRv=mysql_query("select * from bq_stscolor where roomoccupy_id='1'");
$rowRv=mysql_fetch_array($sqlRv); 
$sqlRd=mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
$rowRd=mysql_fetch_array($sqlRd);
$sqlRo=mysql_query("select * from bq_stscolor where roomoccupy_id='3'");
$rowRo=mysql_fetch_array($sqlRo); 
$sqlRg=mysql_query("select * from bq_stscolor where roomoccupy_id='4'");
$rowRg=mysql_fetch_array($sqlRg);
$sqlRm=mysql_query("select * from bq_stscolor where roomoccupy_id='5'");
$rowRm=mysql_fetch_array($sqlRm);
$sqlRe=mysql_query("select * from bq_stscolor where roomoccupy_id='6'");
$rowbl=mysql_fetch_array($sqlRe);

if($row['confirm_status']==1) {
	$rmAVai=$rowRv['room_availability'];
	$clr=$rowRv['room_color'];
}else if($row['confirm_status']==2) {
	$rmAVai=$rowRd['room_availability'];
	$clr=$rowRd['room_color'];
}else if($row['confirm_status']==3) {
	$rmAVai=$rowRo['room_availability'];
	$clr=$rowRo['room_color'];
}else if($row['confirm_status']==4) {
	$rmAVai=$rowRg['room_availability'];
	$clr=$rowRg['room_color'];
}else if($row['confirm_status']==5) {
	$rmAVai=$rowRm['room_availability'];
	$clr=$rowRm['room_color'];
}else if($row['confirm_status']==6) {
	$rmAVai=$rowbl['room_availability'];
	$clr=$rowbl['room_color'];
}


$sqlR=mysql_query("select sum(amount)as advAmt,receipt_no,pay_mode from bq_hallresvadv where booking_no='".$row['booking_no']."' AND status='1'");	
$rowR=mysql_fetch_array($sqlR);	
		
		
?>
<tr>
	<td width="80" style="text-align:center;"><?php echo $x;  ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['booking_no'];?></td>
	<td width="80" style="text-align:center;"><?php echo $row['book_date']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['guest_name']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['venue']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['session']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['from_time']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['to_time']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['funct']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['expected']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['guaranted']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['phone']; ?></td>
	<td width="80" style="text-align:left;"><?php echo $row['email']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['company_name']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['contact_person']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['contact_mobile']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $rowR['advAmt']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $rowR['receipt_no']; ?></td>
	<td width="80" style="text-align:center;"><?php echo ucfirst($rowR['pay_mode']); ?></td>
	<td width="80" style="text-align:left;color:#000;background-color:#<?php /* echo $clr; */?>"><?php echo strtoupper($rmAVai); ?></td>
<td width="80" style="text-align:center;">
<?php if($row['fp_status']=="" && $row['log_status']=="1") { ?>
<a href="edit-hall-booking.php?roomBk=<?php echo $row['booking_no']; ?>&rmBkID=<?php echo $row['hallbook_id']; ?>" style="" class=""><input type="button" class="btnH" value="Edit"/></a>
<?php }else{?>
<a href="#"><input type="button" class="butDisable" value="Edit"/></a>
<?php }?>
</td>
<td width="80">
		<a onclick="clikval('<?php echo $row['comp_code']; ?>');" style="" class="Ckk">Log</a>&nbsp;
		</td>


</tr>
<?php } ?>	

</table>

	</div>
	</div>
	</div>
	</div>
	<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <h4>Use Log</h4>
    </div>
	<img onclick="closewin();" style="width: 3%;position: absolute;top: 0;right: 0;cursor: pointer;" src="../../img/close.png" />
    <div id="loaddata" class="modal-body">
      <p>Some text in the Modal Body</p>
      <p>Some other text...</p>
    </div>
  </div>

</div>
	</div>
	</div>
	<?php include("../../footer.php"); ?>
	<script>
function clikval(obj)
{
	var source_code = obj;
	$.ajax({
		type:'GET',
		url:'../../log/hall_bookinglog.php',
			data:{
			source_code:source_code
			},
			success:function(data){
				// alert(data); 
			$('#loaddata').html(data);
			$('#myModal').css('display','block');
			}
	});
	
	
}

function closewin()
{
	$('#myModal').css('display','none');
}
var modal = document.getElementById("myModal");
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
	
	<?php include("../../footer.php"); ?>
	</body>
 </form>