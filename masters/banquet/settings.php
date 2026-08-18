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
jQuery("#setting").validationEngine();
});
	SyntaxHighlighter.defaults['toolbar'] = false;
	SyntaxHighlighter.all();
	
	
function edit_unit(id,code,cny,pre,sts) {
	$("#setting_id").val(id);
	$("#date_init").val(code);
	$("#sett_text").val(cny);
	if(pre=='1'){
		$('#presuff_active').prop('checked', true);
		}
		else{
			$('#presuff_passive').prop('checked', true);
		}
	if(sts=='1'){
		$('#status_active').prop('checked', true);
		}
		else{
			$('#status_passive').prop('checked', true);
		}
	$("#update").show();
	$("#rest").show();
	$("#add").hide();
	$("#setting").attr("action","<?php echo $home_path;?>/action/add_setting.php"); 
}

function cancel_ed() {
	$("#setting_id").val('');
	$("#date_init").val('');
	$("#sett_text").val('');
	$("#presuff").val('');
	$("#status").val('');
	$("#update").hide();
	$("#rest").show();
	$("#add").show();
	$("#setting").attr("action","<?php echo $home_path;?>/action/add_setting.php");
}	


function checkCurrencyCode() {
	payment_mode=$('#payment_mode').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatSetting.php',
			data:{
			payment_mode:payment_mode
			},
			success:function(data){
				/* alert(data); */
				if(data==1){
					$('#setting_err').html('* Payment Mode already exists.');
					$('#payment_mode').val('');
				}
				else{
					$('#setting_err').html('');
				}
			}
	});
}
</script> 
<body class="bgBODY">
	
<div class="box " style="width:99%;box-shadow: -4px 6px 10px -3px rgba(0,0,0,0.76);float:left;padding:14px 0 0 10px;margin:0px 0 0 5px;border-right:1px solid #C6C9CE;border-left:1px solid #BBBED4;background:rgba(255,255,255,0.7);" >&nbsp;

	<div class="box-header well">	
		<h3 class="nameHdr">Settings</h3>
	</div>
	 <br/>
 
<div style="width:50%;float:left;box-shadow:0 3px 3px 3px rgba(0,0,0,0.76);">	
	<div style="margin:20px 0 0 50px;">
		<form id="setting" name="setting" action="<?php echo $home_path;?>/action/add_setting.php" method="post" class="" >
			<span id="setting_err" class="myerror1"></span>
			<input type="hidden" name="setting_id" id="setting_id" value=""/>
			<p>
			<label>Date of init.<em></em></label><input type="text" name="date_init" id="date_init" data-validation="required" class="input validate[required]" onblur="checkCurrencyCode();" style="text-transform:uppercase;"/>
			</p>
			<p>
			<label>Text<em></em></label><input type="text" name="sett_text" id="sett_text" data-validation="required" class="input validate[required]" onblur="checkTaxCode();" style=""/>
			</p>
			<p>
			<label>Prefix/Suffix<em></em></label>
			<input type="radio" name="presuff" id="presuff_active" value="1" style="margin:0 0 0 -4px;" checked /><label style="margin:0 0 0 -7px;vertical-align:sub;">Prefix</label>
			<input type="radio" name="presuff" id="presuff_passive" value="0" style="margin:0 0 0 -72px;"/><label style="margin:0 0 0 -7px;">Suffix</label>
			</p>
			<p>
			<label>Status<em></em></label>
			<input type="radio" name="status" id="status_active" value="1" style="margin:0 0 0 -4px;" checked /><label style="margin:0 0 0 -7px;vertical-align:sub;">Active</label>
			<input type="radio" name="status" id="status_passive" value="0" style="margin:0 0 0 -72px;"/><label style="margin:0 0 0 -7px;">Passive</label>
			</p>
			<div style="margin:35px 0 0 24px;padding:0 0 50px 0;">
			<button type="submit" id="add" class="button_example bnkSbt"><img src="../../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
			
			<button type="submit" id="update" class="button_example bnkSbt" style="display:none;"><img src="../../images/update.png" class="sbtBtnImg" />&nbsp;&nbsp;Update</button>
			
			<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed();" ><img src="../../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
			
			<button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" onClick="self.close();" ><img src="../../images/cancel.png" class="sbtBtnImg" style="width:20px;height:20px;"/>&nbsp;&nbsp;Exit</button>
			</div>
	</div>
</div>


<div class="col-sm-6" id="invoice" style="width:47%;float:left;margin:0 0 0 12px;overflow:auto;height:319px;">

 <table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 5px 15px 11px;text-align:center;font-size:12px;width:97%;">
	<tr class="info">
		<td colspan="7" style="text-align:center;"><b>View Setting Details</b></td>
	</tr>
<tr>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Date of init.</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Text</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Prefix/Suffix</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>
</tr>
	<?php 
	$sql=mysql_query("select * from setting");
	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		if($row['presuff']==1){
			$presuff='Prefix';
		}else{
			$presuff='Suffix';
		}
		
		if($row['status']==1){
			$status='Active';
		}else{
			$status='Deactive';
		}
	?>
	<tr>
		<td width="80" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80" style="text-align:center;"><?php echo $row['date_init']; ?></td>
		<td width="80" style="text-align:center;"><?php echo $row['sett_text']; ?></td>
		<td width="80" style="text-align:center;"><?php echo $presuff; ?></td>
		<td width="80" style="text-align:center;"><?php echo $status; ?></td>
		<td width="80" style="text-align:center;">
<a onclick="edit_unit('<?php echo $row['setting_id'];?>','<?php echo $row['date_init'];?>','<?php echo $row['sett_text'];?>','<?php echo $row['presuff'];?>','<?php echo $row['status'];?>')" style="cursor:pointer;" >Edit</a>&nbsp;
		</td>
	<?php } } else{ ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any Setting details...
    </div>
<?php } ?>
</table>
</div>
</div>
</form>	
</body>