<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<script>
jQuery(document).ready(function(){
	 $("#msgFo").fadeOut(5000);
$(':checkbox').click(function(e){
	if($("input:checked").length>0){
	   $('#print').show();
	   $('#email').show();
	   $('#approve').show();
	}else{
	   $('#print').hide();
	   $('#email').hide();
	   $('#approve').hide();
	   $('#cancelApprove').hide();
	 }
   
});	

	$('.btnn').click(function (e) {
		if($(this).attr('id')=="approve"){
			if($("input:checked").length>1){ alert("Please select only one row"); return }
			r=confirm("Do you want to cancel Hall Advance");
			if(r==true){
					bookN=$('#bookN').val();
					rcptN=$('#rcptN').val();
						
				$('#act').val("approve");
				document.location.href="../../action/update-halladv-approve.php?bookN="+bookN+'&rcptN='+rcptN;
			}
			
		}
		
		return;
	});
	
	
	
	
	
	$('#searchBtn').click(function(){
	item="?val="+$('#searchTxt').val();
	document.location.href="view-reservroom-booking.php"+item;
}); 
	
	jQuery("#roommaster").validationEngine();
	});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});
shortcut.add("Ctrl+A",function() { 
	 $('#taxTypes').attr('action', 'define-tax.php');  
	 $('#taxTypes').submit(); 
}); 


function setPrint(id,val,c,d)
{	
	$('#bookN').val(c);
	$('#rcptN').val(d);
	
	if($("#"+id).is(":checked"))
	{  
		$('.ckPrint').each(function(){
			a_id=this.id.split('_');
			if($(this).attr('id') != id)
			{
				$(this).attr("disabled",true);
				$("#ed"+a_id[1]).attr("style","display:none");
			}
			});
	}
	else
	{
		$('.ckPrint').each(function(){
			a_id=this.id.split('_');
			$(this).removeAttr("disabled");
			$("#ed"+a_id[1]).attr("style","display:inline");
		});
	}
	
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

<body class="bgBODY">

<form id="taxTypes" name="taxTypes" class="" style=""> 
<div class="" style="height:500px;overflow:auto;">	

<input type="hidden" id="bookN" name="bookN"/>
<input type="hidden" id="rcptN" name="rcptN"/>

<!--<table style="float:right;margin:7px 0 0 8px;">
<tr>
<td style="width:534px;">
<a href="reserv-hall-advance.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="
margin:10px 50px 10px 0px;float:right;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Define Tax</button></a>
</td>	
</tr>
</table>-->
<table style="margin:30px 0 0 0;width:300px;float:left;">	
<tr>
<td><a id="approve" style="display:none;" class="btnn"><button type="button" id="approve" class="btnH appV">Cancel Advance </button></a></td>
</tr>
</table>

<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:41px 0 15px 0px;text-align:center;font-size:12px;">
	<tr class="info">
		<td colspan="18" style="text-align:center;"><h3 class="viewDT" id="Userhd"><b>View Hall Advance</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Sl.no</th>
		<th width="30" style="text-align:center;background-color:#F5F5F5;color:#000;"><input name="" type="checkbox" class="Ckk" disabled /></th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Receipt Date </th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Receipt no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Booking no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Function date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Venue</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Session</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">From time</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">To time</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Function</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Guest Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Amount</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Pay mode</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;color:#000;">Status</th>
	</tr>

<?php 
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$ad=explode('/',$adtCurDt);
$cur=$ad[2].'-'.$ad[1].'-'.$ad[0];
$sql=mysql_query("select * from bq_hallresvadv where status!='3' order by status ASC");
$x=0;
while($row=mysql_fetch_array($sql)) {
$x++;

$sqB=mysql_query("select * from bq_hallbooking where booking_no='".$row['booking_no']."' AND confirm_status='2'");
$roB=mysql_fetch_array($sqB);

if($row['status']=='1') {
	$status='Paid';
}else if($row['status']=='2') {
	$status='Settled';
}	
 $fn=explode('/',$roB['book_date']);
 $fnC=@$fn[2].'-'.@$fn[1].'-'.@$fn[0];
?>
<tr>
	<td width="80" style="text-align:center;"><?php echo $x;  ?></td>
	<?php if($row['status']!='2' && strtotime($fnC)>=strtotime($cur)) { ?>
	<td style="text-align:center;"><input name="chk[]"  type="checkbox" id="c_<?php echo $row['reservadv_id']?>" class="ckPrint group1 check_" value="<?php echo $row['reservadv_id']?>" onclick="setPrint(this.id,this.value,'<?php echo $row['booking_no']?>','<?php echo $row['receipt_no']?>');" /></td>
	<?php }else{?>
		<td style="text-align:center;"><input name="chk[]"  type="checkbox" id="c_<?php echo $row['reservadv_id']?>" class="ckPrint group1 check_" value="<?php echo $row['reservadv_id']?>" onclick="" disabled /></td>
	<?php }?>
	<td width="80" style="text-align:center;"><?php echo $row['cur_date']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['receipt_no']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['booking_no']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['function_date']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($roB['venue']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($roB['session']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($roB['from_time']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($roB['to_time']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($roB['funct']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['guest_name']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['amount']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['pay_mode']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $status; ?></td>
</tr>
<?php } ?>	
</table>
	
	</div>
	<?php include("../../footer.php"); ?>
	</body>
 </form>