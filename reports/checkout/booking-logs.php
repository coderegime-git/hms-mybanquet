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
	
	$('#searchBtn').click(function(){
	item="?val="+$('#searchTxt').val();
	document.location.href="booking-logs.php"+item;
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
sts=$('#confirm_status').val();
/* if(fromdate!="" && todate!="")
{ */
document.location="booking-logs.php?fromdate="+fromdate+"&todate="+todate+"&sts="+sts;
/* } */

}

function srcSub(){
	$('#searchTxt').val('');
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
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>

<td><label style="width:100px;"><b>Status :</b></label></td>
<td style="text-align:center;" class="sourceonVAL">
	<?php $sqlBS=mysql_query("select distinct room_availability,roomavail_define from bq_stscolor where roomavail_define!='1' "); ?>
	<select name="confirm_status[]" id="confirm_status<?php echo $cc;?>" class="fstChUPPRCase" style="width:87px;float:left;font-size:12px;" onChange="selConfirmStsName('<?php echo $cc;?>');">
	<option value="">--Select--</option>
	<option value="all"<?php echo ($_GET['sts']=='all')?'selected':''; ?>>All</option>
	<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
	<?php if($rowBS['roomavail_define']==$_GET['sts']) { ?>
	<option value="<?php  echo $rowBS['roomavail_define']; ?>" selected ><?php  echo $rowBS['room_availability'];?></option>
	<?php  }else{  ?>
	<option value="<?php  echo $rowBS['roomavail_define']; ?>"><?php  echo $rowBS['room_availability'];?></option>
	<?php  } }  ?>
	</select>
</td>
	
	
<td style="">
	<!--<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter Guest name / Phone / Venue" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php /* if(isset($_GET['sts'])) {echo $_GET['sts'];}else{echo '';} */?>" onclick="srcSub();" />-->

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
	
</td>

<td style="">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter Booking#/Name/Venue/Date" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['sts'])) {echo $_GET['sts'];}else{echo '';} ?>" onclick="srcSub();" />

	<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="myButSRc btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>
	
</td>


<td>
	<a href="<?php echo $home_path ?>/reports/checkout/xt_booking_logs.php?fromdate=<?php echo $_GET['fromdate']?>&todate=<?php echo $_GET['todate']?>&sts=<?php echo $_GET['sts']?>" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="margin:0 0 0 44px;" class="myButeXL btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Export&nbsp;</button></a>
</td>
<td>
	<input type="button" value="Print" class="myButsprn" onclick="printPage();" style="margin:0 0 0 75px;font-weight: bold;padding: 5px;">
</td>


</tr>
</table>
 </div>

<table cellpadding="0" cellspacing="0" border="1" class="table" style="margin:10px 0 0px 0px;text-align:center;font-size:12px;position;absolute;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDTT" style=""><b>Booking Status</b></h3><b></b></td>
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
	<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Sl.no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Booking#" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Fn Date" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Gst Name" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Venue" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Session" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="From" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="To" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Pax" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Function" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Phone" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:8%;"><div label="Email" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Company" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Booked by" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Booker no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Adv" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Recept no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Pay mode" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Status" ></div></th>
		
    	<th class="scrollbarhead"></th>
	</tr>
	</thead>
	<thead class="dispSHw" style="display:none;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDT" id=""><b>Booking Status</b></h3><b></b></td>
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
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Pax</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Function</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Phone</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Email</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Company</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booked by</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booker no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Adv</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Recept no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Pay mode</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Status</th>
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

if(isset($_GET['fromdate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['sts']) && $_GET['sts']!='' && $_GET['sts']!='all') {
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status='".$_GET['sts']."'  group by booking_no,venue order by str_to_date(book_date,'%d/%m/%Y') ASC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}
else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['sts']) && $_GET['sts']=='all') {
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod'   group by booking_no,venue order by str_to_date(book_date,'%d/%m/%Y') ASC ";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}
else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['sts']) && $_GET['sts']=='') {
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod'   group by booking_no,venue order by str_to_date(book_date,'%d/%m/%Y') ASC ";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}

if(isset($_GET['val']) && $_GET['val']!=''){
$item_where= " where booking_no like '%".$_GET['val']."%' OR guest_name like '%".$_GET['val']."%' OR venue like '%".$_GET['val']."%' OR book_date like '%".$_GET['val']."%' ";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}

/* else if(isset($_GET['sts']) && $_GET['sts']!='') {
$item_where= " where guest_name like '%".$_GET['sts']."%' OR phone like '%".$_GET['sts']."%' OR venue like '%".$_GET['sts']."%' AND confirm_status!='1' AND str_to_date(book_date,'%d/%m/%Y') >= '$cur' AND confirm_status!='7' order by str_to_date(book_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}else{
$sql=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status!='7' AND confirm_status!='1' order by str_to_date(book_date,'%d/%m/%Y') DESC"); 
} */

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
	$clr='#000';
}else if($row['confirm_status']==2) {
	$rmAVai=$rowRd['room_availability'];
	$clr='#000';
}else if($row['confirm_status']==3) {
	$rmAVai=$rowRo['room_availability'];
	$clr='#000';
}else if($row['confirm_status']==4) {
	$rmAVai=$rowRg['room_availability'];
	$clr='#000';
}else if($row['confirm_status']==5) {
	$rmAVai=$rowRm['room_availability'];
	$clr='#000';
}else if($row['confirm_status']==6) {
	$rmAVai=$rowbl['room_availability'];
	$clr='#000';
}else if($row['confirm_status']==7) {
	$rmAVai='CANCELLED';
	$clr='#fc0330';
}

$sqlR=mysql_query("select sum(amount)as advAmt,receipt_no,pay_mode,booking_no from bq_hallresvadv where booking_no='".$row['booking_no']."' AND status='1' AND hallbook_id='".$row['hallbook_id']."' group by booking_no");
$rowR=mysql_fetch_array($sqlR);	
		
		
?>
<tr>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $x;  ?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $row['booking_no'];?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $row['book_date']; ?></td>
	<td width="80" style="text-align:left;color:<?php  echo $clr; ?>;"><?php echo strtoupper($row['guest_name']); ?></td>
	<td width="80" style="text-align:left;color:<?php  echo $clr; ?>;"><?php echo strtoupper($row['venue']); ?></td>
	<td width="80" style="text-align:left;color:<?php  echo $clr; ?>;"><?php echo strtoupper($row['session']); ?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $row['from_time']; ?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $row['to_time']; ?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $row['guaranted']; ?></td>
	<td width="80" style="text-align:left;color:<?php  echo $clr; ?>;"><?php echo strtoupper($row['funct']); ?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $row['phone']; ?></td>
	<td width="80" style="text-align:left;color:<?php  echo $clr; ?>;"><?php echo $row['email']; ?></td>
	<td width="80" style="text-align:left;color:<?php  echo $clr; ?>;"><?php echo strtoupper($row['company_name']); ?></td>
	<td width="80" style="text-align:left;color:<?php  echo $clr; ?>;"><?php echo strtoupper($row['contact_person']); ?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $row['contact_mobile']; ?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $rowR['advAmt']; ?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo $rowR['receipt_no']; ?></td>
	<td width="80" style="text-align:center;color:<?php  echo $clr; ?>;"><?php echo ucfirst($rowR['pay_mode']); ?></td>
	<td width="80" style="text-align:left;color:<?php  echo $clr; ?>;background-color:#<?php /* echo $clr; */?>"><?php echo strtoupper($rmAVai); ?></td>

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