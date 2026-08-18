<?php
include('../../config.php');

$sqlPd=mysql_query("select * from  property_definition where propdef_id='1'");
$rowPd=mysql_fetch_array($sqlPd); 
$prop_name=$rowPd['prop_name'];
$phone=$rowPd['phone'];

	$output="";
	$output.='
	<table class="table" border="" style="text-align:center;border-left:1px solid #000;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">
	<tr>
		<td colspan="19" style="text-align:center;font-size:14px;font-weight:bold;" >'.$prop_name.'</td>
	</tr>	
	<tr>
		<td colspan="19" style="text-align:center;font-size:14px;font-weight:bold;">Booking Status</td>
	</tr>
	
	<table class="table" border="1" style="text-align:center;font-size:12px;">	
	<tr>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booking#</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Fn date</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Gst Name</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Venue</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Session</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">From time</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">To time</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Pax</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Function</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Phone</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Email</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Company</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booked by</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Booker no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Adv</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Recept no</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Pay mode</th>
		<th width="80" style="text-align:center;background-color:#d3524e;color:#fff;">Status</th>
	</tr>';

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$ad=explode('/',$adtCurDt);
$cur=$ad[2].'/'.$ad[1].'/'.$ad[0];

	$fr=explode('/',$_GET['fromdate']);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
	$to=explode('/',$_GET['todate']);
	$tod=$to[2].'-'.$to[1].'-'.$to[0];

if(isset($_GET['fromdate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['sts']) && $_GET['sts']!='' && $_GET['sts']!='all') {
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status='".$_GET['sts']."' AND confirm_status!=7  group by booking_no,venue order by str_to_date(book_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['sts']) && $_GET['sts']=='all') {
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status!=7  group by booking_no,venue order by str_to_date(book_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}else if(isset($_GET['fromdate']) && isset($_GET['todate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='' && isset($_GET['sts']) && $_GET['sts']=='') {
$item_where= " where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status!=7  group by booking_no,venue order by str_to_date(book_date,'%d/%m/%Y') DESC";
$sql=mysql_query("select * from bq_hallbooking $item_where");
}

$x=0;$rmAVai="";
while($row=mysql_fetch_array($sql)) {
$x++;
$sqlRv=mysql_query("select * from bq_stscolor where roomoccupy_id='1'");
$rowRv=mysql_fetch_array($sqlRv); 
$sqlRd=mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
$rowRd=mysql_fetch_array($sqlRd);
$sqlRo=mysql_query("select * from bq_stscolor where roomoccupy_id='3'");
$rowRo=mysql_fetch_array($sqlRo); 
$sqlRg=mysql_query("select * from bq_stscolor where roomoccupy_id='4'");
$rowRg=mysql_fetch_array($sqlRg);
$sqlRm=mysql_query("select * from bq_stscolor where roomoccupy_id='5'");
$rowRm=mysql_fetch_array($sqlRm);
$sqlRe=mysql_query("select * from bq_stscolor where roomoccupy_id='6'");
$rowbl=mysql_fetch_array($sqlRe);

if($row['confirm_status']==1) {
	$rmAVai=$rowRv['room_availability'];
	$clr=$rowRv['room_color'];
}else if($row['confirm_status']==2) {
	$rmAVai=$rowRd['room_availability'];
	$clr=$rowRd['room_color'];
}else if($row['confirm_status']==3) {
	$rmAVai=$rowRo['room_availability'];
	$clr=$rowRo['room_color'];
}else if($row['confirm_status']==4) {
	$rmAVai=$rowRg['room_availability'];
	$clr=$rowRg['room_color'];
}else if($row['confirm_status']==5) {
	$rmAVai=$rowRm['room_availability'];
	$clr=$rowRm['room_color'];
}else if($row['confirm_status']==6) {
	$rmAVai=$rowbl['room_availability'];
	$clr=$rowbl['room_color'];
}else if($row['confirm_status']==7) {
	$rmAVai='CANCELLED';
	$clr=$rowbl['room_color'];
}


$sqlR=mysql_query("select sum(amount)as advAmt,receipt_no,pay_mode,booking_no from bq_hallresvadv where booking_no='".$row['booking_no']."' AND status='1' AND hallbook_id='".$row['hallbook_id']."' group by booking_no");	
$rowR=mysql_fetch_array($sqlR);	

$output.='
<tr>
	<td width="80" style="text-align:center;">'.$x.'</td>
	<td width="80" style="text-align:center;">'. $row['booking_no'].'</td>
	<td width="80" style="text-align:center;">'.$row['book_date'].'</td>
	<td width="80" style="text-align:left;">'. strtoupper($row['guest_name']).'</td>
	<td width="80" style="text-align:left;">'. strtoupper($row['venue']).'</td>
	<td width="80" style="text-align:left;">'. strtoupper($row['session']).'</td>
	<td width="80" style="text-align:center;">'.$row['from_time'].'</td>
	<td width="80" style="text-align:center;">'.$row['to_time'].'</td>
	<td width="80" style="text-align:center;">'.$row['guaranted'].'</td>
	<td width="80" style="text-align:left;">'.strtoupper($row['funct']).'</td>
	<td width="80" style="text-align:center;">'.$row['phone'].'</td>
	<td width="80" style="text-align:left;">'.$row['email'].'</td>
	<td width="80" style="text-align:left;">'.strtoupper($row['company_name']).'</td>
	<td width="80" style="text-align:left;">'.strtoupper($row['contact_person']).'</td>
	<td width="80" style="text-align:center;">'.$row['contact_mobile'].'</td>
	<td width="80" style="text-align:center;">'.$rowR['advAmt'].'</td>
	<td width="80" style="text-align:center;">'. $rowR['receipt_no'].'</td>
	<td width="80" style="text-align:center;">'. ucfirst($rowR['pay_mode']).'</td>
	<td width="80" style="text-align:left;color:#000;">'.strtoupper($rmAVai).'</td>
</tr>';
}

$output.='</table>';
$fileName = 'Booking-status-Details'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;

?>