<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$fpno=$_GET['fpno'];

$output="";

$sql=mysql_query("select * from bq_opfpmenudetail where fpno='".$fpno."' AND itemcode='55555' ");
while($row=mysql_fetch_array($sql)){
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL"><input name="open_itemname[]" id="open_itemname" type="text"  class="textbox fstChUPPRCase expet" style="width:263px;margin:5px 0 0 0px" value="'.$row['itemname'].'" /></td>
	<td style="text-align:center;" class="sourceonVAL">
	<select name="open_submenu[]" id="open_submenu" type="text"  class="textbox fstChUPPRCase expet" style="width:110px;margin:5px 0 0 0px" value="">
		<option value="">--Select--</option>';
		$sqle=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
		while($res=mysql_fetch_array($sqle)){
			if($row['submenugrpcode']==$res['grpcode']){
			$output.='<option value="'.$res['grpcode'] .'" selected >'. strtoupper($res['grpname']).'</option>';	
			}else{
			$output.='<option value="'.$res['grpcode'] .'" >'. strtoupper($res['grpname']).'</option>';	
			}
		} 
$output.='</select>
</td>
</tr>';		
}

for($cc=1;$cc<30;$cc++){
$output.='<tr id="">
<td style="text-align:center;" class="sourceonVAL"><input name="open_itemname[]" id="open_itemname" type="text"  class="textbox fstChUPPRCase expet" style="width:263px;margin:5px 0 0 0px" value="" /></td>
<td style="text-align:center;" class="sourceonVAL">
<select name="open_submenu[]" id="open_submenu" type="text"  class="textbox fstChUPPRCase expet" style="width:110px;margin:5px 0 0 0px" value="">
			<option value="">--Select--</option>';
			$sqle=mysql_query("select distinct grpcode,grpname from bq_grpcode where status='1'");
			while($res=mysql_fetch_array($sqle)){
			$output.='<option value="'.$res['grpcode'] .'" >'. strtoupper($res['grpname']).'</option>';
				} 
$output.='</select>
</td>
</tr>';	
}

echo $output;
