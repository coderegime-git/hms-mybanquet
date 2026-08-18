<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$vucNo=$_GET['vucNo'];
$output="";

$sqlm=mysql_query("select * from bq_opvchrhdr where vouchrno='".$vucNo."'");
$row=mysql_fetch_array($sqlm);

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$row['bkno']."'");
$rowb=mysql_fetch_array($sqlb);

$sqb=mysql_query("select * from bq_billinstruc where bill_code='".$rowb['top_code']."'");
$rob=mysql_fetch_array($sqb);

$sqbV=mysql_query("select * from bq_opvchrdtl where vouchrno='".$vucNo."'");
$x=0;
$nmrs=mysql_num_rows($sqbV);
while($robV=mysql_fetch_array($sqbV)){
	$x++;
$itmTot=$robV['item_qty']*$robV['item_rate'];

$sqI=mysql_query("select * from bq_itemmaster where item_code='".$robV['item_code']."'");
$roI=mysql_fetch_array($sqI);

$sqT=mysql_query("select * from bq_opvchrtaxdtl where item_code='".$robV['item_code']."'");
$roT=mysql_fetch_array($sqT);
$netAmt=$itmTot+$roT['taxamt'];

/* $result = mysql_query("select ed_code from earning_deduction where earn_deduct='earning'") ;
$str=""; $tmpStr=""; $btStr=""; $i=0; 
$btStr ='<option value="">---select--</option>';
while($row = mysql_fetch_array( $result )) { 
$tmpStr ='<option value="'.$row['ed_code'].'"==yes?selected:"">'.$row['ed_code'].'</option>';
$btStr .=$tmpStr;
 $i++;} */
/*  echo $roI['allow_disc']; */
 
$output.='<tr id="">
<td style="text-align:center;" class="sourceonVAL">
<input name="s_no[]" id="s_no<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="'.$x.'" readonly />
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code'.$x.'" type="hidden"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="'.$robV['item_code'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="'.$robV['item_name'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$robV['item_qty'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="'.$robV['item_rate'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_total[]" id="item_total'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:135px;margin:5px 0 0 0px;text-align:right;" value="'.$itmTot.'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL">
<select name="disc_flag[]" id="disc_flag'.$x.'" class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px;" onChange="selDisBill();" readonly >
<option value="">--Select--</option>';
$output.='<option value="'.$roI['allow_disc'].'"==yes?selected:"">Yes</option>
<option value="'.$roI['allow_disc'].'"==no?selected:"">No</option>';
$output.='</select>
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="disc_amount[]" id="disc_amount'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="0.00" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="tax_amount[]" id="tax_amount'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="'.$roT['taxamt'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="net_amount[]" id="net_amount'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:135px;margin:5px 0 0 0px;text-align:right;" value="'.$netAmt.'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="split[]" id="split'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="1" /></td>
</tr>';	
}

for($cc=$nmrs;$cc<7;$cc++){
$output.='<tr id="">
<td style="text-align:center;" class="sourceonVAL">
<input name="s_no[]" id="s_no<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" readonly />
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code'.$x.'" type="hidden"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_total[]" id="item_total" type="text"  class="textbox fstChUPPRCase expet" style="width:135px;margin:5px 0 0 0px;text-align:right;" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL">
<select name="disc_flag[]" id="disc_flag" class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px;" onChange="selDisBill();" readonly >
<option value="">--Select--</option>
<option value="">Yes</option>
<option value="">No</option>
</select>
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="disc_amount[]" id="disc_amount" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="0.00" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="tax_amount[]" id="tax_amount" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="net_amount[]" id="net_amount" type="text"  class="textbox fstChUPPRCase expet" style="width:135px;margin:5px 0 0 0px;text-align:right;" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="split[]" id="split" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="" readonly  /></td>
</tr>';	
}


$adv="";
/* Start Advance */
$sqsC=mysql_query("select * from bq_hallresvadv where booking_no='".$row['bkno']."' AND status!='3'");
$nmrA=mysql_num_rows($sqsC);
while($rwsC=mysql_fetch_array($sqsC)){
$adv.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="receipt[]" id="receipt<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$rwsC['receipt_no'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="receipt_date[]" id="receipt_date<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="'.$rwsC['cur_date'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="receipt_amount[]" id="receipt_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="'.$rwsC['amount'].'" readonly /></td>
	</tr>';	
}
 for($i=$nmrA;$i<4;$i++){
	$adv.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="receipt[]" id="receipt<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="receipt_date[]" id="receipt_date<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="receipt_amount[]" id="receipt_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="" readonly /></td></tr>'; 
 }
/* End Advance */






echo $row['fpno'].','.$row['bkno'].','.$rob['bill_desc'].','.$rowb['guest_name'].','.$rowb['venue'].','.$rowb['book_date'].','.$rowb['session'].','.$rowb['guaranted'].','.$output.','.$adv;


?>