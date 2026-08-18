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
	
	$('input[name^=qty]').live('keyup', function() {
		qty=parseFloat($("#qty").val()); 
		unit_price=parseFloat($("#unit_price").val()); 
		VenAmt=parseFloat(qty*unit_price);
		$("#total_amount").val(VenAmt.toFixed(2));
		vnTotAmt=$("#total_amount").val();
		if(vnTotAmt=="NaN"){$("#total_amount").val('0.00');}
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
	
	var fullDate = new Date();
		console.log(fullDate);
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
		$(".curdate").val(currentDate);
	
});


function selRFQNoDet(){
	rfqNO=$("#rfq_no").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selRFQVEndorDet.php',
			data:{
			rfqNO:rfqNO
			},
			success:function(data){
				 /* alert(data); */   
				  qte=data.split('@');
				  
				  $('#qty').val(qte[0]);
				  $('#totQty').val(qte[0]);
				  $('#ui').val(qte[1]);
				  $('#rate').val(qte[2]);
				  $('.reqDD').val(qte[3]);
				  $('#part_no').val(qte[4]);
				  $('#part_name').val(qte[5]);
				  $('#total_amount').val(qte[6]);
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
		
</script> 
<style>
 .block_top_1 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    margin: 0 20px 0 0;
    min-height: 320px;
    padding: 10px;
    width: 475px;
}
.block_top_2 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    min-height: 320px;
    padding: 12px;
    width: 475px;
}
.block_top_3 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    margin: 0 0 0 20px;
    min-height: 320px;
    padding: 10px;
    width: 300px;
}
input, textarea, select, .uneditable-input {
    border: 1px solid #cccccc;
    border-radius: 0;
    color: #555555;
    display: inline-block;
    font-size: 13px;
    height: 28px;
    line-height: 28px;
    margin-bottom: 9px;
    padding: 4px;
    width: 180px;
}
/* .table tr td {
    height: 25px;
	color:#333333;
} */
/* .table-disable-hover.table tbody tr:hover td,
.table-disable-hover.table tbody tr:hover th {
    background-color: inherit;
} */
 #addcustomer .table .textbox { width:180px;} 
 
 .textbox {
    background: #fff none repeat scroll 0 0;
    border-color: #b1a795 #e2d9c7 #e2d9c7 #b1a795;
    border-style: solid;
    border-width: 1px;
    float: left;
    font-size: 12px;
    height: 26px;
    line-height: 26px;
    margin: 0 0 10px;
    padding: 0 5px;
    width: 180px;
}
table tr td {
    height: 25px;
	color: #333333;
}
.table th, .table td{
border-top: 1px solid #dddddd;
    line-height: 18px;
    padding: 8px;
    text-align: left;
    vertical-align: top;
	}
	
	.table-condensed th, .table-condensed td {
    padding: 4px 5px;
}

.drop-down {
    background: #fff none repeat scroll 0 0;
    border-color: #b1a795 #e2d9c7 #e2d9c7 #b1a795;
    border-style: solid;
    border-width: 1px;
    float: left;
    font-size: 12px;
    height: 28px;
    line-height: 26px;
    margin: 0 0 8px;
    padding: 2px 5px;
    width: 180px;
}
</style>


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
			<h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Vendor Allocation</b></h3>
<?php
$sql=mysql_query("select * from vendor_allocation where vendorallot_id='".$_GET['uid']."'");
$row=mysql_fetch_array($sql);
?>		
<div class="" style="border-right:1px solid #ddd;">
<form id="quotationmaster" name="quotationmaster" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/update_vendor_allot.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="vendorallot_id" id="vendorallot_id" value="<?php echo $_GET['uid'];?>" type="hidden"/>
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			<tr>
				<td width="180" >RFQ No:</td>
				<td>
				<input name="rfq_no" id="rfq_no" type="text" data-validation="required" value="<?php echo $row['rfq_no']; ?>" class="input validate[required] textbox" onkeyup="selRFQNoDet();"/>
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
		if($resulte['vendor_name']=$row['vendor_name']){
		?>
	<option value="<?php echo $resulte['vendor_code'] ?>" selected ><?php echo $resulte['vendor_name'] ?></option>
	<?php }else{ ?>
		
	<option value="<?php echo $resulte['vendor_code'] ?>"><?php echo $resulte['vendor_name'] ?></option>
	<?php } } ?>
</select>
	</td>
			</tr>	
			<tr>
				<td width="180" >Total Qty :</td>
				<td ><input name="qty" id="qty" type="text" value="<?php echo $row['qty']; ?>" data-validation="required" class="input validate[required,custom[integer]] textbox codesUPPERCase"/></td>
			</tr>
			<tr>
				<td width="180" >Allot Qty:</td>
				<td>
				<input name="allot_qty" id="allot_qty" type="text" data-validation="required" class="input validate[required] textbox" onkeyup="selRFQNoDet();"/>
				</td>
			</tr>
			
			
			
			<!--<tr>
				<td width="180" >Drawing Attach :</td>
				<td ><input name="draw_attach" id="draw_attach" type="file"  class="textbox"/></td>
			</tr>-->
		</table>
		</div>
	
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
				<input name="vendor_price" id="vendor_price" type="text" value="<?php echo $row['vendor_price']; ?>" data-validation="required" class="input validate[required,custom[integer]] textbox" onkeyup="selRFQNoDet();"/>
				</td>
			</tr>
		<tr>
				<td width="180" >Ref Unit Price:</td>
				<td><input name="unit_price" id="unit_price" type="text" value="<?php echo $row['unit_price']; ?>" data-validation="required" class="input validate[required,custom[integer]] textbox"/></td>
			</tr>

			
			<tr>
				<td width="180" >Drawing Attach :</td>
				<td   ><input name="draw_attach" id="draw_attach" type="file"  class="textbox"/></td>
			</tr>
			
	</table>
	
<!--<div>Terms and condition:</div>	-->


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