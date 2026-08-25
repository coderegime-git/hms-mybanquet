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

<!-- Datepicker start
<script src="<?php echo $home_path;?>/date-picker/jquery-1.10.2.js"></script>-->
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<!-- End -->

<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	$(".datepicker" ).datepicker({
	    changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd-mm-yy"
  });
  
  $(".datepicker1" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd-mm-yy"
  }); 
  
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#hotelDefi").validationEngine();
	
	$("#tariff").click(function(){
		
		 if(this.checked) {
			 $("#tariff_rt").val(1);
								
		}  else{
			 $("#tariff_rt").val(0);
			
		 } 
	}); 

});

 shortcut.add("Ctrl+S",function() { 
	 $('#hotelDefi').attr('action', '<?php echo $home_path;?>/action/add_item_master.php');  
	 $('#hotelDefi').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_itemmaster_bqt.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#hotelDefi').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "view_itemmaster_bqt.php";
});


/* var rowCount = 0; 
function addMoreRows(frm) {
	rowCount=rowCount+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsED tr').length+2;
	
	var recRow = '<tr id="rowCount'+rowCount+'"><td style="width:100px;text-align:center;" id="room'+rowCount+'">'+rowCount+'</td><td style="width:250px;text-align:center;"><select name="tax_code[]" id="tax_code'+rowCount+'" style="font-size:12px;width:100px;height:18px;" onChange="selTaxCode();" class="wagRw1"><option value="">--Select--</option><?php $sqle="select * from tax_type";$rowe=mysql_query($sqle);while($resulte=mysql_fetch_array($rowe)){?><option value="<?php echo $resulte['tax_code'] ?>" ><?php echo $resulte['tax_code']; ?></option><?php }?></select></td><td style="width:100px;text-align:center;" id="room"><input name="tax_desc[]" id="tax_desc'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase"/></td><td style="text-align:center;"><select name="factor[]" id="factor'+rowCount+'" style="font-size:12px;width:100px;height:18px;"><option value="">--Select--</option><option value="percentage" >Percentage</option><option value="amount" >Amount</option></select></td><td style="text-align:center;"><input name="factor_value[]" id="factor_value'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:0 0 0 15px" /></td><td style="text-align:center;display:none;" class="sourceonTAR"><select name="source[]" id="source'+rowCount+'" style="font-size:12px;width:100px;height:18px;" class="sourceE"><option value="">--Select--</option><option value="rack">Rack</option><option value="charged">Charged</option></select></td><td style="text-align:center;" class="sourceonVAL"><select name="source1[]" id="source'+rowCount+'" style="font-size:12px;width:100px;height:18px;" class="sourceE"><option value="">--Select--</option><option value="onvalue">On Value</option><option value="discountedvalue">Discounted Value</option></select></td><td style="text-align:center;"><a href="javascript:void(0);" onclick="removeRow('+rowCount+');" name="remove['+rowCount+']" id="remove_'+ rowCount +'" class="deleterecord"><img src="../../images/removeicon.png" class="familyEmpMasterHREF" style="width:20px;height:20px;"/></a></td></tr>'; 
	
	 jQuery('#addedRowsED').append(recRow); 
	$('#rowCount').val(rowCount);
	
	trF=$('#tariff_rt').val();
	if(trF==1){
	$(".sourceonTAR").show();
	$(".sourceonVAL").hide();	
	}else{
		$(".sourceonTAR").hide();
		$(".sourceonVAL").show();	
	}
} */


function removeRow(removeNum) {
 jQuery('#rowCount'+removeNum).remove(); 
} 
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

function selTaxCode(cnt){
	var rowTblCo = $('#addedRowsED tr').length+1;
	taxCode=$('#tax_code'+cnt).val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selectFoStructureCode.php',
			data:{
			taxCode:taxCode
			},
			success:function(data){
				/*  alert(data);  */
						
			 $('#tax_desc'+cnt).val(data);
			}
	});
}

function selMenuGrp(){
	menGrp = $('#menu_group').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selectMEnuMastSUbmenu.php',
			data:{
			menGrp:menGrp
			},
			success:function(data){
				  /* alert(data); */ 
			$('#itsubmnu_name').html(data);
			  /* $('#tax_desc'+cnt).val(data); */
			}
	});
	
}


function checkItemCode(){
	itmCde = $('#item_code').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatItmMastItemCode.php',
			data:{
			itmCde:itmCde
			},
			success:function(data){
				  /* alert(data); */
			if(data==1){
				alert("Item code already exists!.");
				$('#item_code').val('');
				$('#item_name').val('');
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
    padding: 2px 9px 0 5px;
		
}

.buttTx{
background: #fc8d83 linear-gradient(to bottom, #fc8d83 5%, #e4685d 100%) repeat scroll 0 0;
    border: 1px solid #d83526;
    border-radius: 2px;
    box-shadow: 0 1px 0 0 #f7c5c0 inset;
    color: #ffffff;
    cursor: pointer;
    display: inline-block;
    font-family: Arial;
    font-size: 12px;
    font-weight: bold;
    padding: 4px 42px;
    text-decoration: none;
    text-shadow: 0 1px 0 #b23e35;
}
.buttTx:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #e4685d), color-stop(1, #fc8d83));
	background:-moz-linear-gradient(top, #e4685d 5%, #fc8d83 100%);
	background:-webkit-linear-gradient(top, #e4685d 5%, #fc8d83 100%);
	background:-o-linear-gradient(top, #e4685d 5%, #fc8d83 100%);
	background:-ms-linear-gradient(top, #e4685d 5%, #fc8d83 100%);
	background:linear-gradient(to bottom, #e4685d 5%, #fc8d83 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e4685d', endColorstr='#fc8d83',GradientType=0);
	background-color:#e4685d;
}
.buttTx:active {
	position:relative;
	top:1px;
}

.buttExam_sngl{
	padding:3px 44px;
}
</style>
			
	<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:603px;">
	<h3 id="Userhd"><b>Item Master(BQT)</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_item_master.php" method="post" class="" style="">
		<div>
		<input type="hidden" name="tariff_rt" id="tariff_rt" />
		<input type="hidden" name="taxCodee" id="taxCodee" class="txCde"/>
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
						<td width="" valign="top"><label>Item Code <em>*</em></label></td>
						<td valign="top"><input type="text" name="item_code" id="item_code" data-validation="required" class="textbox input validate[required] codesUPPERCase tobCode" onblur="checkItemCode();" /></td>
				</tr>
				<tr>
						<td width="" valign="top"><label>Item Name<em>*</em></label></td>
						<td valign="top"><input type="text" name="item_name" id="item_name" data-validation="required" class="textbox input validate[required] fstChUPPRCase" onblur="checkDepartmentName();"/></td>
				</tr>
				<tr>
				<td width="" valign="top"><label>Menu Group<em>*</em></label></td>
				<td valign="top">
				<select name="menu_type" id="menu_type" style="font-size:12px;" onChange="selMenuType();" class="wagRw1 textbox ">
				<option value="">--Select--</option>
				<?php
				 $sqle=mysql_query("select * from bq_grpcode");
				while($res=mysql_fetch_array($sqle)){ 
				?>
				<option value="<?php echo $res['grpcode'] ?>" ><?php echo $res['grpname']; ?></option>
				<?php  } ?>
				</select>
				</td>
				</tr>
				<tr>
				<td width="" valign="top"><label>Item Sub Category<em>*</em></label></td>
				<td valign="top">
				<select name="itmsub_cat" id="itmsub_cat" style="font-size:12px;" onChange="selMenuGrp();" class="wagRw1 textbox ">
				<option value="">--Select--</option>
				<?php
				 $sqle=mysql_query("select distinct subcat_code from bq_subcatitem");
				while($res=mysql_fetch_array($sqle)){ 
				?>
				<option value="<?php echo $res['subcat_code'] ?>" ><?php echo $res['subcat_code']; ?></option>
				<?php  } ?>
				</select>
				</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Sub Menu Code<em>*</em></label></td>
					<td valign="top">
					<select name="itmsubmnu_code" id="itmsubmnu_code" style="font-size:12px;" onChange="selMenuGrp();" class="wagRw1 textbox ">
				<option value="">--Select--</option>
				<?php
				$sqle=mysql_query("select distinct submenu_code,submenu_name from bq_submenugrp");
				while($res=mysql_fetch_array($sqle)){
				?>
				<option value="<?php echo $res['submenu_code'] ?>" ><?php echo $res['submenu_name']; ?></option>
				<?php } ?>
				</select>
					</td>
				</tr>	
					
					<tr>
						<td width="" valign="top"><label>Rate<em>*</em></label></td>
						<td valign="top"><input type="text" name="item_rate" id="item_rate" data-validation="required" class="textbox input validate[required] fstChUPPRCase" onblur="checkDepartmentName();"/></td>
						
					</tr>
						
						
			</tbody>
			</table>
			<table style="width:50%;margin:4px 0 0 0;" class="table">
					<tbody>
					
					
					<tr>
			<td width="" valign="top"><label>Tax Structure<em>*</em></label></td>
			<td valign="top">
			<select name="tax_struc" id="tax_struc" style="font-size:12px;" onChange="selTaxCode(<?php echo $c;?>);" class="wagRw1 textbox ">
				<option value="">--Select--</option>
				<?php
				$sqle=mysql_query("select distinct str_code from bq_taxstruct");
				while($res=mysql_fetch_array($sqle)){
				?>
				<option value="<?php echo $res['str_code'] ?>" ><?php echo $res['str_code']; ?></option>
				<?php } ?>
			</select>
			</td>
<tr>					
					<td><label>Allow Discount </label></td>
					<td width="" valign="top">
						<select name="allow_disc" id="allow_disc" class="textbox">
							<option value="">--Select--</option>
							<option value="yes">yes</option>
							<option value="no">No</option>
						</select>
					</td>
					</tr>
			
			<tr>
						<td><label>Allow Rate Change </label></td>
						<td width="" valign="top">
						<select name="allwrate_chg" id="allwrate_chg" class="textbox" >
							<option value="">--Select--</option>
							<option value="yes">yes</option>
							<option value="no">No</option>
						</select>
						</td>
						</tr>
					</tr>

					<tr>
					<td><label>Allow Quantity </label></td>
					<td width="" valign="top">
					<select name="allow_qty" id="allow_qty" class="textbox">
						<option value="">--Select--</option>
					<option value="yes">yes</option>
					<option value="no">No</option>
					</select>
					</td>
					</tr>					
					
					<tr>
						<td><label>Status </label></td>
						<td width="" valign="top"><input type="radio" name="status" id="status_active" value="1"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Active</span>
						<input name="status" id="status_passive" type="radio" value="0" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">Passive</span></td>
						
					</tr>
					
				</tbody>
			</table>
			
<table style="width:100%;margin:4px 0 0 0;font-size:12px;" class="table">
<thead>
<?php 
$sqlM=mysql_query('select * from bq_menumaster group by menu_code');
if(mysql_num_rows($sqlM)>0){
?>
<tr>
	<th style="text-align:center;">Code</th>
	<th style="text-align:center;">Menu</th>
	<th style="text-align:center;">Status</th>
</tr>
</thead>
<tbody>
<?php
while($rwM=mysql_fetch_array($sqlM)){
?>
<tr>
	<td><input type="text" name="itmnu_code[]" id="itmnu_code" class="textbox input fstChUPPRCase" value="<?php echo $rwM['menu_code'] ?>" readonly /></td>
	<td><input type="text" name="itmnu_name[]" id="itmnu_name" class="textbox input fstChUPPRCase" value="<?php echo $rwM['menu_name'] ?>" readonly /></td>
	<td>
	<select name="mnu_sts[]" id="mnu_sts" style="width:80px;">
	<option value="">--select--</option>
	<option value="yes">Yes</option>
	<option value="no">No</option>
	</select>
	
	</td>
	
</tr>
<?php } } ?>
</tbody>
			
			</table>	
					
			
				<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 0px;">
		<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view_itemmaster_bqt.php"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="buttExam_sngl" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/masters/banquet/view_itemmaster_bqt.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
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