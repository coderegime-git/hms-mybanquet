<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

		
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

$item_name=$_POST['item_name'];

for($cc=0;$cc<count($item_name);$cc++){
	if($_POST['item_name']!="")	{
		$sqll="UPDATE bq_opvchrdtl SET ";
		$sqll=$sqll."split='".$_POST['split'][$cc]."',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where item_code='".$_POST['item_code'][$cc]."' AND vouchrno='".$_POST['voucher_no']."' AND bill_status!='3'";
		$resultt=mysql_query($sqll);
	}	
}



for($ce=0;$ce<count($_POST['item_code']);$ce++){
 $sqF=mysql_query("select * from bq_taxstruct where str_code='".$_POST['taxcde'][$ce]."' AND status='1'");
	while($roF=mysql_fetch_array($sqF)){
		
		$itmTot=$_POST['item_total'][$ce]-$_POST['disc_val'][$ce];
		
		$txVal=$itmTot*$roF['factor_value']/100;
	
		$rem="";
		$blN="";
		$sts="1";
		
		$sqll="UPDATE bq_opvchrtaxdtl SET ";
		$sqll=$sqll."taxableamt='".$itmTot."',";
		$sqll=$sqll."taxamt='".$txVal."'";
		$sqll=$sqll." where item_code='".$_POST['item_code'][$ce]."' AND vouchrno='".$_POST['voucher_no']."' AND taxcode='".$roF['tax_code']."' AND bill_status!='3'";
		 /* echo $sqll; */ 
		$resultt=mysql_query($sqll);
	} 
}
  /* die(); */ 


for($cf=0;$cf<count($_POST['item_code']);$cf++){
	
		$sqll="UPDATE bq_opvchrdtl SET ";
		$sqll=$sqll."discamt='".$_POST['disc_val'][$cf]."',";
		$sqll=$sqll."disccode='".$_POST['disc_perc'][$cf]."',";
		$sqll=$sqll."discperamt='".$_POST['disc_amount'][$cf]."',";
		$sqll=$sqll."tax_amt ='".$_POST['tax_amount'][$cf]."',";
		$sqll=$sqll."net_amount='".$_POST['net_amount'][$cf]."'";
		$sqll=$sqll." where item_code='".$_POST['item_code'][$cf]."' AND vouchrno='".$_POST['voucher_no']."' AND bill_status!='3'";
		/* echo $sqll; */
		$resultt=mysql_query($sqll);
}
/* die(); */

 /* die(); */
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

/* for($ic=0;$ic<count($item_name);$ic++) {
	$sqlG=mysql_query("select SUM(item_qty)*SUM(item_rate)AS totVl from bq_opvchrdtl where vouchrno='".$_POST['voucher_no']."' AND bill_status!='2' AND bill_status!='3' group by split");
	$rndOff="";
	$rowsS=mysql_fetch_array($sqlG);
				$totVlGT=$rowsS['totVl']; 
					
	$sqSt=mysql_query("select * from savesplit_temp where reg_num='".$rmYRr[$ic]."'");
	if(mysql_num_rows($sqSt)>0){
	while($sqSt=mysql_fetch_array($sqSt)) {
		$split=""; $status="3";
		$sqslT="UPDATE savesplit_temp SET ";
		$sqslT=$sqslT."split_temp='".$split."',";
		$sqslT=$sqslT."status='".$status."'";
		$sqslT=$sqslT." where reg_num='".$rmYRr[$ic]."'";
		$rtt=mysql_query($sqslT);
		
		$sqSt=mysql_query("delete from savesplit_temp where reg_num='".$rmYRr[$ic]."'");
		$rtt=mysql_query($sqSt);
	}
	}
	
	
			
} */ 

if($resultt){
	header('location:'.$home_path.'/transaction/frontdesk/bqt_billing.php?vucNo='.$_POST['voucher_no']);
}else{
	header('location:'.$home_path.'/transaction/frontdesk/bqt_billing.php?msg=Error in insertion');
}

?>