<?php
ob_start();
session_start();
include("config.php");
$added_on=date('Y-m-d H:i:s');

$sql=mysql_query("select * from mybanquet.bq_opbillhdr");
while($rowR=mysql_fetch_array($sql)){
	
$sUp="UPDATE mybanquet.bq_opbillhdtl SET ";
$sUp=$sUp."bkno='".$rowR['bkno']."',";
$sUp=$sUp."venue='".$rowR['venue']."',";
$sUp=$sUp."session='".$rowR['session']."',";
$sUp=$sUp."funct='".$rowR['funct']."'";
$sUp=$sUp." where bill_no='".$rowR['bill_no']."'";
$Ud =mysql_query($sUp); 
 

}

/* $sql=mysql_query("select * from mybanquet.bq_hallbooking");
while($rowR=mysql_fetch_array($sql)){
	
$sUp="UPDATE mybanquet.bq_opbillhdr SET ";
$sUp=$sUp."funct='".$rowR['funct']."'";
$sUp=$sUp." where bkno='".$rowR['booking_no']."'";
$Ud =mysql_query($sUp); 
 

}  */


/* $added_by=$_SESSION['user']; */


/* $sql=mysql_query("select * from mybanquet.bq_opbillhdr where bill_status='3'");
while($rowR=mysql_fetch_array($sql)){
	
$sUp="UPDATE mybanquet.bq_opbillstldtl SET ";
$sUp=$sUp."settleflag='".$rowR['bill_status']."'";
$sUp=$sUp." where bill_no='".$rowR['bill_no']."'";
$Ud =mysql_query($sUp); 
 

} */ 
/* die(); */

/* echo "select SUM(item_total)-SUM(discamt)AS ttAmt from mybanquet.bq_opbillhdtl where str_to_date(bill_date,'%d/%m/%Y') >= '2017-07-01' AND str_to_date(bill_date,'%d/%m/%Y') <= '2017-12-31' AND grpcode!='liq' AND bill_status!='3' group by bill_no ";
die(); */


/* $sql=mysql_query("select SUM(item_total)-SUM(discamt)AS ttAmt,bill_no from mybanquet.bq_opbillhdtl where str_to_date(bill_date,'%d/%m/%Y') >= '2017-07-01' AND str_to_date(bill_date,'%d/%m/%Y') <= '2017-12-31' AND grpcode!='liq' AND bill_status!='3' group by bill_no ");
while($row=mysql_fetch_array($sql)) {
	
	$sUp="UPDATE bq_opbillhdr SET ";
	$sUp=$sUp."taxableamt='".$row['ttAmt']."'";
	$sUp=$sUp." where bill_no='".$row['bill_no']."'";
	$Ud =mysql_query($sUp); 
	
} */ 


/* $sql=mysql_query("select * from mybanquet.bq_opbillstldtl where settleflag!='3' AND company>0 group by bill_no order by str_to_date(bill_date,'%d/%m/%Y') ASC");  */
/* echo "select * from mybanquet.bq_opbillstldtl where settleflag!='3' AND  str_to_date(bill_date,'%d/%m/%Y') = '2017-01-05' AND company>0 group by bill_no order by str_to_date(bill_date,'%d/%m/%Y') ASC";
die(); */

/*  $sql=mysql_query("select * from mybanquet.bq_opbillstldtl where settleflag!='3' AND  str_to_date(bill_date,'%d/%m/%Y') = '2017-05-01' AND company>0 group by bill_no order by str_to_date(bill_date,'%d/%m/%Y') ASC");  */

 /* $sql=mysql_query("select * from mybanquet.bq_opbillstldtl where settleflag!='3' AND company>0 group by bill_no order by str_to_date(bill_date,'%d/%m/%Y') ASC"); 

	$x=0;$debt=0;$crdt=0;$taxAmt=0;$cashh=0;$sgst=0;$cgst=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {

$sqlC=mysql_query("select * from company_master where comp_name='".$row['compname']."'");
$rowC=mysql_fetch_array($sqlC);

$sqC=mysql_query("select * from mybanquet.bq_opbillhdr where bill_no='".$row['bill_no']."'");
$roC=mysql_fetch_array($sqC);

$blk="";	
$sqlCy="insert into ar_bills(	bill_date,bill_no,room_no,reg_num,guest_name,module,comp_code,comp_name,bill_amount,arreceipt_no,cash,card,cheque,neft,commission,disc,balance,adjusted_on,adjusted_by,remarks,status,added_by,added_on)";
		$sqlCy.=" values(";
		$sqlCy.="'".$row['bill_date']."',";
		$sqlCy.="'".$row['bill_no']."',";
		$sqlCy.="'bqt',";
		$sqlCy.="'bqt',";
		$sqlCy.="'".$roC['fname']."',";
		$sqlCy.="'bqt',";
		$sqlCy.="'".$row['compcode']."',";
		$sqlCy.="'".$row['compname']."',";
		$sqlCy.="'".$row['billamt']."',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'".$row['company']."',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'Null',";
		$sqlCy.="'1',";
		$sqlCy.="'".$added_by."',";
		$sqlCy.="'".$added_on."')";
		$UsQueCy =mysql_query($sqlCy);
	}
} */




/* $sql=mysql_query("select * from bq_hallbooking where confirm_status='2'");
while($rowR=mysql_fetch_array($sql)){
	
$sUp="UPDATE bq_opbillhdr SET ";
$sUp=$sUp."venue='".$rowR['venue']."',";
$sUp=$sUp."session='".$rowR['session']."'";
$sUp=$sUp." where bkno='".$rowR['booking_no']."'";
$Ud =mysql_query($sUp); 
 

} 






$sqFb=mysql_query("select * from bq_opbillhdr where bill_status!='3'");
while($rmFb=mysql_fetch_array($sqFb)){
	
$sqb=mysql_fetch_array(mysql_query("select hallbook_id,bkno from bq_opfpmenuhdr where fpno='".$rmFb['fpno']."'"));
	
	$sqlLk="UPDATE bq_hallresvadv SET ";
	$sqlLk=$sqlLk."status='2'";
	$sqlLk=$sqlLk." where hallbook_id='".$sqb['hallbook_id']."' AND booking_no='".$sqb['bkno']."' AND status='1'" ;
	$UsQLk =mysql_query($sqlLk);
} */




?>