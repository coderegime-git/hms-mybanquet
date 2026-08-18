<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../menu.php");
?>
<style>
 label {width: 150px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
 
 input[type=text], textarea{
 height:26px;
}

</style>
		
		
<script type="text/javascript">
jQuery(document).ready(function(){
	$("#msgFo").fadeOut(5000);
jQuery("#salesexec").validationEngine();
});
	SyntaxHighlighter.defaults['toolbar'] = false;
	SyntaxHighlighter.all();
	
	
function edit_unit(id,code,desc,desg,sts) {
	$("#salesexecutive_id").val(id);
	$("#executive_code").val(code);
	$("#executive_name").val(desc);
	$("#designation").val(desg);
		if(sts=='1'){
			$('#status_active').prop('checked', true);
		}
		else{
			$('#status_passive').prop('checked', true);
		}
	$("#update").show();
	$("#rest").show();
	$("#add").hide();
	$("#salesexec").attr("action","<?php echo $home_path;?>/action/update_sales_executive.php"); 
}

function cancel_ed() {
	$("#salesexecutive_id").val('');
	$("#executive_code").val('');
	$("#executive_name").val('');
	$("#designation").val('');
	$("#update").hide();
	$("#rest").show();
	$("#add").show();
	$("#salesexec").attr("action","<?php echo $home_path;?>/action/add_sales_executive.php");
}	


function checkExeCode(){
	executive_code=$('#executive_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatExeCode.php',
			data:{
			executive_code:executive_code
			},
			success:function(data){
				/* alert(data); */
				if(data==1){
					$('#slsexe_err').html('* Executive Code already exists.');
					$('#executive_code').val('');
				}
				else{
					$('#slsexe_err').html('');
				}
			}
	});
}
</script> 
		
		
<body class="bgBODY">
	 <div class="box">&nbsp;
	 
<div class="box-header well">	
		<!--<h3 style="font-size:14px;margin:0px;">Tax Types</h3>-->
		<h3 class="nameHdr">Sales Executive</h3>
	</div>
	 <br/>
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo"class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>	
<div class="defineDiv">
<div style="width:50%;float:left;/* padding:10px 0 0 25px; */">
<form id="salesexec" name="salesexec" action="<?php echo $home_path;?>/action/add_sales_executive.php" method="post" class="defineForm" style="box-shadow:0 3px 3px 3px rgba(0,0,0,0.76);margin: 0 0 12px 0;padding:20px 0 0 0;">
<span id="slsexe_err" class="myerror1"></span>
<input type="hidden" name="salesexecutive_id" id="salesexecutive_id" value=""/>
	<div style="margin:0px 0 0 50px;">
	<p>
	<label >Exec. Code  <em></em></label><input type="text" name="executive_code" id="executive_code" onblur="checkExeCode();" class="codesUPPERCase"/>
	</p>
	<p>
	<label >Exec. Name <em></em></label><input type="text" name="executive_name" id="executive_name" data-validation="required" class="input validate[required] fstChUPPRCase" />
	</p>
	<p>
	<label >Designation <em></em></label><input type="text" name="designation" id="designation" data-validation="required" class="input validate[required] fstChUPPRCase" />
	</p>
	<p>
		<label >Status <em></em></label>
		<input type="radio" name="status" id="status_active" value="1" id="IDofInput" checked /><label style="width:70px;vertical-align: text-top;">Active</label>
		<input type="radio" name="status" id="status_passive" value="0" /><label style="width:54px;vertical-align: text-top;">Passive</label>
	</p>

<div class="defineSubmit">
	<button type="submit" id="add" class="button_example bnkSbt"><img src="../../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
		
	<button type="submit" id="update" class="button_example bnkSbt" style="display:none;"><img src="../../images/update.png" class="sbtBtnImg" />&nbsp;&nbsp;Update</button>
	
	<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed();" ><img src="../../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
	
	<button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" onClick="self.close();" ><img src="../../images/cancel.png" class="sbtBtnImg" style="width:20px;height:20px;"/>&nbsp;&nbsp;Exit</button>
</div>
</div>	
</div>


<div class="col-sm-6" id="invoice" style="width:47%;float:left;margin:0 0 0 12px;overflow:auto;height:295px;border:1px solid #888888;">

<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="/* margin:10px 5px 15px 11px; */text-align:center;font-size:12px;width:100%;">
<tr class="info">
	<td colspan="6" style="text-align:center;"><b>View Sales Executive Details</b></td>
</tr>
<tr>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Code</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Name</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Designation</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>
</tr>
<?php 
$sql=mysql_query("select * from sales_executive");
$x=0;
if(mysql_num_rows($sql)>0) {
while($row=mysql_fetch_array($sql)) {
	$x++;
	if($row['status']==1){
		$status='Active';
	}else{
		$status='Deactive';
	}
?>
<tr>
	<td width="80" style="text-align:center;"><?php echo $x; ?></td>
	<td width="80" class="codesUPPERCase"><?php echo $row['executive_code']; ?></td>
	<td width="80" class="fstChUPPRCase"><?php echo $row['executive_name']; ?></td>
	<td width="80" class="fstChUPPRCase"><?php echo $row['designation']; ?></td>
	<td width="80" class="fstChUPPRCase"><?php echo $status; ?></td>
	<td width="80">
	<a onclick="edit_unit('<?php echo $row['salesexecutive_id'];?>','<?php echo $row['executive_code'];?>','<?php echo $row['executive_name'];?>','<?php echo $row['designation'];?>','<?php echo $row['status'];?>')" style="cursor:pointer;" class="">Edit</a>&nbsp;
	
	</td>
</tr>
<?php } } else{ ?>	
<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
						   You have not created any Sales Executive details...
</div>
<?php } ?>
</table>
</div>


</form>
	</div>
</body>