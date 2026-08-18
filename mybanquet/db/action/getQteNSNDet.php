<?php  
session_start();
include("../config.php");

$nsnNBR=$_GET['nsnNmber'];

/*  echo $nsnNBR; */

/* $sqlN=mysql_query("select * from nsnpart_assign where nsnnumber='$nsnNBR'");
$rowN=mysql_fetch_array($sqlN);
$partNBRASSign=$rowN['partnumber'];
$partname=$rowN['partname']; */


$sql=mysql_query("select * from partnumber where nsnnumber='$nsnNBR'");

$partNMe="";
$partname="";

$partNMe.='<select style="height:100px;scroll:auto" name="part_no[]" id="partnumber" style="font-size:14px;" multiple onChange="selPartNo();">';
$partNMe.='<option value="">--Select--</option>';

$partname.='<select style="height:100px;scroll:auto" name="part_name[]" id="part_name" style="font-size:14px;" multiple disabled >';
$partname.='<option value="">--Select--</option>';

if(mysql_num_rows($sql)>0){
	while($row=mysql_fetch_array($sql)){
		$partNMe.='<option value="'.$row['partnumber'].'" selected>'.$row['partnumber'].'</option>'; 
		$partname.='<option value="'.$row['partname'].'" selected>'.$row['partname'].'</option>'; 
	}
	$partNMe.='</select><label id="oldPartNO" onClick="selectOLDPartNO();" style="cursor:pointer;display:none;padding: 5px 0 0 0;">&nbsp;Partno</label>

	<label id="newPartNO" onClick="selectPartNO();" style="cursor:pointer;padding: 5px 0 0 0;">&nbsp;New Partno</label>
	<input name="new_partno" id="new_partno" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="display:none;"/>';
	
	$partname.='</select><input name="new_partname" id="new_partname" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="display:none;"/>';
} 

 
 echo $partNMe.','.$partname ;  

?>