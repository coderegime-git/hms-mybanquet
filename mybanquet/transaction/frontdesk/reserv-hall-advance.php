<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");
/* include("../../menu.php"); */
?>
 <!--form validation-->	
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>

<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<!-- Datepicker start
<script src="<?php echo $home_path;?>/date-picker/jquery-1.10.2.js"></script>-->
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<!-- End -->


<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	 $(".datepicker" ).datepicker({
	    changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd-mm-yy"
  });
  
   $(".datepicker1" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd-mm-yy"
  }); 
  jQuery("#taxTypes").validationEngine();
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(5000);


$(".incLchk").on("click", function(){
	amount=$('#amount').val();
	$('#reservAmt').val(amount);
	resAMt=$('#reservAmt').val();
	
	yes='yes';
	no='no';
    if(incLchk.checked) {
		$('#inclusive').val('incl');
		$.ajax({
		type:'GET',
		url:'  ../../action/selReservHallAdvance.php',
			data:{
			amount:amount,
			yes:yes
			},
			success:function(data){
				/* alert(data); */
				opt=data.split(',');
				amt=opt[1]-opt[0];
				$('#amount').val(opt[0]);
				$('#netamt').val(opt[1]);
				$('#taxamt').val(amt.toFixed(2));
			}
		});
     
    } else {
		$('#inclusive').val('');
    	$.ajax({
		type:'GET',
		url:'  ../../action/selReservHallAdvance.php',
			data:{
			amount:resAMt,
			resAMt:resAMt,
			no:no
			},
			success:function(data){
				 /* alert(data);  */
				$('#amount').val(data);
				$('#netamt').val(data);
				$('#reservAmt').val(data);
				
				$('#taxamt').val('');
			}
		});
    }
});





	
	

});

 shortcut.add("Ctrl+S",function() { 
	 $('#taxTypes').attr('action', '../../action/add_tax_type.php');  
	 $('#taxTypes').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_define_tax.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#taxTypes').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});


function getGUestName(){
	reserv_no=$('#reserv_no').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selectReservGuestName.php',
			data:{
			reserv_no:reserv_no
			},
			success:function(data){
				  /* alert(data);  */
				$('#guest_name').val(data);
				if(data==1){
					alert("Check Reservation status!.");
				}
			}
	});
}

function popupBillAdv()
{ 
curDt=$('#cur_date').val();
rtNo=$('#receipt_no').val();
roomNo=$('#reserv_no').val();
guNm=$('#guest_name').val();
amt=$('#amount').val();
rem=$('#remarks').val();
paMde=$('#pay_mode').val();
if(curDt!='' && rtNo!='' && roomNo!='' && guNm!='' && amt!='' && paMde!=''){
newwindow=window.open('<?php echo $home_path;?>/transaction/view/print-Reserv-advance.php?curDte='+curDt+'&rcptNo='+rtNo+'&roomNo='+roomNo+'&gustNme='+guNm+'&amt='+amt+'&payMde='+paMde+'&remks='+rem,"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=500');
newwindow.focus();
}
 
} 

function pyMode(){
pyMde=$('#pay_mode').val();
if(pyMde=='CARD'){
	$('#cc_cheqno').val('');
	$('#cheque_date').val('');
	$('#upi').val('');
	$('#card_desc').removeAttr('disabled','disabled');
	$('#cardno').removeAttr('disabled','disabled');
	
}else{
	$('#card_desc').attr('disabled',true);	
	$('#cardno').attr('disabled',true);	
}

if(pyMde=='UPI'){
	$('#cc_cheqno').val('');
	$('#cheque_date').val('');
	$('#card_desc').val('');
	$('#upi').removeAttr('disabled','disabled');
	
}else{
	$('#upi').attr('disabled',true);	
}

if(pyMde=='cheque'){
	$('#card_desc').val('');
	$('#remarks').val('');
	$('#upi').val('');
	$('#cc_cheqno').removeAttr('disabled','disabled');
	$('#cheque_date').removeAttr('disabled','disabled');
	
}else{
	$('#cc_cheqno').attr('disabled',true);	
	$('#cheque_date').attr('disabled',true);	
}

	
}

function cardType(){
pyMde=$('#pay_mode').val();
	if(pyMde=='CARD'){
	$('#cc_cheqno').removeAttr('disabled','disabled');
	$('#cheque_date').removeAttr('disabled','disabled');
	}
}

function resvAdvSubmit(){
	pyMde=$('#pay_mode').val();
	crDesc=$('#card_desc').val();
	ccChq=$('#cc_cheqno').val();
	remA=$('#remarks').val();
	chDt=$('#cheque_date').val();
	var status = true;	
	if(pyMde=='CARD' && crDesc==""){
		
		alert('Select card type');
		status = false;
	}else if(pyMde=='CARD' && remA==""){
		alert('Enter card details');
		status = false;
	}
	
	if(pyMde=='cheque' && ccChq==""){
		alert('Enter cheque no');
		status = false;
	}else if(pyMde=='cheque' && chDt==""){
		alert('Select cheque date');
		status = false;
	}
	
		if(!status){
			return false;
		}
		else
		{
			$('#card_desc').removeAttr('disabled','disabled');
			$('#cc_cheqno').removeAttr('disabled','disabled');
			$('#cheque_date').removeAttr('disabled','disabled');
			$('#taxTypes').submit();
		}
} 

function clrAmt(){
	$('#amount').val('');
	$('#netamt').val('');
	$('#reservAmt').val('');
	$('#taxamt').val('');
	$('#incLchk').val('');
	/* $('.incLchk').prop('checked',false); */
}

function hallAdv(){
	amount=$('#amount').val();
	
	$.ajax({
		type:'GET',
		url:'  ../../action/selReservHallAdvanceNOINcl.php',
			data:{
			amount:amount
			},
			success:function(data){
				 /* alert(data); */
				 opt=data.split(',');
				$('#taxamt').val(opt[0]);
				$('#netamt').val(opt[1]);
			}
		});
	
}

function selBadFeed(){
	 //alert('hi'); 
	bookNo=$('#book_no').val();
	bookId=$('#hallbook_id').val();
	$.ajax({
	type:'GET',
	url:'  ../../action/seladvance_paid.php',
		data:{
		bookNo:bookNo,
		bookId:bookId
		},
		success:function(data){
			/* alert(data); */
			$('#feedBk').html(data);
		}
	});	 
}

</script> 

<body class="bgBODY">
<div id="invoice" style="margin:0 0 0 325px;">
	<!--<div class="container" >-->
	
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;margin:0 0 0 -261px;">
		<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<p style="text-align:center;">
		<span id="msgFoprop" class="msgNotifyprop"></span>
</p>
<style>
.spanClr{
	color: #5b503b;
    display: block;
    float: left;
    font-size: 12px;
    font-weight: normal;
    padding: 2px 9px 0 5px;
}
.btn-sm{
    padding: 3px 10px;
    margin-top: 6px;
    width: 25%;
}
.nowrap{white-space: nowrap;}
.table-responsive{
overflow:hidden;
}
</style>
<!-- Start popup -->
<div id="myModal" class="modal fade" role="dialog" style="padding:20px 0 0 0;width:1000px;margin:0 auto;">
  <div class="modal-dialog" style="width:900px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">

<table class="table table-striped" style="font-size:12px;" cellpadding="0" cellspacing="0" border="1" >
<tbody id="feedBk">
</tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End popup -->
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');

$sqlR=mysql_query("select * from bq_hallbooking where booking_no='".$_GET['roomBk']."' AND hallbook_id='".$_GET['rmBkID']."' group by booking_no order by hallbook_id ASC");	
$row=mysql_fetch_array($sqlR);

$sqlAr=mysql_query("select sum(netamt)as amt from bq_hallresvadv where booking_no='".$_GET['roomBk']."' AND hallbook_id='".$_GET['rmBkID']."' and netamt > 0 and status=1");	
$rowAr=mysql_fetch_array($sqlAr);
if($rowAr['amt'] > 0){
	$amnt=$rowAr['amt'];
}else{
	$amnt=0;
}
?>			
	<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:468px;">
	<h3 id="Userhd"><b>Reservation Hall Advance</b></h3>
<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_hallreserv_advance.php" method="post" class="" style="" onsubmit="myButton.disabled = true; return true;">
	<input type="hidden" name="book_no" id="book_no" value="<?php echo $_GET['roomBk']; ?>" readonly />
<input type="hidden" name="hallbook_id" id="hallbook_id" value="<?php echo $_GET['rmBkID']; ?>" readonly />
<input type="hidden" name="book_date" id="book_date" value="<?php echo $row['book_date']; ?>" readonly />
		<div>
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>
				<tr>
						<td width="" valign="top"><label>Date<em>*</em></label></td>
						<td valign="top"><input type="text" name="cur_date" id="cur_date" data-validation="required" class="textbox input validate[required] form-control" value="<?php echo $rowAC['cur_date'];?>" readonly />
						</td>
				</tr>
				<tr>
						<td width="" valign="top"><label>Booking #<em>*</em></label></td>
						<td valign="top"><input type="text" name="booking_no" id="booking_no" data-validation="required" class="textbox input validate[required] form-control" onkeyup="getGUestName();" value="<?php echo $_GET['roomBk']; ?>" readonly />
						</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Guest Name <em>*</em></label></td>
					<td valign="top"><input type="text" name="guest_name" id="guest_name" data-validation="required" class="textbox input validate[required] form-control" value="<?php echo $row['guest_name']; ?>"  /></td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Advance paid</label></td>
					<td valign="top"><input type="text" name="advpaid" style="height:21px;" id="advpaid" data-validation="required" class="textbox input  fstChUPPRCase form-control" value="<?php echo $amnt; ?>" readonly /><span><i class="fa fa-info-circle fa-2x" aria-hidden="true" style="margin: 0 0 0 7px;" data-toggle="modal" data-target="#myModal" onclick="selBadFeed();"></i></span></td>
				</tr>
					<tr>
						<td width="" valign="top"><label>Amount<em>*</em></label></td>
						<td valign="top"><input type="text" name="amount" id="amount" data-validation="required" class="textbox input validate[required,custom[number]] fstChUPPRCase form-control" value="" onblur="hallAdv();" onclick="clrAmt();" style="width:128px;margin:0 0 0 0px;font-size:12px;"/><span style="margin:0 0 0 6px;font-size:12px;">Nett</span><input type="checkbox" name="incLchk" id="incLchk" value="incl"<?php ?> class="incLchk" style="float:left;margin:0 0 0 10px" checked disabled /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Tax </label></td>
						<td valign="top"><input type="text" name="taxamt" id="taxamt" class="textbox fstChUPPRCase" value="" style="width:72px;float:left;;margin:0 0 0 0px;" readonly /><span style="float:left;margin:0 0 0 5px;font-size:12px;">Total</span>&nbsp;<input type="text" name="netamt" id="netamt" class="textbox fstChUPPRCase" value="" style="width:72px;float:left;;margin:0 0 0 3px;" readonly /> </td>
						
						<input name="reservAmt" id="reservAmt" type="hidden" value="" />
						<input name="inclusive" id="inclusive" type="hidden" value="" />
					</tr>
					<?php 
					$sqlPr=mysql_query("select * from property_definition where propdef_id='1'");
					$rowPr=mysql_fetch_array($sqlPr);
					?>
					<tr>
					<tr>
							<td width="" valign="top"><label>Pay Mode <em>*</em></label></td>
							<td valign="top">
							<?php $sqlPm=mysql_query("select distinct payment_mode from payment_mode where payment_mode!='COMPANY'");?>
							<select name="pay_mode" id="pay_mode" data-validation="required" class="input validate[required] fstChUPPRCase textbox form-control" style="" onchange="pyMode();">
							<option value="">--Select--</option>
							<?php while($rowPm=mysql_fetch_array($sqlPm)) { ?>
							<?php if($rowPr['pay_mode']==$rowPm['payment_mode']) { ?>
							<option value="<?php echo $rowPm['payment_mode'];?>" selected ><?php echo strtoupper($rowPm['payment_mode']);?></option>
							<?php }else{?>
							<option value="<?php echo $rowPm['payment_mode'];?>"><?php echo strtoupper($rowPm['payment_mode']);?></option>
							<?php } } ?>
							</select>
							</td>
						
					</tr>
					<tr>
							<td width="" valign="top"><label>Card Type<em>*</em></label></td>
							<td valign="top">
							<select name="card_desc" id="card_desc" style="border:1px solid #ddd;" class="inptSt textbox form-control" onchange="cardType();" disabled >
							<option value="">--Select--</option>
							<?php 
							$sqlF=mysql_query("select * from company_master where classf='creditcard'");
							while($rowF=mysql_fetch_array($sqlF)) {	?>
							<option value="<?php echo $rowF['comp_name']; ?>"><?php echo  strtoupper($rowF['comp_name']); ?></option>
							<?php }	?>
							</select>
							</td>
					</tr>
					<tr>
							<td width="" valign="top"><label>Upi<em>*</em></label></td>
							<td valign="top">
							<select name="upi" id="upi" style="border:1px solid #ddd;" class="inptSt textbox form-control" onchange="cardType();" disabled >
							<option value="">--Select--</option>
							<?php 
							$sqlF=mysql_query("select * from company_master where classf='upi'");
							while($rowF=mysql_fetch_array($sqlF)) {	?>
							<option value="<?php echo $rowF['comp_name']; ?>"><?php echo  strtoupper($rowF['comp_name']); ?></option>
							<?php }	?>
							</select>
							</td>
					</tr>
					<tr>
						<td width="" valign="top"><label>CC / Cheque #<em>*</em></label></td>
						<td valign="top"><input type="text" name="cc_cheqno" id="cc_cheqno" class="textbox fstChUPPRCase form-control" disabled /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Cheque Date<em>*</em></label></td>
						<td valign="top"><input type="text" name="cheque_date" id="cheque_date" class="textbox fstChUPPRCase datepicker form-control" disabled /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Card No<em>*</em></label></td>
						<td valign="top"><input type="text" name="cardno" id="cardno" class="textbox fstChUPPRCase form-control" disabled /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Remarks<em>*</em></label></td>
						<td valign="top"><input type="text" name="remarks" id="remarks" class="textbox fstChUPPRCase form-control" /></td>
					</tr>
					</tbody>
				</table>
			</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div class="col-md-12  responsive nowrap " style=" padding-left:3px;">
		<button type="button" id="add" class="btn btn-primary btn-sm btn-responsive" name="myButton" style="" onclick="return resvAdvSubmit();" ><img src="<?php echo $home_path;  ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
				
		<a href="view-halladvance-booking.php"><button type="button" id="update" class="btn btn-primary btn-sm btn-responsive" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="btn btn-primary btn-sm btn-responsive" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="btn btn-primary btn-sm btn-responsive" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	</td>
	</tr>
	</table>
	</form>	
	
	

	</div>
	</div>
	<?php include("../../footer.php"); ?>
</body>
</html>