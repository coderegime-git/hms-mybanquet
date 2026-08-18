<?php
ob_start();
//session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$menu=$_GET['menu'];
$fpNo=$_GET['fpNo'];
$bkNo=$_GET['bkNo'];
$output="";
$outMnu="";

$sqlm=mysql_query("select * from bq_itemmaster where itmnu_code='".$menu."' AND status='1' AND itmsub_cat!='oth'");
$j=1;
while($row=mysql_fetch_array($sqlm)){
$j++;
$item_code=$row['item_code']; 
$item_name=$row['item_name']; 
$itmsub_cat=$row['itmsub_cat']; 
$itmsubmnu_code=$row['itmsubmnu_code']; 
$tax_struc=$row['tax_struc']; 
$item_rate=$row['item_rate']; 
$sqidt=mysql_fetch_array(mysql_query("select * from bq_opfpmenudetail where itemname='".$row['item_name']."' and fpno='".$fpNo."' and bill_status='1'"));
if($row['item_name']==$sqidt['itemname']){
	$ch="checked";
}else{
	$ch=" ";
}
$preff=ltrim($sqidt['preference']);
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="itemcode[]" id="item_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="'.$item_code.'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemname[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px" value="'.$item_name.'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="menusel[]" id="menusel" type="checkbox"  class="textbox fstChUPPRCase expet chk" style="width:52px;margin:5px 0 0 0px" value="'.$item_code.'" onclick="setMenu(this.value);Menuselval(this.value);"  '.$ch.' />
	<td style="text-align:center;" class="sourceonVAL"><input name="pref[]" id="pref'.$item_code.'" type="text"  class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="'.$preff.'" onkeyup="prefdet(this.value,'.$item_code.');"/></td>
	<input name="itmsub_cat[]" id="itmsub_cat" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$itmsub_cat.'" />
	<input name="itmsubmnu_code[]" id="itmsubmnu_code" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$itmsubmnu_code.'" />
	<input name="tax_struc[]" id="tax_struc" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$tax_struc.'" />
	<input name="item_rate[]" id="item_rate" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$item_rate.'" />
	</td>
</tr>	';
}


$sqm=mysql_query("select * from bq_itemmaster where itmnu_code='".$menu."' AND status='1'");
while($rm=mysql_fetch_array($sqm)){
	
$item_code=$row['item_code']; 
$item_name=$row['item_name']; 
$itmsub_cat=$row['itmsub_cat']; 
$itmsubmnu_code=$row['itmsubmnu_code']; 
$tax_struc=$row['tax_struc']; 
$item_rate=$row['item_rate']; 

$sqS=mysql_query("select * from bq_submenugrp where submenu_code='".$rm['itmsubmnu_code']."'");
$rmS=mysql_fetch_array($sqS);

$sqSM=mysql_query("select * from bq_menugrp where menu_code='".$rmS['subgrp_code']."'");
$rmSM=mysql_fetch_array($sqSM);

$status='1';
$sql="insert into bq_tempfp(bkno,item_code,item_name,menu_name,mnugrpcode,itmsub_cat,itmsubmnu_code,status)";
	 $sql.=" values(";
	 $sql.="'".$bkNo."',";
	 $sql.="'".$rm['item_code']."',";
	 $sql.="'".$rm['item_name']."',";
	 $sql.="'".$menu."',";
	 $sql.="'".$rmSM['menu_name']."',";
	 $sql.="'".$rm['itmsub_cat']."',";
	 $sql.="'".$rm['itmsubmnu_code']."',";
	 $sql.="'".$status."')";
	 /* echo $sql;
	 die(); */
	 $UsQuery =mysql_query($sql);
}	 

/*$outMnu.='<table class="tree" style="font-size:10px;font-weight:bold;">
 <tbody>';
$sqll=mysql_query("select * from bq_tempfp where status='1' group by mnugrpcode");
$x=1;
while($roww=mysql_fetch_array($sqll)){ 
$x++;
	$outMnu.='<tr class="treegrid-1 expanded"><td>'.strtoupper($roww['mnugrpcode']).'</td></tr>
    <tr class="treegrid-2 treegrid-parent-1"><td>'.strtoupper($roww['mnugrpcode']).'</td></tr>';
}
  $outMnu.='</tbody>
</table>';*/

$outMnu.='<table class="tree" style="font-size:10px;font-weight:bold;">
 <tbody>';
 
$sqll=mysql_query("select * from bq_opfpmenudetail where fpno='".$fpNo."' and bill_status='1' group by menugrpcode");
while($roww=mysql_fetch_array($sqll)){ 
$sqS=mysql_query("select * from bq_menugrp where menu_code='".$roww['menugrpcode']."'");
$rmS=mysql_fetch_array($sqS);
$outMnu.='<tr class="treegrid-1 expanded"><td>'.strtoupper($rmS['menu_name']).'</td></tr>';
$sqop=mysql_query("select * from bq_opfpmenudetail where fpno='".$roww['fpno']."' and menugrpcode='".$roww['menugrpcode']."' and bill_status='1'");
$x=1;
while($rowp=mysql_fetch_array($sqop)){
$x++;
	$outMnu.='<tr class="treegrid-2 treegrid-parent-1"><td>'.strtoupper($rowp['itemname']).'</td></tr>';
}
}
  $outMnu.='</tbody>
</table>';

 echo $output.'&#'.$outMnu; 
 
?>