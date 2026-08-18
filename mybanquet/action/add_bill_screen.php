<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$kot_itemcode=$_POST['kot_itemcode'];


$sql="insert into pos_blheader(outlet,session,covers,table_no,steward,members,disc,discamt,totqty,totalval,disamt,tottax,netamt,linktbl,bill_status,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['bill_outlet']."',";
	$sql.="'".$_POST['bill_sess']."',";
	$sql.="'".$_POST['bill_cov']."',";
	$sql.="'".$_POST['table_no']."',";
	$sql.="'".$_POST['bill_ste']."',";
	$sql.="'".$_POST['members']."',";
	$sql.="'".$_POST['disc']."',";
	$sql.="'".$_POST['disc_amount']."',";
	$sql.="'".$_POST['totqty']."',";
	$sql.="'".$_POST['totalval']."',";
	$sql.="'".$_POST['disamt']."',";
	$sql.="'".$_POST['tottax']."',";
	$sql.="'".$_POST['netamt']."',";
	$sql.="'".$_POST['linktbl']."',";
	$sql.="'1',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
 /* echo $sql;
 die(); */ 
$UsQuery =mysql_query($sql);


$kot_no=$_POST['kot_no'];

for($cc=0;$CC<count($kot_no);$cc++){
	$sql="insert into pos_bldetail(outlet,session,covers,table_no,steward,members,kot_no,item_name,item_qty,item_rate,line_tot,dis_flag,dis_amt,tax_amt,net_amt,bill_status,split,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_POST['bill_outlet']."',";
	$sql.="'".$_POST['bill_sess']."',";
	$sql.="'".$_POST['bill_cov']."',";
	$sql.="'".$_POST['table_no']."',";
	$sql.="'".$_POST['bill_ste']."',";
	$sql.="'".$_POST['members']."',";
	$sql.="'".$_POST['kot_no'][$cc]."',";
	$sql.="'".$_POST['kot_itemdesc'][$cc]."',";
	$sql.="'".$_POST['kot_itemqty'][$cc]."',";
	$sql.="'".$_POST['kotitem_rate'][$cc]."',";
	$sql.="'".$_POST['kot_itemval'][$cc]."',";
	$sql.="'".$_POST['kot_disc'][$cc]."',";
	$sql.="'".$_POST['kot_discAmt'][$cc]."',";
	$sql.="'".$_POST['kot_tax'][$cc]."',";
	$sql.="'".$_POST['kot_netamt'][$cc]."',";
	$sql.="'1',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
 echo $sql;
 die();  
$UsQuery =mysql_query($sql);
}


if($UsQuery){
header('location:'.$home_path.'/transaction/frontdesk/billing-screen.php?msg=Data saved successfully!');
}else {
header('location:'.$home_path.'/transaction/frontdesk/billing-screen.php?msg=Error in insertion');
}


?>