<?php
ob_start();
include("../includes/header.php");
/* include("config.php"); */
include("../util.php");
include("../amountToWords.php");
?>
<style>
.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;position: absolute;z-index: 1;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}
</style>
<!--form validation-->	
<link rel="stylesheet" href="../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!---//-form valid---->
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

	$("#rfq_no").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../action/selInvPageRFQ.php",
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
	$("#h_tax").keyup(function(){
		hTaxx=($("#h_tax").val());
		hTax=parseFloat($("#h_tax").val());
		clinQty=parseFloat($(".clQTy").val());
		totItmval=parseFloat($("#total_itemval").val());
		convRate=parseFloat($("#conversion_rate").val());
		if(hTaxx!=''){
			totVal=parseFloat((hTax/100)*clinQty*totItmval);
			totvalTx=(totVal+totItmval);
			inrConv=(totvalTx*convRate);
			($("#inv_subtotal").val(totvalTx.toFixed(2)));
			($("#invoice_total_inr").val(inrConv.toFixed(2)));
			($("#invoice_total_usd").val(totvalTx.toFixed(2)));
		}
		if(hTaxx==''){
			totVal=parseFloat(totItmval);
			inrConv=(totVal*convRate);		
			($("#inv_subtotal").val(totVal.toFixed(2)));
			($("#invoice_total_inr").val(inrConv.toFixed(2)));
			($("#invoice_total_usd").val(totVal.toFixed(2)));
		}
			qtTotAmt=$("#inv_subtotal").val(); 
			if(qtTotAmt=="NaN"){$("#inv_subtotal").val('0.00');}
			qtTot=$("#invoice_total_inr").val(); 
			if(qtTot=="NaN"){$("#invoice_total_inr").val('0.00');}
			qtT=$("#invoice_total_usd").val(); 
			if(qtT=="NaN"){$("#invoice_total_usd").val('0.00');}
			
		invTotInr=$("#invoice_total_inr").val();
		invTotal=parseFloat($('#invoice_total').val());
		$.ajax({
			type:'GET',
			url:'  ../action/selInvTOtalWords.php',
				data:{
					invTotInr:invTotInr
				},
				success:function(data){
					/* alert(data); */
					$('#inv_totwords').html(data);	
					$('#inv_totwor').val(data);		
				}
		});
	});
	
	$("#tax_rate").keyup(function(){
			hTaxx=($("#tax_rate").val());
			hTax=parseFloat($("#tax_rate").val());
			clinQty=parseFloat($(".clQTy").val());
			totItmval=parseFloat($("#total_itemval").val());
			convRate=parseFloat($("#conversion_rate").val());
			
			if(hTaxx!=''){
				totVal=parseFloat((hTax/100)*clinQty*totItmval);
				totvalTx=(totVal+totItmval);
				inrConv=(totvalTx*convRate);
				invS=($("#inv_subtotal").val(totvalTx.toFixed(2)));
				invInr=($("#invoice_total_inr").val(inrConv.toFixed(2)));
				invUs=($("#invoice_total_usd").val(totvalTx.toFixed(2)));
			}
			if(hTaxx==''){
			totVal=parseFloat(totItmval);
			inrConv=(totVal*convRate);		
			($("#inv_subtotal").val(totVal.toFixed(2)));
			($("#invoice_total_inr").val(inrConv.toFixed(2)));
			($("#invoice_total_usd").val(totVal.toFixed(2)));
		}
			qtTotAmt=$("#inv_subtotal").val(); 
			if(qtTotAmt=="NaN"){$("#inv_subtotal").val('0.00');}
			qtTot=$("#invoice_total_inr").val(); 
			if(qtTot=="NaN"){$("#invoice_total_inr").val('0.00');}
			qtT=$("#invoice_total_usd").val(); 
			if(qtT=="NaN"){$("#invoice_total_usd").val('0.00');}
			
			invTotInr=$("#invoice_total_inr").val();
			invTotal=parseFloat($('#invoice_total').val());
			$.ajax({
				type:'GET',
				url:'  ../action/selInvTOtalWords.php',
					data:{
						invTotInr:invTotInr
					},
					success:function(data){
						/* alert(data); */
						$('#inv_totwords').html(data);	
						$('#inv_totwor').val(data);	
					}
			});
	});
	
	 $("#freight_amount").keyup(function(){
		frAmtt=($("#freight_amount").val());
		hTaxx=($("#h_tax").val());
		hTax=parseFloat($("#h_tax").val());
		TaxxRt=($("#tax_rate").val());
		TaxxR=parseFloat($("#tax_rate").val());
		frAmt=parseFloat($("#freight_amount").val());
		invSub=parseFloat($("#inv_subtotal").val()); 
		totItmval=parseFloat($("#total_itemval").val());
		convRate=parseFloat($("#conversion_rate").val());
		
		if(frAmtt!='' && hTaxx!=''){
				totVal=parseFloat((hTax/100)*clinQty*totItmval);
				alert(totVal);
				totvalTx=(totVal+totItmval+frAmt);
				inrConv=(totvalTx*convRate);
				invS=($("#inv_subtotal").val(totvalTx.toFixed(2)));
				invInr=($("#invoice_total_inr").val(inrConv.toFixed(2)));
				invUs=($("#invoice_total_usd").val(totvalTx.toFixed(2)));
		}
		 if(frAmtt!='' && TaxxRt!=''){
				totVal=parseFloat((TaxxR/100)*clinQty*totItmval);
				totvalTx=(totVal+totItmval+frAmt);
				inrConv=(totvalTx*convRate);
				invS=($("#inv_subtotal").val(totvalTx.toFixed(2)));
				invInr=($("#invoice_total_inr").val(inrConv.toFixed(2)));
				invUs=($("#invoice_total_usd").val(totvalTx.toFixed(2)));
		}
		if(frAmtt=='' && hTaxx=='' && TaxxRt==''){
				freinvAmt=(totItmval);
				inrConv=(freinvAmt*convRate);
				invS=($("#inv_subtotal").val(freinvAmt.toFixed(2)));
				invInr=($("#invoice_total_inr").val(inrConv.toFixed(2)));
				invUs=($("#invoice_total_usd").val(freinvAmt.toFixed(2)));
		}
		if(frAmtt!='' && hTaxx=='' && TaxxRt==''){
				freinvAmt=(totItmval+frAmt);
				inrConv=(freinvAmt*convRate);
				invS=($("#inv_subtotal").val(freinvAmt.toFixed(2)));
				invInr=($("#invoice_total_inr").val(inrConv.toFixed(2)));
				invUs=($("#invoice_total_usd").val(freinvAmt.toFixed(2)));
		} 
		invTotInr=$("#invoice_total_inr").val();
			invTotal=parseFloat($('#invoice_total').val());
			$.ajax({
				type:'GET',
				url:'  ../action/selInvTOtalWords.php',
					data:{
							invTotInr:invTotInr
					},
					success:function(data){
						/* alert(data); */
						$('#inv_totwords').html(data);	
						$('#inv_totwor').val(data);	
					}
			});
		
	}); 
	
	var myCalendar;
	myCalendar = new dhtmlXCalendarObject(["calendar","calendar2","calendar3"]);
	myCalendar.setDateFormat("%d-%m-%Y");
	jQuery("#invoicepage").validationEngine();
	
	
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
	clinDest=$('.clinDest').val(); 
	
	/* var searchString = clinDest;
	alert(searchString);
	$("#addedRowsED tr td:contains('" + searchString  + "')").each(function() {
	alert($(this).text());
    if ($(this).text() != searchString) {
		alert('Clin destination are different');
    }  
	});
 */

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

/* function fromHTax() {
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
} */


function selINVrFQNoDet() {
	rfqNO=$("#rfq_no").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selINVoiceRFQDet.php',
			data:{
			rfqNO:rfqNO
			},
			success:function(data){
				   /* alert(data); */  
			 	  qte=data.split('@'); 
				/*   $('#clintDest').html(data); */
				  $('#clin_dest').val(qte[0]);
				  $('#clin_qty').val(qte[1]);
				  $('#total_itemval').val(qte[2]);
			}
	});
}
	
/* function selClinDest() {
	clin_dest=$('#clin_dest').val();
	rfqNO=$("#rfq_no").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selCLINShip.php',
			data:{
			clin_dest:clin_dest,
			rfqNO:rfqNO
			},
			success:function(data){
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
} */

/* 
function checkUnitPRice() {
	unitPrc=parseFloat($('#unit_price').val());
	Qty=parseFloat($('#qty').val());
	totPrc=parseFloat(unitPrc*Qty);
	parseFloat($('#total_itemval').val(totPrc));
		  $('#inv_subtotal').val(totPrc);	
		  $('#invoice_total').val(totPrc);	
	rfqNO=$("#rfq_no").val();
	invoice_total_inr=$("#invoice_total_inr").val();
	invTotal=parseFloat($('#invoice_total').val());
	$.ajax({
		type:'GET',
		url:'  ../action/selInvTOtalWords.php',
			data:{
				invTotInr:invTotInr
			},
			success:function(data){
				alert(data);
				$('#inv_totwords').html(data);	
			}
	});
} */

function chRFQQty(no){
	conRFQ=$('#cont_rfq'+no).val();
	convRate=parseFloat($("#conversion_rate").val());
	$.ajax({
		type:'GET',
		url:'  ../action/selInvPAgeRFQQty.php',
			data:{
			conRFQ:conRFQ,
			convRate:convRate
			},
			success:function(data){
				/*  alert(data);  */
				 opt=data.split(',');
			 	 eachPr=parseFloat(parseFloat(opt[5])*convRate);
				 /* clnPr=parseFloat(eachPr*opt[1]); */
				/*  alert(eachPr);  */
				 $('#cont_dest'+no).val(opt[0]);
				 $('#cont_qty'+no).val(opt[1]);
				 $('#total_itemval').val(opt[5]);
				 $('#inv_subtotal').val(opt[5]);
				 $('#inv_subtotal').val(opt[5]);
				 $('#invoice_total_inr').val(eachPr);
				 $('#invoice_total_usd').val(opt[5]);
				 $('#inv_totwords').html(opt[6]);
				 $('#inv_totwor').val(opt[6]);	
				 if(data==1){
					 alert('RFQ Number not available.');
					  $('#cont_dest'+no).val('');
					  $('#cont_rfq'+no).val('');
				 }
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

function noOfContract(){
	multCtract=$("#mult_contract").val();
	if(multCtract=='yes'){
		$("#noRfq").show();
		$("#addedRowsEBS").show();
		$("#addedRowsED").show();
		$("#snglEBSinv").hide();
		$(".rfqSingle").hide();	
	}else if(multCtract=='no'){
		$("#noRfq").hide();
		$("#addedRowsEBS").hide();
		$("#addedRowsED").hide();
		$(".rfqSingle").show();	
		$("#snglEBSinv").show();
	}
}

var PrependZeros = function (str, len) {
    if(typeof str === 'number' || Number(str)){
    str = str.toString();
    return (len - str.length > 0) ? new Array(len + 1 - str.length).join('0') + str: str;
}
else{
    for(var i = 0,spl = str.split(' '); i < spl.length; spl[i] = (Number(spl[i])&& spl[i].length < len)?PrependZeros(spl[i],len):spl[i],str = (i == spl.length -1)?spl.join(' '):str,i++);
    return str;
}
}

function genContract(){
	var rowCount = 0;
	var rowCont = 0;
	no_rfq=$("#no_rfq_no").val();
	var rowTblCount = $('#addedRowsED tr').length;
	$('#addedRowsED').html('');
	/* alert(rowTblCount); */
		for(i=0;i<no_rfq;i++) {
		     rowCount=rowCount+1; 
			
			 var recRow = '<tr id="rowCount'+rowCount+'"><td style="width:250px">RFQ.'+rowCount+' :</td><td><input name="cont_rfq[]" id="cont_rfq'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase exTRfq" onblur="chRFQQty('+rowCount+');"/></td></tr><tr id="rowCount'+rowCount+'"><td style="width:250px">Clin Dest.'+rowCount+' :</td><td><input name="clin_dest[]" id="cont_dest'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase clinDest"/></td></tr><tr id="rowCount'+rowCount+'"><td style="width:250px">Qty.'+rowCount+' :</td><td><input name="clin_qty[]" id="cont_qty'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase clQTy"/></td></tr> '; 
 
			jQuery('#addedRowsED').append(recRow); 
			$('#rowCount').val(rowCount);
		}
		
		ebsNextNo=parseFloat($("#ebsNextNo").val());
		m=0;
		for(j=0;j<no_rfq;j++) {
		     rowCont=rowCont+1; 
			m=m+1;
		    ebsI=parseFloat(ebsNextNo+m);
			ff= PrependZeros(ebsI,6);
			 var recRw = '<tr id="rowCont'+rowCont+'"><td style="width:250px">EBSInvoice No.'+rowCont+' :</td><td><input name="ebsinv_no[]" id="ebsinv_no'+rowCont+'" type="text" data-validation="required" value="'+ff+'" class="input validate[required] textbox codesUPPERCase"/></td></tr>'; 
 
			jQuery('#addedRowsEBS').append(recRw); 
			$('#rowCont').val(rowCont);
		}
}

function fromHtaxRte() {
	taxTpe=$('#tax_type').val();
	if(taxTpe=='fromhtax'){
		$("#frHtx").show();
		$("#frTXRate").hide();
		$('#tax_rate').val('');
	}
	if(taxTpe=='taxrate'){
		$("#frHtx").hide();
		$("#frTXRate").show();
		$('#h_tax').val(''); 
	}
	if(taxTpe==''){
		$("#frHtx").hide();
		$("#frTXRate").hide();
		$('#tax_rate').val('');
		$('#h_tax').val('');
	}
}

function freightAmt(){
	freight=$("#add_freight").val();
	if(freight=='yes'){
		$("#FreightAmot").show();
	}
	if(freight=='no' || freight==''){
		$("#FreightAmot").hide();
	}
	/* if(freight==''){
		$("#freight_amount").hide();
	} */
}

function selectInvRFQ(val) {
$("#rfq_no").val(val);
$("#suggesstion-box").hide();
}

function checkBIlltoCode(){
	bcode=$("#billto_code").val();
	$.ajax({
		type:'GET',
		url:'  ../action/selInvBilltoCOde.php',
			data:{
			bcode:bcode
			},
			success:function(data){
				/* alert(data); */
				opt=data.split(',');
				$("#bill_1").val(opt[0]);
				$("#bill_2").val(opt[1]);
				$("#bill_3").val(opt[2]);
				$("#bill_4").val(opt[3]);
			}
	});	
	
}
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
	$sqlE="select max(ebsinv_no) as maxnumber  from invoice" ;
    $resultE = mysql_query($sqlE);
    $rowE = mysql_fetch_array($resultE);

 $sqlCu=mysql_query("select * from currency_master where currency_code='USD'"); 
 $rowCu=mysql_fetch_array($sqlCu);
 $conRate=$rowCu['conversion_rate']; 
?>
<body class="bgBODY">
<div class="about">
	<div id="invoice" style="border:1px solid #ddd;margin:0 auto;">
		<div class="col-md-12" >
			<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Invoice Page</b></h3>
			
<form id="invoicepage" name="invoicepage" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add-invoice.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="conversion_rate" id="conversion_rate" value="<?php echo $conRate;?>" type="hidden"/>
<input name="ebsNextNo" id="ebsNextNo" value="<?php  echo $rowE['maxnumber'];?>" type="hidden"/>
<input name="invitemVal" id="invitemVal" value="" type="hidden" class="itVal"/>
<div class="block_top_1">
	<table style="float:left;" class="table table-condensed table-disable-hover" cellpadding="0" cellspacing="0" class="table" border="0" >
				<tr>
						<td width="125" valign="top">Multiple Contracts:</td>
						<td valign="top">
						<select name="mult_contract" id="mult_contract" onchange="noOfContract();" data-validation="required" class="input validate[required] textbox cur_date">
						<option value="">--Select--</option>
						<option value="yes">Yes</option>
						<option value="no">No</option>
						</select>
						</td>
				</tr>
				<tr>
						<td width="125" valign="top">Invoice Type * :</td>
						<td valign="top">
						<select name="invoice_type" id="invoice_type" onchange="selInvType();" data-validation="required" class="input validate[required] textbox cur_date">
						<option value="">--Select--</option>
						<option value="commercial">Commercial</option>
						<option value="sample">Sample</option>
						</select>
						</td>
				</tr>
				<tr>
					<td width="125" valign="top">Invoice Date *:</td>
					<td valign="top">
						<input name="invoice_date" id="calendar" type="text" class="textbox invDte" onblur="checkitemcode()"/>
					</td>
				</tr>
				<tr style="display:none;" id="noRfq">
					<td width="125" valign="top">Number of RFQ:</td>
					<td valign="top"><input name="no_rfq_no" id="no_rfq_no" type="text" onKeyup="genContract();" data-validation="required" class="input validate[required] textbox fstChUPPRCase"/></td>
				</tr>
				
			<tbody id="addedRowsED" style="">
			</tbody>
				<!--<tr style="display:none;" id="rfqSingle">
					<td width="125" valign="top">RFQ No:</td>
					<td valign="top"><input name="rfq_no" id="rfq_no" type="text" class="textbox" onblur="selINVrFQNoDet();" /></td>
				</tr>-->

				
				<tr style="display:none;" class="rfqSingle">
					<td width="125" valign="top">RFQ No:</td>
					<td valign="top"><input name="cont_rfqs" id="rfq_no" type="text" class="textbox" onClick="selINVrFQNoDet();" />
					<div id="suggesstion-box"></div>
					
					</td>
				</tr>
				<tr style="display:none;" class="rfqSingle">
					<td width="125" valign="top">CLIN Dest:</td>
					<td valign="top" id="clintDest">
					<input name="clin_dests" id="clin_dest" type="text" class="textbox" /></td>
				</tr>
				<tr style="display:none;" class="rfqSingle">
					<td width="125" valign="top">Qty:</td>
					<td valign="top" id="clintDest">
					<input name="clin_qtys" id="clin_qty" type="text" class="textbox clQTy" /></td>
				</tr>
				<!--<tr>
					<td width="125" valign="top">CLIN Dest:</td>
					<td valign="top" id="clintDest">
					<select name="clin_dest[]" id="clin_dest" style="font-size:14px;" onChange="selClinDest();" class="clnDest">
					<option value=''>--Select--</option>
					</select>
					</td>
				</tr>-->
				<tr>
					<td width="125" valign="top">Invoice No :</td>
					<td valign="top"><input name="invoice_no" id="invoice_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo getNextInvoiceNumber(); ?>"/></td>
				</tr>
				<tbody id="addedRowsEBS" style="">
				</tbody>
				<tr id="snglEBSinv" style="display:none;">
					<td width="125" valign="top">EBS Invoice No:</td>
					<td valign="top"><input name="ebsinv_nos" id="ebsinv_no" type="text" class="textbox" value="<?php  echo getNextEBSInvoiceNumber();?>" onblur="checkitemcode()"/></td>
				</tr>
				<!--<tr>
					<td width="125" valign="top">NSN No./Nos.:</td>
					<td valign="top"><input name="nsn_no" id="nsn_no" type="text" class="textbox" onblur="checkitemcode()" data-validation="required" class="input validate[required] textbox fstChUPPRCase"/></td>
				</tr>-->
										
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
							if($resultba['currency_default']==$rowC['currency_default']){
																
						?>
						<option value="<?php echo $resultba['currency_code'];?>" selected><?php echo $resultba['currency_code'];?></option>
									<?php }else{?>
						<option value="<?php echo $resultba['currency_code'];?>"><?php echo $resultba['currency_code'];?></option>
						<?php } }?>		
					</select>
				</td>
			</tr>
				<!--<tr>
					<td width="125" valign="top">Add another Contract :</td>
					<td valign="top">
					<select name="addanot_cont" id="addanot_cont">
						<option value="">--Select--</option>
						<option value="yes">Yes</option>
						<option value="no">No</option>
						</select>
					</td>
				</tr>-->
				</table>
						
					
				<table style="float:left;" class="table table-condensed table-disable-hover" cellpadding="0" cellspacing="0" class="table" border="0" >
					
				
						
					
				</table>
			</div>
			<div class="block_top_2">
			<table style="" class="table">
				<tr>
					<td width="125" valign="top">Bill To Code :</td>
					<td valign="top"><input name="billto_code" id="billto_code" type="text"onkeyUp="checkBIlltoCode()" /></td>
				</tr>
			</table>
			<table style="" class="table">
			
		
			<ul id="myTab" class="nav nav-tabs">
				 <li class="active"><a href="#tab_billto" data-toggle="tab">Bill To</a></li>
				 <li><a href="#tab_shippto" data-toggle="tab">Ship To</a></li>
			 </ul>

			 <div id="myTabContent" class="tab-content" >
				 <div class="tab-pane fade in active" id="tab_billto">
					 <input id="bill_1" name="bill_1" value="" style="width:271px" type="text" placeholder="Address Line 1">
					 <input id="bill_2" name="bill_2" value="" style="width:271px" type="text" placeholder="Address Line 2">
					 <input id="bill_3" name="bill_3" value="" style="width:271px" type="text" placeholder="Address Line 3">
					 <input id="bill_4" name="bill_4" value="" style="width:271px" type="text" placeholder="Address Line 4">
				 </div>
				 <div class="tab-pane fade in " id="tab_shippto">
					<input id="ship_1"  name="ship_1" value="" style="width:271px" type="text" placeholder="Address Line 1">
					<input id="ship_2"  name="ship_2" value="" style="width:271px" type="text" placeholder="Address Line 2">
					<input id="ship_3"  name="ship_3" value="" style="width:271px" type="text" placeholder="Address Line 3">
					<input id="ship_4"  name="ship_4" value="" style="width:271px" type="text" placeholder="Address Line 4">
				 </div>
				 </div>
		<tr>
			<td width="145" valign="top" >Tax Type :</td>
			<td width="385" valign="top" >
			<select name="tax_type" id="tax_type" onChange="fromHtaxRte();" >
				<option value="">--Select--</option>
				<option value="fromhtax">From H/Tax</option>
				<option value="taxrate">Tax rate</option>
			</select>
							
			<!--<input type="radio" id="from_htax" name="status" value="1" style="width:14px;" checked onclick="fromHtax();"/>&nbsp;<span style="vertical-align: super;">From H/Tax</span>&nbsp;&nbsp;<input type="radio" id="tax_rate" name="status" style="width:14px;" value="0" onclick="TaxRate();"/>&nbsp;<span style="vertical-align: super;">Tax rate</span>-->
			</td>
		</tr>				 
			<tr id="frHtx" style="display:none;">
				<td width="125" valign="top">From H/Tax (%):</td>
				<td valign="top"><input name="h_tax" id="h_tax" type="text" class="textbox" /></td>
				
			</tr>
			<tr id="frTXRate" style="display:none;">
				<td width="125" valign="top">Tax rate (%):</td>
				<td valign="top"><input name="tax_rate" id="tax_rate" type="text" class="textbox" /></td>
				
			</tr>
			
						<tr>
							<td width="125" valign="top">Carrier :</td>
							<td valign="top"><input name="carrier" id="carrier" type="text" class="textbox" onblur="checkitemcode()" disabled /></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">AWB No :</td>
							<td valign="top"><input name="awb_no" id="awb_no" type="text" class="textbox" onblur="checkitemcode()" disabled /></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Add freight *:</td>
							<td valign="top">
							<select name="add_freight" id="add_freight" onChange="freightAmt();" disabled >
							<option value="">--Select--</option>
							<option value="yes">Yes</option>
							<option value="no">No</option>
							</select>
							</td>
						</tr>
						<tr id="FreightAmot" style="display:none;">
							<td width="125" valign="top">Freight Amount :</td>
							<td valign="top"><input name="freight_amount" id="freight_amount" type="text" class="textbox"/></td>
						</tr>
			
			
						<!--<tr>
							<td width="125" valign="top">Conversion Rate:</td>
							<td valign="top"><input name="conv_rate" id="conv_rate" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>-->
						
				
					
					
								
						
				
			</table>
			</div>
			<div class="block_top_3">
			<table style="" class="table">
				<tr>
					<td width="125" valign="top">Total Item Value:</td>
					<td valign="top"><input name="total_itemval" id="total_itemval" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase totIt" /></td>
				</tr>	
				<tr>
					<td width="125" valign="top">Invoice sub total :</td>
					<td valign="top"><input name="inv_subtotal" id="inv_subtotal" type="text"  data-validation="required" class="input validate[required] textbox fstChUPPRCase" /></td>
				</tr>
				<tr>
					<td width="125" valign="top">Invoice Total (INR)&nbsp;<span id="inrSmbl"></span>:</td>
					<td valign="top"><input name="invoice_total_inr" id="invoice_total_inr" type="text" class="textbox" onblur="invTOTtoWords();" data-validation="required" class="input validate[required] textbox fstChUPPRCase"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">Invoice Total (USD)&nbsp;<span id="inrSmbl"></span>:</td>
					<td valign="top"><input name="invoice_total_usd" id="invoice_total_usd" type="text" class="textbox" data-validation="required" class="input validate[required] textbox fstChUPPRCase"/></td>
				</tr>
				<!--<tr>
					<td width="125" valign="top">Invoice total in INR:</td>
					<td valign="top"><input name="inv_totcurrency" id="inv_totcurrency" type="text" class="textbox" onblur="checkitemcode()"/></td>
				</tr>-->
				<tr>
				
					<td width="125" valign="top">Invoice total in words:</td>
					<td valign="top" id="inv_totwords" style="border:1px solid #B1A795;overflow:auto;height:50px;">&nbsp;
				
					</td>
				</tr>	
					
				<tr>
					<td width="125" valign="top">Total No. of packages :</td>
					<td valign="top"><input name="total_packages" id="total_packages" type="text" class="textbox" onblur="checkitemcode()"/>
					<textarea name="inv_totwords" id="inv_totwor" style="width:200px;height:50px;" hidden></textarea>
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