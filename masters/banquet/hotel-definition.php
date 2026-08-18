<?php
ob_start();
include("../../config.php");
include("../../header.php");
/* include("../../menu.php"); */
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
/* (function($) {
	window.addEvent('domready',function() {
		$('content-box').addEvent('keydown',function(event) {
			if((event.control || event.meta) && event.key == 'b') {
				event.stop();
				$('propmaster').submit();
			}
		});
	});
});
 */
function checkPropertyCode(){
	propCode=$('#prop_code').val();
	$.ajax({
		type:'GET',
		url:'  ../action/repeatPropertyCode.php',
			data:{
			propCode:propCode
			},
			success:function(data){
				 /* alert(data);  */
				if(data==1){
					$('#msgFoprop').html('* Property Code already exists.');
					$('#prop_code').val('');
				}
				else{
					$('#msgFoprop').html('');
				}
			}
	});
}



</script> 
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
</style>
			
	<div id="addcustomer" style="border:1px solid #ddd;width:698px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Property Definition</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_hotel_definition.php" method="post" class="" style="">
		<div>
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Property Code<em>*</em></label></td>
						<td valign="top"><input name="prop_code" id="prop_code" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" style="width:210px"/>
						</td>
						
						
				</tr>
				<tr>
					<td width="" valign="top"><label>Name <em>*</em></label></td>
					<td valign="top"><input name="prop_name" id="prop_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px"/></td>
				</tr>
					
					<tr>
						<td width="" valign="top"><label>Address Line 1 <em>*</em></label></td>
						<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Address Line 2</label></td>
						<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:210px" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>City <em>*</em></label></td>
						<td width="" valign="top"><input name="city" id="city" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">Zip</span>
						<input name="pin_code" id="pin_code" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox fstChUPPRCase" style="width:80px;margin:0 0 0 11px;" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Country <em>*</em></label></td>
						<td width="" valign="top"><input name="country" id="country" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">State<em>*</em></span>
						<input name="state" id="state" type="text" style="width:80px" data-validation="required" class="input validate[required] textbox fstChUPPRCase" /></td>
						
					</tr>
					<tr>
					<td width="" valign="top"><label>Phone <em>*</em></label></td>
					<td valign="top"><input name="phone" id="phone" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>E-mail <em>*</em></label></td>
					<td valign="top"><input name="email" id="email" type="text" data-validation="required" class="input validate[required,custom[email]] textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
					<tr>
							<td width="" valign="top"><label>Tin Number </label></td>
							<td valign="top"><input name="tin_number" id="tin_number" type="text" class="textbox" style="width:210px" /></td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Service Tax </label></td>
							<td valign="top"><input name="service_tax" id="service_tax" type="text" class="textbox" style="width:210px" /></td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Luxury Tax </label></td>
							<td valign="top"><input name="luxury_tax" id="luxury_tax" type="text" class="textbox" style="width:210px" /></td>
						</tr>
					<tr>
						<td><label>Billing </label></td>
						<td width="" valign="top"><input name="billing" id="prefix" type="radio" value="prefix" class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Prefix</span>
						<input name="billing" id="suffix" type="radio" value="suffix" class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Suffix</span><span class="spanClr">Text</span>
						<input name="pre_text" id="pre_text" type="text" class="textbox fstChUPPRCase" style="width:60px" /></td>
					</tr>
					
					<tr>
						<td><label>Round Off </label></td>
						<td width="" valign="top"><input name="round_off" id="rnd_higher" type="radio" value="higher" class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Higher</span>
						<input name="round_off" id="rnd_nearer" type="radio" value="nearer" class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Nearer</span><span class="spanClr">Value</span>
						<input name="rnd_value" id="rnd_value" type="text" style="width:35px"  class="input validate[custom[integer]] textbox fstChUPPRCase"/></td>
					</tr>
					
					</tbody>
				</table>
			
			
			<table style="width:50%;margin:4px 0 0 0;" class="table">
					<tbody>
					
					<tr>
						<td width="" valign="top"><label>Base Currency:</label></td>
						<td valign="top">
						<select name="base_curr" id="base_curr" >
						<option value="">--Select--</option>
						</select>
						
						<!--<input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" />-->
						
						</td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Check Out Time<em>*</em></label></td>
						<td valign="top">
						<select name="checkout_time" id="checkout_time" data-validation="required" class="input validate[required]">
						<option value="">--Select--</option>
						<option>24 Hours</option>
						<option>12 Noon</option>
						</select>
						</td>
					</tr>
						<tr>
							<td width="" valign="top"><label>Grace Time [Hrs.]<em>*</em></label></td>
							<td valign="top"><input name="grace_time" id="grace_time" type="text" data-validation="required" class="input validate[required] textbox" /></td>
							
						</tr>
						<tr>
							<td width="" valign="top"><label>Early check-in [Hrs.]</label></td>
							<td valign="top"><input name="early_checkin" id="early_checkin" type="text" class="textbox" /></td>
							
						</tr>
						<tr>
							<td width="" valign="top"><label>Room Type<em>*</em></label></td>
							<td valign="top">
							<select name="room_type" id="room_type" data-validation="required" class="input validate[required]">
						<option value="">--Select--</option>
							</select>
						</tr>
						<tr>
							<td width="" valign="top"><label>Rack Table<em>*</em></label></td>
							<td valign="top"><select name="rack_table" id="rack_table" data-validation="required" class="input validate[required]" >
						<option value="">--Select--</option>
							</select></td>
							
						</tr>
						<tr>
							<td width="" valign="top"><label>Market Segment <em>*</em></label></td>
							<td valign="top"><select name="market_segment" id="market_segment" data-validation="required" class="input validate[required]" >
						<option value="">--Select--</option>
							</select></td>
							
						</tr>
						<tr>
							<td width="" valign="top"><label>Business Source <em>*</em></label></td>
							<td valign="top"><select name="business_src" id="business_src" data-validation="required" class="input validate[required]" >
						<option value="">--Select--</option>
							</select></td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Meal Plan <em>*</em></label></td>
							<td valign="top"><select name="meal_plan" id="meal_plan" data-validation="required" class="input validate[required]" >
						<option value="">--Select--</option>
							</select></td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Pay Mode <em>*</em></label></td>
							<td valign="top"><select name="pay_mode" id="pay_mode" data-validation="required" class="input validate[required]">
						<option value="">--Select--</option>
							</select></td>
						</tr>
						
						
							<?php 
							$mon="";
							for ($m=1; $m<=12; $m++) {
							$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
								$mon.="<option value='$m'>$month</option>";
							}
							?>			
					<tr>
						<td width="" valign="top"><label>Finc. Year <em>*</em></label></td>
						<td width="" valign="top"><select id="financial_year" name="financial_year" data-validation="required" class="input validate[required]">
							<option value="">--Select--</option>
								<?php echo $mon; ?>
								</select></td>
						
					</tr>
					<tr>
							<td width="" valign="top"><label>Value Decimals</label></td>
							<td valign="top"><input name="val_decimal" id="val_decimal" type="text" class="textbox" /></td>
						</tr>							
						
				</tbody>
			</table>
			</div>
				
		<!--<table style="width:100%;border:1px solid #ddd;" class="table">
			<tr>
				<td><h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Packing Standard</b></h3></td>
			</tr>
		</table>-->	
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 125px;">
		<button type="submit" id="add" class="button_example bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="update-hotel-definition.php"><button type="button" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="button_example" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="" onClick="self.close();" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
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