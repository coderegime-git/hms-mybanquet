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
		<td colspan="24" style="text-align:center;font-size:14px;font-weight:bold;" >'.$prop_name.'</td>
	</tr>	
	<tr>
		<td colspan="24" style="text-align:center;font-size:14px;font-weight:bold;">Sales Register Report</td>
	</tr>
	
	<table class="table" border="1" style="text-align:center;font-size:12px;">	
	
	<tr>
	<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Sl.no</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill#</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill Date</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Guest/Company Name</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Venue</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Function</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Pax</th>';
$sqS=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
while($roS=mysql_fetch_array($sqS)){

$output.='<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">'.ucwords($roS['grpname']).'</th>';
 } 
$output.='<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">Net Amt</th>';

$sqlTS=mysql_query("select * from bq_taxstruct where status='1' group by tax_code");
while($rowtS=mysql_fetch_array($sqlTS)){

$output.='<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:100px;">'.$rowtS['tax_code'].'</th>';
 } 

$output.='<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Disc</th>
<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">RND</th>
<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Grand Total</th>
<th width="80" class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;width:80px;">Billed by</th>
</tr>';

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

$output.='<tr>
	<td width="" style="text-align:center;" style="width:50px;">'.$x.'</td>

	<td width="" class="codesUPPERCase bN" style="width:100px;text-align:left;color:'. $bgcolor.'" onclick="selRefNo('.$row['bill_no'].');"><input type="hidden" id="bn'.$row['bill_no'].'" value="'. $row['bill_no'].'"/>'.$row['bill_no'].'</td>
	<td width="" class="fstChUPPRCase" style="width:100px;color:'. $bgcolor.'">'.$row['bill_date'].'</td>
	<td width="" class="fstChUPPRCase" style="width:70px;text-align:left;color:'.$bgcolor.'">'.$row['fname'].'</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:'.$bgcolor.'">'. $rbk['venue'].'</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:'. $bgcolor.'">'.strtoupper($rbf['func_desc']).'</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:'.$bgcolor.'">'. $sqV['gpax'].'</td>';
$sqlTS=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
while($rowtS=mysql_fetch_array($sqlTS)){ 
$sqL=mysql_query("select sum(item_total)AS grpAmt from bq_opbillhdtl where bill_no='".$row['bill_no']."' AND grpcode='".$rowtS['grpcode']."' AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rowL=mysql_fetch_array($sqL);

$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'. $bgcolor.'">'. sprintf("%01.2f",$rowL['grpAmt']).'</td>';
}
$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'.$bgcolor.'">'.$row['nontaxableamt'].'</td>';


if($row['sgst']>0){
	$cgst+=$row['cgst'];
	$sgst+=$row['sgst'];
$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'. $bgcolor.'">'.$row['cgst'].'</td>';	
$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'. $bgcolor.'">'.$row['sgst'].'</td>';	
}else{
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
$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'. $bgcolor.'">'.$txAMt.'</td>';
} }
$rRnd=mysql_fetch_array(mysql_query("select * from bq_opbillhdtl where itemcode='RND' AND bill_no='".$row['bill_no']."'"));
	
$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'.$bgcolor.'">'.$row['discamt'].'</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'.$bgcolor.'">'.$rRnd['itemrate'].'</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'. $bgcolor.'">'.round($row['billamt']+$row['roundoff']+$row['advamt']).'</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;color:'.$bgcolor.'">'.strtoupper($row['added_by']).'</td>	
	</tr>';
$ratechrg+=$rbp['ratechrg'];
$billamt+=$row['billamt'];
$advamt+=$row['advamt'];
 } } }
$sqlbl=mysql_query("select SUM(nontaxableamt)AS nontax,SUM(taxableamt)AS taxable,SUM(discamt)AS discable,SUM(billamt)AS billable,SUM(gpax)AS tGpax from bq_opbillhdr where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rwbl=mysql_fetch_array($sqlbl);

$output.='<tr>
	<td width="" style="text-align:center;" style="width:50px;">&nbsp;</td>

	<td width="" class="codesUPPERCase bN" style="width:100px;text-align:left;color:'.$bgcolor.'" >&nbsp;</td>
	<td width="" class="fstChUPPRCase" style="width:100px;color:'. $bgcolor.'">&nbsp;</td>
	<td width="" class="fstChUPPRCase" style="width:70px;text-align:left;color:'. $bgcolor.'">&nbsp;</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;color:'.$bgcolor.'">&nbsp;</td>
	<td width="" class="fstChUPPRCase" style="text-align:left;width:50px;font-weight:bold;color:'.$bgcolor.'">Total</td>
	<td width="" class="fstChUPPRCase" style="text-align:right;width:50px;font-weight:bold;color:'.$bgcolor.'">&nbsp;</td>';
$sqlTS=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
while($rowtS=mysql_fetch_array($sqlTS)){
$sqL=mysql_query("select SUM(item_total)AS itmTot  from bq_opbillhdtl where grpcode='".$rowtS['grpcode']."' AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rowL=mysql_fetch_array($sqL);

$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">'. sprintf("%01.2f",$rowL['itmTot']).'</td>';
 }
$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'. $bgcolor.'">'.sprintf("%01.2f",$rwbl['nontax']).'</td>';

if($cgst>0){ 

$scg=mysql_query("select sum(cgst)AS cgst from bq_opbillhdr where cgst>0 AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rcg=mysql_fetch_array($scg);

$ssg=mysql_query("select sum(sgst)AS sgst from bq_opbillhdr where sgst>0 AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'");
$rsg=mysql_fetch_array($ssg);

$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$rcg['cgst']).'</td>
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$rsg['sgst']).'</td>';

}else{ 


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
$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$txAMtt).'</td>';
} }
/* $rRndT=mysql_fetch_array(mysql_query("select SUM(itemrate)AS rndOf from bq_opbillhdtl where itemcode='RND' AND str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod'")); */
$rRndT=mysql_fetch_array(mysql_query("select SUM(roundoff)AS rndOf,SUM(advamt)AS adv from bq_opbillhdr where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND bill_status!='3'"));

$output.='<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">'.sprintf("%01.2f",$rwbl['discable']).'</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">'. sprintf("%01.2f",$rRndT['rndOf']).'</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">'.round($rwbl['billable']+$rRndT['rndOf']+$rRndT['adv']).'</td>	
<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;color:'.$bgcolor.'">'.strtoupper($row['added_by']).'</td>	
</tr>';





$output.='</table>';
$fileName = 'Sales-register-Details'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;

?>