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
  document.location.href="ar_receipts_report.php"+comp;	
  });
  
  $('#billsrcv').change(function() {
  bls="";
  if($(this).val()!=''){bls = "?bls="+$(this).val(); }
  document.location.href="ar_receipts_report.php"+bls;	
  });

  
$('#searchBtn').click(function(){
	item="?val="+$('#searchTxt').val();
	document.location.href="ar_receipts_report.php"+item;
}); 
	
	
jQuery("#roommaster").validationEngine();

});


function showsales() {
/* val=$('#item_uid').val(); */
fromdate=$('#from_date').val();
todate=$('#to_date').val();
if(fromdate!="" && todate!="")
{
document.location="ar_receipts_report.php?fromdate="+fromdate+"&todate="+todate;
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
<td><label style="width:105px;"><b>Vendor :</b></label></td>
<td>
<?php $sqlBS=mysql_query("select distinct vendor_code,vendor_name from company_master where status='1'");?>
<select name="company" id="company" class="fstChUPPRCase" style="width:170px;float:left;" onChange="selCompanyName();">
<option value="">--Select--</option>
<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
<?php if($_GET['comp']==$rowBS['vendor_code']) { ?>
<option value="<?php echo $rowBS['vendor_code'];?>" selected ><?php echo $rowBS['vendor_code'];?></option>
<?php }else{ ?>
<option value="<?php echo $rowBS['vendor_code'];?>"><?php echo $rowBS['vendor_name'];?></option>
<?php } } ?>
</select>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
<!--<td>
<select name="billsrcv" id="billsrcv" style="width:100px;">
<option value="all"<?php if(isset($_GET['bls'])) {echo ($_GET['bls']=='all')?'selected':'';} ?>>All</option>
<option value="bills"<?php if(isset($_GET['bls'])) { echo ($_GET['bls']=='bills')?'selected':'';} ?>>Bills</option>
<option value="receipts"<?php if(isset($_GET['bls'])) { echo ($_GET['bls']=='receipts')?'selected':'';} ?>>Receipts</option>
</select>
</td>-->	

	<td><label style="width:80px;"><b>From :</b></label></td>
					<td>
						<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
					</td>
					<td><label style="width:70px;"><b>To :</b></label></td>
					<td>
						<input name="to_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
					</td>
<td>
		  <a href="<?php echo $home_path ?>/reports/checkout/xt_ar_receipts_report_xls.php" style="margin:0px 0 0 62px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="" class="submitbtnprint btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/></button></a>
		
</td>
<td style="width:600px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Search" style="margin-left: 32px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="" />

<button type="button" name="searchBtn" id="searchBtn" style="margin:-45px 47px 0 298px;color:#000;font-size:13px;font-weight:bold;padding:2px;width: 100px;" class="submitbtnprint btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>
</td>	
</tr>
</table>


<div style="overflow:auto;height:420px;width:99%;">
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;width:100%;"><b>AR Receipts Report</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="30" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Receipt Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Receipt no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Vendor name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Amount</th>
	</tr>
<?php 
$item_where="";
if(isset($_GET['fromdate'],$_GET['todate'])) {
$fromDate=$_GET['fromdate'];
$toDate=$_GET['todate'];
}
	if(isset($_GET['comp'])){
		$item_where= " vendor_code='".$_GET['comp']."'";
	}
	if(isset($_GET['fromdate'],$_GET['todate'])){
		$item_where= " rcpt_date BETWEEN '$fromDate' AND '$toDate'";
	}
	if(isset($_GET['val'])){
		$item_where= " arreceipt_no like '%".$_GET['val']."%'";
	} 
	

if(isset($_GET['comp'])){	
	$sql=mysql_query("select * from ar_receipts where $item_where ");
}else if(isset($_GET['fromdate'],$_GET['todate'])){
	$sql=mysql_query("select * from ar_receipts where $item_where");
}else if(isset($_GET['val'])){
	$sql=mysql_query("select * from ar_receipts where $item_where");
}else{
$sql=mysql_query("select * from ar_receipts");	
}
	if(mysql_num_rows($sql)>0) {
		$x=0;
	while($row=mysql_fetch_array($sql)) {
		$x++;
		$sqlS=mysql_query("select * from company_master where vendor_code='".$row['vendor_code']."'");
		$rowS=mysql_fetch_array($sqlS);
		$vendor_name=$rowS['vendor_name'];
		if(isset($row['remarks']) && ($row['remarks']!='Null'))
		{
			$remarks=ucfirst($row['remarks']).', ';
		}else{
			$remarks="";
		}	
	?>
	<tr>
		<td width="30" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['rcpt_date']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['rcpt_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $vendor_name; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['amount']; ?></td>
	</tr>
	<?php } } else { ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any AR Receipts report details...
    </div>
<?php } ?>
</table>
	</div>
	</div>
	</body>
 </form>