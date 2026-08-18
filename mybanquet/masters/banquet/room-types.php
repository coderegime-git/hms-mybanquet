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
	 $('#taxTypes').attr('action', '../../action/add_roomtype.php');  
	 $('#taxTypes').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_room_type.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#taxTypes').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});

function checkRoomtyCode(){
	room_code=$('#room_code').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatRoomtype.php',
			data:{
			room_code:room_code
			},
			success:function(data){
				  /* alert(data); */  
				if(data==1){
					alert('Room Code already exists.');
					/* $('#msgFoprop').html('* Tax Code already exists.'); */
					$('#room_code').val('');
				}
				else{
					$('#msgFoprop').html('');
				}
			}
	});
}

function checkRoomtyDesc(){
	roomDesc=$('#room_desc').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatRoomtypeDesc.php',
			data:{
			roomDesc:roomDesc
			},
			success:function(data){
				/*  alert(data); */ 
				if(data==1){
					alert('Room Description already exists.');
					$('#room_desc').val('');
				}
				else{
					$('#msgFoprop').html('');
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
			
	<div id="addcustomer" style="border:1px solid #ddd;width:468px;margin:0 0 0 112px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Room Types</b></h3>
		<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_roomtype.php" method="post" class="" style="">
		<div>
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Applicable Date<em>*</em></label></td>
						<td valign="top"><input type="text" name="applicable_date" data-validation="required" class="input validate[required] datepicker" />
						</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Type Code <em>*</em></label></td>
					<td valign="top"><input type="text" name="room_code" id="room_code" data-validation="required" class="input validate[required] codesUPPERCase" onblur="checkRoomtyCode();" /></td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Type Desc <em>*</em></label></td>
					<td valign="top"><input type="text" name="room_desc" id="room_desc" data-validation="required" class="input validate[required] fstChUPPRCase" onblur="checkRoomtyDesc();" /></td>
				</tr>
					
					<tr>
						<td width="" valign="top"><label>Total Rooms<em>*</em></label></td>
						<td valign="top"><input type="text" name="total_rooms" id="total_rooms" data-validation="required" class="input validate[required,custom[integer]] fstChUPPRCase" onblur="checkTaxCodeDesc();"/></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Over Booking %<em>*</em></label></td>
						<td valign="top"><input type="text" name="over_booking" id="over_booking" data-validation="required" class="input validate[required,custom[number]] fstChUPPRCase" onblur="checkTaxCodeDesc();"/></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Display Seq.<em>*</em></label></td>
						<td valign="top"><input type="text" name="disp_seq" id="disp_seq" data-validation="required" class="input validate[required,custom[integer]] fstChUPPRCase" onblur="checkTaxCodeDesc();"/></td>
						
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
	<div style="margin:0 0 0 1px;">
		<button type="submit" id="add" class="button_example bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view_room_type.php"><button type="button" id="update" class="button_example bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="button_example" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	</td>
	</tr>
	</table>
	</form>	
	
	

	</div>
	</div>
</body>
</html>