<?php
include('../../config.php');

$sql=mysql_query("select * from property_definition where propdef_id='1'");
$row=mysql_fetch_array($sql);
$prop_name=$row['prop_name'];
$city=$row['city'];
$phone=$row['phone'];
$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];

	$output="";
	$output.='
	<table class="table" border="" style="text-align:center;border-left:1px solid #000;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">	
	<tr>
		<td colspan="16" style="text-align:center;font-size:16px;font-weight:bold;">View Duplicate Hall Advance Report</td>
	</tr>
	<tr>
		<td colspan="16" style="text-align:right;font-size:14px;font-weight:bold;">Phone:'. $phone.'</td>
	</tr>
	<tr>
		<td colspan="16" style="text-align:center;font-size:14px;font-weight:bold;" >'.$prop_name.','. $city.'</td>
	</tr>
	</table>
	
		<table class="" border="1" style="text-align:center;font-size:12px;">	
	<tr>
		<th  style="text-align:center;">Sl.no</th>
		<th  style="text-align:center;">Booking#</th>
		<th  style="text-align:center;">Date</th>
		<th  style="text-align:center;">Receipt no</th>
		<th  style="text-align:center;">Bill no</th>
		<th  style="text-align:center;">Bill date</th>
		<th  style="text-align:center;">Gst Name</th>
		<th  style="text-align:center;">Venue</th>
		<th  style="text-align:center;">Function</th>
		<th  style="text-align:center;">Phone</th>
		<th  style="text-align:center;">Contact per.</th>
		<th  style="text-align:center;">Contact no</th>
		<th  style="text-align:center;">Adv</th>
		<th  style="text-align:center;">Pay mode</th>
		<th  style="text-align:center;">Remarks</th>
		<th  style="text-align:center;">User</th>
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
$x=0;$ttT=0;
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
	$tt=floatval($row['amount'])+floatval($row['sgst'])+floatval($row['cgst']);
	
$ttT+=$tt;
$output.='<tr>
	<td  style="text-align:center;">'.$x.'</td>
	<td  style="text-align:center;">'. $row['booking_no'].'</td>
	<td  style="text-align:center;">'.$row['cur_date'].'</td>
	<td  style="text-align:center;">'.$row['receipt_no'].'</td>
	<td  style="text-align:center;">'.$rwH['bill_no'].'</td>
	<td  style="text-align:center;">'.$rwH['bill_date'].'</td>
	<td  style="text-align:left;">'.strtoupper($row['guest_name']).'</td>
	<td  style="text-align:left;">'.strtoupper($rw['venue']).'</td>
	<td  style="text-align:left;">'.strtoupper($row['function_date']).'</td>
	<td  style="text-align:center;">'.$rw['phone'].'</td>
	<td  style="text-align:left;">'.strtoupper($rw['contact_person']).'</td>
	<td  style="text-align:center;">'.$rw['contact_mobile'].'</td>
	<td  style="text-align:right;">'.$tt.'</td>
	<td  style="text-align:center;">'. ucfirst($row['pay_mode']).'</td>
	<td  style="text-align:center;">'.ucfirst($row['remarks']).'</td>
	<td  style="text-align:center;">'.ucfirst($row['added_by']).'</td>
</tr>';
 } } 
 
 $output.='<tr>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;font-weight:bold;">Total</td>
	<td  style="text-align:right;font-weight:bold;">'.$ttT.'</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
	<td  style="text-align:center;">&nbsp;</td>
</tr>';


$output.='</table>';
$fileName = 'ViewHallDUplicate-Advance'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;

?>