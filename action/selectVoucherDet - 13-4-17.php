<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$fp_no=$_GET['fp_no'];
$output="";
$adv="";
$sqlm=mysql_query("select * from bq_opfpmenuhdr where fpno='".$fp_no."' AND bill_status='1'");
$row=mysql_fetch_array($sqlm);

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$row['bkno']."' AND confirm_status='2'");
$rowb=mysql_fetch_array($sqlb);

$sqb=mysql_query("select * from bq_billinstruc where bill_code='".$rowb['top_code']."'");
$rob=mysql_fetch_array($sqb);

$sqbC=mysql_query("select * from bq_opfpmenuhdr where bkno='".$row['bkno']."' AND bill_status!='3'");
$nmrs=mysql_num_rows($sqbC);
$rwbC=mysql_fetch_array($sqbC);

$output.='<tr id="">

	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="Rate" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px" value="Rate" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="1" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rwbC['hallchrg'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_value[]" id="item_value" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rwbC['hallchrg'].'" readonly /></td>
</tr>	';

$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="Hall" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px" value="Hall" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="1" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rwbC['ratechrg'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_value[]" id="item_value" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rwbC['ratechrg'].'" readonly /></td>
</tr>	';

$sbC=mysql_query("select * from bq_opfpmenudetail where fpno='".$rwbC['fpno']."' AND bill_status!='3'");
$nmrsC=mysql_num_rows($sbC);
while($rbC=mysql_fetch_array($sbC)){
$itmVal=$rbC['qty']*$rbC['rate'];
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px"  value="'.$rbC['itemcode'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px"  value="'.$rbC['itemname'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px"  value="'.$rbC['qty'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rbC['rate'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_value[]" id="item_value" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$itmVal.'" readonly /></td>
</tr>	';

}
$nRs=$nmrsC+2;

for($i=$nRs;$i<9;$i++){
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px"  value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px"  value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px"  value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_value[]" id="item_value" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly /></td>
</tr>	';	
	
}


$sqsC=mysql_query("select * from bq_hallresvadv where booking_no='".$row['bkno']."' AND status!='3'");
$nmrA=mysql_num_rows($sqsC);
while($rwsC=mysql_fetch_array($sqsC)){
$adv.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_rcpt[]" id="adv_rcpt" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px"  value="'.$rwsC['receipt_no'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_date[]" id="adv_date" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px"  value="'.$rwsC['cur_date'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_amount[]" id="adv_amount" type="text"  class="textbox fstChUPPRCase expet" style="width:172px;margin:5px 0 0 0px"  value="'.$rwsC['amount'].'" readonly /></td>
</tr>	';	
	
}
 for($i=$nmrA;$i<=5;$i++){
	$adv.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_rcpt[]" id="adv_rcpt" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px"  value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_date[]" id="adv_date" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px"  value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="adv_amount[]" id="adv_amount" type="text"  class="textbox fstChUPPRCase expet" style="width:172px;margin:5px 0 0 0px"  value="" readonly /></td>
</tr>	'; 
 }
 /* echo $output.','.$adv; */

 echo $row['bkno'].','.$row['bkdate'].','.$rowb['guest_name'].','.$rowb['session'].','.$rowb['venue'].','.$rob['bill_desc'].','.$rowb['booker_name'].','.$rowb['phone'].','.$rowb['guaranted'].','.$output.','.$adv;


?>