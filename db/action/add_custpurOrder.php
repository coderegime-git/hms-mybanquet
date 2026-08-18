<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$file1 =$_FILES['add_po']['name'];
$upload1=$_SERVER['DOCUMENT_ROOT']."/myerp/library/"; 
$target_path2 = $upload1 . basename( ($_FILES['add_po']['name']));
move_uploaded_file($_FILES['add_po']['tmp_name'], $target_path2);

$clinQty=$_POST['clin_qty'];
for($cc=0;$cc<count($clinQty);$cc++)
{ 
$sql="insert into customer_purorder(	company_id,cur_date,customer_name,rfq_no,custpo_no,pr_number,nsn_no,total_qty,bal_qty,no_clin,clin_qty,clin_dest,quote_ref,special_req,inspec_place,fob,req_deldate,order_value,add_po,part_number,part_nomen,unit_issue,packing_type,heading1,detail1,table1,code1,require1,heading2,detail2,table2,code2,require2,heading3,detail3,table3,code3,require3,heading4,detail4,table4,code4,require4,heading5,detail5,table5,code5,require5,heading6,detail6,table6,code6,require6,heading7,detail7,table7,code7,require7,heading8,detail8,table8,code8,require8,heading9,detail9,table9,code9,require9,heading10,detail10,table10,code10,require10,heading11,detail11,table11,code11,require11,heading12,detail12,table12,code12,require12,heading13,detail13,table13,code13,require13,heading14,detail14,table14,code14,require14,heading15,detail15,table15,code15,require15,heading16,detail16,table16,code16,require16,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".$_POST['cur_date']."',";
	$sql.="'".$_POST['customer_name']."',";
	$sql.="'".$_POST['rfq_no']."',";
	$sql.="'".strtoupper($_POST['custpo_no']."',");
	$sql.="'".$_POST['pr_number']."',";
	$sql.="'".$_POST['nsn_no']."',";
	$sql.="'".$_POST['total_qty']."',";
	$sql.="'".$_POST['bal_qty']."',";
	$sql.="'".$_POST['no_clin']."',";
	$sql.="'".$_POST['clin_qty'][$cc]."',";
	$sql.="'".$_POST['clin_dest'][$cc]."',";
	$sql.="'".$_POST['quote_ref']."',";
	$sql.="'".$_POST['special_req']."',";
	$sql.="'".$_POST['inspec_place']."',";
	$sql.="'".$_POST['fob']."',";
	$sql.="'".$_POST['req_deldate']."',";
	$sql.="'".$_POST['order_value']."',";
	$sql.="'".$file1."',";
	$sql.="'".$_POST['part_number']."',";
	$sql.="'".$_POST['part_nomen']."',";
	$sql.="'".$_POST['unit_issue']."',";
	$sql.="'".$_POST['packing_type']."',";
	
	$sql.="'".$_POST['heading1']."',";
	$sql.="'".$_POST['detail1']."',";
	$sql.="'".$_POST['table1']."',";
	$sql.="'".strtoupper($_POST['code1'])."',";
	$sql.="'".strtoupper($_POST['require1'])."',";
	
	$sql.="'".$_POST['heading2']."',";
	$sql.="'".$_POST['detail2']."',";
	$sql.="'".$_POST['table2']."',";
	$sql.="'".strtoupper($_POST['code2'])."',";
	$sql.="'".strtoupper($_POST['require2'])."',";
	$sql.="'".$_POST['heading3']."',";
	$sql.="'".$_POST['detail3']."',";
	$sql.="'".$_POST['table3']."',";
	$sql.="'".strtoupper($_POST['code3'])."',";
	$sql.="'".strtoupper($_POST['require3'])."',";
	$sql.="'".$_POST['heading4']."',";
	$sql.="'".$_POST['detail4']."',";
	$sql.="'".$_POST['table4']."',";
	$sql.="'".strtoupper($_POST['code4'])."',";
	$sql.="'".strtoupper($_POST['require4'])."',";
	$sql.="'".$_POST['heading5']."',";
	$sql.="'".$_POST['detail5']."',";
	$sql.="'".$_POST['table5']."',";
	$sql.="'".strtoupper($_POST['code5'])."',";
	$sql.="'".strtoupper($_POST['require5'])."',";
	$sql.="'".$_POST['heading6']."',";
	$sql.="'".$_POST['detail6']."',";
	$sql.="'".$_POST['table6']."',";
	$sql.="'".strtoupper($_POST['code6'])."',";
	$sql.="'".strtoupper($_POST['require6'])."',";
	$sql.="'".$_POST['heading7']."',";
	$sql.="'".$_POST['detail7']."',";
	$sql.="'".$_POST['table7']."',";
	$sql.="'".strtoupper($_POST['code7'])."',";
	$sql.="'".strtoupper($_POST['require7'])."',";
	$sql.="'".$_POST['heading8']."',";
	$sql.="'".$_POST['detail8']."',";
	$sql.="'".$_POST['table8']."',";
	$sql.="'".strtoupper($_POST['code8'])."',";
	$sql.="'".strtoupper($_POST['require8'])."',";
	$sql.="'".$_POST['heading9']."',";
	$sql.="'".$_POST['detail9']."',";
	$sql.="'".$_POST['table9']."',";
	$sql.="'".strtoupper($_POST['code9'])."',";
	$sql.="'".strtoupper($_POST['require9'])."',";
	$sql.="'".$_POST['heading10']."',";
	$sql.="'".$_POST['detail10']."',";
	$sql.="'".$_POST['table10']."',";
	$sql.="'".strtoupper($_POST['code10'])."',";
	$sql.="'".strtoupper($_POST['require10'])."',";
	$sql.="'".$_POST['heading11']."',";
	$sql.="'".$_POST['detail11']."',";
	$sql.="'".$_POST['table11']."',";
	$sql.="'".strtoupper($_POST['code11'])."',";
	$sql.="'".strtoupper($_POST['require11'])."',";
	$sql.="'".$_POST['heading12']."',";
	$sql.="'".$_POST['detail12']."',";
	$sql.="'".$_POST['table12']."',";
	$sql.="'".strtoupper($_POST['code12'])."',";
	$sql.="'".strtoupper($_POST['require12'])."',";
	$sql.="'".$_POST['heading13']."',";
	$sql.="'".$_POST['detail13']."',";
	$sql.="'".$_POST['table13']."',";
	$sql.="'".strtoupper($_POST['code13'])."',";
	$sql.="'".strtoupper($_POST['require13'])."',";
	$sql.="'".$_POST['heading14']."',";
	$sql.="'".$_POST['detail14']."',";
	$sql.="'".$_POST['table14']."',";
	$sql.="'".strtoupper($_POST['code14'])."',";
	$sql.="'".strtoupper($_POST['require14'])."',";
	$sql.="'".$_POST['heading15']."',";
	$sql.="'".$_POST['detail15']."',";
	$sql.="'".$_POST['table15']."',";
	$sql.="'".strtoupper($_POST['code15'])."',";
	$sql.="'".strtoupper($_POST['require15'])."',";
	$sql.="'".$_POST['heading16']."',";
	$sql.="'".$_POST['detail16']."',";
	$sql.="'".$_POST['table16']."',";
	$sql.="'".strtoupper($_POST['code16'])."',";
	$sql.="'".strtoupper($_POST['require16'])."',";
	
	
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
/*  echo $sql;
	die(); */ 
	$UsQuery =mysql_query($sql);
	if($UsQuery){
		header('location:'.$home_path.'/operations/customerpo.php?msg=Data saved Successfully!');
	}
	else{
		header('location:'.$home_path.'/operations/customerpo.php?msg=Error in insertion');
	}
}

$sqlP=mysql_query("select * from partnumber where partnumber='".$_POST['part_number']."'");
if(mysql_num_rows($sqlP)==0){
	$sql="insert into partnumber(company_id,nsnnumber,partnumber,partname,added_by,added_on)";
	$sql.=" values(";
	$sql.="'".$_SESSION['companyId']."',";
	$sql.="'".strtoupper($_POST['nsn_no'])."',";
	$sql.="'".strtoupper($_POST['part_number'])."',";
	$sql.="'".strtoupper($_POST['part_nomen'])."',";
	$sql.="'".$added_by."',";
	$sql.="'".$added_on."')";
	/* echo $sql;
	die(); */ 
	$UsQuery =mysql_query($sql);
}




?>