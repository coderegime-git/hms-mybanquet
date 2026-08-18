<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$fpno=$_GET['fpno'];

$output="";

/* echo "select * from bq_opfpmenudetail where fpno='".$fpno."' AND itemcode!='55555'"; */

$sql=mysql_query("select * from bq_opfpmenudetail where fpno='".$fpno."'");
$cc=0;
while($row=mysql_fetch_array($sql)){
	$cc++;
	$tot=$row['qty']*$row['rate'];
$output.='<tr id="">
<td style="text-align:center;" class="sourceonVAL">
<select name="amen_itemcode[]" id="amen_itemcode'. $cc.'" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;" value="'.$row['itemcode'].'" onchange="itmOthName('.$cc.');">
<option value="">--Select--</option>';
$sqle=mysql_query("select distinct item_code,item_name,itmsub_cat from bq_itemmaster where status='1' AND itmsub_cat IN('oth','bev')");
while($res=mysql_fetch_array($sqle)){
if($res['item_code']==$row['itemcode']){
$output.='<option value="'. $res['item_code'].'" selected >'.strtoupper($res['item_code'].'('.$res['itmsub_cat'].')').'</option>';	
}else{
$output.='<option value="'. $res['item_code'].'" >'.strtoupper($res['item_code'].'('.$res['itmsub_cat'].')').'</option>';
} }
$output.='</select>

</td>

<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemname[]" id="amen_itemname'. $cc.'" type="text"  class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="'.$row['itemname'].'" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemqty[]" id="amen_itemqty'. $cc.'" type="text"  class="textbox fstChUPPRCase expet" style="width:40px;margin:5px 0 0 0px" value="'.$row['qty'].'" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemrate[]" id="amen_itemrate'. $cc.'" type="text"  class="textbox fstChUPPRCase expet" style="width:60px;margin:5px 0 0 0px" value="'.$row['rate'].'" /></td>
<td style="text-align:center;" class="sourceonVAL"><input name="amen_itemamount[]" id="amen_itemamount'.$cc.'" type="text"  class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="'.$tot.'" /></td>
</tr>';		

 }
echo $output;
