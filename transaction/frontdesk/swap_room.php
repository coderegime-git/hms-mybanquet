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
	roomNo=$('#room_no').val();
	crType=$('#croom_type').val();
	tarRmtype=$('#tarRm_type').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selSwapRmSubmit.php',
			data:{
			crType:crType,
			tarRmtype:tarRmtype
			},
			success:function(data){
				   /* alert(data); */ 
				   if(data==1){
					   r=confirm("Do you want swap the room");
					   if(r==true){
						    $('#taxTypes').attr('action', '../../action/add_swap_room.php');  
							$('#taxTypes').submit(); 
					   }else{
						   alert("Select same room type.");
					   }
					   
				   }
					
			}
	});
	
}

function clickFirstRow(rm,tp){
	/* alert(rm+tp); */
	$('#target_room').val(rm);
	$('#tarRm_type').val(tp);
	
	
}
</script> 
<body class="bgBODY">
<div id="invoice" class="frmCentr divBrd frmBgClr" style="width:1000px;">
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
.spanClr{
	color: #5b503b;
    display: block;
    float: left;
    font-size: 12px;
    font-weight: normal;
    padding: 2px 9px 0 5px;
		
}
.myBuTSbt {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #fff;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 90px;
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
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');

if(isset($_GET['regNum'])){
$sqlGr=mysql_query("select * from guest_register where guestreg_id='".$_GET['regNum']."'");
$rowGr=mysql_fetch_array($sqlGr);
}
?>		
<h3 id="Userhd"><b>Swap Room</b></h3>
	<div class="col-md-12" style="overflow:auto;height:295px;margin:2px 0 0 0;" >
	
<table  class="table table-condensed table-hover table-striped table-bordered" cellspacing="0" cellpadding="6" border="3" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;border:none;/* margin:0 0 15px 0; */">
<tr>
<?php


$record_per_page=10;
$deductRows=10;
$sqlL=mysql_query("select * from room_master where occupy_status='3' AND room_type='".$rowGr['room_type']."'");
$count_no_rowsL=mysql_num_rows($sqlL);
$sql=mysql_query("select * from room_master where occupy_status='3' AND room_type='".$rowGr['room_type']."'");
$count_no_rows=mysql_num_rows($sql);
$fixtures = '';
$count_i=0;
while($row=mysql_fetch_array($sql)) {
if($count_i == 0 || $count_i % 10 == 0){
		echo $fixtures .= '</tr>';
	}
 $count_i++;
 
	$sqlLD=mysql_query("select * from guest_register gr, guest_trans gt where gr.room_no='".$row['room_number']."' AND gt.room_no='".$row['room_number']."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'"); 
	$rowLD=mysql_fetch_array($sqlLD);
	
$sqlRv=mysql_query("select * from room_color where roomoccupy_id='3'");
$rowRv=mysql_fetch_array($sqlRv); 
if($row['occupy_status']==3){
	$bgcolor= '#'.$rowRv['room_color'];
	$occStatus="Vacant";
}
	
/* if($row['occupy_status']==1){
	$bgcolor= "#66FF00";
	$occStatus="Vacant";
} */
?>

<td id="firstRow" class="firstRow codesUPPERCase buton" value="<?php echo $bgcolor; ?>" onclick="clickFirstRow('<?php echo $row['room_number']?>','<?php echo $row['room_type'] ?>');" style="text-align:center;box-shadow:3px 4px 8px 4px;background-color:<?php echo $bgcolor; ?>"><?php echo $row['room_number'].' - '.$row['room_type']; ?><br/>
<?php if($row['occupy_status']==3) { ?>
<a rel="popover" data-toggle="popover" data-placement="right"  data-original-title="<a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/walkincheck_in.php?romNo=<?php echo $row['room_number'];?>&rmType=<?php echo $row['room_type'];?>>Check In</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/block_rooms.php?romNo=<?php echo $row['room_number'];?>>Block Room</a><br/><br/><a class=popCls href=<?php echo $home_path;?>/transaction/frontdesk/clear_room.php?romNo=<?php echo $row['room_number'];?>>Clear Room</a>" data-content=<div style='padding:10px 0 0 0;color:#000;cursor:pointer;'><?php  echo $occStatus; ?></div><div style='padding:10px 0 0 0'></div></a><span id="firstRowSpn"><?php /* echo $occStatus; */?></span>
<?php } ?>
</td>
<?php } ?>

</table>
<style>

</style>

</div>

<div class="col-sm-12" style="" >


<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_charges.php" method="post" class="" style="">
<table class="table table-condensed table-hover table-striped table-bordered" cellspacing="0" cellpadding="" border="0" style="font-size:13px;margin-bottom:0px;">
<tr>
	<th style="text-align:center;background-color:#126295;color:#fff;">Room</th>
	<th style="text-align:center;background-color:#126295;color:#fff;">Type</th>
	<th style="text-align:center;background-color:#126295;color:#fff;">Guest Name</th>
	<th style="text-align:center;background-color:#126295;color:#fff;">Reg#</th>
	<th style="text-align:center;background-color:#126295;color:#fff;">Target Room</th>
</tr>
<tr>
<input type="hidden" name="oldroom_no" id="room_no" data-validation="required" class="textbox input validate[required,custom[integer]]" value="<?php if(isset($rowGr['room_no'])){echo $rowGr['room_no'];} ?>" onkeyup="getRoomNoChge();"/>
<td style=""><input type="text" name="croom_no" id="croom_no" data-validation="required" class="textbox input validate[required,custom[integer]]" value="<?php if(isset($rowGr['room_no'])){ echo $rowGr['room_no'];}?>" style="width:80px;"readonly /></td>
<td><input type="text" name="croom_type" id="croom_type" data-validation="required" class="textbox input validate[required]" value="<?php if(isset($rowGr['room_no'])){ echo $rowGr['room_type'];}?>" style="width:80px;" readonly /></td>
<td><input type="text" name="cgst_name" id="cgst_name" data-validation="required" class="textbox input validate[required]" value="<?php if(isset($rowGr['room_no'])){ echo $rowGr['guest_name'];}?>" style="width:196px;" readonly /></td>
<td><input type="text" name="creg_num" id="creg_num" data-validation="required" class="textbox input validate[required]" value="<?php if(isset($rowGr['room_no'])){ echo $rowGr['reg_num'];}?>" style="width:80px;"readonly /></td>
<td valign="top" width=""><input type="text" name="target_room" id="target_room" class="textbox input validate[required]" style="width:80px;" onblur="selTargetRoom();" /><input type="text" name="tarRm_type" id="tarRm_type" data-validation="required" class="textbox input validate[required]" style="width:80px;" readonly />&nbsp;
</td>
</tr>
<tr>

</tr>
</table>
		<table style="border:none;" class="table table-condensed table-hover table-striped table-bordered">
	<tr>
		<td>	
	<div style="margin:0 0 0 1px;">
		<button type="button" name="tarrm_type" id="tarrm_type" class="myBuTSbt bnkSbt" onclick="ckChangeRmSubmt();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">S</span>wap</button>
			
		<a href="#.php"><button type="button" id="update" class="myBuTSbt bnkSbt" onclick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="myBuTSbt" style="" onclick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>

			<button type="button" id="exit" name="exit" class="myBuTSbt" style="" onclick="self.close();" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button>
	</div>
	</td>
	</tr>
	</table>

</div>

</form>		
	
	

	</div>
	</div>
<?php include("../../footer.php"); ?>
</body>
</html>