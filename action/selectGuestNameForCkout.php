<?php  

include("../config.php");
$room_no=$_GET['room_no'];

$sqlRr=mysql_query("select distinct mainreg_num,linkregnum from link_room where mainroom_no='".$_GET['room_no']."' OR linkroomnum='".$_GET['room_no']."' AND bill_status='1'");
if(mysql_num_rows($sqlRr)>0){
	$rowRr=mysql_fetch_array($sqlRr);
	$mainreg_num=$rowRr['mainreg_num'];
	$linkregnum=$rowRr['linkregnum'];

	$sql="select distinct guest_name from guest_register gr, guest_trans gt where gr.guestreg_id='$mainreg_num' AND gt.reg_num='$mainreg_num' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$guest_name=$row['guest_name'];

	$sqlln="select distinct guest_name from guest_register gr, guest_trans gt where gr.guestreg_id='$linkregnum' AND gt.reg_num='$linkregnum' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'";
	$resln=mysql_query($sqlln);
	$rowln=mysql_fetch_array($resln);
	$lnkguest_name=$rowln['guest_name'];

	$x=0;$roomDis="";$roomDiLM="";
	$sqlLi=mysql_query("select distinct mainreg_num,linkregnum from link_room where mainroom_no='".$_GET['room_no']."' OR linkroomnum='".$_GET['room_no']."' AND bill_status='1'");
	$rowLi=mysql_fetch_array($sqlLi);

	$sqlB="select (sum(tax_val)+sum(debit)-sum(credit)) AS balance,room_no,reg_num,bill_status from guest_trans where reg_num='".$rowLi['mainreg_num']."' AND bill_status='1'";
	$sqlBa=mysql_query($sqlB);
	if(mysql_num_rows($sqlBa)>0){
	$rowBal=mysql_fetch_array($sqlBa);
		$x++;
		$roomDis.='<tr><td width="" style="text-align:center;"><input name="sr_no[]" id="sr_no" type="text"  class="fstChUPPRCase inptSt" style="width:33px;" value="'.$x.'" readonly /></td>
			<td width="" style="text-align:center;"><input name="room_no[]" id="room_no" type="text" class="fstChUPPRCase inptSt" style="width:104px;" value="'.$rowBal['room_no'].'" readonly /></td>
			<td width="" style="text-align:center;"><input name="reg_num[]" id="reg_num" type="text"  class="fstChUPPRCase inptSt" style="width:129px;" value="'.$rowBal['reg_num'].'" readonly /></td>
			<td width="" style="text-align:center;"><input name="guest_name[]" id="guest_name" type="text"  class="fstChUPPRCase inptSt" style="width:244px;" value="'.$guest_name.'" readonly /></td>
			<td width="" style="text-align:center;"><input name="balance[]" id="balance" type="text"  class="fstChUPPRCase inptSt" style="width:113px;" value="'.$rowBal['balance'].'" readonly /></td>
			<td width="" style="text-align:center;"><input name="status[]" id="c_'.$rowBal['reg_num'].'" type="checkbox" class="chk ckPrint statusCHK"  style="width:80px;" value="'.$rowBal['reg_num'].'" onclick="checkSubmit(this);" /></td></tr>';  
	}

	$sqllr="select (sum(tax_val)+sum(debit)-sum(credit)) AS balance,room_no,reg_num,bill_status from guest_trans where reg_num='".$rowLi['linkregnum']."' AND bill_status='1'";
	$sqR=mysql_query($sqllr);
	if(mysql_num_rows($sqR)>0){
	$rowR=mysql_fetch_array($sqR);
		$x++;
		$roomDis.='<tr><td width="" style="text-align:center;"><input name="sr_no[]" id="sr_no" type="text"  class="fstChUPPRCase inptSt" style="width:33px;" value="'.$x.'" readonly /></td>
			<td width="" style="text-align:center;"><input name="room_no[]" id="room_no" type="text" class="fstChUPPRCase inptSt" style="width:104px;" value="'.$rowR['room_no'].'" readonly /></td>
			<td width="" style="text-align:center;"><input name="reg_num[]" id="reg_num" type="text"  class="fstChUPPRCase inptSt" style="width:129px;" value="'.$rowR['reg_num'].'" readonly /></td>
			<td width="" style="text-align:center;"><input name="guest_name[]" id="guest_name" type="text"  class="fstChUPPRCase inptSt" style="width:244px;" value="'.$lnkguest_name.'" readonly /></td>
			<td width="" style="text-align:center;"><input name="balance[]" id="balance" type="text"  class="fstChUPPRCase inptSt" style="width:113px;" value="'.$rowR['balance'].'" readonly /></td>
			<td width="" style="text-align:center;"><input name="status[]" id="c_'.$rowR['reg_num'].'" type="checkbox" class="chk ckPrint statusCHK"  style="width:80px;" value="'.$rowR['reg_num'].'" onclick="checkSubmit(this);" /></td></tr>';  
	}
}else{
	$sqlgY=mysql_query("select distinct guest_name,guestreg_id from guest_register gr, guest_trans gt where gr.room_no='".$_GET['room_no']."' AND gt.room_no='".$_GET['room_no']."' AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'");
	$rowgY=mysql_fetch_array($sqlgY);
	$guest_name=$rowgY['guest_name'];
	$roomDis="";
	$sqTy="select (sum(tax_val)+sum(debit)-sum(credit)) AS balance,room_no,reg_num,bill_status from guest_trans where reg_num='".$rowgY['guestreg_id']."' AND bill_status='1'";
	$resY=mysql_query($sqTy);
	if(mysql_num_rows($resY)>0){
	$rowsY=mysql_fetch_array($resY);
		$x=1;
		$roomDis.='<tr><td width="" style="text-align:center;"><input name="sr_no[]" id="sr_no" type="text"  class="fstChUPPRCase inptSt" style="width:33px;" value="'.$x.'" readonly /></td>
			<td width="" style="text-align:center;"><input name="room_no[]" id="room_no" type="text" class="fstChUPPRCase inptSt" style="width:104px;" value="'.$rowsY['room_no'].'" readonly /></td>
			<td width="" style="text-align:center;"><input name="reg_num[]" id="reg_num" type="text"  class="fstChUPPRCase inptSt" style="width:129px;" value="'.$rowsY['reg_num'].'" readonly /></td>
			<td width="" style="text-align:center;"><input name="guest_name[]" id="guest_name" type="text"  class="fstChUPPRCase inptSt" style="width:244px;" value="'.$guest_name.'" readonly /></td>
			<td width="" style="text-align:center;"><input name="balance[]" id="balance" type="text"  class="fstChUPPRCase inptSt" style="width:113px;" value="'.$rowsY['balance'].'" readonly /></td>
			<td width="" style="text-align:center;"><input name="status[]" id="c_'.$rowgY['guestreg_id'].'" type="checkbox" class="chk ckPrint statusCHK"  style="width:80px;" value="'.$rowgY['guestreg_id'].'" onclick="checkSubmit(this);" /></td></tr>';  
	}
	
}
  echo $roomDis.','.$guest_name; 


?>