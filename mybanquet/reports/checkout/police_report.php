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
	document.location.href="police_report.php"+item;
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
	newwindow=window.open('<?php echo $home_path;?>/transaction/view/bill-print-pdout.php?billNo='+val,"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
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
<table style="margin:-16px 0 0 37px;width:55%;float:right;">	
<tr>
<td> <button type="button" id="print" style="display:none;margin:10px 0 -3px 145px;" class="submitbtnprint btnn" onclick="popupBillPrint()">Print</button></td>
<td>
		  <a href="<?php echo $home_path ?>/reports/checkout/xt_viewPoliceRprtDetails-xls.php" style="margin:0px 0 0 62px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="" class="submitbtnprint btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Export&nbsp;</button></a>
		
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
	
		<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Occupancy Report</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="30" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Arrival Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Departure Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Room no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Age</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Address</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Phone</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Nationality</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Purpose of visit</th>
		<!--<th width="80" style="text-align:center;background-color:#F5F5F5;">Signature</th>-->
	</tr>
	<?php 
/* 	"select * from guest_register gr, guest_trans gt where gr.room_no='".$rmN[$cc]."' AND gt.room_no='".$rmN[$cc]."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'" */
/* $toDate=date('14/07/2016'); */
$toDate=date('d/m/Y');
 
/* 	$sql=mysql_query("select distinct gr.guestreg_id,gr.arrival_date,gr.departure_date,gr.room_no,gr.guest_name,gr.address1,gr.address2,gr.city,gr.pin_code,gr.nationality,gr.purpose_visit,gr.phone from guest_register gr,guest_trans gt where arrival_date='".$toDate."'"); */
	$sql=mysql_query("select distinct gr.guestreg_id,gr.arrival_date,gr.departure_date,gr.room_no,gr.guest_name,gr.address1,gr.address2,gr.city,gr.pin_code,gr.nationality,gr.purpose_visit,gr.phone,gt.reg_num from guest_register gr,guest_trans gt where arrival_date='".$toDate."' AND gr.guestreg_id=gt.reg_num");
	
	$x=0;$debt=0;$crdt=0;$taxAmt=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		/* $debt+=$row['debit'];
		$crdt+=$row['credit'];
		$taxAmt+=$row['tax_amt'];
	
			$sqlH=mysql_query("select distinct mainguest_name from bill_header where mainroom_no='".$row['mainroom_no']."' AND bill_no='".$row['bill_no']."'");
			$rowH=mysql_fetch_array($sqlH); */
		
		$x++;
	?>
	<tr>
		<td width="30" style="text-align:center;"><?php echo $x; ?></td>
		<!--<td width="30"><input name="chk[]"  type="checkbox" id="c_<?php /* echo $row['guestreg_id'] */?>" class="ckPrint group1 check_" value="<?php /* echo $row['guestreg_id'] */?>" onclick="setPrint(this.id,this.value);" /></td>-->
		<td width="80" class="codesUPPERCase"><?php echo $row['arrival_date']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['departure_date']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['room_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['guest_name']; ?></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['address1']; ?><br/>
		<?php if($row['address2']!=''){ echo $row['address2']; } ?><br/>
		<?php echo $row['city']; ?><br/>
		<?php echo $row['pin_code']; ?>
		</td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['phone']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['nationality']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['purpose_visit']; ?></td>
		
	</tr>
	<?php } } else{ ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any Police details...
    </div>
<?php } ?>
</table>
	</div>
	</div>
	</body>
 </form>