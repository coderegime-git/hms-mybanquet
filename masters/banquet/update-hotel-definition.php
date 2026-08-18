<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../menu.php");
?>
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; }

input[type=text], textarea{
 height:26px;
} 
</style>	



<script>
$(document).ready(function() {
		$("#msgFo").fadeOut(5000);
	jQuery("#propdefinition").validationEngine();
});
function selectpropertycode() {
	property_code=$('#property_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/selectpropertydetails.php',
			data:{
			property_code:property_code
			},
			success:function(data){	
			/*  alert(data); */ 
			 var val = data.split('-');
			 $('#property_id').val(val[0]);			
			 $('#property_name').val(val[2]);			
			 $('#address1').val(val[3]);			
			 $('#address2').val(val[4]);			
			 $('#city').val(val[5]);			
			 $('#pincode').val(val[6]);			
			 $('#state').val(val[7]);			
			 $('#country').val(val[8]);			
			 $('#phone').val(val[9]);			
			 $('#email').val(val[10]);			
			 $('#currency').val(val[11]);			
			 $('#checkout_time').val(val[12]);			
			 $('#grace_time').val(val[13]);			
			 $('#room_type').val(val[14]);			
			 $('#rack_table').val(val[15]);			
			 $('#market_segment').val(val[16]);			
			 $('#business_source').val(val[17]);			
			 $('#meal_plan').val(val[18]);			
			 $('#pay_mode').val(val[19]);			
			 $('#date_format').val(val[20]);			
			 $('#qty_decimals').val(val[21]);			
			 $('#rate_decimals').val(val[22]);			
			 $('#start_date').val(val[23]);			
			 $('#early_checkin').val(val[24]);			
			 $('#tin_number').val(val[25]);			
			 $('#sertax_number').val(val[26]);			
			 $('#luxtax_number').val(val[27]);			
			}
	});
}

</script>


<body class="bgBODY">

	<div class="box propertyhead" style="" >&nbsp;
	<div class="box-header well" >	
		<h4 style="font-size:14px;margin:0;">Property Definition</h4>
	</div>
	 <br/>
	  <?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo"class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<form name="propdefinition" id="propdefinition" action="<?php echo $home_path;?>/action/update_hotel_definition.php" method="post" class="defineForm">

		<input type="text" name="property_id" id="property_id" style="display:none;" />

		<div style="width:900px;margin: 0 0 0 56px;">
		<br/>
		<p>
		<label>Property Code <em>*</em></label>
		
	<select name="property_code" id="property_code" autofocus="autofocus" style="width:203px;font-size:14px;" onchange="selectpropertycode();" class="codesUPPERCase">
			<option value="">--Select--</option>
		<?php
		$sqlba="select property_code from property_definition";
		$rowba=mysql_query($sqlba);
		while($resultba=mysql_fetch_array($rowba)) {
		?>
		<option value="<?php echo $resultba['property_code']; ?>"><?php echo strtoupper($resultba['property_code']);?></option>
		<?php } ?>
		</select>
			
		<label>Name</label><input type="text" name="property_name" id="property_name" data-validation="required" class="input validate[required,custom[onlyLetterSp]] fstChUPPRCase" />
		</p>
		<p>
		<label>Address Line 1 <em>*</em></label><input type="text" name="address1" id="address1" data-validation="required" class="input validate[required] fstChUPPRCase" />
		<label>Address Line 2</label><input type="text" name="address2" id="address2" class="fstChUPPRCase"/>
		</p>
		<p>
		<label>City <em>*</em></label><input type="text" name="city" id="city" data-validation="required" class="input validate[required,custom[onlyLetterSp]] fstChUPPRCase" />
		<label >Zip <em>*</em></label><input type="text" name="pincode" id="pincode" data-validation="required" class="input validate[required,custom[integer]]" />
		</p>
		<p>
		<label>State <em>*</em></label><input type="text" name="state" id="state" data-validation="required" class="input validate[required,custom[onlyLetterSp]] fstChUPPRCase" />
		<label>Country <em>*</em></label><input type="text" name="country" id="country" data-validation="required" class="input validate[required,custom[onlyLetterSp]] fstChUPPRCase" />
		</p>
		<p>
		<label>Telephone <em></em></label><input type="text" name="phone" id="phone" data-validation="required" class="input validate[required,custom[integer]]" />
		<label>E-mail <em>*</em></label><input type="text" name="email" id="email" data-validation="required" class="input validate[required,custom[email]]" />
		</p>
	
		<h4 class="propertyH4">Default</h4>
		
		 <p>
		<label>Base Currency <em>*</em></label><input type="text" name="currency" id="currency"  />
		<label>Check Out Time <em></em></label><input type="text" name="checkout_time" id="checkout_time"  />
		</p>
		<p>
		<label>Grace Time [Hrs.] <em></em></label><input type="text" name="grace_time" id="grace_time" style="height:25px;"/>
		<label>Room Type <em></em></label><input type="text" name="room_type" id="room_type" />
		</p>
		<p>
		<label>Rack Table <em></em></label><input type="text" name="rack_table" id="rack_table" />
		<label>Market Segment <em></em></label><input type="text" name="market_segment" id="market_segment" />
		</p>
		<p>
		<label>Business Source <em></em></label><input type="text" name="business_source" id="business_source" />
		<label>Meal Plan <em></em></label><input type="text" name="meal_plan" id="meal_plan" />
		</p>
		<p>
		<label>Pay Mode <em></em></label><input type="text" name="pay_mode" id="pay_mode" />
		<label>Date Format <em></em></label><input type="text" name="date_format" id="date_format" />
		</p>
		<p>
		<label>Quantity Decimals<em></em></label><input type="text" name="qty_decimals" id="qty_decimals" />
		<label>Rate Decimals <em></em></label><input type="text" name="rate_decimals" id="rate_decimals" />
		</p>
		<p>
		<label>Start Date <em></em></label><input type="text" name="start_date" id="start_date" />
		<label>Early Checkin<em></em></label><input type="text" name="early_checkin" id="early_checkin" />
		</p>
		<p>
		<label>Tin Number <em></em></label><input type="text" name="tin_number" id="tin_number" />
		<label>Service Tax Number<em></em></label><input type="text" name="sertax_number" id="sertax_number" />
		</p>
		<p>
		<label>Luxury Tax Number <em></em></label><input type="text" class="txtBOX" name="luxtax_number" id="luxtax_number" />
		</p>
	</div>
		<div style="margin:42px 0 0 331px;padding: 0 0 23px;">
		<!--<button type="submit" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();"><img src="../../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>-->
			
			<button type="submit" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/update.png" class="sbtBtnImg"/>&nbsp;&nbsp;Update</button>
			
			<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
			
			<!--<input type="submit" name="" id="" value="Submit" class="button_example" onclick="return hoteldefinition();"/>
			<input type="submit" name="" id="" value="Modify" class="button_example_edit"/>
			<input type="submit" name="" id="" value="Delete" class="button_example_delete"/>
			<input type="submit" name="" id="" value="Clear" class="button_example_clear"/>-->
		</div>
		
		</form>
	
	</div>
	</body>
