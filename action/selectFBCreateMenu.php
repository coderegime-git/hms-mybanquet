<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$menu=$_GET['menu'];
$bkNo=$_GET['bkNo'];
$mcode=$_GET['mcode'];

if($mcode=='clrmenu'){
$sqlLk="UPDATE bq_tempfp SET ";
$sqlLk=$sqlLk."temp_sts='',";
$sqlLk=$sqlLk."status='0'";
$sqlLk=$sqlLk." where bkNo='".$bkNo."'" ;
//echo $sqlLk;
$UsQLk =mysql_query($sqlLk);
}

$submenu=$_GET['submenu'];
if($submenu!=''){
$sqlm=mysql_query("select * from bq_itemmaster where itmnu_code='".$menu."' AND status='1' AND itmsub_cat!='oth' and itmsubmnu_code='".$submenu."'");
}else{
$sqlm=mysql_query("select * from bq_itemmaster where itmnu_code='".$menu."' AND status='1' AND itmsub_cat!='oth'  LIMIT 70");
}
$output="";
$outMnu="";
//$sqlm=mysql_query("select * from bq_itemmaster where itmnu_code='".$menu."' AND status='1' AND itmsub_cat!='oth' ORDER BY FIELD(itmsubmnu_code, '".$submenu."')desc");
$x=0;
while($row=mysql_fetch_array($sqlm)){
 $x++;  
$item_code=$row['item_code']; 
$item_name=$row['item_name']; 
$itmsub_cat=$row['itmsub_cat']; 
$itmsubmnu_code=$row['itmsubmnu_code']; 
$tax_struc=$row['tax_struc']; 
$item_rate=$row['item_rate']; 
$pref=$row['item_rate']; 
 $sqidt=mysql_fetch_array(mysql_query("select * from bq_tempfp where status='2' and item_code='".$row['item_code']."' and bkNo='".$bkNo."' and mnugrpcode!='' group by item_code"));
if($row['item_code']==$sqidt['item_code']){
	$ch="checked";
}else{
	$ch=" ";
}
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="itemcode[]" id="item_code" type="hidden"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="'.$item_code.'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="itemname[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:280px;margin:5px 0 0 0px" value="'.$item_name.'" readonly /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="menusel[]" id="menusel'.$item_code.'" type="checkbox"  class="textbox fstChUPPRCase expet chk" style="width:52px;margin:5px 0 0 0px" value="'.$item_code.'" submenu="'.$itmsubmnu_code.'"  onclick="setMenu(this);" '.$ch.'/>
	<td style="text-align:center;" class="sourceonVAL"><input name="pref[]" id="pref'.$item_code.'" type="text"  class="textbox fstChUPPRCase expet" style="width:200px;margin:5px 0 0 0px" value="" /></td>
	<input name="itmsub_cat[]" id="itmsub_cat" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$itmsub_cat.'" />
	<input name="itmsubmnu_code[]" id="itmsubmnu_code" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$itmsubmnu_code.'" />
	<input name="tax_struc[]" id="tax_struc" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$tax_struc.'" />
	<input name="item_rate[]" id="item_rate" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$item_rate.'" />
	</td>
</tr>	';
}

$sqtm=mysql_query("select * from bq_tempfp where status='1' and bkNo='".$bkNo."'");
$rmTM=mysql_fetch_array($sqtm);
if($rmTM['menu_name']!=$menu){
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
}	 
/*lll  $outMnu.='<ul id="zeroTree" >';
$sqll=mysql_query("select * from bq_tempfp");
while($roww=mysql_fetch_array($sqll)){


$outMnu.='<li style="color:#7B0E0E;font-weight:bold;font-size:11px;" >'. $roww['mnugrpcode'].'
	<ul>
		<li style="color:#7B0E0E;font-weight:bold;font-size:11px;" >'. $roww['mnugrpcode'].'</li>
	</ul>
</li>';
 } 

$outMnu.='</ul>'; */
$outMnu.='<table class="tree" style="font-size:10px;font-weight:bold;">
 <tbody>';
$sqlt=mysql_query("select distinct itmsubmnu_code,bkNo from bq_tempfp where status='2' AND bkNo='".$bkNo."' and itmsubmnu_code!=''");
while($row=mysql_fetch_array($sqlt)){
	$sqlsb=mysql_query("select * from bq_submenugrp where status='1' and submenu_code='".$row['itmsubmnu_code']."'");
    $rowsb=mysql_fetch_array($sqlsb);
	$outMnu.='<tr class="treegrid-1 expanded"><td><input field="text" onclick="selsubCode(this);" style="cursor:pointer;border:none;" submenu="'.$rowsb['submenu_code'].'" value="'.strtoupper($rowsb['submenu_name']).'" readonly/></td></tr>';
$sqll=mysql_query("select * from bq_tempfp where status='2' AND itmsubmnu_code='".$row['itmsubmnu_code']."' and bkNo='".$row['bkNo']."' group by item_code");
$x=1;
while($roww=mysql_fetch_array($sqll)){
$x++;
    $outMnu.='<tr class="treegrid-2 treegrid-parent-1"><td>'.strtoupper($roww['item_name']).'</td></tr>';
}
}
  $outMnu.='</tbody>
</table>';
$outMnu.='<table class="tree" style="font-size:10px;font-weight:bold;">
 <tbody>';
$sqlt=mysql_query("SELECT itmsubmnu_code,item_code FROM `bq_itemmaster` where status='1' and itmnu_code='".$menu."' group by itmsubmnu_code");
$x=0;
while($row=mysql_fetch_array($sqlt)){
	$sqmc=mysql_fetch_array(mysql_query("select * from bq_tempfp where status='2' and itmsubmnu_code='".$row['itmsubmnu_code']."' and bkNo='".$bkNo."' and mnugrpcode!='' group by itmsubmnu_code"));
	
	$subcode = $row['itmsubmnu_code'];
$sqlLr=mysql_query("SELECT  * FROM `bq_submenugrp` WHERE submenu_code = '$subcode'"); 
$rowL=mysql_fetch_array($sqlLr);
	if($row['itmsubmnu_code']!=$sqmc['itmsubmnu_code']){
$x++;

	$outMnu.='<tr class="treegrid-'.$x.'" ><td><input field="text" onclick="selsubCode(this);" style="cursor:pointer;border:none;" submenu="'.$rowL['submenu_code'].'" value="'.strtoupper($rowL['submenu_name']).'" readonly/></td></tr>';
$sqll=mysql_query("select * from bq_itemmaster where status='1' and itmsubmnu_code='".$row['itmsubmnu_code']."' group by item_code");

while($roww=mysql_fetch_array($sqll)){

    $outMnu.='<tr class="treegrid-a'.$x.' treegrid-parent-'.$x.'"><td>'.strtoupper($roww['item_name']).'</td></tr>';
}
	}
}
  $outMnu.='</tbody>
</table>';

 echo $output.'&#'.$outMnu;

 
?>
