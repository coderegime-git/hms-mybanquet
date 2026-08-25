 <?php
	$var=explode('?',$_SERVER['REQUEST_URI']);
	$page=preg_replace('/.*\/([^\/])/','$1',$var[0]);
	unset($var);
	$menuVals =explode(',',$_SESSION['menuOption']);
$ad="";$ms="";$qt="";
if($page=='user-master.php' || $page=='Update-user-master.php' || $page=='access-rights.php' || $page=='update-access-rights.php' || $page=='change-password.php' || $page=='update-password.php' || $page=='view-user-master.php') 
	{
		$ad = 'active';
		$ms = ''; 
		$qt = ''; 
	}
	else if($page=='property-master.php' || $page=='update-prop-master.php' || $page=='view-property-master.php' || $page=='vendor-master.php' || $page=='update-vendor-master.php' || $page=='unitofissue.php' || $page=='property-definition.php' || $page=='view-prop-definit.php' || $page=='edit_propdef.php' || $page=='business-source.php' || $page=='view_business_source.php' || $page=='edit_businesssource.php' || $page=='company_master.php' || $page=='view_company_master.php' || $page=='edit_company_master.php'){
		$ad = '';
		$ms = 'active'; 
		$qt = ''; 
	}else if($page=='quotation.php'){
		$ad = '';
		$ms = ''; 
		$qt = 'active'; 
	}
	
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$CurDt=date("d/m/Y");
$dt=$adtCurDt;
$dte=explode('/',$dt);
$dtea=$dte[1].'/'.$dte[2];

$fromdate1=$dte[2].'/'.$dte[1].'/'.$dte[0];
$fromdate=$dte[0].'/'.$dte[1].'/'.$dte[2];


?>
 <style>
 .menu li a{
	 /* color:#000; */
 }
 </style>
 
  <link rel="stylesheet" href="<?php echo $home_path; ?>/flat-menu/styles.css">
  <script src="<?php echo $home_path; ?>/flat-menu/script.js"></script>
   <div class="menu-container">
        <div class="menu">
            <ul>
                <li class='<?php echo $hm; ?> '><a href='<?php echo $home_path; ?>/dashboard.php?fromdate=<?php echo $CurDt;?>&todate=<?php echo $CurDt;?>' >Home</a></li>
                <li class='<?php echo $ms; ?> has-sub'><a href='#'>Masters</a>
                    <ul>
                        <li><a href="#">Property</a>
                            <ul>
                                
            <?php if(in_array('bq_def',$menuVals) || $_SESSION['user'] == 'admin') { ?>
             <li><a href='#' style="cursor:pointer;" ><span>Property Definition</span></a></li>
			<?php  }  ?>
			<?php if(in_array('bq_ma',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_market_segment.php' ><span>Market Segment</span></a></li>
			   <?php } ?>
			    <?php if(in_array('bq_bs',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_business_source.php' ><span>Bussines Source</span></a></li>
			   <?php } ?>
			   <?php if(in_array('bq_dp',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_department_bqt.php' ><span>Departments</span></a></li>
			   <?php } ?>
			   <?php /* if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { */ ?>
          <!-- <li class='last'><a href='<?php /* echo $home_path; */ ?>/masters/banquet/company_master_bqt.php' ><span>Company Master</span></a></li>-->
			   <?php /* } */ ?>
			   <?php if(in_array('bq_pd',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_paymode.php' ><span>Paymode</span></a></li>
			   <?php } ?>
			 
			   <?php if(in_array('bq_bl',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_bill_inst.php' ><span>Billing Instruction</span></a></li>
			   <?php } ?>
			   <?php if(in_array('bq_fn',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_func_mast.php' ><span>Function Master</span></a></li>
			   <?php } ?>
			  
                            </ul>
                        </li>
                        <li><a href="#">Session</a>
                            <ul>
                                 
			    
			    			   
			   <?php if(in_array('bq_ss',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_session_master.php' ><span>Session Master</span></a></li>
			   <?php } ?>
			    <?php if(in_array('bq_lm',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_location.php' ><span>Location Master</span></a></li>
			   <?php } ?>
			   <?php if(in_array('bq_sm',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_seating.php' ><span>Seating Master</span></a></li>
			   <?php } ?>
			    <?php if(in_array('bq_vm',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_venue_master.php' ><span>Venue Master</span></a></li>
			   <?php } ?>
			    <?php if(in_array('bq_bk',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_bank_name.php' ><span>Bank Master</span></a></li>
			   <?php } ?>
			    <?php if(in_array('bq_cp',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/common_parameters_bqt.php' ><span>Common Parameters</span></a></li>
			   <?php } ?>
			   <?php if(in_array('bq_pr',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_paymode_restriction.php' ><span>Paymode Restriction</span></a></li>
			   <?php } ?>
                            </ul>
                        </li>
                        <li><a href="#">Menu</a>
                            <ul>
                  <?php if(in_array('bq_tx',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Tax</span></a>
			   <?php } ?>                 
			   <?php if(in_array('bq_tm',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_tax_mast.php' ><span>Tax Master</span></a></li>
			   <?php } ?>
			    <?php if(in_array('bq_td',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_tax_det.php' ><span>Tax Details</span></a></li>
			   <?php } ?>
			     <?php if(in_array('bq_tt',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view-fotax-structure.php' ><span>Tax Structure</span></a></li>
			   <?php } ?>
				   
			     <?php if(in_array('bq_me',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Menu Creation</span></a>
			   <?php } ?>
			   <?php if(in_array('bq_ic',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_categ_bqt.php' ><span>Item Category</span></a></li>
			   <?php } ?>
			                    
			    <?php if(in_array('bq_is',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_subcateg_bqt.php' ><span>Item Sub Category</span></a></li>
                            </ul>
                        </li>
                        <li><a href="#">Category</a>
                            <ul>
              
			   <?php } ?>
			 <?php if(in_array('bq_mg',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_menugrp_bqt.php' ><span>Menu Group</span></a></li>
			   <?php } ?>
 <?php if(in_array('bq_sm_g',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_submenuBqt_bqt.php' ><span>Sub Menu Group</span></a></li>
			   <?php } ?>
 <?php if(in_array('bq_mn',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view-menu-master.php' ><span>Menu Master</span></a></li>
			   <?php } ?>
 <?php if(in_array('bq_ims',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_itemmaster_bqt.php' ><span>Item Master</span></a></li>
			   <?php } ?>
			   			   
			  	
<?php if(in_array('bq_vs_v',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/view_valid_settlement_bqt.php' ><span>Valid Settlement</span></a></li>
			   <?php } ?>
<?php if(in_array('bq_abc',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/abcdates_bqt.php' ><span>ABC Dates</span></a></li>
			   <?php } ?>
<?php if(in_array('bq_mx',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/matrixpax_bqt.php' ><span>Matrix Pax</span></a></li>
			   <?php } ?>
			   <?php /* if(in_array('bq_rc',$menuVals) || $_SESSION['user'] == 'admin') { */ ?>
             <!-- <li class='last'><a href='<?php echo $home_path; ?>/masters/banquet/reason_code_bqt.php' ><span>Reason Codes</span></a></li>-->
			   <?php /* } */ ?>
			  
			                </ul>
                        </li>
                    </ul>
                </li>
               <li ><a href='#'>Operations</a> 
                    <ul>
                        <?php
	  if(in_array('bq_hb',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-hall-booking.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&val=' >Hall Booking</a></li>
	<?php } ?>
	
	<?php
	  if(in_array('bq_ad',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{  ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-hall-advance.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&val=' >Advance</a></li>
	<?php  }  ?>
	
	<?php
	  if(in_array('bq_ad_ca',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{  ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-halladvance-booking.php' >Cancel Advance</a></li>
	<?php  }  ?>
	<?php
	  if(in_array('bq_ad_ra',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{  ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-reservadvance.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&val=' >Refund Advance</a></li>
	<?php  }  ?>
	
	<?php
	  if(in_array('bq_fb',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-fb-creation-chk.php' >FP Creation</a></li>
	<?php } ?>
	<?php
	  /*if(in_array('bq_fap',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-fpapproval.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>' >FP Approval</a></li>
	<?php } */?>
	<?php
	  if(in_array('bq_en',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-amendments.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&val=' >Amendments</a></li>
	<?php } ?>
	<?php
	  if(in_array('bq_kot',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-fpkot.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&val=' >KOT</a></li>
	<?php } ?>
	<?php
	  if(in_array('bq_vr',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-fpvoucher-details.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&val=' >Voucher</a></li>
	<?php } ?>
	<?php
	  if(in_array('bq_blg',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-bqtbill-details.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&val=' >Billings</a></li>
	<?php } ?>
	<?php
	  if(in_array('bq_stt',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/settlement.php' >Settlement</a></li>
	<?php } ?>
	
	<?php
	  if(in_array('bq_stt_rst',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-resettlement.php' >Resettlement</a></li>
	<?php } ?>
	
	<?php
	  if(in_array('bbq_stt_ga',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/gst_amendment.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>' >GST Amendment</a></li>
	<?php } ?>
	
	<?php
	  if(in_array('bq_hbl',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-block-hall.php' >Hall Block</a></li>
	<?php } ?>
	<?php
	  /*if(in_array('bq_acr',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >ACR</a></li>
	<?php } ?>
	<?php
	  if(in_array('bq_dyc',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Day Closing</a></li>
	<?php } */?>
	
	<?php
	  if(in_array('bq_acr',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/Responsive-WYSIWYG/printing_tag.php' >Printing tag</a></li>
	<?php } ?>
	
       </ul>
   </li>
                   
				<li><a href="#">Reports</a>
				<ul>
    <?php  /* if(in_array('bq_dbl',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani') { */ ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-bqtbill-details.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&val=' >Duplicate Bills</a></li>
	<?php /* } */?>
	<?php   if(in_array('bq_rs',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani') {  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='<?php echo $home_path; ?>/transaction/frontdesk/view-duplicateHall-advance.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>' >Duplicate Advance</a></li>
	<?php } ?>
   <?php   if(in_array('bq_rs_bs',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani') {  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='<?php echo $home_path; ?>/reports/checkout/booking-logs.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&sts=all' >Booking Status</a></li>
	<?php } ?>
	<?php   if(in_array('bq_rs_sr',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/reports/checkout/sales-report.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>' >Sales Report</a></li>
	<?php } ?>
	
	<?php   if(in_array('bq_rad',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/reports/checkout/function-report.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>' >Function Wise Sales Report</a></li>
	<?php } ?>
	
	<?php   if(in_array('bq_rhr',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/reports/checkout/hallwise-report.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>' >Hall wise Revenue</a></li>
	
	<?php } ?>
	
	
	<?php if(in_array('bq_rps',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani') { ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='<?php echo $home_path; ?>/reports/checkout/settlement-report.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>' >Settlement Report </a></li>
	<?php } ?>	
	
<?php if(in_array('bq_rps_is',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani') {  ?>
<li class='<?php /*echo $qt;*/ ?>'><a href='<?php echo $home_path; ?>/reports/checkout/itemWise_sales.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>&mnuTy=' >Itemwise Sales</a></li>
<?php } ?>

	<?php   if(in_array('bq_rtx',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Tax Report</a></li>
	<?php } ?>	
	<?php   if(in_array('bq_rub',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Un Billed FP</a></li>
	<?php } ?>
	<?php   if(in_array('bq_rfd',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php echo $qt; ?>'><a href='<?php echo $home_path; ?>/reports/checkout/functionfortheday.php?fromdate=<?php echo $adtCurDt; ?>&todate=<?php echo $adtCurDt; ?>' >Functions for the Day</a></li>
	<?php } ?>
	<?php   if(in_array('bq_rps',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Production Sheet</a></li>
	<?php } ?>
		
	
                            </ul>
                        </li>
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Import</a>
						<ul class="dropdown-menu">
							<?php   if(in_array('po_pr',$menuVals) || $_SESSION['user'] == 'admin'){  ?>
								<li class='<?php /* echo $qt; */ ?>'><a href='<?php echo $home_path; ?>/import/import_menugrp.php' >Import Menu Group</a></li>
							<?php } ?>	
							<?php   if(in_array('gr_pr',$menuVals) || $_SESSION['user'] == 'admin'){  ?>
								<li class='<?php /*echo $qt;*/ ?>'><a href='<?php echo $home_path; ?>/import/import_submenugrp.php' >Import Submenu group</a></li>
							<?php } ?>
							<?php   if(in_array('po_pr',$menuVals) || $_SESSION['user'] == 'admin'){  ?>
								<li class='<?php /* echo $qt; */ ?>'><a href='<?php echo $home_path; ?>/import/import_menumaster.php' >Import Menu master</a></li>
							<?php } ?>	
							<?php   if(in_array('gr_pr',$menuVals) || $_SESSION['user'] == 'admin'){  ?>
								<li class='<?php /*echo $qt;*/ ?>'><a href='<?php echo $home_path; ?>/import/import_itemmaster.php' >Import Item master</a></li>
							<?php } ?>
						</ul>
					</li>
                   <!--<li><a href="#">Charts</a>
				<ul>
    <?php   if(in_array('bq_rb',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani') {  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='<?php echo $home_path; ?>/density_chart.php?fromdate=<?php echo $CurDt; ?>' >Density Chart</a></li>
	<?php } ?>
	
		
	
                            </ul>
                        </li>
						<li><a href='<?php echo $home_path;?>/dashboard.php?fromdate=<?php echo $fromdate;?>&todate=<?php echo $fromdate;?>'>Dashboard</a></li>-->
            </ul>
        </div>
    </div>
	
