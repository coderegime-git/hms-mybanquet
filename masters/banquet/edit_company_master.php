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
	$sql=mysql_query("select * from company_master where company_id='".$_GET['compId']."'");
	$row=mysql_fetch_array($sql);
?>			
	<div id="addcustomer" style="border:1px solid #ddd;width:720px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Vendor Master</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/update_company_master.php" method="post" class="" style="">
		<input name="company_id" id="company_id" type="hidden" value="<?php echo $row['company_id'];?>"/>
		<div>
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Code<em>*</em></label></td>
						<td valign="top"><input name="comp_code" id="comp_code" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" value="<?php echo $row['vendor_code'];?>" style="width:210px"/>
						</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Name <em>*</em></label></td>
					<td valign="top"><input name="comp_name" id="comp_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" value="<?php echo $row['vendor_name'];?>" style="width:210px"/></td>
				</tr>
					
				<tr>
						<td width="" valign="top"><label>Contact Name</label></td>
						<td valign="top"><input name="cont_name" id="cont_name" type="text" style="width:210px" data-validation="required"class="input validate[required] textbox fstChUPPRCase" value="<?php echo $row['cont_name'];?>" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Address Line 1</label></td>
						<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" value="<?php echo $row['address1'];?>" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Address Line 2</label></td>
						<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $row['address2'];?>" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>City <em>*</em></label></td>
						<td width="" valign="top"><input name="city" id="city" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:87px" value="<?php echo $row['city'];?>"/><span class="spanClr">Zip</span>
						<input name="pin_code" id="pin_code" type="text" class="textbox fstChUPPRCase" style="width:80px;margin:0 0 0 11px;" value="<?php echo $row['pin_code'];?>" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Country <em>*</em></label></td>
						<td width="" valign="top"><input name="country" id="country" type="text" class="textbox fstChUPPRCase" style="width:87px" value="<?php echo $row['country'];?>"/><span class="spanClr">State<em>*</em></span>
						<input name="state" id="state" type="text" style="width:80px" class="textbox fstChUPPRCase" value="<?php echo $row['state'];?>" /></td>
						
					</tr>
										
					</tbody>
				</table>
			<table style="width:50%;margin:4px 0 0 0;" class="table">
					<tbody>
					
				<tr>
					<td width="" valign="top"><label>Phone <em>*</em></label></td>
					<td valign="top"><input name="phone" id="phone" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $row['phone'];?>"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>E-mail <em>*</em></label></td>
					<td valign="top"><input name="email" id="email" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $row['email'];?>"/></td>
					</tr>
					<tr>
							<td width="" valign="top"><label>Tin Number </label></td>
							<td valign="top"><input name="tin_number" id="tin_number" type="text" class="textbox" style="width:210px" value="<?php echo $row['tin_number'];?>" /></td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Service Tax </label></td>
							<td valign="top"><input name="service_tax" id="service_tax" type="text" class="textbox" style="width:210px" value="<?php echo $row['service_tax'];?>" /></td>
						</tr>
										
					<tr>
							<td width="" valign="top"><label>Business source</label></td>
							<td valign="top">
						<?php $sqlBS=mysql_query("select distinct source_code from business_source");?>
							<select name="busin_src" id="busin_src" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px;">
							<option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<?php if($rowBS['source_code']==$row['busin_src']){ ?>
							<option value="<?php echo $rowBS['source_code'];?>" selected ><?php echo $rowBS['source_code'];?></option>
							<?php }else{?>
							<option value="<?php echo $rowBS['source_code'];?>"><?php echo $rowBS['source_code'];?></option>
							<?php } } ?>
							</select>
						</td>
							
						</tr>
							
					<tr>
						<td><label>Status </label></td>
						<td width="" valign="top"><input type="radio" name="status" id="status_active" value="1"<?php echo ($row['status']=='1')?'checked':''; ?>  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Active</span>
						<input name="status" id="status_passive" type="radio" value="0"<?php echo ($row['status']=='0')?'checked':''; ?> style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">Passive</span></td>
					</tr>
											
						
				</tbody>
			</table>
			</div>
	
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 0px;">
		<button type="submit" id="add" class="buttExam_Dbl bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view_company_master.php"><button type="button" id="update" class="buttExam_Dbl bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
		<button type="reset" id="rest" class="buttExam_Dbl" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExam_Dbl" style=""><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
		
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