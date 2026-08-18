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
	}
	else if($page=='quotation.php'){
		$ad = '';
		$ms = ''; 
		$qt = 'active'; 
	}
?>
  
  <link rel="stylesheet" href="<?php echo $home_path; ?>/flat-menu/styles.css">
  <script src="<?php echo $home_path; ?>/flat-menu/script.js"></script>
   
   <div id='cssmenu'>
<ul>
    <li class='<?php echo $ad; ?> has-sub '><a href='#'>Admin</a>
      <ul>
	    <?php
		if(in_array('user_masters',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li ><a href='<?php echo $home_path; ?>/admin/user-master.php' >User Master</a></li>
		 <?php } ?>	
		 <?php
		if(in_array('access_rights',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li ><a href='<?php echo $home_path; ?>/admin/update-access-rights.php'  >Access Rights</a></li>
		 <?php } ?>	
		  <?php
		if(in_array('change_password',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
		 <li ><a href='<?php echo $home_path; ?>/admin/update-password.php' >Change Password</a></li>
		  <?php } ?>	
		   <?php
		if(in_array('hms_para',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
			<li><a href='<?php echo $home_path; ?>/admin/update_parameters.php'><span>Hms Parameters</span></a></li>
		  <?php } ?>
		 		 
      </ul>
   </li>
   <li class='<?php echo $ms; ?> has-sub'><a href='#'>Masters</a>
      <ul>
               <?php if(in_array('prop_def',$menuVals) || $_SESSION['user'] == 'admin') { ?>
               <li><a href='<?php echo $home_path; ?>/masters/frontoffice/property-definition.php' style="cursor:pointer;" ><span>Property Definition</span></a></li>
			<?php } ?>
			 <script type="text/javascript">
						
						function popupBillPrint()
						{
												 
						 newwindow=window.open('<?php echo $home_path;?>/masters/frontoffice/bill-print-307.php',"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
						newwindow.focus(); 
						}
						
						function popupHtlDefi(){
						 newwindow=window.open('<?php echo $home_path;?>/masters/frontoffice/hotel-definition.php',"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
						newwindow.focus(); 
						}
						
						</script>
			 <?php if(in_array('busin_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Stores</span></a></li>
			   <?php } ?>
			    <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Groups</span></a></li>
			   <?php } ?>
			   <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='<?php echo $home_path; ?>/masters/frontoffice/stewart-master.php' ><span>UOM</span></a></li>
			   <?php } ?>
			   <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>CostCentre</span></a></li>
			   <?php } ?>
			   <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Item Master(stores)</span></a></li>
			   <?php } ?>
			    <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Supplier Master</span></a></li>
			   <?php } ?>
			    			   
			   <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Tax Code</span></a></li>
			   <?php } ?>
			    <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Tax Structure(stores)</span></a></li>
			   <?php } ?>
			   <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Item Template Master</span></a></li>
			   <?php } ?>
			   <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Store Parameters</span></a></li>
			   <?php } ?>
			   <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>SubCostCentre</span></a></li>
			   <?php } ?>
			   <?php if(in_array('comp_mast',$menuVals) || $_SESSION['user'] == 'admin') { ?>
              <li class='last'><a href='#' ><span>Standing PO</span></a></li>
			   <?php } ?>
			   </ul>
   </li>
   
<li ><a href='#'>Operations</a> 
<ul>
<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >ItemTemplate</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Indents</a></li>
	<?php } ?>
	
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Department Req</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Purchase Order</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Receipts</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Receipt Returns</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Storewise Issues</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Issues</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Issue Returns</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Adjustments</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Physical Stock </a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Physical Stock Entry</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Month End Closing</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Purchase Invoice</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Close Indents</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >DIR Receipts</a></li>
	<?php } ?>
	<?php
	  if(in_array('accou_receiv',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ ?>
         <li class='<?php echo $qt; ?>'><a href='#' >Supplier Merge</a></li>
	<?php } ?>
	
	
	
       </ul>
   </li>
   
  <li><a href='#'>Reports</a> 
   <ul>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php echo $qt; ?>'><a href='#' >Template Print</a></li>
	<?php } ?>
	<?php if(in_array('roomadvrt_det',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani') { ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Indent Print </a></li>
	<?php } ?>	
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Po Print</a></li>
	<?php } ?>	
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Grn Print</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Issue Print</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Item Listing</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Supplier Item List</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Items Expiry List</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Stock Ledger</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Store Ledger</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >CostCentre </a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Remarks Wise </a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Item wise Report</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Receipt Returns</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >FSN Analysis</a></li>
	<?php } ?>
	<?php   if(in_array('chkout_sumry',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani'){  ?>
	<li class='<?php /*echo $qt;*/ ?>'><a href='#' >Physical Stock</a></li>
	<?php } ?>
	</ul>
	</li>
  <li ><a href='#'>Database Backup</a> 
	  <ul>
	  <?php   if(in_array('data_backup',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani') { ?>
<li <?php /* echo $db; */ ?>><a href="<?php echo $home_path;?>/transaction/backup/download-link.php">DB Backup</a></li>
<?php } ?>	
</ul>
</li>

</ul>
</li>


</div>