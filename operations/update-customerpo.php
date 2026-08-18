<?php
ob_start();
include("../includes/header.php");
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
		url: "../action/selectQuoteDetails1.php",
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

function selectRFQ(val) {
$("#rfq_no").val(val);
$("#suggesstion-box").hide();
}

function noOfclin() {
	var rowCount = 0;
	no_clin=$("#no_clin").val();
	var rowTblCount = $('#addedRowsED tr').length;
	$('#addedRowsED').html('');
	/* alert(rowTblCount); */
		for(i=0;i<no_clin;i++) {
			rowCount=rowCount+1; 
			
			 var recRow = '<tr id="rowCount'+rowCount+'"><td style="width:250px">CLIN Qty. :</td><td><input name="clin_qty[]" id="clin_qty'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase exTOTQty exT" onKeyup="chBAlCLinQty('+rowCount+');" onblur="chMaxCLinQty('+rowCount+');"/></td></tr><tr id="rowCount'+rowCount+'"><td style="width:250px">CLIN Destination :</td><td><input name="clin_dest[]" id="clin_dest'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase"/></td></tr> '; 
 
			jQuery('#addedRowsED').append(recRow); 
			$('#rowCount').val(rowCount);
		}
}

function chBAlCLinQty() {
	totTt=0;
	$('.exT').each(function(){
		totTt +=parseFloat($(this).val());
			/* $('#bal_qty').val(totTt); */
	});
	totQy=parseFloat($("#total_qty").val());
	bAmt=parseFloat($("#bal_qty").val());
	ttQy=totQy-totTt;
	$("#bal_qty").val(ttQy);
	ba=$("#bal_qty").val();
	if(ba=="NaN"){$("#bal_qty").val('0.00');}
}

function selQuoteREF() {
	quRef=$('#quote_ref').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectQuoteDetails.php',
			data:{
			quRef:quRef
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split('@');
				  
				  $('#nsn_no').val(qte[0]);
				  $('#part_no').val(qte[1]);
				  $('#part_name').val(qte[2]);
				  $('#rfq_no').val(qte[3]);
				  $('#total_qty').val(qte[4]);
				  $('#totQty').val(qte[4]);
				  $('.reqDeldate').val(qte[5]);
				  $('#order_value').val(qte[6]);
				   
				/* if(data==1){
					$('#msgFoprop').html('* Vendor Code already exists.');
					$('#vendor_code').val('');
				}
				else{
					$('#msgFoprop').html('');
				} */
			}
	});
}

function selectQuoteREFQ1(){
rfq=$('#rfqNo').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectQuoteDetails1.php',
			data:{
			/* rfq:rfq */
			data:'keyword='+$(this).val(),
			},
			success:function(data){
				 /*  alert(data); */  
				 /*  qte=data.split('@'); */
				 /*  qte=data.split('@'); */
				 /* $("#department_name").val(data); */
			}
	});	
}


function excTotQTY() {
 totQty=parseFloat($('#totQty').val());
 total_qty=parseFloat($('#total_qty').val());
	if(total_qty>totQty){
		r=confirm('Exceed the quantity. Do you want to continue ?');
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
	/* alert(clinQty); */
	totQty=parseFloat($('#totQty').val());
	if(clinQty>totQty){
		r=confirm('Exceed the quantity. Do you want to continue ?');
		if(r==true){
			
		}else{
			$('#clin_qty'+numrow).val(totQty);
		}
	}
	
	/* $(".exTOTQty").each(function(){
				totTt +=parseFloat($(this).val());
				alert(totTt);
		if(totTt>totQty){
		r=confirm('Exceed the quantity. Do youdd want to continue ?');
		if(r==true){
			
		}else{
			$('#clin_qty'+numrow).val(totQty);
		}
	}		
				
	}); */
	
	
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


function selctPacCOde1(){
	heading1=$('#heading1').val();
	code1=$('#code1').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard.php',
			data:{
			heading1:heading1,
			code1:code1
			},
			success:function(data){
				/*   alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require1').val(qte[1]);  
				  }else{
					 $('#code1').val('');  
					$('#require1').val('');   
				  }
			}
	});
}
function selctPacCOde2(){
	heading2=$('#heading2').val();
	code2=$('#code2').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard2.php',
			data:{
			heading2:heading2,
			code2:code2
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require2').val(qte[1]);  
				  }else{
				  $('#code2').val('');  
					$('#require2').val('');   
				  }
			}
	});
}
function selctPacCOde3(){
	heading3=$('#heading3').val();
	code3=$('#code3').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard3.php',
			data:{
			heading3:heading3,
			code3:code3
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require3').val(qte[1]);  
				  }else{
				  $('#code3').val('');  
					$('#require3').val('');   
				  }
			}
	});
}


function selctPacCOde4(){
	heading4=$('#heading4').val();
	code4=$('#code4').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard4.php',
			data:{
			heading4:heading4,
			code4:code4
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require4').val(qte[1]);  
				  }else{
				  $('#code4').val('');  
					$('#require4').val('');   
				  }
			}
	});
}
function selctPacCOde5(){
	heading5=$('#heading5').val();
	code5=$('#code5').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard5.php',
			data:{
			heading5:heading5,
			code5:code5
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require5').val(qte[1]);  
				  }else{
				  $('#code5').val('');  
					$('#require5').val('');   
				  }
			}
	});
}

function selctPacCOde6(){
	heading6=$('#heading6').val();
	code6=$('#code6').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard6.php',
			data:{
			heading6:heading6,
			code6:code6
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require6').val(qte[1]);  
				  }else{
				  $('#code6').val('');  
					$('#require6').val('');   
				  }
			}
	});
}
function selctPacCOde7(){
	heading7=$('#heading7').val();
	code7=$('#code7').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard7.php',
			data:{
			heading7:heading7,
			code7:code7
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require7').val(qte[1]);  
				  }else{
				  $('#code7').val('');  
					$('#require7').val('');   
				  }
			}
	});
}
function selctPacCOde8(){
	heading8=$('#heading8').val();
	code8=$('#code8').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard8.php',
			data:{
			heading8:heading8,
			code8:code8
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require8').val(qte[1]);  
				  }else{
				  $('#code8').val('');  
					$('#require8').val('');   
				  }
			}
	});
}
function selctPacCOde9(){
	heading9=$('#heading9').val();
	code9=$('#code9').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard9.php',
			data:{
			heading9:heading9,
			code9:code9
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require9').val(qte[1]);  
				  }else{
				  $('#code9').val('');  
					$('#require9').val('');   
				  }
			}
	});
}
function selctPacCOde10(){
	heading10=$('#heading10').val();
	code10=$('#code10').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard10.php',
			data:{
			heading10:heading10,
			code10:code10
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require10').val(qte[1]);  
				  }else{
				  $('#code10').val('');  
					$('#require10').val('');   
				  }
			}
	});
}
function selctPacCOde11(){
	heading11=$('#heading11').val();
	code11=$('#code11').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard11.php',
			data:{
			heading11:heading11,
			code11:code11
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require11').val(qte[1]);  
				  }else{
				  $('#code11').val('');  
					$('#require11').val('');   
				  }
			}
	});
}
function selctPacCOde12(){
	heading12=$('#heading12').val();
	code12=$('#code12').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard12.php',
			data:{
			heading12:heading12,
			code12:code12
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require12').val(qte[1]);  
				  }else{
				  $('#code12').val('');  
					$('#require12').val('');   
				  }
			}
	});
}
function selctPacCOde13(){
	heading13=$('#heading13').val();
	code13=$('#code13').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard13.php',
			data:{
			heading13:heading13,
			code13:code13
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require13').val(qte[1]);  
				  }else{
				  $('#code13').val('');  
					$('#require13').val('');   
				  }
			}
	});
}
function selctPacCOde14(){
	heading14=$('#heading14').val();
	code14=$('#code14').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard14.php',
			data:{
			heading14:heading14,
			code14:code14
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require14').val(qte[1]);  
				  }else{
				  $('#code14').val('');  
					$('#require14').val('');   
				  }
			}
	});
}
function selctPacCOde15(){
	heading15=$('#heading15').val();
	code15=$('#code15').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard15.php',
			data:{
			heading15:heading15,
			code15:code15
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require15').val(qte[1]);  
				  }else{
				  $('#code15').val('');  
					$('#require15').val('');   
				  }
			}
	});
}
function selctPacCOde16(){
	heading16=$('#heading16').val();
	code16=$('#code16').val();
	$.ajax({
		type:'GET',
		url:'  ../action/selectPackStandard16.php',
			data:{
			heading16:heading16,
			code16:code16
			},
			success:function(data){
				 /*  alert(data);  */
				  qte=data.split(',');
				  if(qte[1]!=''){
					code1=$('#require16').val(qte[1]);  
				  }else{
				  $('#code16').val('');  
					$('#require16').val('');   
				  }
			}
	});
}

function pacTYpeCp(){
	pacType=$('#packing_type').val();  
	pacTpe=pacType.toUpperCase();
	/* alert(pacTpe); */
	if(pacTpe=='CP' || pacTpe==''){
		$('#cpoDIV').hide(); 
	}else{
		$('#cpoDIV').show(); 
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
<?php
if(isset($_GET['uid'])){
$uid=$_GET['uid'];
$sqlQ=mysql_query("select * from quotation where quote_id='".$_GET['uid']."'");
$rowQ=mysql_fetch_array($sqlQ);
}
?>
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
<?php 

	$sql=mysql_query("select * from customer_purorder where custpo_id='".$_GET['uid']."'");
	$x=0;
	$row=mysql_fetch_array($sql);
		$x++;
	?>
<form id="quotationmaster" name="quotationmaster" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/update_custPurOrder.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="custpo_id" id="custpo_id" type="hidden" value="<?php echo $row['custpo_id']?>" />
<input name="totQty" id="totQty" type="hidden"/>
<div>
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			<tr>
					<td width="180" >Date * :</td>
					<td >
					<input name="cur_date" id="calendar" type="text" data-validation="required" class="input validate[required] textbox cur_date" onblur="checkitemcode()" value="<?php echo $row['cur_date']?>"/>
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
							if($resulte['client_id']==$row['customer_name']){ ?>
							<option value="<?php echo $resulte['client_id'] ?>" selected ><?php echo $resulte['client_name'] ?></option>	
						<?php }else{ ?>
						<option value="<?php echo $resulte['client_id'] ?>"><?php echo $resulte['client_name'] ?></option>
						<?php } } ?>
					</select>
				</td>
			</tr>
	<tr>
		<td width="180" >RFQ No. *:</td>
		<td ><input name="rfq_no"  id="rfq_no" type="text" onkeyup="selectQuoteREFQ1();" onclick="selectQuoteREFQ();" value="<?php echo $row['rfq_no']; ?>"/>
		<div id="suggesstion-box"></div>
		</td>
	</tr>
			
			<tr>
				<td width="180" >Contract No./PO.No.:</td>
				<td><input name="custpo_no" id="custpo_no" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" value="<?php echo $row['custpo_no']?>"/></td>
			</tr>
			<tr>
				<td width="180" >PR Number:</td>
				<td><input name="pr_number" id="pr_number" type="text" class="textbox" value="<?php echo $row['pr_number']; ?>" /></td>
			</tr>
			<tr>
				<td width="180" >NSN No:</td>
				<td ><input name="nsn_no" id="nsn_no" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox" value="<?php echo $row['nsn_no']; ?>"/></td>
			</tr>
			<tr>
				<td width="180" >Total Qty :</td>
				<td><input name="total_qty" id="total_qty" type="text" class="textbox codesUPPERCase" value="<?php echo $row['total_qty']; ?>" onblur="excTotQTY();" style="width:90px;"/><input name="bal_qty" id="bal_qty" type="text" class="textbox " value="<?php echo $row['bal_qty']; ?>" style="width:89px;" placeholder="Balance qty" readonly /></td>
			</tr>
			<tr>
				<td width="180" >No. of CLIN's *:</td>
				<td>
					<input name="no_clin" id="no_clin" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['no_clin']?>"/>
				</td>
			</tr>
			
			<?php
			$sqlCln=mysql_query("select * from customer_purorder where custpo_id='".$_GET['uid']."'");
			$x=0;
			while($rowCln=mysql_fetch_array($sqlCln)){
				$x++;
			?>
			<tr>
				<td width="180" >CLIN Qty.<?php echo $x; ?>:</td>
				<td>
					<input name="clin_qty[]" id="clin_qty" type="text" data-validation="required" class="input validate[required] textbox exT" value="<?php echo $row['clin_qty']?>" onKeyup="chBAlCLinQty();"/>
				</td>
			</tr>
			<tr>
				<td width="180" >CLIN Dest.<?php echo $x; ?>:</td>
				<td>
					<input name="clin_dest[]" id="clin_dest" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['clin_dest']?>"/>
				</td>
			</tr>
			<?php } ?>
			<tbody id="addedRowsED" style="">
			</tbody>

			
		</table>
		</div>
	
		<table style="width:50%;border-left:1px solid #ddd;" class="table">
			<tr>
				<td width="180" >Quote Ref.#:</td>
				<td>
				<input name="quote_ref" id="quote_ref" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['quote_ref']?>" onkeyUp="selQuoteREF();"/>
				
				</td>
			</tr>
			<tr>
				<td width="180" >Special Requirements :</td>
				<td><input name="special_req" id="special_req" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['special_req']?>"/></td>
			</tr>
			<tr>
				<td width="180" >Inspection Place:</td>
				<td>
					<select class="drop-down fstChUPPRCase" name="inspec_place" id="inspec_place">
						<option value="">--Select--</option>
						<option value="origin"<?php echo ($row['inspec_place']=='origin')?'selected':''; ?>>Origin</option>
						<option value="destination"<?php echo ($row['inspec_place']=='destination')?'selected':''; ?>>Destination</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<td width="180" >FOB:</td>
				<td><select class="drop-down fstChUPPRCase" name="fob" id="fob">
						<option value="">--Select--</option>
						<option value="origin"<?php echo ($row['fob']=='origin')?'selected':''; ?>>Origin</option>
						<option value="destination"<?php echo ($row['fob']=='destination')?'selected':''; ?>>Destination</option>
				</select></td>
			</tr>
			<tr>
				<td width="180" >RDD :</td>
				<td><input name="req_deldate" id="calendar2" type="text" class="textbox codesUPPERCase reqDeldate" placeholder="dd/mm/yyyy" value="<?php echo $row['req_deldate']; ?>"/></td>
			</tr>
			<tr>	
				<td width="180" >Order Value :</td>
				<td><input name="order_value" id="order_value" type="text" class="textbox codesUPPERCase" value="<?php echo $row['order_value']; ?>"/></td>
			</tr>
			<tr>
				<td width="180" >Add PO :</td>
				<td ><input name="add_po" id="add_po" type="file" class="textbox"/></td>
			</tr>
			
			
		</table>
<table style="width:100%;border:1px solid #ddd;" class="table">
			<tr>
				<td><h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Packing Standard</b></h3></td>
			</tr>
		</table>
<div id="next">
<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			
			<tr>
				<td width="180" >Part Number:</td>
				<td>
				<input name="part_number" id="part_number" type="text" value="<?php echo $row['part_number']; ?>" data-validation="required" class="input validate[required] textbox" onkeyup="selectQuoteREFQ();"/>
				</td>
			</tr>
			<tr>
				<td width="180" >Nomenclature:</td>
				<td><input name="part_nomen" id="part_name" type="text" value="<?php echo $row['part_nomen']; ?>" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			
			
		</table>
		</div>
		<table style="width:50%;border-left:1px solid #ddd;" class="table">
			<tr>
				<td width="180" >Unit of Issue (U/I):</td>
				<td >
					<input name="unit_issue" id="unit_issue" type="text" data-validation="required" value="<?php echo $row['unit_issue']; ?>" class="input validate[required] textbox"/>
				</td>
			</tr>
			<tr>
				<td width="180" >Packing Type *:</td>
				<td>
					<input name="packing_type" id="packing_type" type="text" data-validation="required" value="<?php echo $row['packing_type']; ?>" class="input validate[required] textbox" onkeyup="pacTYpeCp();" />
				</td>
			</tr>
	</table>
<style>	
.headeR{
width:60px;
}
.headeTxt{
width:450px;
}
</style>	
		
<table style="float:left;width:99%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
	<tr>
		<th style="text-align:center;">HEADING</th>
		<th style="text-align:center;">DETAIL</th>
		<th style="text-align:center;">TABLE</th>
		<th style="text-align:center;">CODE</th>
		<th style="text-align:center;">REQUIREMENT</th>
	</tr>
	<tbody>
	<tr>
	<td><input name="heading1" id="heading1" type="text" value="QUP" class="headeR" readonly /></td>
	<td><input name="detail1" id="detail1" type="text" value="Quantity per Unit Pack" class="" readonly /></td>
	<td><input name="table1" id="table1" type="text" value="Page 142, Para J4.3" readonly /></td>
	<td><input name="code1" id="code1" type="text" value="<?php echo $row['code1']; ?>" class="textbox headeR selctCOde selCde" onblur="selctPacCOde1();" /></td>
	<td><input name="require1" id="require1" type="text" value="<?php echo $row['require1']; ?>" class="textbox headeTxt selctReq" /></td>
	</tr>
	<tr>
	<td><input name="heading2" id="heading2" type="text" value="ICQ" class="textbox headeR" readonly /></td>
	<td><input name="detail2" id="detail2" type="text" value="Inter. Cont. Quantity" class="textbox" readonly /></td>
	<td><input name="table2" id="table2" type="text" value="Page 143, Para J4.11" class="textbox" readonly /></td>
	<td><input name="code2" id="code2" type="text" value="<?php echo $row['code2']; ?>" class="textbox headeR" onblur="selctPacCOde2();"/></td>
	<td><input name="require2" id="require2" type="text" value="<?php echo $row['require2']; ?>" class="textbox headeTxt selctCOde selctReq"/></td>

	</tr>
	<tr>
	<td><input name="heading3" id="heading3" type="text" value="MOP" class="textbox headeR" readonly /></td>
	<td><input name="detail3" id="detail3" type="text" value="Method of Preservation" class="textbox" readonly /></td>
	<td><input name="table3" id="table3" type="text" value="Page 144, Para J I, J IA" class="textbox" readonly /></td>
	<td><input name="code3" id="code3" type="text" value="<?php echo $row['code3']; ?>" class="textbox headeR" onblur="selctPacCOde3();"/></td>
	<td><input name="require3" id="require3" type="text" value="<?php echo $row['require3']; ?>" class="textbox headeTxt selctCOde"/></td>

	</tr>
	<tr>
	<td><input name="heading4" id="heading4" type="text" value="CD"  class="textbox headeR" readonly /></td>
	<td><input name="detail4" id="detail4" type="text" value="Cleaning and Drying" class="textbox" readonly /></td>
	<td><input name="table4" id="table4" type="text" value="Page J II"  class="textbox" readonly /></td>
	<td><input name="code4" id="code4" type="text" value="<?php echo $row['code4']; ?>" class="textbox headeR" onblur="selctPacCOde4();"/></td>
	<td><input name="require4" id="require4" type="text" value="<?php echo $row['require4']; ?>" class="textbox headeTxt selctCOde"/></td>

	</tr>
	<tr>
	<td><input name="heading5" id="heading5" type="text" value="PM" class="textbox headeR" readonly /></td>
	<td><input name="detail5" id="detail5" type="text" value="Preservative Material" class="textbox" readonly /></td>
	<td><input name="table5" id="table5" type="text" value="Page J III" class="textbox" readonly /></td>
	<td><input name="code5" id="code5" type="text" value="<?php echo $row['code5']; ?>" class="textbox headeR" onblur="selctPacCOde5();"/></td>
	<td><input name="require5" id="require5" type="text" value="<?php echo $row['require5']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading6" id="heading6" type="text" value="WM" class="textbox headeR" readonly /></td>
	<td><input name="detail6" id="detail6" type="text" value="Wrapping Material" class="textbox" readonly /></td>
	<td><input name="table6" id="table6" type="text" value="Page J IV" class="textbox" readonly /></td>
	<td><input name="code6" id="code6" type="text" value="<?php echo $row['code6']; ?>" class="textbox headeR" onblur="selctPacCOde6();"/></td>
	<td><input name="require6" id="require6" type="text" value="<?php echo $row['require6']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading7" id="heading7" type="text" value="CUD"  class="textbox headeR" readonly /></td>
	<td><input name="detail7" id="detail7" type="text" value="Cush/Dun Material" class="textbox" readonly /></td>
	<td><input name="table7" id="table7" type="text" value="Page J V"  class="textbox" readonly /></td>
	<td><input name="code7" id="code7" type="text" value="<?php echo $row['code7']; ?>" class="textbox headeR" onblur="selctPacCOde7();"/></td>
	<td><input name="require7" id="require7" type="text" value="<?php echo $row['require7']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading8" id="heading8" type="text" value="CT" class="textbox headeR" readonly /></td>
	<td><input name="detail8" id="detail8" type="text" value="Cushioning Thickness" class="textbox" readonly /></td>
	<td><input name="table8" id="table8" type="text" value="Page J VI" class="textbox" readonly /></td>
	<td><input name="code8" id="code8" type="text" value="<?php echo $row['code8']; ?>" class="textbox headeR" onblur="selctPacCOde8();"/></td>
	<td><input name="require8" id="require8" type="text" value="<?php echo $row['require8']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading9" id="heading9" type="text" value="UC"  class="textbox headeR" readonly /></td>
	<td><input name="detail9" id="detail9" type="text" value="Unit Pack Container" class="textbox" readonly /></td>
	<td><input name="table9" id="table9" type="text" value="Page J VII" class="textbox" readonly /></td>
	<td><input name="code9" id="code9" type="text" value="<?php echo $row['code9']; ?>" class="textbox headeR" onblur="selctPacCOde9();"/></td>
	<td><input name="require9" id="require9" type="text" value="<?php echo $row['require9']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading10" id="heading10" type="text" value="IC" data-validation="required" class="textbox headeR" readonly /></td>
	<td><input name="detail10" id="detail10" type="text" value="Intermediate Container"  class="textbox" readonly /></td>
	<td><input name="table10" id="table10" type="text" value="Page J VII"  class="textbox" readonly /></td>
	<td><input name="code10" id="code10" type="text" value="<?php echo $row['code10']; ?>"  class="textbox headeR" onblur="selctPacCOde10();"/></td>
	<td><input name="require10" id="require10" type="text" value="<?php echo $row['require10']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading11" id="heading11" type="text" value="UCL" class="textbox headeR" readonly /></td>
	<td><input name="detail11" id="detail11" type="text" value="Unit Cont. Level" class="textbox" readonly /></td>
	<td><input name="table11" id="table11" type="text" value="Page J VIII" class="textbox" readonly /></td>
	<td><input name="code11" id="code11" type="text" value="<?php echo $row['code11']; ?>"  class="textbox headeR" onblur="selctPacCOde11();"/></td>
	<td><input name="require11" id="require11" type="text" value="<?php echo $row['require11']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading12" id="heading12" type="text" value="OPI" class="textbox headeR" readonly /></td>
	<td><input name="detail12" id="detail12" type="text" value="Optional Procedure Indicator"  class="textbox" readonly /></td>
	<td><input name="table12" id="table12" type="text" value="Page J VIIIa" class="textbox" readonly /></td>
	<td><input name="code12" id="code12" type="text" value="<?php echo $row['code12']; ?>" class="textbox headeR" onblur="selctPacCOde12();"/></td>
	<td><input name="require12" id="require12" type="text" value="<?php echo $row['require12']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading13" id="heading13" type="text" value="PACK" class=" textbox headeR" readonly /></td>
	<td><input name="detail13" id="detail13" type="text" value="Level A Military Packing" class="textbox" readonly /></td>
	<td><input name="table13" id="table13" type="text" value="Page J IX"  class="textbox" readonly /></td>
	<td><input name="code13" id="code13" type="text" value="<?php echo $row['code13']; ?>"  class="textbox headeR" onblur="selctPacCOde13();"/></td>
	<td><input name="require13" id="require13" type="text" value="<?php echo $row['require13']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading14" id="heading14" type="text" value="PACK" class="textbox headeR" readonly /></td>
	<td><input name="detail14" id="detail14" type="text" value="Level B Military Packing" class="textbox" readonly /></td>
	<td><input name="table14" id="table14" type="text" value="Page J IXa"  class="textbox" readonly /></td>
	<td><input name="code14" id="code14" type="text" value="<?php echo $row['code14']; ?>"  class="textbox headeR" onblur="selctPacCOde14();"/></td>
	<td><input name="require14" id="require14" type="text" value="<?php echo $row['require14']; ?>"  class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading15" id="heading15" type="text" value="PACK" class="textbox headeR" readonly /></td>
	<td><input name="detail15" id="detail15" type="text" value="Minimal Packing"  class="textbox" readonly /></td>
	<td><input name="table15" id="table15" type="text" value="Page J IXb" class="textbox" readonly /></td>
	<td><input name="code15" id="code15" type="text" value="<?php echo $row['code15']; ?>" class="textbox headeR" onblur="selctPacCOde15();"/></td>
	<td><input name="require15" id="require15" type="text" value="<?php echo $row['require15']; ?>" class="textbox headeTxt"/></td>

	</tr>
	<tr>
	<td><input name="heading16" id="heading16" type="text" value="SP MK" class="textbox headeR" readonly /></td>
	<td><input name="detail16" id="detail16" type="text" value="Special Marking"  class="textbox" readonly /></td>
	<td><input name="table16" id="table16" type="text" value="Page J X"  class="textbox" readonly /></td>
	<td><input name="code16" id="code16" type="text" value="<?php echo $row['code16']; ?>"  class="textbox headeR" onblur="selctPacCOde16();"/></td>
	<td><input name="require16" id="require16" type="text" value="<?php echo $row['require16']; ?>" class="textbox headeTxt"/></td>

	</tr>
			</tbody>
			
</table>	
</div>	
<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>
	<div style="margin:10px 0 10px 194px;">
	<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkUnitMaster();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
		
		<a href="view-custpurcOrder.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
		
		<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" onClick="self.close();" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button></a>
		
	</div>
		</td>
	</tr>
</table>

</form>	
</div>	
	</div>
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
<!-- scroll_top_btn END --> 
</body>
</html>