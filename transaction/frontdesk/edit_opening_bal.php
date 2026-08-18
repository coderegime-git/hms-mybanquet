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
	
	
	var fullDate = new Date();
	console.log(fullDate);
	var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
	var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
	$("#cur_date").val(currentDate);

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
<div id="invoice" style="margin:0 0 0 325px;">
	<!--<div class="container" >-->
	
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;margin:0 0 0 -261px;">
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
<?php 
	$sql=mysql_query("select * from ar_bills where arbill_id='".$_GET['opeBal']."'");
	$row=mysql_fetch_array($sql);
?>				
	<div id="addcustomer" style="border:1px solid #ddd;width:468px;margin:0 0 0 112px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Opening Balance</b></h3>
	<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/update_ar_bills.php" method="post">
		<input name="arbill_id" id="arbill_id" type="hidden" value="<?php echo $row['arbill_id'];?>"/>
		<div>
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>
					<tr>
						<td width="" valign="top"><label>Date <em>*</em></label></td>
						<td valign="top"><input type="text" name="cur_date" id="cur_date" data-validation="required" class="input validate[required] codesUPPERCase curDate" value="<?php echo $row['cur_date'];?>"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Vendor <em>*</em></label></td>
					<td valign="top">
					<?php $sqlBS=mysql_query("select distinct vendor_code,vendor_name from company_master where status='1'");?>
							<select name="vendor_code" id="vendor_code" style="width:148px;" data-validation="required" class="input validate[required]" onchange="selCompanyName();">
							<option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<?php if($rowBS['vendor_code']==$row['vendor_code']) { ?>
							<option value="<?php echo $rowBS['vendor_code'];?>" selected ><?php echo $rowBS['vendor_name'];?></option>
							<?php } else{ ?>
							<option value="<?php echo $rowBS['vendor_code'];?>"><?php echo $rowBS['vendor_name'];?></option>
							<?php } ?>
							<?php } ?>
							</select>
					</td>
				</tr>
					<tr>
						<td width="" valign="top"><label>Bill Date<em>*</em></label></td>
						<td valign="top"><input type="text" name="bill_date" id="bill_date" data-validation="required" class="input validate[required] fstChUPPRCase datepicker" value="<?php echo $row['bill_date'];?>"/></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Bill Number<em>*</em></label></td>
						<td valign="top"><input type="text" name="bill_no" id="bill_no" data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['bill_no'];?>"/></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Bill Amount<em>*</em></label></td>
						<td valign="top"><input type="text" name="bill_amount" id="bill_amount" data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['bill_amount'];?>"/></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Remarks<em>*</em></label></td>
						<td valign="top"><input type="text" name="remarks" id="remarks" data-validation="required" class="input validate[required] fstChUPPRCase" value="<?php echo $row['remarks'];?>"/></td>
						
					</tr>
				
					</tbody>
				</table>
			</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 1px;">
		<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view_opening_balance.php"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
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