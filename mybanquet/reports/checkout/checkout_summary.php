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
	document.location.href="occupancy_report.php"+item;
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
		  <a href="<?php echo $home_path ?>/reports/checkout/xt_viewOccupancyDetails-xls.php" style="margin:0px 0 0 62px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="" class="submitbtnprint btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Today Occupancy&nbsp;</button></a>
		
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
	
		<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;width:192%;"><b>Occupancy Report</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="30" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Arrival Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Departure Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">GRC no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Room no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Days</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Bil no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Tariff</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Exp</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">SRT</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">SBC</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">KKC</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Others</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Tot Debit</th>
		<!--<th width="80" style="text-align:center;background-color:#F5F5F5;">Allow</th>-->
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Disc</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Adv</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Tot Credit</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Bal</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Refund</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Cash</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Card</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Credit</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">NEFT</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Remarks</th>
		<!--<th width="80" style="text-align:center;background-color:#F5F5F5;">Signature</th>-->
	</tr>
	<?php 
	
/* $sql=mysql_query("select distinct bh.bill_no,bh.bill_date,bh.mainguest_name,bh.mainroom_no,bh.room_no,bh.guest_name,bh.pay_mode,bh.settleflag,bd.rev_desc,bd.cash,bd.credit,bd.cheque,bd.neft,bd.compname,gr.grc_number,gr.guestreg_id,gr.arrival_date,gr.arrival_time,gr.departure_date,gr.departure_time from guest_register gr,bill_detail bd,bill_header bh where gr.room_no=bh.room_no AND gr.guestreg_id=bh.reg_num AND bh.settleflag='2'");	 */
$sql=mysql_query("select distinct bh.bill_no,bh.bill_date,bh.mainguest_name,bh.mainroom_no,bh.room_no,bh.guest_name,bh.pay_mode,bh.settleflag,bd.compname,gr.grc_number,gr.guestreg_id,gr.arrival_date,gr.arrival_time,gr.departure_date,gr.departure_time from guest_register gr,bill_detail bd,bill_header bh where bh.bill_no=bd.bill_no AND gr.guestreg_id=bh.reg_num AND bh.settleflag='1'");	
	
	$x=0;$debt=0;$crdt=0;$taxAmt=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		/* $debt+=$row['debit'];
		$crdt+=$row['credit'];
		$taxAmt+=$row['tax_val']; */
		$pay_mode=$row['pay_mode'];
		if($pay_mode=='cash'){
			$pay_mode=='Cash';
		}

$SqlTr=mysql_query("select distinct bd.rev_desc,bd.debit from guest_register gr,bill_detail bd,bill_header bh where gr.room_no='".$row['mainroom_no']."' AND bh.mainroom_no='".$row['mainroom_no']."' AND bd.mainroom_no='".$row['mainroom_no']."' AND  bd.bill_no='".$row['bill_no']."' AND gr.guestreg_id=bh.reg_num AND bh.settleflag='1' AND bd.rev_desc='Tariff' AND bh.settleflag='1'");
$rowTr=mysql_fetch_array($SqlTr);

$SqlTE=mysql_query("select distinct bd.rev_desc,bd.debit from guest_register gr,bill_detail bd,bill_header bh where gr.room_no='".$row['mainroom_no']."' AND bh.mainroom_no='".$row['mainroom_no']."' AND bd.mainroom_no='".$row['mainroom_no']."' AND  bd.bill_no='".$row['bill_no']."' AND gr.guestreg_id=bh.reg_num AND bh.settleflag='1' AND bd.rev_desc='Extra Person' AND bh.settleflag='1'");
$rowTE=mysql_fetch_array($SqlTE);		

/* select distinct bd.rev_desc,bd.debit,bd.credit,bd.tax_amt from bill_detail bd,bill_header bh where bd.bill_no='000001' AND bd.rev_desc='SRT' AND bh.settleflag='2'  */
/* echo "select distinct bd.rev_desc,bd.debit,bd.credit,bd.tax_amt from bill_detail bd,bill_header bh where bd.mainroom_no='".$row['mainroom_no']."' AND  bd.bill_no='".$row['bill_no']."' AND bh.settleflag='2' AND bd.rev_desc='SRT'"; */
/* echo "select distinct bd.rev_desc,bd.debit,bd.credit,bd.tax_amt from bill_detail bd,bill_header bh where AND bd.mainroom_no='".$row['mainroom_no']."' AND  bd.bill_no='".$row['bill_no']."' AND bh.settleflag='2' AND bd.rev_desc='SRT' AND bh.settleflag='2'"; */

$SqlTx=mysql_query("select distinct bd.rev_desc,bd.debit,bd.credit,bd.tax_amt from bill_detail bd,bill_header bh where bd.bill_no='".$row['bill_no']."' AND bd.rev_desc='SRT' AND bh.settleflag='1'");
$rowTx=mysql_fetch_array($SqlTx);

$SqlTC=mysql_query("select distinct bd.rev_desc,bd.debit,bd.credit,bd.tax_amt from bill_detail bd,bill_header bh where bd.bill_no='".$row['bill_no']."' AND bd.rev_desc='SBC' AND bh.settleflag='1'");
$rowTC=mysql_fetch_array($SqlTC);

$SqlTKC=mysql_query("select distinct bd.rev_desc,bd.debit,bd.credit,bd.tax_amt from bill_detail bd,bill_header bh where bd.bill_no='".$row['bill_no']."' AND bd.rev_desc='KKC' AND bh.settleflag='1'");
$rowTKC=mysql_fetch_array($SqlTKC);

$SqlDs=mysql_query("select distinct bd.rev_desc,bd.debit,bd.credit,bd.tax_amt from bill_detail bd,bill_header bh where bd.bill_no='".$row['bill_no']."' AND bd.rev_desc!='Advance' AND bh.settleflag='1'");
$rowDs=mysql_fetch_array($SqlDs);

$SqlOt=mysql_query("select distinct bd.rev_desc,bd.debit,bd.credit from guest_register gr,bill_detail bd,bill_header bh where gr.room_no='".$row['mainroom_no']."' AND bh.mainroom_no='".$row['mainroom_no']."' AND bd.mainroom_no='".$row['mainroom_no']."' AND  bd.bill_no='".$row['bill_no']."' AND gr.guestreg_id=bh.reg_num AND bh.settleflag='1' AND bd.rev_desc!='SRT' AND bd.rev_desc!='SBC' AND bd.rev_desc!='KKC' AND bd.rev_desc!='Advance' AND bh.settleflag='1'");
$rowOt=mysql_fetch_array($SqlOt);


$sqlLM="select (sum(tax_val)+sum(debit)-sum(credit)) AS balance,bd.mainroom_no,bd.reg_num,bd.bill_status from bill_detail bd,bill_header bh where bd.mainroom_no='".$row['mainroom_no']."' AND bd.reg_num=bh.reg_num AND bh.settleflag='1'";

$sqlB="select distinct (sum(tax_amt)+sum(debit)-sum(credit)) AS balance,sum(debit) AS totAmt,sum(credit) AS totCrtAmt,sum(tax_amt) AS TxAt ,bd.rev_desc,bd.debit,bd.credit from bill_detail bd,bill_header bh where bh.bill_no='".$row['bill_no']."' AND bd.mainroom_no='".$row['mainroom_no']."' AND bh.mainroom_no=bd.mainroom_no AND bd.bill_no='".$row['bill_no']."' AND bh.settleflag='1'";
$sqlBal=mysql_query($sqlB);
$rowBal=mysql_fetch_array($sqlBal); 
		
		$exPA=explode('/',$row['arrival_date']);
		$frmDate=@$exPA[2].'-'.@$exPA[1].'-'.@$exPA[0];
		$exPT=explode('/',$row['bill_date']);
		$toDate=@$exPT[2].'-'.@$exPT[1].'-'.@$exPT[0];
		$arriva_date=strtotime($frmDate);
		$departure_date=strtotime($toDate);
		$datediff = $departure_date - $arriva_date;
		$datediffF=round(abs(($datediff/(60*60*24))+1)); 
		/* $arrTim=$row['arrival_time'];
		$dtT=explode(':',$arrTim);
		$ArrdateTime=@$dtT[0].':'.@$dtT[1]; */
		
		if(@$exPA[2]==@$exPT[2] && @$exPA[1]==@$exPT[1] && @$exPA[0]==@$exPT[0]){
			$noOfDys='1';
		}else{
			$noOfDys=$datediffF;
		}
			
		
	
		
		
	?>
	<tr>
		<td width="30" style="text-align:center;"><?php echo $x; ?></td>
		<!--<td width="30"><input name="chk[]"  type="checkbox" id="c_<?php /* echo $row['guestreg_id'] */?>" class="ckPrint group1 check_" value="<?php /* echo $row['guestreg_id'] */?>" onclick="setPrint(this.id,this.value);" /></td>-->
		<td width="80" class="codesUPPERCase"><?php echo $row['arrival_date']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['departure_date']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['grc_number']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['mainroom_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $noOfDys; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['mainguest_name']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['bill_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $rowTr['debit']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $rowTE['debit']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $rowTx['tax_amt']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $rowTC['tax_amt']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $rowTKC['tax_amt']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php /* echo $rowOt['debit']; */ ?></td>
		
		
		<td width="80" class="fstChUPPRCase"><?php echo $rowBal['totAmt']; ?></td>
		<!--<td width="80" class="fstChUPPRCase"><?php /* echo $noOfDys; */ ?></td>-->
		<td width="80" class="fstChUPPRCase"><?php echo $rowDs['credit']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $rowBal['totAmt']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $rowBal['totCrtAmt']; ?></td>
		
		<td width="80" class="fstChUPPRCase"><?php if($rowBal['balance']>0) { echo $rowBal['balance'];} ?></td>
		
		<td width="80" class="fstChUPPRCase"><?php if($rowBal['balance']<0) { echo $rowBal['balance']; }?></td>
		<td width="80" class="fstChUPPRCase"><?php if($rowBal['balance']==0) { echo $rowBal['balance']; }?></td>
		<!--<td width="80" class="fstChUPPRCase"><?php /* if(isset($row['cash'])) {echo $row['cash']; } */?></td>-->
		<td width="80" class="fstChUPPRCase"><?php if(isset($row['card'])) {echo $row['card']; }?></td>
		<td width="80" class="fstChUPPRCase"><?php if(isset($row['cheque'])) {echo $row['cheque']; }?></td>
		<td width="80" class="fstChUPPRCase"><?php if(isset($row['neft'])) {echo $row['neft']; }?></td>
		<td width="80" class="fstChUPPRCase"><?php if(isset($row['compname'])) {echo $row['compname']; }?></td>
	
	</tr>
	<?php } } else{ ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any Checkout summary details...
    </div>
<?php } ?>
</table>
	</div>
	</div>
	</body>
 </form>