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
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script>
$(document).ready(function(){
	
	$(".datepicker" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});
  

 $(':checkbox').click(function(e){
	if($("input:checked").length>0){
	$('#print').show();
	}else{
	$('#print').hide();
	}
});

$('#company').change(function() {
  comp="";
  if($(this).val()!=''){comp = "?comp="+$(this).val(); }
  document.location.href="outstanding_report.php"+comp;	
  });
  
  $('#billsrcv').change(function() {
  bls="";
  if($(this).val()!=''){bls = "?bls="+$(this).val(); }
  document.location.href="outstanding_report.php"+bls;	
  });

  
$('#searchBtn').click(function(){
	item="?val="+$('#searchTxt').val();
	document.location.href="outstanding_report.php"+item;
}); 
	
	
jQuery("#roommaster").validationEngine();

});


function showsales() {
/* val=$('#item_uid').val(); */
fromdate=$('#from_date').val();
todate=$('#to_date').val();
if(fromdate!="")
{
	document.location="flash_report.php?fromdate="+fromdate;
}


}

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
<div class="" style="height:600px;overflow:auto;">	
<div style="margin:0px 0 10px 750px;">
</div>

<!--<table style="width:45%;float:left;">	
<tr>
<td> <button type="button" id="print" style="display:none;margin:20px 0 -3px 145px;" class="submitbtnprint btnn" onclick="popupBillPrint()">Print</button></td>
</tr>
</table>-->
<?php
if(isset($_GET['fromdate'])){
$date=$_GET['fromdate'];	
}else{
$date=date('d/m/Y');
}
?>
<table style="margin:10px 0 10px 37px;float:left;">	
	<tr>
		<td><label style="width:105px;"><b>Date :</b></label></td>
		<td>
			<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php echo $date;?>" onChange="showsales()" placeholder="From Date"/>
		</td>
	</tr>
</table>

<!--<table style="margin:-16px 0 0 37px;width:55%;float:right;">	
<tr>
<td><label style="width:105px;"><b>company :</b></label></td>
<td>
<?php $sqlBS=mysql_query("select distinct comp_code,comp_name from company_master where status='1'");?>
<select name="company" id="company" class="fstChUPPRCase" style="width:170px;float:left;" onChange="selCompanyName();">
<option value="">--Select--</option>
<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
<?php if($_GET['comp']==$rowBS['comp_code']) { ?>
<option value="<?php echo $rowBS['comp_code'];?>" selected ><?php echo $rowBS['comp_code'];?></option>
<?php }else{ ?>
<option value="<?php echo $rowBS['comp_code'];?>"><?php echo $rowBS['comp_code'];?></option>
<?php } } ?>
</select>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>

	<td><label style="width:80px;"><b>From :</b></label></td>
					<td>
						<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
					</td>
					<td><label style="width:70px;"><b>To :</b></label></td>
					<td>
						<input name="to_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
					</td>
<td>
		  <a href="<?php echo $home_path ?>/reports/checkout/xt_viewOutstandingDetails-xls.php" style="margin:0px 0 0 62px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="" class="submitbtnprint btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/></button></a>
		
</td>
<td style="width:600px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Search" style="margin-left: 32px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="" />

<button type="button" name="searchBtn" id="searchBtn" style="margin:-45px 47px 0 298px;color:#000;font-size:13px;font-weight:bold;padding:2px;width: 100px;" class="submitbtnprint btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>
</td>	
</tr>
</table>-->
<div style="width:99%;">
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
		<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;width:100%;"><b>Flash Report</b></h3><b></b></td>
	</tr>
</table>
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px 5px;text-align:left;font-size:12px;width:240px;float:left;">
	<tr>
		<th width="30" style="text-align:center;background-color:#F5F5F5;" class="table">Module</th>
	</tr>
<?php 
$sqlB=mysql_query("select ledger_code,description from ledgers where ledger_type='income'");
while($rowB=mysql_fetch_array($sqlB)) {
?>
<tr>
	<td width="80" class="fstChUPPRCase" style="text-align:left;">&nbsp;<?php echo $rowB['description']; ?></td>
	<!--<td width="80" class="fstChUPPRCase"><?php /* echo $rowV['Trf']; */ ?></td>-->
</tr>
<?php } ?>	
<tr>
	<td width="80" class="fstChUPPRCase" style="font-weight:bold;text-align:left;">&nbsp;Total Sales</td>
</tr>
<tr>
	<td width="80" class="fstChUPPRCase" style="font-weight:bold;text-align:left;"></td>
</tr>
<?php $sqlBT=mysql_query("select distinct tax_desc from tax_structure");
while($rowBT=mysql_fetch_array($sqlBT)) { ?>
<tr>
	<td width="80" class="fstChUPPRCase" style="text-align:left;">&nbsp;<?php echo $rowBT['tax_desc']; ?></td>
</tr>
<?php } ?>	
<tr>
	<td width="80" class="fstChUPPRCase" style="font-weight:bold;text-align:left;">&nbsp;Total Tax</td>
</tr>
<tr class="info">
	<td colspan="" style="text-align:center;"></td>
</tr>
<tr>
		<td width="30" style="text-align:center;background-color:#F5F5F5;text-align:left;">&nbsp;Total Rooms</td>
</tr>
	<tr>
		<td width="80" style="text-align:center;background-color:#F5F5F5;text-align:left;">&nbsp;Room Sold</td>
		</tr>
	<tr>
		<td width="80" style="text-align:center;background-color:#F5F5F5;text-align:left;">&nbsp;Occupied (%)</td>
	</tr>
	<tr>
		<td width="80" class="fstChUPPRCase" style="font-weight:bold;text-align:left;"></td>
	</tr>
	<tr>
		<td width="80" style="text-align:center;background-color:#F5F5F5;text-align:left;">&nbsp;Cash</td>
	</tr>
	<tr>
		<td width="80" style="text-align:center;background-color:#F5F5F5;text-align:left;">&nbsp;Card</td>
	</tr>
	<tr>
		<td width="80" style="text-align:center;background-color:#F5F5F5;text-align:left;">&nbsp;Credit</td>
	</tr>
	
	<tr>
		<td width="80" style="text-align:center;background-color:#F5F5F5;text-align:left;">&nbsp;NEFT</td>
	</tr>
	<tr>
		<td width="80" style="text-align:center;background-color:#F5F5F5;text-align:left;">&nbsp;Cheque</td>
	</tr>
	<tr>
		<td width="80" style="text-align:center;background-color:#F5F5F5;text-align:left;">&nbsp;Room</td>
	</tr>
</table>
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;width:230px;float:left;">
<tr>
	<th style="text-align:center;">DTD</th>
</tr>
<?php 
/* $date=date('d/m/Y'); */	
 
$sqlB=mysql_query("select ledger_code,description from ledgers where ledger_type='income'");
while($rowB=mysql_fetch_array($sqlB)) {
}

$sqlRm=mysql_query("select * from room_master");
$numRows=mysql_num_rows($sqlRm);
$rowRm=mysql_fetch_array($sqlRm);

$sqlV=mysql_query("select sum(debit) AS Trf from guest_trans where rev_desc='Tariff' AND trans_date='$date'");
$rowV=mysql_fetch_array($sqlV);

$sqlR=mysql_query("select sum(amount) AS rMdly from room_advance where cur_date='$date' AND pay_mode='cash'");
$rowR=mysql_fetch_array($sqlR);

$sqlARr=mysql_query("select sum(amount) AS ARdly from ar_receipts where rcpt_date='$date' AND pay_mode='cash'");
$rowARr=mysql_fetch_array($sqlARr);

$sqlCa=mysql_query("select sum(debit) AS TrfM from guest_trans where trans_date='$date' AND pay_mode='cash'");
$rowCa=mysql_fetch_array($sqlCa);
$dyCash=$rowARr['ARdly']+$rowCa['TrfM']+$rowR['rMdly'];


$sqlRd=mysql_query("select sum(amount) AS rMdlym from room_advance where cur_date='$date' AND pay_mode='card'");
$rowRd=mysql_fetch_array($sqlRd);

$sqlARrd=mysql_query("select sum(amount) AS ARdlyd from ar_receipts where rcpt_date='$date' AND pay_mode='card'");
$rowARrd=mysql_fetch_array($sqlARrd);

$sqlCad=mysql_query("select sum(debit) AS TrfMm from guest_trans where trans_date='$date' AND pay_mode='card'");
$rowCad=mysql_fetch_array($sqlCad);
$dlyCad=$rowCad['TrfMm']+$rowARrd['ARdlyd']+$rowRd['rMdlym'];


$sqlAR=mysql_query("select sum(bill_amount) AS daBlAmt from ar_bills where bill_date='$date'");
$rowAR=mysql_fetch_array($sqlAR);

$sqld=mysql_query("select sum(debit) AS Trcrd from guest_trans where trans_date='$date' AND pay_mode='company'");
$rowd=mysql_fetch_array($sqld);

$sqlE=mysql_query("select sum(debit) AS exTrf from guest_trans where rev_desc='Extra Person' AND trans_date='$date'");
$rowE=mysql_fetch_array($sqlE);
$totSal=$rowV['Trf']+$rowE['exTrf'];

$sqllx=mysql_query("select sum(tax_val) AS txat from guest_trans where rev_desc='Luxury Tax' AND trans_date='$date'");
$rowlx=mysql_fetch_array($sqllx);

$sqlSx=mysql_query("select sum(tax_val) AS txSat from guest_trans where rev_desc='Service Tax' AND trans_date='$date'");
$rowSx=mysql_fetch_array($sqlSx);

$sqlSx=mysql_query("select sum(tax_val) AS txSat from guest_trans where rev_desc='Service Tax' AND trans_date='$date'");
$rowSx=mysql_fetch_array($sqlSx);

$sqlCx=mysql_query("select count(distinct room_no) AS tdrmcnt from guest_trans where trans_date='$date' AND bill_status='2'");
$rowCx=mysql_fetch_array($sqlCx);

$sqlCS=mysql_query("select count(distinct room_no) AS tdrmNcnt from guest_trans where trans_date='$date' AND bill_status='1'");
$rowCS=mysql_fetch_array($sqlCS);
$occu=$rowCS['tdrmNcnt']/$numRows*100;



?>
<tr>
	<td><?php echo sprintf("%01.2f",$rowV['Trf']); ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo $rowE['exTrf']; ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo $totSal; ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo sprintf("%01.2f",$rowlx['txat']); ?></td>
</tr>
<tr>
	<td><?php echo sprintf("%01.2f",$rowSx['txSat']); ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo $numRows; ?></td>
</tr>
<tr>
	<td><?php echo $rowCS['tdrmNcnt']; ?></td>
</tr>
<tr>
	<td><?php echo (sprintf("%01.2f",$occu)).'%'; ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo round(sprintf("%01.2f",$dyCash)); ?></td>
</tr>
<tr>
	<td><?php echo round(sprintf("%01.2f",$dlyCad)); ?></td>
</tr>
<tr>
	<td><?php echo round(sprintf("%01.2f",$rowAR['daBlAmt'])); ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
</table>

<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;width:230px;float:left;">
<tr>
<th style="text-align:center;">MTD</th>
</tr>
<?php 
$dt=explode('/',$date);	
$inDt='01';
$stDt='01'.'/'.$dt[1].'/'.$dt[2];
$EdDt='31'.'/'.$dt[1].'/'.$dt[2];

/* echo "select sum(debit) AS MntTrf from guest_trans where rev_desc='Tariff' AND trans_date BETWEEN '$stDt' AND '$EdDt'"; */
/* echo "select sum(debit) AS MntTrf from guest_trans where rev_desc='Tariff' AND trans_date BETWEEN '$stDt' AND '$EdDt'"; */

$sqlVD=mysql_query("select sum(debit) AS MntTrf from guest_trans where rev_desc='Tariff' AND trans_date BETWEEN '$stDt' AND '$EdDt'");
$rowVD=mysql_fetch_array($sqlVD);

$sqlmR=mysql_query("select sum(amount) AS rlym from room_advance where cur_date BETWEEN '$stDt' AND '$EdDt' AND pay_mode='cash'");
$rowmR=mysql_fetch_array($sqlmR);

$sqlAm=mysql_query("select sum(amount) AS ARdlym from ar_receipts where rcpt_date BETWEEN '$stDt' AND '$EdDt' AND pay_mode='cash'");
$rowAm=mysql_fetch_array($sqlAm);

$sqlVM=mysql_query("select sum(debit) AS mMntTrf from guest_trans where rev_desc='Tariff' AND trans_date BETWEEN '$stDt' AND '$EdDt' AND pay_mode='cash'");
$rowVM=mysql_fetch_array($sqlVM);
$mnthCsh=$rowVM['mMntTrf']+$rowAm['ARdlym']+$rowmR['rlym'];

$sqlmRD=mysql_query("select sum(amount) AS rlymM from room_advance where cur_date BETWEEN '$stDt' AND '$EdDt' AND pay_mode='card'");
$rowmRD=mysql_fetch_array($sqlmRD);

$sqlAmd=mysql_query("select sum(amount) AS ARdlymD from ar_receipts where rcpt_date BETWEEN '$stDt' AND '$EdDt' AND pay_mode='card'");
$rowAmd=mysql_fetch_array($sqlAmd);

$sqldD=mysql_query("select sum(debit) AS mMnCtTrf from guest_trans where trans_date BETWEEN '$stDt' AND '$EdDt' AND pay_mode='card'");
$rowdD=mysql_fetch_array($sqldD);
$mnCrd=$rowdD['mMnCtTrf']+$rowAmd['ARdlymD']+$rowmRD['rlymM'];

$sqlARm=mysql_query("select sum(bill_amount) AS daBlAmtM from ar_bills where bill_date BETWEEN '$stDt' AND '$EdDt'");
$rowARm=mysql_fetch_array($sqlARm);

$sqlE=mysql_query("select sum(debit) AS exMTrf from guest_trans where rev_desc='Extra Person' AND trans_date BETWEEN '$stDt' AND '$EdDt'");
$rowE=mysql_fetch_array($sqlE);
$mtotSal=$rowVD['MntTrf']+$rowE['exMTrf'];

$sqlMl=mysql_query("select sum(tax_val) AS mnTxat from guest_trans where rev_desc='Luxury Tax' AND trans_date BETWEEN '$stDt' AND '$EdDt'");
$rowMl=mysql_fetch_array($sqlMl);

$sqlSl=mysql_query("select sum(tax_val) AS mnSTxat from guest_trans where rev_desc='Service Tax' AND trans_date BETWEEN '$stDt' AND '$EdDt'");
$rowSl=mysql_fetch_array($sqlSl);

$mThttTx=$rowMl['mnTxat']+$rowSl['mnSTxat'];

$sqlMx=mysql_query("select count(distinct room_no) AS tdrmNcnt from guest_trans where trans_date BETWEEN '$stDt' AND '$EdDt' AND bill_status='2'");
$rowMx=mysql_fetch_array($sqlMx);

$sqlMO=mysql_query("select count(distinct room_no) AS tdrmONcnt from guest_trans where trans_date BETWEEN '$stDt' AND '$EdDt' AND bill_status='1'");
$rowMO=mysql_fetch_array($sqlMO);

$occuM=$rowMO['tdrmONcnt']/$numRows*100;
?>
<tr>
	<td><?php echo sprintf("%01.2f",$rowVD['MntTrf']); ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo $rowE['exMTrf']; ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo $mtotSal; ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo sprintf("%01.2f",$rowMl['mnTxat']); ?></td>
</tr>
<tr>
	<td><?php echo sprintf("%01.2f",$rowSl['mnSTxat']); ?></td>
</tr>
<tr>
	<td><?php echo sprintf("%01.2f",$mThttTx); ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo $numRows; ?></td>
</tr>
<tr>
	<td><?php echo $rowMO['tdrmONcnt']; ?></td>
</tr>
<tr>
	<td><?php echo (sprintf("%01.2f",$occuM)).'%'; ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo round(sprintf("%01.2f",$mnthCsh)); ?></td>
</tr>
<tr>
	<td><?php echo round(sprintf("%01.2f",$mnCrd)); ?></td>
</tr>
<tr>
	<td><?php echo round(sprintf("%01.2f",$rowARm['daBlAmtM'])); ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
</table>

<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;width:230px;float:left;">
<tr>
	<th style="text-align:center;">YTD</th>
</tr>
<?php 
$dt=explode('/',$date);	
$inDt='01';
$stDtY='01'.'/'.'01'.'/'.$dt[2];
$EdDtY='31'.'/'.'12'.'/'.$dt[2];

$sqlT=mysql_query("select sum(debit) AS yrTrf from guest_trans where rev_desc='Tariff' AND trans_date BETWEEN '$stDtY' AND '$EdDtY'");
$rowT=mysql_fetch_array($sqlT);

$sqlyD=mysql_query("select sum(amount) AS rlYM from room_advance where cur_date BETWEEN '$stDtY' AND '$EdDtY' AND pay_mode='cash'");
$rowyD=mysql_fetch_array($sqlyD);

$sqlAmY=mysql_query("select sum(amount) AS ARdlymY from ar_receipts where rcpt_date BETWEEN '$stDtY' AND '$EdDtY' AND pay_mode='cash'");
$rowAmY=mysql_fetch_array($sqlAmY);

$sqlAmD=mysql_query("select sum(amount) AS ARdlyY from room_advance where cur_date BETWEEN '$stDtY' AND '$EdDtY' AND pay_mode='card'");
$rowAmD=mysql_fetch_array($sqlAmD);

$sqlAmYd=mysql_query("select sum(amount) AS ARdlymYd from ar_receipts where rcpt_date BETWEEN '$stDtY' AND '$EdDtY' AND pay_mode='card'");
$rowAmYd=mysql_fetch_array($sqlAmYd);

$sqlTT=mysql_query("select sum(debit) AS yrTYrf from guest_trans where trans_date BETWEEN '$stDtY' AND '$EdDtY' AND pay_mode='cash'");
$rowTt=mysql_fetch_array($sqlTT);
$cshYr=$rowTt['yrTYrf']+$rowAmY['ARdlymY']+$rowyD['rlYM'];


$sqlTTD=mysql_query("select sum(debit) AS yrTYrfD from guest_trans where trans_date BETWEEN '$stDtY' AND '$EdDtY' AND pay_mode='card'");
$rowTtD=mysql_fetch_array($sqlTTD);
$yrCard=$rowTtD['yrTYrfD']+$rowAmYd['ARdlymYd']+$rowAmD['ARdlyY'];

$sqlARY=mysql_query("select sum(bill_amount) AS daBlAmtY from ar_bills where bill_date BETWEEN '$stDtY' AND '$EdDtY'");
$rowARY=mysql_fetch_array($sqlARY);

$sqlEY=mysql_query("select sum(debit) AS exYTrf from guest_trans where rev_desc='Extra Person' AND trans_date BETWEEN '$stDtY' AND '$EdDtY'");
$rowEY=mysql_fetch_array($sqlEY);
$ytotSal=$rowT['yrTrf']+$rowEY['exYTrf'];

$sqlMY=mysql_query("select sum(tax_val) AS mnYTxat from guest_trans where rev_desc='Luxury Tax' AND trans_date BETWEEN '$stDtY' AND '$EdDtY'");
$rowMY=mysql_fetch_array($sqlMY);

$sqlSY=mysql_query("select sum(tax_val) AS mnSYTxat from guest_trans where rev_desc='Service Tax' AND trans_date BETWEEN '$stDtY' AND '$EdDtY'");
$rowSY=mysql_fetch_array($sqlSY);
$yrThttTx=$rowMY['mnYTxat']+$rowSY['mnSYTxat'];

$sqlYx=mysql_query("select count(distinct room_no) AS tdrYNcnt from guest_trans where trans_date BETWEEN '$stDtY' AND '$EdDtY' AND bill_status='2'");
$rowYx=mysql_fetch_array($sqlYx);

$sqlx=mysql_query("select count(distinct room_no) AS tdRyYNcnt from guest_trans where trans_date BETWEEN '$stDtY' AND '$EdDtY' AND bill_status='1'");
$rowx=mysql_fetch_array($sqlx);

$occuY=$rowx['tdRyYNcnt']/$numRows*100;

?>
<tr>
	<td><?php echo sprintf("%01.2f",$rowT['yrTrf']); ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo $rowEY['exYTrf']; ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo $ytotSal; ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo sprintf("%01.2f",$rowMY['mnYTxat']); ?></td>
</tr>
<tr>
	<td><?php echo sprintf("%01.2f",$rowSY['mnSYTxat']); ?></td>
</tr>
<tr>
		<td><?php echo sprintf("%01.2f",$yrThttTx); ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo $numRows; ?></td>
</tr>
<tr>
	<td><?php echo $rowx['tdRyYNcnt']; ?></td>
</tr>
<tr>
	<td><?php echo (sprintf("%01.2f",$occuY)).'%'; ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td><?php echo round(sprintf("%01.2f",$cshYr)); ?></td>
</tr>
<tr>
	<td><?php echo round(sprintf("%01.2f",$yrCard)); ?></td>
</tr>
<tr>
	<td><?php echo round(sprintf("%01.2f",$rowARY['daBlAmtY'])); ?></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>
<tr>
	<td></td>
</tr>

</table>
	</div>
	</div>
	</body>
 </form>