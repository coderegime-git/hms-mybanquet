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
venue=$('#venue').val();
if(fromdate!="" && todate!="" && out!="")
{
document.location="functionfortheday.php?fromdate="+fromdate+"&todate="+todate+"&venue="+venue;
}

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
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>

<td><label style="width:70px;"><b>Venue</b>&nbsp;&nbsp;</label></td>
<td>
<?php 
$sqlBS=mysql_query("select distinct venue_code,venue_desc from bq_venue where status='1'"); ?>
	<select name="venue" id="venue" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" onChange="selVenueName();">
	<option value="">--Select--</option>
	<option value="">All</option>
	<?php 
	
	while($rowBS=mysql_fetch_array($sqlBS)) {
if($rowBS['venue_code']==$_GET['venue']){		
	?>

	<option value="<?php  echo $rowBS['venue_code']; ?>" selected ><?php  echo $rowBS['venue_desc'];?></option>
<?php }else{ ?>
	<option value="<?php  echo $rowBS['venue_code']; ?>"><?php  echo $rowBS['venue_desc'];?></option>
	<?php  } }  ?>
	</select>
</td>	
<td>
	<input name="submt" style="margin:0 0 0 20px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
</td>
<td>
	<a href="<?php echo $home_path ?>/reports/checkout/xt_functionfortheday_report_xls.php?fromdate=<?php echo $_GET['fromdate']?>&todate=<?php echo $_GET['todate']?>&venue=<?php echo $_GET['venue']?>" style="margin:0px 0 0 62px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="margin:0 0 0 44px;" class="myButeXL btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Export&nbsp;</button></a>
</td>
<td>
	<input type="button" value="Print" class="myButsprn" onclick="printPage();" style="margin:0 0 0 75px;font-weight: bold;padding: 5px;">
</td>

</tr>
</table>
</div>



<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="1" class="table" style="margin:0px 0 0px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
	<td colspan="35" style="text-align:center;"><h3 class="viewDTT"><b>Functions for the Day Report</b></h3><b></b></td>
	</tr>
</table>

<form id="taxTypes" name="taxTypes" class="" style="overflow:auto;"> 
<div style="" >
<div class="scrollingtable frmCentrR" id="dvContainer" style="top:134px;width:100%;" >
  <div>
    <div style="">
<table border="1" cellpadding="0" cellspacing="0" style="text-align:center;font-size:12px;">
<thead>
		<tr>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Sl.no" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Booking#" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Fn Date" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Gst Name" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Session" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="From" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="To" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Function" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Phone" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Email" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Company" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Booked By" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="status" ></div></th>
		<th class="scrollbarhead"></th>
	</tr>
</thead>
	
<thead class="dispSHw" style="display:none;">
<tr >
	<td colspan="37" style="text-align:center;font-size:14px;font-weight:bold;"><?php echo $prop_name.', '.$city; ?></td>
</tr>
<tr>
	<td colspan="37" style="text-align:center;"><h3 class="viewDT"><b>Functions for the Day Report from <?php if(isset($_GET['fromdate'])){echo $_GET['fromdate']; } ?> to <?php if(isset($_GET['todate'])){echo $_GET['todate']; } ?></b></h3><b></b></td>
</tr>
<tr>
	<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Sl.no</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Booking#</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Fn Date</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Gst Name</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Session</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">From</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">To</th>
    <th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Function</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Phone</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Email</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Company</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Booked By</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">status</th>
	</tr>
	</thead>
	
<tbody>
<?php 
if(isset($_GET['fromdate'],$_GET['todate'])) {
	$fr=explode('/',$_GET['fromdate']);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	$to=explode('/',$_GET['todate']);
	$tod=$to[2].'-'.$to[1].'-'.$to[0];
if(isset($_GET['venue']) && $_GET['venue']!=''){
$sdep=mysql_query("select distinct venue_code,venue_desc from bq_venue where venue_code='".$_GET['venue']."' AND status='1'");
}else{
$sdep=mysql_query("select distinct venue_code,venue_desc from bq_venue where status='1'");	
}
while($rwp=mysql_fetch_array($sdep)){
$item_where=" where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND venue='".$rwp['venue_code']."' AND confirm_status='2' order by hallbook_id ASC";
/* echo "select * from bq_opbillhdr $item_where"; */
$sql=mysql_query("select * from bq_hallbooking $item_where");
$x=0;$debt=0;$crdt=0;$taxAmt=0;$ratechrg=0;$billamt=0;$advamt=0;$gpax=0;$Tgpax=0;$cgst=0;$sgst=0;
if(mysql_num_rows($sql)>0) {
	?>
<tr>
<td style="text-align:left;width:120px;color:#FF0034;font-weight:bold;" colspan="13"><?php echo strtoupper($rwp['venue_desc']); ?></td>
</tr>
<?php
while($row=mysql_fetch_array($sql)) {
	$x++;

if($row['confirm_status']=='2'){
	$bgcolor= '#ff0000';
} else {
	$bgcolor= '#000';
}

$rem=rtrim($remarks,',');

$rbk=mysql_fetch_array(mysql_query("select * from bqt_session where sess_code='".$row['session']."'"));
$rbf=mysql_fetch_array(mysql_query("select func_desc from bq_function where func_code='".$row['funct']."'"));
$rbp=mysql_fetch_array(mysql_query("select ratechrg,fpno from bq_opfpmenuhdr where bkno='".$row['bkno']."'"));
$rbh=mysql_fetch_array(mysql_query("select * from bq_opbillhdtl where itemcode='Hall' AND bill_no='".$row['bill_no']."'"));

$sqlRd=mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
$rowRd=mysql_fetch_array($sqlRd);

if($row['confirm_status']==2) {
	$rmAVai=$rowRd['room_availability'];
	$clr=$rowRd['room_color'];
}
?>

<tr>
	<td width="" style="text-align:center;" style=""><?php echo $x; ?></td>
    <td width="" class="fstChUPPRCase" style=""><?php echo $row['booking_no']; ?></td>
	<td width="" class="fstChUPPRCase" style=""><?php echo $row['book_date']; ?></td>
	<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($row['guest_name']); ?></td>
	<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($rbk['sess_name']); ?></td>
	<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['from_time']; ?></td>
	<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['to_time']; ?></td>
	<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($rbf['func_desc']); ?></td>	
	<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['phone']; ?></td>	
	<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['email']; ?></td>	
<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($row['company_name']); ?></td>	
<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($row['contact_person']);?></td>	
<td width="" class="fstChUPPRCase" style="text-align:left;"><?php echo strtoupper($rmAVai);?></td>	
</tr>

<?php } } } } ?>

</tbody>	
</table>
	</div>
	</div>
	</div>
	
</div>


</div>
</body>
 </form>