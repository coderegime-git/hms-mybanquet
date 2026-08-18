<?php
ob_start();
include("../config.php");

$tableNo=$_GET['tableNo'];

$tblDet="";
/* echo "select * from pos_kotbill where kot_table='$tableNo' AND bill_status='1'"; */
$sqlBill=mysql_query("select * from pos_kotbill where kot_table='$tableNo' AND bill_status='1'");
$x=0;
if(mysql_num_rows($sqlBill)>0){
while($rowBill=mysql_fetch_array($sqlBill)){
	$x++;
$kotNo=$rowBill['kot_no'];
$tblDet.='<tr>
	<td width="40"><input type="text" name="srlNo[]" id="srlNo" value="'.$x.'" style="width:46px;margin-bottom:0px;" /></td>
	<td width="40"><input type="text" name="kot_no[]" id="kot_no" value="'.$kotNo.'" style="width:46px;margin-bottom:0px;"/></td>
	<td width="220"><input type="text" name="kot_itemdesc[]" id="kot_itemdesc" value="'.$rowBill['kot_itemdesc'].'" style="width:245px;margin-bottom:0px;"/></td>
	<td width="40"><input type="text" name="kot_itemqty[]" id="kot_itemqty" value="'.$rowBill['kot_itemqty'].'" class="itemQty" style="width:47px;margin-bottom:0px;"/></td>
	<td width="80"><input type="text" name="kotitem_rate[]" id="kotitem_rate" value="'.$rowBill['kotitem_rate'].'" style="width:90px;margin-bottom:0px;"/></td>
	<td width="80"><input type="text" name="kot_itemval[]" id="kot_itemval" value="'.$rowBill['kot_itemval'].'" class="itemVal" style="width:92px;margin-bottom:0px;"/></td>
	<td width="40"><input type="text" name="kot_disc" id="kot_disc" value="" style="width:45px;margin-bottom:0px;"/></td>
	<td width="50"><input type="text" name="kot_discAmt" id="kot_discAmt" class="damt" value="0" style="width:57px;margin-bottom:0px;"/></td>
	<td width="50"><input type="text" name="kot_tax" id="kot_tax" class="taxVl" value="0" style="width:57px;margin-bottom:0px;"/></td>
	<td width="80"><input type="text" name="kot_netamt" id="kot_netamt" class="netAmt" value="'.$rowBill['kot_itemval'].'" style="width:89px;margin-bottom:0px;"/></td>
	<td width="40"><input type="text" name="split" id="split" value="1" style="width:30px;margin-bottom:0px;"/></td>
</tr>';
} 
$sqlB=mysql_query("select SUM(kot_itemqty)AS iTmQty,SUM(kot_itemval)AS iTmVAl,kot_taxtotal,kot_disctot,kot_steward from pos_kotbill where kot_table='$tableNo' AND bill_status='1'");
$rowB=mysql_fetch_array($sqlB);
$kot_taxtotal=floatval($rowB['kot_taxtotal']);
$kot_disctot=floatval($rowB['kot_disctot']);
$grndTT=$rowB['iTmVAl']+$kot_taxtotal-$kot_disctot;

$tblDet.='<tr>
		<td width="40" style="text-align:center;"></td>
		<td width="80"></td>
		<td width="80" class="codesUPPERCase"></td>
		<td width="80" class="fstChUPPRCase"><input type="text" style="width:47px;border:1px solid #000;" value="'.$rowB['iTmQty'].'" name="totqty" id="totqty" readonly /></td>
		<td width="80" class="fstChUPPRCase"></td>
		<td width="80" class="fstChUPPRCase"><input type="text" style="width:92px;border:1px solid #000;" value="'.$rowB['iTmVAl'].'" name="totalval" id="totalval" readonly /></td>
		<td width="80" class="fstChUPPRCase"></td> 
		<td width="80" class="fstChUPPRCase"><input type="text" name="disamt" id="disamt" style="width:57px;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;" value="'.$rowB['kot_disctot'].'" readonly /></td>
		<td width="80" class="fstChUPPRCase"><input type="text" name="tottax" id="tottax" style="width:57px;border:1px solid #000;" value="'.$rowB['kot_taxtotal'].'" readonly /></td>
		<td width="80" class="fstChUPPRCase"><input type="text" name="netamt" id="netamt" style="width:89px;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;" value="'.$grndTT.'" readonly /></td>
		<td width="80" class="fstChUPPRCase"></td>
	</tr>';
	

	
echo $tblDet.','.$rowB['kot_steward'];
}
else{
	echo 1;
}

?>
