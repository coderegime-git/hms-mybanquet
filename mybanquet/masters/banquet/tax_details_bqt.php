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
	 $('#taxTypes').attr('action', '../../action/add_tax_details.php');  
	 $('#taxTypes').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_tax_det.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#taxTypes').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});

function checkSessionMaster() {
	source_code=$('#source_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatSessionMaster.php',
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

function checkSessionMasterDesc(){
	source_desc=$('#source_desc').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatSessionMasterDesc.php',
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
label{
	width:100px;
	text-align:right;
}
</style>
<?php
$sqlTx=mysql_query("select * from bq_taxdetail where taxdet_id='1'");
$rowTx=mysql_fetch_array($sqlTx);
$hall_tax=$rowTx['hall_tax'];
$food_tax=$rowTx['food_tax'];
$adv_tax=$rowTx['adv_tax'];
?>			
<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:468px;">
<h3 id="Userhd"><b>Tax Details(BQT)</b></h3>
<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_tax_details.php" method="post" class="" style="">
<div>
	<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
	<tbody>
		<tr>
			<td width="" valign="top"><label>Hall Tax <em>*</em></label></td>
			<td valign="top">
			<?php $sqlPm=mysql_query("select distinct str_code,description from bq_taxstruct");?>
			<select name="hall_tax" id="hall_tax" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="">
			<option value="">--Select--</option>
			<?php while($rowPm=mysql_fetch_array($sqlPm)) { ?>
			<?php if($hall_tax==$rowPm['str_code']) { ?>
			<option value="<?php echo $rowPm['str_code'];?>" selected ><?php echo $rowPm['description'];?></option>
			<?php }else{ ?>
			<option value="<?php echo $rowPm['str_code'];?>"  ><?php echo $rowPm['description'];?></option>
			<?php } } ?>
			</select>
			</td>
		</tr>
		<tr>
			<td width="" valign="top"><label>Food Tax<em>*</em></label></td>
			<td valign="top">
			<?php $sqlPm=mysql_query("select distinct str_code,description from bq_taxstruct");?>
			<select name="food_tax" id="food_tax" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="">
			<option value="">--Select--</option>
			<?php while($rowPm=mysql_fetch_array($sqlPm)) { ?>
			<?php if($food_tax==$rowPm['str_code']) { ?>
			<option value="<?php echo $rowPm['str_code'];?>" selected ><?php echo $rowPm['description'];?></option>
			<?php }else{ ?>
			<option value="<?php echo $rowPm['str_code'];?>"  ><?php echo $rowPm['description'];?></option>
			<?php } } ?>
			</select>
			</td>	
		</tr>	
		<tr>
			<td width="" valign="top"><label>Advance Tax<em>*</em></label></td>
			<td valign="top">
			<?php $sqlPm=mysql_query("select distinct str_code,description from bq_taxstruct");?>
			<select name="adv_tax" id="adv_tax" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="">
			<option value="">--Select--</option>
			<?php while($rowPm=mysql_fetch_array($sqlPm)) { ?>
			<?php if($adv_tax==$rowPm['str_code']) { ?>
			<option value="<?php echo $rowPm['str_code'];?>" selected ><?php echo $rowPm['description'];?></option>
			<?php }else{ ?>
			<option value="<?php echo $rowPm['str_code'];?>"  ><?php echo $rowPm['description'];?></option>
			<?php } } ?>
			</select>
			</td>	
		</tr>
	</tbody>
	</table>
			</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 0px;">
		<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view_tax_det.php"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
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