<?php
ob_start();
include("../includes/header.php");
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
	
var fullDate = new Date();  
	 
console.log(fullDate);
var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
var currentDate = fullDate.getDate() + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
var currentNxtDate = fullDate.getDate()+1 + "-" + twoDigitMonth + "-" + fullDate.getFullYear();

 $(".cur_date").val(currentDate);
/*  $("#datepicker-example17").val(currentNxtDate).data('Zebra_DatePicker').hide(); */
	 
	 
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#quotationmaster").validationEngine();
	
	
	
	var fullDate = new Date();
		console.log(fullDate);
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
		$("#cur_date").val(currentDate);
		
		
		
$(".exT").keyup(function(){
	alert("dsds");
		totTt +=parseFloat($(this).val());
		alert(totTt);
	if(totTt>totQty){
		r=confirm('Exceed the quantityddssasa. Do youdd want to continue ?');
		if(r==true){

		}else{
			$('#clin_qty'+numrow).val(totQty);
		}
	}		
	
}); 
	
	
	
	
	
});


function noOfclin() {
	var rowCount = 0;
	no_clin=$("#no_clin").val();
	var rowTblCount = $('#addedRowsED tr').length;
	$('#addedRowsED').html('');
	/* alert(rowTblCount); */
		for(i=0;i<no_clin;i++) {
			rowCount=rowCount+1; 
			
			 var recRow = '<tr id="rowCount'+rowCount+'"><td style="width:250px">CLIN Qty.'+rowCount+' :</td><td><input name="clin_qty[]" id="clin_qty'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase exTOTQty exT" onblur="chMaxCLinQty('+rowCount+');"/></td></tr><tr id="rowCount'+rowCount+'"><td style="width:250px">CLIN Destination'+rowCount+' :</td><td><input name="clin_dest[]" id="clin_dest'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase"/></td></tr> '; 
 
			jQuery('#addedRowsED').append(recRow); 
			$('#rowCount').val(rowCount);
		}
}


function selectQuoteREFQ() {
	rfq=$('#rfqNo').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectQuoteDetails.php',
			data:{
			rfq:rfq
			},
			success:function(data){
				  /* alert(data);  */
				  qte=data.split('@');
				  
				  $('#nsn_no').val(qte[0]);
				  $('#part_no').val(qte[1]);
				  $('#part_name').val(qte[2]);
				  $('#rfq_no').val(qte[3]);
				  $('#total_qty').val(qte[4]);
				  $('#totQty').val(qte[4]);
				  $('.reqDeldate').val(qte[5]);
				  $('#order_value').val(qte[6]);
				  $('#quote_ref').val(qte[7]);
				  $('#inspec_place').val(qte[8]);
				  $('#fob').val(qte[9]);
				
			}
	});
}

function excTotQTY() {
 totQty=parseFloat($('#totQty').val());
 total_qty=parseFloat($('#total_qty').val());
	if(total_qty>totQty){
		r=confirm('Exceed the quantityii. Do you want to continue ?');
		if(r==true){
			
		}else{
			$('#total_qty').val(totQty);
		}
	}
	
	if(total_qty<totQty){
		r=confirm('Less than the quantity. Do you want to continue ?');
		if(r==true){
			
		}else{
			$('#total_qty').val(totQty);
		}
	}
}

a=0;

function chMaxCLinQty(numrow){
	a=a+1;
	clinQty=parseFloat($('#clin_qty'+numrow).val());
	totTt=0;
	$(".exT").each(function(){
		 totTt +=parseFloat($(this).val()); 
	});
	totQty=parseFloat($('#total_qty').val());
	if(totTt!='NaN'){
	if(totTt>totQty){
		
		alert('Exceed the quantity.');
		
		$(".exT").each(function(){
				/*  parseFloat($(this).val(''));   */
				
			});
		
	}
	 }
	  /* if(clinQty>totQty){
		alert('Exceed the quantityyy2323.');
		$(".exT").each(function(){
				 parseFloat($(this).val('')); 
			});
			
	}   */

	
	/* if(totQt>clinQty){
		r=confirm('Exceed the quantityyy. Do you want to continue ?');
		if(r==true){ */
		/* parseFloat($('#clin_qty'+numrow).val('')); */	
		/* }else{ */
		/* 	$('#clin_qty'+numrow).val(totQty); */
	/* 		 parseFloat($('#clin_qty'+numrow).val(''));
		}
	} */
}


function checkCustomerPO(){
	total_qty=$('#total_qty').val();
	var status = true;	
	totTt=0;
	$(".exT").each(function(){
		 totTt +=parseFloat($(this).val()); 
	});
	if(totTt>total_qty){
		alert('Exceed the total quantity.');
		status = false;
		
	}else if(totTt<total_qty){
		alert('Less than the total quantity.');
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
	/* font-size:14px; */
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
<script src="<?php echo $home_path;?>/tab-content/tabcontent.js" type="text/javascript"></script>
<link href="<?php echo $home_path;?>/tab-content/template4/tabcontent.css" rel="stylesheet" type="text/css" />
<?php
if(isset($_GET['uid'])){
$uid=$_GET['uid'];
$sqlQ=mysql_query("select * from quotation where quote_id='".$_GET['uid']."'");
$rowQ=mysql_fetch_array($sqlQ);
}
?>
<body class="bgBODY" >
<div class="about">
<div class="col-md-12">
<div id="invoice" style="border:1px solid #ddd;margin:0 auto;">
	<!--<div id="invoice" style="border:1px solid #ddd;margin:0 0 0 12px;">-->
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

<div class="tabcontents">
<div id="view1" class="masterEmployeeBG">		
			<h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Customer Purchase Order</b></h3>
	

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

<div class="" style="border-right:1px solid #ddd;">
<form id="quotationmaster" name="quotationmaster" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_customerpo.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="totQty" id="totQty" type="hidden"/>
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			<tr>
					<td width="180" >Date * :</td>
					<td >
					<input name="cur_date" id="calendar" type="text" data-validation="required" class="input validate[required] textbox cur_date" onblur="checkitemcode()"/>
					</td>
			</tr>
			<tr>
				<td width="180" >Customer Name * :</td>
				<td>
					<select name="customer_name" id="customer_name" style="font-size:14px;" onChange="selVENdorPO();">
						<option value="">--Select--</option>
						<?php
						$sqle="select * from client_master";
						$rowe=mysql_query($sqle);
						while($resulte=mysql_fetch_array($rowe)) {
						?>
						<option value="<?php echo $resulte['client_id'] ?>"><?php echo $resulte['client_name'] ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="180" >RFQ No:</td>
				<td>
				<input name="rfqNo" id="rfqNo" type="text" data-validation="required" class="input validate[required] textbox" onkeyup="selectQuoteREFQ();"/>
				</td>
			</tr>
			<tr>
				<td width="180" >Contract No./PO.No.:</td>
				<td><input name="customerpo_no" id="customerpo_no" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			
			<tr>
				<td width="180" >NSN No:</td>
				<td ><input name="nsn_no" id="nsn_no" type="text" data-validation="required" class="input validate[required] textbox" value="<?php if(isset($rowQ['nsn_no'])) { echo $rowQ['nsn_no']; } ?>"/></td>
			</tr>
			<tr>
				<td width="180" >Total Qty :</td>
				<td><input name="total_qty" id="total_qty" type="text" class="textbox codesUPPERCase" value="<?php if(isset($rowQ['qty'])){echo $rowQ['qty'];} ?>"onblur="excTotQTY();"/></td>
			</tr>
			
			<tr>
				<td width="180" >No. of CLIN's *:</td>
				<td>
					<input name="no_clin" id="no_clin" type="text" data-validation="required" class="input validate[required] textbox" onKeyup="noOfclin();"/>
				</td>
			</tr>
			
			
			<tbody id="addedRowsED" style="">
			</tbody>
		</table>
		</div>
	
		<table style="width:50%;border-left:1px solid #ddd;" class="table">
			<tr>
				<td width="180" >Quote Ref.#:</td>
				<td>
				<input name="quote_ref" id="quote_ref" type="text" data-validation="required" class="input validate[required] textbox" value="" />
				
				</td>
			</tr>
			<tr>
				<td width="180" >Special Requirements :</td>
				<td><input name="spec_req" id="spec_req" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			
			<tr>
				<td width="180" >Inspection Place:</td>
				<td>
					<select class="drop-down fstChUPPRCase" name="inspec_place" id="inspec_place">
						<option value="">--Select--</option>
						<option value="origin">Origin</option>
						<option value="destination">Destination</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td width="180" >FOB:</td>
				<td><select class="drop-down fstChUPPRCase" name="fob" id="fob">
						<option value="">--Select--</option>
						<option value="origin">Origin</option>
						<option value="destination">Destination</option>
				</select></td>
			</tr>
			
			<tr>
				<td width="180" >RDD :</td>
				<td><input name="req_deldate" id="calendar2" type="text" class="textbox codesUPPERCase reqDeldate" placeholder="dd/mm/yyyy"/></td>
			</tr>
			<tr>	
				<td width="180" >Order Value :</td>
				<td><input name="order_value" id="order_value" type="text" class="textbox codesUPPERCase" value="<?php if(isset($rowQ['quote_amt'])){echo $rowQ['quote_amt'];} ?>"/></td>
			</tr>
			<tr>
				<td width="180" >Add PO :</td>
				<td ><input name="add_po" id="add_po" type="file" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td style="text-align:center;height:51px;vertical-align:middle;"><b>Packing Standard</b></td>
				<td>
					<ul class="tabs" data-persist="true">
						<li><a href="#view1" class="epPersDEts" style="display:none;">Next</a></li>
						<li><a href="#view2" >Next</a></li>
					</ul>
				</td>
			</tr>
			<!--<tr>
			<td style="width:200px;vertical-align:middle;">Packing Requirements :</td>
			<td width="385" valign="top" class="payComDays">
			<input type="radio" id="packing_active" name="packing_req" value="1" style="width:25px;vertical-align:middle;" checked />&nbsp;<span style="vertical-align:middle;">CP</span>&nbsp;&nbsp;<input type="radio" id="packing_passive" name="packing_req" style="width:25px;vertical-align:middle;" value="0" />&nbsp;<span style="vertical-align:middle;">Others</span>
			</td>
			</tr>-->
		
					
		</table>
</div>

		
		
		
		
		



<div id="view2" class="masterEmployeeBG">
		
			<h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Customer Purchase Order</b></h3>
	

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

<div class="" style="border-right:1px solid #ddd;">
<form id="quotationmaster" name="quotationmaster" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_customerpo.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="totQty" id="totQty" type="hidden"/>
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			<tr>
					<td width="180" >Date * :</td>
					<td >
					<input name="cur_date" id="calendar" type="text" data-validation="required" class="input validate[required] textbox cur_date" onblur="checkitemcode()"/>
					</td>
			</tr>
			<tr>
				<td width="180" >Customer Name * :</td>
				<td>
					<select name="customer_name" id="customer_name" style="font-size:14px;" onChange="selVENdorPO();">
						<option value="">--Select--</option>
						<?php
						$sqle="select * from client_master";
						$rowe=mysql_query($sqle);
						while($resulte=mysql_fetch_array($rowe)) {
						?>
						<option value="<?php echo $resulte['client_id'] ?>"><?php echo $resulte['client_name'] ?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="180" >RFQ No:</td>
				<td>
				<input name="rfqNo" id="rfqNo" type="text" data-validation="required" class="input validate[required] textbox" onkeyup="selectQuoteREFQ();"/>
				</td>
			</tr>
			<tr>
				<td width="180" >Contract No./PO.No.:</td>
				<td><input name="customerpo_no" id="customerpo_no" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			
			<tr>
				<td width="180" >NSN No:</td>
				<td ><input name="nsn_no" id="nsn_no" type="text" data-validation="required" class="input validate[required] textbox" value="<?php if(isset($rowQ['nsn_no'])) { echo $rowQ['nsn_no']; } ?>"/></td>
			</tr>
			<tr>
				<td width="180" >Total Qty :</td>
				<td><input name="total_qty" id="total_qty" type="text" class="textbox codesUPPERCase" value="<?php if(isset($rowQ['qty'])){echo $rowQ['qty'];} ?>"onblur="excTotQTY();"/></td>
			</tr>
			
			<tr>
				<td width="180" >No. of CLIN's *:</td>
				<td>
					<input name="no_clin" id="no_clin" type="text" data-validation="required" class="input validate[required] textbox" onKeyup="noOfclin();"/>
				</td>
			</tr>
			
			
			<tbody id="addedRowsED" style="">
			</tbody>
		</table>
		</div>
	
		<table style="width:50%;border-left:1px solid #ddd;" class="table">
			<tr>
				<td width="180" >Quote Ref.#:</td>
				<td>
				<input name="quote_ref" id="quote_ref" type="text" data-validation="required" class="input validate[required] textbox" value="" />
				
				</td>
			</tr>
			<tr>
				<td width="180" >Special Requirements :</td>
				<td><input name="spec_req" id="spec_req" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			
			<tr>
				<td width="180" >Inspection Place:</td>
				<td>
					<select class="drop-down fstChUPPRCase" name="inspec_place" id="inspec_place">
						<option value="">--Select--</option>
						<option value="origin">Origin</option>
						<option value="destination">Destination</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td width="180" >FOB:</td>
				<td><select class="drop-down fstChUPPRCase" name="fob" id="fob">
						<option value="">--Select--</option>
						<option value="origin">Origin</option>
						<option value="destination">Destination</option>
				</select></td>
			</tr>
			
			<tr>
				<td width="180" >RDD :</td>
				<td><input name="req_deldate" id="calendar2" type="text" class="textbox codesUPPERCase reqDeldate" placeholder="dd/mm/yyyy"/></td>
			</tr>
			<tr>	
				<td width="180" >Order Value :</td>
				<td><input name="order_value" id="order_value" type="text" class="textbox codesUPPERCase" value="<?php if(isset($rowQ['quote_amt'])){echo $rowQ['quote_amt'];} ?>"/></td>
			</tr>
			<tr>
				<td width="180" >Add PO :</td>
				<td ><input name="add_po" id="add_po" type="file" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td style="text-align:center;height:51px;vertical-align:middle;"><b>Packing Standard</b></td>
				<td>
					<ul class="tabs" data-persist="true">
						<li><a href="#view1" class="epPersDEts" >Back</a></li>
						<li><a href="#view2" style="display:none;">Next</a></li>
					</ul>
				</td>
			</tr>
			<!--<tr>
			<td style="width:200px;vertical-align:middle;">Packing Requirements :</td>
			<td width="385" valign="top" class="payComDays">
			<input type="radio" id="packing_active" name="packing_req" value="1" style="width:25px;vertical-align:middle;" checked />&nbsp;<span style="vertical-align:middle;">CP</span>&nbsp;&nbsp;<input type="radio" id="packing_passive" name="packing_req" style="width:25px;vertical-align:middle;" value="0" />&nbsp;<span style="vertical-align:middle;">Others</span>
			</td>
			</tr>-->
		
					
		</table>



<table style="border:1px solid #ddd;margin:-30px 0 0 0;" class="table">
	<tr>
		<td>
	<div style="margin:10px 0 10px 194px;">
	<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkCustomerPO();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
		
		<a href="view-customerpo.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
		
		<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button></a>
		
	</div>
		</td>
	</tr>
</table>
</div>

		

</div>
</form>		
	</div>
</div>
</div>
	

</body>
</html>