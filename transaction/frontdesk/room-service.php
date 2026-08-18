<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");
/* include("../../menu.php"); */
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

<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
 <!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	
		$("[rel=tooltip]").tooltip();
	$("[rel=popover]").popover({trigger:'click',html:true});
	
		function clickFirstRow(){
		 firstSpn=$("#firstRowSpn").html();
		 if(firstSpn=='Vacant'){
		 
		 }
	}
	
	
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
  jQuery("#taxTypes").validationEngine();
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(5000);
	
	
	

});

 shortcut.add("Ctrl+S",function() { 
	 $('#taxTypes').attr('action', '../../action/add_tax_type.php');  
	 $('#taxTypes').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_define_tax.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#taxTypes').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});

function checkTaxCode(){
	taxCode=$('#tax_code').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatTaxCode.php',
			data:{
			taxCode:taxCode
			},
			success:function(data){
				  /* alert(data); */  
				if(data==1){
					alert('Tax Code already exists.');
					/* $('#msgFoprop').html('* Tax Code already exists.'); */
					$('#tax_code').val('');
				}
				else{
					$('#msgFoprop').html('');
				}
			}
	});
}

function checkTaxCodeDesc(){
	taxDesc=$('#description').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatTaxCodeDesc.php',
			data:{
			taxDesc:taxDesc
			},
			success:function(data){
				/*  alert(data); */ 
				if(data==1){
					alert('Tax Description already exists.');
					$('#description').val('');
				}
				else{
					$('#msgFoprop').html('');
				}
			}
	});
}

function selTargetRoom(){
	roomNo=$('#room_no').val();
	tarRoom=$('#target_room').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selTargetRoomType.php',
			data:{
			roomNo:roomNo,
			tarRoom:tarRoom
			},
			success:function(data){
				   /* alert(data); */
				   $('#tarRm_type').val(data);
				   if(data==1){
					 alert("Target Room already exists.");  
					  $('#tarRm_type').val('');
					   $('#target_room').val('');
				   }
				   if(data==2){
					 alert("Check the room status.");  
					  $('#tarRm_type').val('');
					   $('#target_room').val('');
				   }
				   if(data==3){
					 alert("Select the source room.");  
					 $('#tarRm_type').val('');
					 $('#target_room').val('');
				   }
			}
	});
}

function getRoomNoChge(){
	roomNo=$('#room_no').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selChangeRoomType.php',
			data:{
			roomNo:roomNo
			},
			success:function(data){
				 /*  alert(data); */
				  opt=data.split(',');
			$('#croom_no').val(opt[0]);
			$('#croom_type').val(opt[1]);
			$('#cgst_name').val(opt[2]);
			$('#creg_num').val(opt[3]);
				  
			}
	});
}

function ckChangeRmSubmt(){
/*  $("#taxTypes").attr("action","<?php echo $home_path; ?>/transaction/frontdesk/roomservice-bill.php");
 $("#taxTypes").submit();  */
 roNo=$('#rom_no').val();
 rmPx=$('#rm_px').val();
document.location.href="<?php echo $home_path; ?>/transaction/frontdesk/roomservice-bill.php?rmS=<?php echo $_GET['rmS'];?>&ouSEs=<?php echo $_GET['ouSEs'];?>&otDt=<?php echo $_GET['otDt'];?>&roNo="+roNo+"&rmPx="+rmPx;
	roomNo=$('#room_no').val();
	crType=$('#croom_type').val();
	tarRmtype=$('#tarRm_type').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selChangeRmSubmit.php',
			data:{
			crType:crType,
			tarRmtype:tarRmtype
			},
			success:function(data){
				   if(data==1){
					   r=confirm("Do you want change the room with same tariff?");
					   if(r==true){
						    $('#taxTypes').attr('action', '../../action/add_change_room.php');  
							$('#taxTypes').submit();
					   }else{
						   
					   }
					   
				   }
					if(data==2){
						r=confirm("Target room type is different from Source Room Type. Do you want to continue?");
					   if(r==true){
						    rr=confirm("Do you want to continue with same tariff?");
							   if(rr==true){
									$('#taxTypes').attr('action', '../../action/add_change_room.php');
									$('#taxTypes').submit();
							   }else{
								   $('#taxTypes').attr('action', '../../action/add_change_room.php');
									$('#taxTypes').submit();
							   }
						    
					   }else{
						   
					   } 
				   }
			}
	}); 
	
}

function clickRoomService(rm,rt,px){
	/* alert(rm); */
	$('#rom_no').val(rm);
	$('#rm_px').val(px);
}
</script> 
<body class="bgBODY">

	<!--<div class="container" >-->
	
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
#viewcustomer { /* width:1000px; */ float:left;margin:0px 0 0 0;}
#viewcustomer .table { /* width:1000px; */ float:left; margin:0px 0 0 0; border:solid 1px #f1f1f1;font-size:12px;}
#viewcustomer .table .heading { background:#bfbfbf;}
#viewcustomer .table .heading p { color:#1c1c1c; font-size:12px; padding:8px 15px; font-weight:bold;}
#viewcustomer .table .detail { background:#fff;}
#viewcustomer .table .detail p { color:#373737; font-size:12px; padding:10px 15px; font-weight:normal;}
#viewcustomer .table .detail p b { color:#157cab;}
#viewcustomer .table .detail p a { color:#157cab;}
#viewcustomer .table .detail p span { color:#157cab;}
#viewcustomer .table .borleftdark { border-left:solid 1px #878787;}
#viewcustomer .table .borleftlight { border-left:solid 1px #f1f1f1;}
#viewcustomer .table .borbottomlight { border-bottom:solid 1px #f1f1f1;}

.style-one {
  border: 1px solid #ffffff;
  width: 100%;
}

.DashbrdDiv{width:773px;margin:7px 0 0 -12px;height:545px;border:1px solid #d5d5d5;background-color:#F4F4F4;
}

/*------------------------------------------------------------------
[6. Widget / .widget]
*/

.widget {
	
	position: relative;
	clear: both;
	
	width: auto;
	
	margin-bottom: 2em;
		
	overflow: hidden;
}
	
.widget-header {
	
	position: relative;
	
	height: 40px;
	line-height: 40px;
	
	background: #f9f6f1;
	background:-moz-linear-gradient(top, #f9f6f1 0%, #f2efea 100%); /* FF3.6+ */
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#f9f6f1), color-stop(100%,#f2efea)); /* Chrome,Safari4+ */
	background:-webkit-linear-gradient(top, #f9f6f1 0%,#f2efea 100%); /* Chrome10+,Safari5.1+ */
	background:-o-linear-gradient(top, #f9f6f1 0%,#f2efea 100%); /* Opera11.10+ */
	background:-ms-linear-gradient(top, #f9f6f1 0%,#f2efea 100%); /* IE10+ */
	background:linear-gradient(top, #f9f6f1 0%,#f2efea 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f6f1', endColorstr='#f2efea');
	-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f6f1', endColorstr='#f2efea')";
	
	
	border: 1px solid #d6d6d6;
	
	
	-webkit-background-clip: padding-box;
	text-align:center;
}	
	
	.widget-header h3 {
		
		position: relative;
		top: 2px;
		left: 10px;
		
		display: inline-block;
		margin-right: 3em;
		
		font-size: 14px;
		font-weight: 800;
		color: #525252;
		line-height: 18px;
		
		text-shadow: 1px 1px 2px rgba(255,255,255,.5);
	}
	
		.widget-header [class^="icon-"], .widget-header [class*=" icon-"] {
			
			display: inline-block;
			margin-left: 13px;
			margin-right: -2px;
			
			font-size: 16px;
			color: #555;
			vertical-align: middle;
			
			
			
		}




.widget-content {
	padding: 20px 15px 15px;
	
	background: #FFF;
	
	
	border: 1px solid #D5D5D5;
	
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}

.widget-header+.widget-content {
	border-top: none;
	
	-webkit-border-top-left-radius: 0;
	-webkit-border-top-right-radius: 0;
	-moz-border-radius-topleft: 0;
	-moz-border-radius-topright: 0;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}

.widget-nopad .widget-content {
	padding: 0;
}

/* Widget Content Clearfix */	
.widget-content:before,
.widget-content:after {
    content:"";
    display:table;
}

.widget-content:after {
    clear:both;
}

/* For IE 6/7 (trigger hasLayout) */
.widget-content {
    zoom:1;
}

/* Widget Table */

.widget-table .widget-content {
	padding: 0;
}

.widget-table .table {
	margin-bottom: 0;
	
	border: none;
}

.widget-table .table tr td:first-child {
	border-left: none;
}

.widget-table .table tr th:first-child {
	border-left: none;
}


/* Widget Plain */

.widget-plain {
	
	background: transparent;
	
	border: none;
}

.widget-plain .widget-content {
	padding: 0;
	
	background: transparent;
	
	border: none;
}


/* Widget Box */

.widget-box {	
	
}

.widget-box .widget-content {	
	background: #E3E3E3;	
	background: #FFF;
}


#dashBrdTbl {
    margin: 65px 0 0 28px;
}

.dashMasImg {
    height: 70px;
    text-align: center;
    width: 70px;
}

.tbl,td{
	padding:0 22px 0 22px;
	/* background-color:#D4D4CC; */
} 

.bgbox
{
background: url(images/box.jpg) no-repeat; 
background-size:260px 250px;
//background:url(images/box.jpg);
}

.login:before {
  content: '';
  position: absolute;
  /* top: -8px; */
  right: -8px;
  bottom: -8px;
  left: -8px;
 /*  z-index: -1; */
  background: rgba(0, 0, 0, 0.08);
  border-radius: 4px;
}
.login h1 {
  margin: -20px -20px 21px;
  line-height: 40px;
  font-size: 15px;
  font-weight: bold;
  color: #555;
  text-align: center;
  text-shadow: 0 1px white;
  background: #f3f3f3;
  border-bottom: 1px solid #cfcfcf;
  border-radius: 3px 3px 0 0;
  background-image: -webkit-linear-gradient(top, whiteffd, #eef2f5);
  background-image: -moz-linear-gradient(top, whiteffd, #eef2f5);
  background-image: -o-linear-gradient(top, whiteffd, #eef2f5);
  background-image: linear-gradient(to bottom, whiteffd, #eef2f5);
  -webkit-box-shadow: 0 1px whitesmoke;
  box-shadow: 0 1px whitesmoke;
}

.dashMasLbl {
    color: #000;
    font: 12px/1.5em Arial,Helvetica,sans-serif;
    margin: 8px 0 0;
    text-align: center;
    width: 112px;
}

/*------------------------------------------------------------------
.wrapper {
    width: 250px;
}

.btnUndLine {
    text-decoration: underline #00008b;
}
</style>

<style>
.spanClr{
	color: #5b503b;
    display: block;
    float: left;
    font-size: 12px;
    font-weight: normal;
    padding: 2px 9px 0 5px;
		
}
.buttExample {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 52px;
}


.buton:hover {
/* position: absolute; */
   /*  background: url(images/pl.png) center center no-repeat rgba(51, 51, 51, 0.6) ; */
   /*  background: url(images/pl.png) center center no-repeat  ;  */
   /*  border-radius: 8px; */
     /* background-size: 20px 20px; */
    /*height: 50px;
    width: 80px;
	padding:21px 0 0 0;
    margin: -18px 0 0 -40px; */
	opacity: 0.4;
	/* box-shadow: 10px 10px 0px 0px rgba(0,0,0,0.75); */
}
/* .tree-menu .closed > a {
    background-image: url("../../img/icon-expand.gif");
} */
.treeMnu{
    background-image: url("../../images/icon-expand.gif");
}
</style>
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');

/* if(isset($_GET['regNum'])){ */
$sqlGr=mysql_query("select * from guest_register where guestreg_id='1'");
$rowGr=mysql_fetch_array($sqlGr);
/* } */
?>		
<form action="#" name="taxTypes" id="taxTypes">

<div class="span6" style="float:left;font-size:12px;margin:10px 10px 0 5px;height:545px;border: 1px solid #d5d5d5;width: 230px;">
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/ie.css"/>

<script type="text/javascript" src="<?php echo $home_path; ?>/tree-menu/lib/jquery.ntm/js/jquery.ntm.js"></script>
<link rel="stylesheet" href="<?php echo $home_path; ?>/tree-menu/css/style.css" />
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $home_path; ?>/tree-menu/lib/jquery.ntm/themes/default/css/theme.css" />
<script type="text/javascript">
	$(document).ready(function() {
		$('.demo').ntm();
	});
</script>
<?php 
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$toDate=$adtCurDt;
$sqlAR=mysql_query("select count(distinct resv_no) AS todayRes from room_booking where arrival_date='$adtCurDt' AND resv_status='1'"); 
$rowAr=mysql_fetch_array($sqlAR);
?>
        <div class="wrapper dsWrpwth">
          <!--<div class="tree-menu demo" id="tree-menu" style="overflow:auto;height:545px;width:236px;">-->
          <div class="tree-menu demo" id="tree-menu" style="overflow:auto;height:513px;border:1px solid #888888;/* box-shadow:2px 3px 10px 1px; */">
		  <!--<div style="font-size:15px;color:#7B0E0E;font-weight:bold;padding:6px;"><?php /* echo date('d/m/Y'); */ ?></div>-->
		  <div style="font-size:15px;color:#7B0E0E;font-weight:bold;padding:6px;text-align:center;">Today's Status</div>
		<ul>
<?php 
/* $toDate=date('d/m/Y'); */
/* $toDate=$adtCurDt; */
/* echo "select count(distinct gr.guestreg_id) AS todayDep from guest_register gr,guest_trans gt where gr.departure_date='".$toDate."' AND gr.guestreg_id=gt.reg_num AND gr.bill_status='1'"; */	
$sqlAR=mysql_query("select count(distinct room_no) AS todayDep from guest_register where departure_date='".$toDate."' AND bill_status='1'"); 
$rowAr=mysql_fetch_array($sqlAR);
?>		
			<li><a href="#" style="">In House <span style="font-size:15px;color:blue;"><?php /* echo $rowAr['todayDep']; */?></span></a>
		<ul>
		<li style="color:#af0a05;background-color:#fff;"><table class="table dsWrpTbl" >
		<tr><td style="width:35px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;">Total Pax</td><td style="width:30px;background-color:#C3C3C3;color:#000;">Adult</td><td style="width:50px;background-color:#C3C3C3;color:#000;">Child</td>
		<!--<td style="width:15px;background-color:#C3C3C3;color:#000;">Amount</td>-->
		</tr>
<?php 
	/* $sqlR=mysql_query("select SUM(pax)AS px,SUM(adult_pax)AS adTpx,SUM(child_pax)AS chTpx from guest_register where bill_status='1' group by room_no");  */
	$sqlR=mysql_query("select * from guest_register where bill_status='1' group by room_no"); 
	$pax=0;$adTpax=0;$chDpax=0;
	while($rowR=mysql_fetch_array($sqlR)){
		$pax+=floatval($rowR['pax']);
		$adTpax+=floatval($rowR['adult_pax']);
		$chDpax+=floatval($rowR['child_pax']);
		
	}

	$sqlRl=mysql_query("select count(meal_plan)AS Mpln from guest_register where bill_status='1' AND meal_plan='EP' group by room_no");  
	$rowRl=mysql_fetch_array($sqlRl);

	$sqlRc=mysql_query("select count(meal_plan)AS cMpln from guest_register where bill_status='1' AND meal_plan='CP' group by room_no");  
	$rowRc=mysql_fetch_array($sqlRc);	
	if($rowRc['cMpln']!=''){
		$cMpln=$rowRc['cMpln'];
	}else{
		$cMpln=0;
	}
	
?>
<tr><td style="width:15px;margin:0 0 0 5px;"><?php echo $pax; ?></td><td style="width:60px;"><?php echo $adTpax; ?></td><td style="width:50px;"><?php echo $chDpax; ?></td>
<!--<td style="width:15px;"><?php /*echo $rowT['blAMt'];*/ ?></td>-->
</tr>
			<?php ?>
			</table></li>
			<li style="color:#af0a05;background-color:#fff;"><table class="table dsWrpTbl" >
		<tr><td style="width:35px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;">Plan</td><td style="width:30px;background-color:#C3C3C3;color:#000;">EP</td><td style="width:50px;background-color:#C3C3C3;color:#000;">CP</td>
		<!--<td style="width:15px;background-color:#C3C3C3;color:#000;">Amount</td>-->
		</tr>
		
		<tr><td style="width:15px;margin:0 0 0 5px;"><?php  echo 'Meal Plan';  ?></td><td style="width:60px;"><?php echo $rowRl['Mpln']; ?></td><td style="width:50px;"><?php echo $cMpln; ?></td></tr>
		  <?php 
			
			$sqlAR=mysql_query("select distinct room_no from guest_register where departure_date='".$toDate."' AND bill_status='1'"); 
			while($rowAr=mysql_fetch_array($sqlAR)){
				$sqlGR=mysql_query("select * from guest_register where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowGr=mysql_fetch_array($sqlGR);
				
				$sqlT=mysql_query("select SUM(debit)+SUM(tax_val)-SUM(credit)AS blAMt from guest_trans where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowT=mysql_fetch_array($sqlT);
			?>
				<!--<tr><td style="width:15px;margin:0 0 0 5px;"><?php echo $rowAr['room_no'];  ?></td><td style="width:60px;"><?php echo $rowRl['Mpln']; ?></td><td style="width:50px;"><?php echo $cMpln; ?></td></tr>-->
			<?php } ?>
			</table></li>
			</ul>
			  </li>
			</ul>
			
			
			
			
            <ul>
                <li><a href="#" style="">Expected Arrivals&nbsp;<span style="font-size:15px;color:blue;"><?php echo $rowAr['todayRes'];?></span> </a>
				<ul>
				<li style="color:#af0a05;background-color:#000;"><table class="table dsWrpTbl" ><tr><td style="width:15px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;">Resv#</td><td style="width:60px;background-color:#C3C3C3;color:#000;">Gst Name</td><td style="width:50px;background-color:#C3C3C3;color:#000;">Type</td><td style="width:15px;background-color:#C3C3C3;color:#000;">Pax</td></tr>
<?php


/*  $dat=date('d/m/Y');  */
$dat=$adtCurDt;	
		
$sqlR=mysql_query("select * from room_booking where arrival_date='$dat' AND resv_status='1'");
while($rowR=mysql_fetch_array($sqlR)){ 
if($rowR['single']!='0'){
	$rmVal=$rowR['single'];
}else if($rowR['doubl']!='0'){
	$rmVal=$rowR['doubl'];
}else if($rowR['tripple']!='0'){
	$rmVal=$rowR['tripple'];
}else if($rowR['quad']!='0'){
	$rmVal=$rowR['quad'];
}
if($rowR['exp']!='0'){
	$rmExVal=$rowR['exp'];
	$romVal=$rmVal+$rmExVal;
}else{
	$romVal=$rmVal;
}

?>
		<tr><td style="width:15px;margin:0 0 0 5px;"><?php echo $rowR['resv_no']; ?></td><td style="width:60px;"><?php echo ucfirst($rowR['guest_name']); ?></td><td style="width:50px;"><?php echo $rowR['room_type']; ?></td><td style="width:15px;"><?php echo $romVal; ?></td></tr>
<?php } ?>
</table></li>
 <!--<li><a href="#" style="color:#af0a05;background-color:#fff;font-weight:bold;">Total Wages&nbsp;&nbsp;</a></li>-->
				  </ul>
			  </li>
			  
			</ul>
		 		  
			<ul>
<?php 
/* $toDate=date('d/m/Y'); */
$toDate=$adtCurDt;
/* echo "select count(distinct gr.guestreg_id) AS todayDep from guest_register gr,guest_trans gt where gr.departure_date='".$toDate."' AND gr.guestreg_id=gt.reg_num AND gr.bill_status='1'"; */	
$sqlAR=mysql_query("select count(distinct room_no) AS todayDep from guest_register where departure_date='".$toDate."' AND bill_status='1'"); 
$rowAr=mysql_fetch_array($sqlAR);
?>		
			<li><a href="#">Expected Departure <span style="font-size:15px;color:blue;"><?php echo $rowAr['todayDep'];?></span></a>
		<ul>
		<li style="color:#af0a05;background-color:#fff;"><table class="table dsWrpTbl" ><tr><td style="width:15px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;">Room#</td><td style="width:60px;background-color:#C3C3C3;color:#000;">Gst Name</td><td style="width:50px;background-color:#C3C3C3;color:#000;">Plan</td><td style="width:15px;background-color:#C3C3C3;color:#000;">Amount</td></tr>
		  <?php 
			
			$sqlAR=mysql_query("select distinct room_no from guest_register where departure_date='".$toDate."' AND bill_status='1'"); 
			while($rowAr=mysql_fetch_array($sqlAR)){
				$sqlGR=mysql_query("select * from guest_register where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowGr=mysql_fetch_array($sqlGR);
				
				$sqlT=mysql_query("select SUM(debit)+SUM(tax_val)-SUM(credit)AS blAMt from guest_trans where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowT=mysql_fetch_array($sqlT);
			?>
				<tr><td style="width:15px;margin:0 0 0 5px;"><?php echo $rowAr['room_no']; ?></td><td style="width:60px;"><?php echo ucfirst($rowGr['guest_name']); ?></td><td style="width:50px;"><?php echo $rowGr['meal_plan']; ?></td><td style="width:15px;"><?php echo $rowT['blAMt']; ?></td></tr>
			<?php } ?>
			</table></li>
			</ul>
			  </li>
			</ul>
			
			<ul>
<?php 
/* $toDate=date('d/m/Y'); */
$toDate=$adtCurDt;
$sqlAR=mysql_query("select count(distinct gr.guestreg_id) AS todayArri from guest_register gr,guest_trans gt where arrival_date='".$toDate."' AND gr.guestreg_id=gt.reg_num ");
$rowAr=mysql_fetch_array($sqlAR);
?>			
<li><a href="#">Today's Arrival <span style="font-size:15px;color:blue;"><?php echo $rowAr['todayArri'];?></span></a>
	<ul>
	<li style="color:#af0a05;background-color:#fff;"><table class="table dsWrpTbl"><tr><td style="width:15px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;">Room#</td><td style="width:60px;background-color:#C3C3C3;color:#000;">Gst Name</td><td style="width:50px;background-color:#C3C3C3;color:#000;">Pax</td><td style="width:15px;background-color:#C3C3C3;color:#000;">Type</td></tr>
 <?php 
			/* $toDate=date('d/m/Y'); */
			$sqlAR=mysql_query("select distinct room_no from guest_register where arrival_date='".$toDate."'"); 
			while($rowAr=mysql_fetch_array($sqlAR)){
				$sqlGR=mysql_query("select * from guest_register where room_no='".$rowAr['room_no']."'"); 
				$rowGr=mysql_fetch_array($sqlGR);
				
				$sqlT=mysql_query("select SUM(debit)+SUM(tax_val)-SUM(credit)AS blAMt from guest_trans where room_no='".$rowAr['room_no']."' AND bill_status='1'"); 
				$rowT=mysql_fetch_array($sqlT);
			?>
				<tr><td style="width:15px;margin:0 0 0 5px;"><?php echo $rowAr['room_no']; ?></td><td style="width:60px;"><?php echo ucfirst($rowGr['guest_name']); ?></td><td style="width:50px;"><?php echo $rowGr['pax']; ?></td><td style="width:15px;"><?php echo $rowGr['room_type']; ?></td></tr>
			<?php } ?>
			</table></li>
		</ul>
	</li>
	</ul>
<ul>
<?php 
/* $toDate=date('d/m/Y'); */
$toDate=$adtCurDt;
$sqlDp=mysql_query("select count(distinct bh.billhead_id) AS todayDept from bill_header bh,bill_detail bd where bh.bill_date='".$toDate."' AND bh.bill_no=bd.bill_no AND bh.settleflag='2'");
$rowDp=mysql_fetch_array($sqlDp);
?>
<li><a href="#">Today's Departure <span style="font-size:15px;color:blue;"><?php echo $rowDp['todayDept'];?></span></a>
<ul>
<li style="color:#af0a05;background-color:#fff;"><table class="table dsWrpTbl"><tr><td style="width:15px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;">Room#</td><td style="width:60px;background-color:#C3C3C3;color:#000;">Gst Name</td><td style="width:50px;background-color:#C3C3C3;color:#000;">Bill #</td><td style="width:15px;background-color:#C3C3C3;color:#000;">Amount</td></tr>
	<?php 
	/* $toDate=date('d/m/Y');  */
	/* $toDate=date('23/08/2016'); */
	$sqlbh=mysql_query("select distinct room_no from bill_header where bill_date='".$toDate."' AND settleflag='2'"); 
	while($rowBh=mysql_fetch_array($sqlbh)){
		$sqlBd=mysql_query("select * from bill_header where room_no='".$rowBh['room_no']."' AND settleflag='2'"); 
		$rowBd=mysql_fetch_array($sqlBd);

	?>
	<tr><td style="width:15px;margin:0 0 0 5px;"><?php echo $rowBd['room_no']; ?></td><td style="width:60px;"><?php echo ucfirst($rowBd['guest_name']); ?></td><td style="width:50px;"><?php echo $rowBd['bill_no']; ?></td><td style="width:15px;"><?php echo $rowBd['net_amt']; ?></td></tr>
	<?php } ?>
	</table></li>
</ul>
</li>
</ul>



</div>
		  
<?php
$sqlRr=mysql_query("select * from property_definition where propdef_id='1'");
$numRr=mysql_fetch_array($sqlRr);
?>
<!--<table class="table" cellspacing="0" cellpadding="0" border="0" id="dasBrdD" style="margin-bottom:0px;">
<tr>
	<td style="background-color:#fff;color:#333333;width:100px;font-size:14px;font-weight:bold;text-align:left;" colspan="7">&nbsp;<?php echo $numRr['prop_name'].' - '.$numRr['city'];?></td>
</tr>
</table>-->
        </div>
</div>
</div>






<div id="viewcustomer" class="" style="margin:3px 0 0 0;">
<div class="DashbrdDiv" style="">
<div class="widget-header" style="border-top:none;border-left:none;border-right:none;">
<div class="col-md-12" style="height:295px;margin:2px 0 0 0;" >
	<h3 id="Userhd" style=""><b style="font-size:16px;">Room Service</b></h3>
<table  class="table table-condensed table-hover table-striped table-bordered" cellspacing="0" cellpadding="6" border="3" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;border:none;margin:34px 0 0 0;/* margin:0 0 15px 0; */">
<tr>
<?php
$record_per_page=10;
$deductRows=10;
$sqlL=mysql_query("select * from room_master where occupy_status='3'");
$count_no_rowsL=mysql_num_rows($sqlL);
$sql=mysql_query("select * from room_master where occupy_status='3' LIMIT 10");
$count_no_rows=mysql_num_rows($sql);
while($row=mysql_fetch_array($sql)) {

	$sqlLD=mysql_query("select * from guest_register gr, guest_trans gt where gr.room_no='".$row['room_number']."' AND gt.room_no='".$row['room_number']."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'"); 
	$rowLD=mysql_fetch_array($sqlLD);
	
$sqlRv=mysql_query("select * from room_color where roomoccupy_id='3'");
$rowRv=mysql_fetch_array($sqlRv); 
if($row['occupy_status']==3){
	$bgcolor= '#'.$rowRv['room_color'];
	$occStatus=$rowLD['guest_name'];
}
	

?>
<style>
.popCls {
	font-size:12px;
	padding:5px;
	text-transform: capitalize;
	cursor:pointer;
	color:#000;
	/* background-color:#3496C3; */
}
.popover {
margin:34px 0 0 0;
}
</style>
<td id="firstRow" class="firstRow codesUPPERCase buton" value="<?php echo $bgcolor; ?>" onclick="clickRoomService('<?php echo $row['room_number'];?>','<?php echo $row['room_type'];?>','<?php echo $rowLD['pax'];?>');" style="text-align:center;box-shadow:3px 4px 8px 4px;background-color:<?php echo $bgcolor; ?>"><?php echo $row['room_number'].' - '.$row['room_type']; ?><br/>
<?php if($row['occupy_status']==3) { ?>
<a rel="popover" data-toggle="popover" data-placement="right"  data-original-title="<a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/walkincheck_in.php?romNo=<?php echo $row['room_number'];?>&rmType=<?php echo $row['room_type'];?>>Check In</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/block_rooms.php?romNo=<?php echo $row['room_number'];?>>Block Room</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/clear_room.php?romNo=<?php echo $row['room_number'];?>>Clear Room</a>" data-content=<div style='padding:10px 0 0 0;color:#000;cursor:pointer;'><?php  echo $occStatus; ?><br/><?php  echo $rowLD['meal_plan'].' - '.$rowLD['pax']; ?></div><div style='padding:10px 0 0 0'></div></a><span id="firstRowSpn"><?php /* echo $occStatus; */?></span>
<?php } ?>
</td>
<?php } ?>
</tr>
<tr>
<?php
$record_per_page=10;
$deductRows=10;
$sql=mysql_query("select * from room_master where occupy_status='3' LIMIT 10,10");
$count_no_rows=mysql_num_rows($sql);
while($row=mysql_fetch_array($sql)) {

	$sqlLD=mysql_query("select * from guest_register gr, guest_trans gt where gr.room_no='".$row['room_number']."' AND gt.room_no='".$row['room_number']."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'");
	$rowLD=mysql_fetch_array($sqlLD);
	
$sqlRv=mysql_query("select * from room_color where roomoccupy_id='3'");
$rowRv=mysql_fetch_array($sqlRv); 
$sqlRv=mysql_query("select * from room_color where roomoccupy_id='3'");
$rowRv=mysql_fetch_array($sqlRv); 
if($row['occupy_status']==3){
	$bgcolor= '#'.$rowRv['room_color'];
	$occStatus=$rowLD['guest_name'];
}
?>
<td id="firstRow" class="firstRow codesUPPERCase buton" value="<?php echo $bgcolor; ?>" onclick="clickRoomService('<?php echo $row['room_number'];?>','<?php echo $row['room_type'];?>','<?php echo $rowLD['pax'];?>');" style="text-align:center;box-shadow:3px 4px 8px 4px;background-color:<?php echo $bgcolor; ?>"><?php echo $row['room_number'].' - '.$row['room_type']; ?><br/>
<?php if($row['occupy_status']==3) { ?>
<a rel="popover" data-toggle="popover" data-placement="right"  data-original-title="<a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/walkincheck_in.php?romNo=<?php echo $row['room_number'];?>&rmType=<?php echo $row['room_type'];?>>Check In</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/block_rooms.php?romNo=<?php echo $row['room_number'];?>>Block Room</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/clear_room.php?romNo=<?php echo $row['room_number'];?>>Clear Room</a>" data-content=<div style='padding:10px 0 0 0;color:#000;cursor:pointer;'><?php  echo $occStatus; ?></div><div style='padding:10px 0 0 0'></div></a><span id="firstRowSpn"><?php /* echo $occStatus; */?></span>
<?php } ?>
</td>
<?php } ?>
 </tr>
<tr>
<?php
$record_per_page=10;
$deductRows=10;

$sql=mysql_query("select * from room_master where occupy_status='3' LIMIT 20,10");
$count_no_rows=mysql_num_rows($sql);
while($row=mysql_fetch_array($sql)) {
	/* echo "select * from guest_register gr, guest_trans gt where gr.guestreg_id=gt.reg_num AND gt.bill_status='1'" */
	/* $sqlLD=mysql_query("select * from guest_register where room_no='".$row['room_number']."'"); */
	$sqlLD=mysql_query("select * from guest_register gr, guest_trans gt where gr.room_no='".$row['room_number']."' AND gt.room_no='".$row['room_number']."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'");
	$rowLD=mysql_fetch_array($sqlLD);
	
$sqlRv=mysql_query("select * from room_color where roomoccupy_id='3'");
$rowRv=mysql_fetch_array($sqlRv); 
if($row['occupy_status']==3){
	$bgcolor= '#'.$rowRv['room_color'];
	$occStatus=$rowLD['guest_name'];
}
?>
<td class="codesUPPERCase" id="firstRow" class="firstRow" value="<?php echo $bgcolor; ?>" onclick="clickFirstRow();" style="text-align:center;box-shadow:3px 4px 8px 4px;background-color:<?php echo $bgcolor; ?>"><?php echo $row['room_number'].' - '.$row['room_type']; ?><br/>
<?php if($row['occupy_status']==3) { ?>
<a rel="popover" data-toggle="popover" data-placement="right"  data-original-title="<a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/walkincheck_in.php?romNo=<?php echo $row['room_number'];?>>Check In</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/block_rooms.php?romNo=<?php echo $row['room_number'];?>>Block Room</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/clear_room.php?romNo=<?php echo $row['room_number'];?>>Clear Room</a>" data-content=<div style='padding:10px 0 0 0;color:#000;cursor:pointer;'><?php  echo $occStatus; ?></div><div style='padding:10px 0 0 0'></div></a><span id="firstRowSpn"><?php /* echo $occStatus; */?></span>
<?php } ?>
</td>
<?php } ?>
 </tr>
 <tr>
<?php
$record_per_page=10;
$deductRows=10;

$sql=mysql_query("select * from room_master where occupy_status='3' LIMIT 30,10");
$count_no_rows=mysql_num_rows($sql);
while($row=mysql_fetch_array($sql)) { 
	/* $sqlLD=mysql_query("select * from guest_register where room_no='".$row['room_number']."'"); */
	$sqlLD=mysql_query("select * from guest_register gr, guest_trans gt where gr.room_no='".$row['room_number']."' AND gt.room_no='".$row['room_number']."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'"); 
	$rowLD=mysql_fetch_array($sqlLD);
	
$sqlRv=mysql_query("select * from room_color where roomoccupy_id='3'");
$rowRv=mysql_fetch_array($sqlRv); 
if($row['occupy_status']==3){
	$bgcolor= '#'.$rowRv['room_color'];
	$occStatus=$rowLD['guest_name'];
}
?>
	<td class="codesUPPERCase" id="firstRow" class="firstRow" value="<?php echo $bgcolor; ?>" onclick="clickFirstRow();" style="text-align:center;box-shadow:3px 4px 8px 4px;background-color:<?php echo $bgcolor; ?>"><?php echo $row['room_number'].' - '.$row['room_type']; ?><br/>
<?php if($row['occupy_status']==3) { ?>
<a rel="popover" data-toggle="popover" data-placement="right"  data-original-title="<a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/walkincheck_in.php?romNo=<?php echo $row['room_number'];?>>Check In</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/block_rooms.php?romNo=<?php echo $row['room_number'];?>>Block Room</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/clear_room.php?romNo=<?php echo $row['room_number'];?>>Clear Room</a>" data-content=<div style='padding:10px 0 0 0;color:#000;cursor:pointer;'><?php  echo $occStatus; ?></div><div style='padding:10px 0 0 0'></div></a><span id="firstRowSpn"><?php /* echo $occStatus; */?></span>
<?php } ?>
</td>
<?php } ?>
 </tr>
 <tr>
<?php
$record_per_page=10;
$deductRows=10;

$sql=mysql_query("select * from room_master where occupy_status='3' LIMIT 40,10");
$count_no_rows=mysql_num_rows($sql);
while($row=mysql_fetch_array($sql)) {
	$sqlLD=mysql_query("select * from guest_register gr, guest_trans gt where gr.room_no='".$row['room_number']."' AND gt.room_no='".$row['room_number']."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'"); 
	$rowLD=mysql_fetch_array($sqlLD);
	
$sqlRv=mysql_query("select * from room_color where roomoccupy_id='1'");
$rowRv=mysql_fetch_array($sqlRv); 
if($row['occupy_status']==3){
	$bgcolor= '#'.$rowRv['room_color'];
	$occStatus=$rowLD['guest_name'];
}
?>
<td class="codesUPPERCase" id="firstRow" class="firstRow" value="<?php echo $bgcolor; ?>" onclick="clickFirstRow('<?php echo $row['room_number']?>');" style="text-align:center;box-shadow:3px 4px 8px 4px;background-color:<?php echo $bgcolor; ?>"><?php echo $row['room_number'].' - '.$row['room_type']; ?><br/>
<?php if($row['occupy_status']==3) { ?>
<a rel="popover" data-toggle="popover" data-placement="right"  data-original-title="<a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/walkincheck_in.php?romNo=<?php echo $row['room_number'];?>>Check In</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/block_rooms.php?romNo=<?php echo $row['room_number'];?>>Block Room</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/clear_room.php?romNo=<?php echo $row['room_number'];?>>Clear Room</a>" data-content=<div style='padding:10px 0 0 0;color:#000;cursor:pointer;'><?php  echo $occStatus; ?></div><div style='padding:10px 0 0 0'></div></a><span id="firstRowSpn"><?php /* echo $occStatus; */?></span>
<?php } ?>
</td>
<?php } ?>
 </tr>
</table>





<?php $sqlRm=mysql_query("select * from room_master");
$numRows=mysql_num_rows($sqlRm);
$rowRm=mysql_fetch_array($sqlRm); 

$sqlR=mysql_query("select * from room_master where occupy_status='1'");
$numR=mysql_num_rows($sqlR);

$sqlO=mysql_query("select * from room_master where occupy_status='2'");
$numO=mysql_num_rows($sqlO);

$sqlG=mysql_query("select * from room_master where occupy_status='3'");
$numG=mysql_num_rows($sqlG);

$sqlGue=mysql_query("select * from room_master where occupy_status='4'");
$numGue=mysql_num_rows($sqlGue);

$sqlMa=mysql_query("select * from room_master where occupy_status='5'");
$numMa=mysql_num_rows($sqlMa);

$sqlEd=mysql_query("select * from room_master where occupy_status='6'");
$numEd=mysql_num_rows($sqlEd);

$toDate=date('d/m/Y');
$sqlAR=mysql_query("select count(distinct gr.guestreg_id) AS todayDep from guest_register gr,guest_trans gt where gr.departure_date='".$toDate."' AND gr.guestreg_id=gt.reg_num"); 
$rowAr=mysql_fetch_array($sqlAR);
			
?>




<table style="border:none;margin:390px 0 0 0;" class="table table-condensed table-hover table-striped table-bordered">
<tr>
<td>	
<button type="button" name="tarrm_type" id="tarrm_type" class="buttExample bnkSbt">&nbsp;&nbsp;Room #</button>
</td>
<td>
	<input type="text" name="rom_no" id="rom_no" data-validation="required" class="required" value="" style="width:80px;margin:3px 0 0 0;"readonly />
	<input type="hidden" name="rm_px" id="rm_px" value="" style="" />
</td>
	
	<td>
		<button type="button" name="tarrm_type" id="tarrm_type" class="buttExample bnkSbt" onclick="ckChangeRmSubmt();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button></td>
			
	<td><button type="reset" id="rest" class="buttExample" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button></td>
			
	<td><a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="buttExample" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</td>
	</tr>
</table>
	
	
	

</div>



</div>

</div>
</div>

</form>		
	
	


	</div>

</body>
</html>