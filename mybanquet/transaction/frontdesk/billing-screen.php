<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<style>
.buttexample {
background-color: #ffffff;
border: 1px solid #ddd;
color: #000;
font-family: arial,helvetica,sans-serif;
font-size: 12px;
margin-left: -3px;
padding: 4px 55px;
}

.sbtBImg{
	width:18px;
	height:18px;
	
}

.buttExaSS {
    background-color: #ffffff;
    border: 1px solid #888888;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
   /*  margin-left: -3px; */
    padding: 7px 0px;
    /* padding: 5px 59px; */
	width:130px;
}
</style>
<!--form validation-->	
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-customValidations.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-debugger.js"></script>

<script src="../../js/shortcut.js" type="text/javascript"></script>
<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	$('form[name="hotelDefi"]').validVal().validValDebug();
	$('form[name="hotelDefi"]').validVal();
	
	
	$("#disc_amount").keyup(function(){
		disVal =parseInt($(this).val()); 
		
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

function chKtableNO(){
	tableNo=$('#table_no').val();
	
	$.ajax({
		type:'GET',
		url:'  ../../action/selchKKOTBillDet.php',
			data:{
			tableNo:tableNo
			},
			success:function(data){
				 /* alert(data); */
				if(data==1){
					 alert('Table does not exists.');
				 }else{				 
				 $('#blScrnN').hide();
				 $('#blScrn').show();
				 opt=data.split(',');
				 $('#blScrn').html(opt[0]);
				 $('#bill_ste').val(opt[1]);
				 }
			}
	});
}
</script> 
<body class="bgBODY">

<div class="">

<div id="invoice" style="">
		
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
</style>
<?php

$sqlM=mysql_query("select * from pos_kotbill where kotbill_id=(select max(kotbill_id)AS MaxId from pos_kotbill)");
$rowM=mysql_fetch_array($sqlM);
?>	
	<div id="addcustomer" class="frmCentr divBrd" style="width:850px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Billing Screen</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_bill_screen.php" method="post" class="" style="">
		<div>
		
		<table style="width:100%;border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;margin:3px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Outlet<em>*</em></label></td>
						<td valign="top"><input name="bill_outlet" id="bill_outlet" type="text" class="input required textbox codesUPPERCase" style="width:100px;margin:3px 0 0 10px;" value="<?php if(isset($rowM['kot_outlet'])){echo $rowM['kot_outlet'];}?>" readonly /><label style="border:1px solid #8C8C8C;color: #474747;display: block;float: right;font-size: 12px;font-weight: normal; padding: 0px 4px 1px 4px;margin:4px 0 0 0;" onclick="outletOpen();"><span class="btnUndLine">C</span>H</label>
						</td>
					<td width="" valign="top"><label>Session<em>*</em></label></td>
					<td valign="top"><input name="bill_sess" id="bill_sess" type="text" class="input required textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" value="<?php if(isset($rowM['kot_session'])){echo $rowM['kot_session'];}?>" readonly /></td>
					<td width="" valign="top"><label>Covers<em>*</em></label></td>
						<td valign="top"><input name="bill_cov" id="bill_cov" type="text" class="input required textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" /></td>
						<!--<td width="" valign="top"><label>Steward</label></td>
						<td valign="top"><input name="bill_ste" id="bill_ste" type="text" class="textbox fstChUPPRCase required" style="width:100px;margin:3px 0 0 10px;" /></td>-->
					</tr>
					</tbody>
				</table>
				
			<table style="width:100%;border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
				<td width="" valign="top" style=""><label>Table<em>*</em></label></td>
						<td valign="top"><input name="table_no" id="table_no" type="text" class="input required textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" onblur="chKtableNO();" />
						
						
						</td>
		<td width="" valign="top"><label style="margin:0 0 0 26px;">Steward</label></td>
		<td valign="top"><input name="bill_ste" id="bill_ste" type="text" class="textbox fstChUPPRCase required" style="width:100px;margin:3px 0 0 10px;" /></td>
					<!--<td><label>Discount</label></td>
					<td width="" valign="top"><input name="disc" id="disc_perc" type="radio" value="higher" class="textbox fstChUPPRCase" style="width:10px;margin:0px;" checked /><span class="spanClr" style="vertical-align:bottom;">Percentage</span>
					<input name="disc" id="disc_amt" type="radio" value="nearer" class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Amount</span><span class="spanClr">Dis. amt.</span>
					<input name="disc_amount" id="disc_amount" type="text" style="width:35px;margin:2px 0 0 0;" class="textbox fstChUPPRCase"/></td>-->
		<td width="" valign="top"><label style="margin:0 0 0 -14px;">Members<em>*</em></label></td>
		<td valign="top"><input name="members" id="members" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:100px;margin:2px 0 0 0;" /></td>
					</tr>
					</tbody>
				</table>
				
				
			<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 0px 0px;text-align:center;font-size:12px;">
	<tr>
		<th width="40" style="text-align:center;background-color:#F5F5F5;">S.No.</th>
		<th width="40" style="text-align:center;background-color:#F5F5F5;">Kot #</th>
		<th width="220" style="text-align:center;background-color:#F5F5F5;">Item Name</th>
		<th width="40" style="text-align:center;background-color:#F5F5F5;">Qty</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Rate</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Total</th>
		<th width="40" style="text-align:center;background-color:#F5F5F5;">D.Flag</th>
		<th width="50" style="text-align:center;background-color:#F5F5F5;">D.Amt</th>
		<th width="50" style="text-align:center;background-color:#F5F5F5;">Tax</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Net Amount</th>
		<th width="20" style="text-align:center;background-color:#F5F5F5;">Split</th>
	</tr>
	<tbody id="blScrnN">
	<?php for($i=0;$i<10;$i++) { ?>
	<tr>
		<td width="40" style="text-align:center;"></td>
		<td width="40"></td>
		<td width="220" class="codesUPPERCase"></td>
		<td width="40" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="40" class="fstChUPPRCase"></td>
		<td width="50" class="fstChUPPRCase"></td>
		<td width="50" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="20" class="fstChUPPRCase"></td>
	</tr>
	<?php } ?>
	</tbody>
	</table>
	
<table style="width:100%;" cellpadding="0" cellspacing="0" border="0" >
	<tbody id="blScrn">
	</tbody>
	<!--<tr>
		<td width="40" style="text-align:center;"></td>
		<td width="80"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase"><input type="text" style="width:47px;"/></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"><input type="text" style="width:92px;"/></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"><input type="text" style="width:57px;"/></td>
		<td width="80" class="fstChUPPRCase"><input type="text" style="width:57px;"/></td>
		<td width="80" class="fstChUPPRCase"><input type="text" style="width:89px;"/></td>
		<td width="80" class="fstChUPPRCase"></td>
		
	</tr>-->
</table>

<div style="width:8.%;float:left;margin:0px 0 0 0px;">
<table style="margin:0 0 0 0px;">
<tr>
<td>
	<a href="#"><button type="button" id="submit" class="buttExaSS bnkSbt frstChr submit" style="" >&nbsp;&nbsp;<span class="btnUndLine">P</span>rint</button></a>
</td>
</tr>
<tr>
<td>
<a href="#"><button type="button" id="printFlio" class="buttExaSS" style="" onclick="cancel_ed()">&nbsp;&nbsp;<span class="btnUndLine">L</span>ast Bill</button></a>
</td>
</tr>

<tr>
<td>
<a href="#"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<span class="btnUndLine">T</span>ax Excemption</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/settlement-bill.php"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<<span class="btnUndLine">F6</span>>Settle</button></a>

</td>
</tr>
<tr>
<td>
<a href="#">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
</a>
</td>
</tr>
<tr>
<td>
<a href="#">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button>
</a>
</td>
</tr>
</table>
</div>
</div>
	

<table style="border:1px solid #ddd;float:right;width:22%;" class="table table-condensed table-hover table-striped table-bordered">
<thead>
<tr>
<th style="width:50px;font-size:12px;text-align:center;">Bill#</th>
<th style="width:85px;font-size:12px;text-align:center;">Amount</th>
<th style="width:50px;font-size:12px;text-align:center;">Print</th>
</tr>
</thead>
<?php for($i=0;$i<4;$i++){?>
<tr>
<td></td>
<td></td>
<td><input type="text" id="" name="" class="textbox" value="Yes" style="width:30px;height:10px;border:none;"/></td>
</tr>
<?php } ?>
</table>
<script>
function discPercCal(){
	$('.disamt').hide();
	$('.disper').show();
	$('#disc_amount').show();
}
function discAmountCal(){
	$('.disamt').show();
	$('.disper').hide();
	$('#disc_amount').show();
}
function grpDiscount(){
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/cHKgrpDiscountOpn.php','mywin','left=280,top=250,width=400,height=370,');
	newwindow.focus();
}
</script>

<table style="border:1px solid #ddd;width:21%;margin:0 0px 0 13px;" class="table table-condensed table-hover table-striped table-bordered">
<thead>
<tr>
<td style="font-weight:bold;text-align:center;font-size:12px;">Discount</td>
</tr>
<tr>
<td width="" valign="top"><label style="float:left;color:#000;">Members<em>*</em></label><input name="members" id="members" type="text" class="input required textbox fstChUPPRCase" style="width:100px;margin:2px 0 0 0;" /></td>
</tr>
<tr>
<td width="" valign="top"><input name="disc" id="disc_perc" type="radio" value="higher" class="textbox fstChUPPRCase" style="width:10px;margin:0px;" onclick="discPercCal();" checked /><span class="spanClr" style="vertical-align:bottom;color:#000;">Percentage</span></td>
</tr>
<tr>
<td><input name="disc" id="disc_amt" type="radio" value="nearer" style="width:10px;margin:0px;" onclick="discAmountCal();" /><span class="spanClr" style="color:#000;">Amount</span><span class="spanClr disamt" style="display:none;color:#000;">Dis. amt.</span><span class="spanClr disper" style="color:#000;" >Dis. %.</span>
<input name="disc_amount" id="disc_amount" class="disc_amount" type="text" style="width:35px;margin:2px 0 0 0;border:1px solid #8C8C8C;" class="textbox"/></td>
</tr>

<tr>
<td><input name="disc" id="disc_amt" type="checkbox" value="nearer" class="textbox fstChUPPRCase" style="width:10px;margin:0px;" onclick="grpDiscount();" /><span class="spanClr" style="color:#000;">Group Discount</span>
</td>
</tr>
</table>	


<table style="border:1px solid #ddd;width:21%;margin:0 0px 0 13px;" class="table table-condensed table-hover table-striped table-bordered">
<thead>
<tr>
<td style="font-weight:bold;text-align:center;font-size:12px;">Table Link</td>
</tr>
<tr>
<td width="" valign="top"><label style="float:left;color:#000;">Table #<em>*</em></label><input name="linktbl" id="linktbl" type="text" class="input required textbox fstChUPPRCase" style="width:100px;margin:2px 0 0 0;" /></td>
</tr>
</table>	
<!--<table style="border-left:1px solid #ddd;margin:7px 0 0 0;width:100%;" class="">
<tr>
	<td>	
<div style="margin:10px 0 -16px 0px;">
	<a href="#"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<span class="btnUndLine">T</span>ax Excemption</button></a>

		<a href="#"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<span class="btnUndLine">L</span>ast Bill</button></a>
	<a href="#"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<<span class="btnUndLine">F6</span>Settle</button></a>
		
	<a href="#"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<<span class="btnUndLine">F9</span>>Link Table</button></a>
	<a href="#">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">F4</span>Void</button>
</a>

</div>
</td>
</tr>


<tr>
	<td>	
<div style="margin:10px 0 -16px 0px;">
	<button type="submit" id="add" class="buttexample bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/imprimer.png" class="sbtBImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">P</span>rint</button>
	
	<a href="#">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">F2</span>Cash</button>
	
	<a href="#">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">F3</span>Card</button>
</a>
	
	<a href="<?php /* echo $home_path; */ ?>/transaction/frontdesk/kot-billscreen.php"><button type="button" id="update" class="buttExaSS bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/clear-icon.png" class="sbtBImg "/>&nbsp;&nbsp;<span class="btnUndLine">C</span>lear </button></a>
		
	<a href="<?php /* echo $home_path; */ ?>/transaction/frontdesk/settlement.php"><button type="button" id="button" class="buttExaSS" style="" onclick="cancel_ed()"><img src="../../images/exitBut.png" class="sbtBImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button>
</div>
</td>
</tr>
</table>-->	
	</form>	

</div>
<!--<table style="width:60px;float:right;margin:0 -128px 0 0;" cellpadding="0" cellspacing="0" class="" border="1" >
<tbody>
<tr>
<td colspan="5">
<h3 style="text-align:center;font-size:14px;padding:10px;background:#ffffff;color:#640E27;margin:1px 0 0 0;text-transform:uppercase;"><b>HOTEL MYHOTEL</b></h3>
</td>
</tr>
<tr>
<td><input type="button" value="Table No" style="padding:5px 7px 5px 7px;"/></td>
<td><input type="button" value="Steward" style="padding:5px 29px 5px 29px;"/></td>
<td><input type="button" value="Amount" style="padding:5px 12px 5px 12px;"/></td>
</tr>
<tr>
<td><input type="text" value="" style="padding:0px 0px 0px 0px;width:54px;border:none;"/></td>
<td><input type="text" value="" style="padding:0px 0px 0px 0px;width:54px;border:none;"/></td>
<td><input type="text" value="" style="padding:0px 0px 0px 0px;width:54px;border:none;"/></td>
</tr>
</tbody>
</table>-->
	</div>
	
	</div>
	
	

				
				
</body>
</html>