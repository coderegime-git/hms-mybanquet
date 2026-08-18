<?php  

include("../config.php");

$hdet=$_GET['hdet'];
$hchg=$_GET['hchg'];

if(isset($_GET['yes'])){
	$yes=$_GET['yes'];
}else if(isset($_GET['no'])){
	$no=$_GET['no'];
}


if(isset($yes) && $yes=='yes'){
	$sql=mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where str_code='$hdet' AND status='1'");
	if(mysql_num_rows($sql)>0){
		$row=mysql_fetch_array($sql);
		$factor=$row['factor'];
		$factor_value=$row['facT'];
		$fcVl=$factor_value+100;
		$htx=$hchg/$fcVl*100;
		echo sprintf("%01.3f",$htx).','.$hchg;
	}
}

if(isset($no) && $no=='no'){
	$sql=mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where str_code='$hdet' AND status='1'");
	if(mysql_num_rows($sql)>0){
		$row=mysql_fetch_array($sql);
		$factor=$row['factor'];
		$factor_value=$row['facT'];
		$fcVl=$factor_value+100;
		$htx=$hchg*$fcVl/100;
		echo sprintf("%01.3f",$htx);
	}
}

?>