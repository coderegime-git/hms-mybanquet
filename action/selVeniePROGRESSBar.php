<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$venu=$_GET['venu'];
$bkDt=$_GET['bkDt'];
/* $ses=$_GET['ses']; */

$bk=explode('/',$bkDt);
$bkm=@$bk[2].'-'.@$bk[1].'-'.@$bk[0];

$sqlRv=mysql_query("select * from bq_stscolor where roomoccupy_id='1'");
$rowRv=mysql_fetch_array($sqlRv); 
$sqlRd=mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
$rowRd=mysql_fetch_array($sqlRd);
$sqlRo=mysql_query("select * from bq_stscolor where roomoccupy_id='3'");
$rowRo=mysql_fetch_array($sqlRo); 
$sqlRg=mysql_query("select * from bq_stscolor where roomoccupy_id='4'");
$rowRg=mysql_fetch_array($sqlRg);
$sqlRm=mysql_query("select * from bq_stscolor where roomoccupy_id='5'");
$rowRm=mysql_fetch_array($sqlRm);
$sqlRe=mysql_query("select * from bq_stscolor where roomoccupy_id='6'");
$rowbl=mysql_fetch_array($sqlRe);


$output="";


$output.='<tr>';		
$output.='<td style="text-align:left;width:80px;"><a href="#" style="color:#000;">'.$venu.'</a></td>';		

for($cc=6;$cc<=24;$cc++){

$sqD=mysql_query("select * from bq_dashhall where str_to_date(funtion_date,'%d/%m/%Y') = '$bkm' AND venue='".$venu."' AND hour='".$cc."' AND status='1'");
if(mysql_num_rows($sqD)>0){
$roD=mysql_fetch_array($sqD);

$sqb=mysql_fetch_array(mysql_query("select * from bq_hallbooking where booking_no='".$roD['booking_no']."' AND hallbook_id='".$roD['hallbook_id']."'"));	

if($roD['confirm_status']==1){
	$bgcolor= '#'.$rowRv['room_color'];
}else if($roD['confirm_status']==2){
	$bgcolor= '#'.$rowRd['room_color'];
}else if($roD['confirm_status']==3){
	$bgcolor= '#'.$rowRo['room_color'];
}else if($roD['confirm_status']==4){
	$bgcolor= '#'.$rowRg['room_color'];
}else if($roD['confirm_status']==5){
	$bgcolor= '#'.$rowRm['room_color'];
}else if($roD['confirm_status']==6){
	$bgcolor= '#'.$rowbl['room_color'];
}else{
	/* $bgcolor= '#'.$rowRd['room_color']; */
}
/* echo $bgcolor; */

$output.='<td style="text-align:center;width:20px;background-color:'. $bgcolor.';color:#fff;" ><a href="'. $home_path.'/transaction/frontdesk/edit-hall-booking.php?roomBk='. $roD['booking_no'].'&rmBkID='.$roD['hallbook_id'].'" data-toggle="tooltip" title="'. 'BK#:'.$roD['booking_no'].','.strtoupper('  GUEST:'.$roD['guest_name']).',  PAX: '.$sqb['guaranted'].'">&nbsp;</a></td>';
 }else{ 
$output.='<a href="#"><td style="text-align:center;width:20px;background-color:#'.$rowRv['room_color'].'" onclick="vcntRoomBook();"><a href="#" data-toggle="tooltip" title="Vacant!">&nbsp;</a>&nbsp;&nbsp;</td></a>';	
	
 } } 
		
	

$output.='</tr>';
echo $output;
/* else{
	echo '1';
} */


