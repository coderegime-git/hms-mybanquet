<?php  
ob_start();
session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

if($_POST['mult_contract']=='yes'){
	$conRfq=$_POST['cont_rfq'];
	for($cc=0;$cc<count($conRfq);$cc++){
		$sqll="UPDATE invoice SET ";
		$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
		$sqll=$sqll."mult_contract='".$_POST['mult_contract']."',";
		$sqll=$sqll."invoice_type='".$_POST['invoice_type']."',";
		$sqll=$sqll."invoice_date='".$_POST['invoice_date']."',";
		$sqll=$sqll."noof_rfq='".$_POST['no_rfq_no']."',";
		$sqll=$sqll."rfq_no='".$_POST['cont_rfq'][$cc]."',";
		$sqll=$sqll."clin_dest='".$_POST['clin_dest'][$cc]."',";
		$sqll=$sqll."clin_qty='".$_POST['clin_qty'][$cc]."',";
		$sqll=$sqll."bill_code='".$_POST['billto_code']."',";
		$sqll=$sqll."bill_1='".$_POST['bill_1']."',";
		$sqll=$sqll."bill_2='".$_POST['bill_2']."',";
		$sqll=$sqll."bill_3='".$_POST['bill_3']."',";
		$sqll=$sqll."bill_4='".$_POST['bill_4']."',";
		$sqll=$sqll."ship_1='".$_POST['ship_1']."',";
		$sqll=$sqll."ship_2='".$_POST['ship_2']."',";
		$sqll=$sqll."ship_3='".$_POST['ship_3']."',";
		$sqll=$sqll."ship_4='".$_POST['ship_4']."',";
		$sqll=$sqll."carrier='".$_POST['carrier']."',";
		$sqll=$sqll."awb_no='".$_POST['awb_no']."',";
		$sqll=$sqll."add_freight='".$_POST['add_freight']."',";
		$sqll=$sqll."freight_amount='".$_POST['freight_amount']."',";
		$sqll=$sqll."tax_type='".$_POST['tax_type']."',";
		$sqll=$sqll."h_tax='".$_POST['h_tax']."',";
		$sqll=$sqll."tax_rate='".$_POST['tax_rate']."',";
		$sqll=$sqll."currency='".$_POST['currency']."',";
		$sqll=$sqll."conv_rate='".$_POST['conv_rate']."',";
		$sqll=$sqll."addanot_cont='".$_POST['addanot_cont']."',";
		$sqll=$sqll."invoice_no='".$_POST['invoice_no']."',";
		$sqll=$sqll."ebsinv_no='".$_POST['ebsinv_no'][$cc]."',";
		$sqll=$sqll."contract_no='".$_POST['contract_no']."',";
		$sqll=$sqll."nsn_no='".$_POST['nsn_no']."',";
		$sqll=$sqll."part_name='".$_POST['part_name']."',";
		$sqll=$sqll."qty='".$_POST['qty']."',";
		$sqll=$sqll."unit_price='".$_POST['unit_price']."',";
		$sqll=$sqll."ui_no='".$_POST['ui_no']."',";
		$sqll=$sqll."total_itemval='".$_POST['total_itemval']."',";
		$sqll=$sqll."inv_subtotal='".$_POST['inv_subtotal']."',";
		$sqll=$sqll."invoice_total_inr='".$_POST['invoice_total_inr']."',";
		$sqll=$sqll."invoice_total_usd='".$_POST['invoice_total_usd']."',";
		$sqll=$sqll."inv_totwords='".$_POST['inv_totwords']."',";
		$sqll=$sqll."total_packages='".$_POST['total_packages']."',";
		$sqll=$sqll."rowcount='".$cc."',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where invoice_no='".$_POST['invoice_no']."' AND rowcount='".$cc."'";

	/* 	  echo $sqll; */
		/* die(); */  

		$resultt=mysql_query($sqll);


		
	}
	if($resultt){
		$msg='Data modified successfully!';
		header('location:'.$home_path.'/operations/view-invoice.php?msg='.$msg);
		}else{
		$msg='Error in updation';
		header('location:'.$home_path.'/operations/view-invoice.php?msg='.$msg);	
		} 
	/* die(); */
}



if($_POST['mult_contract']=='no'){
		$sqll="UPDATE invoice SET ";
		$sqll=$sqll."company_id='".$_SESSION['companyId']."',";
		$sqll=$sqll."mult_contract='".$_POST['mult_contract']."',";
		$sqll=$sqll."invoice_type='".$_POST['invoice_type']."',";
		$sqll=$sqll."invoice_date='".$_POST['invoice_date']."',";
		$sqll=$sqll."noof_rfq='".$_POST['no_rfq_no']."',";
		$sqll=$sqll."rfq_no='".$_POST['cont_rfqs']."',";
		$sqll=$sqll."clin_dest='".$_POST['clin_dests']."',";
		$sqll=$sqll."clin_qty='".$_POST['clin_qtys']."',";
		$sqll=$sqll."bill_code='".$_POST['billto_code']."',";
		$sqll=$sqll."bill_1='".$_POST['bill_1']."',";
		$sqll=$sqll."bill_2='".$_POST['bill_2']."',";
		$sqll=$sqll."bill_3='".$_POST['bill_3']."',";
		$sqll=$sqll."bill_4='".$_POST['bill_4']."',";
		$sqll=$sqll."ship_1='".$_POST['ship_1']."',";
		$sqll=$sqll."ship_2='".$_POST['ship_2']."',";
		$sqll=$sqll."ship_3='".$_POST['ship_3']."',";
		$sqll=$sqll."ship_4='".$_POST['ship_4']."',";
		$sqll=$sqll."carrier='".$_POST['carrier']."',";
		$sqll=$sqll."awb_no='".$_POST['awb_no']."',";
		$sqll=$sqll."add_freight='".$_POST['add_freight']."',";
		$sqll=$sqll."freight_amount='".$_POST['freight_amount']."',";
		$sqll=$sqll."tax_type='".$_POST['tax_type']."',";
		$sqll=$sqll."h_tax='".$_POST['h_tax']."',";
		$sqll=$sqll."tax_rate='".$_POST['tax_rate']."',";
		$sqll=$sqll."currency='".$_POST['currency']."',";
		$sqll=$sqll."conv_rate='".$_POST['conv_rate']."',";
		$sqll=$sqll."addanot_cont='".$_POST['addanot_cont']."',";
		$sqll=$sqll."invoice_no='".$_POST['invoice_no']."',";
		$sqll=$sqll."ebsinv_no='".$_POST['ebsinv_nos']."',";
		$sqll=$sqll."contract_no='".$_POST['contract_no']."',";
		$sqll=$sqll."nsn_no='".$_POST['nsn_no']."',";
		$sqll=$sqll."part_name='".$_POST['part_name']."',";
		$sqll=$sqll."qty='".$_POST['qty']."',";
		$sqll=$sqll."unit_price='".$_POST['unit_price']."',";
		$sqll=$sqll."ui_no='".$_POST['ui_no']."',";
		$sqll=$sqll."total_itemval='".$_POST['total_itemval']."',";
		$sqll=$sqll."inv_subtotal='".$_POST['inv_subtotal']."',";
		$sqll=$sqll."invoice_total_inr='".$_POST['invoice_total_inr']."',";
		$sqll=$sqll."invoice_total_usd='".$_POST['invoice_total_usd']."',";
		$sqll=$sqll."inv_totwords='".$_POST['inv_totwords']."',";
		$sqll=$sqll."total_packages='".$_POST['total_packages']."',";
		$sqll=$sqll."added_by='".$added_by."',";
		$sqll=$sqll."added_on='".$added_on."'";
		$sqll=$sqll." where invoice_no='".$_POST['invoice_no']."'";
		/*   echo $sqll;
		die(); */  
		$resultt=mysql_query($sqll);
		if($resultt){
		$msg='Data modified successfully!';
		header('location:'.$home_path.'/operations/view-invoice.php?msg='.$msg);
		}else{
		$msg='Error in updation';
		header('location:'.$home_path.'/operations/view-invoice.php?msg='.$msg);	
		}
}


?>