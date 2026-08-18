<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$book_date=$_POST['book_date'];

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];


/*  Start Hall Booking Cancelled */
for($cc=0; $cc<count($_POST['book_date']);$cc++ ) {
if($_POST['confirm_status'][$cc]==7) {
		
$bokD=$_POST['book_date'][$cc];
$fr=explode('/',$bokD);
$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];

$sqll="UPDATE bq_hallbooking SET ";
$sqll=$sqll."audit_date='".$curDate."',";
$sqll=$sqll."confirm_status='".$_POST['confirm_status'][$cc]."',";
$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'";
mysql_query($sqll);

$sbD=mysql_query("select * from bq_dashhallbook where str_to_date(book_date,'%d/%m/%Y')='$frm' AND venue='".$_POST['venue'][$cc]."'");
while($rRe=mysql_fetch_array($sbD)){
	$t6=explode(',',$rRe['tme6']);
	$t7=explode(',',$rRe['tme7']);
	$t8=explode(',',$rRe['tme8']);
	$t9=explode(',',$rRe['tme9']);
	$t10=explode(',',$rRe['tme10']);
	$t11=explode(',',$rRe['tme11']);
	$t12=explode(',',$rRe['tme12']);
	$t13=explode(',',$rRe['tme13']);
	$t14=explode(',',$rRe['tme14']);
	$t15=explode(',',$rRe['tme15']);
	$t16=explode(',',$rRe['tme16']);
	$t17=explode(',',$rRe['tme17']);
	$t18=explode(',',$rRe['tme18']);
	$t19=explode(',',$rRe['tme19']);
	$t20=explode(',',$rRe['tme20']);
	$t21=explode(',',$rRe['tme21']);
	$t22=explode(',',$rRe['tme22']);
	$t23=explode(',',$rRe['tme23']);
	$t24=explode(',',$rRe['tme24']);
	
	if($t6[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme6='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t7[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme7='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t8[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme8='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t9[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme9='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t10[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme10='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t11[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme11='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t12[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme12='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t13[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme13='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t14[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme14='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t15[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme15='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t16[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme16='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t17[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme17='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t18[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme18='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t19[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme19='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t20[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme20='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t21[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme21='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t22[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme22='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t23[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme23='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t24[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme24='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	
}
}
}
/*  End  Hall Booking Cancelled */




/*  Start Hall Booking Updated with already exists */
for($cc=0; $cc<count($_POST['book_date']);$cc++ ) {
if($_POST['confirm_status'][$cc]!=7 && $_POST['confirm_status'][$cc]!='') {
	
$bokD=$_POST['book_date'][$cc];
$fr=explode('/',$bokD);
$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];

/* $sbD=mysql_query("select * from bq_hallbooking where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'");  */
/* echo "select * from bq_dashhallbook where str_to_date(book_date,'%d/%m/%Y')='$frm' AND venue='".$_POST['venue'][$cc]."'"; */
$sbD=mysql_query("select * from bq_dashhallbook where str_to_date(book_date,'%d/%m/%Y')='$frm' AND venue='".$_POST['venue'][$cc]."'");
while($rRe=mysql_fetch_array($sbD)){

	$t6=explode(',',$rRe['tme6']);
	$t7=explode(',',$rRe['tme7']);
	$t8=explode(',',$rRe['tme8']);
	$t9=explode(',',$rRe['tme9']);
	$t10=explode(',',$rRe['tme10']);
	$t11=explode(',',$rRe['tme11']);
	$t12=explode(',',$rRe['tme12']);
	$t13=explode(',',$rRe['tme13']);
	$t14=explode(',',$rRe['tme14']);
	$t15=explode(',',$rRe['tme15']);
	$t16=explode(',',$rRe['tme16']);
	$t17=explode(',',$rRe['tme17']);
	$t18=explode(',',$rRe['tme18']);
	$t19=explode(',',$rRe['tme19']);
	$t20=explode(',',$rRe['tme20']);
	$t21=explode(',',$rRe['tme21']);
	$t22=explode(',',$rRe['tme22']);
	$t23=explode(',',$rRe['tme23']);
	$t24=explode(',',$rRe['tme24']);
	
	if($t6[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme6='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t7[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme7='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t8[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme8='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t9[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme9='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t10[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme10='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t11[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme11='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t12[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme12='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t13[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme13='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t14[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme14='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t15[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme15='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t16[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme16='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t17[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme17='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t18[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme18='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t19[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme19='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t20[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme20='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t21[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme21='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t22[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme22='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t23[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme23='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}
	if($t24[1]==$_POST['bookNum']){
		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme24='',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where book_date='".$_POST['book_date'][$cc]."' AND venue='".$_POST['venue'][$cc]."'";
		mysql_query($sqll);
	}


if($_POST['from_time'][$cc]!=''){
	
			$starttime = $_POST['from_time'][$cc]; 
			$endtime = $_POST['to_time'][$cc]; 
			$st=explode(':',$starttime); 
			$str=$st[0];
			$en=explode(':',$endtime); 
			$enr=$en[0];

for($sT=$str;$sT<=$enr;$sT++){
	
$bookNum=$_POST['bookNum'];
$sqM=mysql_query("select * from bq_dashhallbook where str_to_date(book_date,'%d/%m/%Y') = '$frm' AND venue='".$_POST['venue'][$cc]."'");
$rwM=mysql_fetch_array($sqM);
$dash_id=$rwM['dash_id'];

		if($sT=='06'){$tmS6=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS6=$rwM['tme6'];}
		if($sT=='07'){$tmS7=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS7=$rwM['tme7'];}
		if($sT=='08'){$tmS8=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS8=$rwM['tme8'];}
		if($sT=='09'){$tmS9=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS9=$rwM['tme9'];}
		if($sT=='10'){$tmS10=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS10=$rwM['tme10'];}
		if($sT=='11'){$tmS11=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS11=$rwM['tme11'];}
		if($sT=='12'){$tmS12=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS12=$rwM['tme12'];}
		if($sT=='13'){$tmS13=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS13=$rwM['tme13'];}
		if($sT=='14'){$tmS14=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS14=$rwM['tme14'];}
		if($sT=='15'){$tmS15=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS15=$rwM['tme15'];}
		if($sT=='16'){$tmS16=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS16=$rwM['tme16'];}
		if($sT=='17'){$tmS17=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS17=$rwM['tme17'];}
		if($sT=='18'){$tmS18=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS18=$rwM['tme18'];}
		if($sT=='19'){$tmS19=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS19=$rwM['tme19'];}
		if($sT=='20'){$tmS20=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS20=$rwM['tme20'];}
		if($sT=='21'){$tmS21=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS21=$rwM['tme21'];}
		if($sT=='22'){$tmS22=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS22=$rwM['tme22'];}
		if($sT=='23'){$tmS23=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS23=$rwM['tme23'];}
		if($sT=='24'){$tmS24=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS24=$rwM['tme24'];}
	

		$sqll="UPDATE bq_dashhallbook SET ";
		$sqll=$sqll."tme6='".$tmS6."',";
		$sqll=$sqll."tme7='".$tmS7."',";
		$sqll=$sqll."tme8='".$tmS8."',";
		$sqll=$sqll."tme9='".$tmS9."',";
		$sqll=$sqll."tme10='".$tmS10."',";
		$sqll=$sqll."tme11='".$tmS11."',";
		$sqll=$sqll."tme12='".$tmS12."',";
		$sqll=$sqll."tme13='".$tmS13."',";
		$sqll=$sqll."tme14='".$tmS14."',";
		$sqll=$sqll."tme15='".$tmS15."',";
		$sqll=$sqll."tme16='".$tmS16."',";
		$sqll=$sqll."tme17='".$tmS17."',";
		$sqll=$sqll."tme18='".$tmS18."',";
		$sqll=$sqll."tme19='".$tmS19."',";
		$sqll=$sqll."tme20='".$tmS20."',";
		$sqll=$sqll."tme21='".$tmS21."',";
		$sqll=$sqll."tme22='".$tmS22."',";
		$sqll=$sqll."tme23='".$tmS23."',";
		$sqll=$sqll."tme24='".$tmS24."',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where dash_id='".$dash_id."'";
		/* echo $sqll; */
		$resultt=mysql_query($sqll);
}
			
		
}
}
}
}
/* die(); */
/*  End  Hall Booking Updated already exists  */








/* Start Hall Booking newly inserted exists */

/* for($cc=0;$cc<count($_POST['from_time']);$cc++) {
	$bokD=$_POST['book_date'][$cc];
	$fr=explode('/',$bokD);
	$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
	
$sqM=mysql_query("select * from bq_dashhallbook where str_to_date(book_date,'%d/%m/%Y') = '$frm' AND venue='".$_POST['venue'][$cc]."' ");
if(mysql_num_rows($sqM)==0){
			
	if($_POST['from_time'][$cc]!=''){
		
		$starttime = $_POST['from_time'][$cc];
		$endtime = $_POST['to_time'][$cc];
		$duration = '60';
		$st=explode(':',$starttime); 
		$str=$st[0];
		$en=explode(':',$endtime); 
		$enr=$en[0];
		
		for($sT=$str;$sT<=$enr;$sT++){
		 echo $sT;
				if($sT=='06'){$tmS6=$_POST['confirm_status'][$cc].','.$bookNum;}else{$tmS6="";}
				if($sT=='07'){$tmS7=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='08'){$tmS8=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='09'){$tmS9=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='10'){$tmS10=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='11'){$tmS11=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='12'){$tmS12=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='13'){$tmS13=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='14'){$tmS14=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='15'){$tmS15=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='16'){$tmS16=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='17'){$tmS17=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='18'){$tmS18=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='19'){$tmS19=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='20'){$tmS20=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='21'){$tmS21=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='22'){$tmS22=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='23'){$tmS23=$_POST['confirm_status'][$cc].','.$bookNum;}
				if($sT=='24'){$tmS24=$_POST['confirm_status'][$cc].','.$bookNum;}
			if($sT==$str){
				$sqlAR="insert into  bq_dashhallbook(audit_date,book_date,venue,session,from_time,to_time,tme6,tme7,tme8,tme9,tme10,tme11,tme12,tme13,tme14,tme15,tme16,tme17,tme18,tme19,tme20,tme21,tme22,tme23,tme24,status,added_by,added_on)";
						$sqlAR.=" values(";
						$sqlAR.="'".$curDate."',";
						$sqlAR.="'".$_POST['book_date'][$cc]."',";
						$sqlAR.="'".$_POST['venue'][$cc]."',";
						$sqlAR.="'".$_POST['session'][$cc]."',";
						$sqlAR.="'".$_POST['from_time'][$cc]."',";
						$sqlAR.="'".$_POST['to_time'][$cc]."',";
						$sqlAR.="'".$tmS6."',";
						$sqlAR.="'".$tmS7."',";
						$sqlAR.="'".$tmS8."',";
						$sqlAR.="'".$tmS9."',";
						$sqlAR.="'".$tmS10."',";
						$sqlAR.="'".$tmS11."',";
						$sqlAR.="'".$tmS12."',";
						$sqlAR.="'".$tmS13."',";
						$sqlAR.="'".$tmS14."',";
						$sqlAR.="'".$tmS15."',";
						$sqlAR.="'".$tmS16."',";
						$sqlAR.="'".$tmS17."',";
						$sqlAR.="'".$tmS18."',";
						$sqlAR.="'".$tmS19."',";
						$sqlAR.="'".$tmS20."',";
						$sqlAR.="'".$tmS21."',";
						$sqlAR.="'".$tmS22."',";
						$sqlAR.="'".$tmS23."',";
						$sqlAR.="'".$tmS24."',";
						$sqlAR.="'".$_POST['confirm_status'][$cc]."',";
						$sqlAR.="'".$added_by."',";
						$sqlAR.="'".$added_on."')";
						$UsQueCy =mysql_query($sqlAR); 
						
						$reg_id = mysql_insert_id();
			}
		
				
		}
	}
	} 
} */

/* die(); */
/* die();  */
/*  End  Hall Booking newly inserted exists  */















/*  Start Hall Booking */
for($cc=0; $cc<count($book_date);$cc++ ){
	$adv="";
	$sts="";

$sbk=mysql_query("select * from bq_hallbooking where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'");
	if(mysql_num_rows($sbk)>0){
	while($rbK=mysql_fetch_array($sbk)){
		 if($_POST['book_date'][$cc]!=''){ 
		/* if($rbK['venue']==$_POST['venue'][$cc] && $rbK['session']==$_POST['session'][$cc] &&  $rbK['from_time']==$_POST['from_time'][$cc] && $rbK['to_time']==$_POST['to_time'][$cc] && $rbK['confirm_status']==$_POST['confirm_status'][$cc] ){ */ 
		
		 /* if($rbK['book_date']==$_POST['book_date'][$cc] && $rbK['venue']==$_POST['venue'][$cc] && $rbK['session']==$_POST['session'][$cc] &&  $rbK['from_time']==$_POST['from_time'][$cc] && $rbK['to_time']==$_POST['to_time'][$cc] && $rbK['confirm_status']==$_POST['confirm_status'][$cc] ){  */
		 
			$sqll="UPDATE bq_hallbooking SET ";
			$sqll=$sqll."audit_date='".$curDate."',";
			$sqll=$sqll."book_date='".$_POST['book_date'][$cc]."',";
			$sqll=$sqll."booking_no='".$_POST['bookNum']."',";
			$sqll=$sqll."venue='".$_POST['venue'][$cc]."',";
			$sqll=$sqll."session='".$_POST['session'][$cc]."',";
			$sqll=$sqll."from_time='".$_POST['from_time'][$cc]."',";
			$sqll=$sqll."to_time='".$_POST['to_time'][$cc]."',";
			$sqll=$sqll."seating='".$_POST['seating'][$cc]."',";
			$sqll=$sqll."funct='".$_POST['funct'][$cc]."',";
			$sqll=$sqll."expected='".$_POST['expected'][$cc]."',";
			$sqll=$sqll."guaranted='".$_POST['guaranted'][$cc]."',";
			$sqll=$sqll."hall_rate='".$_POST['hall_rate'][$cc]."',";
			$sqll=$sqll."confirm_status='".$_POST['confirm_status'][$cc]."',";
			$sqll=$sqll."fp_status='".$sts."',";
			$sqll=$sqll."chief_guest='".$_POST['chief_guest'][$cc]."',";
			$sqll=$sqll."corporate='".$_POST['corporate']."',";
			$sqll=$sqll."title='".$_POST['title']."',";
			$sqll=$sqll."guest_name='".$_POST['guest_name']."',";
			$sqll=$sqll."address1='".$_POST['address1']."',";
			$sqll=$sqll."address2='".$_POST['address2']."',";
			$sqll=$sqll."city='".$_POST['city']."',";
			$sqll=$sqll."pin='".$_POST['pin_code']."',";
			$sqll=$sqll."state='".$_POST['state']."',";
			$sqll=$sqll."country='".$_POST['country']."',";
			$sqll=$sqll."phone='".$_POST['phone']."',";
			$sqll=$sqll."email='".$_POST['email']."',";
			$sqll=$sqll."comp_code='".$_POST['comp_code']."',";
			$sqll=$sqll."company_name='".$_POST['company_name']."',";
			$sqll=$sqll."comaddress1='".$_POST['comaddress1']."',";
			$sqll=$sqll."comaddress2='".$_POST['comaddress2']."',";
			$sqll=$sqll."comcity='".$_POST['comcity']."',";
			$sqll=$sqll."compin='".$_POST['compincode']."',";
			$sqll=$sqll."comstate='".$_POST['comstate']."',";
			$sqll=$sqll."comcountry='".$_POST['comcountry']."',";
			$sqll=$sqll."comphone='".$_POST['comphone']."',";
			$sqll=$sqll."comemail='".$_POST['comemail']."',";
			$sqll=$sqll."contact_person='".$_POST['contact_person']."',";
			$sqll=$sqll."contact_mobile='".$_POST['contact_mobile']."',";
			$sqll=$sqll."booked_by='".$_POST['booked_by']."',";
			$sqll=$sqll."booker_id='".$_POST['booker_id']."',";
			$sqll=$sqll."top_code='".$_POST['top_code']."',";
			$sqll=$sqll."business_src='".$_POST['business_src']."',";
			$sqll=$sqll."segment_code='".$_POST['segment_code']."',";
			$sqll=$sqll."purpose_visit='Null',";
			$sqll=$sqll."pay_mode='".$_POST['pay_mode']."',";
			$sqll=$sqll."remind_date='".$_POST['remind_date']."',";
			$sqll=$sqll."remarks='".$_POST['remarks']."',";
			$sqll=$sqll."added_by='".$added_by."',";
			$sqll=$sqll."added_on='".$added_on."'";
			$sqll=$sqll." where booking_no='".$_POST['bookNum']."' AND hallbook_id='".$_POST['hallbook_id'][$cc]."'";
			/*  echo $sqll; 
			die();  */
			$resultt=mysql_query($sqll);
			
			
		  }
	  }
	}
	
	 else{
		 if($_POST['book_date'][$cc]!=''){ 
			$adv="";
			$sts="";
			$sqlAR="insert into  bq_hallbooking(audit_date,book_date,booking_no,venue,session,from_time,to_time,seating,funct,expected,guaranted,hall_rate,confirm_status,fp_status,chief_guest,corporate,title,guest_name,address1,address2,city,pin, 	state,country,phone,email,comp_code,company_name,comaddress1,comaddress2,comcity,compin,comstate,comcountry,comphone,comemail,contact_person,contact_mobile,booked_by,booker_id,top_code,business_src,segment_code,purpose_visit,pay_mode,remind_date,remarks,adv,added_by,added_on)";
			$sqlAR.=" values(";
			$sqlAR.="'".$curDate."',";
			$sqlAR.="'".$_POST['book_date'][$cc]."',";
			$sqlAR.="'".$_POST['bookNum']."',";
			$sqlAR.="'".$_POST['venue'][$cc]."',";
			$sqlAR.="'".$_POST['session'][$cc]."',";
			$sqlAR.="'".$_POST['from_time'][$cc]."',";
			$sqlAR.="'".$_POST['to_time'][$cc]."',";
			$sqlAR.="'".$_POST['seating'][$cc]."',";
			$sqlAR.="'".$_POST['funct'][$cc]."',";
			$sqlAR.="'".$_POST['expected'][$cc]."',";
			$sqlAR.="'".$_POST['guaranted'][$cc]."',";
			$sqlAR.="'".$_POST['hall_rate'][$cc]."',";
			$sqlAR.="'".$_POST['confirm_status'][$cc]."',";
			$sqlAR.="'".$sts."',";
			$sqlAR.="'".$_POST['chief_guest'][$cc]."',";
			$sqlAR.="'".$_POST['corporate']."',";
			$sqlAR.="'".$_POST['title']."',";
			$sqlAR.="'".$_POST['guest_name']."',";
			$sqlAR.="'".$_POST['address1']."',";
			$sqlAR.="'".$_POST['address2']."',";
			$sqlAR.="'".$_POST['city']."',";
			$sqlAR.="'".$_POST['pin_code']."',";
			$sqlAR.="'".$_POST['state']."',";
			$sqlAR.="'".$_POST['country']."',";
			$sqlAR.="'".$_POST['phone']."',";
			$sqlAR.="'".$_POST['email']."',";
			$sqlAR.="'".$_POST['comp_code']."',";
			$sqlAR.="'".$_POST['company_name']."',";
			$sqlAR.="'".$_POST['comaddress1']."',";
			$sqlAR.="'".$_POST['comaddress2']."',";
			$sqlAR.="'".$_POST['comcity']."',";
			$sqlAR.="'".$_POST['compincode']."',";
			$sqlAR.="'".$_POST['comstate']."',";
			$sqlAR.="'".$_POST['comcountry']."',";
			$sqlAR.="'".$_POST['comphone']."',";
			$sqlAR.="'".$_POST['comemail']."',";
			$sqlAR.="'".$_POST['contact_person']."',";
			$sqlAR.="'".$_POST['contact_mobile']."',";
			$sqlAR.="'".$_POST['booked_by']."',";
			$sqlAR.="'".$_POST['booker_id']."',";
			$sqlAR.="'".$_POST['top_code']."',";
			$sqlAR.="'".$_POST['business_src']."',";
			$sqlAR.="'".$_POST['segment_code']."',";
			$sqlAR.="'Null',";
			$sqlAR.="'".$_POST['pay_mode']."',";
			$sqlAR.="'".$_POST['remind_date']."',";
			$sqlAR.="'".$_POST['remarks']."',";
			$sqlAR.="'".$adv."',";
			$sqlAR.="'".$added_by."',";
			$sqlAR.="'".$added_on."')";
			/* echo $sqlAR;
			die(); */
			$UsQueCy =mysql_query($sqlAR); 
		 } 
	} 
}
/* End Hall Booking */








if($UsQueCy){
	header('location:'.$home_path.'/transaction/frontdesk/view-hall-booking.php?msg='.$bookNum.' generated successfully!.');
}
else{
	header('location:'.$home_path.'/transaction/frontdesk/view-hall-booking.php?msg=Error in insertion');
}	
?>