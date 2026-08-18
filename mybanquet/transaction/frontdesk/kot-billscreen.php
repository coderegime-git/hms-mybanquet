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
padding: 4px 15px;
}

.sbtBImg{
	width:22px;
	height:22px;
	
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
<div class="col-sm- about">
<div id="invoice" style="margin:0 0 0 103px">
		
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
			
	<div id="addcustomer" style="border:1px solid #ddd;width:800px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Outlet Master</b></h3>
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
		<th width="80" style="text-align:center;background-color:#F5F5F5;">SI.No.</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Kot#</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Item Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Qty</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Rate</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Total</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">D.Flag</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">D.Amount</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Tax</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Net Amount</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Split</th>
	</tr>
	
	<tr>
		<td width="80" style="text-align:center;"></td>
		<td width="80"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
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
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"></td>
		
	</tr>
</table>
</div>
	

	
	
<table style="border-left:1px solid #ddd;margin:117px 0 0 0;" class="">
<tr>
	<td>	
<div style="margin:150px 0 0 0px;">
	<button type="submit" id="add" class="buttexample bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/kot6.png" class="sbtBImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ettlement</button>
	
	<a href="view-prop-definit.php"><button type="button" id="update" class="buttexample bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/imprimer.png" class="sbtBImg "/>&nbsp;&nbsp;<span class="btnUndLine">B</span>ill Print</button></a>
		
		<button type="reset" id="rest" class="buttexample" style="" onclick="cancel_ed()"><img src="../../images/logo-icon-active.png" class="sbtBImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">S</span>ettlement</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttexample" style=""><img src="../../images/icon-19.png" class="sbtBImg" />&nbsp;&nbsp;<span class="btnUndLine">T</span>able Split</button></a>	
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttexample" style=""><img src="../../images/61-512.png" class="sbtBImg" />&nbsp;&nbsp;<span class="btnUndLine">T</span>able Change</button></a>	
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttexample" style=""><img src="../../images/tbl.jpg" class="sbtBImg" />&nbsp;&nbsp;<span class="btnUndLine">T</span>able Merge</button></a>	
</div>
</td>
</tr>
</table>	


	
	</form>	
	
	
</div>
<table style="width:60px;float:right;margin:0 -77px 0 0;" cellpadding="0" cellspacing="0" class="" border="1" >
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
</table>
<table style="width:60px;background-color:#c0c0c0;margin:0 -77px 0 0;float:right;" cellpadding="0" cellspacing="0" class="" border="0" >
<tbody>
<tr>
<td colspan="" style="color:#000;font-weight:bold;"><input type="text" value="" style="padding:0px 0px 0px 0px;width:249px;border:none;color:#fff;"/>&nbsp;&nbsp;Pending Amt &nbsp;:</td>
</tr>
</tbody>
</table>
<table style="width:60px;margin:0 -77px 0 0;float:right;" cellpadding="0" cellspacing="0" class="table" border="0" >
<tbody>
<!--<tr>
<td colspan="3"><input type="text" value="" style="padding:0px 0px 0px 0px;width:54px;border:none;"/>Pending Amount</td>
</tr>-->
<tr>
<td><input type="button" value="1" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="2" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="3" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="4" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="5" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="6" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="7" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="8" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="9" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="10" style="padding:10px 16px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="11" style="padding:10px 17px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="1A" style="padding:10px 16px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="1B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="1C" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="2A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="2B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="2C" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="3A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="3B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="3C" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="4A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="4B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="4C" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="5A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="5B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="5C" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="6A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="6B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="7A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="7B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
</tbody>
</table>
	</div>
	
	</div>
	
	

				
				
</body>
</html>