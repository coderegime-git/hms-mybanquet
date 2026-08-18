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

function outLetCode(){
outCde=$('#outlet_code').val();
$('#payMd').hide();
document.location.href="paymode_restriction.php?outlet="+outCde;

	
	
}

/*   $('#billsrcv').change(function() {
  bls="";
  if($(this).val()!=''){bls = "?bls="+$(this).val(); }
  document.location.href="outstanding_report.php"+bls;	
  });

  
$('#searchBtn').click(function(){
	item="?val="+$('#searchTxt').val();
	document.location.href="day_summary.php"+item;
});  */
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
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Paymode Restriction</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_paymode_rest.php" method="post" class="" style="">
		<div>
			<?php
			$sqlu="select prop_code,prop_name from property_definition";
			$rowu=mysql_query($sqlu);
			$resultu=mysql_fetch_array($rowu);
			?>
					
			<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
					<td width="" valign="top"><label>User Code<em>*</em></label></td>
					<td valign="top"><input name="user_code" id="user_code" type="text" class="input required textbox codesUPPERCase" style="" value="<?php echo $resultu['prop_name']; ?>" readonly />
					</td>
				</tr>
			</tbody>
			</table>
			
			
<table style="width:50%;margin:4px 0 0 0;" class="table">
<tbody>
<tr>
	<td width="" valign="top"><label>Outlet Code<em>*</em></label></td>
	<td valign="top">
		<select name="outlet_code" id="outlet_code" onchange="outLetCode();">
		<option value="">--Select--</option>
		<?php
		$sqlu="select outlet_code,outlet_name from pos_outlet";
		$rowu=mysql_query($sqlu);
		while($resultu=mysql_fetch_array($rowu)) { 	?>
		<?php if($resultu['outlet_code']==$_GET['outlet']){ ?>
		<option value="<?php echo $resultu['outlet_code'];?>" selected ><?php echo $resultu['outlet_name'];?></option>
		<?php }else{ ?>
		<option value="<?php echo $resultu['outlet_code'];?>"><?php echo $resultu['outlet_name'];?></option>
		<?php } } ?>
		</select>
	</td>
</tr>
</tbody>
</table>
			
			
			
			<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;border:none;">
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sr. No.</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Payment Type</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Access</th>
	</tr>
	
<?php 
if(isset($_GET['outlet'])) {
$sqlC=mysql_query("select * from pos_paymode where outlet_code='".$_GET['outlet']."' AND payment_type='Cash'");
$rowC=mysql_fetch_array($sqlC);

$sqlCr=mysql_query("select * from pos_paymode where outlet_code='".$_GET['outlet']."' AND payment_type='Creditcard'");
$rowCr=mysql_fetch_array($sqlCr);

$sqlCo=mysql_query("select * from pos_paymode where outlet_code='".$_GET['outlet']."' AND payment_type='Company'");
$rowCo=mysql_fetch_array($sqlCo);

$sqlv=mysql_query("select * from pos_paymode where outlet_code='".$_GET['outlet']."' AND payment_type='Void'");
$rowv=mysql_fetch_array($sqlv);

$sqlr=mysql_query("select * from pos_paymode where outlet_code='".$_GET['outlet']."' AND payment_type='Room'");
$rowr=mysql_fetch_array($sqlr);

$sqlcp=mysql_query("select * from pos_paymode where outlet_code='".$_GET['outlet']."' AND payment_type='Compliment'");
$rowcp=mysql_fetch_array($sqlcp);

$sqls=mysql_query("select * from pos_paymode where outlet_code='".$_GET['outlet']."' AND payment_type='Staff'");
$rows=mysql_fetch_array($sqls);
}
?>
<?php if(isset($_GET['outlet'])) { ?>
	<tr>	
		<td style="width:40px;text-align:center;"><input type="text" name="srno[]" id="item_outlet" value="1" style="width:30px;border:none;" readonly /></td>
		<td><input type="text" name="payment_type[]" id="item_rate" value="Cash" style="border:none;" readonly /></td>
		<td>
		<select name="access[]" id="" style="width:80px;">
		<option value="yes"<?php echo ($rowC['access']=='yes')?'selected':''; ?> >Yes</option>
		<option value="no"<?php echo ($rowC['access']=='no')?'selected':''; ?>>No</option>
		</select ></td>
	</tr>

<tr>	
		<td style="width:40px;text-align:center;"><input type="text" name="srno[]" id="item_outlet" value="2" style="width:30px;border:none;" readonly /></td>
		<td><input type="text" name="payment_type[]" id="item_rate" value="Creditcard" style="border:none;" readonly /></td>
		<td>
		<select name="access[]" id="" style="width:80px;">
	
		<option value="yes"<?php echo ($rowCr['access']=='yes')?'selected':''; ?>>Yes</option>
		<option value="no"<?php echo ($rowCr['access']=='no')?'selected':''; ?>>No</option>
		</select ></td>
	</tr>	
	<tr>	
		<td style="width:40px;text-align:center;"><input type="text" name="srno[]" id="item_outlet" value="3" style="width:30px;border:none;" readonly /></td>
		<td><input type="text" name="payment_type[]" id="item_rate" value="Company" style="border:none;" readonly /></td>
		<td>
		<select name="access[]" id="" style="width:80px;">
		
		<option value="yes"<?php echo ($rowCo['access']=='yes')?'selected':''; ?>>Yes</option>
		<option value="no"<?php echo ($rowCo['access']=='no')?'selected':''; ?>>No</option>
		</select ></td>
	</tr>
	<tr>	
		<td style="width:40px;text-align:center;"><input type="text" name="srno[]" id="item_outlet" value="4" style="width:30px;border:none;" readonly /></td>
		<td><input type="text" name="payment_type[]" id="item_rate" value="Void" style="border:none;" readonly /></td>
		<td>
		<select name="access[]" id="" style="width:80px;">
	
		<option value="yes"<?php echo ($rowv['access']=='yes')?'selected':''; ?>>Yes</option>
		<option value="no"<?php echo ($rowv['access']=='no')?'selected':''; ?>>No</option>
		</select ></td>
	</tr>
	<tr>	
		<td style="width:40px;text-align:center;"><input type="text" name="srno[]" id="item_outlet" value="5" style="width:30px;border:none;" readonly /></td>
		<td><input type="text" name="payment_type[]" id="item_rate" value="Room" style="border:none;" readonly /></td>
		<td>
		<select name="access[]" id="" style="width:80px;">
		
		<option value="yes"<?php echo ($rowr['access']=='yes')?'selected':''; ?>>Yes</option>
		<option value="no"<?php echo ($rowr['access']=='no')?'selected':''; ?>>No</option>
		</select ></td>
	</tr>
	<tr>	
		<td style="width:40px;text-align:center;"><input type="text" name="srno[]" id="item_outlet" value="6" style="width:30px;border:none;" readonly /></td>
		<td><input type="text" name="payment_type[]" id="item_rate" value="Compliment" style="border:none;" readonly /></td>
		<td>
		<select name="access[]" id="" style="width:80px;">
		
		<option value="yes"<?php echo ($rowcp['access']=='yes')?'selected':''; ?>>Yes</option>
		<option value="no"<?php echo ($rowcp['access']=='no')?'selected':''; ?>>No</option>
		</select ></td>
	</tr>
	<tr>	
		<td style="width:40px;text-align:center;"><input type="text" name="srno[]" id="item_outlet" value="7" style="width:30px;border:none;" readonly /></td>
		<td><input type="text" name="payment_type[]" id="item_rate" value="Staff" style="border:none;" readonly /></td>
		<td>
		<select name="access[]" id="" style="width:80px;">
	
		<option value="yes"<?php echo ($rows['access']=='yes')?'selected':''; ?>>Yes</option>
		<option value="no"<?php echo ($rows['access']=='no')?'selected':''; ?>>No</option>
		</select ></td>
	</tr>
<?php } ?>
<!--<tbody id="payMd">
	<tr style="height:350px;border:1px solid #000;" >
	<td></td>
	</tr>
</tbody>-->
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