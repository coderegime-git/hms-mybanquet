<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");
?>
 <!--form validation-->	
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<script src="../../js/shortcut.js" type="text/javascript"></script>
<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	$(".datepicker" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});
	
	
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#hotelDefi").validationEngine();
	
	
	$("#vendor_code").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../../action/selectVENdorCdeCHkOut.php",
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

	
	$('input[name^=qty]').live('keyup', function() {
		qtyVal =parseInt($(this).val()); 
		unitval =parseInt($(this).parent().next().find('input').val());
		totAMt=(qtyVal*unitval);
		Amt =parseInt($(this).parent().next().next().find('input').val(totAMt));
		ttAmt=parseInt($(this).parent().next().next().find('input').val());
		if(isNaN(ttAmt)){ ttAmt=parseInt($(this).parent().next().next().find('input').val(0));}
		 lnTT=$(".lineTot").val();
		 if(lnTT=='NaN'){$(".lineTot").val('0');}
		totTot =0;
		$(".lineTot").each(function(){
			totTot +=parseFloat($(this).val());
		});
		 $(".balAmt").val(totTot.toFixed(2)); 
   });
	
	$('input[name^=rate]').live('keyup', function() {
		unitval=parseInt($(this).val()); 
		qtyVal=parseInt($(this).parent().prev().find('input').val());
		totAMt=(qtyVal*unitval);
		Amt =parseInt($(this).parent().next().find('input').val(totAMt));
		ttAmt=parseInt($(this).parent().next().find('input').val());
		if(isNaN(ttAmt)){ ttAmt=parseInt($(this).parent().next().find('input').val(0));	}
		totTot =0;
		lnTT=$(".lineTot").val();
		 if(lnTT=='NaN'){$(".lineTot").val('0');}
		  $(".lineTot").each(function(){
			totTot +=parseFloat($(this).val());
		  });
		 $(".balAmt").val(totTot.toFixed(2)); 
		
	});


});

 shortcut.add("Ctrl+S",function() { 
	 $('#hotelDefi').attr('action', '../../action/add_hotel_definition.php');  
	 $('#hotelDefi').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_hotel_definition.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#hotelDefi').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});

function checkPropertyCode(){
	propCode=$('#prop_code').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatPropertyCode.php',
			data:{
			propCode:propCode
			},
			success:function(data){
				 /* alert(data);  */
				if(data==1){
					alert('Property Code already exists!.');
					$('#prop_code').val('');
				}
				else{
				
				}
			}
	});
}

function selectVend(val) {
$("#vendor_code").val(val);
$("#suggesstion-box").hide();
}

var rowCount = 0; 
function addMoreRows() {
	paxNo=$('#pax').val();
	rowCount=rowCount+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsED tr').length+2;
	/* $('#addedRowsED').html(''); */
	/* for(i=0;i<paxNo;i++) { */
		var recRow = '<tr id="rowCount'+rowCount+'"><td width="" style="text-align:center;"><input name="sno[]" id="sno" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:40px;text-align:center;" value=""  /></td><td width="" style="text-align:center;" id="room'+rowCount+'" ><input name="particular[]" id="particular" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:401px;" value=""  /></td><td width="" style="text-align:center;" id="room'+rowCount+'" ><input name="patch_no[]" id="patch_no" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:110px;" value=""  /></td><td width="" style="text-align:center;" id="room'+rowCount+'" ><input name="qty[]" id="qty" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:75px;" value=""  /></td><td width="" style="text-align:center;" id="rate'+rowCount+'" ><input name="rate[]" id="rate" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:120px;" value=""  /></td><td width="" style="text-align:center;" id="room'+rowCount+'" ><input name="amount[]" id="amount" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase lineTot" style="width:120px;" value="" readonly  /></td><td><a href="javascript:void(0);" onclick="removeRow('+rowCount+');" name="remove['+rowCount+']" id="remove_'+ rowCount +'" class="deleterecord" width="15"><img src="../../images/removeicon.png" style="width:18px;height:18px;"/></a></td></tr>';

		jQuery('#addedRowsED').append(recRow); 
		$('#rowCount').val(rowCount);
	/* } */
}
	function removeRow(removeNum) {
		jQuery('#rowCount'+removeNum).remove(); 
	} 

function checkBillBtn() {
	$("#whleButton").show();
	$("#BillButton").hide();
}

function checkCheOutCash(){
	$(".checkoutCash").show();
	$(".checkoutCARD").hide();
	$(".checkoutCompany").hide();
	$(".checkoutCHEque").hide();
	$("#checkoutREFUND").hide();
	$(".checkoutNEFT").hide();
	val=$("#cash").val();
	$("#pay_mode").val(val);
	
	Bval=parseFloat($("#bill_amt").val());
	$("#cashbill_amt").val(Bval);
	
	csBill=$("#cashbill_amt").val();
	if(csBill=='NaN'){$("#cashbill_amt").val('');}
	
	$("#submit").removeAttr('disabled', true);
}

function checkCheOutCard(){
	$("#checkoutCash").hide();
	$("#checkoutCARD").show();
	$("#checkoutCompany").hide();
	$("#checkoutCHEque").hide();
	$("#checkoutREFUND").hide();
	$("#checkoutNEFT").hide();
	val=$("#card").val();
	$("#pay_mode").val(val);
	Bval=parseFloat($("#bill_amt").val());
	$("#cardbill_amt").val(Bval);
	csBill=$("#cardbill_amt").val();
	if(csBill=='NaN'){$("#cardbill_amt").val('');}
	$("#submit").removeAttr('disabled', true);
}
function checkCheOutCompany(){
	$("#checkoutCash").hide();
	$("#checkoutCARD").hide();
	$("#checkoutCompany").show();
	$("#checkoutCHEque").hide();
	$("#checkoutREFUND").hide();
	$("#checkoutNEFT").hide();
	val=$("#company").val();
	$("#pay_mode").val(val);
	Bvall=parseFloat($("#bill_amt").val());
	parseFloat($("#compbill_amt").val(Bvall));
	csBill=$("#compbill_amt").val();
	if(csBill=='NaN'){$("#compbill_amt").val('');}
}
function checkCheOutCheq(){
	$("#checkoutCash").hide();
	$("#checkoutCARD").hide();
	$("#checkoutCompany").hide();
	$("#checkoutCHEque").show();
	$("#checkoutREFUND").hide();
	$("#checkoutNEFT").hide
	val=$("#cheque").val();
	$("#pay_mode").val(val);
	Bval=parseFloat($("#bill_amt").val());
	$("#cheqbill_amt").val(Bval);
	csBill=$("#cheqbill_amt").val();
	if(csBill=='NaN'){$("#cheqbill_amt").val('');}
} 
 function checkCheOutNEFT(){
	$("#checkoutCash").hide();
	$("#checkoutCARD").hide();
	$("#checkoutCompany").hide();
	$("#checkoutCHEque").hide();
	$("#checkoutREFUND").hide();
	$("#checkoutNEFT").show();
	val=$("#neft").val();
	$("#pay_mode").val(val);
	Bval=parseFloat($("#bill_amt").val());
	$("#neftbill_amt").val(Bval);
	
	csBill=$("#neftbill_amt").val();
	if(csBill=='NaN'){$("#neftbill_amt").val('');}
} 
function checkCheOutREFUND(){
	$("#checkoutCash").hide();
	$("#checkoutCARD").hide();
	$("#checkoutCompany").hide();
	$("#checkoutCHEque").hide();
	$("#checkoutNEFT").hide();
	$("#checkoutREFUND").show();
	val=$("#refund").val();
	$("#pay_mode").val(val);
	$("#balance_amt").val('0');
	$("#submit").removeAttr('disabled', true);
} 

function popupBillPrint()
{
billNo=$("#bill_no").val();
	
newwindow=window.open('<?php echo $home_path;?>/transaction/view/bill-print.php?billNo='+billNo,"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
newwindow.focus(); 
}

</script> 
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<body class="bgBODY">
<div class="about">
<div id="invoice" style="border:1px solid #ddd;margin:0 0 0 325px">
	<!--<div class="container" >-->
		<div class="col-md-9" >
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
<style>
.spanClr{
	color: #5b503b;
    display: block;
    float: left;
    font-size: 12px;
    font-weight: normal;
    padding: 0px 9px 0 5px;
		
}

.button_bill{
font-size:12px;font-family:arial, helvetica, sans-serif;
/* text-decoration:none; */
 color: #000;
  background-color: #ffffff; 
 margin-left:-3px;
 border:1px solid #ddd;
/*  padding:0 30px; */
 padding:4px 80px;
}


.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;position: absolute;z-index: 1;}
#country-list li{padding: 3px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 3px;border: #F0F0F0 1px solid;}

</style>
			
	<div id="addcustomer" style="border:1px solid #ddd;width:897px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Billing</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_bill_generate.php" method="post" class="" style="">
		<input type="hidden" name="pay_mode" id="pay_mode" value="" class="" value=""/>
		<input type="hidden" name="bill_no" id="bill_no" value="<?php echo getCheckOutBillNumber();?>" class="" />
		<div>
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
						<td width="" valign="top"><label>Vendor Code<em>*</em></label></td>
						<td valign="top"><input name="vendor_code" id="vendor_code" type="text" data-validation="required" class="input validate[required] codesUPPERCase"  style="width:210px"/>
						<div id="suggesstion-box"></div>
						</td>
     			</tr>
				<tr>
						<td width="" valign="top"><label>Bill Date<em>*</em></label></td>
						<td valign="top"><input name="bill_date" id="bill_date" type="text" data-validation="required" class="input validate[required] codesUPPERCase datepicker" style="width:210px"/>
						</td>
     			</tr>
					</tbody>
				</table>
				<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
						<td width="" valign="top"><label>DC Number<em>*</em></label></td>
						<td valign="top"><input name="prop_code" id="prop_code" type="text" class="codesUPPERCase" onblur="checkPropertyCode();" style="width:210px"/>
						</td>
				</tr>
					</tbody>
				</table>
					
<table style="width:50%;margin:4px 0 0 0;" class="table">
	<tbody>
<tr>
		<th width="" style="text-align:center;background-color:#F5F5F5;">S.No.</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Particulars</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Patch No</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Qty</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Rate</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Amount&nbsp;&nbsp;</th>
		<th><img src="../../images/plus.png" id="add-item" onclick="addMoreRows(this.form);" style="width:20px;height:20px;cursor:pointer;"/></th>
</tr>
	<tr id="billdisp">
			<td width="" style="text-align:center;"><input name="sno[]" id="sno" type="text" class="fstChUPPRCase" style="width:40px;text-align:center;" value="1"  /></td>
			<td width="" style="text-align:center;"><input name="particular[]" id="particular" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:401px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="patch_no[]" id="patch_no" type="text" class="fstChUPPRCase" style="width:110px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="qty[]" id="qty" type="text" data-validation="required" class="input validate[required] fstChUPPRCase" style="width:75px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="rate[]" id="rate" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:120px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="amount[]" id="amount" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase lineTot" style="width:120px;" value="0.00" readonly /></td>
</tr>
<tr id="billdisp">
			<td width="" style="text-align:center;"><input name="sno[]" id="sno" type="text" class="fstChUPPRCase" style="width:40px;text-align:center;" value="2"  /></td>
			<td width="" style="text-align:center;"><input name="particular[]" id="particular" type="text" class="fstChUPPRCase" style="width:401px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="patch_no[]" id="patch_no" type="text class="fstChUPPRCase" style="width:110px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="qty[]" id="qty" type="text" class="fstChUPPRCase" style="width:75px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="rate[]" id="rate" type="text" class="fstChUPPRCase" style="width:120px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="amount[]" id="amount" type="text"  class="fstChUPPRCase lineTot" style="width:120px;" value="0.00" readonly /></td>
</tr>
<tr id="billdisp">
			<td width="" style="text-align:center;"><input name="sno[]" id="sno" type="text" class="fstChUPPRCase" style="width:40px;text-align:center;" value="3"  /></td>
			<td width="" style="text-align:center;"><input name="particular[]" id="particular" type="text" class="fstChUPPRCase" style="width:401px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="patch_no[]" id="patch_no" type="text" class="fstChUPPRCase" style="width:110px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="qty[]" id="qty" type="text" class="fstChUPPRCase" style="width:75px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="rate[]" id="rate" type="text"  class="fstChUPPRCase" style="width:120px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="amount[]" id="amount" type="text" class=" fstChUPPRCase lineTot" style="width:120px;" value="0.00" readonly /></td>
</tr>
<tr id="billdisp">
			<td width="" style="text-align:center;"><input name="sno[]" id="sno" type="text"  class="fstChUPPRCase" style="width:40px;text-align:center;" value="4"  /></td>
			<td width="" style="text-align:center;"><input name="particular[]" id="particular" type="text" class="fstChUPPRCase" style="width:401px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="patch_no[]" id="patch_no" type="text" class="fstChUPPRCase" style="width:110px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="qty[]" id="qty" type="text" class="fstChUPPRCase" style="width:75px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="rate[]" id="rate" type="text" class="fstChUPPRCase" style="width:120px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="amount[]" id="amount" type="text" class="fstChUPPRCase lineTot" style="width:120px;" value="0.00" readonly /></td>
</tr>
<tr id="billdisp">
			<td width="" style="text-align:center;"><input name="sno[]" id="sno" type="text"  class="fstChUPPRCase" style="width:40px;text-align:center;" value="5"  /></td>
			<td width="" style="text-align:center;"><input name="particular[]" id="particular" type="text" class="fstChUPPRCase" style="width:401px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="patch_no[]" id="patch_no" type="text"class="fstChUPPRCase" style="width:110px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="qty[]" id="qty" type="text" class="fstChUPPRCase" style="width:75px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="rate[]" id="rate" type="text" class="fstChUPPRCase" style="width:120px;" value="" /></td>
			<td width="" style="text-align:center;"><input name="amount[]" id="amount" type="text" class="fstChUPPRCase lineTot" style="width:120px;" value="0.00" readonly /></td>
</tr>

<tbody id="addedRowsED">

</tbody>
</table>



<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 0px;" id="BillButton">
		<!--<button type="button" id="bill" value="bill" class="buttExam_sngl bnkSbt frstChr" style="" onclick="checkBillBtn();">Bill</button>-->
		<input name="balance_amt" id="balance_amt" type="text" class="fstChUPPRCase balAmt" style="width:99px;height:27px;margin:0 0 0 764px;" value="" placeholder="Bill Amount" readonly />		
	</div>	
	<!--<div style="margin:0px 0 0 0px;display:none;" id="whleButton">
		<button type="button" id="cash" value="cash" class="buttExam_sngl bnkSbt frstChr" style="" onclick="checkCheOutCash();">Cash</button>
		<button type="button" id="card" value="credit" class="buttExam_sngl bnkSbt" onclick="checkCheOutCard();">Credit</button>
		<input name="balance_amt" id="balance_amt" type="text" class="fstChUPPRCase balAmt" style="width:108px;height:27px;margin:0 0 0 263px;" value="" placeholder="Balance Amount" readonly />		
	</div>-->
	</td>
	</tr>
	</table>


<!--<table style="float:left;width:100%;margin:4px 0 0 0;display:none;" id="checkoutCash" cellpadding="0" cellspacing="0" class="table checkoutCash" border="0" >
			<tbody>
				<tr>
					<td width="60" valign="top"><label style="float:right;width:51px;margin:0 0 0 6px;">Bill Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;width:110px;">
					<input name="cashbill_amt" id="cashbill_amt" type="text" data-validation="required" value="" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:92px;margin:0 0 0 6px;">Received Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="cashrcd_amt" id="cashrcd_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" onkeyup="checkRcvdAmt();" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:52px;margin:0 0 0 6px;">Balance<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="cashbal_amt" id="cashbal_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:56px;margin:0 0 0 6px;">Remarks<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="pdoutremarks" id="cash_remarks" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
				</tr>
			</table>
			
		<table style="float:left;width:100%;margin:4px 0 0 0;display:none;" id="checkoutCARD" cellpadding="0" cellspacing="0" class="table checkoutCARD" border="0" >
			<tbody>
				<tr>
					<td width="60" valign="top"><label style="float:right;width:51px;margin:0 0 0 6px;">Bill Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;width:110px;">
					<input name="cardbill_amt" id="cardbill_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:63px;margin:0 0 0 6px;">Rcvd Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="cardrcd_amt" id="cardrcd_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:23px;margin:0 0 0 6px;">Bal<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="cardbal_amt" id="cardbal_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:56px;margin:0 0 0 6px;">Card No<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="cardNo" id="cardNo" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:56px;margin:0 0 0 6px;">Remarks<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="pdoutremarks" id="card_remarks" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
				</tr>
			</table>
			
			<table style="float:left;width:100%;margin:4px 0 0 0;display:none;" id="checkoutCompany" cellpadding="0" cellspacing="0" class="table checkoutCompany" border="0" >
			<tbody>
				<tr>
					<td width="60" valign="top"><label style="float:right;width:57px;margin:0 0 0 6px;">Company<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;width:110px;">
					<?php /* $sqlBS=mysql_query("select distinct comp_code,comp_name from company_master where status='1'"); */?>
							<select name="companyName" id="companyName" style="width:100px;" class="fstChUPPRCase" onchange="selCOMpName();">
							<option value="">--Select--</option>
							<?php/*  while($rowBS=mysql_fetch_array($sqlBS)) { */ ?>
							<option value="<?php /* echo $rowBS['comp_code']; */?>"><?php /* echo $rowBS['comp_code']; */?></option>
							<?php /* } */ ?>
							</select>
					</td>
					<td width="60" valign="top"><label style="float:right;width:51px;margin:0 0 0 6px;">Bill Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;width:110px;">
					<input type="text" name="compbill_amt" id="compbill_amt" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:75px;" value="" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:63px;margin:0 0 0 6px;">Rcvd Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input  type="text"  name="comprcd_amt" id="comprcd_amt"data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:75px;" value="" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:23px;margin:0 0 0 6px;">Bal<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input type="text" name="compbal_amt" id="compbal_amt"  data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:75px;" value="" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:56px;margin:0 0 0 6px;">Remarks<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input type="text" name="pdoutremarks" id="compremarks"  data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:75px;" value="" />
					</td>
				</tr>
			</table>
			
			<table style="float:left;width:100%;margin:4px 0 0 0;display:none;" id="checkoutCHEque" cellpadding="0" cellspacing="0" class="table checkoutCHEque" border="0" >
			<tbody>
				<tr>
					<td width="60" valign="top"><label style="float:right;width:51px;margin:0 0 0 6px;">Bill Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;width:110px;">
					<input name="cheqbill_amt" id="cheqbill_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:63px;margin:0 0 0 6px;">Rcvd Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="cheqrcd_amt" id="cheqrcd_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:23px;margin:0 0 0 6px;">Bal<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="chebal_amt" id="chebal_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:56px;margin:0 0 0 6px;">Chq No<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="cheque_no" id="cheque_no" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:56px;margin:0 0 0 6px;">Remarks<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="pdoutremarks" id="cheque_rem" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
				</tr>
			</table>
			
				
			<table style="float:left;width:100%;margin:4px 0 0 0;display:none;" id="checkoutNEFT" cellpadding="0" cellspacing="0" class="table checkoutNEFT" border="0" >
			<tbody>
				<tr>
					<td width="60" valign="top"><label style="float:right;width:51px;margin:0 0 0 6px;">Bill Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;width:110px;">
					<input name="neftbill_amt" id="neftbill_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:63px;margin:0 0 0 6px;">Rcvd Amt<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="neftrcd_amt" id="neftrcd_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:23px;margin:0 0 0 6px;">Bal<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="neftrcd_bal" id="neftrcd_bal" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:56px;margin:0 0 0 6px;">Ref No<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="neftref_no" id="neftref_no" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:56px;margin:0 0 0 6px;">Remarks<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="pdoutremarks" id="neft_rem" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:80px;" value="" />
					</td>
				</tr>
			</table>-->

				
								
						
				</tbody>
			</table>
			</div>
	
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 0px;">
		<button type="submit" id="submit" class="button_bill bnkSbt frstChr" style="" onclick="popupBillPrint();" ><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-bill-receipt.php"><button type="button" id="update" class="button_bill bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="button_bill" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_bill" style=""><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
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