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
		<td colspan="9" style="text-align:center;font-size:14px;font-weight:bold;">BANQUET ITEM WISE SALES</td>
	</tr>
	<tr>
		<td colspan="9" style="text-align:center;font-size:14px;font-weight:bold;" >'.$prop_name.'</td>
	</tr>	
	<tr>
		<td colspan="9" style="text-align:center;font-size:14px;font-weight:bold;">Item WIse Sales Report from '.$_GET['fromdate'].' to '.$_GET['todate'].'</td>
	</tr>
	<table class="table" border="1" style="text-align:center;font-size:12px;">	
	<tr>
		<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Sl.no</th>
		<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Date</th>
		<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill no</th>
		<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Code</th>
		<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Name</th>
		<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Qty</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Rate</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Disc</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Total</th>
	</tr>';	

$lnTt=0;$lnQy=0;$lnDt=0;$txAT=0;$txATT=0;$itemqty=0;$itemrate=0;$discamt=0;$item_total=0;
$fr=explode('/',$_GET['fromdate']);
$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];

$to=explode('/',$_GET['todate']);
$tod=$to[2].'-'.$to[1].'-'.$to[0];
if($_GET['mnuTy']!='All' && $_GET['mnuTy']!='' ){
	$sq=mysql_query("select * from bq_grpcode where grpcode='".$_GET['mnuTy']."'");
}else{
	$sq=mysql_query("select * from bq_grpcode");
}

while($rwp=mysql_fetch_array($sq)) {
$x=0;
if(isset($_GET['fromdate'],$_GET['todate']) && isset($_GET['mnuTy'])) {
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND grpcode='".$rwp['grpcode']."' AND bill_status!='3'";
$sql=mysql_query("select * from bq_opbillhdtl $item_where");
}
$nmR=mysql_num_rows($sql);
if(mysql_num_rows($sql)>0){
$itemqtyy=0;$itemratee=0;$discamtt=0;$item_totall=0;

$output.='<tr>
<td style="text-align:left;width:120px;color:#FF0034;font-weight:bold;" colspan="9">'.strtoupper($rwp['grpname']).'</td>
</tr>';


while($row=mysql_fetch_array($sql)){
$x++;

$itemqty+=$row['itemqty'];
$itemrate+=$row['itemrate'];
$discamt+=$row['discamt'];
$item_total+=$row['item_total'];

$itemqtyy+=$row['itemqty'];
$itemratee+=$row['itemrate'];
$discamtt+=$row['discamt'];
$item_totall+=$row['item_total'];

	
	$output.='<tr>
		<td width="" class="fstChUPPRCase" style="text-align:center;width:30px;">'.$x.'</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">'.$row['bill_date'].'</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">'.$row['bill_no'].'</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">'.$row['itemcode'].'</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:220px;">'.$row['itemname'].'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:120px;">'.$row['itemqty'].'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;">'.$row['itemrate'].'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;">'.$row['discamt'].'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;">'.$row['item_total'].'</td>
	</tr>';
 } } 
 if($x=$nmR) { 
$output.='<tr>
		<td width="" class="fstChUPPRCase" style="text-align:center;width:30px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:220px;font-weight:bold;">Total</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:120px;font-weight:bold;">'.sprintf("%01.2f",$itemqtyy).'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;">'.sprintf("%01.2f",$itemratee).'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;">'.sprintf("%01.2f",$discamtt).'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;">'. sprintf("%01.2f",$item_totall).'</td>
	</tr>';

 } } 

$output.='<tr>
		<td width="" class="fstChUPPRCase" style="text-align:center;width:30px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:220px;font-weight:bold;">Grand Total</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:120px;font-weight:bold;">'.sprintf("%01.2f",$itemqty).'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;">'.sprintf("%01.2f",$itemrate).'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;">'.sprintf("%01.2f",$discamt).'</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;">'.sprintf("%01.2f",$item_total).'</td>
	</tr>';
$output.='</table>';
$fileName = 'BqtItemwiseSales-Details'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;

?>