<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$cur_date=$rowAC['cur_date'];


$fp_no=$_GET['fp_no'];
$vl=$_GET['vl'];

$output="";
$adv="";
$sqlm=mysql_query("select * from bq_opfpmenuhdr where fpno='".$fp_no."' AND bill_status='1'");
$row=mysql_fetch_array($sqlm);

$sqll="UPDATE bq_hallbooking SET ";
$sqll=$sqll."expected='".$vl."',";
$sqll=$sqll."guaranted='".$vl."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where fpno='".$fp_no."' AND confirm_status='2'";

/*echo $sqll;
die();*/   

$resultt=mysql_query($sqll);

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$row['bkno']."' and fpno='".$fp_no."' AND hallbook_id='".$row['hallbook_id']."' AND confirm_status='2'");
$rowb=mysql_fetch_array($sqlb);

$sq=mysql_query("select menu_code,menu_name from bq_menumaster where menu_code='".$row['menu_code']."'");
$rq=mysql_fetch_array($sq);

$sqb=mysql_query("select * from bq_billinstruc where bill_code='".$rowb['top_code']."'");
$rob=mysql_fetch_array($sqb);

$sqbC=mysql_query("select * from bq_opfpmenuhdr where fpno='".$fp_no."' AND bill_status!='3'");
$nmrs=mysql_num_rows($sqbC);
$rwbC=mysql_fetch_array($sqbC);
if(isset($rwbC['hallchrg'])){
		$hachrg=$rwbC['hallchrg'];
	}else{
		$hachrg==0;
	}
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
	<input name="subcatcode[]" id="subcatcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="OT" readonly />
	<input name="catcode[]" id="catcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="oth" readonly />
	<input name="grpcode[]" id="grpcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="hall" readonly />
	</td>
</tr>	';
}

if($rwbC['ratechrg']>0){
$sqs=mysql_query("select * from bq_itemmaster where itmnu_name='".$rq['menu_name']."'");
$rqs=mysql_fetch_array($sqs);

	$totVRt=$vl*$rwbC['ratechrg'];
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code1" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="'.$rq['menu_code'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name1" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px" value="'.$rq['menu_name'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty1" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$vl.'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate1" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$rwbC['ratechrg'].'" readonly /></td>
	<td style="text-align:right;" class="sourceonVAL"><input name="item_value[]" id="item_value1" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px;text-align:right;" value="'.$totVRt.'" readonly />
	<input name="tax_code[]" id="tax_code1" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rwbC['ratetax'].'" readonly />
	
	<input name="subcatcode[]" id="subcatcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rqs['itmsub_cat'].'" readonly />
	<input name="catcode[]" id="catcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rqs['itmsub_cat'].'" readonly />
	<input name="grpcode[]" id="grpcode" type="hidden"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="food" readonly />
	</td>
</tr>	';
}
/* End Ratetax  */


/* Start Open item  */
/* echo "select * from bq_opfpmenudetail where fpno='".$fp_no."' AND subcatcode='oth' AND bill_status='1'"; */
$sbCI=mysql_query("select * from bq_opfpmenudetail where fpno='".$fp_no."' and bill_status='1' and itemcode='55555'"); 
/* $sbCI=mysql_query("select * from bq_opfpmenudetail where fpno='".$fp_no."' AND bill_status='1'"); */
$nmI=mysql_num_rows($sbCI);
$totOpn=0;
while($rbC=mysql_fetch_array($sbCI)){
$totVl=$rbC['qty']*$rbC['rate'];
$totOpn+=$rbC['qty']*$rbC['rate'];
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
/* End Open item  */

/* Start amenities  */
/* echo "select * from bq_opfpmenudetail where fpno='".$fp_no."' AND subcatcode='oth' AND bill_status='1'"; */
$sbCI=mysql_query("select * from bq_opfpmenudetail where fpno='".$fp_no."' AND catcode='oth' AND bill_status='1'"); 
/* $sbCI=mysql_query("select * from bq_opfpmenudetail where fpno='".$fp_no."' AND bill_status='1'"); */
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
/* echo "select * from bq_opkothdr where fpno='".$rwbC['fpno']."' AND kotstatus!='3'"; */
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
	$totAdv=$rwsC['amount']+$rwsC['sgst']+$rwsC['cgst'];
$adv.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_rcpt[]" id="adv_rcpt" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px"  value="'.$rwsC['receipt_no'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_date[]" id="adv_date" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px"  value="'.$rwsC['cur_date'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_amount[]" id="adv_amount" type="text"  class="textbox fstChUPPRCase expet" style="width:104px;margin:5px 0 0 0px;text-align:right;"  value="'.$totAdv.'" readonly /></td>
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
if(isset($totVRt) && $totVRt!=""){$totVRtT=$totVRt;}else{$totVRtT="0";}
if(isset($totVlL) && $totVlL!=""){$totVlLl=$totVlL;}else{$totVlLl="0";}
if(isset($totOpn) && $totOpn!=""){$totVOpn=$totOpn;}else{$totVOpn="0";}
if(isset($itemTt) && $itemTt!=""){$itemTtT=$itemTt;}else{$itemTtT="0";}
/* if($totVRt!=""){$totVRtT=$totVRt;}else{$totVRtT="0";} */
/* if($totVlL!=""){$totVlLl=$totVlL;}else{$totVlLl="0";} */
/* if($itemTt!=""){$itemTtT=$itemTt;}else{$itemTtT="0";} */
$totval=$hachrgG+$totVRtT+$totVlLl+$totVOpn+$itemTtT;
$tax=$totval*18/100;
$gst=sprintf("%01.2f",$tax/2);
$net=sprintf("%01.2f",$totval+$tax);
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

 echo $output.','.$totval.','.$gst.','.$gst.','.$net;


?>