<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$cur_date=$rowAC['cur_date'];


$fp_no=$_GET['fp_no'];
$output="";
$adv="";
$sqlm=mysql_query("select * from bq_opfpmenuhdr where fpno='".$fp_no."' AND bill_status='1'");
$row=mysql_fetch_array($sqlm);

$sqm=mysql_query("select menucode from bq_opfpmenudetail where fpno='".$fp_no."' AND bill_status='1'");
$rw=mysql_fetch_array($sqm);

$sq=mysql_query("select menu_code,menu_name from bq_menumaster where menu_code='".$rw['menucode']."'");
$rq=mysql_fetch_array($sq);


$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$row['bkno']."' AND confirm_status='2'");
$rowb=mysql_fetch_array($sqlb);

$sqb=mysql_query("select * from bq_billinstruc where bill_code='".$rowb['top_code']."'");
$rob=mysql_fetch_array($sqb);

$sqbC=mysql_query("select * from bq_opfpmenuhdr where bkno='".$row['bkno']."' AND bill_status='1'");
$nmrs=mysql_num_rows($sqbC);
$rwbC=mysql_fetch_array($sqbC);

$sqS=mysql_query("select sess_name from bqt_session where sess_code='".$rowb['session']."'");
$roS=mysql_fetch_array($sqS);


if($rwbC['hallchrg']>0){
	$hachrg=$rwbC['hallchrg'];
$output.='<tr id="">

	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code1" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="Hall" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name1" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px" value="Hall" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty1" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="1" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate1" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$rwbC['hallchrg'].'" readonly /></td>
	<td style="" class="sourceonVAL">
	<input name="item_value[]" id="item_value1" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$rwbC['hallchrg'].'" readonly />
	<input name="tax_code[]" id="tax_code1" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rwbC['halltax'].'" readonly />
	</td>
</tr>	';
}

if($rwbC['ratechrg']>0){
	$totVRt=$rowb['guaranted']*$rwbC['ratechrg'];
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code1" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="'.$rq['menu_code'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name1" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px" value="'.$rq['menu_name'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty1" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rowb['guaranted'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate1" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$rwbC['ratechrg'].'" readonly /></td>
	<td style="text-align:right;" class="sourceonVAL"><input name="item_value[]" id="item_value1" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$totVRt.'" readonly />
	<input name="tax_code[]" id="tax_code1" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rwbC['ratetax'].'" readonly />
	</td>
</tr>	';
}
/* End Ratetax  */

/* Start amenities  */
/* echo "select * from bq_opfpmenudetail where fpno='".$fp_no."' AND subcatcode='oth' AND bill_status='1'"; */
$sbCI=mysql_query("select * from bq_opfpmenudetail where fpno='".$fp_no."' AND subcatcode='oth' AND bill_status='1'");
$nmI=mysql_num_rows($sbCI);
$totVlL=0;
while($rbC=mysql_fetch_array($sbCI)){
$totVl=$rbC['qty']*$rbC['rate'];
$totVlL+=$rbC['qty']*$rbC['rate'];
	$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px"  value="'.$rbC['itemcode'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px"  value="'.$rbC['itemname'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px"  value="'.$rbC['qty'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$rbC['rate'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL">
	<input name="item_value[]" id="item_value" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$totVl.'" readonly />
	<input name="tax_code[]" id="tax_code" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rbC['taxstructcode'].'" readonly />
	<input name="subcatcode[]" id="subcatcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rbC['subcatcode'].'" readonly />
	<input name="catcode[]" id="catcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rbC['catcode'].'" readonly />
	<input name="grpcode[]" id="grpcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rbC['grpcode'].'" readonly />
	</td>
</tr>	';
}
/* End AMenities  */


/* Start Kot  */
$sbC=mysql_query("select * from bq_opkothdr where fpno='".$rwbC['fpno']."' AND kotstatus!='3'");
$nmrsC=mysql_num_rows($sbC);
$itemTt=0;
while($rbC=mysql_fetch_array($sbC)){
/* $itmVal=$rbC['qty']*$rbC['rate']; */
$itemTt+=$rbC['item_qty']*$rbC['item_rate'];
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px"  value="'.$rbC['item_code'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px"  value="'.$rbC['item_name'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px"  value="'.$rbC['item_qty'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$rbC['item_rate'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL">
	<input name="item_value[]" id="item_value" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$rbC['item_value'].'" readonly />
	<input name="tax_code[]" id="tax_code" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rbC['taxstructcode'].'" readonly />
	<input name="subcatcode[]" id="subcatcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rbC['subcatcode'].'" readonly />
	<input name="catcode[]" id="catcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rbC['catcode'].'" readonly />
	<input name="grpcode[]" id="grpcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rbC['grpcode'].'" readonly />
	</td>
</tr>	';

}
$nRs=$nmrsC+2;

for($i=$nRs;$i<14;$i++){
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_code[]" id="item_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px"  value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_name[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px"  value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_qty[]" id="item_qty" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px"  value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_rate[]" id="item_rate" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemm_value[]" id="item_value" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly /></td>
</tr>	';	
	
}
/* End Kot */

/* Start Advance */
$sqsC=mysql_query("select * from bq_hallresvadv where booking_no='".$row['bkno']."' AND status='1' AND function_date='".$cur_date."'");
$nmrA=mysql_num_rows($sqsC);
while($rwsC=mysql_fetch_array($sqsC)){
$adv.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_rcpt[]" id="adv_rcpt" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px"  value="'.$rwsC['receipt_no'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_date[]" id="adv_date" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px"  value="'.$rwsC['cur_date'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_amount[]" id="adv_amount" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px;text-align:right;"  value="'.$rwsC['amount'].'" readonly /></td>
</tr>';	
}
for($i=$nmrA;$i<4;$i++){
$adv.='<tr id="">
<td style="text-align:center;" class="sourceonVAL"><input name="adv_rcpt[]" id="adv_rcpt" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px"  value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="adv_date[]" id="adv_date" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px"  value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="adv_amount[]" id="adv_amount" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px"  value="" readonly /></td>
</tr>'; 
 }
/* End Advance */

if(isset($hachrg) && $hachrg!=""){$hachrgG=$hachrg;}else{$hachrgG="0";}
if($totVRt!=""){$totVRtT=$totVRt;}else{$totVRtT="0";}
if($totVlL!=""){$totVlLl=$totVlL;}else{$totVlLl="0";}
if($itemTt!=""){$itemTtT=$itemTt;}else{$itemTtT="0";}
$totval=$hachrgG+$totVRtT+$totVlLl+$itemTtT;

/* echo "select * from bq_opfpmenudetail where fpno='".$rwbC['fpno']."' AND bill_status='1'";
$sbCI=mysql_query("select * from bq_opfpmenudetail where fpno='".$rwbC['fpno']."' AND subcatcode='oth' AND bill_status='1'");
while($rbC=mysql_fetch_array($sbCI)){
$sqF=mysql_query("select * from bq_taxstruct where str_code='".$rbC['taxstructcode']."' AND status='1'");
while($roF=mysql_fetch_array($sqF)){
	$txVal=$_POST['item_value'][$ce]*$roF['factor_value']/100;
}
} */
if($row['bkno']!=""){$bkno=$row['bkno'];}else{$bkno="";}
if($row['bkdate']!=""){$bkdate=$row['bkdate'];}else{$bkdate="";}

echo $bkno.','.$bkdate.','.$rowb['guest_name'].','.$roS['sess_name'].','.$rowb['venue'].','.$rob['bill_desc'].','.$rowb['contact_person'].','.$rowb['phone'].','.$rowb['guaranted'].','.$output.','.$adv.','.$totval;


?>