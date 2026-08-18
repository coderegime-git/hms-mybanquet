<?php
ob_start();
include("../../config.php");
include("../../header.php");
/* include("../../menu.php"); */
?>

<style>
 label { width: 100px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;text-align:right;font-size:13px;} 
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
	 minDate: 0,
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
	 $('#taxTypes').attr('action', '../../action/add_tax_type.php');  
	 $('#taxTypes').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_define_tax.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#taxTypes').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});

function checkTaxCode(){
	taxCode=$('#tax_code').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatTaxCode.php',
			data:{
			taxCode:taxCode
			},
			success:function(data){
				  /* alert(data); */  
				if(data==1){
					alert('Tax Code already exists.');
					/* $('#msgFoprop').html('* Tax Code already exists.'); */
					$('#tax_code').val('');
				}
				else{
					$('#msgFoprop').html('');
				}
			}
	});
}

function checkOpenOutlet(){
val=$('#outletType').val();
opN=$('#open_outlet').val();
outS=$('#outlet_sess').val();
outDt=$('#outlet_date').val();
	/*  alert(val); */
if(val=='Fine Dine' || val=='Take Away'){
 $("#taxTypes").attr("action","<?php echo $home_path; ?>/transaction/frontdesk/kot-bill.php");
 $("#taxTypes").submit(); 
}
if(val=='Room Service'){
 $("#taxTypes").attr("action","<?php echo $home_path; ?>/transaction/frontdesk/room-service.php?rmS="+opN+"&ouSEs="+outS+"&otDt="+outDt);
 /* $("#taxTypes").attr("action","<?php echo $home_path; ?>/transaction/frontdesk/roomservice-bill.php"); */
 $("#taxTypes").submit();
}
			
}

function outletChg() {
	openL=$("#open_outlet").val();
	$.ajax({
		type:'GET',
		url:'  ../../action/chkopnOutlt.php',
			data:{
			openL:openL
			},
			success:function(data){
				 /* alert(data); */   
				 $('#outletType').val(data);
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
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Open Outlet</b></h3>
		<!--<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path; ?>/action/add_open_outlet.php" method="post" class="" style="">-->
		<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="#" method="post" class="" style="">
		<input type="text" id="outletType" name="outletType" value="" style="display:none;"/>
		<div>
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>
			<tr>
				<td width="" valign="top"><label>Outlet<em>*</em></label></td>
				<td valign="top">
				<?php $sqlRt=mysql_query("select outlet_code,outlet_name from pos_outlet");?>
					<select name="open_outlet" id="open_outlet" class="textbox input required fstChUPPRCase" onchange="outletChg();">
					<option value="">--Select--</option>
					<?php while($rowRt=mysql_fetch_array($sqlRt)) { ?>
					<option class="codesUPPERCase" value="<?php echo $rowRt['outlet_code'];?>" ><?php echo $rowRt['outlet_name'];?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Session <em>*</em></label></td>
				<td valign="top">
					<?php $sqlRt=mysql_query("select session_code,session_name from pos_session");?>
					<select name="outlet_sess" id="outlet_sess" class="textbox input required fstChUPPRCase">
					<option value="">--Select--</option>
					<?php while($rowRt=mysql_fetch_array($sqlRt)){?>
					<option class="codesUPPERCase" value="<?php echo $rowRt['session_code'];?>" ><?php echo $rowRt['session_name'];?></option>
					<?php } ?>
					</select>
				</td>
			</tr>
				<?php $date=date('d/m/Y');?>
				<tr>
					<td width="" valign="top"><label>Date <em>*</em></label></td>
					<td valign="top"><input type="text" name="outlet_date" id="outlet_date" data-validation="required" class="textbox input required" value="<?php echo $date; ?>" readonly /></td>
				</tr>
								
					</tbody>
				</table>
			</div>
				
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 1px;">
		<!--<a href="<?php echo $home_path; ?>/transaction/frontdesk/kot-bill.php">--><button type="button" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkOpenOutlet();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button><!--</a>-->
		
		<a href="view_define_tax.php"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
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