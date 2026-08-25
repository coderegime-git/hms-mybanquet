<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");
/* include("../../menu.php"); */


	$var=explode('?',$_SERVER['REQUEST_URI']);
	$page=preg_replace('/.*\/([^\/])/','$1',$var[0]);
	unset($var);
	$menuVals =explode(',',$_SESSION['menuOption']);
	
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
<?php
$sqle=mysql_query("SELECT * FROM audt_control");
$rowe=mysql_fetch_array($sqle);
$cru = $rowe['cur_date'];
$dtr = explode('/',$cru);
$dy = $dtr[2].'-'.$dtr[1].'-'.$dtr[0];
//echo $dy;
$date = date('Y-m-d');
$dtNow = new DateTime($date.' 00:00:00');
$dtToCompare = new DateTime($dy.' 00:00:00');
$diff = $dtNow->diff($dtToCompare);
$ordt = $diff->days;
?>

<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	$(".datepicker" ).datepicker({
	    changeMonth:true,
     changeYear:true,
     yearRange:"-100:+5",
	  /* minDate: 0, */
     dateFormat:"dd/mm/yy"
  });
  
 
  jQuery("#taxTypes").validationEngine();
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(5000);
	
	 $("#msgFo").fadeOut(5000);
	

});

 shortcut.add("Ctrl+S",function() { 
	 $('#taxTypes').attr('action', '<?php echo $home_path;?>/action/add_block_halls.php');  
	 $('#taxTypes').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view-block-hall.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#taxTypes').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "view-block-hall.php";
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

function getGUestName(){
	room_no=$('#room_no').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selectGuestName.php',
			data:{
			room_no:room_no
			},
			success:function(data){
				  /* alert(data); */ 
				$('#guest_name').val(data);
			}
	});
}

function getBlockRoomNo(){
	room_no=$('#room_no').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selChgeRoomType.php',
			data:{
			room_no:room_no
			},
			success:function(data){
				    /* alert(data);  */
				$('#room_type').val(data);
				if(data==1){
					alert("Check the room status.");
					$('#room_type').val('');
				}
				
			}
	});
}

function cleanN(){
	mnt=$('#mainten').val();
	adt=$('#audDte').val();
	$('#from_date').val('');
	$('#to_date').val('');
	if(mnt=='hkp'){
		$('#from_date').val(adt);
		$('#to_date').val(adt);
		$('#remarks').val('hkp');
	}else if(mnt=='visiting'){
		$('#from_date').val(adt);
		$('#to_date').val(adt);
		$('#remarks').val('visiting');
	}else if(mnt=='maintenance'){
		$('#from_date').val(adt);
		$('#to_date').val(adt);
		$('#remarks').val('maintenance');
	}else{
		$('#from_date').val('');
		$('#to_date').val('');
		$('#remarks').val('');
	}
}

function selVenueName(){
	venu=$("#venue").val();
	bkDt=$("#book_date").val();
	// alert(venu);
    ses=$("#session").val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selVeniePROGRESSBar.php',
			data:{
			venu:venu,
			bkDt:bkDt,
			// ses:ses
			},
			success:function(data){
				/* alert(data); */
			if(data==1){
				/* $("#venPRODef").show(); 
				$(".venPROShw").hide();
				$(".venPROShw1").hide(); */
			}else{
				 $("#venPRODef").hide(); 
				 $(".venPROShw").show();
				 $(".venPROShw1").show();
				 $(".venPROShw1").append(data);
				}
				
				
			}
	});
}

function selSessionName(){
sess=$("#session").val();
venu=$("#venue").val();
bkDt=$("#book_date").val();

	$.ajax({
		type:'GET',
		url:'  ../../action/selSessionblockDet.php',
			data:{
			sess:sess,
			venu:venu,
			bkDt:bkDt
			},
			success:function(data){
				 /* alert(data); */
				 opt=data.split(',');
				 $('#from_time').val(opt[0]);
				 $('#to_time').val(opt[1]);
				 $('#seating').focus();
				 
				if(opt[0]==2){
					alert(opt[1]);
					$("#session").val('');
					$("#venue").val('');
					$("#book_date").val('');
					$("#from_time").val('');
					$("#to_time").val('');
					$("#confirm_status").val('')
					$(".venPROShw1").hide();
					$(".venPROShw").hide();
					$("#venPROShw").show(); 
				}else if(opt[0]==1){
					alert(opt[1]);
					$("#from_time").val(opt[2]);
					$("#to_time").val(opt[3]);
					// $("#confirm_status").val('6');
					// alert();
					$("#add").hide();
					$("#release").show(); 
				}	
				
			}
		});
		
}

function selTOtme(){
	frT=$("#from_time").val(); 
	toT=$("#to_time").val(); 
	spF=frT.split(':');
	sp=toT.split(':');
	if(parseFloat(spF[0])>parseFloat(sp[0])){
		alert("To time should not be less than from time.");
		$("#to_time").val(''); 
	}
}

</script> 
<body class="bgBODY">

	
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;margin:0 0 0 -261px;">
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

label{
	 font-size:12px;
	 padding: 3px 9px 0 0;
	 font-weight: normal;
	 float: right;
}

.table{
	 margin-bottom:0px;
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
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$audDte=$rowAC['cur_date'];
$cr=explode('/',$rowAC['cur_date']);
$crd=$cr[0].'-'.$cr[1].'-'.$cr[2];
$curTime=date('H:i:s');

?>			
	<div class="col-sm-12" style="height:10px;"></div>
	<div class="container" style="">	
	<div class="col-sm-4"></div>
	<div class="col-sm-4 table-responsive" style="border: 1px solid #ddd; padding: 0;">
	<h3 id="Userhd"><b>Hall Block</b></h3>
		<form id="taxTypes" name="taxTypes" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_block_halls.php" method="post" class="" style="">
	
<input type="hidden" name="audDte" id="audDte" value="<?php echo $crd; ?>"/>
<input type="hidden" name="audDteE" id="audDteE" value="<?php echo $audDte; ?>"/>
		
			<table cellpadding="0" cellspacing="0" class="table" border="0" style="margin:4px 0 0 0;" >
			<tbody>
				<!--<tr>
					<td width="" valign="top"><label>Date<em>*</em></label></td>
					<td valign="top"><input type="text" name="cur_date" id="cur_date" data-validation="required" class="input validate[required] textbox" value="<?php /* echo $rowAC['cur_date']; */?>" readonly />
					</td>
				</tr>-->
				<tr>
						<td><label>Date</label></td>
						<td width="" valign="top">				
					<input  name="book_date" id="book_date" type="text" class="input validate[required] textbox form-control codesUPPERCase datepicker" value="" onblur="arrDateSel('<?php echo $cc;?>');" onclick="arrCopySel('<?php echo $cc;?>');"  placeholder="dd/mm/yyyy"/></td>
				  </tr>

				<tr>
					<td width="" valign="top"><label>Venue<em>*</em></label></td>
					<td valign="top">
					<?php $sqlBS=mysql_query("select distinct venue_code,venue_desc from bq_venue where status='1'"); ?>
	<select name="venue" id="venue" class="input validate[required] fstChUPPRCase textbox form-control"  onChange="selVenueName();">
	<option value="">--Select--</option>
	<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  
	if(isset($_GET['ven']) && $_GET['ven']==$rowBS['venue_desc']){
	?>
	<option value="<?php  echo $rowBS['venue_code']; ?>" selected ><?php  echo $rowBS['venue_desc'];?></option>
	<?php }else{ ?>
	<option value="<?php  echo $rowBS['venue_code']; ?>"><?php  echo $rowBS['venue_desc'];?></option>
	<?php  } } ?>
	</select>
					</td>
				</tr>
				
				<tr>
						<td><label>Session </label></td>
						<td width="" valign="top">
<?php $sqlBS=mysql_query("select distinct sess_code,sess_name from bqt_session where status='1'"); ?>
		<select name="session" id="session" class="input validate[required] fstChUPPRCase textbox form-control" onChange="selSessionName();">
		<option value="">--Select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
		<option value="<?php  echo $rowBS['sess_code']; ?>"><?php  echo $rowBS['sess_name'];?></option>
		<?php  }  ?>
		</select>
						</td>
					</tr>
				
                  
				<tr>
				    <td><label>From</label></td>
				    <td style="text-align:center;">
					<input name="from_time" id="from_time" type="text" class="input validate[required] textbox form-control fstChUPPRCase"/>
					</td>
				 </tr>	
				 <tr>
				    <td><label>To</label></td>
					<td style="text-align:center;">
					<input name="to_time" id="to_time" type="text" data-validation="required" class="input validate[required] textbox form-control fstChUPPRCase" value="" onblur="selTOtme();" />
					</td>
			    </tr>
				<input type="text" hidden name="confirm_status" value="6" id="confirm_status" class="fstChUPPRCase textbox" />
				
				<!--<tr>
					<td width="" valign="top"><label>Released by<em>*</em></label></td>
					<td valign="top"><input type="text" name="released_by" id="released_by" data-validation="required" class="input validate[required] fstChUPPRCase textbox" /></td>
				</tr>
				
				
				<tr>
					<td width="" valign="top"><label>Reason<em>*</em></label></td>
					<td valign="top">
					<select name="reason" id="reason" data-validation="required" class="input validate[required] fstChUPPRCase textbox">
					<option value="">--Select--</option>
					<option value="REG">Regular Guest</option>
					<option value="GST">Guest Request</option>
					<option value="MAI">Maintenance</option>
					
					</select>
					</td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Remarks<em>*</em></label></td>
					<td valign="top"><input type="text" name="remarks" id="remarks" data-validation="required" value="<?php if(isset($_GET['romNo'])){echo $remarks;}?>" class="input validate[required] fstChUPPRCase textbox form-control" /></td>
				</tr>-->
					</tbody>
				</table>
			
				
	<!--<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>-->	
	<div class="col-md-12  responsive nowrap " style=" padding-left:3px;">
	<?php /* if(isset($nmRws)==0){ */ ?>
	<?php 
	// $sess=?><script>  $("#session").val(); <?php 
	// $venu=?>  $("#venue").val(); <?php 
	// $bkDt=?> $("#book_date").val(); </script><?php 
	// $bk=explode('/',$bkDt);
    // $bkm=@$bk[2].'-'.@$bk[1].'-'.@$bk[0];
	
	// if(isset($sess)&& isset($venu)){
	// $sqB=mysql_query("select * from bq_hallbooking where venue='".$venu."' AND session='".$sess."' AND confirm_status!='6' AND str_to_date(book_date,'%d/%m/%Y') = '$bkm'");
	// $nmR=mysql_num_rows($sqB);
	// if(mysql_num_rows($sqB)>0){
		// ?>
		<button type="submit" id="add" name="add" class="btn btn-primary btn-sm btn-responsive" style="" onClick="return checkUnitMasterfdf();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		<?php// }else{ ?>
		<button type="submit"  id="release" name="release" class="btn btn-primary btn-sm btn-responsive" style="display:none" ><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">R</span>elease</button>
	<?php //} }else { ?>
	    <!--<button type="submit" id="add" name="add" class="btn btn-primary btn-sm btn-responsive" style="" onClick="return checkUnitMasterfdf();"><img src="<?php echo $home_path; ?>/images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>-->
	<?php //} ?>
		<a href="view-block-hall.php"><button type="button" id="update" class="btn btn-primary btn-sm btn-responsive" onClick="return checkPropertyMasterq();"><img src="<?php echo $home_path; ?>/images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
			
			<button type="reset" id="rest" class="btn btn-primary btn-sm btn-responsive" style="" onClick="cancel_ed()"><img src="<?php echo $home_path; ?>/images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
			<!--<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="butExample" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>-->
			<a href="view-block-hall.php"><button type="button" id="exit" name="exit" class="btn btn-primary btn-sm btn-responsive"><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
	</div>
	<!--</td>
	</tr>
	</table>-->
	</form>	
	</div>
	<!-- Start Room Status -->
<table style="float:left;width:100%;border:1px solid #ddd;margin:4px 0 0 0;font-size:12px;" cellpadding="0" cellspacing="0" class="table" border="0" >

<tbody id="venPRODef">
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;height:15px;">Venue</th>
	<?php 
	for($cc=6;$cc<=24;$cc++){
	?>
	<th style="text-align:center;background-color:#F5F5F5;width:5px;height:15px;"><?php echo $cc; ?></th>
	<?php } ?>
</tr>
<tr id="">
<td style="text-align:center;" id="room"><input type="text" style="width:52px;height:15px;" readonly /></td>
<?php 
	for($cc=6;$cc<=24;$cc++){
	?>
<td style="text-align:center;" id="room"><input type="text" style="width:52px;height:15px;" readonly /></td>
<?php } ?>
</tr>
</tbody>	

<tbody class="venPROShw" style="display:none;border:1px solid #cccccc;">
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;height:15px;border:1px solid #cccccc;">Venue</th>
	<?php 
	for($cc=6;$cc<=24;$cc++){
	?>
	<th style="text-align:center;background-color:#F5F5F5;width:5px;height:15px;border:1px solid #cccccc;"><?php echo $cc; ?></th>
	<?php } ?>
</tr>
</tbody>
<tbody class="venPROShw1" style="display:none;border:1px solid #cccccc;">

</tbody>

</table>



<?php
$sqlRv=mysql_query("select * from bq_stscolor where roomoccupy_id='1'");
$rowRv=mysql_fetch_array($sqlRv); 
$sqlRd=mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
$rowRd=mysql_fetch_array($sqlRd);
$sqlRo=mysql_query("select * from bq_stscolor where roomoccupy_id='3'");
$rowRo=mysql_fetch_array($sqlRo); 
$sqlRg=mysql_query("select * from bq_stscolor where roomoccupy_id='4'");
$rowRg=mysql_fetch_array($sqlRg);
$sqlRm=mysql_query("select * from bq_stscolor where roomoccupy_id='5'");
$rowRm=mysql_fetch_array($sqlRm);
$sqlRe=mysql_query("select * from bq_stscolor where roomoccupy_id='6'");
$rowRe=mysql_fetch_array($sqlRe);
?>
	<table class="table table-condensed table-hover table-striped table-bordered dsTTrm" cellspacing="0" cellpadding="6" border="3">
		<tr>
			<td style="background-color:#<?php echo $rowRv['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Available</td>
			<td style="background-color:#<?php echo $rowRd['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Reserved</td>
			<td style="background-color:#<?php echo $rowRo['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Wait Listed </td>
			<td style="background-color:#<?php echo $rowRg['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Enquiry </td>
			<td style="background-color:#<?php echo $rowRm['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Tentative</td>
			<td style="background-color:#<?php echo $rowRe['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Blocked</td>
		</tr>
		
</table>
<!-- End Room Status -->
	</div>
	<?php include("../../footer.php"); ?>
</body>
</html>