<?php
ob_start();
include("../config.php");
include("../header.php");
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
	/* jQuery("#hotelDefi").validationEngine(); */
	
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
	
	
	
  $('#module_name').change(function() {
	$('#hideRwCnt').hide();
  modName="";
  if($(this).val()!=''){modName = "?modName="+$(this).val(); }
  document.location.href="update_parameters.php"+modName;	
  });
  
  

});

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
});





var rowCount = 0; 
function addMoreRows(frm) {
	rowCount=rowCount+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsED tr').length+2;
	
	var recRow = '<tr id="rowCount'+rowCount+'"><td style="width:100px;text-align:center;" id="room'+rowCount+'">'+rowCount+'</td><td style="width:250px;text-align:center;"><select name="tax_code[]" id="tax_code'+rowCount+'" style="font-size:12px;width:100px;height:18px;" onChange="selTaxCode();" class="wagRw1"><option value="">--Select--</option><?php $sqle="select * from tax_type";$rowe=mysql_query($sqle);while($resulte=mysql_fetch_array($rowe)){?><option value="<?php echo $resulte['tax_code'] ?>" ><?php echo $resulte['tax_code']; ?></option><?php }?></select></td><td style="width:100px;text-align:center;" id="room"><input name="tax_desc[]" id="tax_desc'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase"/></td><td style="text-align:center;"><select name="factor[]" id="factor'+rowCount+'" style="font-size:12px;width:100px;height:18px;"><option value="">--Select--</option><option value="percentage" >Percentage</option><option value="amount" >Amount</option></select></td><td style="text-align:center;"><input name="factor_value[]" id="factor_value'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:0 0 0 15px" /></td><td style="text-align:center;display:none;" class="sourceonTAR"><select name="source[]" id="source'+rowCount+'" style="font-size:12px;width:100px;height:18px;" class="sourceE"><option value="">--Select--</option><option value="rack">Rack</option><option value="charged">Charged</option></select></td><td style="text-align:center;" class="sourceonVAL"><select name="source[]" id="source'+rowCount+'" style="font-size:12px;width:100px;height:18px;" class="sourceE"><option value="">--Select--</option><option value="onvalue">On Value</option><option value="discountedvalue">Discounted Value</option></select></td><td style="text-align:center;"><a href="javascript:void(0);" onclick="removeRow('+rowCount+');" name="remove['+rowCount+']" id="remove_'+ rowCount +'" class="deleterecord"><img src="../../images/removeicon.png" class="familyEmpMasterHREF" style="width:20px;height:20px;"/></a></td></tr>'; 
	
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

function selTaxCode(){
	var rowTblCo = $('#addedRowsED tr').length+1;
	taxCode=$('#tax_code'+rowCount).val();
	/* taxVl=$('.txCde').val(taxCode); */
/* 	alert(taxCode); */
	/* alert('sdsd'+taxVl); */
	
		
	$.ajax({
		type:'GET',
		url:'  ../../action/selectFoStructureCode.php',
			data:{
			taxCode:taxCode
			},
			success:function(data){
				 /*  alert(data);  */
				  /* var x = optDt.split(',');
				j=0;
				for(i=0;i<x.length;i++)
				{
					vall=($('#tax_desc'+j).val(x[i]));
					j++;
				}  */
			
			  $('#tax_desc'+rowCount).val(data);
			}
	});
}

function taxDetval(){
	taxVal=$("#taxdet_tarval").val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selRateTable.php',
			data:{
			taxVal:taxVal
			},
			success:function(data){
				$("#taxdet_tarey").val(data);
			}
	});
}
function taxDetval1(){
	taxVal=$("#taxdet_planval").val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selRateTable1.php',
			data:{
			taxVal:taxVal
			},
			success:function(data){
				$("#taxdet_planey").val(data);
			}
	});
}
function taxDetval2(){
	taxVal=$("#taxdet_expval").val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selRateTable2.php',
			data:{
			taxVal:taxVal
			},
			success:function(data){
				$("#taxdet_expey").val(data);
			}
	});
}
function taxDetval3(){
	taxVal=$("#taxdet_excval").val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selRateTable3.php',
			data:{
			taxVal:taxVal
			},
			success:function(data){
				$("#taxdet_excey").val(data);
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
    padding: 2px 9px 0 5px;
		
}
</style>
			
	<div id="addcustomer" style="border:1px solid #ddd;width:698px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Update Parameters</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/admin/add_hmsparameters.php" method="post" class="" style="">
		<div>
		<input type="hidden" name="tariff_rt" id="tariff_rt" />
		<input type="hidden" name="taxCodee" id="taxCodee" class="txCde"/>
<?php 
if(isset($_GET['modName'])){
	$sqlF=mysql_query("select * from hms_parameters where module_name='".$_GET['modName']."'");
	$rowF=mysql_fetch_array($sqlF);
}
?>
		<table style="float:left;width:100%;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
					<td width="110" valign="top"><label style="float:right;width:100px;">Module<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<select name="module_name" id="module_name" data-validation="required" class="input validate[required] textbox codesUPPERCase" onchange="changeModuleName();">
					<option>--Select--</option>
					<option value="Frontoffice"<?php if(isset($_GET['modName'])) { echo ($_GET['modName']=='Frontoffice')?'selected':'';} ?>>Front Office</option>
					<option value="PointofSale"<?php if(isset($_GET['modName'])) { echo ($_GET['modName']=='PointofSale')?'selected':'';} ?>>Point of Sale</option>
					<option value="Materials"<?php if(isset($_GET['modName'])) { echo ($_GET['modName']=='Materials')?'selected':'';} ?>>Materials</option>
					<option value="Foodcosting"<?php if(isset($_GET['modName'])) { echo ($_GET['modName']=='Foodcosting')?'selected':'';} ?>>Food Costing</option>
					<option value="Banquets"<?php if(isset($_GET['modName'])) { echo ($_GET['modName']=='Banquets')?'selected':'';} ?>>Banquets</option>
					<option value="Housekeeping"<?php if(isset($_GET['modName'])) { echo ($_GET['modName']=='Housekeeping')?'selected':'';} ?>>House Keeping</option>
					</select>
					</td>
				</tr>			
			</tbody>
		</table>
			
	<table cellpadding="0" cellspacing="0" border="0" class="table" style="text-align:center;font-size:12px;">
	<tr>
		<th width="" style="text-align:center;background-color:#F5F5F5;">S.No.</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Description</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Status</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Applicable Date</th>
	</tr>
		
	<!--<tr id="hideRwCnt">
		<td width="" style="text-align:center;">1</td>
		<td width="" style="text-align:center;"><input name="description[]" id="description" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:450px;" value="" /></td>
		<td width="" style="text-align:center;"><input name="status[]" id="status" type="checkbox" data-validation="required" class="input validate[required] fstChUPPRCase" style="" value="1" /></td>
		<td width="" style="text-align:center;"><input name="applicable_date[]" id="applicable_date" type="text" data-validation="required" class="input validate[required] fstChUPPRCase" style="" value="" /></td>
	</tr>-->
	<?php 
	$sqlO=mysql_query("select * from hms_parameters where module_name='".$_GET['modName']."'");
	$x=0;
	while($rowO=mysql_fetch_array($sqlO)){
$x++;
?>
	<tr id="">
		<td width="" style="text-align:center;"><?php echo $x; ?></td>
		<td width="" style="text-align:center;"><input name="description[]" id="description" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:450px;" value="<?php echo $rowO['description']; ?>" /></td>
		<td width="" style="text-align:center;"><input name="status[]" id="status" type="checkbox" data-validation="required" class="input validate[required] fstChUPPRCase" style="" value="1"<?php echo ($rowO['status']=='1')?'checked':''; ?> /></td>
		<td width="" style="text-align:center;"><input name="applicable_date[]" id="applicable_date" type="text" data-validation="required" class="input validate[required] fstChUPPRCase" style="" value="<?php echo $rowO['applicable_date']; ?>" /></td>
	</tr>
<?php } ?>
	</table>
</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 125px;">
		<button type="submit" id="add" class="button_example bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-fotax-structure.php"><button type="button" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
		<button type="reset" id="rest" class="button_example" style="" onclick="cancel_ed()"><img src="../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style=""><img src="../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
		
	</div>
	</td>
	</tr>
	</table>		
	
	
	
</div>
	</div>
	</div>
	</form>	
</body>
</html>