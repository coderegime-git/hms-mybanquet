<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>
 
<style>
label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 

  #searchTxt{
	background
	:url("../../images/search.png") no-repeat scroll right center #FFFFFF;
	}
</style>	

<script>
$(document).ready(function(){

 $(':checkbox').click(function(e){
	if($("input:checked").length>0){
	$('#print').show();
	}else{
	$('#print').hide();
	}
});

$('#searchBtn').click(function(){
	item="?val="+$('#searchTxt').val();
	document.location.href="room_advance_printout.php"+item;
	}); 
	
	
jQuery("#roommaster").validationEngine();

});


function setPrint(id,val)
		{	
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



function popupBillPrint()
{
	val=$('.ckPrint:checkbox:checked').val();
	newwindow=window.open('<?php echo $home_path;?>/transaction/view/print-room-advance-report.php?advRDId='+val,"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
	newwindow.focus(); 
}
</script>
<body class="bgBODY">
<form id="taxTypes" name="taxTypes" class="" style=""> 
<div class="" style="height:500px;overflow:auto;">	
<div style="margin:0px 0 10px 750px;">
</div>

<table style="width:45%;float:left;">	
<tr>
<td> <button type="button" id="print" style="display:none;margin:20px 0 -3px 145px;" class="submitbtnprint btnn" onclick="popupBillPrint()">Print</button></td>
</tr>
</table>
<table style="margin:15px 0 0 37px;width:45%;float:right;">	
<tr>
	<td>
		  <a href="<?php echo $home_path ?>/reports/checkout/xt_viewRoomAdvance-xls.php" style="margin:10px 0 0 65px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="" class="submitbtnprint btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Export&nbsp;</button></a>
		
		</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Search" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="" />

	<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="submitbtnprint btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>
</td>	
</tr>
</table>
<div style="overflow:auto;height:420px;width:99%;">
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Room Advance Details</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th></th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Receipt no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Room no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Guest name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Amount</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Cash</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Card</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Remarks</th>
	</tr>
	<?php 
	$sqlRm=mysql_query("select sum(amount) as advAmt from room_advance");
	$rowRm=mysql_fetch_array($sqlRm);
	$sqlRc=mysql_query("select sum(amount) as advAmtCsh from room_advance where pay_mode='cash'");
	$rowRc=mysql_fetch_array($sqlRc);
	$sqlCd=mysql_query("select sum(amount) as advAmtCrd from room_advance where pay_mode='card'");
	$rowCd=mysql_fetch_array($sqlCd);
	
	$x=0;
	if(isset($_GET['val'])){
		
	$item_where= " where cur_date like '%".$_GET['val']."%' OR receipt_no like '".$_GET['val']."' OR guest_name like '%".$_GET['val']."%' OR room_no='".$_GET['val']."'";
	/* echo "select * from room_advance $item_where"; */
	$sql=mysql_query("select * from room_advance $item_where");
	} else{
		$sql=mysql_query("select * from  room_advance");
	}
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
	?>
	<tr>
		<td width="30" style="text-align:center;"><?php echo $x; ?></td>
		<td width="30"><input name="chk[]"  type="checkbox" id="c_<?php echo $row['roomadv_id']?>" class="ckPrint group1 check_" value="<?php echo $row['roomadv_id']?>" onclick="setPrint(this.id,this.value);" /></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['cur_date']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['receipt_no']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['room_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['guest_name']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['amount']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php if($row['pay_mode']=='cash') { echo $row['amount'];} ?></td>
		<td width="80" class="fstChUPPRCase"><?php if($row['pay_mode']=='card') { echo $row['amount']; }?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['remarks'];  ?></td>

	</tr>
	
	<?php } ?>
	<!--<tr>
		<td width="30" style="text-align:center;"></td>
		<td width="30"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase" style="font-weight:bold;background-color:#474747;color:#fff;">Total</td>
		<td width="80" class="fstChUPPRCase" style="font-weight:bold;background-color:#474747;color:#fff;"><?php echo $rowRm['advAmt'];?></td>
		<td width="80" class="fstChUPPRCase" style="font-weight:bold;background-color:#474747;color:#fff;"><?php echo $rowRc['advAmtCsh'];?></td>
		<td width="80" class="fstChUPPRCase" style="font-weight:bold;background-color:#474747;color:#fff;"><?php echo $rowCd['advAmtCrd'];?></td>
		<td width="80" class="fstChUPPRCase"></td>
	</tr>-->

	<?php } else{ ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any Room advance details...
    </div>
<?php } ?>


</table>
</div>
	
	</div>
	
		
<table class="table" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
<tr>
	<td width="30" style="text-align:center;"></td>
	<td width="30"></td>
	<td width="80" class="codesUPPERCase"></td>
	<td width="80" class="codesUPPERCase"></td>
	<td width="80" class="codesUPPERCase"></td>
	<td width="80" class="fstChUPPRCase" style="font-weight:bold;background-color:#474747;color:#fff;">Total</td>
	<td width="80" class="fstChUPPRCase" style="font-weight:bold;background-color:#474747;color:#fff;"><?php echo $rowRm['advAmt'];?></td>
	<td width="80" class="fstChUPPRCase" style="font-weight:bold;background-color:#474747;color:#fff;"><?php echo $rowRc['advAmtCsh'];?></td>
	<td width="80" class="fstChUPPRCase" style="font-weight:bold;background-color:#474747;color:#fff;"><?php echo $rowCd['advAmtCrd'];?></td>
	<td width="80" class="fstChUPPRCase"></td>
</tr>	
</table>

	</body>
 </form>