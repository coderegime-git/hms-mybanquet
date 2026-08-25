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
  jQuery("#taxTypes").validationEngine();
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(5000);

});

 shortcut.add("Ctrl+S",function() { 
	 $('#taxTypes').attr('action', '../../action/add_itemSubcate_bqt.php');  
	 $('#taxTypes').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_subcateg_bqt.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#taxTypes').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});

function checkDepartmentCode() {
	dept_code=$('#dept_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatDepartmentCode.php',
			data:{
			dept_code:dept_code
			},
			success:function(data){
				/* alert(data); */
				if(data==1){
					alert('Department code already exists!.');
					$('#dept_code').val('');
				}
				else{
					
				}
			}
	});
}

function checkDepartmentName(){
	dept_name=$('#dept_name').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatDepartmentName.php',
			data:{
			dept_name:dept_name
			},
			success:function(data){
				/*  alert(data); */ 
				if(data==1){
					alert('Department Name already exists!.');
					$('#dept_name').val('');
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
			
	<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:468px;">
	<h3 id="Userhd"><b>Item Sub Category(BQT)</b></h3>
		<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_itemSubcate_bqt.php" method="post" class="" style="">
		<div>
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>
					<tr>
						<td width="" valign="top"><label>SubCategory Code <em>*</em></label></td>
						<td valign="top"><input type="text" name="subcat_code" id="subcat_code" data-validation="required" class="textbox input validate[required] codesUPPERCase tobCode" onblur="checkDepartmentCode();" /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>SubCategory Name<em>*</em></label></td>
						<td valign="top"><input type="text" name="subcat_name" id="subcat_name" data-validation="required" class="textbox input validate[required] fstChUPPRCase" onblur="checkDepartmentName();"/></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Category Code<em>*</em></label></td>
						<td valign="top">
<select name="cat_code" id="cat_code" style="font-size:12px;" class="textbox fstChUPPRCase">
<option value="">--Select--</option>
<?php
$sqle="select distinct cat_code,cat_name from bq_itemcat where status='1' AND cat_code!=''";
$rowe=mysql_query($sqle);while($resulte=mysql_fetch_array($rowe)){
?>
<option value="<?php echo $resulte['cat_code'] ?>" ><?php echo $resulte['cat_name']; ?></option><?php }?>
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
			</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 0px;">
		<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view_subcateg_bqt.php">
		<button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button>
		</a>
			
			<button type="reset" id="rest" class="buttExam_sngl" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	</td>
	</tr>
	</table>
	</form>	
	</div>
	</div>
	<?php include("../../footer.php"); ?>
</body>
</html>