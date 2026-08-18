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
		<td colspan="22" style="text-align:center;font-size:14px;font-weight:bold;" >'.$prop_name.'</td>
	</tr>	
	<tr>
		<td colspan="22" style="text-align:center;font-size:14px;font-weight:bold;">Settlement Report from '.$_GET['fromdate'].' to '.$_GET['todate'].'</td>
	</tr>
	</table>
	<table class="table" border="1" style="text-align:center;font-size:12px;">	
	
	<tr>
	<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Sl.no</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill#</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill Date</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Gst/Comp</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Venue</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Function</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Pax</th>
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
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">card_desc</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">ccno</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">compname</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">Remarks</th>
	<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Settled by</th>
</tr>';

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
$sqBl=mysql_fetch_array(mysql_query("select * from bq_opbillstldtl where bill_no='".$row['bill_no']."' AND settleflag!='3'"));

$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3' order by opbillhdr_id ASC";
$sqBs=mysql_fetch_array(mysql_query("select SUM(billamt)AS blAm from bq_opbillhdr $item_where"));

$sqV=mysql_fetch_array(mysql_query("select * from bq_opvchrhdr where fpno='".$rbp['fpno']."' AND bill_status!='3'"));
if($rbp['fpno']=='283'){
$gpax=$row['gpax'];	
}else{
$gpax=$sqV['gpax'];		
}


$gPx+=$sqV['gpax'];
$output.='<tr>
<td width="" style="text-align:center;" style="width:50px;">'.$x.'</td>
<td width="" class="codesUPPERCase bN" style="width:100px;text-align:left;color:'.$bgcolor.'" onclick="selRefNo('.$row['bill_no'].');"><input type="hidden" id="bn'.$row['bill_no'].'" value="'. $row['bill_no'].'"/>'.$row['bill_no'].'</td>
<td width="" class="fstChUPPRCase" style="width:100px;color:'.$bgcolor.'">'.$row['bill_date'].'</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:70px;color:'.$bgcolor.'">'.strtoupper($row['fname']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:'.$bgcolor.'">'.strtoupper($rVn['venue_desc']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:'.$bgcolor.'">'.strtoupper($rbf['func_desc']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:'.$bgcolor.'">'.$gpax.'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$row['billamt']+$row['advamt']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$row['advamt']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBl['cash']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBl['card']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBl['company']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBl['upi']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBl['cheque']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBl['neft']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBl['room']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBl['refund']).'</td>


<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.$sqBl['card_desc'].'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.$sqBl['ccno'].'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'.$sqBl['compname'].'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;color:'.$bgcolor.'">'. $sqBl['remarks'].'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'.$bgcolor.'">'.strtoupper($sqBl['added_by']).'</td>	
</tr>';
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
 } } }
if(isset($_GET['ven']) && $_GET['ven']!='all' && $_GET['ven']!=''){
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3' AND venue='".$_GET['ven']."' order by opbillhdr_id ASC";
$sqBs=mysql_fetch_array(mysql_query("select SUM(billamt)AS blAm,SUM(advamt)AS advaT,SUM(gpax)AS gpxlAm from bq_opbillhdr $item_where"));
}else{
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3' order by opbillhdr_id ASC";
$sqBs=mysql_fetch_array(mysql_query("select SUM(billamt)AS blAm,SUM(advamt)AS advaT,SUM(gpax)AS gpxlAm from bq_opbillhdr $item_where"));	
}

$output.='<tr>
<td width="" style="text-align:center;" style="width:50px;">&nbsp;</td>
<td width="" class="codesUPPERCase bN" style="width:100px;text-align:left;color:'.$bgcolor.'">&nbsp;</td>
<td width="" class="fstChUPPRCase" style="width:100px;color:'.$bgcolor.'">&nbsp;</td>
<td width="" class="fstChUPPRCase" style="width:70px;color:'.$bgcolor.'">&nbsp;</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:'.$bgcolor.'">&nbsp;</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;font-weight:bold;color:'.$bgcolor.'">Total</td>
<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;font-weight:bold;color:'.$bgcolor.'">'. sprintf("%01.2f",$gPx).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBs['blAm']+$sqBs['advaT']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$sqBs['advaT']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$cash).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$card).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$company).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$UPI).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'. sprintf("%01.2f",$cheque).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'. sprintf("%01.2f",$neft).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'. sprintf("%01.2f",$room).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$refund).'</td>


<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">&nbsp;</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">&nbsp;</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">&nbsp;</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">&nbsp;</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">&nbsp;</td>	

</tr>';


$fileName = 'Settlement-Report-Details'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;
$output.='</table>';
?>