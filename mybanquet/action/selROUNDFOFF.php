<?php  

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$vucNo=$_GET['vucNo'];

$sptNo=$_GET['sptNo'];
$spltNo=trim($sptNo, ',');
$splitNo=explode(',',$spltNo);

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

for($ic=0;$ic<count($splitNo);$ic++) {
	$sqlG=mysql_query("select * from bq_opvchrdtl where vouchrno='".$_GET['vucNo']."' AND bill_status='1' AND split='".$splitNo[$ic]."'");
	$rndOff="";$ttTx=0;$linett=0;
	while($rowsS=mysql_fetch_array($sqlG)) {
		$sqTx=mysql_query("select * from bq_opvchrtaxdtl where vouchrno='".$_GET['vucNo']."' AND item_code='".$rowsS['item_code']."' AND bill_status='1'");
		while($roTx=mysql_fetch_array($sqTx)){
			$ttTx+=$roTx['taxamt'];
		}
		
		$sqt=mysql_query("select * from bq_opvchrdtl where vouchrno='".$_GET['vucNo']."' AND item_code='".$rowsS['item_code']."' AND bill_status='1'");
		while($rot=mysql_fetch_array($sqt)){
			$linett+=$rot['line_total'];
		}
	}
}

		$balaAmt=sprintf("%01.2f", $linett+$ttTx);
		$sqlP=mysql_query("select grace_time,rnd_value,round_off from property_definition");
		$rowp=mysql_fetch_array($sqlP);
		$graTime=$rowp['grace_time'];
		$rndVal=$rowp['rnd_value'];
		$round_off=$rowp['round_off'];

		$baAt=fmod($balaAmt, 1);
		$rmAmt=($rndVal-sprintf("%01.2f",$baAt));
		$remAMt=floatval($balaAmt)+floatval($rmAmt);
		
		if($round_off=='higher' && $baAt>=0.5) 
		{ 
			$rmAmtRd=$rmAmt;
			$remAMtT=floatval($balaAmt)+floatval($rmAmt);
		}else if($round_off=='higher' && $baAt<=0.5) { 
			$rmAmtRd=$rmAmt;
			$remAMtT=floatval($balaAmt)+floatval($rmAmt);
		}else if($round_off=='nearer' && $baAt>=0.5) { 
			$rmAmtRd=$rmAmt;
			$remAMtT=floatval($balaAmt)+floatval($rmAmt);
		}else if($round_off=='nearer' && $baAt<0.5){
			$rmAmtRd=$baAt;
			$remAMtT=round($balaAmt);
		}else{
			$rmAmtRd="";
		}



$srn=mysql_query("select * from bq_opvchrdtl where item_code='RND'");
if(mysql_num_rows($srn)==0) {
$rwn=mysql_fetch_array($srn);
$iteCdeRnd=$rwn['item_code'];
		
if($rmAmtRd>0 && $iteCdeRnd=='RND') {	
$crdt="";
$sts="1";
	$sqlLD=mysql_query("select * from ledgers where ledger_code='RND'");
	$rowLD=mysql_fetch_array($sqlLD);
$refno='';	
	
$sql="insert into bq_opvchrdtl(vouchrno,refno,item_code,item_name,item_qty,item_rate,line_total,discamt,disccode, 	taxstruccode,subcatcode,catcode,grpcode,billno,split_temp,split,bill_status,added_by,added_on)";
	 $sql.=" values(";
	 $sql.="'".$vucNo."',";
	 $sql.="'".$refno."',";
	 $sql.="'".$rowLD['ledger_code']."',";
	 $sql.="'".$rowLD['description']."',";
	 $sql.="'1',";
	 $sql.="'".sprintf("%01.2f",$rmAmtRd)."',";
	 $sql.="'".sprintf("%01.2f",$rmAmtRd)."',";
	 $sql.="'Null',";
	 $sql.="'Null',";
	 $sql.="'Null',";
	 $sql.="'Null',";
	 $sql.="'Null',";
	 $sql.="'Null',";
	 $sql.="'Null',";
	 $sql.="'Null',";
	 $sql.="'1',";
	 $sql.="'".$sts."',";
	 $sql.="'".$added_by."',";
	 $sql.="'".$added_on."')";
	 mysql_query($sql);
}
}










