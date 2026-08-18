<?php
ob_start();
include("../../config.php");
include("../../header.php");
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
<?php 
	$sql=mysql_query("select * from property_definition where propdef_id='".$_GET['propId']."'");
	$row=mysql_fetch_array($sql);
?>				
	<div id="addcustomer" style="border:1px solid #ddd;width:698px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Property Definition</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/update_property_definition.php" method="post" class="" style="">
		<input name="propdef_id" id="propdef_id" type="hidden" value="<?php echo $row['propdef_id'];?>"/>
	
		<div>
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Property Code<em>*</em></label></td>
						<td valign="top"><input name="prop_code" id="prop_code" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" value="<?php echo $row['prop_code'];?>" style="width:210px"/>
						</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Name <em>*</em></label></td>
					<td valign="top"><input name="prop_name" id="prop_name" type="text" data-validation="required" value="<?php echo $row['prop_name'];?>" class="input validate[required] textbox fstChUPPRCase" style="width:210px"/></td>
				</tr>
					
					<tr>
						<td width="" valign="top"><label>Address Line 1 <em>*</em></label></td>
						<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" value="<?php echo $row['address1'];?>" class="input validate[required] textbox fstChUPPRCase" style="width:210px" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Address Line 2</label></td>
						<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" value="<?php echo $row['address2'];?>" style="width:210px" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>City <em>*</em></label></td>
						<td width="" valign="top"><input name="city" id="city" type="text" data-validation="required" value="<?php echo $row['city'];?>" class="input validate[required] textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">Zip</span>
						<input name="pin_code" id="pin_code" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox fstChUPPRCase" value="<?php echo $row['pin_code'];?>" style="width:80px;margin:0 0 0 11px;" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Country <em>*</em></label></td>
						<td width="" valign="top"><input name="country" id="country" type="text" data-validation="required" value="<?php echo $row['country'];?>" class="input validate[required] textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">State<em>*</em></span>
						<input name="state" id="state" type="text" style="width:80px" data-validation="required" value="<?php echo $row['state'];?>" class="input validate[required] textbox fstChUPPRCase" /></td>
						
					</tr>
					
					
					
					</tbody>
				</table>
			
			
			<table style="width:50%;margin:4px 0 0 0;" class="table">
					<tbody>
					<tr>
					<td width="" valign="top"><label>E-mail <em>*</em></label></td>
					<td valign="top"><input name="email" id="email" type="text" data-validation="required" value="<?php echo $row['email'];?>" class="input validate[required,custom[email]] textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
					<tr>
							<td width="" valign="top"><label>Tin Number </label></td>
							<td valign="top"><input name="tin_number" id="tin_number" type="text" class="textbox" value="<?php echo $row['tin_number'];?>" style="width:210px" /></td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Service Tax </label></td>
							<td valign="top"><input name="service_tax" id="service_tax" type="text" class="textbox" value="<?php echo $row['service_tax'];?>" style="width:210px" /></td>
						</tr>
						<tr>
					<td width="" valign="top"><label>Phone <em>*</em></label></td>
					<td valign="top"><input name="phone" id="phone" type="text" data-validation="required" value="<?php echo $row['phone'];?>" class="input validate[required,custom[integer]] textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>	
					
					<tr>
						<td><label>Bill </label></td>
						<td width="" valign="top"><input name="billing" id="prefix" type="radio" value="prefix"<?php echo ($row['billing']=='prefix')?'checked':''; ?> class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Prefix</span>
						<input name="billing" id="suffix" type="radio" value="suffix"<?php echo ($row['billing']=='suffix')?'checked':''; ?> class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Suffix</span><span class="spanClr">Text</span>
						<input name="pre_text" id="pre_text" type="text" value="<?php echo $row['pre_text'];?>" class="textbox fstChUPPRCase" style="width:53px" /></td>
					</tr>
					
					<tr>
						<td><label>Round Off </label></td>
						<td width="" valign="top"><input name="round_off" id="rnd_higher" type="radio" value="higher"<?php echo ($row['round_off']=='higher')?'checked':''; ?> class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Higher</span>
						<input name="round_off" id="rnd_nearer" type="radio" value="nearer"<?php echo ($row['round_off']=='nearer')?'checked':''; ?> class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Nearer</span><span class="spanClr">Value</span>
						<input name="rnd_value" id="rnd_value" type="text" style="width:35px"  class="textbox fstChUPPRCase" value="<?php echo $row['rnd_value'];?>" /></td>
					</tr>
				</tbody>
			</table>
			</div>
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 0px;">
		<button type="submit" id="add" class="button_example bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>

		<a href="view-prop-definit.php"><button type="button" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>

		<button type="reset" id="rest" class="button_example" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>

		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style=""><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
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