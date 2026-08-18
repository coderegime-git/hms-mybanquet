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

$('#searchBtn').click(function(){
	item="?val="+$('#searchTxt').val();
	document.location.href="check_out_bill.php"+item;
	}); 
	
	
jQuery("#roommaster").validationEngine();
$(".ckPrint").show();

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
function printPage(){
			/* $(".ckPrint").hide(); */
			 /* $('.ckPrint').delay(5000).hide(0);  */ 
			$('.ckPrint').hide().delay(3000).show(0);
			$('.Ckk').hide().delay(3000).show(0);					
			var divContents = $("#dvContainer").html();
		    var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print(); 
}
function showsales() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
if(fromdate!="" && todate!="")
{
document.location="check_out_bill.php?fromdate="+fromdate+"&todate="+todate;
}

}
</script>
<body class="bgBODY">
<form id="taxTypes" name="taxTypes" class="" style=""> 
<div class="" style="height:500px;overflow:auto;">	
<div style="margin:0px 0 10px 750px;">
</div>

<table style="width:45%;float:left;">	
<tr>
<td> <button type="button" id="print" style="display:none;margin:38px 0 -3px 145px;" class="myButpRN btnn" onclick="popupBillPrint()">Print</button></td>
</tr>
</table>
<!--<table style="position:absolute;left:0;">	
<tr>
<td> <button type="button" id="print" style="display:none;margin:10px 0 -3px 145px;" class="submitbtnprint btnn" onclick="popupBillPrint()">Print</button></td>
<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 100px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td>
	<a href="<?php echo $home_path ?>/reports/checkout/xt_viewCheckOutBills-xls.php?fromdate=<?php echo $_GET['fromdate']?>&todate=<?php echo $_GET['todate']?>" style="margin:0px 0 0 62px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="margin:0 0 0 -103px;" class="myButeXL btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Checkout Bill&nbsp;</button></a>
</td>
<td>
	<input type="button" value="Print" class="myButsprn" onclick="printPage();" style="margin:0 0 0 128px;font-weight: bold;padding: 5px;">
</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Search" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="" />

	<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="myButSRc btnn"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>
</td>	
</tr>
</table>-->
<div style="overflow:auto;height:420px;width:99%;" id="dvContainer">
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$ad=explode('/',$adtCurDt);
$addC=$ad[2].'-'.$ad[1].'-'.$ad[0];
?>
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:15px 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="16" style="text-align:center;"><h3 class="viewDT"><b>View Resettlement</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Bill no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Bill date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">FP no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Bill amount</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Cash</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Card</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Company</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Cheque</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Neft</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Room</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Refund</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Void</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Remarks</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Status</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Resettle</th>
	</tr>
	<?php 
$sql=mysql_query("select * from bq_opbillstldtl where settleflag='1' AND str_to_date(bill_date,'%d/%m/%Y') = '$addC' group by bill_no order by bill_no ASC");
$x=0;$debt=0;$crdt=0;$taxAmt=0;
if(mysql_num_rows($sql)>0) {
while($row=mysql_fetch_array($sql)) {

$settleflag=$row['settleflag'];
if($settleflag=='3'){
	$settle='Cancelled';
}else if($settleflag=='1'){
	$settle='Settled';
}
$x++;
?>
	<tr>
		<td width="30" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['bill_no']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['bill_date']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['fpno']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['billamt']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['cash']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['card']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['company']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['cheque']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['neft']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['room']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['refund']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['void']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['remarks']; ?></td>
		<?php if($settle=='Cancelled'){ ?>
		<td width="80" class="fstChUPPRCase" style="color:red;"><?php echo $settle; ?></td>
		<?php }else if($settle=='Settled'){?>
		<td width="80" class="fstChUPPRCase"><?php echo $settle; ?></td>
		<?php } ?>
		<td width="80">
		<a href="resettlement.php?blNo=<?php echo $row['bill_no']; ?>&rgNm=<?php echo $row['reg_num']; ?>&billNm=<?php echo $row['bill_no']; ?>" style="" class="btnH">Resettle</a>&nbsp;
		</td>
	</tr>
<?php } }  ?>	
</table>
	</div>
	</div>
	</body>
 </form>