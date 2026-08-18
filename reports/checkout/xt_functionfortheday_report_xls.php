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
		<td colspan="13" style="text-align:center;font-size:14px;font-weight:bold;" >'.$prop_name.'</td>
	</tr>	
	<tr>
		<td colspan="13" style="text-align:center;font-size:14px;font-weight:bold;">Functions for the Day Report</td>
	</tr>
	
	<table class="table" border="1" style="text-align:center;font-size:12px;">	
	
	<tr>
	    <!--<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;"><div label="Sl.no" ></div></th>
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
		<th class="scrollbarhead"></th>-->
   
    <th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Sl.no</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Booking#</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Fn Date</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Gst Name</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Session</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">From</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">To</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Function</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Phone</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Email</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Amount</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Company</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Booked By</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">status</th>
	
   
   </tr>';
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
	$amount=0;
$output.='<tr>
<td style="text-align:left;width:120px;color:#FF0034;font-weight:bold;" colspan="13">'.strtoupper($rwp['venue_desc']).'</td>
</tr>';

while($row=mysql_fetch_array($sql)) {
	$x++;

if($row['confirm_status']=='2'){
	$bgcolor= '#ff0000';
} else {
	$bgcolor= '#000';
}

// $rem=rtrim($remarks,',');

$rbk=mysql_fetch_array(mysql_query("select * from bqt_session where sess_code='".$row['session']."'"));
$rbf=mysql_fetch_array(mysql_query("select func_desc from bq_function where func_code='".$row['funct']."'"));
// $rbp=mysql_fetch_array(mysql_query("select ratechrg,fpno from bq_opfpmenuhdr where bkno='".$row['bkno']."'"));
// $rbh=mysql_fetch_array(mysql_query("select * from bq_opbillhdtl where itemcode='Hall' AND bill_no='".$row['bill_no']."'"));

$sqlRd=mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
$rowRd=mysql_fetch_array($sqlRd);
$sqlhrs = mysql_query("select netamt from bq_hallresvadv where booking_no = '".$row['booking_no']."' and status = '1'");
while($rowhrs = mysql_fetch_array($sqlhrs)){
	$amount += $rowhrs['netamt'];
	$amountT +=$rowhrs['netamt'];
}
if($row['confirm_status']==2) {
	$rmAVai=$rowRd['room_availability'];
	$clr=$rowRd['room_color'];
}

$output.='<tr>
	<td width="" style="text-align:center;" style="">'.$x.'</td>
    <td width="" class="fstChUPPRCase" style="">'.$row['booking_no'].'</td>
	<td width="" class="fstChUPPRCase" style="">'.$row['book_date'].'</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;">'.strtoupper($row['guest_name']).'</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;">'.strtoupper($rbk['sess_name']).'</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;">'.$row['from_time'].'</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;">'.$row['to_time'].'</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;">'.strtoupper($rbf['func_desc']).'</td>	
	<td width="" class="fstChUPPRCase" style="text-align:left;">'.$row['phone'].'</td>	
	<td width="" class="fstChUPPRCase" style="text-align:left;">'.$row['email'].'</td>	
	<td width="" class="fstChUPPRCase" style="text-align:left;">'.$amount.'</td>
<td width="" class="fstChUPPRCase" style="text-align:left;">'.strtoupper($row['company_name']).'</td>	
<td width="" class="fstChUPPRCase" style="text-align:left;">'.strtoupper($row['contact_person']).'</td>	
<td width="" class="fstChUPPRCase" style="text-align:left;">'. strtoupper($rmAVai).'</td>	
</tr>';

} } } }
$output.='<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td>Total</td>
<td>'.$amountT.'</td>
<td></td>
<td></td>
</tr>';
$output.='</table>';
$fileName = 'Functions_for_the_Day'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;

?>