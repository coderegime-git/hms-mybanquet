<?php
ob_start();
include("../../config.php");
include("../../header.php");
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
  
  
    /* $("#statusCHK").click(function(){
		alert('dsds');
		 if(this.checked) {
			 $("#confirm").removeAttr('disabled', false);
		 }else{
			 $("#confirm").attr('disabled', true);
		 }
	 
	}); */
	
	
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
 jQuery("#hotelDefi").validationEngine();
	
	$("#comp_desc").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../../action/selectCOMPNoCheckOut.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			/*  alert(data);  */
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
	
	$("#room_desc").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../../action/selectROOMDescCheckOut.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			/*  alert(data);  */
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
	
	
	
	$("#tariff").click(function(){
		
		 if(this.checked) {
			 $("#tariff_rt").val(1);
			 
			/*  alert(this.checked);
			$(".sourceonTAR").show();
			$(".sourceonVAL").hide(); */
			/* tarche='<select ><option value="">--Select--</option><option value="rack" >Rack</option><option value="charged" >Charged</option></select>';
			
			 var rowTblCo = $('#addedRowsED tr').length+1;
			 j=0;
				for(i=0;i<rowTblCo;i++)
				{
					vall=($('#source'+i).html(tarche));
					j++;
				}   */
				
							
		}  else{
			 $("#tariff_rt").val(0);
			/* $(".sourceonTAR").hide();
			$(".sourceonVAL").show();  */
			/* tarche='<select ><option value="">--Select--</option><option value="percentage" >On Value</option><option value="amount" >Discounted value</option></select>';
			 var rowTblCo = $('#addedRowsED tr').length+1;
			 j=0;
				for(i=0;i<rowTblCo;i++)
				{
					vall=($('#source'+i).html(tarche));
					j++;
				}  */
		 } 
	}); 
	
	
	
  $('#module_name').change(function() {
  modName="";
  if($(this).val()!=''){modName = "?modName="+$(this).val(); }
  document.location.href="update_parameters.php"+modName;	
  });
  
  
var dt = new Date();
var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
$('#departure_time').val(time);  

/* $('input[name^=cashrcd_amt]').live('keyup', function() {
	cashRcd=parseFloat($("#cashrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	csBlAmt=parseFloat(Bval-cashRcd);
	$("#balance").val(csBlAmt);
	cabaltAmt=$("#cashbal_amt").val();
	if(cabaltAmt=="NaN"){$("#cashbal_amt").val('');}
	
	if(cabaltAmt==0){
		$("#submit").removeAttr('disabled', true);
	}
}); */	

$('input[name^=cashrcd_amt]').live('keyup', function() {
	cashRcd=parseFloat($("#cashrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	cabaltAmt=$("#balance").val();
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt);
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
		
});	

$('input[name^=cardrcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#cardrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt);
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	if(cardRcd!='0'){
		$("#card_desc").removeAttr('disabled', true);
	}else{
		$("#card_desc").attr('disabled','disabled');
	}
	 
});	

$('input[name^=comprcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#comprcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt);
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	
	if(cardRcd!='0'){
		$("#comp_desc").removeAttr('disabled', true);
	}else{
		$("#comp_desc").attr('disabled','disabled');
	}
	
});	

$('input[name^=chequercd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#chequercd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt);
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	

});

$('input[name^=roomrcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#roomrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt);
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	if(cardRcd!='0'){
		$("#room_desc").removeAttr('disabled', true);
	}else{
		$("#room_desc").attr('disabled','disabled');
	}
	
});

$('input[name^=refundrcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#refundrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt);
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
});


$('.inputs').keydown(function (e){
   if(e.keyCode == 13){
     $(this).next('.inputs').focus();
 }
});

/* $("#comp_desc").blur(function(){
	coDes=$("#comp_desc").val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatSettleCompName.php',
			data:{
			coDes:coDes
			},
			success:function(data){
				if(data==0){
					alert("Company name not exists!");
					$("#comp_desc").val('');
				}
			}
	});
}); */


bal=$("#balance").val();
if(bal==0){
	 $("#confirm").removeAttr('disabled', true); 
	$("#refundrcd_amt").removeAttr('disabled', true); 
	$("#refund_desc").removeAttr('disabled', true); 
	$("#refund_tips").removeAttr('disabled', true); 
	$("#refund_rem").removeAttr('disabled', true); 
	$("#cashrcd_amt").attr('disabled', 'disabled');
	$("#cardrcd_amt").attr('disabled', 'disabled');
	$("#comprcd_amt").attr('disabled', 'disabled');
	$("#chequercd_amt").attr('disabled', 'disabled');
	$("#roomrcd_amt").attr('disabled', 'disabled');
}else{
	$("#refundrcd_amt").attr('disabled', 'disabled'); 
	$("#refund_desc").attr('disabled', 'disabled'); 
	$("#refund_tips").attr('disabled', 'disabled'); 
	$("#refund_rem").attr('disabled', 'disabled');
	$("#cashrcd_amt").removeAttr('disabled', true);
	$("#cardrcd_amt").removeAttr('disabled', true);
	$("#comprcd_amt").removeAttr('disabled', true);
	$("#chequercd_amt").removeAttr('disabled', true);
	$("#roomrcd_amt").removeAttr('disabled', true);
}


});

function selectRoomNO(val) {
	$("#room_number").val(val);
	$("#suggesstion-box").hide();
}


/* window.onload = function() {

} */


shortcut.add("Ctrl+S",function() { 
	 $('#hotelDefi').attr('action', '../../action/add_fotax_structure.php');  
	 $('#hotelDefi').submit(); 
}); 
shortcut.add("Ctrl+V",function() { 
	window.location.href = "view-fotax-structure.php";
});
shortcut.add("Ctrl+C",function() { 
  $('#hotelDefi').find("input[type=text], textarea").val("");
});
shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});





var rowCount = 0; 
function addMoreRows(frm) {
	rowCount=rowCount+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsED tr').length+2;
	
	var recRow = '<tr id="rowCount'+rowCount+'"><td style="width:100px;text-align:center;" id="room'+rowCount+'">'+rowCount+'</td><td style="width:250px;text-align:center;"><select name="tax_code[]" id="tax_code'+rowCount+'" style="font-size:12px;width:100px;height:18px;" onChange="selTaxCode();" class="wagRw1"><option value="">--Select--</option><?php $sqle="select * from tax_type";$rowe=mysql_query($sqle);while($resulte=mysql_fetch_array($rowe)){?><option value="<?php echo $resulte['tax_code'] ?>" ><?php echo $resulte['tax_code']; ?></option><?php }?></select></td><td style="width:100px;text-align:center;" id="room"><input name="tax_desc[]" id="tax_desc'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase"/></td><td style="text-align:center;"><select name="factor[]" id="factor'+rowCount+'" style="font-size:12px;width:100px;height:18px;"><option value="">--Select--</option><option value="percentage" >Percentage</option><option value="amount" >Amount</option></select></td><td style="text-align:center;"><input name="factor_value[]" id="factor_value'+rowCount+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:0 0 0 15px" /></td><td style="text-align:center;display:none;" class="sourceonTAR"><select name="source[]" id="source'+rowCount+'" style="font-size:12px;width:100px;height:18px;" class="sourceE"><option value="">--Select--</option><option value="rack">Rack</option><option value="charged">Charged</option></select></td><td style="text-align:center;" class="sourceonVAL"><select name="source[]" id="source'+rowCount+'" style="font-size:12px;width:100px;height:18px;" class="sourceE"><option value="">--Select--</option><option value="onvalue">On Value</option><option value="discountedvalue">Discounted Value</option></select></td><td style="text-align:center;"><a href="javascript:void(0);" onclick="removeRow('+rowCount+');" name="remove['+rowCount+']" id="remove_'+ rowCount +'" class="deleterecord"><img src="../../images/removeicon.png" class="familyEmpMasterHREF" style="width:20px;height:20px;"/></a></td></tr>'; 
	
	 jQuery('#addedRowsED').append(recRow); 
	$('#rowCount').val(rowCount);
	
	trF=$('#tariff_rt').val();
	if(trF==1){
	$(".sourceonTAR").show();
	$(".sourceonVAL").hide();	
	}else{
		$(".sourceonTAR").hide();
		$(".sourceonVAL").show();	
	}
}


	function removeRow(removeNum) {
	 jQuery('#rowCount'+removeNum).remove(); 
	} 

function selTaxCode(){
	var rowTblCo = $('#addedRowsED tr').length+1;
	taxCode=$('#tax_code'+rowCount).val();
	/* taxVl=$('.txCde').val(taxCode); */
/* 	alert(taxCode); */
	/* alert('sdsd'+taxVl); */
	
		
	$.ajax({
		type:'GET',
		url:'  ../../action/selectFoStructureCode.php',
			data:{
			taxCode:taxCode
			},
			success:function(data){
				 /*  alert(data);  */
				  /* var x = optDt.split(',');
				j=0;
				for(i=0;i<x.length;i++)
				{
					vall=($('#tax_desc'+j).val(x[i]));
					j++;
				}  */
			
			  $('#tax_desc'+rowCount).val(data);
			}
	});
}



function getBillNumDetails() {
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/settleBillDetails.php',"_blank",'scrollbars=1,menubar=0,resizable=1,width=320,top=100,left=500,height=190');
	newwindow.focus();
}

 function checkSubmit(cb){
	 var menuStr="";
	$('.chk').each(function(i,v){
		if($(this).is(':checked'))
		{
		menuStr +=$(this).val()+',';
		 $("#confirm").removeAttr('disabled', true); 
		}
	});
	menuStr = menuStr.slice(0,-1);
	$("#hid_menu").val(menuStr);
}
  
/* function chekoutSubmit() { */
	
	
	/*  depT=$('#departure_time').val(); 
	 val=$("#hid_menu").val();
		$('#hotelDefi').attr('action', 'check_out_savesplit.php?reg_num='+val+'&dep='+depT);  
	 $('#hotelDefi').submit(); 
 */
/* } */
  
function settleCash() {
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/selectSettleCash.php',"_blank",'scrollbars=1,menubar=0,resizable=1,width=500,top=100,left=500,height=220');
	newwindow.focus();
	
	/* $.ajax({
		type:'GET',
		url:'  ../../action/selectSettleCash.php',
			data:{
			taxCode:taxCode
			},
			success:function(data){
				alert(data);
			}
	}); */
}

function selectCmp(val) {
$("#comp_desc").val(val);
$("#suggesstion-box").hide();
}

function formSubmit() {
$("#refundrcd_amt").removeAttr('disabled', true); 
 	var menuStr="";
	$('.remSum').each(function(i,v){
		 if($(this).val()!='')
		{ 
		menuStr +=$(this).val()+',';
		 }
	});
	menuStr = menuStr.slice(0,-1);
	$("#hid_menu").val(menuStr);
return true;

$.ajax({
		type:'GET',
		url:'  ../../action/selectSettleSUBMIT.php',
			data:{
			taxCode:taxCode
			},
			success:function(data){
				alert(data);
			}
	}); 
	
	
}

/* function setMenu()
{
	
} */


</script> 
<body class="bgBODY">
<div class="about">
<div id="invoice" style="">
	<!--<div class="container" >-->
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
    padding: 2px 9px 0 5px;
		
}

.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:0;padding:0;width:90px;position: absolute;z-index: 1;}
#country-list li{padding: 2px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;font-size:12px;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}

/* thead, tbody { display: block; }

tbody {
    height: 300px;      
    overflow-y: auto;    
    overflow-x: hidden;  
} */

.tathead{ display: block;border:none; }

.tatbody {
   /*  height: 350px; */       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
	border:none;
}
.tbHd{
	color: #5b503b;
    display: block;
    float: right;
    font-size: 12px;
    font-weight: normal;
    padding: 3px 9px 0 0;
	font-weight:normal;
}


.tableS > thead > tr > th, .tableS > tbody > tr > th, .table > tfoot > tr > th, .tableS > thead > tr > td, .tableS > tbody > tr > td, .tableS > tfoot > tr > td {
  color: #333333;
  border:1px solid #CCCCCC;
}

.inptSt {
	border: none;
    border-radius: 0;
    color: #555555;
    display: inline-block;
    font-size: 13px;
    line-height: 18px;
 }
 	.buttExaS {
    background-color: #ffffff;
    border: 1px solid #888888;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
   /*  margin-left: -3px; */
    padding: 5.1px 0px;
    /* padding: 5.5px 59px; */
	width:125px;
}

	.butEx{
	background-color: #ffffff;
    border: 1px solid #ddd;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 58px;
	}
	</style>
		
	<div id="addcustomer" class="frmCentr divBrd" style="width:712px;height:344px;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Settlement</b></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_settlement.php" method="post" class="" style="">
		<div>
		<input type="hidden" name="tariff_rt" id="tariff_rt" />
		<input type="hidden" name="taxCodee" id="taxCodee" class="txCde"/>
		<input type="hidden" name="departure_time" id="departure_time" class=""/>
		<textarea id="hid_menu" name="hid_menu" value="" hidden ></textarea>
		

<?php  /* if(isset($_GET['romNo'])) { $sqlG=mysql_fetch_array(mysql_query("select * from guest_register where room_no='".$_GET['romNo']."' AND bill_status='1'")); } 

if(isset($_GET['romNo'])) { 
$sqlB=mysql_query("select (sum(tax_val)+sum(debit)-sum(credit)) AS balance,gt.room_no,gt.reg_num,gt.bill_status,gr.guest_name,max(gt.trans_date)AS tranSDte,gr.departure_date from guest_trans gt,guest_register gr,room_master rm where gt.room_no='".$_GET['romNo']."' AND gr.room_no='".$_GET['romNo']."' AND  gr.guestreg_id=gt.reg_num AND rm.room_number='".$_GET['romNo']."' AND rm.occupy_status='3' AND gt.bill_status='1'"); 
$nmRws=mysql_num_rows($sqlB);
$rowRTs=mysql_fetch_array($sqlB);

if($nmRws>0 && $rowRTs['tranSDte']!='NULL' && $rowRTs['tranSDte']!=''){
	$tranSDte=$rowRTs['tranSDte'];
}else{
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$tranSDte=$rowAC['cur_date'];
}
		$exPA=explode('/',$tranSDte);
		$frmDate=@$exPA[2].'-'.@$exPA[1].'-'.@$exPA[0];
		$exPT=explode('/',$rowRTs['departure_date']);
		$toDate=@$exPT[2].'-'.@$exPT[1].'-'.@$exPT[0];
		$arrival_date=strtotime($frmDate);
		$departure_date=strtotime($toDate);
		$datediff = $departure_date - $arrival_date;
		$datediffF=round(abs(($datediff/(60*60*24))));	
} */	

	
if(isset($_GET['rgNm'])){
 /* echo "select * from bill_header bh,guest_register gr where gr.guestreg_id='".$_GET['rgNm']."' AND bh.reg_num='".$_GET['rgNm']."' AND settleflag='4'"; */ 	
$sqlBh=mysql_query("select * from bill_header bh,guest_register gr where gr.guestreg_id='".$_GET['rgNm']."' AND bh.reg_num='".$_GET['rgNm']."' AND settleflag='4'");
$rowBh=mysql_fetch_array($sqlBh); 
	if($rowBh['net_amt']<0){
		$refund=$rowBh['net_amt'];
	}else{
		$refund=0;
	}
	
	if($rowBh['net_amt']>0){
		$balNc=$rowBh['net_amt'];
	}else{
		$balNc=0;
	}
}
?>		
	<table style="float:left;width:100%;margin:4px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS" border="0" >
			<tbody>
			<tr>
					<td width="60" valign="top"><label style="float:right;width:65px;margin:0 0 0 6px;">Outlet<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="bill_no" id="bill_no" class="input required textbox codesUPPERCase inptSt" style="width:82px;" value="<?php if(isset($_GET['blNo'])){ echo $_GET['blNo'];} ?>" onclick="getBillNumDetails();" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:84px;margin:0 0 0 6px;">Table No<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="bill_amt" id="bill_amt" type="text" class="input required fstChUPPRCase inptSt" style="width:138px;" value="<?php if(isset($rowBh['net_amt'])){ echo $rowBh['net_amt'];} ?>" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:55px;margin:0 0 0 6px;">Bill Amt <em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="balance" id="balance" type="text" class="fstChUPPRCase inptSt" style="width:100px;" value="<?php if(isset($rowBh['net_amt'])){ echo $balNc;} ?>" readonly />
					</td>
					
				</tr>	
				<tr>
					<td width="60" valign="top"><label style="float:right;width:65px;margin:0 0 0 6px;">Bill #<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="room_no" id="room_no" class="input required textbox codesUPPERCase inptSt" style="width:82px;" value="<?php if(isset($rowBh['room_no'])){ echo $rowBh['room_no'];} ?>" onkeyup="getGUestName();" />
					</td>
					<td width="60" valign="top"><label style="float:right;width:84px;margin:0 0 0 6px;">Tips<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="guest_name" id="guest_name" type="text"class="input required fstChUPPRCase inptSt" style="width:138px;" value="<?php if(isset($rowBh['mainguest_name'])){ echo $rowBh['mainguest_name'];} ?>" readonly />
					</td>
					<td width="60" valign="top"><label style="float:right;width:53px;margin:0 0 0 6px;">Settled<em></em></label></td>
					<td valign="top" style="margin:0 0 0 0;">
					<input name="pay_mode" id="pay_mode" type="text" class="input required fstChUPPRCase inptSt" style="width:100px;" value="<?php if(isset($rowBh['pay_mode'])){ echo $rowBh['pay_mode'];} ?>" readonly />
					</td>
					<!--<td valign="top" style="margin:0 0 0 0;">-->
<?php 
/* if(isset($_GET['billNm'],$rowBh['room_no'])){
	$sqlBh=mysql_query("select distinct room_no from bill_detail where bill_no='".$_GET['billNm']."' AND room_no!='".$rowBh['room_no']."'");
	$rmNm="";
	while($rowB=mysql_fetch_array($sqlBh)){
		$rmNm.=$rowBh['room_no'];
	}
} */
?>
					<!--<input name="link_room" id="link_room" type="text" class="fstChUPPRCase inptSt" style="width:100px;" value="<?php /* if(isset($rmNm)) {echo $rmNm;} */ ?>" readonly />
					
					</td>-->
				</tr>	
	<tr>
		<td width="60" valign="top"><label style="float:right;width:76px;margin:0 0 0 6px;">Membership<em></em></label></td>
		<td valign="top" style="margin:0 0 0 0;">
		<input name="arrival_date" id="arrival_date" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase inptSt" style="width:75px;" value="<?php if(isset($rowBh['arrival_date'])){ echo $rowBh['arrival_date'];} ?>" readonly />
		<input name="arrival_time" id="arrival_time" type="text" class="fstChUPPRCase inptSt" style="width:62px;" value="<?php if(isset($rowBh['arrival_time'])){ echo $rowBh['arrival_time'];} ?>" readonly />
		</td>
		<td width="60" valign="top"><label style="float:right;width:84px;margin:0 0 0 6px;">Booker Id<em></em></label></td>
		<td valign="top" style="margin:0 0 0 0;">
		<input name="arrival_date" id="arrival_date" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase inptSt" style="width:75px;" value="<?php if(isset($curDate)){ echo $curDate;} ?>" readonly />
		<input name="departure_time" id="departure_time" type="text" class="fstChUPPRCase inptSt" style="width:62px;" value="<?php if(isset($rowBh['departure_time'])){ echo $rowBh['departure_time'];} ?>" readonly />
		</td>
		<td width="60" valign="top"><label style="float:right;width:53px;margin:0 0 0 6px;">Balance <em></em></label></td>
		<td valign="top" style="margin:0 0 0 0;">
		<input name="regNm" id="regNm" type="text" class="fstChUPPRCase inptSt" style="width:100px;" value="&nbsp;<?php if(isset($_GET['rgNm'])){echo $_GET['rgNm'];}?>" readonly />
		</td>
		
	</tr>		
	</tbody>
</table>
	
<table class="table tableS" style="width:15%;float:left;margin:0px 0 0 0;text-align:center;font-size:12px;">
<tr>
<th width="" style="text-align:center;background-color:#0080C0;color:#fff;width:1%;">Mode</th>
</tr>
<tr>
<td>
<button type="button" id="cash" name="pay_mode" value="cash" class="buttExaS bnkSbt frstChr submit" style="" onclick="checkCheOutCash();" disabled >&nbsp;&nbsp;<span class="btnUndLine">C</span>ash</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="card" name="pay_mode" value="card" class="buttExaS" style="" onclick="checkCheOutCard();">&nbsp;&nbsp;<span class="btnUndLine">C</span>ard</button></a>
</td>
</tr>
<tr>
<td>
<button type="button" id="company" name="pay_mode" value="company" class="buttExaS bnkSbt" onclick="checkCheOutCompany();" >&nbsp;&nbsp;<span class="btnUndLine">C</span>ompany</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="cheque" name="pay_mode" value="cheque" class="buttExaS" style="" onclick="checkCheOutCheq();" >&nbsp;&nbsp;<span class="btnUndLine">C</span>heque</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="room" name="pay_mode" value="room" class="buttExaS" style="" onclick="checkCheOutNEFT();" >&nbsp;&nbsp;<span class="btnUndLine">R</span>oom</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="refund" name="pay_mode" value="refund" class="buttExaS" style="" onclick="checkCheOutNEFT();" >&nbsp;&nbsp;<span class="btnUndLine">R</span>efund</button>
</td>
</tr>
</table>
		
<div id="" style="width:82%;float:right;">

<table cellpadding="0" cellspacing="0" border="1" class="" style="text-align:center;font-size:12px;width:100%;background-color:#fff;">
	<tr>
		<th width="" style="text-align:center;background-color:#0080C0;color:#fff;width:20%;">Amount</th>
		<th width="" style="text-align:center;background-color:#0080C0;color:#fff;width:16%;">Description</th>
		<th width="" style="text-align:center;background-color:#0080C0;color:#fff;width:16%;">Tips</th>
		<th width="" style="text-align:center;background-color:#0080C0;color:#fff;width:30%;">Remarks</th>
	</tr>
	<?php /* for($i=0;$i<5;$i++) { */?>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="cashrcd_amt" id="cashrcd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="cash_desc" id="cash_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="cash_tips" id="cash_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="cash_rem" id="cash_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"/></td>
	</tr>
	<?php /* } */ ?>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="cardrcd_amt" id="cardrcd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;">
		<select name="card_desc" id="card_desc" style="width:90px;border:1px solid #ddd;" class="inptSt" disabled >
		<option value="">--Select--</option>
		<?php 
		$sqlF=mysql_query("select * from company_master where classf='creditcard'");
		while($rowF=mysql_fetch_array($sqlF)) {	?>
		<option value="<?php echo $rowF['comp_name']; ?>"><?php echo $rowF['comp_name']; ?></option>
		<?php }	?>
		</select>
		<!--<input name="card_desc" id="card_desc" type="text"  style="width:30px;" value="" class="inptSt"/>--></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="card_tips" id="card_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="card_rem" id="card_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"/></td>
	</tr>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="comprcd_amt" id="comprcd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
	
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;">
		<?php $sqlBS=mysql_query("select distinct comp_code,comp_name from company_master where  classf='company' OR classf='travelagent'");?>
			<select name="comp_desc" id="comp_desc" style="width:90px;border:1px solid #ddd;font-size:12px;" class="fstChUPPRCase inptSt" disabled >
			<option value="">--Select--</option>
			<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
			<option value="<?php echo $rowBS['comp_code'];?>"><?php echo $rowBS['comp_code'];?></option>
			<?php } ?>
			</select>
						
		<!--<input name="comp_desc" id="comp_desc" type="text"  style="width:90px;border:1px solid #ddd;font-size:12px;" value="" class="inptSt" onkeydown="checkSettCompName();"/>
		<div id="suggesstion-box"></div>-->
		</td>
				
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="comp_tips" id="comp_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="comp_rem" id="comp_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"/></td>
	</tr>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="chequercd_amt" id="chequercd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="cheq_desc" id="cheq_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="cheq_tips" id="cheq_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="cheq_rem" id="cheq_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"/></td>
	</tr>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="roomrcd_amt" id="roomrcd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;">
		<select name="room_desc" id="room_desc" style="width:90px;border:1px solid #ddd;" class="inptSt" disabled >
		<option value="">--Select--</option>
		<?php 
		$sqlF=mysql_query("select * from room_master where occupy_status='3'");
		while($rowF=mysql_fetch_array($sqlF)) {	?>
		<option value="<?php echo $rowF['room_number']; ?>"><?php echo $rowF['room_number']; ?></option>
		<?php }	?>
		</select>
		<!--<input name="room_desc" id="room_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/>
		<div id="suggesstion-box"></div>-->
		</td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="room_tips" id="room_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/>
		</td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="room_rem" id="room_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"/></td>
	</tr>
	<?php /* if(isset($rowBh['net_amt']) && $rowBh['net_amt']<0) { */ ?>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="refundrcd_amt" id="refundrcd_amt" type="text" style="width:90px;border:1px solid #ddd;text-align:right;" value="<?php if(isset($refund)){echo $refund;}?>" class="inptSt amtBal" disabled /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="refund_desc" id="refund_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt" disabled /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="refund_tips" id="refund_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt" disabled /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="refund_rem" id="refund_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum" disabled /></td>
	</tr>
	<?php /* } */ ?>
	</table>
</div>


<table style="border-left:1px solid #ddd;margin:0px 0 0 0;" class="table">
<tr>
	<td>	
	<div style= "/*margin:0px 0 0 125px; */ text-align:center;margin:0px 0;">
		<button type="submit" id="confirm" class="butEx bnkSbt frstChr" style="" onclick="return formSubmit();" disabled ><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<button type="button" id="confirm" class="butEx bnkSbt frstChr" style="" disabled ><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">R</span>e-settle</button>
		
		<button type="reset" id="rest" class="butEx bnkSbt frstChr" style=""><img src="../../images/clear.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
		
		<a href="<?php echo $home_path; ?>/transaction/frontdesk/billing-screen.php"><button type="button" id="exit" name="exit" class="butEx" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	</td>
</tr>
</table>
</div>
	</div>
	</div>
	</form>	
</body>
</html>