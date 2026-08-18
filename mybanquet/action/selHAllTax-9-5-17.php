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
	$sql=mysql_query("select * from bq_taxstruct where str_code='$hdet' AND status='1'");
	if(mysql_num_rows($sql)>0){
		$row=mysql_fetch_array($sql);
		$factor=$row['factor'];
		$factor_value=$row['factor_value'];
		$fcVl=$factor_value+100;
		$htx=$hchg/$fcVl*100;
		echo sprintf("%01.2f",$htx);
	}
}

if(isset($no) && $no=='no'){
	$sql=mysql_query("select * from bq_taxstruct where str_code='$hdet' AND status='1'");
	if(mysql_num_rows($sql)>0){
		$row=mysql_fetch_array($sql);
		$factor=$row['factor'];
		$factor_value=$row['factor_value'];
		$fcVl=$factor_value+100;
		$htx=$hchg*$fcVl/100;
		echo sprintf("%01.2f",$htx);
	}
}

?>