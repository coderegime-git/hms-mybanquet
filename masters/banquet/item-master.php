<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>
 <!--form validation-->	
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-customValidations.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-debugger.js"></script>

<!--<script src="../../js/shortcut.js" type="text/javascript"></script>-->

<!-- Datepicker start
<script src="<?php /* echo $home_path; */?>/date-picker/jquery-1.10.2.js"></script>-->
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
  
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
$('form[name="hotelDefi"]').validVal().validValDebug();
$('form[name="hotelDefi"]').validVal();

});

 shortcut.add("Ctrl+S",function() { 
	 $('#hotelDefi').attr('action', '../../action/add_hotel_definition.php');  
	 $('#hotelDefi').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_hotel_definition.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#hotelDefi').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});

function checkPropertyCode(){
	propCode=$('#prop_code').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatPropertyCode.php',
			data:{
			propCode:propCode
			},
			success:function(data){
				 /* alert(data);  */
				if(data==1){
					alert('Property Code already exists!.');
					$('#prop_code').val('');
				}
				else{
				
				}
			}
	});
}

function submenuCat(){
submCat=$('#submn_cat').val();
/* alert(submCat); */
	$.ajax({
		type:'GET',
		url:'  ../../action/smMenuCAT.php',
			data:{
			submCat:submCat
			},
			success:function(data){
				 /* alert(data); */
			opt=data.split(',');		
			$('#menu_type').val(opt[0]);			
			$('#menu_cate').val(opt[1]);			
				/* if(data==1){
					alert('Property Code already exists!.');
					$('#prop_code').val('');
				}
				else{
				
				} */
			}
	});	
}

</script> 
<body class="bgBODY">
<div class="">
<div id="invoice" style="">
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
    padding: 0px 9px 0 5px;
		
}
</style>
			
	<div id="addcustomer" class="frmCentr divBrd" style="width:698px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Item Master</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_item_master.php" method="post" class="" style="">
		<div>
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
					<td width="" valign="top"><label>Effective Date<em>*</em></label></td>
					<td valign="top"><input name="effect_date" id="effect_date" type="text" class="input required textbox codesUPPERCase datepicker" style=""/>
					</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Item Code <em>*</em></label></td>
					<td valign="top"><input name="item_code" id="item_code" type="text" class="input required textbox fstChUPPRCase" style=""/></td>
				</tr>
					<tr>
						<td width="" valign="top"><label>Item Name<em>*</em></label></td>
						<td valign="top"><input name="item_name" id="item_name" type="text" class="input required textbox fstChUPPRCase" style="" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Menu Type</label></td>
						<td valign="top"><input name="menu_type" id="menu_type" type="text" class="textbox fstChUPPRCase required" style="" readonly /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Menu Category<em>*</em></label></td>
						<td width="" valign="top"><input name="menu_cate" id="menu_cate" type="text" class="textbox fstChUPPRCase required" style="" readonly /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Sub Menu Category</label></td>
						<td valign="top">
						<?php $sqlRt=mysql_query("select distinct submn_catcd,submn_catnm from pos_submenucat");?>
							<select name="submn_cat" id="submn_cat" class="textbox input required fstChUPPRCase" style="" onchange="submenuCat();">
							<option value="">--Select--</option>
							<?php while($rowRt=mysql_fetch_array($sqlRt)){?>
							<option class="codesUPPERCase" value="<?php echo $rowRt['submn_catcd'];?>" ><?php echo $rowRt['submn_catnm'];?></option>
							<?php } ?>
							</select>
						</td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Remarks</label></td>
						<td valign="top"><input name="remarks" id="remarks" type="text" class="textbox fstChUPPRCase" style="" /></td>
						
					</tr>
					<tr>
						<td><label>Status </label></td>
						<td width="" valign="top"><input type="radio" name="status" id="status_active" value="1"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Yes</span>
						<input name="status" id="status_passive" type="radio" value="0" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">No</span></td>
					</tr>
					
					</tbody>
				</table>
			
			
			<table style="width:50%;margin:4px 0 0 0;" class="table">
					<tbody>
					<tr>
					<td width="" valign="top"><label>Cost % <em>*</em></label></td>
					<td valign="top"><input name="cost_per" id="cost_per" type="text" class="input required textbox fstChUPPRCase" style=""/></td>
					</tr>
					<tr>
							<td width="" valign="top"><label>Print Order</label></td>
							<td valign="top"><input name="print_order" id="print_order" type="text" class="textbox required" style="" /></td>
						</tr>
						<tr>
							<td><label>Discount </label></td>
						<td width="" valign="top"><input type="radio" name="disc" id="status_active" value="1"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span class="spanClr">Yes</span>
						<input name="disc" id="status_passive" type="radio" value="0" style="width:10px;margin:3px 0 0 0;float:left;"/><span class="spanClr">No</span></td>
						</tr>
					<tr>
					<td width="" valign="top"><label>Default Bill<em>*</em></label></td>
					<td valign="top"><input name="def_bill" id="def_bill" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox fstChUPPRCase" style=""/></td>
					</tr>
				</tbody>
			</table>
			
			
			
			<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Outlet</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Rate</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Kitchen</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Tax</th>
	</tr>
	<?php
	 $sqlu="select outlet_code,outlet_name from res_outletmaster";
	 $rowu=mysql_query($sqlu);
	 while($resultu=mysql_fetch_array($rowu)) { 
	?>
	<tr>	
		<td><input type="text" name="item_outlet[]" id="item_outlet" value="<?php echo $resultu['outlet_name']; ?>" readonly /></td>
		<td><input type="text" name="item_rate[]" id="item_rate" value=""/></td>
		<td><input type="text" name="item_kitc[]" id="item_kitc" value=""/></td>
		<td><input type="text" name="item_tax[]" id="item_tax" value=""/></td>
	</tr>	
	<?php  }  ?>	
</table>
	</div>
	
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 0px;">
		<button type="submit" id="add" class="button_example bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-prop-definit.php"><button type="button" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
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