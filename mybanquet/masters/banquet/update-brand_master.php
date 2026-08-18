<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../menu.php");
?>

<script>
	jQuery(document).ready(function(){
	jQuery("#propdefinition").validationEngine();
	
	$(".Discrates").click(function() {
		$('#DiscAmt').prop("disabled", false);
		$('.ratFoo').prop("disabled", false);
	});
	
	$(".DiscratNone").click(function() {
		$('#DiscAmt').prop('disabled',true);
		$('.ratFoo').prop('disabled',true);
	});
	$(".DiscratTbl").click(function() {
		$('#DiscAmt').prop('disabled',true);
		$('.ratFoo').prop('disabled',true);
	});
});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});

function checkPropertyCode(){
	propCode=$('#property_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatPropertyCode.php',
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
		<h4 style="font-size:14px;margin:0px;">Company Master</h4>
	</div>
	 <br/>
<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<?php 
$sql=mysql_query("select * from company_master where companymaster_id='".$_GET['compid']."'");
$x=0;
$row=mysql_fetch_array($sql);
?>
<div class="table-responsive">	
<form name="propdefinition" id="propdefinition" action="<?php echo $home_path;?>/action/update_company_master.php" method="post" class="defineForm">
		<div style="width:900px;margin: 0 0 0 56px;">
		<span id="propertycode_err" class="myerror1"></span>
		<input type="hidden" name="companymaster_id" id="companymaster_id" value="<?php echo $row['companymaster_id']; ?>" />
		
		<p>
		<label>Code <em>*</em></label><input type="text" name="company_code" id="company_code" data-validation="required" class="input validate[required] codesUPPERCase" onblur="checkCompanyCode();" value="<?php echo $row['company_code']; ?>"/>
		
		
		<label>Company Name</label><input type="text" name="company_name" id="company_name" data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['company_name']; ?>"/>
		</p>
		<p>
		<label>Classification <em>*</em></label><input type="text" name="classification" id="classification" data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['classification']; ?>"/>
		<label>Contact Name</label><input type="text" name="contact_name" id="contact_name" value="<?php echo $row['contact_name']; ?>" class="fstChUPPRCase" />
		</p>
		<p>
		<label>TIN No <em>*</em></label><input type="text" name="tin_no" id="tin_no" value="<?php echo $row['tin_no']; ?>" class="fstChUPPRCase"/>
		<label >IATA No  <em>*</em></label><input type="text" name="iata_no" id="iata_no" value="<?php echo $row['iata_no']; ?>" class="fstChUPPRCase"/>
		</p>
		<h4 style="margin:0 0 10px 19px;text-decoration:underline;">Company Address</h4>
		<p>
		<label>Address <em>*</em></label><input type="text" name="caddress" id="caddress"data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['caddress']; ?>"/>
		<label>Address 1 <em>*</em></label><input type="text" name="caddress1" id="caddress1" value="<?php echo $row['caddress1']; ?>" class="fstChUPPRCase"/>
		</p>
		<p>
		<label>City <em></em></label><input type="text" name="ccity" id="ccity" data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['ccity']; ?>"/>
		<label>State <em>*</em></label><input type="text" name="cstate" id="cstate" value="<?php echo $row['cstate']; ?>" class="fstChUPPRCase"/>
		</p>
		<p>
		<label>Country <em></em></label><input type="text" name="ccountry" id="ccountry" data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['ccountry']; ?>"/>
		<label>Zip Code <em>*</em></label><input type="text" name="cpincode" id="cpincode"  data-validation="required" class="input validate[custom[integer]]" value="<?php echo $row['cpincode']; ?>"/>
		</p>
		<p>
		<label>Phone <em></em></label><input type="text" name="cphone" id="cphone" data-validation="required" class="input validate[required,custom[integer]]" value="<?php echo $row['cphone']; ?>"/>
		<label>E-Mail <em>*</em></label><input type="text"name="cemail" id="cemail" data-validation="required" class="input validate[required,custom[email]]" value="<?php echo $row['cemail']; ?>"/>
		</p>
		<p>
		<h4 style="margin:0 0 10px 19px;text-decoration:underline;width:200px;float:left;">Billing Address</h4>
		<input type="checkbox"  /><label > Same as above<em></em></label>
		</p>
		<p style="">
		<label>Address<em>*</em></label><input type="text" name="baddress" id="baddress" data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['baddress']; ?>"/>
		<label>Address 1<em></em></label><input type="text" name="baddress1" id="baddress1" value="<?php echo $row['baddress1']; ?>" class="fstChUPPRCase"/>
		</p>
		<p>
		<label>City <em></em></label><input type="text" name="bcity" id="bcity" data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['bcity']; ?>"/>
		<label>State <em>*</em></label><input type="text" name="bstate" id="bstate" value="<?php echo $row['bstate']; ?>" class="fstChUPPRCase"/>
		</p>
		<p>
		<label>Country <em></em></label><input type="text" name="bcountry" id="bcountry"  data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['bcountry']; ?>"/>
		<label>Zip Code <em>*</em></label><input type="text" name="bpincode" id="bpincode"  data-validation="required" class="input validate[custom[integer]]" value="<?php echo $row['bpincode']; ?>"/>
		</p>
		<p>
		<label > Sales Executive<em></em></label><input type="text" name="sales_exe" id="sales_exe" style="width:95px;" value="<?php echo $row['sales_exe']; ?>" class="fstChUPPRCase"/><input type="text"  style="width:100px;margin:-10px 0 0 10px;" name="sales_exe1" id="sales_exe1" value="<?php echo $row['sales_exe1']; ?>" class="fstChUPPRCase"/>
		<label > Sales Office<em></em></label><input type="text" name="sales_office" id="sales_office" style="width:95px;" value="<?php echo $row['sales_office']; ?>" class="fstChUPPRCase"/><input type="text"  style="width:100px;margin:-10px 0 0 10px;" name="sales_office1" id="sales_office1" class="fstChUPPRCase" value="<?php echo $row['sales_office1']; ?>"/>
		</p>
		<p>
		<label > Market Segment<em></em></label><input type="text" name="market_segment" id="market_segment" style="width:95px;" value="<?php echo $row['market_segment']; ?>" class="fstChUPPRCase"/><input type="text"  style="width:100px;margin:-10px 0 0 10px;" name="market_segment1" id="market_segment1" value="<?php echo $row['market_segment1']; ?>" class="fstChUPPRCase"/>
		<label > Business Source<em></em></label><input type="text" name="business_source" id="business_source" style="width:95px;" class="fstChUPPRCase" value="<?php echo $row['business_source']; ?>"/><input type="text"  style="width:100px;margin:-10px 0 0 10px;" name="business_source1" id="business_source1" class="fstChUPPRCase" value="<?php echo $row['business_source1']; ?>"/>
		</p>
		<p>
		<label > Room Nights<em></em></label><input type="text" name="room_nights" id="room_nights" value="<?php echo $row['room_nights']; ?>" class="fstChUPPRCase"/>
		<label > Points<em></em></label><input type="text" name="points" id="points" value="<?php echo $row['points']; ?>" class="fstChUPPRCase"/>
		</p>
		<p>
		<label >Commissions (%)<em></em></label><input type="text" name="commissions" id="commissions" value="<?php echo $row['commissions']; ?>"/>
		<label > Credit<em></em></label>
		<?php
		$active_status = 'unchecked';
		$deactive_status = 'unchecked';
		if ($row['credit_ck'] == "1")
		{ $active_status = 'checked';	}
		else
		{ $deactive_status = 'checked'; }
		?>
		<input type="radio" name="credit_ck" id="credit_active" value="1"<?PHP print $active_status; ?> id="IDofInput" checked /><label style="width:70px;vertical-align: sub;">Yes</label>
		<input type="radio" name="credit_ck" id="credit_passive" value="0"<?PHP print $deactive_status; ?> /><label style="width:54px;vertical-align: sub;">No</label>
		</p>
		<p>
		<label > Expiry Date<em></em></label><input type="text" name="expiry_date" id="expiry_date" value="<?php echo $row['expiry_date']; ?>"/>
		<label > Credit Limit<em></em></label><input type="text" name="credit_limit" id="credit_limit" value="<?php echo $row['credit_limit']; ?>" />
		</p>
		<style>
		hr { display: block; height: 1px;
    border: 0; border-top: 1px solid #ccc;
    margin: 1em 0; padding: 0; }
	</style>
		<hr >
		<p>
		<label style="width:100px;">Black List<em></em></label>
		<input type="radio" name="black_list" id="black_active" value="1"<?php echo ($row['black_list']=='1')?'checked':''; ?> /><label style="width:70px;vertical-align: sub;">Yes</label>
		<input type="radio" name="black_list" id="black_passive" value="0"<?php echo ($row['black_list']=='0')?'checked':''; ?> /><label style="width:54px;vertical-align:sub;">No</label>
		
		<label style="width:115px;margin:0 0 0 -10px;">Credit Days<em></em></label><input type="text" name="credit_days" id="credit_days" style="width:100px;margin:0 0 0 -13px;" value="<?php echo $row['credit_days']; ?>"/><label  style="width:80px;margin:0 0 0 48px;">Remarks<em></em></label><input type="text" name="remarks" id="remarks" style="width:233px;margin-left:11px;" value="<?php echo $row['remarks']; ?>"/>
		</p>
	<hr >
	<h4 style="margin:0 0 10px 19px;text-decoration:underline;width:99%;float:left;">Rates</h4>
	<p style="margin-left:20px;">
		<input type="radio" name="rates" id="rates" class="DiscratNone" value="none"<?php echo ($row['black_list']=='none')?'checked':''; ?>/><label style="width:65px;vertical-align:sub;"> None<em></em></label>
		<input type="radio" name="rates" id="rates" class="DiscratTbl" value="rate_table"<?php echo ($row['black_list']=='rate_table')?'checked':''; ?>/><label style="width:100px;vertical-align:sub;"> Rate Table<em></em></label>
		<input type="radio" name="rates" id="rates" class="Discrates" value="discount"<?php echo ($row['black_list']=='discount')?'checked':''; ?>/><label style="width:120px;vertical-align:sub;" >Discount(%)<em></em></label><input type="text"  style="width:50px;margin:10px -27px;" name="DiscAmt" id="DiscAmt" disabled />
		
		
		<label style="width:77px;margin:0 0 0 67px;">Food(%)<em></em></label><input type="text" name="food" id="food" class="ratFoo" style="width:50px;vertical-align:bottom;" value="<?php echo $row['food']; ?>" disabled />
		<label style="width:115px;margin:0 0 0 -7px;">Beverage(%)<em></em></label><input type="text" name="beverage" id="beverage" class="ratFoo" style="width:50px;vertical-align:bottom;"value="<?php echo $row['beverage']; ?>" disabled /><label  style="width:67px;margin:0 0 0 0px;">liquid(%)<em></em></label><input type="text" name="liquid" id="liquid" class="ratFoo" style="width:50px;margin-left:11px;vertical-align:bottom;" value="<?php echo $row['liquid']; ?>" disabled />
		</p>
		<hr >
		<p>
			<label >Status <em></em></label>
			<input type="radio" name="status" id="status_active" value="1" id="IDofInput" checked /><label style="width:70px;vertical-align: sub;">Active</label>
			<input type="radio" name="status" id="status_passive" value="0" /><label style="width:54px;vertical-align: sub;">Passive</label>
		</p>
		<hr >
	<br/>
	<br/>
</div>
<div style="margin: -19px 0 0 244px;padding: 0 0 23px;">
	<button type="submit" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();"><img src="../../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
		
		<a href="view-company-master.php"><button type="button" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
		
		<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style=""><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
		
</div>
		</form>
</div>
</body>