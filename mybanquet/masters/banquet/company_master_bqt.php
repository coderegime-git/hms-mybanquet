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
	 $('#hotelDefi').attr('action', '../../action/add_company_master.php');  
	 $('#hotelDefi').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_company_master.php";
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
<div id="invoice" style="">
	<!--<div class="container" >-->
		<div class="" >
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
			
<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:720px;">
<h3 id="Userhd"><b>Company Master</b></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_company_master.php" method="post" class="" style="">
		<div>
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Code<em>*</em></label></td>
						<td valign="top"><input name="comp_code" id="comp_code" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" style="width:210px"/>
						</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Name <em>*</em></label></td>
					<td valign="top"><input name="comp_name" id="comp_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px"/></td>
				</tr>
					
					<tr>
						<td width="" valign="top"><label>Classification <em>*</em></label></td>
						<td valign="top">
						<select name="classf" id="classf" value="" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px;">
						<option value="">--Select--</option>
						<option value="company">Company</option>
						<option value="travelagent">Travel Agent</option>
						<option value="creditcard">Credit Card</option>
						</select>
											
						</td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Contact Name</label></td>
						<td valign="top"><input name="cont_name" id="cont_name" type="text" style="width:210px" data-validation="required"class="input validate[required] textbox fstChUPPRCase" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Address Line 1</label></td>
						<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Address Line 2</label></td>
						<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:210px" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>City <em>*</em></label></td>
						<td width="" valign="top"><input name="city" id="city" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">Zip</span>
						<input name="pin_code" id="pin_code" type="text" class="textbox fstChUPPRCase" style="width:80px;margin:0 0 0 11px;" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Country <em>*</em></label></td>
						<td width="" valign="top"><input name="country" id="country" type="text" class="textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">State<em>*</em></span>
						<input name="state" id="state" type="text" style="width:80px" class="textbox fstChUPPRCase" /></td>
						
					</tr>
					<tr>
					<td width="" valign="top"><label>Phone <em>*</em></label></td>
					<td valign="top"><input name="phone" id="phone" type="text" class="textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>E-mail <em>*</em></label></td>
					<td valign="top"><input name="email" id="email" type="text" class="textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
					<tr>
							<td width="" valign="top"><label>Tin Number </label></td>
							<td valign="top"><input name="tin_number" id="tin_number" type="text" class="textbox" style="width:210px" /></td>
						</tr>
						<tr>
							<td width="" valign="top"><label>IATA Number</label></td>
							<td valign="top"><input name="iata_num" id="iata_num" type="text" class="textbox" style="width:210px" /></td>
						</tr>
					
					<tr>
						<td width="" valign="top"><label>Sales Executive:</label></td>
						<td valign="top">
					<select name="sales_exe" id="sales_exe" style="width:210px;" class="textbox">
						<option value="">--Select--</option>
						</select>
						</td>
					</tr>						
					</tbody>
				</table>
						
			<table style="width:50%;margin:4px 0 0 0;" class="table">
					<tbody>
					
					<tr>
						<td width="" valign="top"><label>Market Segment<em>*</em></label></td>
						<td valign="top">
						<!--<select name="market_seg" id="market_seg" class="fstChUPPRCase textbox">-->
						<?php $sqlBS=mysql_query("select distinct mscode,msname from bq_marketseg");?>
						<select name="market_seg" id="market_seg" class="fstChUPPRCase textbox">
						<option value="">--Select--</option>
						<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
						<option value="<?php echo $rowBS['mscode'];?>"><?php echo $rowBS['msname'];?></option>
						<?php } ?>
						</select>
						</td>
					</tr>
						<tr>
							<td width="" valign="top"><label>Sales office<em>*</em></label></td>
							<td valign="top">
						<select name="sales_off" id="sales_off" class="fstChUPPRCase textbox">
						<option value="">--Select--</option>
						</select>
						</td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Business source</label></td>
							<td valign="top">
						<?php $sqlBS=mysql_query("select distinct bs_code,bs_name from bq_bssource");?>
							<select name="busin_src" id="busin_src" class="fstChUPPRCase textbox">
							<option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<option value="<?php echo $rowBS['bs_code'];?>"><?php echo $rowBS['bs_name'];?></option>
							<?php } ?>
							</select>
						</td>
							
						</tr>
						<tr>
							<td width="" valign="top"><label>Room Nights<em>*</em></label></td>
							<td valign="top">
							<input name="room_nights" id="room_nights" type="text" class="textbox" /></td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Commissions (%)<em>*</em></label></td>
							<td valign="top">
							<input name="commission" id="commission" type="text" class="textbox" /></td>
						</tr>
					<tr>
						<td><label>Credit  </label></td>
						<td width="" valign="top"><input type="radio" name="credit" id="credit_active" value="yes"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Yes</span>
						<input name="credit" id="credit_passive" type="radio" value="no" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">No</span></td>
					</tr>
					
					
						<tr>
							<td width="" valign="top"><label>Credit Limit<em>*</em></label></td>
							<td valign="top">
							<input name="credit_limit" id="credit_limit" type="text" class="textbox" />
							</td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Credit Days<em>*</em></label></td>
							<td valign="top">
							<input name="credit_days" id="credit_days" type="text" class="textbox" />
							</td>
						</tr>
						<tr>
						<td><label>Black List  </label></td>
						<td width="" valign="top"><input type="radio" name="black_list" id="blklist_active" value="yes"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Yes</span>
						<input name="black_list" id="blklist_passive" type="radio" value="no" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">No</span></td>
					</tr>
					<tr>
							<td width="" valign="top"><label>Remarks<em>*</em></label></td>
							<td valign="top"><input name="remarks" id="remarks" type="text" class="textbox" /></td>
							
						</tr>
					<!--<tr>
						<td><label>Rates </label></td>
						<td width="" valign="top"><input name="rate_chk" id="rte_none" type="radio" value="none" class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">None</span>
						<input name="rate_chk" id="rte_rate" type="radio" value="rate" class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Rate</span><span class="spanClr">Dis(%)</span>
						<input name="rte_disc" id="rte_disc" type="text" class="textbox fstChUPPRCase" style="width:18px" /></td>
					</tr>-->
					
					<tr>
						<td width="" valign="top"><label>Food <em>*</em></label></td>
						<td width="" valign="top"><input name="food" id="food" type="text" class="textbox fstChUPPRCase" style="width:55px"/><span class="spanClr">Beverage<em>*</em></span>
						<input name="beverage" id="beverage" type="text" style="width:55px" class="textbox fstChUPPRCase" /></td>
						
					</tr>
							
					<tr>
						<td><label>Status </label></td>
						<td width="" valign="top"><input type="radio" name="status" id="status_active" value="1"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Active</span>
						<input name="status" id="status_passive" type="radio" value="0" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">Passive</span></td>
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
	<?php include("../../footer.php"); ?>
</body>
</html>