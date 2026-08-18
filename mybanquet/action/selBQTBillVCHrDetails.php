<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$vucNo=$_GET['vucNo'];
$output="";

/* $sqlVv=mysql_query("select * from bq_opbillhdtl where vouchrno='".$vucNo."'");
if(mysql_num_rows($sqlVv)>0){
	echo 1;
}else{ */
	
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

if($roI['allow_disc']=='yes'){
	$allow_disc='Y';
}else {
	$allow_disc='N';
}
 
$output.='<tr id="">
<td style="text-align:center;" class="sourceonVAL">
<input name="s_no[]" id="s_no<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="'.$x.'" readonly />
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code'.$x.'" type="hidden"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="'.$robV['item_code'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="'.$robV['item_name'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_qty[]" id="item_qty'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$robV['item_qty'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_rate[]" id="item_rate'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="'.$robV['item_rate'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="item_total[]" id="item_total'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:135px;margin:5px 0 0 0px;text-align:right;" value="'.$itmTot.'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="disc_flag[]" id="disc_flag'.$x.'" class="textbox fstChUPPRCase disF" style="width:70px;margin:5px 0 0 0px;text-align:center;" value="'.$allow_disc.'"   />
</td><td style="text-align:center;" class="sourceonVAL"><input name="disc_amount[]" id="disc_amount'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="0.00" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="tax_amount[]" id="tax_amount'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="'.$roT['taxamt'].'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="net_amount[]" id="net_amount'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:135px;margin:5px 0 0 0px;text-align:right;" value="'.$netAmt.'" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="split[]" id="split'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:center;" value="1" /></td>
</tr>';	
}

for($cc=$nmrs;$cc<7;$cc++){
$output.='<tr id="">
<td style="text-align:center;" class="sourceonVAL">
<input name="s_no[]" id="s_no<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px" value="" readonly />
</td>
<td style="text-align:center;" class="sourceonVAL"><input name="itemm_code[]" id="item_codem'.$cc.'" type="hidden"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="itemm_name[]" id="item_namem'.$cc.'" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="itemm_qty[]" id="item_qtym'.$cc.'" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="itemm_rate[]" id="item_ratem'.$cc.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="itemm_total[]" id="item_totalm" type="text"  class="textbox fstChUPPRCase expet" style="width:135px;margin:5px 0 0 0px;text-align:right;" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="discm_flagg[]" id="disc_flagg'.$cc.'" class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px;" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="discm_amount[]" id="disc_amountm" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="0.00" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="taxm_amount[]" id="tax_amountm" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;text-align:right;" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="netm_amount[]" id="net_amountm" type="text"  class="textbox fstChUPPRCase expet" style="width:135px;margin:5px 0 0 0px;text-align:right;" value="" readonly /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="splitm[]" id="splitm" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="" readonly  /></td>
</tr>';	
}



/* Start Advance */
$adv="";
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

/* Start Discount */
$dis="";
$sqTV=mysql_query("select * from bq_opvchrdtl where vouchrno='".$vucNo."'");
$nmS=mysql_num_rows($sqTV);
$x=0;
while($roTV=mysql_fetch_array($sqTV)){
	$x++;
if($roTV['item_code']=='Hall'){
$dis.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_group[]" id="spitem_group'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$roTV['item_code'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_disc[]" id="spitem_disc'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="Percentage" onclick="selDisPerc('.$x.');" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_amount[]" id="spitem_amount'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px" value="0.00" onclick="selDisAMt('.$x.');" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_split[]" id="spitem_split'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px" value="1" /></td>
	</tr>';	
}

if($roTV['item_code']=='Rate'){
$dis.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_group[]" id="spitem_group'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$roTV['item_code'].'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_disc[]" id="spitem_disc'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="Percentage" onclick="selDisPerc('.$x.');" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_amount[]" id="spitem_amount'.$x.'" type="text" data-toggle="modal" data-target="#myModal" class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px" value="0.00" onclick="selDisAMt('.$x.');" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_split[]" id="spitem_split'.$x.'" type="text"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px" value="1" /></td>
	</tr>';	
}
}

for($cd=0;$cd<2;$cd++){
	$dis.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_group[]" id="spitem_group<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_disc[]" id="spitem_disc<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_amount[]" id="spitem_amount<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px" value="" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="spitem_split[]" id="spitem_split<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:70px;margin:5px 0 0 0px" value="" readonly /></td>
	</tr>';	
}
/* End Discount */

echo $row['fpno'].','.$row['bkno'].','.$rob['bill_desc'].','.$rowb['guest_name'].','.$rowb['venue'].','.$rowb['book_date'].','.$rowb['session'].','.$rowb['guaranted'].','.$output.','.$adv.','.$dis;

/* } */
?>