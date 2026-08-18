<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>
<style>
 label {width: 190px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;text-align:right;font-size:13px;} 
.multiselect {
    width:10em;
    height:6.8em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
    color:#ffffff;
    background-color:#000099;
}
</style>
 <!--form validation-->	
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-customValidations.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-debugger.js"></script>

<script src="../../js/shortcut.js" type="text/javascript"></script>
<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	 $('form[name="hotelDefi"]').validVal().validValDebug();
  $('form[name="hotelDefi"]').validVal();
	
	jQuery.fn.multiselect = function() {
		$(this).each(function() {
			var checkboxes = $(this).find("input:checkbox");
			checkboxes.each(function() {
				var checkbox = $(this);
				// Highlight pre-selected checkboxes
				if (checkbox.prop("checked"))
					checkbox.parent().addClass("multiselect-on");
	 
				// Highlight checkboxes that the user selects
				checkbox.click(function() {
					if (checkbox.prop("checked"))
						checkbox.parent().addClass("multiselect-on");
					else
						checkbox.parent().removeClass("multiselect-on");
				});
			});
		});
	};

	
	$('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });

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
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Table Master</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_table_master.php" method="post" class="" style="">
		<div>
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Table No<em>*</em></label></td>
						<td valign="top"><input name="table_no" id="table_no" type="text" class="input required textbox codesUPPERCase" style="width:210px"/>
						</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Maximum Covers<em>*</em></label></td>
					<td valign="top"><input name="max_covers" id="max_covers" type="text" class="input required textbox fstChUPPRCase" style="width:210px"/></td>
				</tr>
					
					<tr>
						<td width="" valign="top"><label>Location<em>*</em></label></td>
						<td valign="top"><input name="location" id="location" type="text" class="input required textbox fstChUPPRCase" style="width:210px" /></td>
						
					</tr>
									
					</tbody>
				</table>
			
			
			<table style="width:16%;margin:4px 75px 0 0px;float:right;" class="table">
					<tbody>
					<tr>
			<td width="145" valign="top"></td>
			<td width="" valign="top" >
			<div style="font-size:12px;font-weight:bold;text-align:center;">Applicable Outlets</div>
				<div class="multiselect" name="pay_group" id="pay_group">
					<label class="bankUnitcd"><input type="checkbox" name="" value="all" onclick="checkAdmin();" id="selecctall"/>&nbsp;All</label>
			<?php
			 $sqlu="select outlet_code,outlet_name from pos_outlet";
			$rowu=mysql_query($sqlu);
			while($resultu=mysql_fetch_array($rowu)) { 
			?>
			<label class="bankUnitcd"><input type="checkbox" name="option[]" id="<?php  echo $resultu['outlet_code']; ?>" value="<?php  echo $resultu['outlet_code']; ?>" class="checkbox1 chk"/>&nbsp;<?php echo $resultu['outlet_name']; ?></label>
			<?php  }  ?>	

				</div><br/>
			<span id="paygroup_err" class="myerror">
			</td>		
			</tr>	
					
										
						
				</tbody>
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