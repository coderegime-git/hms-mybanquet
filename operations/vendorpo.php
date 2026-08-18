<?php
ob_start();
include("../includes/header.php");
include("../util.php");
?>
<style>
.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;position: absolute;z-index: 1;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}
</style>
<!--form validation-->	
<link rel="stylesheet" href="../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	jQuery("#vendorPO").validationEngine();
	$("#rfq_no").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../action/selectVENDORpoRFQ.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			/* alert(data); */ 
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
		
	var myCalendar;
	myCalendar = new dhtmlXCalendarObject(["calendar","calendar2","calendar3"]);
	myCalendar.setDateFormat("%d-%m-%Y");
	
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	
	
	$('input[name^=quote_rate]').live('keyup', function() {
		qty=parseFloat($("#qty").val()); 
		qtRate=parseFloat($("#quote_rate").val()); 
		qtAmt=parseFloat(qty*qtRate);
		$("#quote_amt").val(qtAmt.toFixed(2));
		qtTotAmt=$("#quote_amt").val();
		if(qtTotAmt=="NaN"){$("#quote_amt").val('0.00');}
	});
	
	$('input[name^=qty]').live('keyup', function() {
		qty=parseFloat($("#qty").val()); 
		rate=parseFloat($("#rate").val()); 
		quote_qty=parseFloat($("#quote_qty").val()); 
		bal_qty=parseFloat($("#bal_qty").val()); 
		/* if(bal_qty!='0'){ */
			balnceQty=quote_qty-qty;	
			$("#bal_qty").val(balnceQty);
		/* } */
		vnAmt=parseFloat(qty*rate);
		$("#total_amount").val(vnAmt.toFixed(2));
		balQty=$("#bal_qty").val(); 
		if(balQty=="NaN"){$("#bal_qty").val('0.00');}
		totalaT=$("#total_amount").val(); 
		if(totalaT=="NaN"){$("#total_amount").val('0.00');}
		
	});
	
	var fullDate = new Date();
		console.log(fullDate);
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
		$(".curdate").val(currentDate);
	
});

function selectRFQVn(val) {
$("#rfq_no").val(val);
$("#suggesstion-box").hide();
}

function selRFQNoDet(){
	rfqNO=$("#rfq_no").val();
	qty=$("#qty").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selRFQVEndorDet.php',
			data:{
			rfqNO:rfqNO,
			qty:qty
			},
			success:function(data){
				     /* alert(data); */ 
				  qte=data.split('@');
				  
				  $('#quote_qty').val(qte[0]);
				  $('#totQty').val(qte[0]);
				  $('#unit_issue').val(qte[1]);
				  $('#rate').val(qte[2]);
				   $('.reqDD').val(qte[6]); 
				  $('#part_no').val(qte[3]);
				  $('#part_name').val(qte[4]);
				  $('#total_amount').val(qte[5]);
				 /*  $('#custreq_deldate').val(qte[6]); */
				  $('#qty').val(qte[7]);
				  $('#vendor_name').html(qte[8]);
				  
							qty=parseFloat($("#qty").val()); 
							quote_qty=parseFloat($("#quote_qty").val()); 
							bal_qty=parseFloat($("#bal_qty").val()); 
							if(bal_qty!='0'){
								balnceQty=quote_qty-qty;	
								$("#bal_qty").val(balnceQty);
							}
							
					if(data==1){
						alert('Please check Vendor allocation.');
						$('#quote_qty').val('');
						$('#vendor_name').html('');
					}
					
					balQY=$('#bal_qty').val();
					if(balQY=="NaN"){$("#bal_qty").val('');}
				 
			}
	});
	
}
		
function selVENdorPO(){
	venNO=$("#vendor_name").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selVEndorADDressDet.php',
			data:{
			venNO:venNO
			},
			success:function(data){
				  /* alert(data); */  
				  qte=data.split('@');
				  $('#vend_add1').val(qte[0]);
				  $('#vend_add2').val(qte[1]);
				  $('#vend_city').val(qte[2]);
				  $('#vend_pincode').val(qte[3]);
				  
				 }
	});
}
	
function selectTypepo()	{
	typPo=$("#typo_po").val();
	po_no=$("#po_no").val();
	if(typPo=='purchase order'){
		$("#purPono").show();
		$("#jobPono").hide();
		$("#prefix").val('P');
	/* val='P';
		conCt=val+po_no;
		$("#po_no").val(conCt); */
	}
	if(typPo=='job order'){
		$("#purPono").hide();
		$("#jobPono").show();
		$("#prefix1").val('J');
		/* vall='J';
		conCt=vall+po_no;
		$("#po_no").val(conCt); */
	}
	
}


function checkVendorPO(){
		qty=parseFloat($("#qty").val()); 
		quote_qty=parseFloat($("#quote_qty").val()); 
		bal_qty=parseFloat($("#bal_qty").val()); 
		subAdd=$("#add").val(); 
		reqDD=parseFloat($(".reqDD").val()); 
		custDeldate=parseFloat($("#custreq_deldate").val()); 
		
	var status = true;	

	if(qty>quote_qty){
		alert('Exceed the total quantity.');
		status = false;
		
	}else {
		
	}
	
	if(subAdd=='submit'){
		r=confirm("Do you want to send PO now");
		if(r==true){
			nwlt="now";
			$("#nowLat").val(nwlt);
			/* status = false; */
			$("#vendorPO").attr("action","<?php echo $home_path;?>/action/add_vendor.php");
		}else{
			nwlt="later";
			$("#nowLat").val(nwlt);
			$("#vendorPO").attr("action","<?php echo $home_path;?>/action/add_vendor.php");
			/* status = false; */
		}
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
	<!--<div id="invoice" style="border:1px solid #ddd;margin:0 0 0 12px;">-->
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
			<h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Vendor Purchase Order</b></h3>
			
<div class="" style="border-right:1px solid #ddd;">
<!--<form id="vendorPO" name="vendorPO" action="<?php /* echo $home_path; */?>/action/add_vendor.php" method="post" class="" style="margin: 0 0 12px 0;">-->
<form id="vendorPO" name="vendorPO" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="" style="margin: 0 0 12px 0;">
<input name="totQty" id="totQty" type="hidden"/>
<input name="nowLat" id="nowLat" type="hidden"/>
<div>
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			<tr>
				<td width="180" >RFQ No:</td>
				<td>
				<input name="rfq_no" id="rfq_no" type="text" data-validation="required" class="input validate[required] textbox" onclick="selRFQNoDet();"/>
				<div id="suggesstion-box"></div>
				</td>
			</tr>
			<tr>
				<td width="180" >Type (PO of JO):</td>
				<td>
					<select class="drop-down fstChUPPRCase" name="typo_po" id="typo_po" onchange="selectTypepo();">
						<option value="">--Select--</option>
						<option value="purchase order">Purchase Order</option>
						<option value="job order">Job Order</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="180" >Date:</td>
				<td>
					<input name="cur_date" id="calendar2" type="text" data-validation="required" class="input validate[required] textbox curdate"/>
				</td>
			</tr>
			
			<tr>
					<td width="180" >Vendor Name * :</td>
					<td>
					<select name="vendor_name" id="vendor_name" style="font-size:14px;" onChange="selVENdorPO();">
					<option value="">--Select--</option>
					</select>

					<!--<input name="vendor_no" id="vendor_no" type="text" data-validation="required" class="input validate[required] textbox" onblur="checkitemcode()"/>-->
					</td>
			</tr>
			<tr>
				<td width="180" >Vendor Address1 :</td>
				<td ><input name="vend_add1" id="vend_add1" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Vendor Address2 :</td>
				<td ><input name="vend_add2" id="vend_add2" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >City :</td>
				<td ><input name="vend_city" id="vend_city" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Pincode :</td>
				<td ><input name="vend_pincode" id="vend_pincode" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
	<td width="180" >Unit of Issue (U/I):</td>
	<td >
		<select name="unit_issue" id="unit_issue" style="" onChange="selPartNo();">
			<option value="">--Select--</option>
			<?php
			$sqle="select uoi_code from unitof_issue";
			$rowe=mysql_query($sqle);
			while($resulte=mysql_fetch_array($rowe)) { 
			?>
			<option value="<?php echo $resulte['uoi_code'];  ?>"><?php  echo $resulte['uoi_code']; ?></option>
			<?php  }  ?>
		</select>
	</td>
</tr>
			
			
			
			
			
			
		</table>
		</div>
	
		<table style="width:50%;border-left:1px solid #ddd;" class="table">
		
		<tr id="purPono" style="display:none;">
				<td width="180" >PO No :</td>
				<td><input name="prefixpo" id="prefix" type="text" class="textbox" value="" style="width:30px;"/>&nbsp;<input name="po_no" id="po_no" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo getNextVENdorPONumberPUROrd(); ?>" style="width:150px;"/></td>
		</tr>
		<tr id="jobPono" style="display:none;">
				<td width="180" >PO No :</td>
				<td><input name="prefixjo" id="prefix1" type="text" class="textbox" value="" style="width:30px;"/>&nbsp;<input name="jo_no" id="po_no" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo getNextVENdorPONumberJOBOrd(); ?>" style="width:150px;"/></td>
		</tr>
		
			<tr>
				<td width="180" >Qty:</td>
				<td><input name="qty" id="qty" type="text" data-validation="required" value=""class="input validate[required] textbox" style="width:60px;"/>&nbsp;<input name="quote_qty" id="quote_qty" type="text" class="textbox" value="" style="width:60px;"/>&nbsp;<input name="bal_qty" id="bal_qty" type="text" data-validation="required" class="input validate[required] textbox" style="width:60px;"/></td>
			</tr>

<tr>
				<td width="180" >Currency :</td>
				<td>
					<select class="drop-down fstChUPPRCase" name="currency" id="currency">
						<option value="">--Select--</option>
						<?php
						$sqlC=mysql_query("select * from currency_master where currency_default='1'");
						$rowC=mysql_fetch_array($sqlC);
						
						$sqlba="select * from currency_master";
						$rowba=mysql_query($sqlba);
						while($resultba=mysql_fetch_array($rowba)) {
								if($resultba['currency_default']==$rowC['currency_default']){
																
						?>
						<option value="<?php echo $resultba['currency_code'];?>" selected><?php echo $resultba['currency_code'];?></option>
									<?php }else{?>
						<option value="<?php echo $resultba['currency_code'];?>"><?php echo $resultba['currency_code'];?></option>
						<?php }} ?>		
					</select>
				</td>
			</tr>
			
			<tr>
				<td width="180" >Rate :</td>
				<td ><input name="rate" id="rate" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" readonly /></td>
			</tr>
			
			<tr>
				<td width="180" >Customer RDD :</td>
				<td>
					<input name="custreq_deldate" id="calendar3" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase reqDD"/>
				</td>
			</tr>
			<tr>
				<td width="180" >RDD :</td>
				<td>
					<input name="req_deldate" id="calendar" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase reqDD"/>
				</td>
			</tr>
			
			
			<tr>
				<td width="180" >Part No:</td>
				<td ><input name="part_no" id="part_no" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Part Name:</td>
				<td ><input name="part_name" id="part_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase"/></td>
			</tr>
			<!--<tr>
				<td width="180" >Nomen/Part Name:</td>
				<td ><input name="quote_rate" id="quote_rate" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox"/></td>
			</tr>-->
			<tr>
				<td width="180" >Total amount *:</td>
				<td ><input name="total_amount" id="total_amount" type="text" data-validation="required" class="input validate[required,custom[number]] textbox"  onblur="checkitemcode()"/></td>
			</tr>
			<!--<tr>
				<td width="180" >Print PO/Send email :</td>
				<td><input name="print_po" id="print_po" type="text" class="textbox codesUPPERCase"/></td>
			</tr>
			<tr>
				<td width="180" >&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td width="180" >&nbsp;</td>
				<td>&nbsp;</td>
			</tr>-->
		</table>
	</div>
<!--<div>Terms and condition:</div>	-->


<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>
	<div style="margin:10px 0 10px 194px;">
	<button type="submit" id="add" value="submit" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkVendorPO();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
		
		<a href="view-vendorpo.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
		
		<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;"><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button></a>
		
	</div>
		</td>
	</tr>
</table>
</div>
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