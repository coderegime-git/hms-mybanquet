<?php  

include("../config.php");
$date=date('d/m/Y');


$frm=$_GET['frm'];


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


$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtrDt=$frm;
$dte=explode('/',$adtrDt);
$dtea=$dte[2].'-'.$dte[1].'-'.$dte[0];

$adtCurDt = date('d/m/Y', strtotime('+1 days', strtotime($dtea)));
/* echo $dateE;
die(); */
/* echo $adtCurDt;
die(); */
$output="";
$output.='<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;">

<tr>';


$frDate=$adtCurDt;
$toDate=$adtCurDt;	

$frxpl=explode('/',$frDate);
$frDt=@$frxpl[2].'-'.@$frxpl[1].'-'.@$frxpl[0];
$toDat=explode('/',$toDate);
$toDD=@$toDat[2].'-'.@$toDat[1].'-'.@$toDat[0];
		
$date_from = $frDt;   
$date_from = strtotime($date_from); 
$date_to = $toDD;  
$date_to = strtotime($date_to);  
for ($i=$date_from; $i<=$date_to; $i+=86400) {
	
$rr= date("d/m/Y", $i);	
$rrr= date("Y-m-d", $i);
$sqlRe=mysql_query("select * from bq_venue");
$x=0;
while($rowRe=mysql_fetch_array($sqlRe)){
	$x++;

		 if($x==1) { 
		
		$output.='<td style="text-align:center;width:80px;">'.$adtCurDt.'</td>';
		 }else{ 
		$output.='<td style="text-align:center;width:80px;">&nbsp;</td>';
		} 
		$output.='<td style="text-align:left;width:80px;"><a href="'. $home_path.'/transaction/frontdesk/hall-booking.php?ven='.$rowRe['venue_desc'].'&dte='.$rr.'" style="color:#000;">'.$rowRe['venue_desc'].'</a></td>';

for($cc=6;$cc<=24;$cc++){
$sqD=mysql_query("select * from bq_dashhall where str_to_date(funtion_date,'%d/%m/%Y') = '$rrr' AND venue='".$rowRe['venue_desc']."' AND hour='".$cc."' AND status='1'");
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
	
}

$output.='<td style="text-align:center;width:20px;background-color:'.$bgcolor.';color:#fff;" ><a href="'.$home_path.'/transaction/frontdesk/edit-hall-booking.php?roomBk='.$roD['booking_no'].'&rmBkID='.$roD['hallbook_id'].'" data-toggle="tooltip" title="BK#:'.$roD['booking_no'].','.strtoupper('  GUEST:'.$roD['guest_name']).',  PAX: '.$sqb['guaranted'].'">&nbsp;</a></td>';
 }else{ 
$output.='<a href="'.$home_path.'/transaction/frontdesk/hall-booking.php?dte='.$rr.'&ven='.$rowRe['venue_desc'].'"><td style="text-align:center;width:20px;background-color:#'.$rowRv['room_color'].'" onclick="vcntRoomBook();"><a href="'. $home_path.'/transaction/frontdesk/hall-booking.php?dte='.$rr.'&ven='.$rowRe['venue_desc'].'" data-toggle="tooltip" title="Vacant!">&nbsp;</a>&nbsp;&nbsp;</td></a>';
	
} }
		
	$output.='</tr>';	

  } 

  }  
  
$output.='</table>';

echo $output.'&#'.$adtCurDt ;


