<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$menu=$_GET['menu'];
$output="";
$outMnu="";
/* echo "select * from bq_itemmaster where itmsubmnu_code='".$menu."'"; */
$sqlm=mysql_query("select * from bq_itemmaster where itmnu_code='".$menu."' AND status='1'");
while($row=mysql_fetch_array($sqlm)){
    
$item_code=$row['item_code']; 
$item_name=$row['item_name']; 
$itmsub_cat=$row['itmsub_cat']; 
$itmsubmnu_code=$row['itmsubmnu_code']; 
$tax_struc=$row['tax_struc']; 
$item_rate=$row['item_rate']; 
 
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="item_code[]" id="item_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px" value="'.$item_code.'" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="item_name[]" id="item_name" type="text"  class="textbox fstChUPPRCase expet" style="width:230px;margin:5px 0 0 0px" value="'.$item_name.'" /></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="menusel[]" id="menusel" type="checkbox"  class="textbox fstChUPPRCase expet" style="width:52px;margin:5px 0 0 0px" value="'.$item_code.'" />
	<input name="itmsub_cat[]" id="itmsub_cat" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$itmsub_cat.'" />
	<input name="itmsubmnu_code[]" id="itmsubmnu_code" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$itmsubmnu_code.'" />
	<input name="tax_struc[]" id="tax_struc" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$tax_struc.'" />
	<input name="item_rate[]" id="item_rate" type="hidden"  class="textbox fstChUPPRCase" style="width:52px;margin:5px 0 0 0px" value="'.$item_rate.'" />
	</td>
</tr>	';
}

$outMnu.='<ul id="zeroTree" >';
$sqlm=mysql_query("select distinct itmsubmnu_code from bq_itemmaster where itmnu_code='".$menu."' AND status='1'");
while($row=mysql_fetch_array($sqlm)){
/* echo "select * from bq_submenugrp where submenu_code='".$row['itmsubmnu_code']."' AND status='1'"; */
$sql=mysql_query("select distinct submenu_name from bq_submenugrp where submenu_code='".$row['itmsubmnu_code']."' AND status='1'");
$row=mysql_fetch_array($sql);


$outMnu.='<li style="color:#7B0E0E;font-weight:bold;font-size:11px;" >'. $row['submenu_name'].'
	<ul>
		<li style="color:#7B0E0E;font-weight:bold;font-size:11px;" >'. $row['submenu_name'].'</li>
	</ul>
</li>';
 } 

$outMnu.='</ul>';

 echo $output.'&#'.$outMnu;
?>