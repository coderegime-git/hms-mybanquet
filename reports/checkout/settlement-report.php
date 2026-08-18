<?php
ob_start();
error_reporting(0);
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
	yearRange:"-5:+5",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-5:+5",
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
			$('.dispSHw').show().delay(1000).hide(0);			
			var divContents = $("#dvContainer").html();
		    var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>&nbsp;</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print(); 
}

function clkSubmit() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
out=$('#outlet').val();
con=$('#consol').val();
ven=$('#venue').val();
if(fromdate!="" && todate!="" && out!="")
{
document.location="settlement-report.php?fromdate="+fromdate+"&todate="+todate+"&ven="+ven;
}
}


function selRefNo(vl,ot){
	val=$('#bn'+vl).val();

		newwindow=window.open('<?php echo $home_path; ?>/transaction/view/print-bqt-billing.php?blN='+vl+'&vucNo='+ot,"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
		newwindow.focus(); 

}


</script>
<?php
$sql=mysql_query("select * from property_definition where propdef_id='1'");
$row=mysql_fetch_array($sql);
$prop_name=$row['prop_name'];
$city=$row['city'];
$phone=$row['phone'];

?>
<body class="bgBODY">

<div class="" style="">	
<table style="width:50%;margin:10px 0 10px 0px;">	
<tr>
<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input name="from_date" style="width:100px;margin:0px 0 0 0;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td style="width:80px;">
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>

<td><label style="width:100px;"><b>Venue :</b></label></td>
<td>
	<?php $sqlBS=mysql_query("select distinct venue_code,venue_desc from bq_venue where status='1'"); ?>
	<select name="venue" id="venue" class="fstChUPPRCase" style="width:150px;float:left;font-size:12px;" onChange="selVenueName('<?php echo $cc;?>');">
	<option value="">--Select--</option>
	<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  
	if(isset($_GET['ven'])&& $_GET['ven']==$rowBS['venue_code']){
	?>
	<option value="<?php  echo $rowBS['venue_code']; ?>" selected ><?php  echo $rowBS['venue_desc'];?></option>
	<?php }else{ ?>
	<option value="<?php  echo $rowBS['venue_code']; ?>"><?php  echo $rowBS['venue_desc'];?></option>
	<?php  } } ?>
	</select>
</td>

<td>
	<input name="submt" style="margin:0 0 0 20px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
</td>
<td>
	<a href="<?php echo $home_path ?>/reports/checkout/xt_settlement_report_xls.php?fromdate=<?php echo $_GET['fromdate']?>&todate=<?php echo $_GET['todate']?>&ven=<?php echo $_GET['ven']?>" style="margin:0px 0 0 62px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="margin:0 0 0 44px;" class="myButeXL btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Export&nbsp;</button></a>
</td>
<td>
	<input type="button" value="Print" class="myButsprn" onclick="printPage();" style="margin:0 0 0 75px;font-weight: bold;padding: 5px;">
</td>

</tr>
</table>
</div>



<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" class="table" style="margin:0px 0 0px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
	<td colspan="35" style="text-align:center;"><h3 class="viewDTT"><b>SETTLEMENT REPORT</b></h3><b></b></td>
	</tr>
</table>

<form id="taxTypes" name="taxTypes" class="" style="overflow:auto;"> 
<div style="" >
<div class="scrollingtable frmCentrR" id="dvContainer" style="top:134px;" >
  <div>
    <div style="">
<table border="1" cellpadding="0" cellspacing="0" style="text-align:center;font-size:12px;">
<thead>
	<tr>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Sl.no" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="Bill#" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="Bill Date" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:70px;"><div label="Gst/Comp" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Venue" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Function" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Pax" ></div></th>
		<!--<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Rate/Pax" ></div></th>-->
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Bill Amt" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Advance" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Cash" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Card" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Company" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="UPI" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Cheque" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Neft" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Room" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Refund" ></div></th>
		
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="card_desc" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="ccno" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="compname" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="remarks" ></div></th>
		<!--<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:50px;"><div label="Hall Chrg" ></div></th>-->

<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="Settled by" ></div></th>
<th class="scrollbarhead"></th>
</tr>

</thead>
	
<thead class="dispSHw" style="display:none;">
<tr >
	<td colspan="37" style="text-align:center;font-size:14px;font-weight:bold;"><?php echo $prop_name.', '.$city; ?></td>
</tr>
<tr>
	<td colspan="37" style="text-align:center;"><h3 class="viewDT"><b>SETTLEMENT Report from <?php if(isset($_GET['fromdate'])){echo $_GET['fromdate']; } ?> to <?php if(isset($_GET['todate'])){echo $_GET['todate']; } ?></b></h3><b></b></td>
</tr>
<tr>
	<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Sl.no</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill#</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill Date</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Guest/Company Name</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Venue</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">FnDate</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Pax</th>
	<!--<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Rate/Pax</th>-->
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">Bill Amt</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">Advance</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Cash</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Card</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Company</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">UPI</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Cheque</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Neft</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Room</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Refund</th>

	
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">Card desc</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">ccno</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">Company</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">Remarks</th>
	<!--<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">Hall Chrg</th>-->

<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Settled by</th>
</tr>
</thead>
	
<tbody>
<?php 
if(isset($_GET['fromdate'],$_GET['todate'])) {
	$fr=explode('/',$_GET['fromdate']);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	$to=explode('/',$_GET['todate']);
	$tod=$to[2].'-'.$to[1].'-'.$to[0];

	
if(isset($_GET['ven']) && $_GET['ven']=='all'){
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' order by opbillhdr_id ASC";
$sql=mysql_query("select * from bq_opbillhdr $item_where");
}else if(isset($_GET['ven']) && $_GET['ven']==''){
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' order by opbillhdr_id ASC";
$sql=mysql_query("select * from bq_opbillhdr $item_where");
}else if(isset($_GET['ven']) && $_GET['ven']!='all' && $_GET['ven']!=''){
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND venue='".$_GET['ven']."' order by opbillhdr_id ASC";
$sql=mysql_query("select * from bq_opbillhdr $item_where");	
	/* echo "select * from bq_opbillhdr $item_where"; */
}else{
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' order by opbillhdr_id ASC";
$sql=mysql_query("select * from bq_opbillhdr $item_where");	
}

$x=0;$debt=0;$crdt=0;$taxAmt=0;$ratechrg=0;$billamt=0;$cash=0;$card=0;$company=0;$UPI=0;$cheque=0;$neft=0;$room=0;$refund=0;$advamt=0;$itemTotal=0;$gpax=0;$gPx=0;

if(mysql_num_rows($sql)>0) {
while($row=mysql_fetch_array($sql)) {
	$x++;

if($row['bill_status']=='3'){
	$bgcolor= '#ff0000';
}else{
	$bgcolor= '#000';
}


if($row['remarks']==''){
	$remarks= $row['remarks'];
}else{
	$remarks= '';
}
$rem=rtrim($remarks,',');

$rVn=mysql_fetch_array(mysql_query("select * from bq_venue where venue_code='".$row['venue']."'"));
$rbk=mysql_fetch_array(mysql_query("select * from bq_hallbooking where booking_no='".$row['bkno']."'"));
$rbf=mysql_fetch_array(mysql_query("select func_desc from bq_function where func_code='".$rbk['funct']."'"));
$rbp=mysql_fetch_array(mysql_query("select ratechrg,fpno from bq_opfpmenuhdr where bkno='".$row['bkno']."' and bill_status!='3'"));
$rbh=mysql_fetch_array(mysql_query("select * from bq_opbillhdtl where itemcode='Hall' AND bill_no='".$row['bill_no']."'"));
if($rbh['item_total']>0){
	$item_total=$rbh['item_total'];
}else{
	$item_total='0';
}
$sqBl=mysql_fetch_array(mysql_query("select * from bq_opbillstldtl where bill_no='".$row['bill_no']."' "));

$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3' order by opbillhdr_id ASC";
$sqBs=mysql_fetch_array(mysql_query("select SUM(billamt)AS blAm from bq_opbillhdr $item_where"));

$sqV=mysql_fetch_array(mysql_query("select * from bq_opvchrhdr where fpno='".$rbp['fpno']."' AND bill_status!='3'"));
if($rbp['fpno']=='283'){
/* $gpax=$row['gpax'];	 */
}else{
$gpax=$sqV['gpax'];		
}
$gPx+=$sqV['gpax'];
?>
<tr>

<td width="" style="text-align:center;" style="width:50px;"><?php echo $x; ?></td>
<td width="" class="codesUPPERCase bN" style="width:100px;text-align:left;color:<?php echo $bgcolor; ?>" onclick="selRefNo('<?php echo $row['bill_no']; ?>','<?php echo $sqBl['vouchrno'];?>');"><input type="hidden" id="bn<?php echo $row['bill_no'];?>" value="<?php echo $row['bill_no']; ?>"/><?php echo $row['bill_no']; ?></td>
<td width="" class="fstChUPPRCase" style="width:100px;color:<?php echo $bgcolor; ?>"><?php echo $row['bill_date']; ?></td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:70px;color:<?php echo $bgcolor; ?>"><?php echo strtoupper($row['fname']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:<?php echo $bgcolor; ?>"><?php echo strtoupper($rVn['venue_desc']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:<?php echo $bgcolor; ?>"><?php echo strtoupper($rbf['func_desc']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:<?php echo $bgcolor; ?>"><?php echo $gpax; ?></td>
<!--<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php /* echo sprintf("%01.2f",$rbp['ratechrg']); */ ?></td>-->
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$row['billamt']+$row['advamt']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$row['advamt']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBl['cash']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBl['card']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBl['company']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBl['upi']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBl['cheque']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBl['neft']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBl['room']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBl['refund']); ?></td>


<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo $sqBl['card_desc']; ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo $sqBl['ccno']; ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo $sqBl['compname']; ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php echo $bgcolor; ?>"><?php echo $sqBl['remarks']; ?></td>
<!--<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:<?php /* echo $bgcolor; */ ?>"><?php /* echo sprintf("%01.2f",$item_total); */ ?></td>-->

<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo strtoupper($sqBl['added_by']); ?></td>	
</tr>
<?php
$gpax+=$row['gpax'];
$ratechrg+=$rbp['ratechrg'];
$billamt+=$row['billamt'];
$cash+=$sqBl['cash'];
$card+=$sqBl['card'];
$company+=$sqBl['company'];
$UPI+=$sqBl['upi'];
$cheque+=$sqBl['cheque'];
$neft+=$sqBl['neft'];
$room+=$sqBl['room'];
$refund+=$sqBl['refund'];
$advamt+=$row['advamt'];
$itemTotal+=$item_total;
?>
<?php } } } ?>
<?php
if(isset($_GET['ven']) && $_GET['ven']!='all' && $_GET['ven']!=''){
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3' AND venue='".$_GET['ven']."' order by opbillhdr_id ASC";
$sqBs=mysql_fetch_array(mysql_query("select SUM(billamt)AS blAm,SUM(advamt)AS advaT,SUM(gpax)AS gpxlAm from bq_opbillhdr $item_where"));
}else{
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3' order by opbillhdr_id ASC";
$sqBs=mysql_fetch_array(mysql_query("select SUM(billamt)AS blAm,SUM(advamt)AS advaT,SUM(gpax)AS gpxlAm from bq_opbillhdr $item_where"));	
}
?>
<tr>
<td width="" style="text-align:center;" style="width:50px;">&nbsp;</td>
<td width="" class="codesUPPERCase bN" style="width:100px;text-align:left;color:<?php echo $bgcolor; ?>">&nbsp;</td>
<td width="" class="fstChUPPRCase" style="width:100px;color:<?php echo $bgcolor; ?>">&nbsp;</td>
<td width="" class="fstChUPPRCase" style="width:70px;color:<?php echo $bgcolor; ?>">&nbsp;</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:<?php echo $bgcolor; ?>">&nbsp;</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>">Total</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$gPx); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBs['blAm']+$sqBs['advaT']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$sqBs['advaT']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$cash); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$card); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$company); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$UPI); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$cheque); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$neft); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$room); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$refund); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>">&nbsp;</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>">&nbsp;</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>">&nbsp;</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>">&nbsp;</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>">&nbsp;</td>	

</tr>

</tbody>	
</table>
	</div>
	</div>
	</div>
	
</div>


</div>
</body>
 </form>