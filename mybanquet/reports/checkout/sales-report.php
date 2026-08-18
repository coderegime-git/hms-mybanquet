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
if(fromdate!="" && todate!="" && out!="")
{
document.location="sales-report.php?fromdate="+fromdate+"&todate="+todate+"&out="+out+"&con="+con;
}
out
}


function selRefNo(vl,ot){
	val=$('#bn'+vl).val();
	/* alert(ot); */
	if(ot=='SPA'){
		newwindow=window.open('<?php /* echo $_SERVER['HTTP_HOST']; */?>http://localhost:8081/mybanquet/transaction/view/spa-bill-print.php?billNo='+val+'&ouLt='+ot,"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
		newwindow.focus(); 
	}else{
		newwindow=window.open('<?php /* echo $_SERVER['HTTP_HOST']; */?>http://localhost:8081/mybanquet/transaction/view/roomservice_bill_print_trans.php?billNo='+val+'&ouLt='+ot,"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
		newwindow.focus(); 
	}
	
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
	<input name="to_date" style="width:100px;margin:0px 100px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>

<td>
	<input name="submt" style="margin:0 0 0 20px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
</td>
<td>
	<a href="<?php echo $home_path ?>/reports/checkout/xt_sales_report_xls.php?fromdate=<?php echo $_GET['fromdate']?>&todate=<?php echo $_GET['todate']?>" style="margin:0px 0 0 62px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="margin:0 0 0 44px;" class="myButeXL btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Export&nbsp;</button></a>
</td>
<td>
	<input type="button" value="Print" class="myButsprn" onclick="printPage();" style="margin:0 0 0 75px;font-weight: bold;padding: 5px;">
</td>

</tr>
</table>
</div>



<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" class="table" style="margin:0px 0 0px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
	<td colspan="35" style="text-align:center;"><h3 class="viewDTT"><b>SALES REPORT</b></h3><b></b></td>
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
	
<?php
$sqlTS=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
while($rowtS=mysql_fetch_array($sqlTS)){
?>
<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="<?php echo ucwords($rowtS['grpname']); ?>" ></div></th>
<?php } ?>
<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="Net Amt" ></div></th>
<?php
$sqlTS=mysql_query("select * from bq_taxstruct where status='1' group by tax_code");
while($rowtS=mysql_fetch_array($sqlTS)){
?>
<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="<?php echo $rowtS['tax_code']; ?>"></div></th>
<?php } ?>
<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="Disc" ></div></th>
<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="RND" ></div></th>
<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="Grand Total" ></div></th>
<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><div label="Billed by" ></div></th>
<th class="scrollbarhead"></th>
</tr>

</thead>
	
<thead class="dispSHw" style="display:none;">
<tr >
	<td colspan="37" style="text-align:center;font-size:14px;font-weight:bold;"><?php echo $prop_name.', '.$city; ?></td>
</tr>
<tr>
	<td colspan="37" style="text-align:center;"><h3 class="viewDT"><b>Sales Report from <?php if(isset($_GET['fromdate'])){echo $_GET['fromdate']; } ?> to <?php if(isset($_GET['todate'])){echo $_GET['todate']; } ?></b></h3><b></b></td>
</tr>
<tr>
	<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Sl.no</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill#</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill Date</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Guest/Company Name</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Venue</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Function</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Pax</th>
<?php
$sqS=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
while($roS=mysql_fetch_array($sqS)){
?>
<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><?php echo ucwords($roS['grpname']); ?></th>
<?php } ?>
<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">Net Amt</th>
<?php

$sqlTS=mysql_query("select * from bq_taxstruct where status='1' group by tax_code");
while($rowtS=mysql_fetch_array($sqlTS)){
?>
<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;"><?php echo $rowtS['tax_code']; ?></th>
<?php } ?>

<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Disc</th>
<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">RND</th>
<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Grand Total</th>
<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Billed by</th>
</tr>
</thead>
	
<tbody>
<?php 
if(isset($_GET['fromdate'],$_GET['todate'])) {
	$fr=explode('/',$_GET['fromdate']);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	$to=explode('/',$_GET['todate']);
	$tod=$to[2].'-'.$to[1].'-'.$to[0];

$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' order by opbillhdr_id ASC";
$sql=mysql_query("select * from bq_opbillhdr $item_where");
$x=0;$debt=0;$crdt=0;$taxAmt=0;$ratechrg=0;$billamt=0;$advamt=0;$gpax=0;$Tgpax=0;$cgst=0;$sgst=0;
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

$rbk=mysql_fetch_array(mysql_query("select * from bq_hallbooking where booking_no='".$row['bkno']."'"));
$rbf=mysql_fetch_array(mysql_query("select func_desc from bq_function where func_code='".$rbk['funct']."'"));
$rbp=mysql_fetch_array(mysql_query("select ratechrg,fpno from bq_opfpmenuhdr where bkno='".$row['bkno']."'"));
$rbh=mysql_fetch_array(mysql_query("select * from bq_opbillhdtl where itemcode='Hall' AND bill_no='".$row['bill_no']."'"));
if($rbh['item_total']>0){
	$item_total=$rbh['item_total'];
	
}else{
	$item_total='0';
}
$gpax+=$row['gpax'];

$sqV=mysql_fetch_array(mysql_query("select * from bq_opvchrhdr where fpno='".$rbp['fpno']."' AND bill_status!='3'"));
$Tgpax+=$sqV['gpax'];

?>
<tr>
	<td width="" style="text-align:center;" style="width:50px;"><?php echo $x; ?></td>

	<td width="" class="codesUPPERCase bN" style="width:100px;text-align:left;color:<?php echo $bgcolor; ?>" onclick="selRefNo('<?php echo $row['bill_no']; ?>');"><input type="hidden" id="bn<?php echo $row['bill_no'];?>" value="<?php echo $row['bill_no']; ?>"/><?php echo $row['bill_no']; ?></td>
	<td width="" class="fstChUPPRCase" style="width:100px;color:<?php echo $bgcolor; ?>"><?php echo $row['bill_date']; ?></td>
	<td width="" class="fstChUPPRCase" style="width:70px;text-align:left;color:<?php echo $bgcolor; ?>"><?php echo $row['fname']; ?></td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:<?php echo $bgcolor; ?>"><?php echo $rbk['venue']; ?></td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:<?php echo $bgcolor; ?>"><?php echo strtoupper($rbf['func_desc']); ?></td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:<?php echo $bgcolor; ?>"><?php echo $sqV['gpax']; ?></td>
	
<?php
$sqlTS=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
while($rowtS=mysql_fetch_array($sqlTS)){ 
$sqL=mysql_query("select sum(item_total)AS grpAmt from bq_opbillhdtl where bill_no='".$row['bill_no']."' AND grpcode='".$rowtS['grpcode']."' AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rowL=mysql_fetch_array($sqL);
?>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$rowL['grpAmt']); ?></td>	
<?php } ?>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo $row['nontaxableamt']; ?></td>	
<?php
if($row['sgst']>0){ 
$cgst+=$row['cgst'];
$sgst+=$row['sgst'];
?>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo $row['cgst']; ?></td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo $row['sgst']; ?></td>	
<?php } else {
$sTS=mysql_query("select * from bq_taxstruct where status='1' group by tax_code");
$txAMt=0;
while($rwS=mysql_fetch_array($sTS)){
	
	$rw=mysql_fetch_array(mysql_query("select vouchrno from bq_opbillhdtl where bill_no='".$row['bill_no']."' "));
	$sqS=mysql_query("select sum(taxamt)AS txAMt from bq_opvchrtaxdtl where vouchrno='".$rw['vouchrno']."' AND taxcode='".$rwS['tax_code']."' AND str_to_date(vchrdate,'%d/%m/%Y') >= '$frm' AND str_to_date(vchrdate,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
	while($rotS=mysql_fetch_array($sqS)){
		if($rotS['txAMt']!="" && $rotS['txAMt']!="0"){
			$txAMt=sprintf("%01.2f",$rotS['txAMt']);
		}else if($rotS['txAMt']==0.00){
			$txAMt="";
		}
		}
?>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo $txAMt; ?></td>
<?php } } ?>
<?php
$rRnd=mysql_fetch_array(mysql_query("select * from bq_opbillhdtl where itemcode='RND' AND bill_no='".$row['bill_no']."'"));
?>
	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo $row['discamt']; ?></td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo $rRnd['itemrate']; ?></td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo round($row['billamt']+$row['roundoff']+$row['advamt']); ?></td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:<?php echo $bgcolor; ?>"><?php echo strtoupper($row['added_by']); ?></td>	
	</tr>
<?php
$ratechrg+=$rbp['ratechrg'];
$billamt+=$row['billamt'];
$advamt+=$row['advamt'];
?>
<?php } } } ?>

<?php
$sqlbl=mysql_query("select SUM(nontaxableamt)AS nontax,SUM(taxableamt)AS taxable,SUM(discamt)AS discable,SUM(billamt)AS billable,SUM(gpax)AS tGpaxx from bq_opbillhdr where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rwbl=mysql_fetch_array($sqlbl);

?>
 
<tr>
	<td width="" style="text-align:center;" style="width:50px;">&nbsp;</td>

	<td width="" class="codesUPPERCase bN" style="width:100px;text-align:left;color:<?php echo $bgcolor; ?>" >&nbsp;</td>
	<td width="" class="fstChUPPRCase" style="width:100px;color:<?php echo $bgcolor; ?>">&nbsp;</td>
	<td width="" class="fstChUPPRCase" style="width:70px;text-align:left;color:<?php echo $bgcolor; ?>">&nbsp;</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:<?php echo $bgcolor; ?>">&nbsp;</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>">Total</td>
	<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php  /* echo $rwbl['tGpaxx']; */?></td>
<?php
$sqlTS=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
while($rowtS=mysql_fetch_array($sqlTS)){
$sqL=mysql_query("select SUM(item_total)AS itmTot  from bq_opbillhdtl where grpcode='".$rowtS['grpcode']."' AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rowL=mysql_fetch_array($sqL);
?>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$rowL['itmTot']); ?></td>	
<?php } ?>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php  echo sprintf("%01.2f",$rwbl['nontax']); ?></td>	
<?php
if($cgst>0){ 

$scg=mysql_query("select sum(cgst)AS cgst from bq_opbillhdr where cgst>0 AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rcg=mysql_fetch_array($scg);

$ssg=mysql_query("select sum(sgst)AS sgst from bq_opbillhdr where sgst>0 AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rsg=mysql_fetch_array($ssg);
	
?>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php  echo sprintf("%01.2f",$rcg['cgst']); ?></td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php  echo sprintf("%01.2f",$rsg['sgst']); ?></td>

<?php }else{ ?>
<?php
$sTS=mysql_query("select * from bq_taxstruct where status='1' group by tax_code");
$txAMt=0;
while($rwS=mysql_fetch_array($sTS)){
	
	$rw=mysql_fetch_array(mysql_query("select vouchrno from bq_opbillhdtl where bill_no='".$row['bill_no']."' "));

	$sqS=mysql_query("select sum(taxamt)AS txAMtt from bq_opvchrtaxdtl where taxcode='".$rwS['tax_code']."' AND str_to_date(vchrdate,'%d/%m/%Y') >= '$frm' AND str_to_date(vchrdate,'%d/%m/%Y') <= '$tod' AND bill_status!='3' group by taxcode");
	$rotS=mysql_fetch_array($sqS);
		if($rotS['txAMtt']!="" && $rotS['txAMtt']!="0"){
			$txAMtt=sprintf("%01.2f",$rotS['txAMtt']);
		}else if($rotS['txAMtt']==0.00){
			$txAMtt="";
		}
?>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo sprintf("%01.2f",$txAMtt); ?></td>
<?php /* } */ } } ?>
<?php
/* $rRndT=mysql_fetch_array(mysql_query("select SUM(itemrate)AS rndOf from bq_opbillhdtl where itemcode='RND' AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod'")); */
$rRndT=mysql_fetch_array(mysql_query("select SUM(roundoff)AS rndOf,SUM(advamt)AS adv from bq_opbillhdr where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'"));
?>

<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo  sprintf("%01.2f",$rwbl['discable']); ?></td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo  sprintf("%01.2f",$rRndT['rndOf']); ?></td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo  round($rwbl['billable']+$rRndT['rndOf']+$rRndT['adv']); ?></td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:<?php echo $bgcolor; ?>"><?php echo strtoupper($row['added_by']); ?></td>	
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