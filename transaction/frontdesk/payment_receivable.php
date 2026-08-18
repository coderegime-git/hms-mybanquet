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
	
	
	var fullDate = new Date();
	console.log(fullDate);
	var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
	var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
	$("#rcpt_date").val(currentDate);
	
	
	

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

function checkTaxCode(){
	taxCode=$('#tax_code').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatTaxCode.php',
			data:{
			taxCode:taxCode
			},
			success:function(data){
				  /* alert(data); */  
				if(data==1){
					alert('Tax Code already exists.');
					/* $('#msgFoprop').html('* Tax Code already exists.'); */
					$('#tax_code').val('');
				}
				else{
					$('#msgFoprop').html('');
				}
			}
	});
}

function checkTaxCodeDesc(){
	taxDesc=$('#description').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatTaxCodeDesc.php',
			data:{
			taxDesc:taxDesc
			},
			success:function(data){
				/*  alert(data); */ 
				if(data==1){
					alert('Tax Description already exists.');
					$('#description').val('');
				}
				else{
					$('#msgFoprop').html('');
				}
			}
	});
}

function getGUestName(){
	room_no=$('#room_no').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selectGuestName.php',
			data:{
			room_no:room_no
			},
			success:function(data){
				/*  alert(data); */  
				$('#guest_name').val(data);
			}
	});
}

function popupBillAdv()
{ 
curDt=$('#rcpt_date').val();
rtNo=$('#rcpt_no').val();
roomNo=$('#comp_code').val();
guNm=$('#comp_name').val();
amt=$('#amount').val();
rem=$('#remarks').val();
paMde=$('#pay_mode').val();
cheque_num=$('#cheque_num').val();
cheque_date=$('#cheque_date').val();
if(curDt!='' && rtNo!='' && roomNo!='' && guNm!='' && amt!='' && paMde!=''){
newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/print-room-advance.php?curDte='+curDt+'&rcptNo='+rtNo+'&roomNo='+roomNo+'&gustNme='+guNm+'&amt='+amt+'&payMde='+paMde+'&remks='+rem,"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=500');
newwindow.focus();
}

 
} 



function payMDeCheque(){
	paMde=$('#pay_mode').val(); 
 if(paMde=='cheque'){
	$('#cheque_num').removeAttr('disabled',true);
	$('#cheque_date').removeAttr('disabled',true);
 }else{
	 $('#cheque_num').attr('disabled','disabled');
	 $('#cheque_date').attr('disabled','disabled');
	 $('#cheque_num').val('');
	 $('#cheque_date').val('');
 }
	
}


function paymentRecvble(){
	$('#cheque_num').removeAttr('disabled',true);
	$('#cheque_date').removeAttr('disabled',true);
	if(!status){
		return false;
		}
		else
		{
			
		}
}


</script> 
<body class="bgBODY">
<div id="invoice" style="">

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
		
	<div id="addcustomer" class="frmCentr divBrd" style="width:468px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Payment Receivable</b></h3>
		<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_ar_receipts.php" method="post" class="" style="">
		<div>
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>
				<tr>
						<td width="" valign="top"><label>Date<em>*</em></label></td>
						<td valign="top"><input type="text" name="rcpt_date" id="rcpt_date" data-validation="required" class="input validate[required] datepicker1" value="" readonly />
						</td>
				</tr>
				<tr>
						<td width="" valign="top"><label>Receipt No<em>*</em></label></td>
						<td valign="top"><input type="text" name="rcpt_no" id="rcpt_no" data-validation="required" class="input validate[required]" value="<?php echo getCheckOutARReceipts(); ?>" readonly />
						</td>
				</tr>		
				<tr>
					<td width="" valign="top"><label>Vendor <em>*</em></label></td>
					<td valign="top">
					<?php $sqlBS=mysql_query("select distinct vendor_code,vendor_name from company_master where status='1'");?>
							<select name="vendor_code" id="vendor_code" style="width:148px;" data-validation="required" class="input validate[required]" onchange="selCompanyName();">
							<option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<option value="<?php echo $rowBS['vendor_code'];?>"><?php echo $rowBS['vendor_name'];?></option>
							<?php } ?>
							</select>
					</td>
				</tr>
				
				<tr>
						<td width="" valign="top"><label>Amount<em>*</em></label></td>
						<td valign="top"><input type="text" name="amount" id="amount" data-validation="required" class="input validate[required,custom[number]] fstChUPPRCase"/></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Pay Mode<em>*</em></label></td>
						<td valign="top">
						<select name="pay_mode" id="pay_mode" data-validation="required" class="input validate[required] fstChUPPRCase" style="width:148px" onchange="payMDeCheque();">
							<option value="">--Select--</option>
							<option value="cash">Cash</option>
							<option value="card">Card</option>
							<option value="cheque">Cheque</option>
							<option value="neft">NEFT</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="" valign="top"><label>CC / Cheque #<em>*</em></label></td>
						<td valign="top"><input type="text" name="cheque_num" id="cheque_num" class="fstChUPPRCase" disabled /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Cheque Date<em>*</em></label></td>
						<td valign="top"><input type="text" name="cheque_date" id="cheque_date" class="fstChUPPRCase datepicker" disabled /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Remarks<em>*</em></label></td>
						<td valign="top"><input type="text" name="remarks" id="remarks" class="fstChUPPRCase" onblur="checkTaxCodeDesc();"/></td>
					</tr>
					</tbody>
				</table>
			</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 1px;">
		<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return paymentRecvble();"><img src="<?php echo $home_path;  ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
				
		<a href="view_payment_rcvbl.php"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="buttExam_sngl" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	</td>
	</tr>
	</table>
	</form>	
	
	

	</div>
	</div>
</body>
</html>