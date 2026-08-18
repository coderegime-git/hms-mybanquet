<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$cr=explode('/',$rowAC['cur_date']);
$ctt=$cr[2].'-'.$cr[1].'-'.$cr[0];	

$srch=$_GET['srch'];

$output="";
/* $sqle=mysql_query("select * from bq_hallbooking where guest_name like '%".$_GET['srch']."%' AND str_to_date(book_date,'%d/%m/%Y')>='$ctt' AND confirm_status='2' AND fp_status='' group by booking_no"); */
$sqle=mysql_query("select * from bq_hallbooking where guest_name like '%".$_GET['srch']."%' AND str_to_date(book_date,'%d/%m/%Y')>='$ctt' AND confirm_status='2' ");
while($res=mysql_fetch_array($sqle)){
	
$booking_no=$res['booking_no'];
$hallbook_id=$res['hallbook_id'];
$guest_name=$res['guest_name'];
$book_date=$res['book_date'];

$output.='<tr>
<td style="width:80px;"><input type="text" name="actChk[]" id="actChk" value="'.$booking_no.'" style="width:80px;border:none;" class="textbox fstChUPPRCase actC" onclick="grpWse();" readonly /></td>
<td style="width:80px;"><input type="text" name="actChk[]" id="actChk" value="'.$hallbook_id.'" style="width:80px;border:none;" class="textbox fstChUPPRCase actC" onclick="grpWse();" readonly /></td>
<td style="width:150px;"><input type="text" name="grp_code[]" id="grp_code" value="'.$guest_name.'" style="width:150px;border:none;" class="textbox fstChUPPRCase" readonly /></td>
<td style="width:150px;"><input type="text" name="grp_code[]" id="grp_code" value="'.$book_date.'" style="width:150px;border:none;" class="textbox fstChUPPRCase" readonly /></td>
<td style="width:150px;border:none;"> <button type="button" onclick="selBQTFBCreat('.$res['booking_no'].','.$hallbook_id.');" class="btnH" data-dismiss="modal">Click</button></td>
</tr>';

} 
 
echo $output;
 
?>