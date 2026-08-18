<?php
ob_start();
include("../includes/header.php");
include("../util.php");
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
	jQuery("#quotationmaster").validationEngine();
	
    var myCalendar;
	myCalendar = new dhtmlXCalendarObject(["calendar","calendar2","calendar3"]);
	myCalendar.setDateFormat("%d-%m-%Y");
	
	
	var fullDate = new Date();
		console.log(fullDate);
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
		$(".vendInvdate").val(currentDate);
		
	$('input[name^=tax]').live('keyup', function() {
		tax=($("#tax").val()); 
		rate=parseFloat($("#rate").val()); 
		qtyAccp=parseFloat($("#qty_accepted").val()); 
	
		/* if(tax != null && tax != ''){ */
		if(tax !=''){
			amntT=parseFloat(qtyAccp*rate);
			amnt=parseFloat((qtyAccp*rate)+parseFloat(tax));
			$("#amount").val(amntT.toFixed(2));
			$("#amount_payable").val(amnt.toFixed(2));
		}
		if(tax ==''){
			amnt=parseFloat((qtyAccp*rate));
			$("#amount").val(amnt.toFixed(2));
			$("#amount_payable").val(amnt.toFixed(2));
		}
		
		TotAmt=$("#amount").val();
		if(TotAmt=="NaN"){$("#amount").val('0.00');}
		TotAmtPy=$("#amount_payable").val();
		if(TotAmtPy=="NaN"){$("#amount_payable").val('0.00');}
	});
	
	
	$('input[name^=rfq_no]').live('blur', function() {
		propCode=$("#prop_code").val(); 
		qtRfqNo=$("#rfq_no").val(); 
		var fullDate = new Date();
		console.log(fullDate);
		//Thu May 19 2011 17:25:38 GMT+1000 {}

		//convert month to 2 digits
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);

		/* var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear(); */
		var currentDate = fullDate.getDate() + twoDigitMonth + fullDate.getFullYear();
		/* alert(currentDate); */
		curDTE=propCode+'-'+currentDate+'-'+qtRfqNo;
		qtRfqNo=$("#quote_number").val(curDTE);
	});
	
	
	$("#qty_accepted").keyup(function(){
		var ordQ=parseFloat($("#order_qty").val());
		var qtyA=parseFloat($("#qty_accepted").val());
		var qtyR=parseFloat($("#qty_rework").val());
		var qtyRe=parseFloat($("#qty_reject").val());
		
		tax=($("#tax").val()); 
		rate=parseFloat($("#rate").val()); 
		qtyAccp=parseFloat($("#qty_accepted").val()); 
	
		/* if(tax != null && tax != ''){ */
		if(tax !=''){
			amntT=parseFloat(qtyAccp*rate);
			amnt=parseFloat((qtyAccp*rate)+parseFloat(tax));
			$("#amount").val(amntT.toFixed(2));
			$("#amount_payable").val(amnt.toFixed(2));
		}
		if(tax ==''){
			amnt=parseFloat((qtyAccp*rate));
			$("#amount").val(amnt.toFixed(2));
			$("#amount_payable").val(amnt.toFixed(2));
		}
		
		TotAmt=$("#amount").val();
		if(TotAmt=="NaN"){$("#amount").val('0.00');}
		TotAmtPy=$("#amount_payable").val();
		if(TotAmtPy=="NaN"){$("#amount_payable").val('0.00');}
		
		
		if(ordQ!=qtyA){
			$("#qtyRew").show();
			$("#qtyRej").show();
		}else{
			$("#qtyRew").hide();
			$("#qtyRej").hide();
		}
		var totQ=parseFloat(qtyA+qtyR+qtyRe);
		/* var totQ=parseFloat(qtyAa+qtyRr+qtyRee); */
		var BaQy=ordQ-totQ;
		$("#bal_qty").val(BaQy);
		
		balQty=$("#bal_qty").val();
		if(balQty=="NaN"){$("#bal_qty").val('0.00');}
	}); 
	$("#qty_rework").keyup(function(){
		var ordQ=($("#order_qty").val());
		var qtyA=($("#qty_accepted").val());
		var qtyR=($("#qty_rework").val());
		var qtyRe=$("#qty_reject").val();
		
		if(qtyA!='' && qtyR!='' && qtyRe!=''){
			var totQ=parseFloat(parseFloat(qtyA)+parseFloat(qtyR)+parseFloat(qtyRe));
		}else if(qtyA!='' && qtyR!=''){
			var totQ=parseFloat(parseFloat(qtyA)+parseFloat(qtyR));
		}else if(qtyA!='' && qtyRe!=''){
			var totQ=parseFloat(parseFloat(qtyA)+parseFloat(qtyRe));
		}else{
			var totQ=parseFloat(parseFloat(qtyA));
		}
		var BaQy=ordQ-totQ;
		$("#bal_qty").val(BaQy);
		
		balQty=$("#bal_qty").val();
		if(balQty=="NaN"){$("#bal_qty").val('0.00');}
	});
	$("#qty_reject").keyup(function(){
		var ordQ=($("#order_qty").val());
		var qtyA=($("#qty_accepted").val());
		var qtyR=($("#qty_rework").val());
		var qtyRe=($("#qty_reject").val());
		if(qtyRe!=""){
			$("#qtyRejRw").show();
		}
		if(qtyRe=="" || qtyRe=='0'){
			$("#qtyRejRw").hide();
		}
		if(qtyRe!=""){
		var totQ=parseFloat(parseFloat(qtyA)+parseFloat(qtyR)+parseFloat(qtyRe));
		}else{
			var totQ=parseFloat(parseFloat(qtyA)+parseFloat(qtyR));
		}
		var BaQy=ordQ-totQ;
		$("#bal_qty").val(BaQy);
		
		balQty=$("#bal_qty").val();
		if(balQty=="NaN"){$("#bal_qty").val('0.00');}
	});
	
	
	var fullDate = new Date();
		console.log(fullDate);
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
		$("#cur_date").val(currentDate);
	
});


function selRFQnumber()	{
	rfqNO=$("#rfq_no").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selVenDRfqNo.php',
			data:{
			rfqNO:rfqNO
			},
			success:function(data){
				 /*  alert(data);  */
				  Qte=data.split(',');
				  $("#purorder_no").val(Qte[0]);
				  $("#part_no").val(Qte[1]);
				  $("#part_name").val(Qte[2]);
				  $("#amount").val(Qte[3]);
				  $("#amount_payable").val(Qte[3]);
				  $("#qty_accepted").val(Qte[4]);
				  $("#rate").val(Qte[5]);
				  $(".venInvDt").val(Qte[6]);
				  $("#order_qty").val(Qte[4]);
				  
			}
	});
}
		
/* function calcQtyACCe() {
	qtyAcc=parseFloat($("#qty_accepted").val());
	rate=parseFloat($("#rate").val());
	amTpAayab=qtyAcc*rate;
	amount_payable=parseFloat($("#amount_payable").val(amTpAayab));

	ordQty=parseFloat($("#order_qty").val());
	qtyAccp=parseFloat($("#qty_accepted").val());
	qtyRewk=parseFloat($("#qty_rework").val());
	qtyRejct=parseFloat($("#qty_reject").val());
	
	totQty=parseFloat(qtyAccp+qtyRewk+qtyRejct);
		
	if(qtyAccp>ordQty){
		r=confirm("Qty greater than accepted. Do you want to continue?");
		if(r==true){
			
		}else{
			$("#qty_accepted").val('')
		}
	} 
}

function qtyReject(){
	ordQty=parseFloat($("#order_qty").val());
	qtyAccp=parseFloat($("#qty_accepted").val());
	qtyRewk=parseFloat($("#qty_rework").val());
	qtyRejct=parseFloat($("#qty_reject").val());
	
	totQty=parseFloat(qtyAccp+qtyRewk+qtyRejct);
	if(totQty>ordQty) {
		r=confirm("Qty greater than accepted. Do you want to continue?");
		if(r==true){
			
		}else{
			$("#qty_accepted").val('');
			$("#qty_rework").val('');
			$("#qty_reject").val('');
		}
	}
} */

function selVENdorInv(){
	vendName=$("#vendor_name").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selVenRFQfrmName.php',
			data:{
			vendName:vendName
			},
			success:function(data){
				 /* alert(data); */  
				 $("#rfq_no").html(data);
			}
	});
}

function checkVendorINvRcpt(){
	var ordQty=($("#order_qty").val());
	var qtyAccp=($("#qty_accepted").val());
	var qtyRewk=($("#qty_rework").val());
	var qtyRejct=($("#qty_reject").val());
	var reaRwork=($("#reason_rework").val());
	var status = true;	
	
	if(qtyAccp!='' && qtyRewk!='' && qtyRejct!=''){
		var totQty=parseFloat(parseFloat(qtyAccp)+parseFloat(qtyRewk)+parseFloat(qtyRejct));
	}else if(qtyAccp!='' && qtyRewk!=''){
		var totQty=parseFloat(parseFloat(qtyAccp)+parseFloat(qtyRewk));
	}else if(qtyAccp!='' && qtyRejct!=''){
		var totQty=parseFloat(parseFloat(qtyAccp)+parseFloat(qtyRejct));
	}else{
		var totQty=parseFloat(parseFloat(qtyAccp));
	}
	
		
	if(totQty != parseFloat(ordQty)){
		alert('Entered qty is not equal to total quantity');
		status = false;
	}else{
		status = true;	
	}
	
	if(qtyRejct!="" && reaRwork=="") {
		alert('Please enter rework');
		status = false;	
	}
	if(!status){
		return false;
		}
		else
		{
			
		}
}
</script> 

<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/codebase-datepicker/dhtmlxcalendar.css"/>
<script src="<?php echo $home_path; ?>/codebase-datepicker/dhtmlxcalendar.js"></script>
	<style>
		#calendar,
		#calendar2,
		#calendar3 {
			border: 1px solid #909090;
			font-family: Tahoma;
			font-size: 12px;
		 	background: #fff url("../images/date-icon.png") no-repeat scroll 95.5% 45%;
    cursor: pointer; 
		}
	</style>
	
<body class="bgBODY">
<div class="about">
<div class="col-md-12">
	<div id="invoice" style="border:1px solid #ddd;margin:0 auto;">
 <?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo"class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<p style="text-align:center;">
		<span id="msgFoprop" class="msgNotifyprop"></span>
</p>		
<h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Vendor Invoice Receipt</b></h3>
<div class="" style="border-right:1px solid #ddd;">
<?php 
	$sql=mysql_query("select * from vendor_invoicercpt where vendor_invrcpt_id='".$_GET['uid']."'");
	$x=0;
	$row=mysql_fetch_array($sql);
		$x++;
	?>
<form id="quotationmaster" name="quotationmaster" action="<?php echo $home_path;?>/action/update_vendor_invrcpt.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="vendor_invrcpt_id" id="vendor_invrcpt_id" type="hidden" data-validation="required" value="<?php echo $row['vendor_invrcpt_id']?>" />
<div>
	<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			<tr>
				<td width="180" >RFQ No:</td>
				<td>
					<input name="rfq_no" id="rfq_no" type="text" data-validation="required" class="input validate[required] textbox" onblur="selRFQnumber();" value="<?php echo $row['rfq_no']?>"/>
				</td>
			</tr>
			<tr>
				<td width="180" >PO No :</td>
				<td><input name="purorder_no" id="purorder_no" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['purorder_no']?>"/></td>
			</tr>
			<?php 
			$sqlVN=mysql_query("select vendor_name from vendor_master where vendor_code='".$row['vendor_name']."'");
			$rowVN=mysql_fetch_array($sqlVN);
			?>
		<tr>
			<td width="180" >Vendor Name * :</td>
			<td>
			<input name="vendor_name" id="vendor_name" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $rowVN['vendor_name']?>"/>
			
			<!--<select name="vendor_name" id="vendor_name" style="width:179px;font-size:14px;" onChange="selVENdorInv();">
			<option value="">--Select--</option>
			</select>-->
			</td>
		</tr>	
			<tr>
				<td width="180" >Vendor Invoice No:</td>
				<td>
				<!--<input name="vendor_invno" id="vendor_invno" type="text" data-validation="required" class="input validate[required] textbox" value="<?php /* echo getNextVEndorInvoiceNumber(); */ ?>" />-->
				<input name="vendor_invno" id="vendor_invno" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['vendor_invno']?>" />
				</td>
			</tr>
			<tr>
					<td width="180" >Vendor Invoice Date :</td>
					<td >
					<input name="vendor_invdate" id="calendar" type="text" data-validation="required" class="input validate[required] textbox venInvDt" onblur="checkitemcode()" value="<?php echo $row['vendor_invdate']?>"/>
					</td>
			</tr>
			<tr>
				<td width="180" >Ordered Qty :</td>
				<td ><input name="order_qty" id="order_qty" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['order_qty']?>"/></td>
			</tr>
			<tr>
				<td width="180" >Qty Accepted:</td>
				<td>
					<input name="qty_accepted" id="qty_accepted" type="text" data-validation="required" class="input validate[required] textbox" onblur="calcQtyACCe();" value="<?php echo $row['qty_accepted']?>" style="width:90px;"/><input name="bal_qty" id="bal_qty" type="text" class="textbox " value="<?php echo $row['bal_qty']?>" style="width:89px;" placeholder="Balance qty" readonly />
				</td>
			</tr>
			
			<?php/*  if($row['qty_rework']!="") { */ ?>
			<tr id="qtyRew" style="display:none;">
				<td width="180" >Qty Rework:</td>
				<td><input name="qty_rework" id="qty_rework" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['qty_rework']?>"/></td>
			</tr>
			<?php /* } */ ?>
			<?php /* if($row['qty_reject']!="") { */ ?>
			<tr id="qtyRej" style="display:none;">
				<td width="180" >Qty Rejected:</td>
				<td>
					<input name="qty_reject" id="qty_reject" type="text" data-validation="required" class="input validate[required] textbox" onblur="qtyReject()"value="<?php echo $row['qty_reject']?>"/>
				</td>
			</tr>
			<?php /* } */ ?>
			<?php /* if($row['reason_rework']!="") { */ ?>
			<tr id="qtyRejRw" style="display:none;">
				<td width="180" >Reason for Rework/Reject :</td>
				<td><input name="reason_rework" id="reason_rework" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['reason_rework']?>"/></td>
			</tr>
			<?php /* } */ ?>
		</table>
	
		<table style="width:50%;border-left:1px solid #ddd;" class="table">
			<tr>
				<td width="180" >Part Name :</td>
				<td ><input name="part_name" id="part_name" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['part_name']?>"/></td>
			</tr>
			<tr>
				<td width="180" >Part No:</td>
				<td ><input name="part_no" id="part_no" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['part_no']?>"/></td>
			</tr>
			
			<tr>
				<td width="180" >Rate:</td>
				<td ><input name="rate" id="rate" type="text" data-validation="required" class="input validate[required,custom[number]] textbox fstChUPPRCase" value="<?php echo $row['rate']?>"/></td>
			</tr>
			<tr>
				<td width="180" >Tax Amount:</td>
				<td ><input name="tax" id="tax" type="text" class="textbox" placeholder="0.00"/></td>
			</tr>
			<tr>
				<td width="180" >Amount:</td>
				<td ><input name="amount" id="amount" type="text" data-validation="required" class="input validate[required,custom[number]] textbox" value="<?php echo $row['amount']?>" readonly /></td>
			</tr>
			<tr>
				<td width="180" >Amount Payable:</td>
				<td ><input name="amount_payable" id="amount_payable" type="text" data-validation="required" class="input validate[required,custom[number]] textbox" value="<?php echo $row['amount_payable']?>"/></td>
			</tr>
			<tr>
				<td width="180" >Vendor DC. No. :</td>
				<td ><input name="vendor_dlno" id="vendor_dlno" type="text" class="textbox codesUPPERCase" value="<?php echo $row['vendor_dlno']?>"/></td>
			</tr>
			<tr>
				<td width="180" >Vendor DC. Date :</td>
				<td>
					<input name="vendor_dldate" id="calendar2" type="text" class="textbox codesUPPERCase vendInvdate" value="<?php echo $row['vendor_dldate']?>"/>
				</td>
			</tr>
			
		</table>
	</div>
	</div>




<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>
<div style="margin:10px 0 10px 194px;">
	<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkVendorINvRcpt();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
		
		<a href="view-vendorinvrecpt.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
		
		<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button></a>
	</div>
		</td>
	</tr>
</table>


</form>		
	</div>
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
				scrollSpeed: 1800,
				easingType: 'linear' 
			};
			
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
		 <a href="#" id="toTop" style="display: none;"><span id="toTopHover" style="opacity: 1;"></span></a>

	 <script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap-3.1.1.min.js"></script>

</body>
</html>