<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$fpno=$_GET['fpno'];

$output="";

$sql=mysql_query("select * from bq_opfpdeptinst where fpno='".$fpno."'");
while($row=mysql_fetch_array($sql)){
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL">
<select name="dept_code[]" id="dept_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;" value="">
	<option value="">--Select--</option>';
	$sqle=mysql_query("select distinct dept_code,dept_name from bq_deptmt where status='1'");
	while($res=mysql_fetch_array($sqle)){
		if($res['dept_code']==$row['deptcode']){
		$output.='<option value="'.$res['dept_code'].'" selected >'.strtoupper($res['dept_name']).'</option>';
		}else{
		$output.='<option value="'.$res['dept_code'].'" >'.strtoupper($res['dept_name']).'</option>';
		}
	 } 
$output.='</select>
</td>
<td valign="top"><textarea cols="50" rows="1" name="dept_instr[]" id="dept_instr" value="" style="text-transform:uppercase;font-size:12px;">'.$row['deptdesc'].'</textarea></td>
</tr>';		
}

for($cc=1;$cc<30;$cc++){
$output.='<tr id="">
	<td style="text-align:center;" class="sourceonVAL">
<select name="dept_code[]" id="dept_code" type="text"  class="textbox fstChUPPRCase expet" style="width:100px;margin:5px 0 0 0px;" value="">
	<option value="">--Select--</option>';
	$sqle=mysql_query("select distinct dept_code,dept_name from bq_deptmt where status='1'");
	while($res=mysql_fetch_array($sqle)){
		$output.='<option value="'.$res['dept_code'].'" >'.strtoupper($res['dept_name']).'</option>';
	 } 
$output.='</select>
</td>
<td valign="top"><textarea cols="50" rows="2" name="dept_instr[]" id="dept_instr" value="" style="text-transform:uppercase;font-size:12px;"></textarea></td>
</tr>';	
}

echo $output;
