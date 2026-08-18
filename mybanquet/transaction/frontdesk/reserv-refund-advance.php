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
	
}else{
	$('#card_desc').attr('disabled',true);	
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

function refAmt() {
refA=$('#ref_amt').val();

	
	
} 

function retUnAmt() {
retA=$('#ret_amt').val();
	
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
</style>
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');

$sqlR=mysql_query("select * from bq_hallresvadv where receipt_no='".$_GET['roomBk']."' group by receipt_no order by receipt_no ASC");	
$rowR=mysql_fetch_array($sqlR);


?>			
	<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:468px;">
	<h3 id="Userhd"><b>Reservation Advance Refund</b></h3>
		<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_resv_adv_refund.php" method="post" class="" style="">
		<div>
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>
				<tr>
						<td width="" valign="top"><label>Date<em>*</em></label></td>
						<td valign="top"><input type="text" name="cur_date" id="cur_date" data-validation="required" class="textbox input validate[required]" value="<?php echo $rowAC['cur_date'];?>" readonly />
						</td>
				</tr>
				<tr>
						<td width="" valign="top"><label>Booking No<em>*</em></label></td>
						<td valign="top"><input type="text" name="book_no" id="book_no" data-validation="required" class="textbox input validate[required]" value="<?php echo $rowR['booking_no']; ?>" readonly />
						</td>
				</tr>
				<tr>
						<td width="" valign="top"><label>Receipt No<em>*</em></label></td>
						<td valign="top"><input type="text" name="receipt_no" id="receipt_no" data-validation="required" class="textbox input validate[required]" value="<?php echo $rowR['receipt_no']; ?>" readonly />
						</td>
				</tr>		
				
				<tr>
					<td width="" valign="top"><label>Guest Name <em>*</em></label></td>
					<td valign="top"><input type="text" name="guest_name" id="guest_name" data-validation="required" class="textbox input validate[required]" value="<?php echo $rowR['guest_name'];?>" readonly /></td>
				</tr>
					<tr>
						<td width="" valign="top"><label>Amount<em>*</em></label></td>
						<td valign="top"><input type="text" name="amount" id="amount" value="<?php echo $_GET['rmAmt'];?>"  class="textbox fstChUPPRCase" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Refund Amount<em>*</em></label></td>
						<td valign="top"><input type="text" name="ref_amt" id="ref_amt" class="textbox fstChUPPRCase" onkeyup="refAmt();" /></td>
						
					</tr>
						<tr>
						<td width="" valign="top"><label>Retention<em>*</em></label></td>
						<td valign="top"><input type="text" name="ret_amt" id="ret_amt" class="textbox fstChUPPRCase" onkeyup="retUnAmt();" /></td>
						
					</tr>
					<?php 
					$sqlPr=mysql_query("select * from property_definition where propdef_id='1'");
					$rowPr=mysql_fetch_array($sqlPr);
					?>
					<tr>
							<td width="" valign="top"><label>Pay Mode <em>*</em></label></td>
							<td valign="top">
							<?php $sqlPm=mysql_query("select distinct payment_mode from payment_mode where payment_mode!='COMPANY'");?>
							<select name="pay_mode" id="pay_mode" data-validation="required" class="input validate[required] fstChUPPRCase textbox form-control" style="" onchange="pyMode();">
							<option value="">--Select--</option>
							<?php while($rowPm=mysql_fetch_array($sqlPm)) { ?>
							<?php if($rowPr['pay_mode']==$rowPm['payment_mode']) { ?>
							<option value="<?php echo $rowPm['payment_mode'];?>" selected ><?php echo $rowPm['payment_mode'];?></option>
							<?php }else{?>
							<option value="<?php echo $rowPm['payment_mode'];?>"><?php echo $rowPm['payment_mode'];?></option>
							<?php } } ?>
							</select>
							</td>
						
						</tr>
					<tr>
							<td width="" valign="top"><label>Card Type<em>*</em></label></td>
							<td valign="top">
							<select name="card_desc" id="card_desc" style="border:1px solid #ddd;" class="inptSt textbox form-control" disabled >
							<option value="">--Select--</option>
							<?php 
							$sqlF=mysql_query("select * from company_master where classf='creditcard'");
							while($rowF=mysql_fetch_array($sqlF)) {	?>
							<option value="<?php echo $rowF['comp_name']; ?>"><?php echo $rowF['comp_name']; ?></option>
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
						<td width="" valign="top"><label>Remarks<em>*</em></label></td>
						<td valign="top"><input type="text" name="remarks" id="remarks" class="textbox fstChUPPRCase" /></td>
					</tr>
					</tbody>
				</table>
			</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 0px;">
		<button type="button" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return resvAdvSubmit();" ><img src="<?php echo $home_path;  ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
				
		<a href="view-resADVRefund.php"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="buttExam_sngl" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
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