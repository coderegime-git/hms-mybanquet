<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

/* echo "rterer".$_POST['nsn_no'];
die(); */


$file1 =$_FILES['add_po']['name'];
$upload1=$_SERVER['DOCUMENT_ROOT']."/myerp/library/"; 
$target_path2 = $upload1 . basename( ($_FILES['add_po']['name']));
move_uploaded_file($_FILES['add_po']['tmp_name'], $target_path2);

$clinQty=$_POST['clin_qty'];
for($cc=0;$cc<count($clinQty);$cc++)
{ 
$sqll="UPDATE customer_purorder SET ";
$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
$sqll=$sqll."cur_date='".$_POST['cur_date']."',";
$sqll=$sqll."customer_name='".$_POST['customer_name']."',";
$sqll=$sqll."rfq_no='".$_POST['rfq_no']."',";
$sqll=$sqll."custpo_no='".strtoupper($_POST['custpo_no'])."',";
$sqll=$sqll."pr_number='".$_POST['pr_number']."',";
$sqll=$sqll."nsn_no='".$_POST['nsn_no']."',";
$sqll=$sqll."total_qty='".$_POST['total_qty']."',";
$sqll=$sqll."bal_qty='".$_POST['bal_qty']."',";
$sqll=$sqll."no_clin='".$_POST['no_clin']."',";
$sqll=$sqll."clin_qty='".$_POST['clin_qty'][$cc]."',";
$sqll=$sqll."clin_dest='".$_POST['clin_dest'][$cc]."',";
$sqll=$sqll."quote_ref='".$_POST['quote_ref']."',";
$sqll=$sqll."special_req='".$_POST['special_req']."',";
$sqll=$sqll."inspec_place='".$_POST['inspec_place']."',";
$sqll=$sqll."fob='".$_POST['fob']."',";
$sqll=$sqll."req_deldate='".$_POST['req_deldate']."',";
$sqll=$sqll."order_value='".$_POST['order_value']."',";
$sqll=$sqll."add_po='".$file1."',";
$sqll=$sqll."part_number='".$_POST['part_number']."',";
$sqll=$sqll."part_nomen='".$_POST['part_nomen']."',";
$sqll=$sqll."unit_issue='".$_POST['unit_issue']."',";
$sqll=$sqll."packing_type='".$_POST['packing_type']."',";
$sqll=$sqll."heading1='".$_POST['heading1']."',";
$sqll=$sqll."detail1='".$_POST['detail1']."',";
$sqll=$sqll."table1='".$_POST['table1']."',";
$sqll=$sqll."code1='".$_POST['code1']."',";
$sqll=$sqll."require1='".$_POST['require1']."',";
$sqll=$sqll."heading2='".$_POST['heading2']."',";
$sqll=$sqll."detail2='".$_POST['detail2']."',";
$sqll=$sqll."table2='".$_POST['table2']."',";
$sqll=$sqll."code2='".$_POST['code2']."',";
$sqll=$sqll."require2='".$_POST['require2']."',";
$sqll=$sqll."heading3='".$_POST['heading3']."',";
$sqll=$sqll."detail3='".$_POST['detail3']."',";
$sqll=$sqll."table3='".$_POST['table3']."',";
$sqll=$sqll."code3='".$_POST['code3']."',";
$sqll=$sqll."require3='".$_POST['require3']."',";
$sqll=$sqll."heading4='".$_POST['heading4']."',";
$sqll=$sqll."detail4='".$_POST['detail4']."',";
$sqll=$sqll."table4='".$_POST['table4']."',";
$sqll=$sqll."code4='".$_POST['code4']."',";
$sqll=$sqll."require4='".$_POST['require4']."',";
$sqll=$sqll."heading5='".$_POST['heading5']."',";
$sqll=$sqll."detail5='".$_POST['detail5']."',";
$sqll=$sqll."table5='".$_POST['table5']."',";
$sqll=$sqll."code5='".$_POST['code5']."',";
$sqll=$sqll."require5='".$_POST['require5']."',";
$sqll=$sqll."heading6='".$_POST['heading6']."',";
$sqll=$sqll."detail6='".$_POST['detail6']."',";
$sqll=$sqll."table6='".$_POST['table6']."',";
$sqll=$sqll."code6='".$_POST['code6']."',";
$sqll=$sqll."require6='".$_POST['require6']."',";
$sqll=$sqll."heading7='".$_POST['heading7']."',";
$sqll=$sqll."detail7='".$_POST['detail7']."',";
$sqll=$sqll."table7='".$_POST['table7']."',";
$sqll=$sqll."code7='".$_POST['code7']."',";
$sqll=$sqll."require7='".$_POST['require7']."',";
$sqll=$sqll."heading8='".$_POST['heading8']."',";
$sqll=$sqll."detail8='".$_POST['detail8']."',";
$sqll=$sqll."table8='".$_POST['table8']."',";
$sqll=$sqll."code8='".$_POST['code8']."',";
$sqll=$sqll."require8='".$_POST['require8']."',";
$sqll=$sqll."heading9='".$_POST['heading9']."',";
$sqll=$sqll."detail9='".$_POST['detail9']."',";
$sqll=$sqll."table9='".$_POST['table9']."',";
$sqll=$sqll."code9='".$_POST['code9']."',";
$sqll=$sqll."require9='".$_POST['require9']."',";
$sqll=$sqll."heading10='".$_POST['heading10']."',";
$sqll=$sqll."detail10='".$_POST['detail10']."',";
$sqll=$sqll."table10='".$_POST['table10']."',";
$sqll=$sqll."code10='".$_POST['code10']."',";
$sqll=$sqll."require10='".$_POST['require10']."',";
$sqll=$sqll."heading11='".$_POST['heading11']."',";
$sqll=$sqll."detail11='".$_POST['detail11']."',";
$sqll=$sqll."table11='".$_POST['table11']."',";
$sqll=$sqll."code11='".$_POST['code11']."',";
$sqll=$sqll."require11='".$_POST['require11']."',";
$sqll=$sqll."heading12='".$_POST['heading12']."',";
$sqll=$sqll."detail12='".$_POST['detail12']."',";
$sqll=$sqll."table12='".$_POST['table12']."',";
$sqll=$sqll."code12='".$_POST['code12']."',";
$sqll=$sqll."require12='".$_POST['require12']."',";
$sqll=$sqll."heading13='".$_POST['heading13']."',";
$sqll=$sqll."detail13='".$_POST['detail13']."',";
$sqll=$sqll."table13='".$_POST['table13']."',";
$sqll=$sqll."code13='".$_POST['code13']."',";
$sqll=$sqll."require13='".$_POST['require13']."',";
$sqll=$sqll."heading14='".$_POST['heading14']."',";
$sqll=$sqll."detail14='".$_POST['detail14']."',";
$sqll=$sqll."table14='".$_POST['table14']."',";
$sqll=$sqll."code14='".$_POST['code14']."',";
$sqll=$sqll."require14='".$_POST['require14']."',";
$sqll=$sqll."heading15='".$_POST['heading15']."',";
$sqll=$sqll."detail15='".$_POST['detail15']."',";
$sqll=$sqll."table15='".$_POST['table15']."',";
$sqll=$sqll."code15='".$_POST['code15']."',";
$sqll=$sqll."require15='".$_POST['require15']."',";
$sqll=$sqll."heading16='".$_POST['heading16']."',";
$sqll=$sqll."detail16='".$_POST['detail16']."',";
$sqll=$sqll."table16='".$_POST['table16']."',";
$sqll=$sqll."code16='".$_POST['code16']."',";
$sqll=$sqll."require16='".$_POST['require16']."',";


$sqll=$sqll."added_by='".$added_by."',";
$sqll=$sqll."added_on='".$added_on."'";
$sqll=$sqll." where custpo_id='".$_POST['custpo_id']."'";

/*     echo $sqll;
die();  */

$resultt=mysql_query($sqll);

	if($resultt){
	$msg='Data modified successfully!';
	header('location:'.$home_path.'/operations/view-custpurcOrder.php?msg='.$msg);
	}else{
	$msg='Error in updation';
	header('location:'.$home_path.'/operations/view-custpurcOrder.php?msg='.$msg);	
	}
}


$sqlP=mysql_query("select * from partnumber where partnumber='".$_POST['part_number']."'");
if(mysql_num_rows($sqlP)>0){
	$sqll="UPDATE partnumber SET ";
	$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
	/* $sqll=$sqll."nsnnumber='".strtoupper($_POST['nsn_no'])."',"; */
	$sqll=$sqll."partnumber='".strtoupper($_POST['part_number'])."',";
	$sqll=$sqll."partname='".strtoupper($_POST['part_nomen'])."',";
	$sqll=$sqll."added_by='".$added_by."',";
	$sqll=$sqll."added_on='".$added_on."'";
	$sqll=$sqll." where nsnnumber='".$_POST['nsn_no']."'";
 
	$resultt=mysql_query($sqll);
}
?>