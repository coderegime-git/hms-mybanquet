<?php
ob_start();

include("../config.php");
include("../util.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$venu=$_GET['venu'];
$bkDt=$_GET['bkDt'];
/* $ses=$_GET['ses']; */

$bk=explode('/',$bkDt);
$bkm=@$bk[2].'-'.@$bk[1].'-'.@$bk[0];

$sqlRv=mysql_query("select * from bq_stscolor where roomoccupy_id='1'");
$rowRv=mysql_fetch_array($sqlRv); 

$output="";

$output.='<tr><td>&nbsp;</td>';
$sRe=mysql_query("select * from bq_dashhallbook where str_to_date(book_date,'%d/%m/%Y') = '$bkm' AND venue='$venu'");
if(mysql_num_rows($sRe)>0){
	while($rRe=mysql_fetch_array($sRe)){
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
			
			
		$sE6=mysql_query("select * from bq_stscolor where roomavail_define='".$t6[0]."'");
		if(mysql_num_rows($sE6)>0){
			$rE6=mysql_fetch_array($sE6);
			$clr6=$rE6['room_color'];
		}else{
			$clr6=$rowRv['room_color'];
		}
		
		
		$sE7=mysql_query("select * from bq_stscolor where roomavail_define='".$t7[0]."'");
		if(mysql_num_rows($sE7)>0){
			$rE7=mysql_fetch_array($sE7);
			$clr7=$rE7['room_color'];
		}else{
			$clr7=$rowRv['room_color'];
		}
		
		$sE8=mysql_query("select * from bq_stscolor where roomavail_define='".$t8[0]."'");
		if(mysql_num_rows($sE8)>0){
			$rE8=mysql_fetch_array($sE8);
			$clr8=$rE8['room_color'];
		}else{
			$clr8=$rowRv['room_color'];
		}
		
		$sE9=mysql_query("select * from bq_stscolor where roomavail_define='".$t9[0]."'");
		if(mysql_num_rows($sE9)>0){
			$rE9=mysql_fetch_array($sE9);
			$clr9=$rE9['room_color'];
		}else{
			$clr9=$rowRv['room_color'];
		}
		
		$sE10=mysql_query("select * from bq_stscolor where roomavail_define='".$t10[0]."'");
		if(mysql_num_rows($sE10)>0){
			$rE10=mysql_fetch_array($sE10);
			$clr10=$rE10['room_color'];
		}else{
			$clr10=$rowRv['room_color'];
		}
		
		$sE11=mysql_query("select * from bq_stscolor where roomavail_define='".$t11[0]."'");
		if(mysql_num_rows($sE11)>0){
			$rE11=mysql_fetch_array($sE11);
			$clr11=$rE11['room_color'];
		}else{
			$clr11=$rowRv['room_color'];
		}
		
		$sE12=mysql_query("select * from bq_stscolor where roomavail_define='".$t12[0]."'");
		if(mysql_num_rows($sE12)>0){
			$rE12=mysql_fetch_array($sE12);
			$clr12=$rE12['room_color'];
		}else{
			$clr12=$rowRv['room_color'];
		}
		
		$sE13=mysql_query("select * from bq_stscolor where roomavail_define='".$t13[0]."'");
		if(mysql_num_rows($sE13)>0){
			$rE13=mysql_fetch_array($sE13);
			$clr13=$rE7['room_color'];
		}else{
			$clr13=$rowRv['room_color'];
		}
		
		$sE14=mysql_query("select * from bq_stscolor where roomavail_define='".$t14[0]."'");
		if(mysql_num_rows($sE14)>0){
			$rE14=mysql_fetch_array($sE14);
			$clr14=$rE14['room_color'];
		}else{
			$clr14=$rowRv['room_color'];
		}
		
		$sE15=mysql_query("select * from bq_stscolor where roomavail_define='".$t15[0]."'");
		if(mysql_num_rows($sE15)>0){
			$rE15=mysql_fetch_array($sE15);
			$clr15=$rE15['room_color'];
		}else{
			$clr15=$rowRv['room_color'];
		}
		
		$sE16=mysql_query("select * from bq_stscolor where roomavail_define='".$t16[0]."'");
		if(mysql_num_rows($sE16)>0){
			$rE16=mysql_fetch_array($sE16);
			$clr16=$rE16['room_color'];
		}else{
			$clr16=$rowRv['room_color'];
		}
		
		$sE17=mysql_query("select * from bq_stscolor where roomavail_define='".$t17[0]."'");
		if(mysql_num_rows($sE17)>0){
			$rE17=mysql_fetch_array($sE17);
			$clr17=$rE17['room_color'];
		}else{
			$clr17=$rowRv['room_color'];
		}
		
		$sE18=mysql_query("select * from bq_stscolor where roomavail_define='".$t18[0]."'");
		if(mysql_num_rows($sE18)>0){
			$rE18=mysql_fetch_array($sE18);
			$clr18=$rE18['room_color'];
		}else{
			$clr18=$rowRv['room_color'];
		}
		
		$sE19=mysql_query("select * from bq_stscolor where roomavail_define='".$t19[0]."'");
		if(mysql_num_rows($sE19)>0){
			$rE19=mysql_fetch_array($sE7);
			$clr19=$rE19['room_color'];
		}else{
			$clr19=$rowRv['room_color'];
		}
		
		$sE20=mysql_query("select * from bq_stscolor where roomavail_define='".$t20[0]."'");
		if(mysql_num_rows($sE20)>0){
			$rE20=mysql_fetch_array($sE7);
			$clr20=$rE20['room_color'];
		}else{
			$clr20=$rowRv['room_color'];
		}
		
		$sE21=mysql_query("select * from bq_stscolor where roomavail_define='".$t21[0]."'");
		if(mysql_num_rows($sE21)>0){
			$rE21=mysql_fetch_array($sE21);
			$clr21=$rE21['room_color'];
		}else{
			$clr21=$rowRv['room_color'];
		}
		
		$sE22=mysql_query("select * from bq_stscolor where roomavail_define='".$t22[0]."'");
		if(mysql_num_rows($sE22)>0){
			$rE22=mysql_fetch_array($sE22);
			$clr22=$rE22['room_color'];
		}else{
			$clr22=$rowRv['room_color'];
		}
		
		$sE23=mysql_query("select * from bq_stscolor where roomavail_define='".$t23[0]."'");
		if(mysql_num_rows($sE23)>0){
			$rE23=mysql_fetch_array($sE23);
			$clr23=$rE23['room_color'];
		}else{
			$clr23=$rowRv['room_color'];
		}
		
		$sE24=mysql_query("select * from bq_stscolor where roomavail_define='".$t24[0]."'");
		if(mysql_num_rows($sE24)>0){
			$rE24=mysql_fetch_array($sE24);
			$clr24=$rE24['room_color'];
		}else{
			$clr24=$rowRv['room_color'];
		}
		
	 if($rRe['tme6']>0){
		$output.='<td style="text-align:center;width:52px;height:13px;background-color:#'.$clr6.';color:#fff;border:1px solid #cccccc;">&nbsp;</td>';
		}else if($rRe['tme6']==''){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
	 }
		 if($rRe['tme7']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr7.';color:#fff">&nbsp;</td>';
		 } else if($rRe['tme7']==''){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		if($rRe['tme8']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr8.';color:#fff;">&nbsp;</td>';
		 }else if($rRe['tme8']=='' ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		if($rRe['tme9']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr9.';color:#fff;">&nbsp;</td>';
		 }else if($rRe['tme9']==''){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme10']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr10.';color:#fff;">&nbsp;</td>';
		 }else if($rRe['tme10']=='' ){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		if($rRe['tme11']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr11.';color:#fff;">&nbsp;</td>';
		}else if($rRe['tme11']==''){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		if($rRe['tme12']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr12.';color:#fff;">&nbsp;</td>';
		}else if($rRe['tme12']==''){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme13']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr13.';color:#fff;">&nbsp;</td>';
		 } else if($rRe['tme13']=='' ){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme14']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr14.';color:#fff;">&nbsp;</td>';
		 }else if($rRe['tme14']==''){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme15']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr15.';color:#fff;">&nbsp;</td>';
		}else if($rRe['tme15']==''){ 
		$output.='<td style="text-align:center;width:52px;height:15px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme16']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr16.';color:#fff;">&nbsp;</td>';
		 }else if($rRe['tme16']==''){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme17']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr17.';color:#fff;">&nbsp;</td>';
		 }else if($rRe['tme17']=='' ){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme18']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr18.';color:#fff;">&nbsp;</td>';
		 } else if($rRe['tme18']=='' ){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme19']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr19.';color:#fff;">&nbsp;</td>';
		 } else if($rRe['tme19']=='' ){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 }
		 if($rRe['tme20']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr20.';color:#fff;">&nbsp;</td>';
		 } else if($rRe['tme20']=='' ){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme21']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'. $clr21.';color:#fff;">&nbsp;</td>';
		 } else if($rRe['tme21']=='' ){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme22']>0 ){
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr22.';color:#fff;">&nbsp;</td>';
		 } else if($rRe['tme22']==''){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme23']>0 ) { 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr23.';color:#fff;">&nbsp;</td>';
		 } else if($rRe['tme23']=='' ){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		 if($rRe['tme24']>0 ) { 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$clr24.';color:#fff;">&nbsp;</td>';
		 }else if($rRe['tme24']=='' ){ 
		$output.='<td style="text-align:center;width:52px;height:13px;border:1px solid #cccccc;background-color:#'.$rowRv['room_color'].'">&nbsp;</td>';
		 } 
		
	}

$output.='</tr>';
echo $output;
}else{
	echo '1';
}

?>
