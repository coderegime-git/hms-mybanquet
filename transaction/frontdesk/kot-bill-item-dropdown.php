<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<style>
.buttexample {
background-color: #ffffff;
border: 1px solid #ddd;
color: #000;
font-family: arial,helvetica,sans-serif;
font-size: 12px;
margin-left: -3px;
padding: 4px 41px;
}

.sbtBImg{
	width:18px;
	height:18px;
	
}

.buttExaSS {
    background-color: #ffffff;
    border: 1px solid #888888;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
   /*  margin-left: -3px; */
    padding: 9px 0px;
    /* padding: 5px 59px; */
	width:154px;
}

.dblMas{
	color: #474747;
    display: block;
    float: right;
    font-size: 12px;
    font-weight: normal;
    padding: 3px 9px 0 0;
}
</style>
<style>
.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:26px 0 0 0px;padding:0;width:190px;position: absolute;z-index: 1;}
#country-list li{padding: 2px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}
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
			
	$("#item_code").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../../action/selectItemDetails.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			/* alert(data); */ 
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});	
			/* $(".vertical").keypress(function(event) {
        if(event.keyCode == 13) { 
        textboxes = $("input.vertical");
        debugger;
        currentBoxNumber = textboxes.index(this);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1]
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false 
            }
        }
    }); */
	
	

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

function outletOpen(){
	id=$('.ckPrint:checkbox:checked').val();
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/outletBillMenu.php','mywin','left=280,top=100,width=200,height=200,');
	newwindow.focus();
}

function tableNoOpn(){
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/outletKotOpn.php','mywin','left=280,top=100,width=200,height=200,');
	newwindow.focus();
}

function stewardOpn(){
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/outletstewOpn.php','mywin','left=280,top=100,width=200,height=200,');
	newwindow.focus();
	
}

function selectItem(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}

var rowCount = 0; 
function addMoreRows() {
	paxNo=$('#pax').val();
	rowCount=rowCount+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsED tr').length+2;
	/* $('#addedRowsED').html(''); */
	/* for(i=0;i<paxNo;i++) { */
		var recRow = '<tr id="rowCount'+rowCount+'"><td width="60"><input name="item_code[]" id="item_code'+rowCount+'" type="text" class="textbox codesUPPERCase itemCde" style="width:100px;margin:4px 0 0 0;"/><div id="suggesstion-box"></div></td><td width="200" class="codesUPPERCase"><input name="item_desc[]" id="item_desc'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:182px;margin:4px 0 0 0;"  /></td><td width="40" class="fstChUPPRCase"><input name="item_qty[]" id="item_qty'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;"  /></td>	<td width="50" class="fstChUPPRCase"><input name="item_rate[]" id="item_rate'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" /></td><td width="60" class="fstChUPPRCase"><input name="item_val[]" id="item_val'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" /></td><td width="100" class="fstChUPPRCase"><input name="item_pref[]" id="item_pref'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:193px;margin:4px 0 0 0;" /></td><td><a href="javascript:void(0);" onclick="removeRow('+rowCount+');" name="remove['+rowCount+']" id="remove_'+ rowCount +'" class="deleterecord" width="15"><img src="../../images/removeicon.png" style="width:18px;height:18px;"/></a></td></tr>';
		
		
		jQuery('#addedRowsED').append(recRow); 
		$('#rowCount').val(rowCount);
	/* } */
}
function removeRow(removeNum) {
		jQuery('#rowCount'+removeNum).remove(); 
	} 

</script> 
<body class="bgBODY">

<div class="col-sm- about">

<div id="invoice" style="">
		
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
	<?php
/* echo $_POST['open_outlet'];
die(); */
?>	
	<div id="addcustomer" class="frmCentr divBrd" style="width:789px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>K.O.T</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_property_definition.php" method="post" class="" style="">
		<div>
		
		<table style="width:100%;border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;margin:3px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Outlet<em></em></label></td>
						<td valign="top"><input name="outlet" id="outlet" type="text" class="input required textbox codesUPPERCase" onblur="checkPropertyCode();" style="width:100px;margin:3px 0 0 10px;" value="<?php if(isset($_POST['open_outlet'])){echo $_POST['open_outlet'];}?>" readonly /><label style="border:1px solid #8C8C8C;color: #474747;display: block;float: right;font-size: 12px;font-weight: normal;    padding: 0px 4px 1px 4px;margin:4px 0 0 0;" onclick="outletOpen();"><span class="btnUndLine">C</span>H</label>
						<!--<input name="prop_code" id="prop_code" type="text" class="input validate[required] textbox codesUPPERCase" value="CH" style="width:50px;text-align:center;margin:3px 0 0 10px;" readonly />-->
						</td>
					<td width="" valign="top"><label>Session<em>*</em></label></td>
					<td valign="top"><input name="prop_name" id="prop_name" type="text" class="input required textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" value="<?php if(isset($_POST['outlet_sess'])){ echo $_POST['outlet_sess'];}?>" readonly /></td>
					<td width="" valign="top"><label>Date<em>*</em></label></td>
						<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input required textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" value="<?php if(isset($_POST['outlet_date'])){ echo $_POST['outlet_date'];} ?>" readonly /></td>
						<td width="" valign="top"><label>Type</label></td>
						<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" value="Normal" readonly /></td>
						
					</tr>
									
					</tbody>
				</table>
<style>
/* .tblImg{
background: url(../../images/tblopn.png) no-repeat scroll 81px 3px;
background-size: 15px 15px;
padding-left:30px;	
} */

</style>
			<table style="width:100%;border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
						<td style="width:54px;" valign="top"><label>KOT#<em></em></label></td>
						<td valign="top"><input name="prop_code" id="prop_code" type="text" class="input required textbox codesUPPERCase" onblur="checkPropertyCode();" style="width:100px;margin:3px 0 0 10px;" value="Auto" readonly /><label style="border:1px solid #8C8C8C;color: #474747;display: block;float: right;font-size: 12px;font-weight: normal;    padding: 0px 4px 1px 4px;margin:4px 0 0 0;"><span class="btnUndLine">N</span>C</label>
						</td>
					<td style="width:122px;" valign="top"><label style="margin:0 0 0 0;">Table #<em>*</em></label></td>
					<td valign="top" style="width:50px;"><input name="table_no" id="table_no" type="text" class="input required textbox fstChUPPRCase tblImg" style="width:100px;margin:4px 0 0 0;"/>
					 <img src="../../images/tblopn.png" style="width:16px;height:16px;margin:8px 0 0 -19px;cursor:pointer;" id="input_img" onclick="tableNoOpn();" >
					</td>
					<!--<div id="input_container">
    <input type="text" id="input" value>
    <img src="../../images/tblopn.png" style="width:15px;height:15px;" id="input_img">
</div>-->
					<td style="width:101px;" valign="top"><label>Covers<em>*</em></label></td>
						<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input required textbox fstChUPPRCase" style="width:100px;margin:4px 0 0 0;" /></td>
						<td style="width:50px;" valign="top"><label>Steward</label></td>
						<td valign="top"><input name="steward_cde" id="steward_cde" type="text" class="textbox required fstChUPPRCase" style="width:100px;margin:4px 0 4px 0;" onclick="stewardOpn();" /></td>
						
					</tr>
					<!--<tr>
						<td width="" valign="top"><label>Name<em>*</em></label></td>
						<td valign="top"><input name="prop_code" id="prop_code" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" style="width:100px;margin:4px 0 0 0;"/>
						
						</td>
					<td width="" valign="top"><label>Mobile<em>*</em></label></td>
					<td valign="top"><input name="prop_name" id="prop_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:100px;margin:4px 0 0 0;"/></td>
					</tr>-->
					</tbody>
				</table>
				
		
			<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 0px 0px;text-align:center;font-size:12px;">
	<tr>
		<!--<th width="20" style="text-align:center;background-color:#F5F5F5;">S.No.</th>-->
		<th width="60" style="text-align:center;background-color:#F5F5F5;">Item Code</th>
		<th width="200" style="text-align:center;background-color:#F5F5F5;">Item Desc</th>
		<th width="40" style="text-align:center;background-color:#F5F5F5;">Qty</th>
		<th width="50" style="text-align:center;background-color:#F5F5F5;">Item Rate</th>
		<th width="60" style="text-align:center;background-color:#F5F5F5;">Value</th>
		<th width="100" style="text-align:center;background-color:#F5F5F5;">Preferences</th>
		<th><img src="../../images/plus.png" id="add-item" onclick="addMoreRows(this.form);" style="width:20px;height:20px;cursor:pointer;"/></th>
	</tr>
	<?php   for($i=0;$i<5;$i++){  ?>
	<tbody id="tblRw" >
	<tr>
		<!--<td width="20" style="text-align:center;"><input name="item_srl[]" id="item_srl" type="text" class="textbox codesUPPERCase " style="width:30px;margin:4px 0 0 0;"  /></td>-->
		<td width="60"><input name="item_code[]" id="item_code" type="text" class="textbox codesUPPERCase itemCde" style="width:100px;margin:4px 0 0 0;"/>
		<div id="suggesstion-box"></div>
		</td>
		<td width="200" class="codesUPPERCase"><input name="item_desc[]" id="item_desc" type="text" class="textbox codesUPPERCase" style="width:182px;margin:4px 0 0 0;"  /></td>
		<td width="40" class="fstChUPPRCase"><input name="item_qty[]" id="item_qty" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;"  /></td>
		<td width="50" class="fstChUPPRCase"><input name="item_rate[]" id="item_rate" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;"  /></td>
		<td width="60" class="fstChUPPRCase"><input name="item_val[]" id="item_val" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;"  /></td>
		<td width="100" class="fstChUPPRCase"><input name="item_pref[]" id="item_pref" type="text" class="textbox codesUPPERCase" style="width:193px;margin:4px 0 0 0;" onkeyup="addMoreRows();" /></td>
	</tr>
	</tbody>
	<!--<script>
	var rowTblCo = $('#addedRowsED tr').length+1;
	</script>
	<tbody  style="height:200px;border:1px solid #000;">
	<tr>
	</tr>
	</tbody>-->
	<?php   }   ?>
	<tbody id="addedRowsED" style="">
	</tbody>
</table>

<table class="" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;width:152px;float:right;">
<tr>
	<!--<td width="" valign="top"><label>Total Qty<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>-->
	<td></td>
	<td></td>
	<td width="" valign="top"><label>Sub Total<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td width="" valign="top"><label>Tax<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td width="" valign="top"><label>Disc<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
</tr>
<tr>
	<td></td>
	<td></td>
	<td width="" valign="top"><label>Total<em></em></label></td>
	<td valign="top"><input name="prop_code" id="prop_code" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" readonly /></td>
</tr>
</table>

<!--<div style="width:8.%;float:left;margin:20px 0 0 11px;">
<table style="margin:0 0 0 0px;">

<tr>
<td>
	<a href="<?php echo $home_path;?>/transaction/frontdesk/billing-screen.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="submit" class="buttExaSS bnkSbt frstChr submit" style="" >&nbsp;&nbsp;<<span class="btnUndLine">F5</span>>Bill</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/settlement.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="printFlio" class="buttExaSS" style="" onclick="cancel_ed()">&nbsp;&nbsp;<<span class="btnUndLine">F6</span>>Settle</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/pax_addremove.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<<span class="btnUndLine">F9</span>>Cash</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/link_room.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt" onclick="popupBillPrint('<?php echo $_GET['reg_num'];?>');">&nbsp;&nbsp;<<span class="btnUndLine">F10</span>>Card</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/refund.php?romNo=<?php echo $rowRr['room_no'];?>">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">P</span>ending KOT</button>
</a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/charges.php?romNo=<?php echo $rowRr['room_no'];?>">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">NC</span>KOT</button>
</a>
</td>
</tr>

</table>

</div>-->
	

</div>
	

	
	
<table style="border-left:1px solid #ddd;margin:117px 0 0 0;width:100%;" class="">
<tr>
	<td>	
<div style="margin:0px 0 0px 0px;">
	<a href="<?php echo $home_path;?>/transaction/frontdesk/billing-screen.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="submit" class="buttExaSS bnkSbt frstChr submit" style="" >&nbsp;&nbsp;<<span class="btnUndLine">F5</span>>Bill</button></a>
	
	<a href="<?php echo $home_path;?>/transaction/frontdesk/settlement.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="printFlio" class="buttExaSS" style="" onclick="cancel_ed()">&nbsp;&nbsp;<<span class="btnUndLine">F6</span>>Settle</button></a>
	
	<a href="<?php echo $home_path;?>/transaction/frontdesk/pax_addremove.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<<span class="btnUndLine">F9</span>>Cash</button></a>
	
	<a href="<?php echo $home_path;?>/transaction/frontdesk/link_room.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt" onclick="popupBillPrint('<?php echo $_GET['reg_num'];?>');">&nbsp;&nbsp;<<span class="btnUndLine">F10</span>>Card</button></a>
		
	<a href="<?php echo $home_path;?>/transaction/frontdesk/refund.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">P</span>ending KOT</button>
</div>
</td>
</tr>
<tr>
	<td>	
<div style="margin:0px 0 0px 0px;">
	<button type="submit" id="add" class="buttExaSS  bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/saves.png" class="sbtBImg frstChr"/>&nbsp;&nbsp;F2&nbsp;<span class="btnUndLine">O</span>rder to Kitchen</button>
	
	<button type="submit" id="add" class="buttExaSS  bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/modify2.jpg" class="sbtBImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">M</span>odify</button>
	
	<button type="submit" id="add" class="buttExaSS  bnkSbt frstChr" style="" onclick="return checkUnitMasterfdf();"><img src="../../images/del.png" class="sbtBImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">D</span>elete</button>
	
	<a href="<?php echo $home_path; ?>/transaction/frontdesk/kot-billscreen.php"><button type="button" id="update" class="buttExaSS  bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/clear-icon.png" class="sbtBImg "/>&nbsp;&nbsp;<span class="btnUndLine">C</span>lear </button></a>
		
	<a href="<?php echo $home_path; ?>/transaction/frontdesk/settlement.php"><button type="button" id="button" class="buttExaSS " style="" onclick="cancel_ed()"><img src="../../images/exitBut.png" class="sbtBImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button>
</div>
</td>
</tr>
</table>	


	
	</form>	
	
	
</div>
<!--<table style="width:60px;float:right;margin:0 -128px 0 0;" cellpadding="0" cellspacing="0" class="" border="1" >
<tbody>
<tr>
<td colspan="5">
<h3 style="text-align:center;font-size:14px;padding:10px;background:#ffffff;color:#640E27;margin:1px 0 0 0;text-transform:uppercase;"><b>HOTEL MYHOTEL</b></h3>
</td>
</tr>
<tr>
<td><input type="button" value="Table No" style="padding:5px 7px 5px 7px;"/></td>
<td><input type="button" value="Steward" style="padding:5px 29px 5px 29px;"/></td>
<td><input type="button" value="Amount" style="padding:5px 12px 5px 12px;"/></td>
</tr>
<tr>
<td><input type="text" value="" style="padding:0px 0px 0px 0px;width:54px;border:none;"/></td>
<td><input type="text" value="" style="padding:0px 0px 0px 0px;width:54px;border:none;"/></td>
<td><input type="text" value="" style="padding:0px 0px 0px 0px;width:54px;border:none;"/></td>
</tr>
</tbody>
</table>-->
<!--<table style="width:60px;background-color:#c0c0c0;float:right;margin:-16px -129px 0 0;" cellpadding="0" cellspacing="0" class="" border="0" >
<tbody>
<tr>
<td colspan="" style="color:#000;font-weight:bold;"><input type="text" value="" style="padding:0px 0px 0px 0px;width:249px;border:none;color:#fff;"/>&nbsp;&nbsp;Table Status &nbsp;:</td>
</tr>
</tbody>
</table>
<table style="width:60px;float:right;margin:0 -128px 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
<tbody>-->
<!--<tr>
<td colspan="3"><input type="text" value="" style="padding:0px 0px 0px 0px;width:54px;border:none;"/>Pending Amount</td>
</tr>-->
<!--<tr>
<td><input type="button" value="1" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="2" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="3" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="4" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="5" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="6" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="7" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="8" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="9" style="padding:10px 20px 10px 20px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="10" style="padding:10px 16px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="11" style="padding:10px 17px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="1A" style="padding:10px 16px 10px 16px;color:#fff;background-color:red;border:1px solid #868686;"/></td>
<td><input type="button" value="1B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="1C" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="2A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="2B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="2C" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="3A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="3B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="3C" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="4A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="4B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="4C" style="padding:10px 15px 10px 16px;color:#fff;background-color:red;border:1px solid #868686;"/></td>
<td><input type="button" value="5A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="5B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
<tr>
<td><input type="button" value="5C" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="6A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="6B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="7A" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
<td><input type="button" value="7B" style="padding:10px 15px 10px 16px;color:#000;background-color:#fff;border:1px solid #868686;"/></td>
</tr>
</tbody>
</table>-->



<!--<table style="width:60px;float:right;margin:0 -128px 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >

<tr>
<td>
	<a href="<?php echo $home_path;?>/transaction/frontdesk/billing-screen.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="submit" class="buttExaSS bnkSbt frstChr submit" style="" >&nbsp;&nbsp;<<span class="btnUndLine">F5</span>>Bill</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/settlement.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="printFlio" class="buttExaSS" style="" onclick="cancel_ed()">&nbsp;&nbsp;<<span class="btnUndLine">F6</span>>Settle</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/pax_addremove.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt">&nbsp;&nbsp;<<span class="btnUndLine">F9</span>>Cash</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/link_room.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="billsbt" class="buttExaSS bnkSbt" onclick="popupBillPrint('<?php echo $_GET['reg_num'];?>');">&nbsp;&nbsp;<<span class="btnUndLine">F10</span>>Card</button></a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/refund.php?romNo=<?php echo $rowRr['room_no'];?>">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">P</span>ending KOT</button>
</a>
</td>
</tr>

<tr>
<td>
<a href="<?php echo $home_path;?>/transaction/frontdesk/charges.php?romNo=<?php echo $rowRr['room_no'];?>">
<button type="button" id="exit" name="exit" class="buttExaSS" style="" >&nbsp;&nbsp;<span class="btnUndLine">NC</span>KOT</button>
</a>
</td>
</tr>

</table>-->



	</div>
	
	</div>
	
	

				
				
</body>
</html>