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
<!-- End -->
<!---//-form valid---->

<link href="<?php echo $home_path;?>/treegrid/docs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $home_path;?>/treegrid/dist/css/jquery.treegrid.css" rel="stylesheet">

	
<script src="<?php echo $home_path;?>/treegrid/docs/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo $home_path;?>/treegrid/dist/js/jquery.treegrid.min.js"></script>
		
		
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

<!--<script type="text/javascript" src="<?php echo $home_path;?>/js/itemfp.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/js/utilfp.js"></script>-->
 
<script type="text/javascript">
$(document).ready(function(){
	if (window.addEventListener) // W3C standard
{
  window.addEventListener('load', selMenuCode, false); // NB **not** 'onload'
  //window.addEventListener('load', prefdet, false);
}
//$('.tree').treegrid();
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
		
});

$('input[name^=amen_itemrate]').keyup(function(){
	rate =parseFloat($(this).val()); 
	qtyVal =parseFloat($(this).parent().prev().find('input').val());
	totAMt=parseFloat(qtyVal*rate);
	itmDs=($(this).parent().prev().find('input').val());
	Amt =parseFloat($(this).parent().next().find('input').val(totAMt));
	ttAmt=parseFloat($(this).parent().next().find('input').val());
	if(isNaN(ttAmt)){ ttAmt=parseFloat($(this).parent().next().find('input').val(0));}
});	
	
	
$("#msgFo").fadeOut(5000);


	


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
			  /*  alert(data); */  
			 opt=data.split(',');
			$('#halltax_chg').val(opt[0]);
			$('#hallchgnoincl').val(opt[1]);
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
			   /* alert(data);  */
			  opt=data.split(',');
			$('#ratetax_chg').val(opt[0]);
			$('#ratechgnoincl').val(opt[1]);
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
			$('#ratechgnoincl').val(data);
		}
	});	 
}
});





});

/*  shortcut.add("Ctrl+S",function() { 
	 $('#hotelDefi').attr('action', '../../action/add_room_booking.php');  
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
}); */

function selMenuCode(){
menu=$('#menu').val();
fpNo=$('#fp_no').val();
bkNo=$('#booking_no').val();
var mcode='clrmenu';
var submenu='';
	if(menu!=""){
		$.ajax({
			type:'GET',
			url:'  ../../action/edit_fbcreatemenu.php',
				data:{
				mcode:mcode,
				submenu:submenu,
				menu:menu,
				fpNo:fpNo,
				bkNo:bkNo
				},
				success:function(data){
					/* alert(data); */
					 opt=data.split('&#');
					/* $('.tree').treegrid(); */
					$('#displyRo').hide();				
					$('.menuDet').hide();				
					$('#displyRoomDETT').show();				
					$('.menuDetShw').show();				
					$('#displyRoomDETT').html(opt[0]);				
					$('.menuDetShw').html(opt[1]);	
					$('.tree').treegrid();					
					
				}
		});
	}
	if(menu==""){
		$('#displyRo').show();				
		$('#displyRoomDETT').hide();		
	}
}

function selsubCode(e){
menu=$('#menu').val();
bkNo=$('#booking_no').val();
var mcode='setmenu';
var submenu = $(e).attr('submenu');
if(submenu!=""){
		$.ajax({
			type:'GET',
			url:'  ../../action/edit_fbcreatemenu.php',
				data:{
				mcode:mcode,
				menu:menu,
				fpNo:fpNo,
				bkNo:bkNo,
				submenu:submenu
				},
				success:function(data){
					/* alert(data); */
					opt=data.split('&#');
					/* $('.tree').treegrid(); */
					$('#displyRo').hide();				
					$('.menuDet').hide();				
					$('#displyRoomDETT').show();				
					$('.menuDetShw').show();				
					$('#displyRoomDETT').html(opt[0]);	
					$('.menuDetShw').html(opt[1]);	
					$('.tree').treegrid();
				}
		});
	}
}
function checkformSubmit() {
	/* $('#hotelDefi').attr('action', '../../action/add_fp_creation.php');  
			$('#hotelDefi').submit(); */
	hd=$('#hid_menu').val();	
	bkn=$('#booking_no').val();	
	gstn=$('#guest_name').val();	
	ven=$('#venue').val();	
	ses=$('#session').val();	
	totpx=$('#tot_pax').val();	
	mnu=$('#menu').val();	
		 if(bkn==''){
			alert('Please enter the booking no!.');
			return false;
		}else if(gstn==""){
			alert('Please enter the Guest name!.');
			return false;
		}else if(ven==""){
			alert('Please enter the venue!.');
			return false;
		}else if(ses==""){
			alert('Please enter the session!.');
			return false;
		}else if(totpx==""){
			alert('Please enter the total pax!.');
			return false;
		}/* else if(mnu==""){
			alert('Please enter the menu name!.');
			return false;
		} */  /* else{ */
			/* $('#hotelDefi').attr('action', '../../action/add_fp_creation.php');  
			$('#hotelDefi').submit(); */
		/* } */
		/* $('#hotelDefi').attr('action', '../../action/add_fp_creation.php');  
			$('#hotelDefi').submit(); */
}

function prefdet(c,e){
	var pref = c;
	$.ajax({
		type:'GET',
		url:'  ../../action/selprefdef.php',
			data:{
			pref:pref
			},
			success:function(data){
				/*  alert(data); */				
				 $('#prefn'+e).val(data);
			}
	});	
	
}

function inclRateTax(){
$.ajax({
		type:'GET',
		url:'  ../../action/selRATETax.php',
			data:{
			menu:menu
			},
			success:function(data){
				/* alert(data);  */
			}
	});	
	
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


function selBQTFBCreat(bk,bid){
	/* bkNo=$('#booking_no').val(); */
	bkNo=bk;
	$.ajax({
		type:'GET',
		url:'  ../../action/selselBQTFBCreat.php',
			data:{
			bkNo:bkNo,
			bid:bid
			},
			success:function(data){
				 /* alert(data); */ 
				/* $('#zeroTree'). */
				opt=data.split(',');
				$('#booking_no').val('');			
				$('#booking_no').val(bkNo);			
				$('#guest_name').val(opt[0]);				
				$('#session').val(opt[3]);				
				$('#venue').val(opt[2]);				
				$('#tot_pax').val(opt[4]);				
				$('#ratetax_chg').val(opt[4]);				
				$('#ratechgnoincl').val(opt[4]);				
				$('#func_dt').val(opt[5]);				
				$('#hallbook_id').val(opt[6]);				
				
				
				
			}
	});
}
function Menuselval(val)
{
	fpno=$('#fpno').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/edit_menusel.php',
			data:{
			fpno:fpno,
			val:val
			},
			success:function(data){
			  /* alert(data); */
		}
	});
}

function setMenu(e)
{
	var submenu = $(e).attr('submenu');
	var val = $(e).attr('value');
	var menuStr="";
	$('.chk').each(function(i,v){
		if($(this).is(':checked'))
		{
		menuStr +=$(this).val()+',';
		}
	});
	menuStr = menuStr.slice(0,-1);
	$("#hid_menu").val(menuStr);
	hdm=$("#hid_menu").val();
	bkNo=$("#booking_no").val();
	menu=$("#menu").val();
	
	$.ajax({
		type:'GET',
		url:'  ../../action/seleditBQTFBMnuCHeckbox.php',
			data:{
			submenu:submenu,
			menu:menu,
			bkNo:bkNo,
			hdm:hdm,
			val:val
			},
			success:function(data){
			/* alert(data);*/
			opt=data.split('&#');
			$('.menuDetShw').html(opt[0]);	
			$('.tree').treegrid();
			/* allow quanty */
			if(opt[1]!=''){
			alert(opt[1]);
			}
			/* allow quanty */
			}
	});
	
}

function arrtTime(){
	frm=$('#arrtime').val();
	if((frm.length) == 2){
		$('#arrtime').val($('#arrtime').val() + ":");
	}
}


function pictTime(){
	frm=$('#pictime').val();
	if((frm.length) == 2){
		$('#pictime').val($('#pictime').val() + ":");
	}
}

function sertTime(){
	frm=$('#sertime').val();
	if((frm.length) == 2){
		$('#sertime').val($('#sertime').val() + ":");
	}
}

function mortTime(){
	frm=$('#mortea').val();
	if((frm.length) == 2){
		$('#mortea').val($('#mortea').val() + ":");
	}
}

function evetTime(){
	frm=$('#evetea').val();
	if((frm.length) == 2){
		$('#evetea').val($('#evetea').val() + ":");
	}
}

function srchTxt(){
	srch=$('#searchTxt').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selsrchTxt.php',
			data:{
			srch:srch
			},
			success:function(data){
				/* alert(data); */
				$('#srcDisHde').hide();	
				$('#srcDisShw').show();	
				$('#srcDisShw').html(data);	
			}
	});
}

function pointNum(e)
{
	var charCode = (e.which)?e.which:e.keyCode;
	if(charCode > 31 && (charCode < 48 || charCode >57) && charCode != 46)
			{
			alert ("Digits only");
			return false;
			}
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
  background: rgba(1, 1, 0, 0.5);
}

::-webkit-scrollbar-thumb
{
  background: rgba(0, 0, 0, 0.5);
}

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
    padding: 5px 34px;
    /* padding: 5px 59px; */
	/* width:125px; */
	width:232px;
}
</style>

		
<body class="bgBODY">
<div class="about" style="margin:0px 0 0 0;">
<?php 	
/* echo $_GET['msg']; */ 
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;margin:0px 0 0 0;">
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

$sqlb=mysql_query("select * from bq_hallbooking where fpno='".$_GET['fpNo']."'");
$rowb=mysql_fetch_array($sqlb);

$sqlS=mysql_query("select * from bqt_session where sess_code='".$rowb['session']."'");
$rowS=mysql_fetch_array($sqlS);
 ?>
<link rel="stylesheet" type="text/css" href="<?php echo $home_path;?>/tcal-picker/tcal.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/tcal-picker/tcal.js"></script> 
<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:1120px;">
<!--<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:1112px;overflow:auto;height:500px;">-->
	<h3 id="Userhd"><b>Edit Banquet Menu </b></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/update-fp-creation.php" method="post" class="" style="">
	<input name="incLc" id="incLc" type="hidden" style="" value=""/>
	<input type="hidden" name="rowVl" id="rowVl"/>
	<input type="hidden" name="book_date" id="book_date" value="<?php echo $rowb['book_date']; ?>"/>
	<input type="hidden" name="rmomType" id="rmomType"/>
	<input type="hidden" name="fpno" id="fpno" value="<?php echo $rowb['fpno'];?>"/>
	<input type="hidden" name="adtDate" id="adtDate" value="<?php echo $curDate?>"/>
	<!--<input type="hidden" name="hid_menu" id="hid_menu" data-validation="required" class="input validate[required]" value=""/>-->
	<input type="hidden" name="hid_menu" id="hid_menu" class="" value=""/>

<style>
btnH{
	padding:2px 15px;
}

.btnHV{
	padding:10px 10px;
	width:268px; 
	
}
</style>

<!-- Start popup -->
<div id="myModal1" class="modal fade" role="dialog" style="padding:80px 0 0 0;width:500px;margin:0 auto;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Department Instructions</h4>
		
		
		 
      </div>
      <div class="modal-body">
	  
<table  class="table " cellpadding="0" cellspacing="0" border="0" style="width:60%;">
<thead class="">
<tr>
	<th style="text-align:left;background-color:#0073B5;color:#fff;width:80px;font-size:12px;text-align:center;">Dept code</th>
	<th style="text-align:left;background-color:#0073B5;color:#fff;width:150px;font-size:12px;text-align:center;">Dept Instruction</th>
</tr>	
</thead>	
<tbody id="srcDisHde" style="">
<?php 
for($cc=1;$cc<7;$cc++){
?>

<tr id="">
<td style="text-align:center;" class="sourceonVAL">
<select name="dept_code[]" id="dept_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;" value="">
		<option value="">--Select--</option>
		<?php
		$sqle=mysql_query("select distinct dept_code,dept_name from bq_deptmt where status='1'");
		while($res=mysql_fetch_array($sqle)){
		?>
		<option value="<?php echo $res['dept_code']  ?>" ><?php echo strtoupper($res['dept_name']); ?></option>
		<?php } ?>
</select>
</td>
<td valign="top"><textarea cols="50" rows="2" name="dept_instr[]" id="dept_instr" value="" style="text-transform:uppercase;font-size:12px;"></textarea></td>
</tr>
<?php 
}
?>

<tr>
<td style="width:150px;border:none;">&nbsp;</td>
<td style="width:150px;border:none;"> <button type="button" onclick="" class="btnH" data-dismiss="modal">Submit</button></td>
</tr>
</tbody>
	
<tbody id="srcDisShw">	

</tbody>
</table>
	
      </div>
      <div class="modal-footer" style="width:500px;">
        &nbsp;
      </div>
    </div>

  </div>
</div>
<!-- End popup -->





<!-- Start popup -->
<div id="myModal2" class="modal fade" role="dialog" style="padding:130px 0 0 0;width:500px;margin:0 auto;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="" data-dismiss="modal">&times;</button>
        <!--<h4 class="modal-title">Department Instructions</h4>-->
		
		
		 
      </div>
      <div class="modal-body">
	  
<table style="float:left;width:81%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
<td colspan="7"><h3 id="rmTyp" style="background-color:#0073B5;color:#fff;"><b>Amenities / Beverages</b></h3></td>
</tr>
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:100px;">Code</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:150px;">Name</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:40px;">Qty</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:60px;">Rate</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:80px;">Amount</th>
	<!--<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:30px;">Tag</th>-->
</tr>
</thead>
	<tbody class="tathead tatbody tableS" id="" style="overflow:auto;height:250px;">
<?php 
for($cc=1;$cc<15;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL">
	<select name="amen_itemcode[]" id="amen_itemcode<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;" value="" onchange="itmOthName(<?php echo $cc;?>);">
				<option value="">--Select--</option>
				<?php
				/* $sqle=mysql_query("select distinct item_code,item_name from bq_itemmaster where status='1' AND itmsub_cat='oth'"); */
				$sqle=mysql_query("select distinct item_code,item_name,itmsub_cat from bq_itemmaster where status='1' AND itmsub_cat IN('oth','OT')");
				while($res=mysql_fetch_array($sqle)){
				?>
				<option value="<?php echo $res['item_code']  ?>" ><?php echo strtoupper ($res['item_code']); ?></option>
				<?php } ?>
		</select>
	<!--<input name="amen_itemcode[]" id="amen_itemcode" type="text"  class="textbox fstChUPPRCase expet" style="width:60px;margin:5px 0 0 0px" value="" />--></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemname[]" id="amen_itemname<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemqty[]" id="amen_itemqty<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:40px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemrate[]" id="amen_itemrate<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:60px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemamount[]" id="amen_itemamount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" /></td>
	<!--<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemtag[]" id="amen_itemtag<?php echo $cc;?>" type="checkbox"  class="textbox fstChUPPRCase expet" style="width:30px;margin:5px 0 0 0px" value="" /></td>-->
</tr>	
<?php 
}
?>	
</tbody>
</table>

<table style="float:left;width:81%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >	
<tr>
<td style="width:150px;border:none;">&nbsp;</td>
<td style="width:150px;border:none;"><button type="button" onclick="" class="btnH" data-dismiss="modal">Submit</button></td>
</tr>
</table> 
 
      </div>
      <div class="modal-footer" style="width:500px;">
        &nbsp;
      </div>
    </div>

  </div>
</div>
<!-- End popup -->
	
<div>

<div style="width:27%;float:left;">	
<table style="float:left;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
<tr>
<td width="" valign="top"><label>Booking No </label></td>
<td valign="top">
<input name="booking_no" id="booking_no" type="text" class="textbox fstChUPPRCase" style="width:210px"
value="<?php echo $rowb['booking_no'];?>" readonly />
</td>
</tr>
<input type="hidden" name="hallbook_id" id="hallbook_id" value="<?php echo $rowb['hallbook_id'];?>"/>
<tr>
<td width="" valign="top"><label>Fp.No <em>*</em></label></td>
<td valign="top"><input name="fp_no" id="fp_no" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $rowb['fpno'];?>" readonly /></td>
</tr>
<tr>
	<td width="" valign="top"><label>Guest name</label></td>
	<td valign="top"><input name="guest_name" id="guest_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" value="<?php echo $rowb['guest_name'];?>" readonly /></td>
	</tr>
		<tr>
		<td width="" valign="top"><label>Venue</label></td>
		<td valign="top"><input name="venue" id="venue" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" value="<?php echo $rowb['venue'];?>" style="width:210px" readonly /></td>
		</tr>
		
		
		<tr>
		<td width="" valign="top"><label>Session</label></td>
		<td valign="top"><input name="session" id="session" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" value="<?php echo $rowS['sess_name'];?>" style="width:210px" readonly /></td>
		</tr>
		<tr>
			<td width="" valign="top"><label>Exp Pax</label></td>
			<td valign="top">
			<input  name="exppax" id="exppax" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" value="<?php echo $rowb['expected'];?>" style="width:70px"  />
			<span class="spanClr">Gaurn Pax</span>&nbsp;
			<input name="gaupax" id="gaupax" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" value="<?php echo $rowb['guaranted'];?>" style="width:70px"  />
			</td>
		</tr>
<?php 
$sqmnu=mysql_fetch_array(mysql_query("select menu_code from bq_opfpmenuhdr where fpno='".$_GET['fpNo']."' and bill_status='1'"));
 ?>		
	
	<tr>
							<td width="" valign="top"><label>Menu </label></td>
							<td valign="top">
							<?php $sqlBS=mysql_query("select distinct itmnu_code,itmnu_name from bq_itemmaster where status='1' AND itmnu_code!=''");?>
							<select name="menu" id="menu" style="font-size:12px;width:210px" onChange="selMenuCode();" class="wagRw1 textbox">
	                        <option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<?php if($rowBS['itmnu_code']==$sqmnu['menu_code']) { ?>
							<option value="<?php echo $rowBS['itmnu_code'];?>" selected ><?php echo $rowBS['itmnu_name'];?></option>
							<?php } else { ?>
							<option value="<?php echo $rowBS['itmnu_code'];?>"><?php echo $rowBS['itmnu_name'];?></option>
							<?php } } ?>
							</select>
							</td>
						</tr>
		<?php $sqmnh=mysql_fetch_array(mysql_query("select * from bq_opfpmenuhdr where fpno='".$_GET['fpNo']."' and bill_status='1'")); ?>
		<tr>
			<td width="" valign="top"><label>Time</label></td>
			<td valign="top">
			<input type="text" name="arrtime" id="arrtime" class="fstChUPPRCase textbox" style="width:50px" value="<?php echo $sqmnh['arrtime'];?>" onkeyup="arrtTime();" >
			<span class="spanClr">Pick</span>&nbsp;
			<input name="pictime" id="pictime" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:0 0 0 -8px;" value='<?php echo $sqmnh['pictime'];?>' onkeyup="pictTime();" /><span class="spanClr">Serv</span>&nbsp;
			<input name="sertime" id="sertime" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:0 0 0 -8px;" value='<?php echo $sqmnh['sertime'];?>' onkeyup="sertTime();" />
			</td>
		</tr>
		<!--<tr>
			<td width="" valign="top"><label>M.T</label></td>
			<td valign="top">
			<input type="text" name="mortea" id="mortea" class="fstChUPPRCase textbox" style="width:92px" value="" onkeyup="mortTime();">
			<span class="spanClr">E.T</span>&nbsp;
			<input name="evetea" id="evetea" type="text" class="textbox fstChUPPRCase" value="" style="width:92px" onkeyup="evetTime();"/>
			</td>
		</tr>-->
		
		<tr>
			<td width="" valign="top"><label>Remarks</label></td>
			<td valign="top"><textarea cols="34" rows="2" name="remarks" id="remarks" value="" style="text-transform:uppercase;font-size:12px;"><?php echo $sqmnh['remarks'];?></textarea></td>
		</tr>
		<tr>
				<td width="" valign="top"><label>Sign Board</label></td>
				<td valign="top"><textarea cols="34" rows="" name="sign_board" id="sign_board" value="" style="text-transform:uppercase;font-size:12px;margin:0px 0 0 0;"><?php echo $sqmnh['signboard'];?></textarea></td>
		</tr>
<?php 
$sqlPm=mysql_query("select * from bq_taxdetail");
$rowPm=mysql_fetch_array($sqlPm);
$halltax=$rowPm['hall_tax'];
$foodtax=$rowPm['food_tax'];

?>
		<tr>
			<td width="" valign="top"><label>Hall Tax</label></td>
			<td valign="top">
			<input type="text" name="halltax_det" id="halltax_det" data-validation="required" class="input validate[required] fstChUPPRCase textbox halltax_det" style="width:65px" value="<?php echo $halltax; ?>" readonly >
			<span class="spanClr">Charge</span>&nbsp;
			<input name="halltax_chg" id="halltax_chg" type="text" onkeypress="return pointNum(event)" class="textbox fstChUPPRCase" style="width:60px;margin:0 0 0 -8px;" value="<?php echo $sqmnh['hallchrg']; ?>" />
			<input name="hallchgnoincl" id="hallchgnoincl" type="hidden" class="textbox fstChUPPRCase" value='0' />
			<input type="checkbox" name="halltaxincl" id="halltaxincl" value="hallincl" class="halltaxincl" style="margin:0 0 0 -8px;" <?php echo ($sqmnh['hallincl']=='hallincl' ? 'checked' : '');?> /> <span style="font-size:12px;">  Incl</span>
			</td>
		</tr>
		<tr>
			<td width="" valign="top"><label>Rate Tax</label></td>
			<td valign="top">
			<input type="text" name="ratetax_det" id="ratetax_det" data-validation="required" class="input validate[required] fstChUPPRCase textbox ratetax_det" style="width:65px" value="<?php echo $foodtax; ?>" readonly >
			<span class="spanClr">Rate&nbsp;&nbsp;</span>&nbsp;
			<input name="ratetax_chg" id="ratetax_chg" type="text" onkeypress="return pointNum(event)" class="textbox fstChUPPRCase" style="width:60px;margin:0 0 0 0px;" value='<?php echo $sqmnh['ratechrg']; ?>'/>
			<input name="ratechgnoincl" id="ratechgnoincl" type="hidden" class="textbox fstChUPPRCase" value='0'/>
			
			<input type="checkbox" name="ratetaxincl" id="ratetaxincl" value="rateincl" class="ratetaxincl" style="margin:0 0 0 -8px;" <?php echo ($sqmnh['rateincl']=='rateincl' ? 'checked' : '');?>  /> <span style="font-size:12px;">Incl</span>
			</td>
		</tr>


</table>



</div>


<table style="float:left;width:40%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
<td colspan="4"><h3 id="rmTyp" style="background-color:#0073B5;color:#fff;"><b>Menu Creation</b></h3></td>
</tr>
<tr>
	<!--<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:100px;">Item code</th>-->
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:280px;">Item name</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:52px;">Select</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:200px;">Preference</th>
</tr>
</thead>
<tbody class="tathead tatbody tableS" id="displyRo" style="overflow:auto;height:263px;">

<?php 
for($cc=1;$cc<14;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code" type="hidden"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:280px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="menusel[]" id="menusel" type="checkbox"  class="textbox fstChUPPRCase expet" style="width:52px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="prefn[]" id="prefn<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="" /></td>
</tr>	
<?php 
}
?>										
</tbody>
<tbody class="tathead tatbody tableS" id="displyRoomDETT" style="overflow:auto;height:263px;display:none;">

</tbody>
</table>




<div class="" style="margin-top:0px;width:228px;float:right;height:300px;">
	


<div class="menuDet" style="height:300px;overflow:auto;margin:10px 0 0 0;">
<table class="tree" style="font-size:10px;font-weight:bold;">
  <tbody>
<?php 
$sql=mysql_query("select * from bq_menugrp where status='1'");
$x=1;
while($row=mysql_fetch_array($sql)){ 
$x++;
?>
    <tr class="treegrid-1"><td><?php echo strtoupper($row['menu_name']); ?></td></tr>
    <tr class="treegrid-2 treegrid-parent-1"><td><?php echo strtoupper($row['menu_name']); ?></td></tr>
<?php } ?>
  </tbody>
</table>
</div>
		
<div class="menuDetShw" style="height:391px;overflow:auto;margin:10px 0 0 0;display:none;">

</div>		
	


	




		
<!--<table style="float:left;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
<td colspan="7"><h3 id="rmTyp" style="background-color:#7b0e0e;color:#fff;"><b>Open Item</b></h3></td>
</tr>
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:100px;">Item name</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:195px;">Sub Menu</th>

</tr>
</thead>
<tbody class="tathead tatbody tableS" id="" style="overflow:auto;height:122px;">

<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="open_itemname[]" id="open_itemname" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL">
	<select name="open_submenu[]" id="open_submenu" type="text"  class="textbox fstChUPPRCase expet" style="width:195px;margin:5px 0 0 0px" value="">
				<option value="">--Select--</option>
				<?php
				$sqle=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
				while($res=mysql_fetch_array($sqle)){
				?>
				<option value="<?php echo $res['grpcode']  ?>" ><?php echo strtoupper($res['grpname']); ?></option>
				<?php } ?>
	</select>
</tr>	

</tbody>


</table>-->
</div>






<table style="float:left;width:32%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
<td colspan="7"><h3 id="rmTyp" style="background-color:#0073B5;color:#fff;"><b>Open Item</b></h3></td>
</tr>
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:287px;">Item name</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:50px;">Qty</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:81px;">Rate</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:110px;">Sub Menu</th>
		<!--<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:145px;">SAC code</th>
<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:100px;">Sub Categ</th>-->

</tr>
</thead>
<tbody class="tathead tatbody tableS" id="" style="overflow:auto;height:122px;">
	<?php 
$sqlm=mysql_query("select * from bq_opfpmenudetail where fpno='".$_GET['fpNo']."' and bill_status='1' and itemcode='55555'");
while($rowm=mysql_fetch_array($sqlm)){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="open_itemname[]" id="open_itemname<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:287px;margin:5px 0 0 0px" value="<?php echo $rowm['itemname']; ?>" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="opn_qty[]" id="opn_qty<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="<?php echo $rowm['qty']; ?>" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="open_itemrate[]" id="open_itemrate<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="<?php echo $rowm['rate']; ?>" /></td>
	<td style="text-align:center;" class="sourceonVAL">
	<select name="open_submenu[]" id="open_submenu<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:110px;margin:5px 0 0 0px" value="">
				<option value="">--Select--</option>
				<?php
				$sqle=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
				while($res=mysql_fetch_array($sqle)){
				if($rowm['submenugrpcode']==$res['grpcode']) { ?>
				<option value="<?php echo $res['grpcode']  ?>" selected ><?php echo strtoupper($res['grpname']); ?></option>
				<?php } else { ?>
				<option value="<?php echo $res['grpcode'];?>"><?php echo $res['grpname'];?></option>
				<?php } } ?>
		</select>
		</td>
	<!--<td style="text-align:center;" class="sourceonVAL"><input name="open_sac[]" id="open_sac<?php echo $cc; ?>" type="text"  class="textbox fstChUPPRCase expet" style="width:130px;margin:5px 0 0 0px" value="<?php echo $rowm['sac']; ?>" /></td>-->
</tr>	
<?php 
}
?>	
<?php 
for($cc=1;$cc<30;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="open_itemname[]" id="open_itemname" type="text"  class="textbox fstChUPPRCase expet" style="width:287px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="opn_qty[]" id="opn_qty" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="open_itemrate[]" id="open_itemrate" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" /></td>
	<td style="text-align:center;" class="sourceonVAL">
	<select name="open_submenu[]" id="open_submenu" type="text"  class="textbox fstChUPPRCase expet" style="width:110px;margin:5px 0 0 0px" value="">
				<option value="">--Select--</option>
				<?php
				$sqle=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
				while($res=mysql_fetch_array($sqle)){
				?>
				<option value="<?php echo $res['grpcode']  ?>" ><?php echo strtoupper($res['grpname']); ?></option>
				<?php } ?>
		</select>
		</td>
	<!--<td style="text-align:center;" class="sourceonVAL"><input name="open_itempreference[]" id="open_itempreference" type="text"  class="textbox fstChUPPRCase expet" style="width:130px;margin:5px 0 0 0px" value="" /></td>-->
</tr>	
<?php 
}
?>	
</tbody>
</table>
				
<table style="float:left;margin:93px 0 0 0;">
<tr>
<td>
<button type="button" id="submit" class="btnHV bnkSbt frstChr submit" style="" data-toggle="modal" data-target="#myModal1" ><!--<img src="../../images/saves.png" class="sbtBtnImg frstChr"/>-->&nbsp;&nbsp;<span class="btnUndLine" style="width:200px;">O</span>ther inst.</button>
</td>
</tr>

<tr>
<td>
<button type="button" id="billsbt" name="billsbt" class="btnHV" style="" data-toggle="modal" data-target="#myModal2" ><!--<img src="../../images/exitBut.png" class="sbtBtnImg" />-->&nbsp;&nbsp;<span class="btnUndLine">A</span>menities</button>
</td>
</tr>
</table>				

			
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
.btn-sm{
    padding: 3px 10px;
    margin-top: 6px;
    width: 25%;
}
.nowrap{white-space: nowrap;}
.table-responsive{
overflow:hidden;
}
</style>

<div class="col-md-12  responsive nowrap " style=" padding-left:3px;">
		<button type="submit" id="send" name="send" class="btn btn-primary btn-sm btn-responsive" style="" onclick="return checkformSubmit();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">U</span>pdate</button>
		
		<a href="view-fb-creation-chk.php"><button type="button" id="update" class="btn btn-primary btn-sm btn-responsive" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
		
			<button type="reset" id="rest" class="btn btn-primary btn-sm btn-responsive" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
		<a href="<?php echo $home_path; ?>/transaction/frontdesk/view-fb-creation-chk.php"><button type="button" id="exit" name="exit" class="btn btn-primary btn-sm btn-responsive" style="" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
		
	</div>
	
	
	
</div>
	</div>
	</div>
	</form>	
	<?php /* include("../../footer.php"); */ ?>
	<script>
	
  $('#menu').change(function() {
        // Set the selected option text to the input field value attribute
        $('#open_itemname').val($('#menu option:selected').text());
      });

      // Set initial value for the input field
      $('#open_itemname').val($('#menu option:selected').text());
	  </script> 
</body>
</html>