<?php
ob_start();
error_reporting(0);
include("../../config.php");
include("../../header.php");
?>
<!--form validation
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>-->

<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<!--<script src="../../js/sweetalert.min.js"></script>-->	


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
	val=$('#searchTxt').val();
	document.location.href="gst_amendment.php?fromdate="+fromdate+"&todate="+todate+"&val="+val;
	}

function srcSub(){
	$('#from_date').val('');
	$('#to_date').val('');
	$('#searchTxt').val('');
}

function selBadFeed(bl,bk,fr,to){
	$.ajax({
	type:'GET',
	url:'  ../../action/selpopupViewgstInd.php',
		data:{
		bl:bl,
		bk:bk,
		fr:fr,
		to:to
		},
		success:function(data){
			/* alert(data); */
			$('#feedBk').html(data);
		}
	});	 
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
/* echo $_GET['msg']; */ 
if(isset($_GET['msg'])){
?>
<script>
$(document).ready(function(){
rserNo=$('#rserNo').val();
rcptNo=$('#rcptNo').val();
msg=$('#msg').val();
swal({
            title: "Do You  Want To Print Booking Advance?",
            text: "Advance No: <?php echo $_GET['rcptNo']; ?>",
            icon: "warning",
            buttons:{
				 cancel: "No",
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

<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input id="rserNo" value="<?php  echo $_GET['rserNo'];?>" hidden > 
	<input id="rcptNo" value="<?php  echo $_GET['rcptNo'];?>" hidden > 
	<input id="msg" value="<?php  echo $_GET['msg'];?>" hidden > 
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter Guest name / Bill# / Book#" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
	<!--<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="myButSRc btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>-->
</td>
<!--<td>
	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
</td>

<td>
<a href="view-fpvoucher.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Voucher</button></a>
</td>-->
</tr>
</table>
 </div>

<table cellpadding="0" cellspacing="0" border="1" class="table" style="margin:10px 0 0px 0px;text-align:center;font-size:12px;position;absolute;">
	<tr class="info">
<td colspan="19" style="text-align:center;"><h3 class="viewDTT" style=""><b>GST Amendments from <?php if(isset($_GET['fromdate'])){echo $_GET['fromdate']; } ?> to <?php if(isset($_GET['todate'])){echo $_GET['todate']; } ?></b></h3><b></b></td>
</tr>
</table>

<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_bqtgstInsert.php" method="post" class="" style="">
 
 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="width: 90%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">

<table class="table" cellpadding="0" cellspacing="0" border="1" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;width:458px;">
<tbody id="feedBk">
</tbody>
</table>
      </div>
  <div class="modal-footer" style="width:480px;">
	<!--<button type="button" onclick="btnFcs();" class="btn btn-default" data-dismiss="modal">Submit</button>-->
	<button type="submit" onClick="btnFcs();" class="btn btn-default" >Submit</button>
  </div>
    </div>

  </div>
</div>
<div style="" >
<div class="scrollingtable frmCentrR" id="dvContainer" style="width:100%;" >
  <div>
    <div style="">

<table style="text-align:center;font-size:12px;" border="1" cellpadding="0" cellspacing="0">
	<thead style="width:500px;">
	<tr>
	<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Sl.no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Bill no" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Booking date" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Bill date" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Venue" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Session" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Function" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Guest name" ></div></th>
		<!--<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Company Name" ></div></th>-->
		<th style="text-align:center;background-color:#F5F5F5;width:5%;"><div label="Address1" ></div></th>
		<!--<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Address2" ></div></th>-->
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="City" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:8%;"><div label="GSTIN" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Total amount" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="Status" ></div></th>
		<th style="text-align:center;background-color:#F5F5F5;width:10%;"><div label="GST Amend" ></div></th>
	 	<th class="scrollbarhead"></th>
	</tr>
	</thead>
	<thead class="dispSHw" style="display:none;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDT" id=""><b>View Hall Booking Details</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Bill no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booking date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Bill date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Venue</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Session</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">From time</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">To time</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Function</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Phone</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Email</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Company</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booked by</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booker no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Adv</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Receipt no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Pay mode</th>
		<td width="80" style="text-align:left;background-color:#<?php/*  echo $clr; */?>"><?php echo strtoupper($rmAVai); ?></td>
	<td width="80" style="text-align:center;"><a href="reserv-hall-advance.php?roomBk=<?php echo $row['booking_no']; ?>&rmBkID=<?php echo $row['hallbook_id']; ?>" style="" class="btnH">Pay
	<!--<img src="<?php /* echo $home_path; */?>/images/paybtn.png"  style="width:54px;height:20px;"/>-->
	</a></td>
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
	<tbody>
	<?php 
if(isset($_GET['fromdate']) && isset($_GET['todate']) || (isset($_GET['val']))) {
	$fr=explode('/',$_GET['fromdate']);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	$to=explode('/',$_GET['todate']);
	$tod=$to[2].'-'.$to[1].'-'.$to[0];
	
if(isset($_GET['fromdate']) && isset($_GET['todate']) ) {
	$fr=explode('/',$_GET['fromdate']);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	$to=explode('/',$_GET['todate']);
	$tod=$to[2].'-'.$to[1].'-'.$to[0];
	
$sql=mysql_query("select distinct bill_no,bill_date,fname,bkno,billamt from bq_opbillhdr where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status !='3' group by bill_no order by RIGHT(bill_no, 5)");

if(isset($_GET['fromdate']) && isset($_GET['todate']) && isset($_GET['val']) && $_GET['val']!='') {
$item_where= " where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_no like '%".$_GET['val']."%' OR bill_date like '%".$_GET['val']."%' OR guest_name like '%".$_GET['val']."%' AND bill_status !='3' order by RIGHT(bill_no, 5)";
 $sql=mysql_query("select distinct bill_no,bill_date,guest_name,bkno,billamt from bq_opbillhdr $item_where");
} 

}

if(isset($_GET['val']) && $_GET['val']!='') {
$item_where= " where bill_no like '%".$_GET['val']."%' OR bill_date like '%".$_GET['val']."%' OR guest_name like '%".$_GET['val']."%' OR bkno like '%".$_GET['val']."%' AND bill_status !='3' order by RIGHT(bill_no, 5)";
 $sql=mysql_query("select distinct bill_no,bill_date,guest_name,bkno,billamt from bq_opbillhdr $item_where");
}

 
$x=0;$debt=0;$crdt=0;$taxAmt=0;
if(mysql_num_rows($sql)>0) {
while($row=mysql_fetch_array($sql)) {
	$slR=mysql_fetch_array(mysql_query("select * from bq_opbillhdr where bill_no='".$row['bill_no']."' AND bill_status !='3'"));
	
	$bill_status=$slR['bill_status'];
	
	if($bill_status=='3'){
		$settle='Cancelled';
	}else if($bill_status=='2'){
		$settle='Settled';
	}else if($bill_status=='1'){
		$settle='Processing';
	}else{
		$settle='';
	}
		$x++;
$sqlBc=mysql_query("select sum(billamt)AS netAmt from bq_opbillhdr where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status !='3'");
$rowBc=mysql_fetch_array($sqlBc);

$slGn=mysql_query("select prefix from gennext_value where field='fobill'");
$rwGn=mysql_fetch_array($slGn);
$foprefix=$rwGn['prefix'];

if($slR['bill_status']=='3'){
	$bgcolor= '#ff0000';
}else{
	$bgcolor= '#000';
}

$slR=mysql_fetch_array(mysql_query("select * from bq_opbillhdr where bill_no='".$row['bill_no']."' AND bill_status !='3'"));
	?>
	
	<tr>
	
		<td width="30" style="text-align:center;"><?php echo $x; ?></td>
		
		<?php
		if($row['bill_status']=='3') { ?>
		<td  class="codesUPPERCase"><a href="<?php echo $home_path;?>/transaction/view/fob_duplicate_print_cancel.php?bilNo=<?php echo $row['bill_no']; ?>&sts=<?php echo $row['bill_status']; ?>" style="font-weight:bold;" class="" title="Print"><?php echo $row['bill_no']; ?></a></td>	
		<?php } else { ?>
		<td  class="codesUPPERCase"><a href="<?php echo $home_path;?>/transaction/view/bill_print_pdf.php?bilNo=<?php echo $row['bill_no']; ?>&sts=<?php echo $row['bill_status']; ?>&type=D" style="font-weight:bold;" class="" title="Print"><?php echo $row['bill_no']; ?></a></td>	
		<?php } ?>
		
		<td  class="fstChUPPRCase"><?php echo $slR['bkdate']; ?></td>
		<td  class="fstChUPPRCase"><?php echo $row['bill_date']; ?></td>
		<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($slR['venue']); ?></td>
		<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($slR['session']); ?></td>
		<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($slR['funct']); ?></td>
		<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($slR['fname']); ?></td>
		<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($slR['add1']); ?></td>
		<!--<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($slR['add2']); ?></td>-->
		<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($slR['city']); ?></td>
		<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($slR['gst_no']); ?></td>
		<td  class="fstChUPPRCase" style="text-align:right;"><?php echo sprintf("%01.2f",$row['billamt']); ?></td>
		<?php if($bill_status=='3'){ ?>
		<td  class="fstChUPPRCase" style="color:red;text-align:left;"><?php echo strtoupper($settle); ?></td>
		<?php }else if($bill_status=='2'){?>
		<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($settle); ?></td>
		<?php } else { ?>
		<td  class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($settle); ?></td>	
	<?php	}?>
		
		<td  class="fstChUPPRCase" style="text-align:left;">
		
		<button type="button" id="add" class="button_example bnkSbt" data-toggle="modal" data-target="#myModal" onClick="selBadFeed('<?php echo $row['bill_no'];?>','<?php echo $row['bkno'];?>','<?php echo $_GET['fromdate'];?>','<?php echo $_GET['todate'];?>');" style="margin:0px 0 0px 10px;"><span class="btnUndLine">GST</span>Amend</button>

		</td>
		
			
	</tr>
	
<?php } } } ?>
<tfoot>	
	<tr>
		<td width="30" style="text-align:center;">&nbsp;</td>
		<td  class="fstChUPPRCase"></td>
		<td  class="fstChUPPRCase"></td>
		<td  class="fstChUPPRCase"></td>
		<td  class="fstChUPPRCase"></td>
		<td  class="fstChUPPRCase"></td>
		<td  class="fstChUPPRCase"></td>
		<td  class="fstChUPPRCase"></td>
		<td  class="fstChUPPRCase"></td>
		<td  class="fstChUPPRCase"></td>
		
		<td  class="fstChUPPRCase" style="text-align:left;font-weight:bold;">Total</td>
		<td  class="fstChUPPRCase" style="text-align:right;font-weight:bold;"><?php if(isset($rowBc['netAmt'])) { echo sprintf("%01.2f",$rowBc['netAmt']);} ?></td>
		<td  class="fstChUPPRCase"></td>		
		<td  class="fstChUPPRCase" style="color:red;"></td>
	</tr>
</tfoot>
</tbody>
</table>

	</div>
	</div>
	</div>
	</div>
	<?php include("../../footer.php"); ?>
	</body>
 </form>