<?php
ob_start();
include("../includes/header.php");
/* include("config.php"); */
 ?>
 <!--form validation-->	
<link rel="stylesheet" href="../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#vendormaster").validationEngine();
});

function selEBSInvNo() {
	ebs_invno=$('#ebsinv_no').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selPaymentReceipt.php',
			data:{
			ebs_invno:ebs_invno
			},
			success:function(data){
				 /* alert(data); */
				Qte=data.split(',');
				$("#inv_date").val(Qte[0]);
				$("#inv_amount").val(Qte[1]);
			}
	});
}


function selDisabl(){
	payType=$("#payment_type").val();
	payAmount=$("#payment_amount").val();
	if(payType=='CHECK'){
		$("#payment_details").prop('disabled',false);
	}else if (payType=='CREDIT CARD'){
		$("#payment_details").prop('disabled',false);
	}else {
		$("#payment_details").prop('disabled',true);
	}
	
	ebs_invno=$('#ebsinv_no').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selCalcPayment.php',
			data:{
			ebs_invno:ebs_invno,
			payAmount:payAmount,
			},
			success:function(data){
				 alert(data); 
				Qte=data.split(',');
				$("#inv_date").val(Qte[0]);
				$("#inv_amount").val(Qte[1]);
			}
	});
}

function frmValid() {
	newPRTno=$('#new_partno').val(); 
	newPRTno=$('#payment_details').prop("disabled", false);
	var status = true;	
	/* if (newPRTno!='') {
		r=confirm("do u want to add new part no.");
		if(r==true){
			  status = true;
		}else{
			
			status = false;
		}
		
	} */
	if(!status){
		return false;
		}
		else
		{
			/* $("#reg-submit").val("Processing.."); */
		}
}

</script> 
<body class="bgBODY">
<div class="about">
<div id="invoice" style="border:1px solid #ddd;margin:0 auto;">
	<!--<div class="container">-->
		<div class="col-md-12" >
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<p style="text-align:center;">
	<span id="msgFoprop" class="msgNotifyprop"></span>
</p>
		<h3 style="text-align:center;width:97%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Payment Receipt</b></h3>
		<div id="addcustomer" style="border:1px solid #ddd;width:910px;">
		<form id="vendormaster" name="vendormaster" action="<?php echo $home_path;?>/action/add_payment_receipt.php" method="post" class="" style="margin: 0 0 12px 0;">
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" class="table" border="0" >
		<tbody>
			<tr>
				<td width="125" valign="top"><label>EBS Invoice No:</label></td>
				<td valign="top"><input name="ebsinv_no" id="ebsinv_no" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="selEBSInvNo();" />
				</td>
									
			</tr>
			<tr>
				<td width="145" valign="top"><label>Date :</label></td>
				<td valign="top"><input name="inv_date" id="inv_date" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" /></td>
			</tr>
			<tr>
				<td width="150" valign="top"><label>Invoice Amount:</label></td>
				<td valign="top"><input name="inv_amount" id="inv_amount" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" onblur="checkitemcode()"/></td>
			</tr>
			
			</tbody>
		</table>
		<table style="width:50%;" class="table">
			<tbody>
			
			<tr>
				<td width="150" valign="top"><label>Payment Amount:</label></td>
				<td valign="top"><input name="payment_amount" id="payment_amount" type="text" class="textbox fstChUPPRCase" onblur="checkitemcode()"/></td>
			</tr>
			<tr>
				<td width="145" valign="top"><label>Payment Type :</label></td>
				<td valign="top">
				<select class="ddpayment"  name="payment_type" id="payment_type" onchange="selDisabl();">
				<option value="">  --Select-- </option>
				<option value="CASH">  CASH </option>
				<option value="CHECK">  CHECK </option>
				<option value="CREDIT CARD">  CREDIT CARD </option>
				</select>
				</td>
			</tr>
			<tr>
				<td width="150" valign="top"><label>Payment Details:</label></td>
				<td valign="top">
				<textarea name="payment_details" id="payment_details" type="text" class="textbox fstChUPPRCase" style="height:50px;" disabled /></textarea>
				</td>
			</tr>
						
		</tbody>
	</table>
	</div>
<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>
	<div style="margin:10px 0 0 112px;">
		<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onClick="return frmValid();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
			
			<a href="view-payment-receipt.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
			
			<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
			
			<button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" onClick="self.close();" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button>
			
		</div>
		</td>
	</tr>
</table>
	</form>		
			
		</div>
	</div>
	</div>
	<div class="banner-bottom" style="margin:15px 0 0 0;">
		<div class="container">
			<script src="<?php echo $home_path; ?>/js/jquery.wmuSlider.js"></script> 
				<script>
					$('.example1').wmuSlider();         
				</script> 
		</div>
	</div>
		<!-- scroll_top_btn -->
	<script type="text/javascript" src="<?php echo $home_path; ?>/js/move-top.js"></script>
	<script type="text/javascript" src="<?php echo $home_path; ?>/js/easing.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
		 <a href="#" id="toTop" style="display: none;"><span id="toTopHover" style="opacity: 1;"></span></a>

	 <script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap-3.1.1.min.js"></script>

</body>
</html>