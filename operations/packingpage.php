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
	
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#quotationmaster").validationEngine();
	
	$('input[name^=quote_rate]').live('blur', function() {
		qty=parseFloat($("#qty").val()); 
		qtRate=parseFloat($("#quote_rate").val()); 
		qtAmt=parseFloat(qty*qtRate);
		$("#quote_amt").val(qtAmt.toFixed(2));
		qtTotAmt=$("#quote_amt").val();
		if(qtTotAmt=="NaN"){$("#quote_amt").val('0.00');}
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
		$("#cur_date").val(currentDate);
	
});


function selRFQnumber()	{
	rfqNO=$("#rfq_no").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selPACkingPage.php',
			data:{
			rfqNO:rfqNO
			},
			success:function(data){
				 /* alert(data); */   
				  Qte=data.split(',');
				  $("#clin_no1").hide();
				  $("#clin_no").val(Qte[0]);
				  $("#contract_no").val(Qte[1]);
				  $("#nsn_no").val(Qte[2]);
				  $("#part_no").val(Qte[3]);
				  $("#part_name").val(Qte[4]);
				  $("#total_qty").val(Qte[5]);
				  $("#clinDest").html(Qte[6]);
			}
	});
}	

		
function selClnDest() {
	deCode=$("#clin_dest").val();
	deAddress=$("#dest_address").val();
	deAddress1=$("#dest_address1").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selCLNDESt.php',
			data:{
			deCode:deCode
			},
			success:function(data) {
					/* alert(data); */ 
				  Qte=data.split(',');
				  $("#dest_address").val(Qte[0]);
				  $("#dest_address1").val(Qte[1]); 
				  $("#clin_qty").val(Qte[3]); 
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
	<div id="invoice" style="border:1px solid #ddd;margin:0 0 0 12px;">
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

<h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Packing Page</b></h3>
			
<div class="" style="border-right:1px solid #ddd;">
<form id="quotationmaster" name="quotationmaster" action="<?php echo $home_path;?>/action/add_packingpage.php" method="post" class="" style="margin: 0 0 12px 0;">
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			<tr>
				<td width="180" >RFQ No:</td>
				<td>
					<input name="rfq_no" id="rfq_no" type="text" data-validation="required" class="input validate[required] textbox" onblur="selRFQnumber();"/>
				</td>
			</tr>
			<tr>
				<td width="180" >CLIN Dest.:</td>
				<td id="clinDest">
					<input name="clin_no" id="clin_no1" type="text" data-validation="required" class="input validate[required] textbox"/>
				</td>
			</tr>
			<tr>
					<td width="180" >Packing Date :</td>
					<td >
					<input name="packing_date" id="calendar" type="text" data-validation="required" class="input validate[required] textbox" onblur="checkitemcode()"/>
					</td>
			</tr>
			
			<tr>
				<td width="180" >Contract No:</td>
				<td>
					<input name="contract_no" id="contract_no" type="text" data-validation="required" class="input validate[required] textbox"/>
				</td>
			</tr>
			
			<tr>
				<td width="180" >NSN No:</td>
				<td><input name="nsn_no" id="nsn_no" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Part No:</td>
				<td>
					<input name="part_no" id="part_no" type="text" data-validation="required" class="input validate[required] textbox"/>
				</td>
			</tr>
			
			
		</table>
		</div>
		<div class="" >
		<table style="width:50%;border-left:1px solid #ddd;" class="table">
			<tr>
				<td width="180" >Nomen/Part Name :</td>
				<td><input name="part_name" id="part_name" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Total Qty :</td>
				<td ><input name="total_qty" id="total_qty" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >CLIN Qty:</td>
				<td ><input name="clin_qty" id="clin_qty" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox"/></td>
			</tr>
			<!--<tr>
				<td width="180" >Dest. Code:</td>
				<td ><input name="dest_code" id="dest_code" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox fstChUPPRCase"/></td>
			</tr>-->
			<tr>
				<td width="180" >Dest. Address:</td>
				<td ><input name="dest_address" id="dest_address" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Dest. Address1:</td>
				<td ><input name="dest_address1" id="dest_address1" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Packing Req:</td>
				<td ><input name="packing_req" id="packing_req" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase"/></td>
			</tr>
			<!--<tr>
				<td width="180" >Print :</td>
				<td>
					<input name="rfq_no" id="rfq_no" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase"/>
				</td>
			</tr>-->
			
		</table>
	</div>

</div>



<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>
		<div style="margin:10px 0 10px 194px;">
			<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkUnitMaster();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
			
			<a href="view-packingpage.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
			
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
	
</body>
</html>