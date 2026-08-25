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

	
<!--<script src="<?php echo $home_path;?>/treegrid/docs/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo $home_path;?>/treegrid/dist/js/jquery.treegrid.min.js"></script>-->
		
		
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
	
$('.tree').treegrid();

 $("#amd_fundt" ).datepicker({
	    changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
	  /* minDate: 0, */
     dateFormat:"dd/mm/yy"
  });
  
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



$(".amd_halltxincl").on("click", function(){
	hdet=$('#amd_halldet').val();
	hchg=$('#amd_hallchg').val();
	yes='yes';
	no='no';
if(amd_halltxincl.checked) {
	
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
			 opt=data.split(',');
			$('#amd_hallchg').val(opt[0]);
			$('#amd_hallincl').val(opt[1]);
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
			$('#amd_hallchg').val(data);
		}
	});	 
}
});


	

$(".amd_ratetaxincl").on("click", function(){
	hdet=$('#amd_ratetax_det').val();
	hchg=$('#amd_ratetax_chg').val();
	yes='yes';
	no='no';
	/* alert(hchg); */
if(amd_ratetaxincl.checked) {
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
			$('#amd_ratetax_chg').val(opt[0]);
			$('#amd_ratechgnoincl').val(opt[1]);
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
			$('#amd_ratetax_chg').val(data);
			$('#amd_ratechgnoincl').val(data);
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
bkNo=$('#booking_no').val();
	if(menu!=""){
		$.ajax({
			type:'GET',
			url:'  ../../action/selectFBCreateMenu.php',
				data:{
				menu:menu,
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
	amdBy=$('#amend_by').val();	
	autBy=$('#author_by').val();	
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
		}else if(mnu==""){
			alert('Please enter the menu name!.');
			return false;
		} else if(amdBy==""){
			alert('Please enter the Amended by!.');
			return false;
		}else if(autBy==""){
			alert('Please enter the Authorised by!.');
			return false;
		} /* else{ */
			/* $('#hotelDefi').attr('action', '../../action/add_fp_creation.php');  
			$('#hotelDefi').submit(); */
		/* } */
		/* $('#hotelDefi').attr('action', '../../action/add_fp_creation.php');  
			$('#hotelDefi').submit(); */
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


function selBQTFBCreat(bk,fbn){
	/* bkNo=$('#booking_no').val(); */
	bkNo=bk;
	$.ajax({
		type:'GET',
		url:'  ../../action/selAmendcreate.php',
			data:{
			bkNo:bkNo,
			fbn:fbn
			},
			success:function(data){
				  /* alert(data); */ 
				/* $('#zeroTree'). */
				opt=data.split('&#');
				$('#booking_no').val('');			
				$('#fp_no').val(opt[0]);			
				$('#booking_no').val(opt[1]);			
				$('#guest_name').val(opt[2]);				
				$('#venue').val(opt[3]);				
				$('#session').val(opt[4]);				
				$('#fromsess').val(opt[5]);				
				$('#tosess').val(opt[6]);	
				$('#func_type').val(opt[7]);	
				$('#seat_type').val(opt[8]);	
				$('#func_date').val(opt[9]);	
				$('#grntpax').val(opt[10]);	
				$('#exppax').val(opt[11]);	
				$('#halltax_chg').val(opt[12]);	
				$('#ratetax_chg').val(opt[13]);	
				$('#booked_by').val(opt[14]);	
				$('#remarks').val(opt[15]);	
				
				$('#halltax_det').val(opt[16]);	
				$('#ratetax_det').val(opt[17]);	
				$('#hallbook_id').val(opt[18]);	
				$('#sign_board').val(opt[19]);	
				
				$('#arrtime').val(opt[20]);	
				$('#pictime').val(opt[21]);	
				$('#sertime').val(opt[22]);	
				$('#mortea').val(opt[23]);	
				$('#evetea').val(opt[24]);	
				$('#menu_code').val(opt[25]);
				
				
				if(opt[26]=='hallincl'){
					$('#halltaxincl').prop('checked',true);	
					$('#amd_halltxincl').prop('checked',true);	
				}
				if(opt[27]=='rateincl'){
					$('#ratetaxincl').prop('checked',true);	
					$('#amd_ratetaxincl').prop('checked',true);	
				}
				$('#address1').val(opt[28]);
				$('#address2').val(opt[29]);
				$('#city').val(opt[30]);
				$('#pin_code').val(opt[31]);
				$('#phone').val(opt[32]);
				$('#gst').val(opt[33]);
				
				
				/* $('#ratetax_chg').val(opt[4]);				
				$('#ratechgnoincl').val(opt[4]);				
				$('#func_dt').val(opt[5]);				
				$('#hallbook_id').val(opt[6]); */				
				
				
				
			}
	});
}



function openItmBtn(){
	fpno=$('#fp_no').val();	
	$.ajax({
		type:'GET',
		url:'  ../../action/selAmendOpenItm.php',
			data:{
			fpno:fpno
			},
			success:function(data){
				 /*  alert(data); */
				/* opt=data.split(',');
				$('#booking_no').val(''); */			
				$('#tatOpen').html(data);			
				
			}
	});
}


function deptINstBtn(){
	fpno=$('#fp_no').val();	
	$.ajax({
		type:'GET',
		url:'  ../../action/selDeptOpenItm.php',
			data:{
			fpno:fpno
			},
			success:function(data){
				  /* alert(data); */
				/* opt=data.split(',');
				$('#booking_no').val(''); */			
				$('#srcDisShw').html(data);			
				
			}
	});
}

function AmeniINstBtn(){
	fpno=$('#fp_no').val();	
	$.ajax({
		type:'GET',
		url:'  ../../action/selAmenitiesItm.php',
			data:{
			fpno:fpno
			},
			success:function(data){
				  /* alert(data); */
				/* opt=data.split(',');
				$('#booking_no').val(''); */			
				$('#tblAMenit').show();			
				$('#tblAMenit').html(data);			
				
			}
	});
}


function setMenu()
{
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
		url:'  ../../action/selselBQTFBMnuCHeckbox.php',
			data:{
			menu:menu,
			bkNo:bkNo,
			hdm:hdm
			},
			success:function(data){
			/* alert(data); */
			$('.menuDetShw').html(data);	
			$('.tree').treegrid();					
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
				/* $('#srcDisHde').hide();	
				$('#srcDisShw').show();	
				$('#srcDisShw').html(data);	 */
			}
	});
}


function copybillToShipPERSONAL() {
		$("#amd_ven").val($("#venue").val());
		$("#amd_sess").val($("#session").val());
		$("#amd_frm").val($("#fromsess").val());
		$("#amd_to").val($("#tosess").val());
		$("#amd_func").val($("#func_type").val());
		$("#amd_seat").val($("#seat_type").val());
		$("#amd_fundt").val($("#func_date").val());
		$("#amd_grpx").val($("#grntpax").val());
		$("#amd_expx").val($("#exppax").val());
		$("#amd_halldet").val($("#halltax_det").val());
		$("#amd_hallchg").val($("#halltax_chg").val());
		$("#amd_ratetax_det").val($("#ratetax_det").val());
		$("#amd_ratetax_chg").val($("#ratetax_chg").val());
		$("#amd_ratetax_chg").val($("#ratetax_chg").val());
		$("#amd_arrtime").val($("#arrtime").val());
		$("#amd_pictime").val($("#pictime").val());
		$("#amd_sertime").val($("#sertime").val());
		$("#amd_mortea").val($("#mortea").val());
		$("#amd_evetea").val($("#evetea").val());
		$("#amd_add1").val($("#address1").val());
		$("#amd_add2").val($("#address2").val());
		$("#amd_city").val($("#city").val());
		$("#amd_pin").val($("#pin_code").val());
		$("#amd_phone").val($("#phone").val());
		$("#amd_gst").val($("#gst").val());
		
}


function selSessionName(e){
sess=$("#session").val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selAMEndSessDet.php',
			data:{
			sess:sess
			},
			success:function(data){
				/* alert(data); */ 
				 opt=data.split(',');
				 $('#amd_frm').val(opt[0]);
				 $('#amd_to').val(opt[1]);
								 
				/* if(opt[0]==2){
					alert(opt[1]);
					$("#session"+e).val('');
					$("#venue"+e).val('');
					$("#book_date"+e).val('');
					$("#from_time"+e).val('');
					$("#to_time"+e).val('');
					$(".venPROShw1").hide();
					$(".venPROShw").hide();
					$("#venPROShw").show(); 
				} */	
				
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
?>
<link rel="stylesheet" type="text/css" href="<?php echo $home_path;?>/tcal-picker/tcal.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/tcal-picker/tcal.js"></script> 
<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:750px;top:78px;">
<!--<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:1112px;overflow:auto;height:500px;">-->
<h3 id="Userhd"><b>Amendments</b></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_amendment_crea.php" method="post" class="" style="">
	<input name="incLc" id="incLc" type="hidden" style="" value=""/>
	<input type="hidden" name="rowVl" id="rowVl"/>
	<input type="hidden" name="rmomType" id="rmomType"/>
	<input type="hidden" name="adtDate" id="adtDate" value="<?php echo $curDate?>"/>
	<input type="hidden" name="hallbook_id" id="hallbook_id" value=""/>
	<input type="hidden" name="menu_code" id="menu_code" value=""/>
	<!--<input type="hidden" name="hid_menu" id="hid_menu" data-validation="required" class="input validate[required]" value=""/>-->
	<input type="hidden" name="hid_menu" id="hid_menu" class="" value=""/>

<style>
.btnH{
	padding:2px 15px;
}

.btnHV{
	padding:4px 2px;
	/* width:246px;  */
	width:100px;
	
}
</style>
<!-- Start popup -->
<div id="myModal" class="modal fade" role="dialog" style="padding:130px 0 0 0;width:570px;margin:0 auto;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Booking</h4>
		
		<table  class="table " cellpadding="0" cellspacing="0" border="0" style="width:30%;margin:0 0 0 154px;">
		<tr>
		<td style="width:80px;">Name</td>
		<td style="width:80px;"><input type="text" name="searchTxt" id="searchTxt" value="" style="width:120px;border:1px solid #000;" class="textbox fstChUPPRCase" onkeyup="srchTxt();" /></td>
		 </tr>
		 </table>
		 
      </div>
      <div class="modal-body">
	  
<table  class="table " cellpadding="0" cellspacing="0" border="0" style="width:60%;">
<thead class="">
<tr>
	<th style="text-align:left;background-color:#F5F5F5;width:80px;font-size:12px;">FP No#</th>
	<th style="text-align:left;background-color:#F5F5F5;width:80px;font-size:12px;">Booking#</th>
	<th style="text-align:left;background-color:#F5F5F5;width:150px;font-size:12px;">Guest name</th>
	<th style="text-align:left;background-color:#F5F5F5;width:150px;font-size:12px;">Function Date</th>
	<th style="text-align:left;background-color:#F5F5F5;width:150px;font-size:12px;">Click</th>
</tr>	
</thead>	
<tbody id="srcDisHde">
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$cr=explode('/',$rowAC['cur_date']);
$ctt=$cr[2].'-'.$cr[1].'-'.$cr[0];	
/* echo "select * from bq_opfpmenuhdr where bill_status='1' AND vuc_status='' AND str_to_date(bkdate,'%d/%m/%Y') >= '$ctt' order by str_to_date(bkdate,'%d/%m/%Y') ASC"; */
$sqle=mysql_query("select * from bq_opfpmenuhdr where bill_status='1' AND vuc_status='' AND str_to_date(bkdate,'%d/%m/%Y') >= '$ctt' order by str_to_date(bkdate,'%d/%m/%Y') ASC");
$c=0;
while($res=mysql_fetch_array($sqle)){
$c++;
$rw=mysql_fetch_array(mysql_query("select guest_name from bq_hallbooking where booking_no='".$res['bkno']."' and fpno='".$res['fpno']."'"))
?>

<tr>
<td style="width:80px;"><input type="text" name="bookNo[]" id="bookNo<?php echo $c;?>" value="<?php echo $res['fpno'];?>" style="width:80px;border:none;" class="textbox fstChUPPRCase actC" onclick="grpWse();" readonly /></td>
<td style="width:80px;"><input type="text" name="bookNoId[]" id="bookNoId<?php echo $c;?>" value="<?php echo $res['bkno'];?>" style="width:80px;border:none;" class="textbox fstChUPPRCase actC"  readonly /></td>
<td style="width:150px;"><input type="text" name="grp_code[]" id="grp_code<?php echo $c;?>" value="<?php echo $rw['guest_name'];?>" style="width:150px;border:none;" class="textbox fstChUPPRCase" readonly /></td>
<td style="width:150px;"><input type="text" name="grp_code[]" id="grp_code<?php echo $c;?>" value="<?php echo $res['bkdate'];?>" style="width:150px;border:none;" class="textbox fstChUPPRCase" readonly /></td>
<td style="width:150px;border:none;"> <button type="button" onclick="selBQTFBCreat('<?php echo $res['bkno'];?>','<?php echo $res['fpno'];?>');" class="btnH" data-dismiss="modal">Click</button></td>
</tr>
<?php } ?>
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

<tbody id="srcDisShw">	

</tbody>

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

<tbody class="tathead tatbody tableS " id="tblAMenit" style="overflow:auto;display:none;">

</tbody>

<tbody class="tathead tatbody tableS" id="" style="overflow:auto;height:250px;">
<?php 
for($cc=1;$cc<15;$cc++){
?>
<tr id="">
<td style="text-align:center;" class="sourceonVAL">
<select name="amen_itemcode[]" id="amen_itemcode<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;" value="" onchange="itmOthName(<?php echo $cc;?>);">
		<option value="">--Select--</option>
		<?php
		$sqle=mysql_query("select distinct item_code,item_name,itmsub_cat from bq_itemmaster where status='1' AND itmsub_cat IN('oth','bev')");
		while($res=mysql_fetch_array($sqle)){
		?>
		<option value="<?php echo $res['item_code']  ?>" ><?php echo strtoupper($res['item_code'].'('.$res['itmsub_cat'].')'); ?></option>
		<?php } ?>
</select>
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemname[]" id="amen_itemname<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemqty[]" id="amen_itemqty<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:40px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemrate[]" id="amen_itemrate<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:60px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemamount[]" id="amen_itemamount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" /></td>
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










<!-- Start popup -->
<div id="myModal3" class="modal fade" role="dialog" style="padding:130px 0 0 0;width:500px;margin:0 auto;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="" data-dismiss="modal">&times;</button>
        <!--<h4 class="modal-title">Department Instructions</h4>-->
		
		
		 
      </div>
	  
<div class="modal-body">
	  
<table style="float:left;width:70%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table tableS " border="0" >
<thead class="tathead">
<tr>
<td colspan="7"><h3 id="rmTyp" style="background-color:#0073B5;color:#fff;"><b>Open Item</b></h3></td>
</tr>
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:263px;">Item name</th>
	<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:110px;">Sub Menu</th>
	<!--<th width="" style="text-align:center;background-color:#F5F5F5;font-size:12px;width:100px;">Sub Categ</th>-->

</tr>
</thead>
<!--<tbody class="tathead tatbody tableS" id="" style="overflow:auto;height:200px;">
<?php 
for($cc=1;$cc<30;$cc++){
?>
<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="open_itemname[]" id="open_itemname" type="text"  class="textbox fstChUPPRCase expet" style="width:263px;margin:5px 0 0 0px" value="" /></td>
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
</tr>	
<?php 
}
?>	
</tbody>-->

<tbody class="tathead tatbody tableS tatOpen" id="tatOpen" style="overflow:auto;height:200px;">

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

<div style="width:340px;float:left;">	
<table style="float:left;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
<tr>
<td colspan="3"><h3 id="rmTyp" style="background-color:#0073B5;color:#fff;"><b>Actual Details</b></h3></td>
</tr>
<tr>
<td width="" valign="top"><label>Fp.No <em>*</em></label></td>
<td valign="top"><input name="fp_no" id="fp_no" type="text" class="textbox fstChUPPRCase" style="width:210px" data-toggle="modal" data-target="#myModal" onclick="fpBkn();" readonly /></td>
</tr>
<tr>
<td width="" valign="top"><label>Booking No </label></td>
<td valign="top">
<input name="booking_no" id="booking_no" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly />
</td>
</tr>

<tr>
<td width="" valign="top"><label>Guest name</label></td>
<td valign="top"><input name="guest_name" id="guest_name" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" readonly /></td>
</tr>
	<tr>
	<td width="" valign="top"><label>Venue</label></td>
	<td valign="top"><input name="venue" id="venue" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" readonly /></td>
	</tr>
	
	
	<tr>
	<td width="" valign="top"><label>Session</label></td>
	<td valign="top"><input name="session" id="session" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" readonly /></td>
	</tr>
	<tr>
					<td width="" valign="top"><label>Address 1 </label></td>
					<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input req fstChUPPRCase textbox"  style="width:210px"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 2 </label></td>
					<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
			<tr>
				<td width="" valign="top"><label>City <em>*</em></label></td>
				<td width="" valign="top"><input name="city" id="city" type="text" data-validation="required" class="input textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">Zip</span>
				<input name="pin_code" id="pin_code" type="text" class="textbox fstChUPPRCase" onkeypress="return pointNum(event);" maxlength="6" pattern="\d{6}" style="width:80px;margin:0 0 0 11px;" /></td>
				
			</tr>
			<!--<tr>
				<td width="" valign="top"><label>State <em>*</em></label></td>
				<td width="" valign="top"><select name="state" id="state" class="textbox fstChUPPRCase" style="width:85px;">
						<option value="">--Select--</option>
						<?php  $sqlBS=mysql_query("select distinct state_code,state_name from states where status='1'"); ?>
						<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
						<option value="<?php  echo $rowBS['state_code']; ?>"><?php  echo $rowBS['state_name']; ?></option>
						<?php  }  ?>
						</select><span class="spanClr">Country</span><input name="country" id="country" type="text" class="textbox fstChUPPRCase" style="width:82px;margin:0 0 0 -8px;" value="India"/>
				</td>
				
			</tr>-->
			
<tr>
<td width="" valign="top"><label>Phone <em>*</em></label></td>
<td width="" valign="top">
<input name="phone" type="text" id="phone" class="input validate[required,custom[integer],minSize[10],maxSize[10]] textbox fstChUPPRCase" maxlength="10" pattern="\d{10}" style="width:210px"  onkeypress="return pointNum(event);"/>
</td>
</tr>
<tr>
<td width="" valign="top"><label>GST <em>*</em></label></td>
<td width="" valign="top">
<input name="gst" type="text" id="gst" class="input validate[required,custom[integer],minSize[10],maxSize[10]] textbox fstChUPPRCase" maxlength="10" pattern="\d{10}" style="width:210px"  onkeypress="return pointNum(event);"/>
</td>
</tr>
	
	<tr>
		<td width="" valign="top"><label>From</label></td>
		<td valign="top">
		<input type="text" name="fromsess" id="fromsess" class="fstChUPPRCase textbox" style="width:92px" value="" >
		<span class="spanClr">To</span>&nbsp;
		<input name="tosess" id="tosess" type="text" class="textbox fstChUPPRCase" value="" style="width:92px"/>
		</td>
	</tr>
	<tr>
	<td width="" valign="top"><label>Function Type</label></td>
	<td valign="top"><input name="func_type" id="func_type" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" readonly /></td>
	</tr>
	
	<tr>
	<td width="" valign="top"><label>Seating Type</label></td>
	<td valign="top"><input name="seat_type" id="seat_type" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" readonly /></td>
	</tr>
	
	<tr>
	<td width="" valign="top"><label>Function Date</label></td>
	<td valign="top"><input name="func_date" id="func_date" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" readonly /></td>
	</tr>
	
	
	<tr>
		<td width="" valign="top"><label>Grnt.pax</label></td>
		<td valign="top">
		<input type="text" name="grntpax" id="grntpax" class="fstChUPPRCase textbox" style="width:76px" value="" >
		<span class="spanClr">Exp.pax</span>&nbsp;
		<input name="exppax" id="exppax" type="text" class="textbox fstChUPPRCase" value="" style="width:77px"/>
		</td>
	</tr>
	
	<tr>
		<td width="" valign="top"><label>Hall Tax</label></td>
		<td valign="top">
		<input type="text" name="halltax_det" id="halltax_det" data-validation="required" class="input validate[required] fstChUPPRCase textbox halltax_det" style="width:65px" value="" readonly >
		<span class="spanClr">Charge</span>&nbsp;
		<input name="halltax_chg" id="halltax_chg" type="text" class="textbox fstChUPPRCase" style="width:60px;margin:0 0 0 -8px;" value='0' />
		<input name="hallchgnoincl" id="hallchgnoincl" type="hidden" class="textbox fstChUPPRCase" value='0' />
		<input type="checkbox" name="halltaxincl" id="halltaxincl" value="hallincl" class="halltaxincl" style="margin:0 0 0 -8px;" /> <span style="font-size:12px;">  Incl</span>
		</td>
	</tr>
	
	<tr>
		<td width="" valign="top"><label>Rate Tax</label></td>
		<td valign="top">
		<input type="text" name="ratetax_det" id="ratetax_det" data-validation="required" class="input validate[required] fstChUPPRCase textbox ratetax_det" style="width:65px" value="" readonly >
		<span class="spanClr">Rate&nbsp;&nbsp;</span>&nbsp;
		<input name="ratetax_chg" id="ratetax_chg" type="text" class="textbox fstChUPPRCase" style="width:60px;margin:0 0 0 0px;" value='0'/>
		<input name="ratechgnoincl" id="ratechgnoincl" type="hidden" class="textbox fstChUPPRCase" value='0'/>
		
		<input type="checkbox" name="ratetaxincl" id="ratetaxincl" value="rateincl" class="ratetaxincl" style="margin:0 0 0 -8px;"  /> <span style="font-size:12px;">Incl</span>
		</td>
	</tr>
	
	<tr>
		<td width="" valign="top"><label>Time</label></td>
		<td valign="top">
		<input type="text" name="arrtime" id="arrtime" class="fstChUPPRCase textbox" style="width:50px" value="" onkeyup="arrtTime();" >
		<span class="spanClr">Pick</span>&nbsp;
		<input name="pictime" id="pictime" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:0 0 0 -8px;" value='' onkeyup="pictTime();" /><span class="spanClr">Serv</span>&nbsp;
		<input name="sertime" id="sertime" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:0 0 0 -8px;" value='' onkeyup="sertTime();" />
		</td>
	</tr>
	<tr>
		<td width="" valign="top"><label>M.T</label></td>
		<td valign="top">
		<input type="text" name="mortea" id="mortea" class="fstChUPPRCase textbox" style="width:92px" value="" >
		<span class="spanClr">E.T</span>&nbsp;
		<input name="evetea" id="evetea" type="text" class="textbox fstChUPPRCase" value="" style="width:92px"/>
		</td>
	</tr>
		
		
	<tr>
	<td width="" valign="top"><label>Booked by</label></td>
	<td valign="top"><input name="booked_by" id="booked_by" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" readonly /></td>
	</tr>
	
	
	
</table>



</div>


<div class="" style="margin-top:0px;width:50px;float:left;height:300px;">

<table style="float:left;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="" border="0" >
<tr>
<td >&nbsp;</td>
</tr>
<tr>
<td >&nbsp;</td>
</tr>
<tr>
<td >&nbsp;</td>
</tr>
<tr>
<td >&nbsp;</td>
</tr>
<tr>
<td >&nbsp;</td>
</tr>
<tr>
<td width="145" valign="top"><img name="imgchk" id="imgchk" src="<?php echo $home_path; ?>/images/arrow_right.png" class="empPerSTRt" onClick="copybillToShipPERSONAL();" style="margin:0 0 0 20px;width:25px;height:25px;" /></td>
</tr>
	
</table>


</div>







<div class="" style="margin-top:0px;width:337px;float:right;height:300px;">
	
<table style="float:left;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
<tr>
<td colspan="3"><h3 id="rmTyp" style="background-color:#0073B5;color:#fff;"><b>Amendments</b></h3></td>
</tr>

		<tr>
		<td width="" valign="top"><label>Venue</label></td>
		<td valign="top">
	<?php $sqlBS=mysql_query("select distinct venue_code,venue_desc from bq_venue where status='1'"); ?>
	<select name="amd_ven" id="amd_ven" class="fstChUPPRCase" style="width:210px;font-size:12px;" >
	<option value="">--Select--</option>
	<?php  while($rowBS=mysql_fetch_array($sqlBS)) { ?> 
	<option value="<?php  echo $rowBS['venue_code']; ?>"><?php  echo $rowBS['venue_desc'];?></option>
	<?php } ?>
	</select>
		</td>
		</tr>
		
		
		<tr>
		<td width="" valign="top"><label>Session</label></td>
		<td valign="top">
		<?php $sqlBS=mysql_query("select distinct sess_code,sess_name from bqt_session where status='1'"); ?>
		<select name="amd_sess" id="amd_sess" class="fstChUPPRCase" style="width:210px;float:left;font-size:12px;" onChange="selSessionName('<?php echo $cc;?>');">
		<option value="">--Select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
		<option value="<?php  echo $rowBS['sess_code']; ?>"><?php  echo $rowBS['sess_name'];?></option>
		<?php  }  ?>
		</select>
		</td>
		</tr>
		
		<tr>
					<td width="" valign="top"><label>Address 1 </label></td>
					<td valign="top"><input name="amd_add1" id="amd_add1" type="text" data-validation="required" class="input req fstChUPPRCase textbox"  style="width:210px"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 2 </label></td>
					<td valign="top"><input name="amd_add2" id="amd_add2" type="text" class="textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
			<tr>
				<td width="" valign="top"><label>City <em>*</em></label></td>
				<td width="" valign="top"><input name="amd_city" id="amd_city" type="text" data-validation="required" class="input textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">Zip</span>
				<input name="amd_pin" id="amd_pin" type="text" class="textbox fstChUPPRCase" onkeypress="return pointNum(event);" maxlength="6" pattern="\d{6}" style="width:80px;margin:0 0 0 11px;" /></td>
				
			</tr>
			<!--<tr>
				<td width="" valign="top"><label>State <em>*</em></label></td>
				<td width="" valign="top"><select name="state" id="state" class="textbox fstChUPPRCase" style="width:85px;">
						<option value="">--Select--</option>
						<?php  $sqlBS=mysql_query("select distinct state_code,state_name from states where status='1'"); ?>
						<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
						<option value="<?php  echo $rowBS['state_code']; ?>"><?php  echo $rowBS['state_name']; ?></option>
						<?php  }  ?>
						</select><span class="spanClr">Country</span><input name="country" id="country" type="text" class="textbox fstChUPPRCase" style="width:82px;margin:0 0 0 -8px;" value="India"/>
				</td>
				
			</tr>-->
			
<tr>
<td width="" valign="top"><label>Phone <em>*</em></label></td>
<td width="" valign="top">
<input name="amd_phone" type="text" id="amd_phone" class="input validate[required,custom[integer],minSize[10],maxSize[10]] textbox fstChUPPRCase" maxlength="10" pattern="\d{10}" style="width:210px"  onkeypress="return pointNum(event);"/>
</td>
</tr>
<tr>
<td width="" valign="top"><label>GST <em>*</em></label></td>
<td width="" valign="top">
<input name="amd_gst" type="text" id="amd_gst" class="input validate[required] textbox fstChUPPRCase" style="width:210px"  onkeypress="return pointNum(event);"/>
</td>
</tr>
		
		<tr>
			<td width="" valign="top"><label>From</label></td>
			<td valign="top">
			<input type="text" name="amd_frm" id="amd_frm" class="fstChUPPRCase textbox" style="width:92px" value="" >
			<span class="spanClr">To</span>&nbsp;
			<input name="amd_to" id="amd_to" type="text" class="textbox fstChUPPRCase" value="" style="width:92px"/>
			</td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Function Type</label></td>
		<td valign="top">
		<?php $sqlBS=mysql_query("select distinct func_code,func_desc from bq_function where status='1'"); ?>
		<select name="amd_func" id="amd_func" class="fstChUPPRCase" style="width:210px;float:left;font-size:12px;" onChange="selFunctionName('<?php echo $cc;?>');">
		<option value="">--Select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
		<option value="<?php  echo $rowBS['func_code']; ?>"><?php  echo $rowBS['func_desc'];?></option>
		<?php  }  ?>
		</select>
		
		</td>
		</tr>
		
		<tr>
		<td width="" valign="top"><label>Seating Type</label></td>
		<td valign="top">
		<?php $sqlBS=mysql_query("select distinct seat_code,seat_desc from bq_seating where status='1'"); ?>
		<select name="amd_seat" id="amd_seat" class="fstChUPPRCase" style="width:210px;float:left;font-size:12px;" onChange="selSeatingName('<?php echo $cc;?>');">
		<option value="" >--select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
		<option value="<?php  echo $rowBS['seat_code']; ?>"><?php  echo $rowBS['seat_desc'];?></option>
		<?php  }  ?>
		</select>
		
		</td>
		</tr>
		
		<tr>
		<td width="" valign="top"><label>Function Date</label></td>
		<td valign="top"><input name="amd_fundt" id="amd_fundt" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" readonly /></td>
		</tr>
		
		<tr>
			<td width="" valign="top"><label>Grnt.pax</label></td>
			<td valign="top">
			<input type="text" name="amd_grpx" id="amd_grpx" class="fstChUPPRCase textbox" style="width:76px" value="" >
			<span class="spanClr">Exp.pax</span>&nbsp;
			<input name="amd_expx" id="amd_expx" type="text" class="textbox fstChUPPRCase" value="" style="width:77px"/>
			</td>
		</tr>
		
		<tr>
			<td width="" valign="top"><label>Hall Tax</label></td>
			<td valign="top">
			<input type="text" name="amd_halldet" id="amd_halldet" data-validation="required" class="input validate[required] fstChUPPRCase textbox amd_halldet" style="width:65px" value="" readonly >
			<span class="spanClr">Charge</span>&nbsp;
			<input name="amd_hallchg" id="amd_hallchg" type="text" class="textbox fstChUPPRCase" style="width:60px;margin:0 0 0 -8px;" value='0' />
			<input name="amd_hallincl" id="amd_hallincl" type="hidden" class="textbox fstChUPPRCase" value='0' />
			<input type="checkbox" name="amd_halltxincl" id="amd_halltxincl" value="hallincl" class="amd_halltxincl" style="margin:0 0 0 -8px;" /> <span style="font-size:12px;">Incl</span>
			</td>
		</tr>
		
		<tr>
			<td width="" valign="top"><label>Rate Tax</label></td>
			<td valign="top">
			<input type="text" name="amd_ratetax_det" id="amd_ratetax_det" data-validation="required" class="input validate[required] fstChUPPRCase textbox amd_ratetax_det" style="width:65px" value="" readonly >
			<span class="spanClr">Rate&nbsp;&nbsp;</span>&nbsp;
			<input name="amd_ratetax_chg" id="amd_ratetax_chg" type="text" class="textbox fstChUPPRCase" style="width:60px;margin:0 0 0 0px;" value='0'/>
			<input name="amd_ratechgnoincl" id="amd_ratechgnoincl" type="hidden" class="textbox fstChUPPRCase" value='0'/>
			<input type="checkbox" name="amd_ratetaxincl" id="amd_ratetaxincl" value="amd_rateincl" class="amd_ratetaxincl" style="margin:0 0 0 -8px;"  /> <span style="font-size:12px;">Incl</span>
			</td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Remarks</label></td>
		<td valign="top"><textarea cols="34" rows="1" name="remarks" id="remarks" value="" style="text-transform:uppercase;font-size:12px;"></textarea></td>
	</tr>
	
	<tr>
		<td width="" valign="top"><label>Sigh Board</label></td>
		<td valign="top"><textarea cols="34" rows="1" name="sign_board" id="sign_board" value="" style="text-transform:uppercase;font-size:12px;"></textarea></td>
	</tr>
	<tr>
		<td width="" valign="top"><label>Time</label></td>
		<td valign="top">
		<input type="text" name="amd_arrtime" id="amd_arrtime" class="fstChUPPRCase textbox" style="width:50px" value="" onkeyup="arrtTime();" >
		<span class="spanClr">Pick</span>&nbsp;
		<input name="amd_pictime" id="amd_pictime" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:0 0 0 -8px;" value='' onkeyup="pictTime();" /><span class="spanClr">Serv</span>&nbsp;
		<input name="amd_sertime" id="amd_sertime" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:0 0 0 -8px;" value='' onkeyup="sertTime();" />
		</td>
	</tr>
	<tr>
		<td width="" valign="top"><label>M.T</label></td>
		<td valign="top">
		<input type="text" name="amd_mortea" id="amd_mortea" class="fstChUPPRCase textbox" style="width:92px" value="" >
		<span class="spanClr">E.T</span>&nbsp;
		<input name="amd_evetea" id="amd_evetea" type="text" class="textbox fstChUPPRCase" value="" style="width:92px"/>
		</td>
	</tr>
	<tr>
		<td width="" valign="top"><label>Amended by</label></td>
		<td valign="top"><input name="amend_by" id="amend_by" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" /></td>
	</tr>

	<tr>
		<td width="" valign="top"><label>Authorised by</label></td>
		<td valign="top"><input name="author_by" id="author_by" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:210px" /></td>
	</tr>
	
</table>

<table style="float:right;margin:5px 0 0 0;">
<tr>
<!--<td>
<button type="button" id="billsbt" name="billsbt" class="btnHV" style="" data-toggle="modal" data-target="#myModal3" onclick="openItmBtn();" >&nbsp;&nbsp;<span class="btnUndLine">O</span>pen Item</button>
</td>-->

<td>
<button type="button" id="submit" class="btnHV bnkSbt frstChr submit" style="" data-toggle="modal" data-target="#myModal1" onclick="deptINstBtn();" >&nbsp;&nbsp;<span class="btnUndLine" style="width:200px;">O</span>ther inst.</button>
</td>

<!--<td>
<button type="button" id="billsbt" name="billsbt" class="btnHV" style="" data-toggle="modal" data-target="#myModal2" onclick="AmeniINstBtn();" >&nbsp;&nbsp;<span class="btnUndLine">A</span>menities</button>
</td>-->
</tr>

</table>


</div>
		
<div class="menuDetShw" style="height:300px;overflow:auto;margin:10px 0 0 0;display:none;">

</div>		

<table style="border-left:1px solid #ddd;margin: 10px 0 0 0;" class="table">
	<tr>
		<td>	
	<div class="col-md-12  responsive nowrap " style=" padding-left:3px;">
		<button type="submit" id="send" name="send" class="btn btn-primary btn-sm btn-responsive" style="" onclick="return checkformSubmit();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-amendments.php?fromdate=<?php echo $rowAC['cur_date'];?>&todate=<?php echo $rowAC['cur_date'];?>&val="><button type="button" id="update" class="btn btn-primary btn-sm btn-responsive" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
		
		<!--<a href="#" target="_blank"><button type="button" id="hallsts" class="butExample" style="" onclick="hall_sts()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">U</span>pdate</button></a>-->
		
			<button type="reset" id="rest" class="btn btn-primary btn-sm btn-responsive" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
		<a href="<?php echo $home_path; ?>/transaction/frontdesk/view-amendments.php?fromdate=<?php echo $rowAC['cur_date'];?>&todate=<?php echo $rowAC['cur_date'];?>&val="><button type="button" id="exit" name="exit" class="btn btn-primary btn-sm btn-responsive" style="" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
		
	</div>
	</td>
	</tr>
</table>

</div>




	
				

			
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
    margin-left: -3px;
    padding: 4px 66px;
}
</style>

		
	
	
	
</div>
	</div>
	</div>
	</form>	
	<?php /* include("../../footer.php"); */ ?>
</body>
</html>