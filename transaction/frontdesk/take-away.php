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
padding: 4px 49px;
}

.sbtBImg{
	width:22px;
	height:22px;
	
}

.buttExaSS {
    background-color: #ffffff;
    border: 1px solid #888888;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
   /*  margin-left: -3px; */
    padding: 9px 0px;
    /* padding: 5px 59px; */
	width:160px;
}
</style>


 <!--form validation-->	
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<script src="../../js/shortcut.js" type="text/javascript"></script>
<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#hotelDefi").validationEngine();

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
</script> 
<body class="bgBODY">
<!--<div style="width:8.%;float:left;margin:0px 0 0 11px;">
<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;">&nbsp;</h3>

<table style="margin:0 0 0 0px;">

<tr>
<td>
	<a href="<?php /* echo $home_path; */?>/transaction/frontdesk/billing-screen.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="submit" class="buttExaSS bnkSbt frstChr submit" style="" >&nbsp;&nbsp;<<span class="btnUndLine">F5</span>>Bill</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/settlement.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="printFlio" class="buttExaSS" style="" onclick="cancel_ed()">&nbsp;&nbsp;<<span class="btnUndLine">F6</span>>Settle</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/pax_addremove.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<<span class="btnUndLine">F9</span>>Cash</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/link_room.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt" onclick="popupBillPrint('<?php echo $_GET['reg_num'];?>');">&nbsp;&nbsp;<<span class="btnUndLine">F10</span>>Card</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/refund.php?romNo=<?php echo $rowRr['room_no'];?>">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">P</span>ending KOT</button>
</a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/charges.php?romNo=<?php echo $rowRr['room_no'];?>">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">NC</span>KOT</button>
</a>
</td>
</tr>

</table>

</div>-->
<div class="col-sm- about">

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
			
	<div id="addcustomer" class="frmCentr divBrd" style="width:850px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>K.O.T</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_property_definition.php" method="post" class="" style="">
		<div>
		
		<table style="width:100%;border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;margin:3px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Outlet<em>*</em></label></td>
						<td valign="top"><input name="prop_code" id="prop_code" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" style="width:100px;margin:3px 0 0 10px;"/>
						<input name="prop_code" id="prop_code" type="text" class="input validate[required] textbox codesUPPERCase" value="F" style="width:50px;text-align:center;margin:3px 0 0 10px;" readonly />
						</td>
					<td width="" valign="top"><label>Session<em>*</em></label></td>
					<td valign="top"><input name="prop_name" id="prop_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;"/></td>
					<td width="" valign="top"><label>Date<em>*</em></label></td>
						<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" /></td>
						<td width="" valign="top"><label>Type</label></td>
						<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" /></td>
						
					</tr>
									
					</tbody>
				</table>
				
			<table style="width:100%;border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Kot #<em>*</em></label></td>
						<td valign="top"><input name="prop_code" id="prop_code" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" style="width:100px;margin:4px 0 0 0;"/>
						
						</td>
					<td width="" valign="top"><label>Table #<em>*</em></label></td>
					<td valign="top"><input name="prop_name" id="prop_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:100px;margin:4px 0 0 0;"/></td>
					<td width="" valign="top"><label>Covers<em>*</em></label></td>
						<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:100px;margin:4px 0 0 0;" /></td>
						<td width="" valign="top"><label>Steward</label></td>
						<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:100px;margin:4px 0 4px 0;" /></td>
						
					</tr>
				
					<!--<tr>
						<td width="" valign="top"><label>Name<em>*</em></label></td>
						<td valign="top"><input name="prop_code" id="prop_code" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" style="width:100px;margin:4px 0 0 0;"/>
						
						</td>
					<td width="" valign="top"><label>Mobile<em>*</em></label></td>
					<td valign="top"><input name="prop_name" id="prop_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:100px;margin:4px 0 0 0;"/></td>
					</tr>-->
									
					</tbody>
				</table>
				
				
			<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 0px 0px;text-align:center;font-size:12px;">
	<tr>
		<th width="40" style="text-align:center;background-color:#F5F5F5;">S.No.</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Item Code</th>
		<th width="180" style="text-align:center;background-color:#F5F5F5;">Description</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Qty</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Item Rate</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Value</th>
		<th width="180" style="text-align:center;background-color:#F5F5F5;">Preferences</th>
	</tr>
	
	<tr>
		<td width="40" style="text-align:center;"></td>
		<td width="80"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		
	</tr>
	<tr>
		<td width="80" style="text-align:center;"></td>
		<td width="80"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		
	</tr>
	<tr>
		<td width="80" style="text-align:center;"></td>
		<td width="80"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		
	</tr>
	<tr>
		<td width="80" style="text-align:center;"></td>
		<td width="80"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		
	</tr>
	<tr>
		<td width="80" style="text-align:center;"></td>
		<td width="80"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		
	</tr>
	<tr>
		<td width="80" style="text-align:center;"></td>
		<td width="80"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		
	</tr>

</table>
<table class="" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 0px 0px;text-align:center;font-size:12px;width:350px;float:left;">
<tr>
	<td width="" valign="top"><label>Reg #<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
	
	<td width="" valign="top"><label>Guest Name<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
</tr>
</table>
<table class="" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:125px 0 0px 0px;text-align:center;font-size:12px;width:350px;float:right;">

<tr>
	<td width="" valign="top"><label>Total Qty<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
	
	<td width="" valign="top"><label>Sub Total<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td width="" valign="top"><label>Tax<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td width="" valign="top"><label>Disc<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td width="" valign="top"><label>Total<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
</tr>
</table>

<div style="width:8.%;float:left;margin:20px 0 0 11px;">
<table style="margin:0 0 0 0px;">
<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/settlement.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="printFlio" class="buttExaSS" style="" onclick="cancel_ed()">&nbsp;&nbsp;<<span class="btnUndLine">F6</span>>Settle</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/pax_addremove.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<<span class="btnUndLine">F9</span>>Cash</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/link_room.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt" onclick="popupBillPrint('<?php echo $_GET['reg_num'];?>');">&nbsp;&nbsp;<<span class="btnUndLine">F10</span>>Card</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/refund.php?romNo=<?php echo $rowRr['room_no'];?>">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">P</span>ending KOT</button>
</a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/charges.php?romNo=<?php echo $rowRr['room_no'];?>">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">NC</span>KOT</button>
</a>
</td>
</tr>

</table>

</div>
	

</div>
	

	
	
<table style="border-left:1px solid #ddd;margin:117px 0 0 0;width:100%;" class="">
<tr>
	<td>	
<div style="margin:0px 0 -22px 0px;">
	<button type="submit" id="add" class="buttexample bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/saves.png" class="sbtBImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ave</button>
	
	<button type="submit" id="add" class="buttexample bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/modify2.jpg" class="sbtBImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">M</span>odify</button>
	
	<button type="submit" id="add" class="buttexample bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/del.png" class="sbtBImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">D</span>elete</button>
	
	<a href="<?php echo $home_path; ?>/transaction/frontdesk/kot-billscreen.php"><button type="button" id="update" class="buttexample bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/clear-icon.png" class="sbtBImg "/>&nbsp;&nbsp;<span class="btnUndLine">C</span>lear </button></a>
		
	<a href="<?php echo $home_path; ?>/transaction/frontdesk/settlement.php"><button type="button" id="button" class="buttexample" style="" onclick="cancel_ed()"><img src="../../images/exitBut.png" class="sbtBImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button>
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