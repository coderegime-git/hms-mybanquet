<?php
ob_start();
error_reporting(0);
include("../../config.php");
include("../../header.php");
?>
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script>
	jQuery(document).ready(function(){
		
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
	
	
	jQuery("#roommaster").validationEngine();
	});
	
	
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});

function clkSubmit() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
srtx=$('#searchTxt').val();
document.location="view-duplicateHall-advance.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
}

function srcSub(){
	$('#from_date').val('');
	$('#to_date').val('');
	$('#searchTxt').val('');
}


function opnDupADv(a,b,c){
	bk=$('#bkn').val();
	rct=$('#rct').val();
	
	
	window.open('<?php echo $home_path;?>/transaction/view/print-HallReserv-advance.php?rserNo='+a+'&rcptNo='+b+'&sts='+c, '_blank','width=1000,height=700');
}
 </script>
 
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
check.png

.butExample {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 66px;
}

</style>	

<body class="bgBODY">


<div style="margin:10px 0 0 0;">
<table style="">
<tr>

<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter Guest name / Bill# / Book#" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />

</td>

<td>
	<a href="<?php echo $home_path ?>/reports/checkout/xt_viewDUpHAllADV-xls.php?fromdate=<?php echo $_GET['fromdate']?>&todate=<?php echo $_GET['todate']?>&val=<?php echo $_GET['val']?>" style="margin:0px 0 0 62px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="" class="myButeXL btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Export&nbsp;</button></a>
</td>


</tr>
</table>
 </div>
 
 
 
 
 
 <form id="taxTypes" name="taxTypes" class="" style=""> 

<table cellpadding="0" cellspacing="0" border="1" class="table" style="margin:10px 0 0px 0px;text-align:center;font-size:12px;position;absolute;">
	<tr class="info">
		<td colspan="15" style="text-align:center;"><h3 class="viewDTT" style=""><b>View Duplicate Hall Advance</b></h3><b></b></td>
	</tr>
</table>

<form id="taxTypes" name="taxTypes" class="" > 
<div style="" >
<div class="scrollingtable frmCentrR" id="dvContainer"  >
  <div>
    <div style="">

<table style="text-align:center;font-size:12px;" border="1" cellpadding="0" cellspacing="0">
	<thead >
	<tr>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Sl.no" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Booking#" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Receipt Dt" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Receipt no" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Bill no" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Bill Dt" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Gst Name" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Venue" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Funct-Dt" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Phone" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Contact per." ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Contact no" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Adv" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Pay mode" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Remarks" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="User" ></div></th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;"><div label="Print" ></div></th>
	</tr>
</thead>




<style>
.btnH{
	padding:3px 8px;
	font-weight:bold;
}
</style>
<?php 
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$ad=explode('/',$adtCurDt);
$cur=$ad[2].'/'.$ad[1].'/'.$ad[0];

	$fr=explode('/',$_GET['fromdate']);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	$to=explode('/',$_GET['todate']);
	$tod=$to[2].'-'.$to[1].'-'.$to[0];

if(isset($_GET['fromdate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']!='') {
$item_where= " where str_to_date(cur_date,'%d/%m/%Y') >= '$frm' AND str_to_date(cur_date,'%d/%m/%Y') <= '$tod'   order by str_to_date(cur_date,'%d/%m/%Y') ASC";
$sql=mysql_query("select * from bq_hallresvadv $item_where");
}else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['val']) && $_GET['val']=='') {
$item_where= " where str_to_date(cur_date,'%d/%m/%Y') >= '$frm' AND str_to_date(cur_date,'%d/%m/%Y') <= '$tod' order by str_to_date(cur_date,'%d/%m/%Y') ASC";
$sql=mysql_query("select * from bq_hallresvadv $item_where");
} else if(isset($_GET['val']) && $_GET['val']!='') {
$item_where= " where guest_name like '%".$_GET['val']."%' OR booking_no like '%".$_GET['val']."%' OR receipt_no like '%".$_GET['val']."%'  order by str_to_date(cur_date,'%d/%m/%Y') ASC";
$sql=mysql_query("select * from bq_hallresvadv $item_where");
}else{
$sql=mysql_query("select * from bq_hallresvadv where str_to_date(cur_date,'%d/%m/%Y') >= '$frm' AND str_to_date(cur_date,'%d/%m/%Y') <= '$tod' order by str_to_date(cur_date,'%d/%m/%Y') ASC"); 
}
/* $sql=mysql_query("select * from bq_hallresvadv where bill_status!='3'"); */
$x=0;
while($row=mysql_fetch_array($sql)) {
$x++;

$rw=mysql_fetch_array(mysql_query("select * from bq_hallbooking where hallbook_id='".$row['hallbook_id']."'"));
/* $rwH=mysql_fetch_array(mysql_query("select * from bq_opbillstldtl where hallbook_id='".$row['hallbook_id']."'")); */
$rwHh=(mysql_query("select * from bq_opbillstldtl where hallbook_id='".$row['hallbook_id']."'"));
if(mysql_num_rows($rwHh)>0){
	$rwH=mysql_fetch_array($rwHh);
}else{
$rwH=mysql_fetch_array(mysql_query("select * from bq_opbillstldtl where bkno='".$row['booking_no']."'"));	
}


if($row['status']!='3'){
?>
<tr>
<input type="hidden" name="bkn" id="bkn" value="<?php echo $row['booking_no']?>"/>
<input type="hidden" name="rct" id="rct" value="<?php echo $row['receipt_no']?>"/>

	<td width="80" style="text-align:center;"><?php echo $x;  ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['booking_no']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['cur_date']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['receipt_no']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $rwH['bill_no']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $rwH['bill_date']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['guest_name']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($rw['venue']); ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($row['function_date']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $rw['phone']; ?></td>
	<td width="80" style="text-align:left;"><?php echo strtoupper($rw['contact_person']); ?></td>
	<td width="80" style="text-align:center;"><?php echo $rw['contact_mobile']; ?></td>
	<td width="80" style="text-align:center;"><?php echo $row['amount']+$row['sgst']+$row['cgst']; ?></td>
	<td width="80" style="text-align:center;"><?php echo ucfirst($row['pay_mode']); ?></td>
	<td width="80" style="text-align:center;"><?php echo ucfirst($row['remarks']); ?></td>
	<td width="80" style="text-align:center;"><?php echo ucfirst($row['added_by']); ?></td>
	<td width="80" style="text-align:center;" onclick="opnDupADv('<?php echo $row['booking_no']?>','<?php echo $row['receipt_no']?>','<?php echo $rw['confirm_status']?>');"><a href="#" style="" class="btnH">Print
	</a></td>
</tr>
<?php } } ?>	
</table>

	</div>
	</div>
	</div>
	</div>	

	<?php include("../../footer.php"); ?>
	</body>
 </form>