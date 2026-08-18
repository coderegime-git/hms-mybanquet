<?php
ob_start();
include("../../config.php");
include("../../header.php");
/* include("../../menu.php"); */
?>
 <!--form validation-->	
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-customValidations.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-debugger.js"></script>

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
$('form[name="hotelDefi"]').validVal().validValDebug();
$('form[name="hotelDefi"]').validVal();
	
	$("#tariff").click(function(){
		
		 if(this.checked) {
			 $("#tariff_rt").val(1);
			 
			/*  alert(this.checked);
			$(".sourceonTAR").show();
			$(".sourceonVAL").hide(); */
			/* tarche='<select ><option value="">--Select--</option><option value="rack" >Rack</option><option value="charged" >Charged</option></select>';
			
			 var rowTblCo = $('#addedRowsED tr').length+1;
			 j=0;
				for(i=0;i<rowTblCo;i++)
				{
					vall=($('#source'+i).html(tarche));
					j++;
				}   */
				
							
		}  else{
			 $("#tariff_rt").val(0);
			/* $(".sourceonTAR").hide();
			$(".sourceonVAL").show();  */
			/* tarche='<select ><option value="">--Select--</option><option value="percentage" >On Value</option><option value="amount" >Discounted value</option></select>';
			 var rowTblCo = $('#addedRowsED tr').length+1;
			 j=0;
				for(i=0;i<rowTblCo;i++)
				{
					vall=($('#source'+i).html(tarche));
					j++;
				}  */
		 } 
	}); 

});
/* 
 shortcut.add("Ctrl+S",function() { 
	 $('#hotelDefi').attr('action', '../../action/add_fotax_structure.php');  
	 $('#hotelDefi').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view-fotax-structure.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#hotelDefi').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
}); */





var rowCount = 0; 
function addMoreRows(frm) {
	rowCount=rowCount+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsED tr').length+2;
	
	var recRow = '<tr id="rowCount'+rowCount+'"><td style="width:100px;text-align:center;" id="room'+rowCount+'">'+rowCount+'</td><td style="width:250px;text-align:center;"><select name="tax_code[]" id="tax_code'+rowCount+'" style="font-size:12px;width:100px;height:18px;" onChange="selTaxCode();" class="wagRw1"><option value="">--Select--</option><?php $sqle="select * from pos_taxmaster";$rowe=mysql_query($sqle);while($resulte=mysql_fetch_array($rowe)){?><option value="<?php echo $resulte['tax_code'] ?>" ><?php echo $resulte['tax_code']; ?></option><?php }?></select></td><td style="width:100px;text-align:center;" id="room"><input name="tax_desc[]" id="tax_desc'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" readonly /></td><td style="text-align:center;"><select name="factor[]" id="factor'+rowCount+'" style="font-size:12px;width:100px;height:18px;"><option value="">--Select--</option><option value="percentage" >Percentage</option><option value="amount" >Amount</option></select></td><td style="text-align:center;"><input name="factor_value[]" id="factor_value'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:0 0 0 15px" /></td><td style="text-align:center;display:none;" class="sourceonTAR"><select name="source[]" id="source'+rowCount+'" style="font-size:12px;width:100px;height:18px;" class="sourceE"><option value="">--Select--</option><option value="rack">Rack</option><option value="charged">Charged</option></select></td><td style="text-align:center;" class="sourceonVAL"><select name="source1[]" id="source'+rowCount+'" style="font-size:12px;width:100px;height:18px;" class="sourceE"><option value="">--Select--</option><option value="onvalue">On Value</option><option value="discountedvalue">Discounted Value</option></select></td><td style="text-align:center;"><a href="javascript:void(0);" onclick="removeRow('+rowCount+');" name="remove['+rowCount+']" id="remove_'+ rowCount +'" class="deleterecord"><img src="../../images/removeicon.png" class="familyEmpMasterHREF" style="width:20px;height:20px;"/></a></td></tr>'; 
	
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
}


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

function selTaxCode(){
	var rowTblCo = $('#addedRowsED tr').length+1;
	taxCode=$('#tax_code'+rowCount).val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selectFoStructureCode.php',
			data:{
			taxCode:taxCode
			},
			success:function(data){
				 /*  alert(data);  */
							
			  $('#tax_desc'+rowCount).val(data);
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
</style>
			
	<div id="addcustomer" class="frmCentr divBrd" style="width:698px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Tax Structure</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_tax_struct.php" method="post" class="" style="">
		<div>
		<input type="hidden" name="tariff_rt" id="tariff_rt" />
		<input type="hidden" name="taxCodee" id="taxCodee" class="txCde"/>
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
						<td width="" valign="top"><label>Applicable Date<em>*</em></label></td>
						<td valign="top"><input type="text" name="applicable_date" id="applicable_date" class="input required datepicker textbox" />
						</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Structure Code <em>*</em></label></td>
					<td valign="top"><input name="str_code" id="str_code" type="text" class="input required textbox fstChUPPRCase" /></td>
				</tr>
				<tr>
					<td width="" valign="top"><label>On Tariff<em>*</em></label></td>
					<td valign="top">
					<input name="tariff" id="tariff" type="checkbox" class="" value="1" onclick="selTariffDet();"/>
					</td>
				</tr>			
			</tbody>
			</table>
			<table style="width:50%;margin:4px 0 0 0;" class="table">
					<tbody>
					<tr>
						<td width="" valign="top"><label>Outlet Name<em>*</em></label></td>
						<td valign="top"><input name="outlet_name" id="outlet_name" type="text" class="input required textbox fstChUPPRCase" /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Description<em>*</em></label></td>
						<td valign="top"><input name="description" id="description" type="text" class="input required textbox fstChUPPRCase" /></td>
					</tr>
					<tr>
						<td><label>Status </label></td>
						<td width="" valign="top"><input type="radio" name="status" id="status_active" value="1"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Active</span>
						<input name="status" id="status_passive" type="radio" value="0" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">Passive</span></td>
					</tr>							
						
				</tbody>
			</table>
			
			<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="text-align:center;font-size:12px;">
	<tr>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Tax Code</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Description</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Factor</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">F.Value</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Source</th>
		<th style="text-align:center;"><img src="../../images/plus.png" id="add-item" onclick="addMoreRows(this.form);" style="width:20px;height:20px;cursor:pointer;"/></th>
	</tr>
		
	<tbody id="addedRowsED">

	</tbody>
</table>
			</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 0px;">
		<button type="submit" id="add" class="button_example bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-fotax-structure.php"><button type="button" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
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