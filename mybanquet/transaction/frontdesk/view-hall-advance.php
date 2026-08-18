<?php
ob_start();
error_reporting(0);
include("../../config.php");
include("../../header.php");
?>
<!--form validation-->	
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="../../js/sweetalert.min.js"></script>
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
	
	
		/* $('#searchBtn').click(function(){
		item="?val="+$('#searchTxt').val();
		document.location.href="view-reservroom-booking.php"+item;
	});  */
	
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
document.location="view-hall-advance.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
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

.butExample {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 66px;
}

.butExample {
    padding: 4px 9px;
}
.butDisable{
	padding: 4px 9px;
}
th {
  position: sticky;
  top: 0;
  background-color: #F5F5F5;
}

</style>	

<body class="bgBODY">
<?php 	
/* echo $_GET['msg']; */ 
if(isset($_GET['msg'])){
?>
<script>
$(document).ready(function(){
rserNo=$('#rserNo').val();
rcptNo=$('#rcptNo').val();
msg=$('#msg').val();
swal({
            title: "Do You  Want To Print Advance?",
            text: "Advance No: <?php echo $_GET['rcptNo']; ?>",
            icon: "warning",
            buttons:{
				 cancel: true,
                 confirm: "Yes",
			},
        })
        .then(function (isOkay) {
            if (isOkay) {
                // form.submit();
			window.open('../view/print-HallReserv-advance.php?rserNo='+rserNo+'&rcptNo='+rcptNo+'&_blank,width=1000,height=700');
            }
        });
        return false;
});
</script>
<?php } ?>
 
<div style="margin:10px 0 0 0;">
<table style="">
<tr>
<input id="rserNo" value="<?php  echo $_GET['rserNo'];?>" hidden > 
	<input id="rcptNo" value="<?php  echo $_GET['rcptNo'];?>" hidden > 
<!--<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	
	<input id="msg" value="<?php  echo $_GET['msg'];?>" hidden > 
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>-->
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter Guest name / Phone / Venue" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
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
		<td colspan="19" style="text-align:center;"><h3 class="viewDTT" style=""><b>View Hall Booking Details</b></h3><b></b></td>
	</tr>
</table>

 <form id="taxTypes" name="taxTypes" class="" > 

 <div style="max-height:500px;overflow-y: scroll;overflow-x: scroll;">
  

<table style="text-align:center;font-size:12px;" border="1" cellpadding="0" cellspacing="0">
	<thead>
<tr style="background-color:#dee2e6;color:#000;"> 
		<th width="80" style="text-align:center;">Sl.no</th>
		<th width="80" style="text-align:center;">Booking#</th>
		<th width="80" style="text-align:center;">Booking Date</th>
		<th width="80" style="text-align:center;">Fn date</th>
		<th width="80" style="text-align:center;">Gst Name</th>
		<th width="80" style="text-align:center;">Venue</th>
		<th width="80" style="text-align:center;">Session</th>
		<th width="80" style="text-align:center;">From time</th>
		<th width="80" style="text-align:center;">To time</th>
		<th width="80" style="text-align:center;">Function</th>
		<th width="80" style="text-align:center;">Phone</th>
		<th width="80" style="text-align:center;">Email</th>
		<th width="80" style="text-align:center;">Company</th>
		<th width="80" style="text-align:center;">Booked by</th>
		<th width="80" style="text-align:center;">Booker no</th>
		<th width="80" style="text-align:center;">Adv</th>
		<th width="80" style="text-align:center;">Receipt no</th>
		<th width="80" style="text-align:center;">Receipt Date</th>
		<th width="80" style="text-align:center;">Pay mode</th>
		<th width="80" style="text-align:center;">Status</th>
		<th width="80" style="text-align:center;">Advance</th>
</tr>

</thead>
<?php 
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$ad=explode('/',$adtCurDt);
$cur=$ad[2].'/'.$ad[1].'/'.$ad[0];
$cdate=$ad[2].'-'.$ad[1].'-'.$ad[0];

	$fr=explode('/',$_GET['fromdate']);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	$to=explode('/',$_GET['todate']);
	$tod=$to[2].'-'.$to[1].'-'.$to[0];

if(isset($_GET['fromdate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']!='') {
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$cdate' AND confirm_status!='1' AND confirm_status!='7'  order by str_to_date(book_date,'%d/%m/%Y' ) ASC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']=='') {
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$cdate' AND confirm_status!='1' AND confirm_status!='7'  order by str_to_date(book_date,'%d/%m/%Y') ASC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}else if(isset($_GET['val']) && $_GET['val']!='') {
$item_where= " where guest_name like '%".$_GET['val']."%' OR phone like '%".$_GET['val']."%' OR venue like '%".$_GET['val']."%' AND confirm_status!='1' AND str_to_date(book_date,'%d/%m/%Y') >= '$cdate' AND confirm_status!='7'  order by str_to_date(book_date,'%d/%m/%Y') ASC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}else{
$sql=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$cdate' AND confirm_status!='7' AND confirm_status!='1'  order by str_to_date(book_date,'%d/%m/%Y') ASC"); 
}


/* $sql=mysql_query("select * from bq_hallbooking where confirm_status!='1' AND str_to_date(book_date,'%d/%m/%Y') >= '$cur' AND confirm_status!='7'"); */
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




$sqlR=mysql_query("select sum(amount)as advAmt,receipt_no,pay_mode,cur_date from bq_hallresvadv where booking_no='".$row['booking_no']."' AND status='1' group by receipt_no");	
$rowR=mysql_fetch_array($sqlR);		

$sqS=mysql_query("select bkno from bq_opbillstldtl where bkno='".$row['booking_no']."' AND settleflag='1'");
if(mysql_num_rows($sqS)==0){	
	$bk=explode('/',$row['book_date']);
$bkD=$bk[2].'-'.$bk[1].'-'.$bk[0];
/* echo $adtCurDt; */
$sqlVe=mysql_query("select * from bq_venue where status='1'");
$rowVe=mysql_fetch_array($sqlVe);
$rwC=mysql_fetch_array(mysql_query("select count(receipt_no) as rcpt from bq_hallresvadv where booking_no='".$row['booking_no']."' and hallbook_id='".$row['hallbook_id']."' AND status='1'"));
if($rwC['rcpt']>0){
	$cnt=$rwC['rcpt']+1;
}else{
	$cnt=1;
}
?>
<tr>
	<td width="80" style="text-align:center;" rowspan="<?php echo $cnt;?>"><?php echo $x;  ?></td>
	<td width="80" style="text-align:center;" rowspan="<?php echo $cnt;?>"><?php echo $row['booking_no'];?></td>
	<td width="80" style="text-align:center;" rowspan="<?php echo $cnt;?>"><?php echo $row['audit_date']; ?></td>
	<td width="80" style="text-align:center;" rowspan="<?php echo $cnt;?>"><?php echo $row['book_date']; ?></td>
	<td width="80" style="text-align:left;" rowspan="<?php echo $cnt;?>"><?php echo strtoupper($row['guest_name']); ?></td>
	<td width="80" style="text-align:left;" rowspan="<?php echo $cnt;?>"><?php echo strtoupper($row['venue']); ?></td>
	<td width="80" style="text-align:left;" rowspan="<?php echo $cnt;?>"><?php echo strtoupper($row['session']); ?></td>
	<td width="80" style="text-align:center;" rowspan="<?php echo $cnt;?>"><?php echo $row['from_time']; ?></td>
	<td width="80" style="text-align:center;" rowspan="<?php echo $cnt;?>"><?php echo $row['to_time']; ?></td>
	<td width="80" style="text-align:left;" rowspan="<?php echo $cnt;?>"><?php echo strtoupper($row['funct']); ?></td>
	<td width="80" style="text-align:center;" rowspan="<?php echo $cnt;?>"><?php echo $row['phone']; ?></td>
	<td width="80" style="text-align:left;" rowspan="<?php echo $cnt;?>"><?php echo $row['email']; ?></td>
	<td width="80" style="text-align:left;" rowspan="<?php echo $cnt;?>"><?php echo strtoupper($row['company_name']); ?></td>
	<td width="80" style="text-align:left;" rowspan="<?php echo $cnt;?>"><?php echo strtoupper($row['contact_person']); ?></td>
	<td width="80"  style="text-align:center;" rowspan="<?php echo $cnt;?>" >
		<?php if($cnt>1){?>
	<tr>
	<?php 
	$sqlR=mysql_query("select * from bq_hallresvadv where booking_no='".$row['booking_no']."' AND status='1'");	
	while($rowR=mysql_fetch_array($sqlR)) {?>
	<td width="80" style="text-align:center;"><?php echo sprintf("%01.2f",$rowR['netamt']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $rowR['receipt_no']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $rowR['cur_date']; ?></td>
	<td width="80" style="text-align:center;"><?php echo ucfirst($rowR['pay_mode']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($rmAVai); ?></td>
	<td width="80" style="text-align:center;">
	<?php if($row['confirm_status']=="2" && strtotime($bkD)>= strtotime($cur)) { ?>
	<a href="reserv-hall-advance.php?roomBk=<?php echo $row['booking_no']; ?>&rmBkID=<?php echo $row['hallbook_id']; ?>" style="" class="btnH">Pay </a></td><?php } ?>
	</tr>
		<?php }  ?>
    </td>
	<?php } else{?>
	<td width="80" style="text-align:center;">0.00</td>
	<td width="80" style="text-align:center;"></td>
	<td width="80" style="text-align:center;"></td>
	<td width="80" style="text-align:center;"></td>
	<td width="80" style="text-align:left;background-color:#<?php/*  echo $clr; */?>"><?php echo strtoupper($rmAVai); ?></td>
	<td width="80" style="text-align:center;">
	<?php if($row['confirm_status']=="2" && strtotime($bkD)>= strtotime($cur)) { ?>
	<a href="reserv-hall-advance.php?roomBk=<?php echo $row['booking_no']; ?>&rmBkID=<?php echo $row['hallbook_id']; ?>" style="" class="btnH">Pay 
	<?php }else { ?>
	<a href="#"><input type="button" class="butDisable" value="Pay"/></a>
	<?php } ?>
    </a></td>
	<?php }  ?>
</tr>
<?php } } ?>	

</table>

	</div>
	
	<?php include("../../footer.php"); ?>
	</body>
 </form>