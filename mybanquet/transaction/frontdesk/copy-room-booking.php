<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<script>
	jQuery(document).ready(function(){
	
	$('#searchBtn').click(function(){
		item="?val="+$('#searchTxt').val();
		document.location.href="view-room-booking.php"+item;
	});
	
	
	});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});
 shortcut.add("Ctrl+A",function() { 
	 $('#taxTypes').attr('action', 'define-tax.php');  
	 $('#taxTypes').submit(); 
}); 

/* shortcut.add("Ctrl+E",function() { 
	uid=$('#roomid').val();
	window.location.href = "edit_define_tax.php?roomid="+uid;
}); */

function checkPropertyCode(){
	propCode=$('#property_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatPropertyCode.php',
			data:{
			propCode:propCode
			},
			success:function(data){
				/* alert(data); */
				if(data==1){
					$('#propertycode_err').html('* Property Code already exists.');
					$('#property_code').val('');
				}
				else{
					$('#propertycode_err').html('');
				}
			}
	});
}

function showGridView(){
	srch=$('#srch').val();
	srchTxt=$('#searchTxt').val();
	if(srch==""){
		alert("Please select Search category.");
	}else if(srchTxt==""){
		alert("Please enter Search text.");
	}else{
		document.location.href="copy-room-booking.php?srcCat="+srch+"&srchTxt="+srchTxt;
	}
	
}

function shwSrcTxt(){
	srch=$('#searchTxt').val('');

}
 </script>
 
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
check.png

.butExample {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 66px;
}

</style>	


<!--<body style="background:#eaebfc url(../../images/bg-ash2.jpg) repeat scroll center top;font: 69%/160% Lucida Grande,Verdana,Helvetica,Arial,sans-serif;">-->
<body class="bgBODY">

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<form id="taxTypes" name="taxTypes" class="" style=""> 
<div class="" style="height:500px;overflow:auto;">	

<table style="float:right;margin:7px 0 0 8px;">
<tr>

<td><label style="width:148px;"><b>Search category :</b></label></td>
<td>
<select name="srch" id="srch"  style="width:130px;">
<option value="">--Select--</option>
<option value="gst"<?php  if(isset($_GET['srcCat'])){ echo ($_GET['srcCat']=='gst')?'selected':''; } ?>  >Guest name</option>
<option value="comp"<?php  if(isset($_GET['srcCat'])){ echo ($_GET['srcCat']=='comp')?'selected':'';} ?>>Company name</option>
<option value="grp"<?php if(isset($_GET['srcCat'])){ echo ($_GET['srcCat']=='grp')?'selected':'';} ?>>Group name</option>
<option value="res"<?php if(isset($_GET['srcCat'])){ echo ($_GET['srcCat']=='res')?'selected':'';} ?>>Reservation#</option>
<option value="arr"<?php if(isset($_GET['srcCat'])){ echo ($_GET['srcCat']=='arr')?'selected':'';} ?>>Arrival Date</option>
<option value="nat"<?php if(isset($_GET['srcCat'])){ echo ($_GET['srcCat']=='nat')?'selected':'';} ?>>Nationality</option>
<option value="vou"<?php if(isset($_GET['srcCat'])){ echo ($_GET['srcCat']=='vou')?'selected':'';} ?>>Voucher</option>
</select>
</td>


<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter the details" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['srchTxt'])) { echo $_GET['srchTxt'];}else{} ?>" onclick="shwSrcTxt();"/>

	<input type="button" value="Display" class="btnH" onclick="showGridView();" style="margin:0 0 0 10px;font-weight: bold;padding: 5px;">
	<!--<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="myButSRc btnH"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>-->
</td>
<!--<td>
<a href="view-reinstate.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">R</span>einstate</button></a>
</td>
<td>&nbsp;</td>	
<td>
<a href="room-booking.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Room Booking</button></a>
</td>-->
</tr>
</table>

<div style="margin:40px 50px 10px 0px;float:right;">
		
</div>
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;">
	<tr class="info">
		<td colspan="19" style="text-align:center;"><h3 class="viewDT" id="Userhd"><b>Reservation Search</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Resv No</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Guest Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Company Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Group</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">No of Rms</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Room Type</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Arr Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Arr Time</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Dept Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Meal Plan</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Resv status</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Voucher</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Copy</th>
	</tr>
<?php 
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$ad=explode('/',$adtCurDt);
$adT=$ad[2].'/'.$ad[1].'/'.$ad[0];

$item_where="";	$nrs=0;

if(isset($_GET['srcCat']) && $_GET['srcCat']!='' && isset($_GET['srchTxt']) && $_GET['srchTxt']!=''){
	if($_GET['srcCat']=='gst'){ 
		$item_where= " where guest_name like '%".$_GET['srchTxt']."%'";
		$sql=mysql_query("select * from room_booking $item_where group by resv_no order by resv_no ASC");
	}else if($_GET['srcCat']=='comp'){
		$item_where= " where company_name like '%".$_GET['srchTxt']."%'";
		$sql=mysql_query("select * from room_booking $item_where group by resv_no order by resv_no ASC");	
	}else if($_GET['srcCat']=='grp'){
		$item_where= " where group_name like '%".$_GET['srchTxt']."%'";
		$sql=mysql_query("select * from room_booking $item_where group by resv_no order by resv_no ASC");	
	}else if($_GET['srcCat']=='res'){
		$item_where= " where resv_no like '%".$_GET['srchTxt']."%'";
		$sql=mysql_query("select * from room_booking $item_where group by resv_no order by resv_no ASC");	
	}else if($_GET['srcCat']=='arr'){
		$item_where= " where arrival_date like '%".$_GET['srchTxt']."%'";
		$sql=mysql_query("select * from room_booking $item_where group by resv_no order by resv_no ASC");	
	}else if($_GET['srcCat']=='nat'){
		$item_where= " where nationality like '%".$_GET['srchTxt']."%'";
		$sql=mysql_query("select * from room_booking $item_where group by resv_no order by resv_no ASC");	
	}else if($_GET['srcCat']=='vou'){
		$item_where= " where receipt_no like '%".$_GET['srchTxt']."%'";
		$sql=mysql_query("select * from room_booking $item_where group by resv_no order by resv_no ASC");	
	}

	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		 if($row['resv_status']==1){
			$statusC="Confirm";
		}else  if($row['resv_status']==2){
			$statusC="Waitlist";
		}else  if($row['resv_status']==3){
			$statusC="Tentative";
		}else  if($row['resv_status']==4){
			$statusC="Cancelled";
		}else  if($row['resv_status']==5){
			$statusC="Noshow";
		}else  if($row['resv_status']==6){
			$statusC="Checked-In";
		}  

$sqlR=mysql_query("select sum(noof_rms)as NoRms from room_booking where str_to_date(arrival_date,'%d/%m/%Y')>='$adT' AND resv_no='".$row['resv_no']."' group by resv_no order by resv_no ASC ");
$roR=mysql_fetch_array($sqlR);

$sqr=mysql_query("select receipt_no from guest_trans where reserv_no='".$row['resv_no']."' AND receipt_no!='Null'");
$ro=mysql_fetch_array($sqr);	

?>
	<tr>
		<td width="80" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80"><?php echo $row['resv_no']; ?></td>
		<td width="80" class="codesUPPERCase"style="text-align:left;"><?php echo $row['guest_name']; ?></td>
		<td width="80" class="codesUPPERCase"style="text-align:left;"><?php echo $row['company_name']; ?></td>
		<td width="80"><?php echo $row['group_name']; ?></td>
		<td width="80" class="fstChUPPRCase" > <?php echo $roR['NoRms']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['room_type']; ?></td>
		<td width="80"><?php echo $row['arrival_date']; ?></td>
		<td width="80"><?php echo $row['arrival_time']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['departure_date']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['meal_plan']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $statusC; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $ro['receipt_no']; ?></td>
		<td width="80">		
		<a href="reserv-copybooking.php?roomBk=<?php echo $row['resv_no']; ?>&rmBkID=<?php echo $row['roombook_id']; ?>" style="" class="">Copy</a>&nbsp;
		</td>
	</tr>
	<?php /*  } */  } } } ?>	
</table>
	</div>
	<?php include("../../footer.php"); ?>
	</body>
 </form>