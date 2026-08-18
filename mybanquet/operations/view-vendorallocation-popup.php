<?php
ob_start();
include("../includes/header.php");
?>

<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$("[rel=tooltip]").tooltip();
	$("[rel=popover]").popover({trigger:'hover',html:true});
				  
	 $(':checkbox').click(function(e){
																
			if($("input:checked").length>0){
			   $('#print').show();
			   $('#email').show();
			   $('#approve').show();
			}else{
			   $('#print').hide();
			   $('#email').hide();
			   $('#approve').hide();
			 }
		   
		});			    
			  
});


					function setPrint(id,val)
						{	
							if($("#"+id).is(":checked"))
							{  
								$('.ckPrint').each(function(){
									a_id=this.id.split('_');
									if($(this).attr('id') != id)
									{
										$(this).attr("disabled",true);
										$("#ed"+a_id[1]).attr("style","display:none");
									}
								});
							}
							else
							{
								$('.ckPrint').each(function(){
									a_id=this.id.split('_');
									$(this).removeAttr("disabled");
									$("#ed"+a_id[1]).attr("style","display:inline");
								});
							}
						}
						
						function popup()
						{
							id=$('.ckPrint:checkbox:checked').val();
							TINY.box.show({url:'vendorAllocationEmail.php?uid'+id,width:418,height:550});
							/* newwindow=window.open('<?php echo $home_path;?>/views/quote_printout.php?uid='+id,'mywin','left=120,width=1000,height=700,');
							newwindow.focus(); */
						}
						function popupDC()
						{
							id=$('.ckPrint:checkbox:checked').val();
							newwindow=window.open('<?php echo $home_path;?>/operations/customerpo.php?uid='+id,'_blank');
							newwindow.focus(); 
						}
						

						
</script>

<link rel="stylesheet" href="<?php echo $home_path;?>/tinybox2/style.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/tinybox2/tinybox.js"></script>


<body class="bgBODY">
	<div style="margin:10px 0 10px 0;flot:right;">
		<a class="submitbtnAdd" href="vendor_allocation.php">Add Vendor Allocation</a>
	</div>
<div class="about">
	<div class="container" style="width:1000px;/* margin:0; */padding:0;">
	
	<div style="height:33px;margin:0 0 0 22px;" id="toolbar">
    <div class="btn-group">
                          						
	<!--<button type="button" id="print" style="display:none" class="submitbtnprint btnn" onclick="popup()">Print</button>-->				  
	<!--<button type="button" id="email" style="color:#000;display:none" onclick="TINY.box.show({url:'vendorAllocationEmail.php?uid',width:418,height:550})" class="btnn submitbtnedit" onclick="popup()" >Email </button> --> 
	<button type="button" id="email" style="color:#000;display:none" onclick="popup();" class="btnn submitbtnedit" onclick="popup()" >Email </button>  
	<button type="button" id="approve" style="color:#000;display:none" onclick="TINY.box.show({url:'sendToVendorAPProve.php',width:418,height:250})" class="btnn submitbtnedit" onclick="popupDC()" >Approve </button>
<div>
		<input value="<?php echo $_POST['keyword']?>" name="keyword" type="text" class="input-medium search-query" style="float:left;margin-left:635px;margin-top:-21px;display:none"/>
		<button style="margin-top: -4.1%;height: 21px;font-size: 12px;padding-top: 1px;float: left;display:none" class="btnn">Go</button>
</div>
</div>
</div>
					
					
		<div class="col-md-12" style="overflow:auto;width:1000px;height:450px;" >
		
		<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>View Vendor Master</b></h3>
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table">
		  <?php 
	$sql=mysql_query("select * from vendor_allocation where company_id='".$_SESSION['companyId']."'");
	$x=0;
	if(mysql_num_rows($sql)>0) {
		?>
		 	<thead>
				<th>S No.</th>
				<th></th>
				<th>RFQ No</th>
				<th>Vendor Name</th>
				<th>Vendor Price</th>
				<th>Unit Price</th>
				<th>Qty</th>
				<th>Total Amount</th>
				<th>Approve status</th>
				<th style="text-align:center;">Edit</th>
			</thead>
                     
		<?php
	while($row=mysql_fetch_array($sql)) {
		$x++;
		 if($row['proceed_po']==1){
			$status='Yes';
		}else{
			$status='No';
		} 
	?>
		<tbody>
			<tr >
			<td><?php echo $x; ?></td>
			<td><input name="chk[]"  type="checkbox" id="c_<?php echo $row['vendorallot_id']?>" class="ckPrint group1 check_" value="<?php echo $row['vendorallot_id']?>" onclick="setPrint(this.id,this.value);" /></td>
			<td class="codesUPPERCase"><?php echo $row['rfq_no']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['vendor_name']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['vendor_price']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['unit_price']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['qty']; ?></td>
			<td class="fstChUPPRCase"><?php echo $row['total_amount']; ?></td>
			<td class="fstChUPPRCase"><?php echo $status; ?></td>
<td>
	<div style="display:inline"; id="ed<?php echo $row['vendorallot_id'];?>">
		<a title="Edit Vendor Details" href="update_vendor_allocation.php?uid=<?php echo $row['vendorallot_id']?>" style="color:#005580;" >Edit</a>
	</div>
	
	<input type="text" id="venId" value="<?php echo $row['vendorallot_id'];?>"/>
</td>	
<?php
/* 	$var=explode('?',$_SERVER['REQUEST_URI']);
	$page=preg_replace('/.*\/([^\/])/','$1',$var[0]);
	unset($var);
	$menuVals =explode(',',$_SESSION['menuOption']); */
	?>
	<?php
		/* if(in_array('vend_modify',$menuVals) || $_SESSION['user'] == 'admin' || $_SESSION['user'] == 'mani')
		{ */ ?>
		<!--<td><a title="Edit Vendor Details" href="update-vendor-master.php?uid=<?php echo $row['vendor_id']?>" style="color:#005580;" >Edit</a></td>-->
		 <?php /* }else{ */ ?>
		<!--<td><a title="Edit Vendor Details" href="#" style="color:#333333;" >Edit</a></td>-->
		<?php /* } */ ?>	
		<!--</tr>-->
		</tbody>
		 <?php   }   ?>
	</table>
<?php  } else { ?>

		  <div style="margin:10px 0 10px 0" class="alert alert-success">
			   You have not created any vendor Details...
		 </div>

		<?php  }  ?>

	</form>

		  
		  
		  
		  
		  
		  
		</div>
		</div>
		</div>