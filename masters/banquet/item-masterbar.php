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
 $('form[name="taxTypes"]').validVal().validValDebug();
$('form[name="taxTypes"]').validVal();
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(5000);

});

 shortcut.add("Ctrl+S",function() { 
	 $('#taxTypes').attr('action', '../../action/add_business_source.php');  
	 $('#taxTypes').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_business_source.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#taxTypes').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});

function checkBusinessSource() {
	source_code=$('#source_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatBusinessSource.php',
			data:{
			source_code:source_code
			},
			success:function(data){
				/* alert(data); */
				if(data==1){
					alert('Business source code already exists!.');
					$('#source_code').val('');
				}
				else{
					
				}
			}
	});
}

function checkBusinessDesc(){
	source_desc=$('#source_desc').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeaBusinessSourceDesc.php',
			data:{
			source_desc:source_desc
			},
			success:function(data){
				/*  alert(data); */ 
				if(data==1){
					alert('Business source Description already exists!.');
					$('#source_desc').val('');
				}
				else{
					
				}
			}
	});
}


</script> 
<body class="bgBODY">
<div id="invoice" style="">
	<!--<div class="container" >-->
	
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
			
	<div id="addcustomer" class="frmCentr divBrd" style="width:468px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Item Master Bar</b></h3>
		<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_itemmaster_bar.php" method="post" class="" style="">
		<div>
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>
					<tr>
						<td width="" valign="top"><label>Code <em>*</em></label></td>
						<td valign="top"><input type="text" name="baritem_code" id="baritem_code" class="input required codesUPPERCase tobCode textbox" onblur="checkBusinessSource();" /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Name<em>*</em></label></td>
						<td valign="top"><input type="text" name="baritem_name" id="baritem_name" class="input required fstChUPPRCase textbox" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>UOM<em>*</em></label></td>
						<td valign="top">
						<?php $sqlRt=mysql_query("select distinct submn_catcd,submn_catnm from pos_submenucat");?>
							<select name="baritem_uom" id="baritem_uom" class="textbox input required fstChUPPRCase" style="" onchange="submenuCat();">
							<option value="">--Select--</option>
							<?php while($rowRt=mysql_fetch_array($sqlRt)){?>
							<option class="codesUPPERCase" value="<?php echo $rowRt['submn_catcd'];?>" ><?php echo $rowRt['submn_catnm'];?></option>
							<?php } ?>
						</select>
						
						<!--<input type="text" name="baritem_uom" id="baritem_uom" class="input required fstChUPPRCase" />--></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Conv factor<em>*</em></label></td>
						<td valign="top"><input type="text" name="conv_factor" id="conv_factor" class="input required fstChUPPRCase textbox" /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Category<em>*</em></label></td>
						<td valign="top"><input type="text" name="category" id="category" class="input required fstChUPPRCase textbox" /></td>
					</tr>
					</tbody>
				</table>
			</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 1px;">
		<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="#"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="buttExam_sngl" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	</td>
	</tr>
	</table>
	</form>	
	
	

	</div>
	</div>
</body>
</html>