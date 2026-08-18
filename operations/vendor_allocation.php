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
	
	$("#rfq_no").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../action/selectVENALLocation.php",
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
	jQuery("#quotationmaster").validationEngine();
	
	$('input[name^=unit_price]').live('keyup', function() {
		qty=parseFloat($("#qty").val()); 
		unit_price=parseFloat($("#unit_price").val()); 
		VenAmt=parseFloat(qty*unit_price);
		$("#total_amount").val(VenAmt.toFixed(2));
		vnTotAmt=$("#total_amount").val();
		if(vnTotAmt=="NaN"){$("#total_amount").val('0.00');}
	});
	
	$('input[name^=allot_qty]').live('keyup', function() {
		convRate=parseFloat($("#conversion_rate").val()); 
		qty=parseFloat($("#allot_qty").val()); 
		unit_price=parseFloat($("#rate").val()); 
		unitV=parseFloat(unit_price*convRate*0.3);
		VenAmt=parseFloat(qty*unitV);
		$("#vendor_price").val(VenAmt.toFixed(2));
		vnTotAmt=$("#vendor_price").val();
		if(vnTotAmt=="NaN"){$("#vendor_price").val('0.00');}
	});
	
	$('input[name^=rfq_no]').live('click', function() {
		rfqNO=$("#rfq_no").val();
		$.ajax({
		type:'GET',
		url:'  ../action/selectVENdorALLocation.php',
			data:{
			rfqNO:rfqNO
			},
			success:function(data){
				 /* alert(data); */  
				  qte=data.split(',');
				  $('#qty').val(qte[0]);
				  $('#unit_issue').val(qte[1]);
				  $('#rate').val(qte[2]);
				  $('#unit_price').val(qte[3]);
			}
		});
	});
	
	
	
});


function selectVENALL(val) {
$("#rfq_no").val(val);
$("#suggesstion-box").hide();
}


/* function selRFQVenDET(){
	rfqNO=$("#rfq_no").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectVENdorALLocation.php',
			data:{
			rfqNO:rfqNO
			},
			success:function(data){
				
				  qte=data.split(',');
				  $('#qty').val(qte[0]);
				  $('#unit_issue').val(qte[1]);
				  $('#rate').val(qte[2]);
				  $('#unit_price').val(qte[3]);
			}
	});
	
} */
		
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
<?php
 $sqlCu=mysql_query("select * from currency_master where currency_code='USD'"); 
 $rowCu=mysql_fetch_array($sqlCu);
 $conRate=$rowCu['conversion_rate'];
?>	
	
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
			<h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Vendor Allocation</b></h3>
			
<div class="" style="border-right:1px solid #ddd;">
<form id="quotationmaster" name="quotationmaster" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_vendor_allocation.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="totQty" id="totQty" type="hidden"/>
<input name="quote_rate" id="rate" type="hidden"/>
<input name="conversion_rate" id="conversion_rate" value="<?php echo $conRate;?>" type="hidden"/>
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			<tr>
				<td width="180" >RFQ No:</td>
				<td>
				<input name="rfq_no" id="rfq_no" type="text" class="textbox" onclick="selRFQVenDET();"/>
				<div id="suggesstion-box"></div>
				</td>
			</tr>
			<tr>
			<td width="180" >Vendor Name * :</td>
			<td>
				<select name="vendor_name" id="vendor_name" style="font-size:14px;" onChange="selVENdorPO();">
					<option value="">--Select--</option>
					<?php
					$sqle="select * from vendor_master";
					$rowe=mysql_query($sqle);
					while($resulte=mysql_fetch_array($rowe)) {
					?>
					<option value="<?php echo $resulte['vendor_code'] ?>"><?php echo $resulte['vendor_name'] ?></option>
					<?php } ?>
				</select>
			</td>
			</tr>
			<tr>
				<td width="180" >Total Qty :</td>
				<td ><input name="qty" id="qty" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox codesUPPERCase"/></td>
			</tr>
			<tr>
				<td width="180" >Allot Qty:</td>
				<td>
				<input name="allot_qty" id="allot_qty" type="text" data-validation="required" class="input validate[required] textbox" />
				</td>
			</tr>
			
			
		</table>
	
	
		<table style="width:50%;border-left:1px solid #ddd;" class="table">
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
		<tr>
			<td width="180" >Vendor Price:</td>
			<td>
			<input name="vendor_price" id="vendor_price" type="text" data-validation="required" class="input validate[required,custom[number]] textbox"/>
			</td>
		</tr>
		<tr>
				<td width="180" >Ref Unit Price:</td>
				<td><input name="unit_price" id="unit_price" type="text" data-validation="required" class="input validate[required,custom[number]] textbox"/></td>
			</tr>

			

			<tr>
				<td width="180" >Drawing Attach :</td>
				<td   ><input name="draw_attach" id="draw_attach" type="file"  class="textbox"/></td>
			</tr>
	</table>
		</div>

<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>
	<div style="margin:10px 0 10px 194px;">
	<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkUnitMaster();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
		
		<a href="view-vendorallocation.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
		
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