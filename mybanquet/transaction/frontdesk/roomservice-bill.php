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
    padding: 7px 0px;
    /* padding: 5px 59px; */
	width:136px;
}

.dblMas{
	color: #474747;
    display: block;
    float: right;
    font-size: 12px;
    font-weight: normal;
    padding: 3px 9px 0 0;
}

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
	
	$('input[name^=kot_itemqty]').on('keyup', function() {
		qtyVal =parseInt($(this).val()); 
		/* alert(qtyVal); */
		unitval =parseInt($(this).parent().next().find('input').val());
		totAMt=(qtyVal*unitval);
		/* alert(totAMt); */
		Amt =parseInt($(this).parent().next().next().find('input').val(totAMt));
		ttAmt=parseInt($(this).parent().next().next().find('input').val());
		if(isNaN(ttAmt)){ ttAmt=parseInt($(this).parent().next().next().find('input').val(0));}
		 lnTT=$(".lineTot").val();
		 if(lnTT=='NaN'){$(".lineTot").val('0');}
		totTot =0;
		$(".lineTot").each(function(){
			/* tot=parseFloat($(this).val().trim());
			if(totTot!="" && totTot!='NaN'){ */
				totTot +=parseFloat($(this).val());
			/* alert(totTot);
			} */
			
		});
		 tx=parseFloat($("#tax_total").val()); 
		 dsc=parseFloat($("#disc_tot").val()); 
		 gTOT=(totTot+tx);
		 $("#sub_total").val(totTot.toFixed(2)); 
		 $("#grnd_tot").val(gTOT.toFixed(2)); 
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

function smCde(cnt){
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/outletItemCode.php?cnt='+cnt,'mywin','left=280,top=100,width=200,height=200,');
	newwindow.focus();
}

function selectItem(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}

var rowCount = 5; 
function addMoreRows() {
	paxNo=$('#pax').val();
	var rwTbl = $('#tblRw tr').length;
	rowCount=rowCount+1; 
	rowCunt=rwTbl+1; 
	rowTblCo=0;
	
	var rowTblCo = $('#addedRowsED tr').length+2;
	/* $('#addedRowsED').html(''); */
	/* for(i=0;i<paxNo;i++) { */
		var recRow = '<tr id="rowCount'+rowCount+'"><td width="60"><input name="item_code[]" id="item_code'+rowCount+'" type="text" class="textbox codesUPPERCase itemCde" style="width:100px;margin:4px 0 0 0;" onclick="smCde('+rowCount+');"/><div id="suggesstion-box"></div></td><td width="200" class="codesUPPERCase"><input name="item_desc[]" id="item_desc'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:182px;margin:4px 0 0 0;"  /></td><td width="40" class="fstChUPPRCase"><input name="item_qty[]" id="item_qty'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;"  /></td>	<td width="50" class="fstChUPPRCase"><input name="item_rate[]" id="item_rate'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" /></td><td width="60" class="fstChUPPRCase"><input name="item_val[]" id="item_val'+rowCount+'" type="text" class="textbox codesUPPERCase lineTot" style="width:100px;margin:4px 0 0 0;" value="0" /></td><td width="100" class="fstChUPPRCase"><input name="item_pref[]" id="item_pref'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:193px;margin:4px 0 0 0;" /></td><td><a href="javascript:void(0);" onclick="removeRow('+rowCount+');" name="remove['+rowCount+']" id="remove_'+ rowCount +'" class="deleterecord" width="15"><img src="../../images/removeicon.png" style="width:18px;height:18px;"/></a></td></tr>';
		
		
		jQuery('#addedRowsED').append(recRow); 
		$('#rowCount').val(rowCount);
	/* } */
}
function removeRow(removeNum) {
		jQuery('#rowCount'+removeNum).remove(); 
	} 

</script> 
<body class="bgBODY">


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
	<div id="addcustomer" class="frmCentr divBrd" style="width:700px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Room service K.O.T</b></h3>
		<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_kotbill.php" method="post" class="" style="">
		
		
		<table style="width:100%;border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;margin:3px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

				<tr>
						<td width="" valign="top"><label>Outlet<em></em></label></td>
						<td valign="top"><input name="kot_outlet" id="kot_outlet" type="text" class="input required textbox codesUPPERCase" style="width:100px;margin:3px 0 0 10px;" value="<?php if(isset($_GET['rmS'])){echo $_GET['rmS'];}?>" readonly /><label style="border:1px solid #8C8C8C;color: #474747;display: block;float: right;font-size: 12px;font-weight: normal;    padding: 0px 4px 1px 4px;margin:4px 0 0 0;" onclick="outletOpen();"><span class="btnUndLine">C</span>H</label>
						</td>
					<td width="" valign="top"><label>Session<em>*</em></label></td>
					<td valign="top"><input name="kot_session" id="kot_session" type="text" class="input required textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" value="<?php if(isset($_GET['ouSEs'])){ echo $_GET['ouSEs'];}?>" readonly /></td>
					<td width="" valign="top"><label>Date<em>*</em></label></td>
						<td valign="top"><input name="kot_date" id="kot_date" type="text" data-validation="required" class="input required textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" value="<?php if(isset($_GET['otDt'])){ echo $_GET['otDt'];} ?>" readonly /></td>
						<td width="" valign="top"><label>Type</label></td>
						<td valign="top"><input name="kot_type" id="kot_type" type="text" class="textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 10px;" value="Normal" readonly /></td>
						
					</tr>
									
					</tbody>
				</table>

			<table style="width:100%;border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
			<tr>
						<td width="" valign="top"><label>KOT #<em></em></label></td>
						<td valign="top"><input  name="kot_no" id="kot_no" type="text" class="input required textbox codesUPPERCase" style="width:100px;margin:3px 0 0 10px;" value="" readonly /><label style="border:1px solid #8C8C8C;color: #474747;display: block;float: right;font-size: 12px;font-weight: normal;    padding: 0px 4px 1px 4px;margin:4px 0 0 0;"><span class="btnUndLine">N</span>C</label>
						</td>
					<td width="" valign="top"><label>Room #<em>*</em></label></td>
					<td valign="top"><input name="kot_session" id="kot_session" type="text" class="input required textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 4px;" value="<?php echo $_GET['roNo'];?>" readonly /></td>
					<td width="" valign="top"><label>Covers<em>*</em></label></td>
						<td valign="top"><input name="kot_date" id="kot_date" type="text" data-validation="required" class="input required textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 -5px;" value="<?php echo $_GET['rmPx'];?>" readonly /></td>
						<td width="" valign="top"><label>steward</label></td>
						<td valign="top"><input name="kot_type" id="kot_type" type="text" class="textbox fstChUPPRCase" style="width:100px;margin:3px 0 0 0px;" value="" readonly /></td>
						
					</tr>
					
				<!--<tr>
						<td style="width:54px;" valign="top"><label>KOT#<em></em></label></td>
						<td valign="top"><input name="kot_no" id="kot_no" type="text" class="input required textbox codesUPPERCase" onblur="checkPropertyCode();" style="width:100px;margin:0px 0 0 0px;" value="Auto" readonly />
						
						<label style="border:1px solid #8C8C8C;color: #474747;display: block;float: right;font-size: 12px;font-weight: normal;    padding: 0px 4px 1px 4px;margin:4px 0 0 0;"><span class="btnUndLine">N</span>C</label>
						</td>
					<td style="width:122px;" valign="top"><label style="margin:0 0 0 0;">Room #<em>*</em></label></td>
					<td valign="top" style="width:50px;"><input name="kot_table" id="kot_table" type="text" class="input required textbox fstChUPPRCase tblImg" style="width:100px;margin:4px 0 0 0;"/>
					 <img src="../../images/tblopn.png" style="width:16px;height:16px;margin:8px 0 0 -19px;cursor:pointer;" id="input_img" onclick="tableNoOpn();" >
					</td>
					
					<td style="width:101px;" valign="top"><label>Covers<em>*</em></label></td>
						<td valign="top"><input name="kot_covers" id="kot_covers" type="text" data-validation="required" class="input required textbox fstChUPPRCase" style="width:100px;margin:4px 0 0 0;" /></td>
						<td style="width:50px;" valign="top"><label>Steward</label></td>
						<td valign="top"><input name="kot_steward" id="kot_steward" type="text" class="textbox required fstChUPPRCase" style="width:100px;margin:4px 0 4px 0;" onclick="stewardOpn();" /></td>
						
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
		<!--<th><img src="../../images/plus.png" id="add-item" onclick="addMoreRows(this.form);" style="width:20px;height:20px;cursor:pointer;"/></th>-->
	</tr>
	<?php   for($i=1;$i<=10;$i++){  ?>
	<tbody id="tblRw" >
	<tr>
		<!--<td width="20" style="text-align:center;"><input name="item_srl[]" id="item_srl" type="text" class="textbox codesUPPERCase " style="width:30px;margin:4px 0 0 0;"  /></td>-->
		<td width="60"><input name="kot_itemcode[]" id="item_code<?php echo $i;?>" type="text" class="textbox codesUPPERCase itemCde " style="width:100px;margin:4px 0 0 0;" onclick="smCde('<?php echo $i;?>');" readonly />
		
		</td>
		<td width="200" class="codesUPPERCase"><input name="kot_itemdesc[]" id="item_desc<?php echo $i;?>" type="text" class="textbox codesUPPERCase " style="width:182px;margin:4px 0 0 0;" readonly /></td>
		<td width="40" class="fstChUPPRCase"><input name="kot_itemqty[]" id="item_qty<?php echo $i;?>" type="text" class="textbox codesUPPERCase " style="width:50px;margin:4px 0 0 0;" /></td>
		<td width="50" class="fstChUPPRCase"><input name="item_rate[]" id="item_rate<?php echo $i;?>" type="text" class="textbox codesUPPERCase " style="width:100px;margin:4px 0 0 0;" readonly  /></td>
		<td width="60" class="fstChUPPRCase"><input name="kot_itemval[]" id="item_val<?php echo $i;?>" type="text" class="textbox codesUPPERCase lineTot" style="width:100px;margin:4px 0 0 0;" value="0" readonly  /></td>
		<td width="100" class="fstChUPPRCase"><input name="kot_itempref[]" id="item_pref<?php echo $i;?>" type="text" class="textbox codesUPPERCase" style="width:153px;margin:4px 0 0 0;"  /></td>
	</tr>
	</tbody>
	<?php   }   ?>
	<tbody id="addedRowsED" style="">
	</tbody>
</table>

<table class="" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;float:right;margin:10px 0 8px 0;">
<tr>

	<td width="" valign="top"><label style="">Sub Total&nbsp;&nbsp;&nbsp;<em></em></label></td>
	<td valign="top"><input name="sub_total" id="sub_total" type="text" class="textbox codesUPPERCase sub_total" style="width:100px;margin:-3px 0 0 0;" value="0" readonly /></td>

	
	<td width="" valign="top"><label>&nbsp;&nbsp;Tax&nbsp;&nbsp;&nbsp;<em></em></label></td>
	<td valign="top"><input name="tax_total" id="tax_total" type="text" class="textbox codesUPPERCase tax_total" style="width:100px;margin:-3px 0 0 0;" value="0" readonly /></td>

	
	<td width="" valign="top"><label>&nbsp;&nbsp;Disc&nbsp;&nbsp;&nbsp;<em></em></label></td>
	<td valign="top"><input name="disc_tot" id="disc_tot" type="text" class="textbox codesUPPERCase disc_tot" style="width:100px;margin:-3px 0 0 0;" value="0" readonly /></td>


	<td width="" valign="top"><label>&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;<em></em></label></td>
	<td valign="top"><input name="grnd_tot" id="grnd_tot" type="text" class="textbox codesUPPERCase grnd_tot" style="width:100px;margin:-3px 0 0 0;" value="0" readonly /></td>
</tr>
</table>
	
	

	
	
<table style="border-left:1px solid #ddd;width:100%;margin: 0 0 -53px 0;" class="">
<tr>
	<td>	

	<a href="<?php echo $home_path;?>/transaction/frontdesk/billing-screen.php?romNo=<?php echo $rowRr['room_no'];?>"><button type="button" id="submit" class="buttExaSS bnkSbt frstChr submit" style="" >&nbsp;&nbsp;<<span class="btnUndLine">F5</span>>Bill</button></a>
	
	<a href="<?php echo $home_path;?>/transaction/frontdesk/settlement.php?romNo=<?php echo $rowRr['room_no'];?>&regNum=<?php echo $rowRr['guestreg_id'];?>"><button type="button" id="printFlio" class="buttExaSS" style="" onclick="cancel_ed()">&nbsp;&nbsp;<<span class="btnUndLine">F6</span>>Re-Settle</button></a>
	
	<a href="<?php echo $home_path; ?>/transaction/frontdesk/settlement.php"><button type="button" id="button" class="buttExaSS " style="" onclick="cancel_ed()"><img src="../../images/exitBut.png" class="sbtBImg" style="width:17px;height:14px;" />&nbsp;&nbsp;<span class="btnUndLine">L</span>ast Bill Print</button></a>
	
	<button type="reset" id="update" class="buttExaSS  bnkSbt" ><img src="../../images/clear-icon.png" class="sbtBImg " style="width:18px;height:16px;"/>&nbsp;&nbsp;<span class="btnUndLine">C</span>lear </button>
	
	<a href="<?php echo $home_path; ?>/transaction/frontdesk/settlement.php"><button type="button" id="button" class="buttExaSS " style="" onclick="cancel_ed()"><img src="../../images/exitBut.png" class="sbtBImg" style="width:17px;height:14px;" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
	

</td>
</tr>
</table>	
</form>	
</div>
	</div>
	</div>
</body>
</html>