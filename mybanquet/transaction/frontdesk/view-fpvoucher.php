<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');

/* echo getNextReservNumber(); */
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
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<!--<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>-->
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<!-- Datepicker start
<script src="<?php echo $home_path;?>/date-picker/jquery-1.10.2.js"></script>-->
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">

   
  <!--<script src="<?php echo $home_path;?>/js/bootstrap.min.js"></script>-->
  
  
<!-- End -->
<!---//-form valid---->

 <script>
	var item_codes;
	var arr=new Array();
	<?php $result = mysql_query("select * from bq_hallbooking where confirm_status='2'") ;?>
	<?php $str=""; $i=0; 
		$k=0;
		$tmpStr="";
	while($row = mysql_fetch_array( $result )) {
	?>
	  arr[<?php echo $i;?>]=new Array();
	  arr[<?php echo $i;?>][0]='<?php echo $row['booking_no']; ?>';
	  arr[<?php echo $i;?>][1]='<?php echo $row['guest_name']; ?>';
	  arr[<?php echo $i;?>][2]='<?php echo $row['venue']; ?>';
	  arr[<?php echo $i;?>][3]='<?php echo $row['session']; ?>';
	  arr[<?php echo $i;?>][4]='<?php echo $row['guaranted']; ?>';
	
	   <?php if($i==0) { 
		$str="'".$row['booking_no']."'";
	   }else{	
		$str=$str.",'". $row['booking_no']."'";
		}?>	 
	  
	  	  
	 <?php $i++; } ?>	
	
	item_codes=<?php echo ("[" . $str. "]") ?>;
	/* alert(item_codes); */
	
 </script>

<script type="text/javascript" src="<?php echo $home_path;?>/js/itemfp.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/js/utilfp.js"></script>
	
	
<script type="text/javascript">
$(document).ready(function(){
	$("#msgFo").fadeOut(5000);
	$('.tree-toggle').click(function () {
	$(this).parent().children('ul.tree').toggle(200);
	});
/* 	$( "#departure_date" ).datepicker({ minDate: 0}); */
		 $(".datepicker" ).datepicker({
	    changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
	  minDate: 0,
     dateFormat:"dd/mm/yy"
  });
  
   $(".datepicker1" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
	  minDate: 0,
     dateFormat:"dd/mm/yy"
  });
  

$(".arrDt").keyup(function(){
	
	if ($(this).val().length == 2){
		$(this).val($(this).val() + "/");
	}else if ($(this).val().length == 5){
		$(this).val($(this).val() + "/");
	}
	
});





$('input[name^=amen_itemqty]').keyup(function(){
		qtyVal =parseFloat($(this).val()); 
		unitval =parseFloat($(this).parent().next().find('input').val());
		totAMt=parseFloat(qtyVal*unitval);
		itmDs=($(this).parent().prev().find('input').val());
		Amt =parseFloat($(this).parent().next().next().find('input').val(totAMt));
		ttAmt=parseFloat($(this).parent().next().next().find('input').val());
		 if(isNaN(ttAmt)){ ttAmt=parseFloat($(this).parent().next().next().find('input').val(0));}
		/* lnTT=$(".lineTot").val();
		 if(lnTT=='NaN'){$(".lineTot").val('0');}
		totTot =0; */
		
});

	
	
$(".depaDate").keyup(function(){
	if ($(this).val().length == 2){
		$(this).val($(this).val() + "/");
	}else if ($(this).val().length == 5){
		$(this).val($(this).val() + "/");
	}
});
			
	$("#msgFo").fadeOut(5000);
/* 	$("#msgFoprop").fadeOut(7000);  */
	jQuery("#hotelDefi").validationEngine();
	
var dt = new Date();
/* var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds(); */
var time = dt.getHours() + ":" + dt.getMinutes() ;
var Dptime = '12:00' ;
$('#departure_time').val(Dptime);
/* $('#departure_time').val(time); */
 
 $('#arrival_time').val(time);
 
$('input[name^=book_date]').live('keyup', function() {
	if ($(this).val().length == 2){
		$(this).val($(this).val() + "/");
	}else if ($(this).val().length == 5){
		$(this).val($(this).val() + "/");
	}
	
});
$('input[name^=departure_date]').live('keyup', function() {
	if ($(this).val().length == 2){
		$(this).val($(this).val() + "/");
	}else if ($(this).val().length == 5){
		$(this).val($(this).val() + "/");
	}
	
});

	


$(".halltaxincl").on("click", function(){
	hdet=$('#halltax_det').val();
	hchg=$('#halltax_chg').val();
	yes='yes';
	no='no';
 if(halltaxincl.checked) {
	
	$.ajax({
	type:'GET',
	url:'  ../../action/selHAllTax.php',
		data:{
		hdet:hdet,
		hchg:hchg,
		yes:yes
		},
		success:function(data){
			 /* alert(data); */
			$('#halltax_chg').val(data);
		}
	});	 
}else{
	$.ajax({
	type:'GET',
	url:'  ../../action/selHAllTax.php',
		data:{
		hdet:hdet,
		hchg:hchg,
		no:no
		},
		success:function(data){
			 /* alert(data); */
			$('#halltax_chg').val(data);
		}
	});	 
}
});


	

$(".ratetaxincl").on("click", function(){
	hdet=$('#ratetax_det').val();
	hchg=$('#ratetax_chg').val();
	yes='yes';
	no='no';
if(ratetaxincl.checked) {
	$.ajax({
	type:'GET',
	url:'  ../../action/selRATETax.php',
		data:{
		hdet:hdet,
		hchg:hchg,
		yes:yes
		},
		success:function(data){
			 /* alert(data); */
			$('#ratetax_chg').val(data);
		}
	});	 
}else{
	$.ajax({
	type:'GET',
	url:'  ../../action/selRATETax.php',
		data:{
		hdet:hdet,
		hchg:hchg,
		no:no
		},
		success:function(data){
			 /* alert(data); */
			$('#ratetax_chg').val(data);
		}
	});	 
}
});





});

 shortcut.add("Ctrl+S",function() { 
	 $('#hotelDefi').attr('action', '<?php echo $home_path;?>/action/add_voucher_detail.php');  
	 $('#hotelDefi').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view-fpvoucher-details.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#hotelDefi').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "view-fpvoucher-details.php";
});

function selVoucherDet(){
fp_no=$('#fp_no').val();
if(fp_no!=""){
	$.ajax({
		type:'GET',
		url:'  ../../action/selectVoucherDet.php',
			data:{
			fp_no:fp_no
			},
			success:function(data){
				    /* alert(data);  */ 
				 opt=data.split('&#');
				 $('#displyRo').hide();
				 $('#dispADVHde').hide();
				 $('#displyRoomDETT').show();
				 $('#dispADVShw').show();
				 $('#booking_no').val(opt[0]);
				 $('#vouc_date').val(opt[1]);
				 $('#guest_name').val(opt[2]);
				 $('#session').val(opt[3]);
				 $('#venue').val(opt[4]);
				 $('#bill_instr').val(opt[5]);
				 $('#con_person').val(opt[6]);
				 $('#mobile').val(opt[7]);
				 $('#total_pax').val(opt[8]);
				 $('#displyRoomDETT').html(opt[9]);
				 $('#dispADVShw').html(opt[10]);
				 $('#total_val').val(opt[11]);
				 $('#scst').val(opt[12]);
				 $('#ccst').val(opt[13]);
				 $('#net_amt').val(opt[14]);
				 $('#remarks').val(opt[15]);
			}
	});
}else{
	alert("Please select FP No!.");
	 $('#displyRo').show();
	 $('#dispADVHde').show();
	 $('#displyRoomDETT').html('');
	 $('#displyRoomDETT').hide();
	 $('#dispADVShw').hide();
	 $('#dispADVShw').html('');
	 $('#booking_no').val('');
	 $('#vouc_date').val('');
	 $('#guest_name').val('');
	 $('#session').val('');
	 $('#venue').val('');
	 $('#bill_instr').val('');
	 $('#con_person').val('');
	 $('#mobile').val('');
	 $('#total_pax').val('');
	 $('#displyRoomDETT').val('');
	 $('#dispADVShw').val('');
	 $('#total_val').val('');
	 $('#scst').val('');
	 $('#ccst').val('');
     $('#net_amt').val('');
}
	
}


function itmOthName(c){
	amitmCde=$('#amen_itemcode'+c).val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selITMAMEnName.php',
			data:{
			amitmCde:amitmCde
			},
			success:function(data){
				/*  alert(data); */
				opt=data.split(',');				
				 $('#amen_itemname'+c).val(opt[0]);
				 $('#amen_itemrate'+c).val(opt[1]);
			}
	});	
}


function btnFcs(){
 vl=$('#pax_num').val();
 $('#total_pax').val(vl);
 
 fp_no=$('#fp_no').val();

		$.ajax({
			type:'GET',
			url:'  ../../action/selectVoucherDetPAXCHange.php',
				data:{
				fp_no:fp_no,
				vl: vl
				},
				success:function(data){
					  /* alert(data); */
					 opt=data.split(',');
					 $('#displyRoomDETT').html(opt[0]);
					 $('#total_val').val(opt[1]);
					 $('#scst').val(opt[2]);
				     $('#ccst').val(opt[3]);
				     $('#net_amt').val(opt[4]);
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

hr.style1{
	border-top: 1px solid #8c8b8b;
}
</style>
<body class="bgBODY">



<div id="invoice" style="">
		<div class="" >
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];
$cr=explode('/',$curDate);
//$cr=array_map('trim', explode('/',$rowAC['cur_date']));
$ctt=$cr[2].'-'.$cr[1].'-'.$cr[0];	

?>
<?php 	
if(isset($_GET['msg'])){
	
?>
	<p style="text-align:center;margin:-16px 0 0 0;">
		<label id="msgFo" class="fstChUPPRCase" style="color:#7B0E0E;margin:19px 0 0 0;font-weight:bold;"><?php echo 'Voucher '.$_GET['msg']; ?></label>
	</p>
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo $home_path;?>/tcal-picker/tcal.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/tcal-picker/tcal.js"></script> 
<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:969px;">
<!--<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:1112px;overflow:auto;height:500px;">-->
<h3 id="Userhd"><b>Banquet Voucher </b></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_voucher_detail.php" method="post" class="" style="">
<div>
<div style="width:34%;float:left;">	
<table style="float:left;border-bottom:1px solid #ddd;margin:8px 0 0 41px;" cellpadding="0" cellspacing="0" class="table" border="0" >

<tr>
		<td width="" valign="top"><label>Voucher#</label></td>
		<td valign="top"><input name="voucher_no" id="voucher_no" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
</tr>

</table>

<table style="float:left;border-bottom:1px solid #ddd;margin:8px 0 0 0px;" cellpadding="0" cellspacing="0" class="table" border="0">
<tr>
<td width="" valign="top"><label>FP.#<em>*</em></label></td>
<td valign="top">
<select name="fp_no" id="fp_no" style="font-size:12px;width:210px" onChange="selVoucherDet();" class="wagRw1 textbox">
	<option value="">--Select--</option>
	<?php
	
	$sqle=mysql_query("select distinct fpno from bq_opfpmenuhdr where bkdate<='$curDate' AND bill_status='1' AND vuc_status=''");
	while($res=mysql_fetch_array($sqle)){
	?>
	<option value="<?php echo $res['fpno']  ?>" ><?php echo strtoupper($res['fpno']); ?></option>
	<?php } ?>
</select>

</td>
</tr>
<tr>
		<td width="" valign="top"><label>Booking#</label></td>
		<td valign="top"><input name="booking_no" id="booking_no" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
</tr>
<tr>
		<td width="" valign="top"><label>Date</label></td>
		<td valign="top"><input name="vouc_date" id="vouc_date" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
</tr>
<tr>
		<td width="" valign="top"><label>Guest</label></td>
		<td valign="top"><input name="guest_name" id="guest_name" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Session</label></td>
		<td valign="top"><input name="session" id="session" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Venue</label></td>
		<td valign="top"><input name="venue" id="venue" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Billing Instruction</label></td>
		<td valign="top"><input name="bill_instr" id="bill_instr" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Contact Person</label></td>
		<td valign="top"><input name="con_person" id="con_person" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Mobile</label></td>
		<td valign="top"><input name="mobile" id="mobile" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
		</tr>
		</table>
		
<table style="float:left;border-bottom:1px solid #ddd;margin:15px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
<thead class="tathead">
<tr>
<td colspan="7"><h3 id="rmTyp" style="background-color:#0073B5;color:#fff;"><b>Advance</b></h3></td>
</tr>
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:104px;">Receipt#</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:104px;">Date</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:104px;">Amount</th>
</tr>
</thead>
<tbody class="tathead tatbody tableS" id="dispADVHde" style="overflow:auto;height:125px;">
<?php 
for($cc=1;$cc<5;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="advv_rcpt[]" id="adv_rcpt<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="advv_date[]" id="adv_date<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="advv_amount[]" id="adv_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px" value="" readonly /></td>
</tr>	
<?php } ?>	
</tbody>

<tbody class="tathead tatbody tableS" id="dispADVShw" style="overflow:auto;height:127px;display:none;">

</tbody>
</table>


<?php 
$sqlPm=mysql_query("select * from bq_taxdetail");
$rowPm=mysql_fetch_array($sqlPm);
$halltax=$rowPm['hall_tax'];
$foodtax=$rowPm['food_tax'];
?>
</div>
<!-- Start popup -->
<div id="myModal" class="modal fade" role="dialog" style="padding:200px 0 0 0;width:500px;margin:0 auto;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">&nbsp;</h4>
      </div>
      <div class="modal-body">
        <p><label style="font-weight:bold;width:110px;vertical-align:top;">Enter the pax</label><label style="font-weight:bold;"><input name="pax_num" id="pax_num" type="text" class="textbox fstChUPPRCase" style="width:210px"/></label></p>
      </div>
      <div class="modal-footer" style="width:500px;">
        <button type="button" onclick="btnFcs();" class="btn btn-default" data-dismiss="modal">Submit</button>
      </div>
    </div>

  </div>
</div>
<!-- End popup -->


<table style="float:left;width:62%;border-right:1px solid #ddd;margin:8px 0 0 17px;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
	<td width="" valign="top"><label>Total Pax</label></td>
	<td valign="top" colspan='4'><input name="total_pax" id="total_pax" type="text" class="textbox fstChUPPRCase" style="width:100px" readonly />&nbsp;
	<input type="button" value="Change" class="btnH" data-toggle="modal" data-target="#myModal" title="Pax Change" style="margin:-4px 0 0 0;" />
	</td>
</tr>
<tr>
<td colspan="5"><h3 id="rmTyp" style="background-color:#0073B5;color:#fff;"><b>Menu Creation</b></h3></td>
</tr>
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:100px;">Item code</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:230px;">Item name</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">Qty</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">Rate</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:102px;">Value</th>
</tr>
</thead>

<tbody class="tathead tatbody tableS" id="displyRo" style="overflow:auto;height:315px;">
<?php 
for($cc=1;$cc<14;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_code[]" id="item_code<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_name[]" id="item_name<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_qty[]" id="item_qty<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_rate[]" id="item_rate<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly  /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_value[]" id="item_value<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:102px;margin:5px 0 0 0px" value="" readonly /></td>
</tr>	
<?php 
}
?>	
</tbody>
<tbody class="tathead tatbody tableS" id="displyRoomDETT" style="overflow:auto;height:315px;display:none;">

</tbody>
<tbody class="" >
<tr id="" style="float:right;">
	<td style="text-align:center;font-size:12px;font-weight:bold;vertical-align:middle;" class="sourceonVAL">&nbsp;Sub Total&nbsp;</td>
	<td style="text-align:center;" class="sourceonVAL"><input name="total_val" id="total_val" type="text"  class="textbox fstChUPPRCase total_val" style="width:120px;margin:5px 0 0 0px" value="" readonly /></td>
	
</tr>
</tbody>
<tbody class="" >
<tr id="" style="float:right;">
	<td style="text-align:center;font-size:12px;font-weight:bold;vertical-align:middle;" class="sourceonVAL">&nbsp;SGST 9%&nbsp;</td>
	<td style="text-align:center;" class="sourceonVAL"><input name="scst" id="scst" type="text"  class="textbox fstChUPPRCase scst" style="width:120px;margin:5px 0 0 0px" value="" readonly /></td>
</tr>
</tbody>
<tbody class="" >
<tr id="" style="float:right;">
	<td style="text-align:center;font-size:12px;font-weight:bold;vertical-align:middle;" class="sourceonVAL">&nbsp;CGST 9%&nbsp;</td>
	<td style="text-align:center;" class="sourceonVAL"><input name="ccst" id="ccst" type="text"  class="textbox fstChUPPRCase ccst" style="width:120px;margin:5px 0 0 0px" value="" readonly /></td>
</tr>
</tbody>
<tbody class="" >
<tr id="" style="float:right;">
<td valign="top" style=""><label>Remarks</label></td>
<td valign="top"><textarea cols="45" rows="2" name="remarks" id="remarks" value="" style="text-transform:uppercase;font-size:12px;"></textarea></td>
	<td style="text-align:center;font-size:12px;font-weight:bold;vertical-align:middle;" class="sourceonVAL">&nbsp;Net amount&nbsp;</td>
	<td style="text-align:center;" class="sourceonVAL"><input name="net_amt" id="net_amt" type="text"  class="textbox fstChUPPRCase net_amt" style="width:120px;margin:5px 0 0 0px" value="" readonly /></td>
</tr>
</tbody>
</table>
<table>


<!--<table style="float:left;width:62%;border-right:1px solid #ddd;margin:8px 0 0 17px;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<tr>
			<td width="" valign="top"><label>Remarks</label></td>
			<td valign="top"><textarea cols="34" rows="2" name="remarks" id="remarks" value="" style="text-transform:uppercase;font-size:12px;"></textarea></td>
		</tr>
</table>-->		


<!--<table style="float:left;width:62%;border-right:1px solid #ddd;margin:8px 0 0 17px;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >


</table>-->
				
				

			
<script>
(function ($) {
	function init() {
		$('.easy-tree').EasyTree({
			addable: true,
			editable: true,
			deletable: true
		});
	}

	window.onload = init();
})(jQuery)
</script>			
	</div>
	
<style>
.butExample {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #fff;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin: 15px 0 0 0;
    padding: 4px 65px;
}
</style>

<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0 0 0 0px;">
		<button type="submit" id="send" name="send" class="butExample bnkSbt frstChr" style="" onclick="return checkformSubmit();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-fpvoucher-details.php?fromdate=<?php echo $rowAC['cur_date'];?>&todate=<?php echo $rowAC['cur_date'];?>&val="><button type="button" id="update" class="butExample bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
		
		<a href="#" target="_blank"><button type="button" id="hallsts" class="butExample" style="" onclick="hall_sts()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">U</span>pdate</button></a>
		
			<button type="reset" id="rest" class="butExample" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
		<a href="<?php echo $home_path; ?>/transaction/frontdesk/view-fpvoucher-details.php?fromdate=<?php echo $rowAC['cur_date'];?>&todate=<?php echo $rowAC['cur_date'];?>&val="><button type="button" id="exit" name="exit" class="butExample" style="" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
	</div>
	</td>
	</tr>
</table>		
	
	
	
</div>
	</div>
	</div>
	</form>	
	<?php /* include("../../footer.php"); */ ?>
</body>
</html>