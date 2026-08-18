<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../menu.php");
?>

<script>
	jQuery(document).ready(function(){
		$("#msgFo").fadeOut(5000);
	jQuery("#roommaster").validationEngine();
	});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});

function checkSalesOffCode(){
	propCode=$('#property_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatSalesOffCode.php',
			data:{
			propCode:propCode
			},
			success:function(data){
				/* alert(data); */
				if(data==1){
					$('#propertycode_err').html('* Property Code already exists.');
					$('#property_code').val('');
				}
				else{
					$('#propertycode_err').html('');
				}
			}
	});
}



 </script>
 
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
</style>	


<!--<body style="background:#eaebfc url(../../images/bg-ash2.jpg) repeat scroll center top;font: 69%/160% Lucida Grande,Verdana,Helvetica,Arial,sans-serif;">-->
<body class="bgBODY">
	<div class="box propertyhead" style="" >&nbsp;
	<div class="box-header well" >	
		<h4 style="font-size:14px;margin:0px;">Sales Office</h4>
	</div>
	 <br/>
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo"class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>	 
<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
  
<div class="table-responsive">	
<form name="roommaster" id="roommaster" action="<?php echo $home_path;?>/action/add_sales_office.php" method="post" class="defineForm">
	<div style="width:900px;margin: 0 0 0 56px;">
		<span id="salesoffice_err" class="myerror1"></span>
		<input type="hidden" name="salesoffice_id" id="salesoffice_id" value=""/>
		<p>
		<label >Sales Off. Code  <em></em></label><input type="text" name="salesoff_code" id="salesoff_code" onblur="checkSalesOffCode();" class="codesUPPERCase"/>
			
		<label>Sales Off. Code Desc. </label><input type="text" name="salesoff_desc" id="salesoff_desc" data-validation="required" class="input validate[required,custom[onlyLetterSp]] fstChUPPRCase"/>
		</p>
		<p>
		<label>Address<em>*</em></label><input type="text" name="address" id="address" data-validation="required" class="input validate[required] fstChUPPRCase" />
		<label>Address 1</label><input type="text" name="address1" id="address1" class="fstChUPPRCase" />
		</p>
		<p>
		<label>City <em>*</em></label><input type="text" name="city" id="city" data-validation="required" class="input validate[required,custom[onlyLetterSp]] fstChUPPRCase" />
		<label>Zip<em>*</em></label><input type="text" name="pincode" id="pincode" data-validation="required" class="input validate[required,custom[integer]] fstChUPPRCase" />
		</p>
		<p>
		<label >State <em>*</em></label><input type="text" name="state" id="state" data-validation="required" class="input validate[required,custom[integer]] fstChUPPRCase" />
		<label>Country <em>*</em></label><input type="text" name="country" id="country" data-validation="required" class="input validate[required,custom[onlyLetterSp]] fstChUPPRCase" />
		</p>
		<p>
		<label>Phone <em></em></label><input type="text" name="phone" id="phone" data-validation="required" class="input validate[required,custom[onlyLetterSp]]" />
		<label>E-mail <em>*</em></label><input type="text" name="email" id="email" data-validation="required" class="input validate[required,custom[onlyLetterSp]]" />
		</p>
		<p>
		<label >Status<em></em></label>
			<input type="radio" name="status" id="status_active" value="1" id="IDofInput" checked /><label style="width:70px;vertical-align: text-top;">Yes</label>
			<input type="radio" name="status" id="status_passive" value="0" /><label style="width:54px;vertical-align: text-top;">No</label>
		</p>
	</div>
	
	<div class="propertySubmit">
		<button type="submit" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();"><img src="../../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
			
			<a href="view-sales-office.php"><button type="button" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
			
			<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
			
			<button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" onClick="self.close();" ><img src="../../images/cancel.png" class="sbtBtnImg" style="width:20px;height:20px;"/>&nbsp;&nbsp;Exit</button>
			
		</div>
		
		</form>
	
	</div>
	</body>
