<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$cr=array_map('trim', explode('/',$rowAC['cur_date']));
$ctt=$cr[2].'-'.$cr[1].'-'.$cr[0];
$curTime=date('H:i:s');
?>	
<style>
.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;font-size:14px;list-style:none;margin:18px 0 0 0px;padding:0;width:210px;position: absolute;z-index: 1;}
#country-list li{padding: 2px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}

.butExmple {
	-moz-box-shadow:inset 0px 1px 0px 0px #cf866c;
	-webkit-box-shadow:inset 0px 1px 0px 0px #cf866c;
	box-shadow:inset 0px 1px 0px 0px #cf866c;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #d0451b), color-stop(1, #bc3315));
	background:-moz-linear-gradient(top, #d0451b 5%, #bc3315 100%);
	background:-webkit-linear-gradient(top, #d0451b 5%, #bc3315 100%);
	background:-o-linear-gradient(top, #d0451b 5%, #bc3315 100%);
	background:-ms-linear-gradient(top, #d0451b 5%, #bc3315 100%);
	background:linear-gradient(to bottom, #d0451b 5%, #bc3315 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#d0451b', endColorstr='#bc3315',GradientType=0);
	background-color:#d0451b;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;
	border:1px solid #942911;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	 font-size: 12px;
    font-weight: bold;
    padding: 4px 25px;
	text-decoration:none;
	text-shadow:0px 1px 0px #854629;
}
.butExmple:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #bc3315), color-stop(1, #d0451b));
	background:-moz-linear-gradient(top, #bc3315 5%, #d0451b 100%);
	background:-webkit-linear-gradient(top, #bc3315 5%, #d0451b 100%);
	background:-o-linear-gradient(top, #bc3315 5%, #d0451b 100%);
	background:-ms-linear-gradient(top, #bc3315 5%, #d0451b 100%);
	background:linear-gradient(to bottom, #bc3315 5%, #d0451b 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#bc3315', endColorstr='#d0451b',GradientType=0);
	background-color:#bc3315;
}
.butExmple:active {
	position:relative;
	top:1px;
}

     

/* .butExmple{
background: #fc8d83 linear-gradient(to bottom, #fc8d83 5%, #e4685d 100%) repeat scroll 0 0;
    border: 1px solid #d83526;
    border-radius: 2px;
    box-shadow: 0 1px 0 0 #f7c5c0 inset;
    color: #ffffff;
    cursor: pointer;
    display: inline-block;
    font-family: Arial;
    font-size: 12px;
    font-weight: bold;
    padding: 4px 25px;
    text-decoration: none;
    text-shadow: 0 1px 0 #b23e35;
	
} */
</style>
<!--form validation-->	
 <script src="<?php echo $home_path;?>/images/bootstrap.min.js"></script>
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<!-- Datepicker start
<script src="<?php echo $home_path;?>/date-picker/jquery-1.10.2.js"></script>-->
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<!-- End -->


<!-- <script src="<?php echo $home_path;?>/images/jquery.min.js"></script>-->
 
 
<!---//-form valid---->

<script type="text/javascript">
$(document).ready(function(){
/* $('input[name^=disc_flag]').on('click', function() {
	qtyVal =($(this).val()); 
	alert('drds'+qtyVal);
}); item_disc*/
$('.tree-toggle').click(function () {
	$(this).parent().children('ul.tree').toggle(200);
	});
$('input[name^=disc_flag]').live("click",function(){
	vl =($(this).val()); 
	/* alert(vl); */
	if(vl=='N'){
		$(this).val('Y');
	}else{
		$(this).val('N');
	}
	
});

$('input[name^=disc_perc]').live("click",function(){
	vl =($(this).val()); 
	/* alert(vl); */
	if(vl=='Perc'){
		$(this).val('Amt');
	}else{
		$(this).val('Perc');
	}
	
});

$('input[name^=disc_amount]').live("click",function(){
	$(this).val(''); 
});	

$('input[name^=disc_amount]').on("keyup",function(){
	rowid=($(this).attr("id")).substr(11);
	$(this).parent().next().find('input').val('');
	vlu =($(this).val()); 
	vl =($(this).parent().prev().find('input').val());
	vlP =($(this).parent().prev().prev().find('input').val());
	lnTot =parseFloat($(this).parent().prev().prev().prev().find('input').val());
		if(vl=='Perc' && vlu>=0){
			
			per=lnTot*vlu/100;
			
			$(this).parent().prev().prev().find('input').val('Y');
			$(this).parent().next().find('input').val(per);
			pvl=$(this).parent().next().find('input').val();
			perc=$(this).parent().next().next().next().find('input').val();
			totvl=parseFloat(perc)-parseFloat(pvl);
			$(this).parent().next().next().next().find('input').val(totvl.toFixed(2));
			
			
			vucNo=$("#voucher_no").val();
			itCd=$(this).parent().prev().prev().prev().prev().prev().prev().prev().find('input').val();
			$.ajax({
			type:'GET',
			url:'  ../../action/selBqtBilltaxCalc.php',
			data:{
			per:per,
			vucNo:vucNo,
			itCd:itCd
			},
			success:function(data){
			 $("#tax_amount"+rowid).val(data);
			 ln=$("#item_total"+rowid).val();
			 ds=$("#disc_val"+rowid).val();
			 tx=$("#tax_amount"+rowid).val();
			
			 
			 tot=parseFloat(ln)-parseFloat(ds)+parseFloat(tx);
			 $("#net_amount"+rowid).val(tot);
			 
			 
			 
				}
			});
			
			
			
			
			
		}else if(vl=='Amt' && vlu>=0){
			per=vlu;
			$(this).parent().prev().prev().find('input').val('Y');
			$(this).parent().next().find('input').val(per);
			pvl=$(this).parent().next().find('input').val();
			perc=$(this).parent().next().next().next().find('input').val();
			totvl=parseFloat(perc)-parseFloat(pvl);
			$(this).parent().next().next().next().find('input').val(totvl.toFixed(2));
			
			
			vucNo=$("#voucher_no").val();
			itCd=$(this).parent().prev().prev().prev().prev().prev().prev().prev().find('input').val();
			$.ajax({
			type:'GET',
			url:'  ../../action/selBqtBilltaxCalc.php',
			data:{
			per:per,
			vucNo:vucNo,
			itCd:itCd
			},
			success:function(data){
			 $("#tax_amount"+rowid).val(data);
			 ln=$("#item_total"+rowid).val();
			 ds=$("#disc_val"+rowid).val();
			 tx=$("#tax_amount"+rowid).val();
			
			 
			 tot=parseFloat(ln)-parseFloat(ds)+parseFloat(tx);
			 $("#net_amount"+rowid).val(tot);
			 
			 
			 
				}
			});
			
			
		}

});


$('input[name^=spitem_amount]').live("click",function(){
	vl =($(this).val()); 
	val=$('.ckPrint:checkbox:checked').val();
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/itmBILLDiscount.php',"_blank",'scrollbars=1,menubar=0,resizable=1,left=500,width=450,height=300');
	/* newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/openItemInsert.php?cnt='+rowid+'&out='+out+'&tx='+tx+'&dis='+dis+'&sub='+sub+'&gnd='+gnd,"_blank",'scrollbars=1,menubar=0,resizable=1,left=500,width=450,height=300'); */
	/* newwindow.focus();  */
	newwindow.focus(); 
});


});

function selBQTBillVCHrDet() {
  vucNo=$("#voucher_no").val(); 
   $.ajax({
		type:'GET',
		url:'  ../../action/selBqtBlVCHRBill.php',
			data:{
			vucNo:vucNo
			},
			success:function(data){
			/* alert(data); */ 
				if(data==1){
					r=confirm("Bill already printed. Do you want to continue?"); 
					if(r==true){
						document.location.href="../../action/cancel_bqt_billing.php?vucNo="+vucNo;
					}
				}else{ 
					document.location.href="bqt_billing.php?vucNo="+vucNo;				
					/* $("#hotelDefi").attr("action","<?php echo $home_path; ?>/action/add_bqt_billing.php");
					$("#hotelDefi").submit(); */
				}			  
			}
	});
	
	/* vucNo=$('#voucher_no').val();
	document.location.href="bqt_billing.php?vucNo="+vucNo; */
}

/* function selBQTBillVCHrDet() {
	vucNo=$('#voucher_no').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selBQTBillVCHrDetails.php',
			data:{
			vucNo:vucNo
			},
			success:function(data){
				opt=data.split(',');
				if(data==1){
					r=confirm("Bill already generated. Do you want to continue?");
					if(r==true){
						document.location.href="../../action/cancel_bqt_billing.php?vucNo="+vucNo;
					}else{
						
					}
				}else{
				$('#fp_no').val(opt[0]);
				$('#booking_no').val(opt[1]);
				$('#bill_inst').val(opt[2]);
				$('#guest_name').val(opt[3]);
				$('#venue').val(opt[4]);
				$('#book_date').val(opt[5]);
				$('#session').val(opt[6]);
				$('#total_pax').val(opt[7]);
				$('#dispItmHde').hide();
				$('#dispItmShw').show();
				$('#dispItmShw').html(opt[8]);
				$('#disADvHDE').hide();
				$('#disADvSHW').show();
				$('#disADvSHW').html(opt[9]);
				$('#discHde').hide();
				$('#discShw').show();
				$('#discShw').html(opt[10]);
				}
				
			}
	});	
} */

function selDisBill(c){
	vl=$('#disc_flag'+c).val();
	/* alert(vl); */
	if(vl=='N'){
		$('#disc_flag'+c).val('Y');
	}else{
		$('#disc_flag'+c).val('N');
	}
	
	
}

/* function selDisPerc(vl){
	alert(vl);
	val=$('#item_disc'+vl).val();
	alert(val);
		var txtFood = document.getElementById("item_disc"+vl).value; 
		alert(txtFood);
	
	
} */


function chkOutBillPrint(){
	 $("#billsbt").removeAttr('disabled',true); 
	 $("#hotelDefi").attr("action","<?php  echo $home_path; ?>/action/add_checkout_savesplit.php");
	 $("#hotelDefi").submit(); 
}



function popupBillPrint()
{
  sptNo=$("#hid_menu").val(); 
  vucNo=$("#voucher_no").val(); 
   $.ajax({
		type:'GET',
		url:'  ../../action/selROUNDFOFF.php',
			data:{
			sptNo:sptNo,
			vucNo:vucNo
			},
			success:function(data){
				/* alert(data); */
				if(sptNo==""){
					alert("check the split!.");
					$("#billsbt").attr('disabled','disabled');
				}else{  	
					$("#hotelDefi").attr("action","<?php echo $home_path; ?>/action/add_bqt_billing.php");
					$("#hotelDefi").submit();
				}			  
			}
	});
}

function printFolio() {
	sptNo=$("#hid_menu").val(); 
	vucNo=$("#voucher_no").val(); 
	document.location.href="<?php echo $home_path; ?>/transaction/view/folio-print-bqt-billing.php?vucNo="+vucNo+"&sptNo="+sptNo;
}



function setMenu() {
	var menuStr="";
	vucN=$("#voucher_no").val();
	$('.chk').each(function(i,v){
		if($(this).is(':checked'))
		{
		menuStr +=$(this).val()+',';
		}
	});
	menuStr = menuStr.slice(0,-1);
	$("#hid_menu").val(menuStr);
	$("#billsbt").removeAttr('disabled',true);	
	hd=$("#hid_menu").val();
	var cT = hd.split(',').length;
	$("#countT").val(cT);
	$("#countTt").val(cT);
		
}

function extBUtton(){
	document.location.href="<?php echo $home_path; ?>/dashboard.php";
}

function printClear(){
	
	/* document.location.href="bqt_billing.php?vucNo="; */
}


function sbtBtnN(){
	bl=$("#bl_name").val();
	bl1=$("#bl_addr").val();
	bl2=$("#bl_addr1").val();
	blcy=$("#bl_city").val();
	blpn=$("#bl_pin").val();
	
	$("#guestt_name").val(bl);
	$("#add1").val(bl1);
	$("#add2").val(bl2);
	$("#cty").val(blcy);
	$("#pncd").val(blpn);
}

function selBadFeed(){
	/* alert(a); */
	snt=$("#countTt").val();
	bkN=$("#booking_no").val();
	fpno=$("#fp_no").val();
	$.ajax({
	type:'GET',
	url:'  ../../action/selpopupADdRpt.php',
		data:{
		snt:snt,
		bkN:bkN,
	    fpno:fpno
		},
		success:function(data){
			/* alert(data); */
			$('#feedBk').html(data);
		}
	});	 
}


</script> 
<style>
.spanClr{
	color: #5b503b;
    display: block;
    float: left;
    font-size: 12px;
    font-weight: normal;
    padding: 0px 9px 0 5px;
		
}
hr.style-one {
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
	margin:-3px 0 0 0;
}
hr.style-one1 {
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
	margin:-7px 0 0 0;
}


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

::-webkit-scrollbar
{
  width: 6px;  /* for vertical scrollbars */
  height: 12px; /* for horizontal scrollbars */
}

::-webkit-scrollbar-track
{
  background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-thumb
{
  background: rgba(0, 0, 0, 0.5);
}
</style>

 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<body class="bgBODY">
<div class="about" style="margin:0px 0 0 0;">
<?php 	
/* echo $_GET['msg']; */ 
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;margin:-16px 0 0 0;">
		<label id="msgFo" class="" style="color:#7B0E0E;"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<div id="invoice" style="">
	<!--<div class="container" >-->
		<div class="" >


<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];
?>
<link rel="stylesheet" type="text/css" href="<?php echo $home_path;?>/tcal-picker/tcal.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/tcal-picker/tcal.js"></script> 
<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:801px;">
<!--<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:1112px;overflow:auto;height:500px;">-->
	<h3 id="Userhd"><b>Banquet Billing </b></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="#" method="post" class="" style="">
	<input name="incLc" id="incLc" type="hidden" style="" value=""/>
	<input type="hidden" name="rowVl" id="rowVl"/>
	<input type="hidden" name="rmomType" id="rmomType"/>
	<input type="hidden" name="hid_menu" id="hid_menu"/>
	<input type="hidden" name="countTt" id="countTt"/>
	
	<input type="hidden" name="adtDate" id="adtDate" value="<?php echo $curDate?>"/>
	<div>
	

	
<!-- Start popup -->
<?php
if(isset($_GET['vucNo']) && $_GET['vucNo']!='' ){
?>
<!-- Start popup -->
<div id="myModal" class="modal fade" role="dialog" style="padding:20px 0 0 0;width:1000px;margin:0 auto;">
  <div class="modal-dialog" style="width:900px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">

	  
<table style="float:left;margin:8px 0 0 5px;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
<td colspan="8"><h3 id="rmTyp" style="background-color:#7b0e0e;color:#fff;"><b>Guest Address Details</b></h3></td>
</tr>
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">Title</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:150px;">Name</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:150px;">Address1</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:150px;">Address2</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">City</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">Pincode</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:140px;">GST NO</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">Split</th>
</tr>
</thead>
<tbody class="tathead tatbody tableS" id="feedBk" style="overflow:auto;height:200px;">

</tbody>
</table>
      </div>
      <div class="modal-footer" style="width:900px;">
        <button type="button" onclick="btnFcs();" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- End popup -->



<!--<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog" style="padding:130px 0 0 0;width:630px;margin:0 auto;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="" data-dismiss="modal">&times;</button>
       </div>
      <div class="">
	  
<table style="float:left;margin:8px 0 0 5px;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
<td colspan="6"><h3 id="rmTyp" style="background-color:#7b0e0e;color:#fff;"><b>Guest Address Details</b></h3></td>
</tr>
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:150px;">Name</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:150px;">Address1</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:150px;">Address2</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">City</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">Pincode</th>
</tr>
</thead>
<input type="text" name="countT" id="countT"/>
<tbody class="tathead tatbody tableS" id="countTTat" style="overflow:auto;height:200px;">
<script type="text/javascript"> 
cnt=$("#countT").val();
cntt=$("#countTt").val();
 
cntT=document.getElementById("countT").value; 

 for (i = 0; i<parseFloat(cntt); i++) {  
document.write('<tr id=""><td style="text-align:center;" class="sourceonVAL"><input name="bl_name" id="bl_name" type="text" class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="" /></td><td style="text-align:center;" class="sourceonVAL"><input name="bl_addr" id="bl_addr" type="text" class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="" /></td><td style="text-align:center;" class="sourceonVAL"><input name="bl_addr1" id="bl_addr1" type="text" class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="" /></td><td style="text-align:center;" class="sourceonVAL"><input name="bl_city" id="bl_city" type="text" class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" /></td><td style="text-align:center;" class="sourceonVAL"><input name="bl_pin" id="bl_pin" type="text" class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" /></td></tr>');
} 
</script>
</tbody>
</table>

<table style="float:left;width:81%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >	
<tr>
<td style="width:150px;border:none;">&nbsp;</td>
<td style="width:150px;border:none;"><button type="button" class="btnH" data-dismiss="modal" onclick="sbtBtnN();">Submit</button></td>
</tr>
</table> 
 
      </div>
      <div class="modal-footer" style="">
        &nbsp;
      </div>
    </div>

  </div>
</div>-->

<?php } ?>

<!-- End popup -->

<?php
$sqlm=mysql_query("select * from bq_opvchrhdr where vouchrno='".$_GET['vucNo']."'");
$row=mysql_fetch_array($sqlm);

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$row['bkno']."' and fpno='".$row['fpno']."'");
$rowb=mysql_fetch_array($sqlb);

$sqbV=mysql_query("select * from bq_opvchrdtl where vouchrno='".$_GET['vucNo']."'");
$robV=mysql_fetch_array($sqbV);

$sqb=mysql_query("select * from bq_billinstruc where bill_code='".$rowb['top_code']."'");
$rob=mysql_fetch_array($sqb);

$sqS=mysql_query("select sess_name from bqt_session where sess_code='".$rowb['session']."'");
$roS=mysql_fetch_array($sqS);

$sqlv=mysql_query("select * from bq_venue where venue_code='".$rowb['venue']."' AND status ='1'");
$rov=mysql_fetch_array($sqlv);
?>				

<table style="float:left;width:40%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<tr>
	<td width="" valign="top"><label>Voucher #</label></td>
	<td valign="top">
	<select name="voucher_no" id="voucher_no" style="font-size:12px;width:160px;" onChange="selBQTBillVCHrDet();" class="wagRw1 textbox">
			<option value="">--Select--</option>
			<?php
			
			$sqle=mysql_query("select distinct vouchrno from bq_opvchrhdr where str_to_date(vouchrdate,'%d/%m/%Y')='$ctt' AND bill_status='1'");
			while($res=mysql_fetch_array($sqle)){
				if($res['vouchrno']==$_GET['vucNo']){
			?>
			<option value="<?php echo $res['vouchrno']  ?>" selected ><?php echo strtoupper($res['vouchrno']); ?></option>
				<?php }else{?>
			<option value="<?php echo $res['vouchrno']  ?>" ><?php echo strtoupper($res['vouchrno']); ?></option>
			<?php } } ?>
	</select>
	</td>
</tr>
<tr>
<td width="" valign="top"><label>FP # <em>*</em></label></td>
<td valign="top"><input name="fp_no" id="fp_no" type="text" class="textbox fstChUPPRCase" style="width:160px" value="<?php if(isset($row['fpno'])) {echo $row['fpno'];}else{echo "";}?>" readonly /></td>
</tr>
<tr>
	<td width="" valign="top"><label>Booking #</label></td>
	<td valign="top"><input name="booking_no" id="booking_no" type="text" class="textbox fstChUPPRCase" style="width:160px" value="<?php if(isset($row['bkno'])) {echo $row['bkno'];}else{echo "";}?>" readonly /></td>
	</tr>
	<tr>
	<td width="" valign="top"><label>Billing Instr</label></td>
	<td valign="top"><input name="bill_inst" id="bill_inst" type="text" class="textbox fstChUPPRCase" style="width:160px" value="<?php if(isset($rob['bill_desc'])) {echo $rob['bill_desc'];}else{echo "";}?>" readonly /></td>
	</tr>
	<tr>
	<td width="" valign="top"><label>No of Splits</label></td>
	<td valign="top"><input name="no_split" id="no_split" type="text" class="textbox fstChUPPRCase" style="width:160px" readonly /></td>
	</tr>
</table>



<table style="float:left;width:40%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<tr>
		<td width="" valign="top"><label>Guest Name </label></td>
		<td valign="top"><input name="guest_name" id="guest_name" type="text" class="textbox fstChUPPRCase guest_name" style="width:160px" value="<?php if(isset($rowb['guest_name'])) {echo $rowb['guest_name'];}else{echo "";}?>" readonly /></td>
		
<input name="guestt_name" id="guestt_name" type="hidden" class="textbox fstChUPPRCase guest_name" style="width:160px" value="" readonly />
<input name="add1" id="add1" type="hidden" class="textbox fstChUPPRCase" style="" value="" readonly />
<input name="add2" id="add2" type="hidden" class="textbox fstChUPPRCase" style="" value="" readonly />
<input name="cty" id="cty" type="hidden" class="textbox fstChUPPRCase" style="" value="" readonly />
<input name="pncd" id="pncd" type="hidden" class="textbox fstChUPPRCase" style="" value="" readonly />
		
</tr>
<tr>
<td width="" valign="top"><label>Venue <em>*</em></label></td>
<td valign="top"><input name="venue" id="venue" type="text" class="textbox fstChUPPRCase" style="width:160px" value="<?php if(isset($rowb['venue'])) {echo $rov['venue_desc'];}else{echo "";}?>" readonly /></td>
</tr>
<tr>
		<td width="" valign="top"><label>Date</label></td>
		<td valign="top"><input name="book_date" id="book_date" type="text" class="textbox fstChUPPRCase" style="width:160px" value="<?php if(isset($rowb['book_date'])) {echo $rowb['book_date'];}else{echo "";}?>" readonly /></td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Session</label></td>
		<td valign="top"><input name="session" id="session" type="text" class="textbox fstChUPPRCase" style="width:160px" value="<?php if(isset($rowb['session'])) {echo $roS['sess_name'];}else{echo "";}?>" readonly /></td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Total Pax</label></td>
		<td valign="top"><input name="total_pax" id="total_pax" type="text" class="textbox fstChUPPRCase" style="width:160px;" value="<?php if(isset($rowb['guaranted'])) {echo $rowb['guaranted'];}else{echo "";}?>" readonly /></td>
		</tr>
</table>



<table style="float:right;width:20%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
	<th colspan="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:105px;">Voucher </th>
	<th colspan="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">Link</th>
</tr>
</thead>
<tbody class="tathead tatbody tableS" id="" style="overflow:auto;height:128px;">
<?php 
for($cc=1;$cc<=5;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_group[]" id="item_group<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:105px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_split[]" id="item_split<?php echo $cc;?>" type="checkbox"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px;" value="" /></td>
	
</tr>	
<?php } ?>
</tbody>
</table>



<!--<div class="" style="margin-top:0px;width:30%;float:right;">
	
<table style="float:left;width:99%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">Item Group</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:100px;">Discount</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:70px;">Amount</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:70px;">Split</th>
</tr>
</thead>
	<tbody class="tathead tatbody tableS" id="discHde" style="overflow:auto;height:110px;">
	<?php 
for($cc=1;$cc<5;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_group[]" id="item_group<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_disc[]" id="item_disc<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_amount[]" id="item_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px" value=""  /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_split[]" id="item_split<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px" value="" /></td>
</tr>	
<?php } ?>
</tbody>

<tbody class="tathead tatbody tableS" id="discShw" style="overflow:auto;height:110px;display:none;">
</tbody>

</table>


</div>-->



<table style="float:left;width:100%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:35px;">S.No.</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:120px;">Item Name</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">Qty</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">Rate</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">Total</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">D.Flag</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">Disc</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">D.Amt</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">D.Val</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:70px;">Tax</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">Net Amount</th>
	<th style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">Split</th>
</tr>
</thead>
<tbody class="tathead tatbody tableS" id="dispItmHde" style="overflow:auto;height:180px;">
<?php 
	$Tnetamt=0;
$sqD=mysql_query("select * from bq_opvchrdtl where vouchrno='".$_GET['vucNo']."'");
$x=0;
$nmRs=mysql_num_rows($sqD);
while($roD=mysql_fetch_array($sqD)){
	$x++;
$lnitmTot=$roD['item_qty']*$roD['item_rate'];
$itmTot=$roD['item_qty']*$roD['item_rate']-$roD['discamt'];
	
$sqI=mysql_query("select * from bq_itemmaster where item_name='".$roD['item_name']."'");
$roI=mysql_fetch_array($sqI);

if($roI['allow_disc']=='yes'){
	$allow_disc='Y';
}else {
	$allow_disc='N';
}
/* echo "select SUM(taxamt)AS txAmt from bq_opvchrtaxdtl where item_code='".$roD['item_code']."'"; */
$sqT=mysql_query("select SUM(taxamt)AS txAmt,taxcode from bq_opvchrtaxdtl where item_name='".$roD['item_name']."' AND vouchrno='".$_GET['vucNo']."'");
$roT=mysql_fetch_array($sqT);
$netAmt=$itmTot+$roT['txAmt'];	
$Tnetamt+=$netAmt;

?>
<tr id="">
<td style="text-align:center;" class="sourceonVAL">

<input name="opvchrdtl_id[]" id="opvchrdtl_id<?php echo $cc;?>" type="hidden"  class="textbox fstChUPPRCase expet" style="width:35px;margin:5px 0 0 0px" value="<?php echo $roD['opvchrdtl_id']; ?>" readonly />

<input name="s_no[]" id="s_no<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:35px;margin:5px 0 0 0px" value="<?php echo $x; ?>" readonly />
<input name="taxcde[]" id="taxcde<?php echo $cc;?>" type="hidden"  class="textbox fstChUPPRCase expet" style="width:35px;margin:5px 0 0 0px" value="<?php echo $roD['taxstruccode']; ?>" readonly />
</td>
<td style="text-align:center;" class="sourceonVAL" hidden ><input name="item_code[]" id="item_code<?php echo $x;?>" type="hidden"  class="textbox fstChUPPRCase expet" style="" value="<?php if(isset($roD['item_code'])) {echo $roD['item_code'];}else{echo "";}?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL" hidden ><input name="sac[]" id="sac<?php echo $x;?>" type="hidden"  class="textbox fstChUPPRCase expet" style="" value="<?php if(isset($roD['sac'])) {echo $roD['sac'];}else{echo "";}?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name<?php echo $x;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px" value="<?php if(isset($roD['item_name'])) {echo $roD['item_name'];}else{echo "";}?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty<?php echo $x;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="<?php if(isset($roD['item_qty'])) {echo $roD['item_qty'];}else{echo "";}?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate<?php echo $x;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="<?php if(isset($roD['item_rate'])) {echo $roD['item_rate'];}else{echo "";}?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_total[]" id="item_total<?php echo $x;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="<?php if(isset($lnitmTot)) {echo $lnitmTot;}else{echo "0.00";}?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL">

<?php /* if($roD['item_code']=='Hall' || $roD['item_code']=='Rate') { */ ?>
<!--<input name="disc_flag[]" id="disc_flag<?php /* echo $x; */?>" class="textbox fstChUPPRCase disF" style="width:50px;margin:5px 0 0 0px;text-align:center;" value="<?php /* if(isset($allow_disc)) {echo $allow_disc;}else{echo "";} */?>"   />-->
<?php /* }else{  */?>

<?php if($roD['discamt']>0) { ?>
<input name="disc_flag[]" id="disc_flag<?php echo $x;?>" class="textbox fstChUPPRCase disF" style="width:50px;margin:5px 0 0 0px;text-align:center;" value="Y" />
<?php } else { ?>
<input name="disc_flag[]" id="disc_flag<?php echo $x;?>" class="textbox fstChUPPRCase disF" style="width:50px;margin:5px 0 0 0px;text-align:center;" value="<?php if(isset($allow_disc)) {echo $allow_disc;}else{echo "0.00";} ?>"   />
<?php } ?>
</td>
<td style="text-align:center;" class="sourceonVAL">
<!--<input name="disc_perc[]" id="disc_perc<?php echo $x;?>" class="textbox fstChUPPRCase disF" style="width:50px;margin:5px 0 0 0px;text-align:center;" value="<?php /* if(isset($roD['disccode'])) {echo ($roD['disccode']);}else{echo "0.00";} */?>" />-->
<input name="disc_perc[]" id="disc_perc<?php echo $x;?>" class="textbox fstChUPPRCase disF" style="width:50px;margin:5px 0 0 0px;text-align:center;" value="Amt" />
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="disc_amount[]" id="disc_amount<?php echo $x;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px;text-align:right;" value="<?php if(isset($roD['discperamt'])) {echo sprintf("%01.2f",$roD['discperamt']);}else{echo "0.00";}?>"  /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="disc_val[]" id="disc_val<?php echo $x;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px;text-align:right;" value="<?php if(isset($roD['discamt'])) {echo sprintf("%01.2f",$roD['discamt']);}else{echo "0.00";}?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL">

<input name="tax_code[]" id="tax_code<?php echo $x;?>" type="hidden"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px;text-align:right;" value="<?php if(isset($roT['taxcode'])) {echo $roT['taxcode'];}else{echo "";}?>" readonly />
<input name="str_code[]" id="str_code<?php echo $x;?>" type="hidden"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px;text-align:right;" value="<?php if(isset($roD['taxstruccode'])) {echo $roD['taxstruccode'];}else{echo "";}?>" readonly />

<input name="tax_amount[]" id="tax_amount<?php echo $x;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px;text-align:right;" value="<?php if(isset($roT['txAmt'])) {echo sprintf("%01.2f",$roT['txAmt']);}else{echo "";}?>" readonly />
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="net_amount[]" id="net_amount<?php echo $x;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="<?php if(isset($netAmt)) {echo sprintf("%01.2f",$netAmt);}else{echo "";}?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="split[]" id="split<?php echo $x;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px;text-align:center;" value="<?php if(isset($roD['split'])) {echo $roD['split'];}else{echo "";}?>" /></td>
</tr>
<?php } ?>

<?php 
for($cc=$nmRs+1;$cc<15;$cc++){
?>
<tr id="">
<td style="text-align:center;" class="sourceonVAL">
<input name="s_no[]" id="s_no<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:35px;margin:5px 0 0 0px" value="<?php echo $cc;?>" readonly />
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="itemnamem[]" id="itemm_name<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="itemm_qty[]" id="itemm_qty<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="itemm_rate[]" id="itemm_rate<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="itemm_total[]" id="itemm_total<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="discm_flag[]" id="discm_flag<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="discm_flag[]" id="discm_flag<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="discm_amount[]" id="discm_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="discm_amount[]" id="discm_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="taxm_amount[]" id="taxm_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="netm_amount[]" id="netm_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="splitm[]" id="splitm<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" /></td>
</tr>	
<?php 
}
?>	
 </tbody>
 
<tbody class="tathead tatbody tableS" id="dispItmShw" style="overflow:auto;height:180px;display:none;">
</tbody>
</table>



<style>
.butExample {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #fff;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 82px;
	/* width:250px; */
	float:left;
}

.buttExaS {
    background-color: #ffffff;
    border: 1px solid #888888;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
   /*  margin-left: -3px; */
    padding: 5px 0px;
    /* padding: 5px 59px; */
	width:125px;
}
</style>


<table style="float:left;width:44%;border-right:1px solid #ddd;margin:8px 0px 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:120px;">Receipt</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:120px;">Date</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:120px;">Amount</th>
</tr>
</thead>
<tbody class="tathead tatbody tableS" id="disADvHDE" style="overflow:auto;height:100px;">
<?php
$adv="";

$ssC=mysql_fetch_array(mysql_query("select hallbook_id from bq_opfpmenuhdr where fpno='".$row['fpno']."' AND bill_status!='3'"));

$sqsC=mysql_query("select * from bq_hallresvadv where booking_no='".$row['bkno']."'  AND status='1' AND hallbook_id='".$ssC['hallbook_id']."'");
$nmrA=mysql_num_rows($sqsC);
while($rwsC=mysql_fetch_array($sqsC)){
?>
<tr id="">
<td style="text-align:center;" class="sourceonVAL"><input name="receipt[]" id="receipt<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px;text-align:center;" value="<?php echo $rwsC['receipt_no']; ?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="receipt_date[]" id="receipt_date<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px;text-align:right;" value="<?php echo $rwsC['cur_date']?>" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="receipt_amount[]" id="receipt_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px;text-align:right;" value="<?php echo $rwsC['amount']+$rwsC['sgst']+$rwsC['cgst']?>" readonly /></td>
</tr>
<?php } ?>	
	
<?php 
for($cc=$nmrA;$cc<4;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="receiptm[]" id="receipt<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="receiptm_date[]" id="receipt_date<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="receiptm_amount[]" id="receipt_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px" value="" /></td>
</tr>	
<?php } ?>
</tbody>

<tbody class="tathead tatbody tableS" id="disADvSHW" style="overflow:auto;height:100px;display:none;">
</tbody>

</table>
				
				
<table style="float:left;width:38%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:120px;">Bill</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:120px;">Amount</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">Y/N</th>
</tr>
</thead>
<tbody class="tathead tatbody tableS" id="" style="overflow:auto;height:100px;">
<?php 
$sqD=mysql_query("select sum(net_amount)AS totV,sum(tax_amt)AS totA,split from bq_opvchrdtl where vouchrno='".$_GET['vucNo']."' AND bill_status='1' group by split");
$x=0;$totV=0;
$nmD=mysql_num_rows($sqD);
while($rw=mysql_fetch_array($sqD)){
	$totV=$rw['totV']+$rw['totA'];
/* $sqTx=mysql_query("select sum(taxamt)AS Txt,split from bq_opvchrtaxdtl where vouchrno='".$_GET['vucNo']."' AND bill_status='1' group by split");
$rwTx=mysql_fetch_array($sqTx);
	$totV=$rw['totV']+$rwTx['Txt']; */
	/* $totV+=$rw['item_qty']*$rw['item_rate']; */
	
	/* SUM(item_qty)*SUM(item_rate)AS totV */
	
	$x++;
?>	
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="billm_no[]" id="bill_no<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px;text-align:center;" value="<?php echo $x; ?>" readonly /></td>
	<td style="text-align:right;" class="sourceonVAL"><input name="bill_amount[]" id="bill_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px;text-align:right;" value="<?php echo sprintf("%01.2f",$Tnetamt);?>" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="bill_sel[]" id="bill_sel<?php echo $cc;?>" type="checkbox"  class="textbox fstChUPPRCase expet chk" onclick="setMenu();" style="width:50px;margin:5px 0 0 0px" value="<?php echo $rw['split']; ?>" readonly /></td>
</tr>
<?php } ?>
<?php 
for($cc=$nmD;$cc<4;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="billm_no[]" id="bill_no<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="billm_amount[]" id="bill_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="billm_sel[]" id="bill_sel<?php echo $cc;?>" type="checkbox"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" readonly /></td>
</tr>	
<?php } ?>
</tbody>
</table>


	
</div>
	


<!--<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 0px;">
		<button type="submit" id="send" name="send" class="butExample bnkSbt frstChr" style="" onclick="return checkformSubmit();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-room-booking.php"><button type="button" id="update" class="butExample bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
		
		<a href="#" target="_blank"><button type="button" id="hallsts" class="butExample" style="" onclick="hall_sts()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">U</span>pdate</button></a>
		
			<button type="reset" id="rest" class="butExample" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
		<a href="<?php/*  echo $home_path; */ ?>/dashboard.php"><button type="button" id="exit" name="exit" class="butExample" style="" onClick="self.close();" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
	</div>
	</td>
	</tr>
</table>-->
	</form>	
	
	
<table style="float:right;margin:5px 0 0 0;">

<tr>
<td>
<button type="button" id="submit" class="buttExaS bnkSbt frstChr submit" style="font-weight:bold;" onclick="chkOutBillPrint();" ><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ave </button>
</td>
</tr>

<tr>
<td>
<button type="button" id="billsbt" name="billsbt" class="buttExaS" style="font-weight:bold;" onClick="popupBillPrint();" ><img src="../../images/imprimer.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">B</span>ill</button>
</td>
</tr>

<tr>
<td>
<a href="#"><button type="button" id="printFlio" class="buttExaS" style="font-weight:bold;" data-toggle="modal" data-target="#myModal" onclick="selBadFeed();"  ><img src="../../images/prtfoli.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">V</span>iew Bill</button></a>
</td>
</tr>

<tr>
<td>
<button type="button" id="exit" name="exit" class="buttExaS" style="font-weight:bold;" onClick="extBUtton();" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button>
</td>
</tr>

</table>

</div>
	</div>
	</div>

	<?php /* include("../../footer.php"); */ ?>
</body>
</html>