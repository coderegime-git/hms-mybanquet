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

/*  shortcut.add("Ctrl+S",function() { 
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
}); */
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
 function seltrate()
 {
	 var rty = $('input[name="rate_chk"]:checked').val();
	 
	 if(rty == 'none')
	 {
		 $('.rplan').css('display','none');
	 }else
	 {
		 $('.rplan').css('display','contents');
	 }
 }
 
 
function compCode(){
	comp_code=$('#comp_code').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatCompanyCode.php',
			data:{
			comp_code:comp_code
			},
			success:function(data){
				/*  alert(data); */
				if(data==1){
					alert('Company code already exists!.');
					$('#comp_code').val('');
				}
				else{
				
				}
			}
	});
}


function compName(){
	comp_name=$('#comp_name').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatCompanyName.php',
			data:{
			comp_name:comp_name
			},
			success:function(data){
				/*  alert(data); */
				if(data==1){
					alert('Company name already exists!.');
					$('#comp_name').val('');
				}
				else{
				
				}
			}
	});
}
</script> 
<body class="bgBODY">

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

label{
	 font-size:12px;
	 padding: 3px 9px 0 0;
	 font-weight: normal;
	 float: right;
}
.table{
	 margin-bottom:0px;
}			
.btn-sm{
    padding: 3px 10px;
    margin-top: 6px;
    width: 25%;
}
.nowrap{white-space: nowrap;}
.table-responsive{
overflow:hidden;
}

</style>
			
	<div class="col-sm-12" style="height:10px;"></div>
	<div class="container" style="">	
	<div class="col-sm-2"></div>
	<div class="col-sm-8 table-responsive" style="border: 1px solid #ddd; padding: 0;">
	<h3 id="Userhd"><b>Company Master</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_company_master.php" method="post" class="" style="">
		
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Code<em>*</em></label></td>
						<td valign="top"><input name="comp_code" id="comp_code" type="text"  class="textbox codesUPPERCase form-control" onBlur="compCode();" style="width:210px;background-color:#D8E5F8;" placeholder="Auto Generate" readonly />
						</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Name <em>*</em></label></td>
					<td valign="top"><input name="comp_name" id="comp_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase form-control" style="width:210px" onBlur="compName();"/></td>
				</tr>
					
					<tr>
						<td width="" valign="top"><label>Classification <em>*</em></label></td>
						<td valign="top">
						<select name="classf" id="classf" value="" data-validation="required" class="input validate[required] textbox fstChUPPRCase form-control" style="width:210px;">
						<option value="">--Select--</option>
						<option value="company">Company</option>
						<option value="travelagent">Travel Agent</option>
						<option value="creditcard">Credit Card</option>
						<option value="staff">Staff</option>
						<option value="individual">Individual</option>
						<option value="ota">OTA</option>
						<option value="upi">UPI</option>
						</select>
											
						</td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Contact Name</label></td>
						<td valign="top"><input name="cont_name" id="cont_name" type="text" style="width:210px" data-validation="required"class="input validate[required] textbox fstChUPPRCase form-control" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Address Line 1</label></td>
						<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase form-control" style="width:210px" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Address Line 2</label></td>
						<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase form-control" style="width:210px" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Address Line 3</label></td>
						<td valign="top"><input name="address3" id="address3" type="text" class="textbox fstChUPPRCase form-control" style="width:210px" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>City <em>*</em></label></td>
						<td width="" valign="top"><input name="city" id="city" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase form-control" style="width:87px"/><span class="spanClr">Zip</span>
						<input name="pin_code" id="pin_code" type="text" class="textbox fstChUPPRCase form-control" style="width:80px;margin:0 0 0 11px;" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Country <em>*</em></label></td>
						<td width="" valign="top"><input name="country" id="country" type="text" class="textbox fstChUPPRCase form-control" style="width:87px"/><span class="spanClr">State<em>*</em></span>
						<input name="state" id="state" type="text" style="width:80px" class="textbox fstChUPPRCase form-control" /></td>
						
					</tr>
					<tr>
					<td width="" valign="top"><label>Phone <em>*</em></label></td>
					<td valign="top"><input name="phone" id="phone" type="text" class="textbox fstChUPPRCase form-control" style="width:210px"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>E-mail <em>*</em></label></td>
					<td valign="top"><input name="email" id="email" type="text" class="textbox fstChUPPRCase form-control" style="width:210px"/></td>
					</tr>
					<!--<tr>
							<td width="" valign="top"><label>Tin Number </label></td>
							<td valign="top"><input name="tin_number" id="tin_number" type="text" class="textbox form-control" style="width:210px" /></td>
						</tr>-->
						<tr>
							<td width="" valign="top"><label>GST Number </label></td>
							<td valign="top"><input name="gst_number" id="gst_number" type="text" class="textbox form-control" style="width:210px" /></td>
						</tr>
						<!--<tr>
							<td width="" valign="top"><label>IATA Number</label></td>
							<td valign="top"><input name="iata_num" id="iata_num" type="text" class="textbox form-control" style="width:210px" /></td>
						</tr>-->
					
										
					</tbody>
				</table>
			<?php 
			$sqlcu=mysql_query("select currency_code from currency where base_currency='1'");
			$rowcu=mysql_fetch_array($sqlcu);
			$curCode=$rowcu['currency_code'];
			?>
			
			<table style="width:50%;margin:4px 0 0 0;" class="table">
					<tbody>
					
					<tr>
						<td width="" valign="top"><label>Sales Executive:</label></td>
						<td valign="top">
						<?php $sqlBS=mysql_query("select distinct executive_code from sales_executive where status = '1'");?>
					<select name="sales_exe" id="sales_exe" style="width:210px;" class="textbox form-control">
						<option value="">--Select--</option>
						<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<option value="<?php echo $rowBS['executive_code'];?>"><?php echo $rowBS['executive_code'];?></option>
							<?php } ?>
						</select>
						</td>
					</tr>	
					
					<tr>
						<td width="" valign="top"><label>Market Segment<em>*</em></label></td>
						<td valign="top">
						<?php $sqlBS=mysql_query("select * from market_segment where status = '1'");?>
							<select name="market_seg" id="market_seg" class="fstChUPPRCase textbox form-control">
							<option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<option value="<?php echo $rowBS['segment_code'];?>"><?php echo $rowBS['segment_code'];?></option>
							<?php } ?>
						</select>
						</td>
					</tr>
						<tr>
							<td width="" valign="top"><label>Sales office<em>*</em></label></td>
							<td valign="top">
							<?php $sqlBS=mysql_query("select distinct salesoff_code from sales_office where status = '1'");?>
							<select name="sales_off" id="sales_off" class="fstChUPPRCase textbox form-control">
						<option value="">--Select--</option>
						<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<option value="<?php echo $rowBS['salesoff_code'];?>"><?php echo $rowBS['salesoff_code'];?></option>
							<?php } ?>
						</select>
						</td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Business source</label></td>
							<td valign="top">
						<?php $sqlBS=mysql_query("select distinct source_code from business_source where status = '1'");?>
							<select name="busin_src" id="busin_src" class="fstChUPPRCase textbox form-control">
							<option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<option value="<?php echo $rowBS['source_code'];?>"><?php echo $rowBS['source_code'];?></option>
							<?php } ?>
							</select>
						</td>
							
						</tr>
						<tr>
							<td width="" valign="top"><label>Bill Instructions<em>*</em></label></td>
							<td valign="top">
							<?php $sqlBS=mysql_query("select distinct tob_code,tob_desc from type_ofbilling where status = '1'");?>
							<select name="billins" id="billins" class="fstChUPPRCase textbox form-control">
							<option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<option value="<?php echo $rowBS['tob_code'];?>"><?php echo $rowBS['tob_desc'];?></option>
							<?php } ?>
							</select></td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Commissions (%)<em>*</em></label></td>
							<td valign="top">
							<input name="commission" id="commission" type="text" class="textbox form-control" /></td>
						</tr>
					<tr>
						<td><label>Credit  </label></td>
						<td width="" valign="top"><input type="radio" name="credit" id="credit_active" value="yes"  class="textbox fstChUPPRCase " style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Yes</span>
						<input name="credit" id="credit_passive" type="radio" value="no" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">No</span></td>
					</tr>
					
					
						<tr>
							<td width="" valign="top"><label>Credit Limit<em>*</em></label></td>
							<td valign="top">
							<input name="credit_limit" id="credit_limit" type="text" class="textbox form-control" />
							</td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Credit Days<em>*</em></label></td>
							<td valign="top">
							<input name="credit_days" id="credit_days" type="text" class="textbox form-control" />
							</td>
						</tr>
						<tr>
						<td><label>Black List  </label></td>
						<td width="" valign="top"><input type="radio" name="black_list" id="blklist_active" value="yes"  class="textbox fstChUPPRCase form-control" style="width:10px;margin:3px 0 0 0;"  /><span class="spanClr">Yes</span>
						<input name="black_list" id="blklist_passive" type="radio" value="no" style="width:10px;margin:3px 0 0 0;float:left;" checked /><span class="spanClr">No</span></td>
					</tr>
					<tr>
							<td width="" valign="top"><label>Remarks<em>*</em></label></td>
							<td valign="top"><input name="remarks" id="remarks" type="text" class="textbox form-control" /></td>
							
						</tr>
					<tr>
						<td><label>Rates </label></td>
						<td width="" valign="top"><input name="rate_chk" id="rte_none" type="radio" value="none" class="textbox fstChUPPRCase" onclick="seltrate()" style="width:10px;margin:0px;" checked /><span class="spanClr">Rack</span>
						<input name="rate_chk" id="rte_rate" type="radio" value="rate" onclick="seltrate()" class="textbox fstChUPPRCase" style="width:10px;margin:0px;"/><span class="spanClr">Rate</span><span class="spanClr">Dis(%)</span>
						<input name="rte_disc" id="rte_disc" type="text" class="textbox fstChUPPRCase form-control" style="width:29px" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "2" /></td>
					</tr>
					
					<tr class="rplan" style="display:none;">
					<div class="rplan" >
							<td width="" valign="top" ><label>Rate Plan<em>*</em></label></td>
							<td valign="top"  >
							<?php $sqlBS=mysql_query("SELECT * FROM rate_table WHERE structure_code != 'RACK' group by structure_code");?>
							<select name="rateplan" id="rateplan" class="fstChUPPRCase textbox form-control">
							<option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<option value="<?php echo $rowBS['structure_code'];?>"><?php echo $rowBS['description'];?></option>
							<?php } ?>
							</select></td>
							</div>
						</tr>
					
					<tr>
						<td width="" valign="top"><label>Food <em>*</em></label></td>
						<td width="" valign="top"><input name="food" id="food" type="text" class="textbox fstChUPPRCase form-control" style="width:55px"/><span class="spanClr">Beverage<em>*</em></span>
						<input name="beverage" id="beverage" type="text" style="width:55px" class="textbox fstChUPPRCase form-control" /></td>
						
					</tr>
					<tr>
						<td><label>Company Type </label></td>
						<td width="" valign="top"><input type="radio" data-validation="required" name="comp_type" id="status_actie" value="C"  class="textbox validate[required] fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" /><span class="spanClr">Contract</span>
						<input name="comp_type" id="status_passie" data-validation="required"  type="radio" value="NC" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">Non Contract</span></td>
					</tr>		
					<tr>
						<td><label>Status </label></td>
						<td width="" valign="top"><input type="radio" name="status" id="status_active" value="1"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Active</span>
						<input name="status" id="status_passive" type="radio" value="0" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">Passive</span></td>
					</tr>
											
						
				</tbody>
			</table>
	
	
	<!--<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>-->	
	<div class="col-md-12  responsive nowrap " style=" padding-left:3px;">
		<button type="submit" id="add" class="btn btn-primary btn-sm btn-responsive" style="" onClick="return checkUnitMasterfdf();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-company-master.php"><button type="button" id="update" class="btn btn-primary btn-sm btn-responsive" onClick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
		<button type="reset" id="rest" class="btn btn-primary btn-sm btn-responsive" style="" onClick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="btn btn-primary btn-sm btn-responsive" style=""><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
		
	</div>
	<!--</td>
	</tr>
	</table>-->		
	</form>	
	
	
	</div>
	</div>
	<?php include("../../footer.php"); ?>
</body>
</html>