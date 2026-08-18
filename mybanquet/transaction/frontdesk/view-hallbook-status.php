<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">

<script>
$(document).ready(function(){
	 $('[data-toggle="tooltip"]').tooltip();   	
		$(".datepicker" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+2",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+2",
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

function showGridView() {
ven=$('#bq_venue').val();
fromdate=$('#from_date').val();
todate=$('#to_date').val();
if(fromdate!="" && todate!="")
{
	document.location="view-hallbook-status.php?fromdate="+fromdate+"&todate="+todate+"&ven="+ven;
}

	
}
</script>
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
</style>

<?php
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
?>
	
<body class="bgBODY">
<form id="taxTypes" name="taxTypes" class="" style=""> 

<div id="viewcustomer" class="col-md-9" id="cOlT">
<input type="hidden" id="adtDt" name="adtDt" value="<?php echo $adtCurDt;?>"/>
<div style="margin:0px 0 0 0px;background-color:#0073B5;color:#fff;" >
<table style="width:800px;">	
<tr>
<td style="width:60px;"><label style="width:80px;color:#fff;font-size:12px;"><b>From </b></label></td>
<td >
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td style="width:60px;"><label style="width:70px;color:#fff;font-size:12px;"><b>To </b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 100px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td style="width:90px;"><label style="width:90px;color:#fff;font-size:12px;"><b>Status </b></label></td>
<td style="border:none;width:161px;" >
		<?php $sqlPV=mysql_query("select * from bq_venue");?>
		<select name="bq_venue" id="bq_venue" style="width:143px;font-size:12px;" >
		<option value="all">All</option>
		<?php while($rowPV=mysql_fetch_array($sqlPV)) { ?>
		<?php if($rowPV['venue_desc']==$_GET['ven']) { ?>
		<option value="<?php echo $rowPV['venue_code'];?>" selected ><?php echo $rowPV['venue_desc'];?></option>
		<?php } else { ?>
		<option value="<?php echo $rowPV['venue_code'];?>"><?php echo $rowPV['venue_desc'];?></option>
		<?php } } ?>
		</select>
</td>
<td style="" id="">
<span>
&nbsp;&nbsp;<input type="button" value="Apply" class="btnH" onclick="showGridView();" style="margin:0 0 0 0px;font-weight: bold;font-size:13px;padding:0px 2px 0 2px;">
</span>
</td>

<td style="" id="">
<span>
<img src="<?php echo $home_path;?>/images/previou.png" value="Apply" class="btnH" style="margin:0 0 0 0px;font-weight: bold;font-size:13px;padding:0px 2px 0 2px;width:35px;height:25px;cursor:pointer;" title="Previous" onclick="dashprevious();"/>
<img src="<?php echo $home_path;?>/images/next.png" value="Apply" class="btnH" style="margin:0 0 0 0px;font-weight: bold;font-size:13px;padding:0px 2px 0 2px;width:35px;height:25px;cursor:pointer;" title="Next" onclick="dashNext();"/>
</span>
</td>

	
</tr>
</table>
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;">
<tr>
	<th style="text-align:center;background-color:#17C464;font-weight:bold;width:80px;">Date</th>
	<th style="text-align:center;background-color:#17C464;font-weight:bold;width:80px;">Venue</th>
	<?php 
	for($cc=6;$cc<=24;$cc++){
	?>
	<th style="text-align:center;background-color:#17C464;font-weight:bold;width:20px;"><?php echo $cc; ?></th>
	<?php } ?>
</tr>
</table>
</div>


<div id="dshBrd" style="width:100%;height:463px;overflow:auto;">




<!--<div style="background-color:#7b0e0e;width:100%;">
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;border:none;float:right;">
<tr>
	<td style="border:none;width:100px;" id="Userhd">
		<?php $sqlPV=mysql_query("select * from bq_venue");?>
		<select name="bq_venue" id="bq_venue" style="width:120px;font-size:12px;" >
		<option value="all">All</option>
		<?php while($rowPV=mysql_fetch_array($sqlPV)) { ?>
		<?php if($rowPV['venue_desc']==$_GET['ven']) { ?>
		<option value="<?php echo $rowPV['venue_code'];?>" selected ><?php echo $rowPV['venue_desc'];?></option>
		<?php } else { ?>
		<option value="<?php echo $rowPV['venue_code'];?>"><?php echo $rowPV['venue_desc'];?></option>
		<?php } } ?>
		</select>

<span>
<input name="from_date" style="width:100px;float:right;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</span>

<span>
	<input name="to_date" style="width:100px;float:right;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</span>
</td>
<td style="width:42px;" id="Userhd">
<span>
<input type="button" value="Apply" class="btnH" onclick="showGridView();" style="margin:0 0 0 0px;font-weight: bold;padding: 5px;font-size:13px;padding:0px 2px 0 2px;">
</span>
</td>
</tr>
</table>
</div>-->

<style>
table {
    table-layout:fixed;
}

table td {
    overflow:hidden;
	border:none;
}

::-webkit-scrollbar
{
  width: 6px;  /* for vertical scrollbars */
  height: 12px; /* for horizontal scrollbars */
}

::-webkit-scrollbar-track
{
  background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-thumb
{
  background: rgba(0, 0, 0, 0.5);
}
</style>

<?php
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


$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$dte=explode('/',$adtCurDt);
$dtea=$dte[2].'/'.$dte[1].'/'.$dte[0];
?>	

<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;">

<tr>
<?php
if(isset($_GET['fromdate']) && isset($_GET['todate'])) { 
$fr=explode('/',$_GET['fromdate']);
$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
$to=explode('/',$_GET['todate']);
$tod=$to[2].'-'.$to[1].'-'.$to[0];


$frDate=$_GET['fromdate'];
$toDate=$_GET['todate'];
}else{
$frDate=$adtCurDt;
$toDate=$adtCurDt;	
}
$frxpl=explode('/',$frDate);
$frDt=@$frxpl[2].'-'.@$frxpl[1].'-'.@$frxpl[0];
$toDat=explode('/',$toDate);
$toDD=@$toDat[2].'-'.@$toDat[1].'-'.@$toDat[0];
		
$date_from = $frDt;   
$date_from = strtotime($date_from); 
$date_to = $toDD;  
$date_to = strtotime($date_to);  
for ($i=$date_from; $i<=$date_to; $i+=86400) {
	
$rr= date("d/m/Y", $i);	
$rrr= date("Y-m-d", $i);

	
if(isset($_GET['ven']) && $_GET['ven']!='' && $_GET['ven']!='all') {
	$sqlRe=mysql_query("select * from bq_venue where venue_code='".$_GET['ven']."'");
}else if(isset($_GET['ven']) && $_GET['ven']=='all') {
	$sqlRe=mysql_query("select * from bq_venue");
}else{
	$sqlRe=mysql_query("select * from bq_venue");
}
$x=0;
while($rowRe=mysql_fetch_array($sqlRe)){
	$x++;
?>
		<?php if($x==1) { ?>
		<?php  if(isset($_GET['fromdate']) && $_GET['fromdate']!='') { ?>
		<td style="text-align:center;width:80px;"><?php  echo $rr;  ?></td>
		<?php }else{ ?>
		<td style="text-align:center;width:80px;"><?php  echo $adtCurDt;  ?></td>
		<?php } ?>
		<?php }else{ ?>
		<td style="text-align:center;width:80px;">&nbsp;</td>
		<?php } ?>
		<td style="text-align:left;width:80px;"><a href="<?php echo $home_path ?>/transaction/frontdesk/hall-booking.php?ven=<?php echo $rowRe['venue_desc']?>&dte=<?php echo $rr; ?>" style="color:#000;"><?php echo $rowRe['venue_desc']; ?></a></td>

<script>
function vcntRoomBook() {
	document.location.href="<?php echo $home_path ?>/transaction/frontdesk/hall-booking.php";
}
</script>
<?php 
for($cc=6;$cc<=24;$cc++){

$sqD=mysql_query("select * from bq_dashhall where str_to_date(funtion_date,'%d/%m/%Y') = '$rrr' AND venue='".$rowRe['venue_desc']."' AND hour='".$cc."' AND status='1'");
if(mysql_num_rows($sqD)>0){
$roD=mysql_fetch_array($sqD);

$sqb=mysql_fetch_array(mysql_query("select * from bq_hallbooking where booking_no='".$roD['booking_no']."' AND hallbook_id='".$roD['hallbook_id']."'"));	
?>
<?php
if($roD['confirm_status']==1){
	$bgcolor= '#'.$rowRv['room_color'];
}else if($roD['confirm_status']==2){
	$bgcolor= '#'.$rowRd['room_color'];
}else if($roD['confirm_status']==3){
	$bgcolor= '#'.$rowRo['room_color'];
}else if($roD['confirm_status']==4){
	$bgcolor= '#'.$rowRg['room_color'];
}else if($roD['confirm_status']==5){
	$bgcolor= '#'.$rowRm['room_color'];
}else if($roD['confirm_status']==6){
	$bgcolor= '#'.$rowbl['room_color'];
}else{
	/* $bgcolor= '#'.$rowRd['room_color']; */
}
/* echo $bgcolor; */
?>
<td style="text-align:center;width:20px;background-color:<?php echo $bgcolor; ?>;color:#fff;" ><a href="<?php echo $home_path;?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $roD['booking_no']; ?>&rmBkID=<?php echo $roD['hallbook_id']; ?>" data-toggle="tooltip" title="<?php echo 'BK#:'.$roD['booking_no'].','.strtoupper('  GUEST:'.$roD['guest_name']).',  PAX: '.$sqb['guaranted'];?>">&nbsp;</a></td>
<?php }else{ ?>
<a href="<?php echo $home_path;?>/transaction/frontdesk/hall-booking.php?dte=<?php echo $rr; ?>&ven=<?php echo $rowRe['venue_desc']; ?>"><td style="text-align:center;width:20px;background-color:#<?php echo $rowRv['room_color']; ?>;" onclick="vcntRoomBook();"><a href="<?php echo $home_path;?>/transaction/frontdesk/hall-booking.php?dte=<?php echo $rr; ?>&ven=<?php echo $rowRe['venue_desc']; ?>" data-toggle="tooltip" title="Vacant!">&nbsp;</a>&nbsp;&nbsp;</td></a>	
	
<?php } } ?>
		
		
</tr>
<?php  }  }  ?>
</table>



</div>


	
<div id="dshBrdShw" style="width:100%;height:463px;overflow:auto;display:none;">


</div>

<div id="viewcustomer" style="width:100%;overflow:auto;margin:0px 0 0 0;">	
<table class="table table-condensed table-hover table-striped table-bordered dsTTrm" cellspacing="0" cellpadding="6" border="3">
		<tr>
			<td style="background-color:#<?php echo $rowRv['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Available</td>
			<td style="background-color:#<?php echo $rowRd['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Reserved</td>
			<td style="background-color:#<?php echo $rowRo['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Wait Listed </td>
			<td style="background-color:#<?php echo $rowRg['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Enquiry </td>
			<td style="background-color:#<?php echo $rowRm['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Tentative</td>
			<td style="background-color:#<?php echo $rowbl['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Blocked</td>
		</tr>
		
</table>
</div>
	

</div>

<?php include("../../footer.php"); ?>
 </form>