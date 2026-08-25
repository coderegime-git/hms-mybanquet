<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<style>
 label { width: 190px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;text-align:right;font-size:13px;} 
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

<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">

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
	
	$('#selecctall').click(function(event) {  
        if(this.checked) { 
            $('.chk').each(function() { 
                this.checked = true;               
            });
        }else{
            $('.chk').each(function() { 
                this.checked = false;                       
            });         
        }
    });
});

shortcut.add("Ctrl+S",function() { 
	$('#taxTypes').attr('action', '<?php echo $home_path;?>/action/update_valid_settle.php');  
	$('#taxTypes').submit(); 
}); 
shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_valid_settlement_bqt.php";
});
shortcut.add("Ctrl+C",function() { 
	$('#taxTypes').find("input[type=text], textarea").val("");
});
shortcut.add("Ctrl+E",function() { 
	window.location.href = "view_valid_settlement_bqt.php";
});

</script> 
<body class="bgBODY">
<div id="invoice" style="">
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
$sql = mysql_query("select * from pos_validsettle where valid_id='".$_GET['valid_id']."'");
$row = mysql_fetch_array($sql);
$outlets_arr = explode(',', $row['outlets']);
?>
			
	<div id="addcustomer" class="frmCentr divBrd" style="width:570px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Edit Valid Settlements(Bqt)</b></h3>
		<form id="taxTypes" name="taxTypes" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/update_valid_settle.php" method="post" class="" style="">
		<input type="hidden" name="valid_id" id="valid_id" value="<?php echo $row['valid_id']; ?>" />
		<div>
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>
				<tr>
					<td width="" valign="top"><label>Outlet Code<em>*</em></label></td>
					<td valign="top"><input type="text" name="outlet_code" id="outlet_code" class="textbox input required" value="<?php echo $row['outlet_code']; ?>" />
					</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Outlet Name <em>*</em></label></td>
					<td valign="top"><input type="text" name="outlet_name" id="outlet_name" class="textbox input required" value="<?php echo $row['outlet_name']; ?>" /></td>
				</tr>
				<tr>
					<td width="145" valign="top" style="font-size:12px;text-align:right;">Applicable Outlets</td>
					<td width="" valign="top" >
						<div class="multiselect" name="outlets" id="outlets" style="width:20em;height:7.8em;">
							<label class="bankUnitcd"><input type="checkbox" name="option[]" value="staff" <?php if(in_array('staff', $outlets_arr) || in_array('all', $outlets_arr)) echo 'checked'; ?> id="" class="chk" />&nbsp;Staff</label>
							<label class="bankUnitcd"><input type="checkbox" name="" value="all" id="selecctall" class="chk"/>&nbsp;All</label>
							<label class="bankUnitcd"><input type="checkbox" name="option[]" value="credit_card" <?php if(in_array('credit_card', $outlets_arr)) echo 'checked'; ?> id="" class="chk" />&nbsp;Credit Card</label>
							<label class="bankUnitcd"><input type="checkbox" name="option[]" value="cash" <?php if(in_array('cash', $outlets_arr)) echo 'checked'; ?> id="" class="chk" />&nbsp;Cash</label>
							<label class="bankUnitcd"><input type="checkbox" name="option[]" value="plan" <?php if(in_array('plan', $outlets_arr)) echo 'checked'; ?> id="" class="chk" />&nbsp;Plan</label>
							<label class="bankUnitcd"><input type="checkbox" name="option[]" value="company" <?php if(in_array('company', $outlets_arr)) echo 'checked'; ?> id="" class="chk" />&nbsp;Company</label>
							<label class="bankUnitcd"><input type="checkbox" name="option[]" value="void" <?php if(in_array('void', $outlets_arr)) echo 'checked'; ?> id="" class="chk" />&nbsp;Void</label>
							<label class="bankUnitcd"><input type="checkbox" name="option[]" value="compli" <?php if(in_array('compli', $outlets_arr)) echo 'checked'; ?> id="" class="chk" />&nbsp;Complimentary</label>
							<label class="bankUnitcd"><input type="checkbox" name="option[]" value="billhold" <?php if(in_array('billhold', $outlets_arr)) echo 'checked'; ?> id="" class="chk" />&nbsp;Bill on Hold</label>
							<label class="bankUnitcd"><input type="checkbox" name="option[]" value="room" <?php if(in_array('room', $outlets_arr)) echo 'checked'; ?> id="" class="chk" />&nbsp;Room</label>
						</div><br/>
						<span id="paygroup_err" class="myerror"></span>
					</td>		
				</tr>
			</tbody>
			</table>
		</div>
				
		<table style="border-left:1px solid #ddd;" class="table">
		<tr>
			<td>	
			<div style="margin:0 0 0 1px;">
				<button type="submit" id="add" class="buttExam_sngl bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
				
				<a href="view_valid_settlement_bqt.php"><button type="button" id="update" class="buttExam_sngl bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
					
				<button type="reset" id="rest" class="buttExam_sngl" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
					
				<a href="<?php echo $home_path; ?>/masters/banquet/view_valid_settlement_bqt.php"><button type="button" id="exit" name="exit" class="buttExam_sngl" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
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
