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
	document.location.href="check_out_bill.php"+item;
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
<table style="margin:15px 0 0 37px;width:45%;float:right;">	
<tr>
<td> <button type="button" id="print" style="display:none;margin:10px 0 -3px 145px;" class="submitbtnprint btnn" onclick="popupBillPrint()">Print</button></td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Search" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="" />

	<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="submitbtnprint btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>
</td>	
</tr>
</table>
<div style="overflow:auto;height:420px;width:99%;">
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Check out bill</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th></th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Bill no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Bill date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Room no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Guest name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Total amount</th>
	</tr>
	<?php 
/* 	"select * from guest_register gr, guest_trans gt where gr.room_no='".$rmN[$cc]."' AND gt.room_no='".$rmN[$cc]."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'" */
	
	if(isset($_GET['val'])){
	$item_where= " where mainroom_no like '%".$_GET['val']."%' OR bill_no like '%".$_GET['val']."%' OR bill_date like '%".$_GET['val']."%'";
	$sql=mysql_query("select distinct bill_no,bill_date,mainroom_no,tax_amt,debit,credit from bill_detail $item_where group by mainroom_no order by bill_no ASC");
	} else{
		$sql=mysql_query("select distinct bill_no,bill_date,mainroom_no,tax_amt,debit,credit from bill_detail group by bill_no order by bill_no ASC");
	}
	
	
	
	
	$x=0;$debt=0;$crdt=0;$taxAmt=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$debt+=$row['debit'];
		$crdt+=$row['credit'];
		$taxAmt+=$row['tax_amt'];
	
	$sqlB="select (sum(tax_amt)+sum(debit)-sum(credit)) AS balance from bill_detail where bill_no='".$row['bill_no']."'";
	$rowBa=mysql_query($sqlB);
	$rowHg=mysql_fetch_array($rowBa);
	
			$sqlH=mysql_query("select distinct mainguest_name from bill_header where mainroom_no='".$row['mainroom_no']."' AND bill_no='".$row['bill_no']."'");
			$rowH=mysql_fetch_array($sqlH);
		$bal=floatval($debt+$taxAmt-$crdt);
		$x++;
	?>
	<tr>
		<td width="30" style="text-align:center;"><?php echo $x; ?></td>
		<td width="30"><input name="chk[]"  type="checkbox" id="c_<?php echo $row['bill_no']?>" class="ckPrint group1 check_" value="<?php echo $row['bill_no']?>" onclick="setPrint(this.id,this.value);" /></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['bill_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['bill_date']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['mainroom_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $rowH['mainguest_name']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo round($rowHg['balance']); ?></td>
	</tr>
	<?php } } else{ ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any check out details...
    </div>
<?php } ?>
</table>
	</div>
	</div>
	</body>
 </form>