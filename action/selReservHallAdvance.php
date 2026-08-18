<?php  

include("../config.php");

$hchg=$_GET['amount'];

if(isset($_GET['yes'])){
	$yes=$_GET['yes'];
}else if(isset($_GET['no'])){
	$no=$_GET['no'];
}

$rq=mysql_fetch_array(mysql_query("select adv_tax from bq_taxdetail"));
$adv_tax=$rq['adv_tax'];

if(isset($yes) && $yes=='yes'){
	$sql=mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where str_code='$adv_tax' AND status='1'");
	if(mysql_num_rows($sql)>0){
		$row=mysql_fetch_array($sql);
		$factor=$row['factor'];
		$factor_value=$row['facT'];
		$fcVl=$factor_value+100;
		$htx=$hchg/$fcVl*100;
		$tx=$hchg-$htx;
		echo sprintf("%01.2f",$htx).','.$hchg;
	}
}

if(isset($no) && $no=='no'){
	$sql=mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where str_code='$adv_tax' AND status='1'");
	if(mysql_num_rows($sql)>0){
		$row=mysql_fetch_array($sql);
		$factor=$row['factor'];
		$factor_value=$row['facT'];
		$fcVl=$factor_value+100;
		$htx=$hchg*$fcVl/100;
		echo sprintf("%01.2f",$htx);
	}
}

?>