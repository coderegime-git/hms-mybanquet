<?php
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];


if($_POST['mult_contract']=='yes'){
	$conRfq=$_POST['cont_rfq'];
	for($cc=0;$cc<count($conRfq);$cc++){
	$sql="insert into invoice(company_id,mult_contract,invoice_type,invoice_date,noof_rfq,rfq_no,clin_dest,clin_qty,bill_code,bill_1,bill_2,bill_3,bill_4,ship_1,ship_2,ship_3,ship_4,carrier,awb_no,add_freight,freight_amount,tax_type,h_tax,tax_rate,currency,conv_rate,addanot_cont,invoice_no,ebsinv_no,contract_no,nsn_no,part_name,qty,unit_price,ui_no,total_itemval,inv_subtotal,invoice_total_inr,invoice_total_usd,inv_totwords,total_packages,rowcount,added_by,added_on)";
		$sql.=" values(";
		$sql.="'".$_SESSION['companyId']."',";
		$sql.="'".$_POST['mult_contract']."',";
		$sql.="'".$_POST['invoice_type']."',";
		$sql.="'".$_POST['invoice_date']."',";
		$sql.="'".$_POST['no_rfq_no']."',";
		$sql.="'".$_POST['cont_rfq'][$cc]."',";
		$sql.="'".$_POST['clin_dest'][$cc]."',";
		$sql.="'".$_POST['clin_qty'][$cc]."',";
		$sql.="'".$_POST['billto_code']."',";
		$sql.="'".$_POST['bill_1']."',";
		$sql.="'".$_POST['bill_2']."',";
		$sql.="'".$_POST['bill_3']."',";
		$sql.="'".$_POST['bill_4']."',";
		$sql.="'".$_POST['ship_1']."',";
		$sql.="'".$_POST['ship_2']."',";
		$sql.="'".$_POST['ship_3']."',";
		$sql.="'".$_POST['ship_4']."',";
		$sql.="'".$_POST['carrier']."',";
		$sql.="'".$_POST['awb_no']."',";
		$sql.="'".$_POST['add_freight']."',";
		$sql.="'".$_POST['freight_amount']."',";
		$sql.="'".$_POST['tax_type']."',";
		$sql.="'".$_POST['h_tax']."',";
		$sql.="'".$_POST['tax_rate']."',";
		$sql.="'".$_POST['currency']."',";
		$sql.="'".$_POST['conv_rate']."',";
		$sql.="'".$_POST['addanot_cont']."',";
		$sql.="'".$_POST['invoice_no']."',";
		$sql.="'".$_POST['ebsinv_no'][$cc]."',";
		$sql.="'".$_POST['contract_no']."',";
		$sql.="'".$_POST['nsn_no']."',";
		$sql.="'".$_POST['part_name']."',";
		$sql.="'".$_POST['qty']."',";
		$sql.="'".$_POST['unit_price']."',";
		$sql.="'".$_POST['ui_no']."',";
		$sql.="'".$_POST['total_itemval']."',";
		$sql.="'".$_POST['inv_subtotal']."',";
		$sql.="'".$_POST['invoice_total_inr']."',";
		$sql.="'".$_POST['invoice_total_usd']."',";
		$sql.="'".$_POST['inv_totwords']."',";
		$sql.="'".$_POST['total_packages']."',";
		$sql.="'".$cc."',";
		$sql.="'".$added_by."',";
		$sql.="'".$added_on."')";
		/* echo $sql;
		die();  */  
		$UsQuery =mysql_query($sql);
		if($UsQuery){
			header('location:'.$home_path.'/operations/invoicepage.php?msg=Data saved Successfully!');
		}
		else{
			header('location:'.$home_path.'/operations/invoicepage.php?msg=Error in insertion');
		}
	}
}




if($_POST['mult_contract']=='no'){
	$conRfq=$_POST['cont_rfq'];
	$sql="insert into invoice(company_id,mult_contract,invoice_type,invoice_date,noof_rfq,rfq_no,clin_dest,clin_qty,bill_code,bill_1,bill_2,bill_3,bill_4,ship_1,ship_2,ship_3,ship_4,carrier,awb_no,add_freight,freight_amount,tax_type,h_tax,tax_rate,currency,conv_rate,addanot_cont,invoice_no,ebsinv_no,contract_no,nsn_no,part_name,qty,unit_price,ui_no,total_itemval,inv_subtotal,invoice_total_inr,invoice_total_usd,inv_totwords,total_packages,rowcount,added_by,added_on)";
		$sql.=" values(";
		$sql.="'".$_SESSION['companyId']."',";
		$sql.="'".$_POST['mult_contract']."',";
		$sql.="'".$_POST['invoice_type']."',";
		$sql.="'".$_POST['invoice_date']."',";
		$sql.="'".$_POST['no_rfq_no']."',";
		$sql.="'".$_POST['cont_rfqs']."',";
		$sql.="'".$_POST['clin_dests']."',";
		$sql.="'".$_POST['clin_qtys']."',";
		$sql.="'".$_POST['billto_code']."',";
		$sql.="'".$_POST['bill_1']."',";
		$sql.="'".$_POST['bill_2']."',";
		$sql.="'".$_POST['bill_3']."',";
		$sql.="'".$_POST['bill_4']."',";
		$sql.="'".$_POST['ship_1']."',";
		$sql.="'".$_POST['ship_2']."',";
		$sql.="'".$_POST['ship_3']."',";
		$sql.="'".$_POST['ship_4']."',";
		$sql.="'".$_POST['carrier']."',";
		$sql.="'".$_POST['awb_no']."',";
		$sql.="'".$_POST['add_freight']."',";
		$sql.="'".$_POST['freight_amount']."',";
		$sql.="'".$_POST['tax_type']."',";
		$sql.="'".$_POST['h_tax']."',";
		$sql.="'".$_POST['tax_rate']."',";
		$sql.="'".$_POST['currency']."',";
		$sql.="'".$_POST['conv_rate']."',";
		$sql.="'".$_POST['addanot_cont']."',";
		$sql.="'".$_POST['invoice_no']."',";
		$sql.="'".$_POST['ebsinv_nos']."',";
		$sql.="'".$_POST['contract_no']."',";
		$sql.="'".$_POST['nsn_no']."',";
		$sql.="'".$_POST['part_name']."',";
		$sql.="'".$_POST['qty']."',";
		$sql.="'".$_POST['unit_price']."',";
		$sql.="'".$_POST['ui_no']."',";
		$sql.="'".$_POST['total_itemval']."',";
		$sql.="'".$_POST['inv_subtotal']."',";
		$sql.="'".$_POST['invoice_total_inr']."',";
		$sql.="'".$_POST['invoice_total_usd']."',";
		$sql.="'".$_POST['inv_totwords']."',";
		$sql.="'".$_POST['total_packages']."',";
		$sql.="'1',";
		$sql.="'".$added_by."',";
		$sql.="'".$added_on."')";
		/* echo $sql;
		die();  */  
		$UsQuery =mysql_query($sql);
		if($UsQuery){
			header('location:'.$home_path.'/operations/invoicepage.php?msg=Data saved Successfully!');
		}
		else{
			header('location:'.$home_path.'/operations/invoicepage.php?msg=Error in insertion');
		}
}
?>