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

function selMenuGrp(cnt){
	menGrp = $('#menu_group'+cnt).val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selectMEnuMastSUbmenu.php',
			data:{
			menGrp:menGrp
			},
			success:function(data){
				  /* alert(data); */ 
			$('#submenu'+cnt).html(data);
			  /* $('#tax_desc'+cnt).val(data); */
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
.buttExam_sngl {
	padding: 4px 20px;
}

</style>
			
	<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:412px;">
	<h3 id="Userhd"><b>Menu Master(BQT)</b></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_menu_master.php" method="post" class="" style="">
		<div>
		<input type="hidden" name="tariff_rt" id="tariff_rt" />
		<input type="hidden" name="taxCodee" id="taxCodee" class="txCde"/>
			<table style="float:left;width:100%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
						<td width="" valign="top"><label>Menu Code<em>*</em></label></td>
						<td valign="top"><input type="text" name="menu_code" id="menu_code" data-validation="required" class="input validate[required] textbox" />
						</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Menu Name<em>*</em></label></td>
					<td valign="top"><input name="menu_name" id="menu_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" /></td>
				</tr>
			
	<tr>
						<td><label>Status </label></td>
						<td width="" valign="top"><input type="radio" name="status" id="status_active" value="1"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Active</span>
						<input name="status" id="status_passive" type="radio" value="0" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">Passive</span></td>
					</tr>							
						
				</tbody>
			</table>
			
<table class="table-bordered"   style="text-align:center;font-size:12px;width:412px;">
<thead class="table">
<tr>
	<th style="width:150px;text-align:center;background-color:#F5F5F5;">Menu Group</th>
	<th style="width:150px;text-align:center;background-color:#F5F5F5;">Sub Menu Group</th>
	<th style="text-align:center;background-color:#F5F5F5;">Allow Quantity</th>
</tr>
</thead>
<tbody id="addedRowsED" class="table" style="overflow:auto;height:250px;width:412px;">
<?php for($c=1;$c<20;$c++){ ?>
<tr>	
<td style="width:150px;text-align:center;">
<select name="menu_group[]" id="menu_group<?php echo $c;?>" style="font-size:12px;width:140px;height:18px;" onChange="selMenuGrp(<?php echo $c;?>);" class="wagRw1 fstChUPPRCase">
<option value="">--Select--</option>
<?php
 $sqle="select distinct menu_code,menu_name from bq_menugrp";
 $rowe=mysql_query($sqle);while($resulte=mysql_fetch_array($rowe)){
?>
<option value="<?php echo $resulte['menu_code'] ?>" ><?php echo $resulte['menu_name']; ?></option><?php }?>
</select>
</td>
<td style="width:150px;text-align:center;">
<select name="submenu[]" id="submenu<?php echo $c;?>" style="font-size:12px;width:140px;height:18px;" class="wagRw1 fstChUPPRCase">
<option value="">--Select--</option>
</select>
</td>
<td style="text-align:center;"><input name="allow_qty[]" id="allow_qty" type="text" class="textbox fstChUPPRCase" style="width:100px;" /></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
				
<table style="border-left:1px solid #ddd;" class="table">
<tr>
	<td>	
<div style="margin:0px 0 0 0px;">
	<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
	
	<a href="view-menu-master.php"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
		
	<button type="reset" id="rest" class="buttExam_sngl" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
	
	<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style=""><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
	
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