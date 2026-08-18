<?php
ob_start();
include("../includes/header.php");
/* include("config.php"); */
include("../util.php");
include("../amountToWords.php");

 ?>
<style>
 .block_top_1 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    margin: 0 20px 0 0;
    min-height: 320px;
    padding: 10px;
    width: 300px;
}
.block_top_2 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    min-height: 320px;
    padding: 10px;
    width: 300px;
}
.block_top_3 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    margin: 0 0 0 20px;
    min-height: 320px;
    padding: 10px;
    width: 300px;
}
input, textarea, select, .uneditable-input {
    border: 1px solid #cccccc;
    border-radius: 0;
    color: #555555;
    display: inline-block;
    font-size: 13px;
    height: 28px;
    line-height: 28px;
    margin-bottom: 9px;
    padding: 4px;
    width: 150px;
}
/* .table tr td {
    height: 25px;
	color:#333333;
} */
.table-disable-hover.table tbody tr:hover td,
.table-disable-hover.table tbody tr:hover th {
    background-color: inherit;
}
 #addcustomer .table .textbox { width:150px;} 
 
 .textbox {
    background: #fff none repeat scroll 0 0;
    border-color: #b1a795 #e2d9c7 #e2d9c7 #b1a795;
    border-style: solid;
    border-width: 1px;
    float: left;
    font-size: 12px;
    height: 26px;
    line-height: 26px;
    margin: 0 0 10px;
    padding: 0 5px;
    width: 150px;
}
table tr td {
    height: 25px;
	color: #333333;
}

</style>
<script type="text/javascript">
$(document).ready(function(){
	var myCalendar;
	myCalendar = new dhtmlXCalendarObject(["calendar","calendar2","calendar3"]);
	myCalendar.setDateFormat("%d-%m-%Y");
	
	
	var fullDate = new Date();
		console.log(fullDate);
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
		$(".invDte").val(currentDate);
		
});


function selInvType(){
	invTpe=$("#invoice_type").val();
	carrier=$("#carrier").val();
	awb_no=$("#awb_no").val();
	add_freight=$("#add_freight").val();
	
	if(invTpe=='commercial'){
		$("#carrier").prop('disabled',false);
		$("#awb_no").prop('disabled',false);
		$("#add_freight").prop('disabled',false);
	}else{
		$("#carrier").prop('disabled',true);
		$("#awb_no").prop('disabled',true);
		$("#add_freight").prop('disabled',true);
		$("#carrier").val('');
		$("#awb_no").val('');
		$("#add_freight").val('');
	}
}

	
function frmValid(){
	$("#carrier").prop('disabled',false);
	$("#awb_no").prop('disabled',false);
	$("#add_freight").prop('disabled',false);
	
	newPRTno=$('#new_partno').val(); 
	newPRTno=$('#part_name').prop("disabled", false);
	
	var status = true;	
	/* if (newPRTno!='') {
		r=confirm("do u want to add new part no.");
		if(r==true){
			  status = true;
		}else{
			
			status = false;
		}
		
	} */
	
	if(!status){
			return false;
		}
		else
		{
			/* $("#reg-submit").val("Processing.."); */
		}
}

function fromHTax() {
	taxRate=$("#tax_rate").val();
	hTax=$("#h_tax").val();
	if(hTax!=''){
		$('#tax_rate').prop("disabled", true);
	}else{
		$('#tax_rate').prop("disabled", false);
	}
}

function fromTAXRate() {
	taxRate=$("#tax_rate").val();
	hTax=$("#h_tax").val();
	if(taxRate!=''){
		$('#h_tax').prop("disabled", true);
	}else{
		$('#h_tax').prop("disabled", false);
	}
}


function selINVrFQNoDet() {
	rfqNO=$("#rfq_no").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selINVoiceRFQDet.php',
			data:{
			rfqNO:rfqNO
			},
			success:function(data){
				  /* alert(data);  */
			 	  qte=data.split('@'); 
				/*   $('#clintDest').html(data); */
				  $('.clnDest').html(qte[0]);
				  $('#part_name').val(qte[1]);
				  $('#nsn_no').val(qte[3]);
				  
				/* $('#nsn_no').val(qte[2]); */
				/* $('.clnDest').val(data); */
			}
	});
}
	
function selClinDest() {
	clin_dest=$('#clin_dest').val();
	rfqNO=$("#rfq_no").val();
	/* alert(clin_dest); */
	$.ajax({
		type:'GET',
		url:'  ../action/selCLINShip.php',
			data:{
			clin_dest:clin_dest,
			rfqNO:rfqNO
			},
			success:function(data){
				 /* alert(data); */  
				  qte=data.split(','); 
				  
				  $('#ship_1').val(qte[0]);
				  $('#ship_2').val(qte[1]);
				  $('#ship_3').val(qte[2]);
				  $('#ship_4').val(qte[3]);
				  $('#unit_price').val(qte[6]);
				  $('#qty').val(qte[7]);
				  $('#ui_no').val(qte[8]);
				  $('#contract_no').val(qte[9]);
				  $('#currency').val(qte[10]);
				  $('#inrSmbl').html(qte[10]);
				  $('#bill_1').val(qte[11]);
				  $('#bill_2').val(qte[12]);
				  $('#bill_3').val(qte[13]);
				  $('#bill_4').val(qte[14]);
			}
	});
}


function checkUnitPRice() {
	unitPrc=parseFloat($('#unit_price').val());
	Qty=parseFloat($('#qty').val());
	totPrc=parseFloat(unitPrc*Qty);
	parseFloat($('#total_itemval').val(totPrc));
		  $('#inv_subtotal').val(totPrc);	
		  $('#invoice_total').val(totPrc);	
	rfqNO=$("#rfq_no").val();
	invTotal=parseFloat($('#invoice_total').val());
	$.ajax({
		type:'GET',
		url:'  ../action/selInvTOtalWords.php',
			data:{
			rfqNO:rfqNO,
			invTotal:invTotal
			},
			success:function(data){
				$('#inv_totwords').html(data);	
			}
	});
}

/* function invTOTtoWords(){
	rfqNO=$("#rfq_no").val();
	invTotal=parseFloat($('#invoice_total').val());
	$.ajax({
		type:'GET',
		url:'  ../action/selInvTOtalWords.php',
			data:{
			rfqNO:rfqNO,
			invTotal:invTotal
			},
			success:function(data){
				$('#inv_totwords').html(data);	
			}
	});
} */

</script> 
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/codebase-datepicker/dhtmlxcalendar.css"/>
<script src="<?php echo $home_path; ?>/codebase-datepicker/dhtmlxcalendar.js"></script>
	<style>
		#calendar,
		#calendar2,
		#calendar3 {
			border: 1px solid #909090;
			font-family: Tahoma;
			font-size: 12px;
		 	background: #fff url("../images/date-icon.png") no-repeat scroll 95.5% 45%;
    cursor: pointer; 
		}
	</style>
<?php
 $sqlCu=mysql_query("select * from currency_master where currency_code='USD'"); 
 $rowCu=mysql_fetch_array($sqlCu);
 $conRate=$rowCu['conversion_rate']; 
?>	
<body class="bgBODY">
<div class="about">
	<div id="invoice" style="border:1px solid #ddd;margin:0 auto;">
		<div class="col-md-12" >
			<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Invoice Page</b></h3>
			<div class="block_top_1">
<?php 
	$sql=mysql_query("select * from invoice where invoice_no='".$_GET['uid']."'");
	$x=0;
	$row=mysql_fetch_array($sql);
		$x++;
	?>	
<form id="quotationmaster" name="quotationmaster" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/update-invoice.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="invoice_id" id="invoice_id" type="hidden" value="<?php echo $row['invoice_id']?>" />
<input name="invoice_no" id="invoice_no" type="hidden" value="<?php echo $_GET['uid'];?>" />
<input name="conversion_rate" id="conversion_rate" value="<?php echo $conRate;?>" type="hidden"/>
<input name="ebsNextNo" id="ebsNextNo" value="<?php  echo $rowE['maxnumber'];?>" type="hidden"/>
<input name="invitemVal" id="invitemVal" value="" type="hidden" class="itVal"/>

	<table style="float:left;" class="table table-condensed table-disable-hover" cellpadding="0" cellspacing="0" class="table" border="0" >
				<tr>
						<td width="125" valign="top">Multiple Contracts:</td>
						<td valign="top">
						<select name="mult_contract" id="mult_contract" onchange="noOfContract();" data-validation="required" class="input validate[required] textbox cur_date">
						<option value="">--Select--</option>
						<option value="yes"<?php echo ($row['mult_contract']=='yes')?'selected':''; ?>>Yes</option>
						<option value="no"<?php echo ($row['mult_contract']=='no')?'selected':''; ?>>No</option>
						</select>
						</td>
				</tr>
				<tr>
						<td width="125" valign="top">Invoice Type * :</td>
						<td valign="top">
						<select name="invoice_type" id="invoice_type" onchange="selInvType();" data-validation="required" class="input validate[required]">
						<option value="">--Select--</option>
						<option value="commercial"<?php echo ($row['invoice_type']=='commercial')?'selected':''; ?>>Commercial</option>
						<option value="sample"<?php echo ($row['invoice_type']=='sample')?'selected':''; ?>>Sample</option>
						</select>
						</td>
				</tr>
				<tr>
					<td width="125" valign="top">Invoice Date *:</td>
					<td valign="top">
						<input name="invoice_date" id="calendar" type="text" class="textbox invDte" onblur="checkitemcode()" value="<?php echo $row['invoice_date']?>"/>
					</td>
				</tr>
				<?php if($row['noof_rfq']!='') { ?>
				<tr style="" id="noRfq">
					<td width="125" valign="top">Number of RFQ:</td>
					<td valign="top"><input name="no_rfq_no" id="no_rfq_no" type="text" onKeyup="genContract();" value="<?php echo $row['noof_rfq']?>"/></td>
				</tr>
				<?php } ?>
			<tbody id="addedRowsED" style="">
			</tbody>
			<?php 
			$sqll=mysql_query("select * from invoice where invoice_no='".$_GET['uid']."' AND mult_contract='yes'");
			while($rowI=mysql_fetch_array($sqll)){
			?>	
				<tr>
					<td width="125" valign="top">RFQ No:</td>
					<td valign="top"><input name="cont_rfq[]" id="rfq_no" type="text" class="textbox" onblur="selINVrFQNoDet();" value="<?php echo $rowI['rfq_no']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">CLIN Dest:</td>
					<td valign="top" id="clintDest">
					<input name="clin_dest[]" id="clin_dest" type="text" class="textbox" value="<?php echo $rowI['clin_dest']?>"/>
					</td>
				</tr>
				<tr style="" class="rfqSingle">
					<td width="125" valign="top">Qty:</td>
					<td valign="top" id="clintDest">
					<input name="clin_qty[]" id="clin_qty" type="text" class="textbox clQTy" value="<?php echo $rowI['clin_qty']?>"/></td>
				</tr>
			<?php } ?>
			
			<?php 
			$sqlR=mysql_query("select * from invoice where invoice_no='".$_GET['uid']."' AND mult_contract='no'");
			while($rowR=mysql_fetch_array($sqlR)){
			?>	
				<tr>
					<td width="125" valign="top">RFQ No:</td>
					<td valign="top"><input name="cont_rfqs" id="rfq_no" type="text" class="textbox" onblur="selINVrFQNoDet();" value="<?php echo $rowR['rfq_no']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">CLIN Dest:</td>
					<td valign="top" id="clintDest">
					<input name="clin_dests" id="clin_dest" type="text" class="textbox" value="<?php echo $rowI['clin_dest']?>"/>
					</td>
				</tr>
				<tr style="" class="rfqSingle">
					<td width="125" valign="top">Qty:</td>
					<td valign="top" id="clintDest">
					<input name="clin_qtys" id="clin_qty" type="text" class="textbox clQTy" value="<?php echo $rowI['clin_qty']?>"/></td>
				</tr>
			<?php } ?>
			
			
			<tr>
				<td width="125" valign="top">Invoice No :</td>
				<td valign="top"><input name="invoice_no" id="invoice_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['invoice_no']?>"/></td>
			</tr>
			<?php 
			$sqlE=mysql_query("select * from invoice where invoice_no='".$_GET['uid']."' AND mult_contract='yes'");
			while($rowE=mysql_fetch_array($sqlE)){
			?>	
				<tr>
					<td width="125" valign="top">EBS Invoice No:</td>
					<td valign="top"><input name="ebsinv_no[]" id="ebsinv_no" type="text" class="textbox" value="<?php echo $rowE['ebsinv_no']?>" onblur="checkitemcode()"/></td>
				</tr>
			<?php } ?>
			<?php 
			$sqlS=mysql_query("select * from invoice where invoice_no='".$_GET['uid']."' AND mult_contract='no'");
			while($rowS=mysql_fetch_array($sqlS)){
			?>	
				<tr id="snglEBSinv" style="">
					<td width="125" valign="top">EBS Invoice No:</td>
					<td valign="top"><input name="ebsinv_nos" id="ebsinv_no" type="text" class="textbox" value="<?php echo $rowS['ebsinv_no'];?>" onblur="checkitemcode()"/></td>
				</tr>
			<?php } ?>
			<tr>
				<td width="180" >Currency :</td>
				<td>
					<select class="fstChUPPRCase" name="currency" id="currency">
						<option value="">--Select--</option>
						<?php
						$sqlC=mysql_query("select * from currency_master where currency_default='1'");
						$rowC=mysql_fetch_array($sqlC);
						
						$sqlba="select currency_code,currency_default from currency_master";
						$rowba=mysql_query($sqlba);
						while($resultba=mysql_fetch_array($rowba)) {
							if($resultba['currency_code']==$row['currency']){
																
						?>
						<option value="<?php echo $resultba['currency_code'];?>" selected><?php echo $resultba['currency_code'];?></option>
									<?php }else{?>
						<option value="<?php echo $resultba['currency_code'];?>"><?php echo $resultba['currency_code'];?></option>
						<?php } }?>		
					</select>
				</td>
			</tr>
			</table>
			</div>
			<div class="block_top_2">
			<table style="" class="table">
				<tr>
					<td width="125" valign="top">Bill To Code :</td>
					<td valign="top"><input name="billto_code" id="billto_code" type="text"onkeyUp="checkBIlltoCode()" value="<?php echo $row['bill_code']?>"/></td>
				</tr>
			</table>
			<table style="" class="table">
			
			
			<ul id="myTab" class="nav nav-tabs">
                             <li class="active"><a href="#tab_billto" data-toggle="tab">Bill To</a></li>
                             <li><a href="#tab_shippto" data-toggle="tab">Ship To</a></li>
						 </ul>

                         <div id="myTabContent" class="tab-content" >
                             <div class="tab-pane fade in active" id="tab_billto">
                                 <input id="bill_1" name="bill_1" value="<?php echo $row['bill_1']?>" style="width:271px" type="text" placeholder="Address Line 1">
                                 <input id="bill_2" name="bill_2" value="<?php echo $row['bill_2']?>" style="width:271px" type="text" placeholder="Address Line 2">
                                 <input id="bill_3" name="bill_3" value="<?php echo $row['bill_3']?>" style="width:271px" type="text" placeholder="Address Line 3">
                                 <input id="bill_4" name="bill_4" value="<?php echo $row['bill_4']?>" style="width:271px" type="text" placeholder="Address Line 4">
                             </div>
                             <div class="tab-pane fade in " id="tab_shippto">
                                <input id="ship_1"  name="ship_1" value="<?php echo $row['ship_1']?>" style="width:271px" type="text" placeholder="Address Line 1">
                                <input id="ship_2"  name="ship_2" value="<?php echo $row['ship_2']?>" style="width:271px" type="text" placeholder="Address Line 2">
                                <input id="ship_3"  name="ship_3" value="<?php echo $row['ship_3']?>" style="width:271px" type="text" placeholder="Address Line 3">
                                <input id="ship_4"  name="ship_4" value="<?php echo $row['ship_4']?>" style="width:271px" type="text" placeholder="Address Line 4">
                             </div>
                             </div>
						<tr>
							<td width="145" valign="top" >Tax Type :</td>
							<td width="385" valign="top" >
							<select name="tax_type" id="tax_type" onChange="fromHtaxRte();" >
								<option value="">--Select--</option>
								<option value="fromhtax"<?php echo ($row['tax_type']=='fromhtax')?'selected':''; ?>>From H/Tax</option>
								<option value="taxrate"<?php echo ($row['tax_type']=='taxrate')?'selected':''; ?>>Tax rate</option>
							</select>
							</td>
						</tr>
			<?php if($row['h_tax']!='') { ?>
			<tr id="frHtx" style="">
				<td width="125" valign="top">From H/Tax (%):</td>
				<td valign="top"><input name="h_tax" id="h_tax" type="text" value="<?php echo $row['h_tax']?>" class="textbox" /></td>
			</tr>
			<?php } ?>
			<?php if($row['tax_rate']!='') { ?>
			<tr id="frTXRate" style="">
				<td width="125" valign="top">Tax rate (%):</td>
				<td valign="top"><input name="tax_rate" id="tax_rate" type="text" value="<?php echo $row['tax_rate']?>" class="textbox" /></td>
			</tr>
			<?php } ?>			
						<tr>
							<td width="125" valign="top">Carrier :</td>
							<td valign="top"><input name="carrier" id="carrier" type="text" class="textbox" onblur="checkitemcode()" disabled value="<?php echo $row['carrier']?>"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">AWB No :</td>
							<td valign="top"><input name="awb_no" id="awb_no" type="text" class="textbox" onblur="checkitemcode()" disabled value="<?php echo $row['awb_no']?>"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Add freight *:</td>
							<td valign="top">
							<select name="add_freight" id="add_freight" disabled >
							<option value="">--Select--</option>
							<option value="yes"<?php echo ($row['add_freight']=='yes')?'selected':''; ?>>Yes</option>
							<option value="no"<?php echo ($row['add_freight']=='no')?'selected':''; ?>>No</option>
							</select>
							</td>
						</tr>
						<?php if($row['freight_amount']!='') { ?>
						<tr id="FreightAmot" style="">
							<td width="125" valign="top">Freight Amount :</td>
							<td valign="top"><input name="freight_amount" id="freight_amount" type="text" class="textbox" value="<?php echo $row['freight_amount']?>"/></td>
						</tr>
						<?php } ?>	
			</table>
			</div>
			<div class="block_top_3">
			<table style="" class="table">
			<tr>
					<td width="125" valign="top">Total Item Value:</td>
					<td valign="top"><input name="total_itemval" id="total_itemval" type="text" class="textbox" value="<?php echo $row['total_itemval']?>"/></td>
				</tr>	
						<tr>
					<td width="125" valign="top">Invoice sub total :</td>
					<td valign="top"><input name="inv_subtotal" id="inv_subtotal" type="text" class="textbox" value="<?php echo $row['inv_subtotal']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">Invoice Total (INR)&nbsp;<span id="inrSmbl"></span>:</td>
					<td valign="top"><input name="invoice_total_inr" id="invoice_total_inr" type="text" class="textbox fstChUPPRCase" onblur="invTOTtoWords();" value="<?php echo $row['invoice_total_inr']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">Invoice Total (USD)&nbsp;<span id="inrSmbl"></span>:</td>
					<td valign="top"><input name="invoice_total_usd" id="invoice_total_usd" type="text" class="textbox fstChUPPRCase" value="<?php echo $row['invoice_total_usd']?>"/></td>
				</tr>
				<tr>
				
					<td width="125" valign="top">Invoice total in words:</td>
					<td valign="top" id="inv_totwords" style="border:1px solid #B1A795;overflow:auto;height:50px;" ><?php echo $row['inv_totwords']?>
					<!--<input name="inv_totwords" id="inv_totwords" type="text" class="textbox" onblur="checkitemcode()" value=""/>-->
					</td>
				</tr>	
					
				<tr>
					<td width="125" valign="top">Total No. of packages :</td>
					<td valign="top"><input name="total_packages" id="total_packages" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['total_packages']?>"/>
					<textarea name="inv_totwords" id="inv_totwor" style="width:200px;height:50px;" hidden><?php echo $row['inv_totwords']?></textarea>
					</td>
				</tr>
					
				
			</table>
			</div>
	
<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
		<div style="margin:10px 0 10px 194px;">
			<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onclick="return frmValid();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
			
			<a href="view-invoice.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
					
			<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
			
			<button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" onClick="self.close();" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button>
		</div>
		</td>
	</tr>
</table>
		</form>		
			<!--<table style="margin:0 0 0 359px;width:150px;text-align:center;" class="col-md-3 table" >
				<tr>
					<td valign="top">
						<input id="addButton" class="submitbtn" type="submit" value="Save" name="text" style="">
					</td>
				</tr>
			</table>-->
			</div>
		</div>
	</div>
	</div>
	<div class="banner-bottom" style="margin:15px 0 0 0;">
		<div class="container">
			<script src="<?php echo $home_path; ?>/js/jquery.wmuSlider.js"></script> 
				<script>
					$('.example1').wmuSlider();         
				</script> 
		</div>
	</div>
		<!-- scroll_top_btn -->
	<script type="text/javascript" src="<?php echo $home_path; ?>/js/move-top.js"></script>
	<script type="text/javascript" src="<?php echo $home_path; ?>/js/easing.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
		 <a href="#" id="toTop" style="display: none;"><span id="toTopHover" style="opacity: 1;"></span></a>

	 <script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap-3.1.1.min.js"></script>

</body>
</html>