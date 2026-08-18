<?php  

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


$itemCd=$_POST['itmnu_code'];
for($cc=0;$cc<count($itemCd);$cc++){
	$sqI=mysql_query("select * from bq_itemmaster where item_id='".$_POST['item_id'][$cc]."'");
	if(mysql_num_rows($sqI)>0){
		$sqll="UPDATE bq_itemmaster SET ";
		$sqll=$sqll."item_code='".$_POST['item_code']."',";
		$sqll=$sqll."item_name='".$_POST['item_name']."',";
		$sqll=$sqll."menu_type='".$_POST['menu_type']."',";
		$sqll=$sqll."itmsub_cat='".$_POST['itmsub_cat']."',";
		$sqll=$sqll."itmsubmnu_code='".$_POST['itmsubmnu_code']."',";
		$sqll=$sqll."item_rate='".$_POST['item_rate']."',";
		$sqll=$sqll."tax_struc='".$_POST['tax_struc']."',";
		$sqll=$sqll."allow_disc='".$_POST['allow_disc']."',";
		$sqll=$sqll."allow_qty='".$_POST['allow_qty']."',";
		$sqll=$sqll."allwrate_chg='".$_POST['allwrate_chg']."',";
		$sqll=$sqll."itmnu_code='".$_POST['itmnu_code'][$cc]."',";
		$sqll=$sqll."itmnu_name='".$_POST['itmnu_name'][$cc]."',";
		$sqll=$sqll."mnu_sts='".$_POST['mnu_sts'][$cc]."',";
		$sqll=$sqll."status='".$_POST['status']."',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where item_code='".$_POST['item_code']."' AND item_id='".$_POST['item_id'][$cc]."'";

		$resultt=mysql_query($sqll);
	}
}	
	
	
$itemCd=$_POST['itmnu_code'];
for($cc=0;$cc<count($itemCd);$cc++){
$sqI=mysql_query("select * from bq_itemmaster where item_id='".$_POST['item_id'][$cc]."'");
	if(mysql_num_rows($sqI)==0){
		if($_POST['mnu_sts'][$cc]=='yes'){
		$sql="insert into bq_itemmaster(item_code,item_name,menu_type,itmsub_cat,itmsubmnu_code,item_rate,tax_struc,allow_disc,allow_qty,allwrate_chg,itmnu_code,itmnu_name,mnu_sts,status,added_by,added_on)";
		$sql.=" values(";
		$sql.="'".$_POST['item_code']."',";
		$sql.="'".$_POST['item_name']."',";
		$sql.="'".$_POST['menu_type']."',";
		$sql.="'".$_POST['itmsub_cat']."',";
		$sql.="'".$_POST['itmsubmnu_code']."',";
		$sql.="'".$_POST['item_rate']."',";
		$sql.="'".$_POST['tax_struc']."',";
		$sql.="'".$_POST['allow_disc']."',";
		$sql.="'".$_POST['allow_qty']."',";
		$sql.="'".$_POST['allwrate_chg']."',";
		$sql.="'".$_POST['itmnu_code'][$cc]."',";
		$sql.="'".$_POST['itmnu_name'][$cc]."',";
		$sql.="'".$_POST['mnu_sts'][$cc]."',";
		$sql.="'".$_POST['status']."',";
		$sql.="'".$added_by."',";
		$sql.="'".$added_on."')";
		/* echo $sql;
		die(); */ 	 
		$UsQuery =mysql_query($sql);
		}		
	}
}

if($resultt){
$msg='Data modified successfully!';
header('location:'.$home_path.'/masters/banquet/view_itemmaster_bqt.php?msg='.$msg);
}else{
$msg='Error in updation';
header('location:'.$home_path.'/masters/banquet/view_itemmaster_bqt.php?msg='.$msg);	
}

?>