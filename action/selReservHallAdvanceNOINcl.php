<?php  

include("../config.php");

$hchg=$_GET['amount'];

$rq=mysql_fetch_array(mysql_query("select adv_tax from bq_taxdetail"));
$adv_tax=$rq['adv_tax'];

	$sql=mysql_query("select SUM(factor_value)AS facT,factor from bq_taxstruct where str_code='$adv_tax' AND status='1'");
	if(mysql_num_rows($sql)>0){
		$row=mysql_fetch_array($sql);
		$factor=$row['factor'];
		$factor_value=$row['facT'];
		$fcVl=$factor_value+100;
		$hchgt=$hchg/$fcVl*100;
		$htx=$hchg*$factor_value/$fcVl;
		//echo $factor;
		$totChr=$htx+$hchgt;
		$slGnr=mysql_query("SELECT count(*) as cnt FROM `hms_parameters` WHERE description = 'Enable Advance tax' and status='1' and module_name='Banquets'");
$rwGnr=mysql_fetch_array($slGnr);
if($rwGnr['cnt'] == '1'){
		echo sprintf("%01.2f",$htx).','.$totChr;
}else{
	    echo sprintf("%01.2f","0.00").','.$totChr;
}
	}



?>